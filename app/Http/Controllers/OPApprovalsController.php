<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Approval;
use App\Plan;

use Auth;
use App\User;
use Nexmo;
use Session;
use App\Category;
use DB;

class OPApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvals = Approval::where('user_id', Auth::user()->id)->where('approved', 0)->orderBy('updated_at', 'asc')->get();
        return view('op.approvals.index')->with('approvals', $approvals);
    }

    public function approvedOP(){
        $approvals = Approval::where('user_id', Auth::user()->id)->orderBy('updated_at', 'asc')->where('approved', 1)->get();
        
        return view('op.approvals.approved')->with('approvals', $approvals);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved($id)
    {
        $approval = Approval::find($id);
        $approval->approved = 1;
        $approval->save();
        $plan = Plan::find($approval->plan_id);
        $plan->state = 1;
        $plan->submitted = 1;
        $plan->save();

        $user = User::where('position_id', 7)->first();

        // Nexmo::message()->send([
        //     'to' => $user->contact_no,
        //     'from' => '639359005736',
        //     'text' => 'New Plan Submission. '.$plan->name
        // ]);


        Session::flash('success', 'Approved!');

        return redirect()->route('op.approvals');

        
    }

    public function disapproved(Request $request,$id){
        $this->validate($request, [
            'remarks' => 'required'
        ]);

        $approval = Approval::find($id);
        $plan = $approval->plan;
        $plan->state = 5;
        $plan->remarks = request()->remarks;
        $plan->save();

        // Nexmo::message()->send([
        //     'to' => $plan->budget->user->contact_no,
        //     'from' => '639359005736',
        //     'text' => 'Your PPMP was disapproved'
        // ]);

        $approvals = Approval::where('plan_id', $approval->plan_id)->get();

        foreach ($approvals as  $approval) {
            Approval::destroy($approval->id);
        }

        return redirect()->back();
    }

    public function planSummary($id){

        $plan = Plan::find($id);

        $planApproval = $plan->approval->where('user_id', Auth::user()->id)->where('plan_id', $plan->id)->first();

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


        return view('op.approvals.viewItems')->with('plan', $plan)->with('categories', $user_item_categories)->with('vp', $user_vp)->with('approval', $planApproval);
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
        //
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
}
