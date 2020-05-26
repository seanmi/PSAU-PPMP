<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Submission;

use App\User;

use App\Plan;
use App\Item;
use App\Category;
use App\Budget;
use App\Ready;

use Session;

use DB;

use Nexmo;

use Carbon\Carbon;

class SubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::where('user_lvl','=', 4)->get();
        $arr = "";
        foreach($users as $user){
            $arr .= $user->name.",";
        }

        $s = Submission::all();

        return view('budget.submissions.index')->with('submissions', Submission::all())->with('users', $arr);
    }

    public function activate($id){

        $budget = Budget::where('submission_id', $id)->get();
        
        if($budget->count() >= 1){          
            $submission = Submission::find($id);
            $submission->active = 1;
            
            foreach ($budget as $key => $value) {
                Plan::create([
                 'name' => 'PPMP '.$value->user->department->name.' for year '.$submission->year,
                 'budget_id' => $value->id,
                 'state' => 5,
                 'remarks' => NULL,
                 'submission_id' => $id,
                ]);

                // try {
                //     Nexmo::message()->send([
                //         'to' => $value->user->contact_no,
                //         'from' => '639359005736',
                //         'text' => 'Budget for PPMP '.$value->user->department->name.' for year '.$submission->year.' is ready'
                //     ]);
                // } catch (Exception $e) {
                //     Session::flash('fail','Notification for'.$value->user->department->name.' failed to sent');
                // }
             }  

             $submission->save();     

             Session::flash('success', 'Submission Activated Successfully!');
             return redirect()->back();
        }else{
            Session::flash('fail','No alloted budget found!');
            return redirect()->back();
        }
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

        $this->validate($request,[
            'title' => 'required|unique:submissions',
            'instruction' =>'required',
            'deadline_submission' => 'required',
        ]);
        $end = new Carbon(request()->deadline_submission);
        $now = Carbon::now();
        $d = $now->diff($end);

        if($d->invert == 1){
            Session::flash('fail', 'Backdate error!');
            return redirect()->back();           
        }
        $check_submission = Submission::where('active', 1)->first();

        $ready = Ready::first();
        if($ready->ready ==0){
            Session::flash('fail', 'Procurement is not yet ready!');
            return redirect()->back();
        }else{
            $date = new Carbon(request()->deadline_submission); 

            $check_date = Submission::where('year', $date->year)->get();
    
            if($check_date->count() >=1){
                Session::flash('fail', 'Only 1 submission can be created per year.');
    
                return redirect()->back();
            }else{
                if ($check_submission) {
                    Session::flash('fail', 'There is active submission found'); 
                    return redirect()->back();   
                }else{
                    $submission = Submission::create([
                        'title' => request()->title,
                        'instruction' => request()->instruction,
                        'deadline_submission' => request()->deadline_submission,
                        'active' => 0,
                        'year' => $date->year,
                    ]);
            
                    // $users = User::all();
                    // $array_user_id = [];
            
                    // foreach($users as $user){
                    //     if($user->user_lvl == 4){
                    //         array_push($array_user_id, $user->id);
                    //         Plan::create([
                    //             'name' => 'PPMP '.$user->department->name.' for year '.$date->year,
                    //             'user_id' => $user->id,
                    //             'plan_year' => $date->year,
                    //         ]);
                    //     }            
                    // }
            
                    // $submission->submissionUsers()->attach($array_user_id);
            
                    Session::flash('success', 'Submission Created Successfully!');
            
                    return redirect()->back();
                }
            }           
        }
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
        $this->validate($request,[
            'title' => 'required',
            'instruction' =>'required',
            'deadline_submission' => 'required',
            'active' => 'required',
        ]);

        $submission = Submission::find($id);
        $date = new Carbon(request()->deadline_submission); 

        $submission->title = request()->title;
        $submission->instruction = request()->instruction;
        $submission->deadline_submission = request()->deadline_submission;
        $submission->active = request()->active;
        $submission->year = $date->year;
        $submission->save();

        Session::flash('success', 'Updated Successfully');

        return redirect()->back();
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

    public function consolidation($year){
        $categories = Category::all();
        $data = DB::table("item_plan")
        ->join('items', 'items.id', '=', 'item_plan.item_id' )
        ->join('plans', 'plans.id', '=', 'item_plan.plan_id' )
        ->select('plans.plan_year','items.*',DB::raw("SUM(item_plan.estimated_budget) as total_estimated_budget"),DB::raw("SUM(item_plan.quantity) as total_quantity"))
        ->where('plans.state', '=', 2)
	    ->groupBy("item_plan.item_id")
        ->get();
     
        return view('procurement.consolidation.index')->with('items', $data)->with('categories', $categories);
    }

    public function consolidationItem($id, $year){
        $item = Item::find($id);
        $data = DB::table('submissions')
            ->join('submission_user', 'submission_user.submission_id', '=', 'submissions.id')
            ->join('plans', 'plans.user_id', '=', 'submission_user.user_id')
            ->join('item_plan', 'item_plan.plan_id', '=', 'plans.id')
            ->join('departments', 'departments.id', '=', 'item_plan.user_id')
            ->join('items', 'items.id', '=', 'item_plan.item_id')
            ->select('*')
            ->where('year', '=', $year)
            ->where('item_plan.item_id', '=', $id)
            ->get();

        return view('procurement.consolidation.itemSummary')->with('items', $data)->with('item', $item);
        
    }
}
