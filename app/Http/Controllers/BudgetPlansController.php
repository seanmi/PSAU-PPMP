<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;

use App\Submission;
use DB;
use Session;
use App\User;
use App\Approval;
use App\Category;
use App\Budget;
use Nexmo;
class BudgetPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('state', 4)->orderBy('updated_at', 'asc')->get();
       
        return view('budget.plans.index')->with('plans', $plans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);

        $group= $plan->budget->user->department->group; 

        $vps = User::whereIn('position_id', [2,3,4,5])->get();
        // dd($vp->department->where('group_id', $group->id));

        foreach ($vps as $vp) {
            if($vp->department->group_id == $group->id){
                $user_vp = $vp;
                break;
            }
        }

        $arr_ids = [];

        $categories = Category::all();
        
        foreach ($categories as  $category) {
            $plan_items = DB::table('item_plan')
                ->join('items', 'items.id', '=', 'item_plan.item_id')
                ->join('categories', 'categories.id', '=', 'items.category_id')
                ->where('categories.id', '=', $category->id)
                ->where('item_plan.plan_id', '=', $plan->id)
                ->select('categories.id')
                ->first();
            if($plan_items){
                array_push($arr_ids, $category->id);
            }
        }

        $user_item_categories = Category::whereIn('id', $arr_ids)->get();


        return view('budget.plans.viewItems')->with('plan', $plan)->with('categories', $user_item_categories)->with('vp', $user_vp);

        // return view('budget.plans.viewItems')->with('items',$plan)->with('plan_name', $plan)->with('budget', $budget);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approved($id){
        $plan = Plan::find($id); //2345
        $end_user = $plan->budget->user; 
        $group = $plan->budget->user->department->group; 
        $vps = User::whereIn('position_id', [2,3,4,5])->where('user_lvl', '!=', 6)->get();
        // dd($vp->department->where('group_id', $group->id));

        foreach ($vps as $vp) {
            if($vp->department->group_id == $group->id){
                $user_vp = $vp;
                Approval::create([
                    'user_id' => $user_vp->id,
                    'plan_id' => $id,
                    'remarks' => '',
                    'approved' => 0,
                ]);
                break;
            }
        }

  
        $plan->state = 3;
        $plan->save();

        // Nexmo::message()->send([
        //     'to' => $user_vp->contact_no,
        //     'from' => '639359005736',
        //     'text' => 'For Review Plan. '.$plan->name
        // ]);

        $submission = Submission::where('year', $plan->plan_year)->get()->first();
        
        DB::table('submission_user')
        ->where('user_id', $plan->user_id)
        ->update(['submitted' =>1]);

        $users = User::where('user_lvl', 2)->get();

  
        Session::flash('success', 'Approved!');

        return redirect()->route('budget.plans');
    }

    public function disapproved(Request $request, $id){
        $this->validate($request, [
            'remarks' => 'required'
        ]);

        $plan = Plan::find($id);
        $plan->remarks = request()->remarks;
        $plan->state = 5;
        $plan->save();

        $user = User::find($id);

        // Nexmo::message()->send([
        //     'to' => $user->contact_no,
        //     'from' => '639359005736',
        //     'text' => 'Your plan was disapproved, Remarks:'.request()->remarks
        // ]);

        Session::flash('success', 'Disapproved');
        return redirect()->route('budget.plans');

        

    }
}
