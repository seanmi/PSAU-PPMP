<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Submission;

use App\Plan;
use App\Budget;

use Session;

use Auth;

use DB;

class UserSubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user()->id;
        $submission = Submission::where('active', 1)->first();
        if(!$submission){
            $submission = collect([]);
            $plans = collect([]);
            return view('user.submissions.index')->with('submissions', $submission)->with('plans', $plans);          
        }
        $budget = Budget::where('user_id', $auth)->where('submission_id', $submission->id)->first();
        if($budget){
            $plans = Plan::where('budget_id', $budget->id)->where('state', 5)->first();
        }else{
            $plans = collect([]);
        }


        // $submission = Submission::where('active', 1)->first();
        // $sub = Submission::where('active', 1)->get();

        // $budget = Budget::where('submission_id', $submission->id)->where('user_id', Auth::user()->id)->first();

        if($budget && $plans){
            // $plans = $budget->plan->where('state', 4)->first();
            return view('user.submissions.index')->with('submissions', $budget->submission->where('id', $submission->id)->get())->with('plans', $plans);
        }else{
            $submission = collect([]);
            $plans = collect([]);
            return view('user.submissions.index')->with('submissions', $submission)->with('plans', $plans);
        }
        // $plans = Plan::where('user_id', Auth::user()->id)->where('state', 4)->get();

        // $submission = DB::table('plans')
        //                 ->join('submissions', 'submissions.id', '=', 'plans.submission_id')
        //                 ->where('plans.state', '=', 4)
        //                 ->where('plans.user_id', '=', Auth::user()->id)
        //                 ->select('submissions.*', 'plans.id as plan_id')
        //                 ->get();


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
