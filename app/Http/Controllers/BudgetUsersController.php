<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Plan;

use Response;

use App\Budget;

use Session;

use Nexmo;

use DB;

class BudgetUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers($id)
    {

        $budget = Budget::where('submission_id', $id)->get();
        $ids = [];
        foreach ($budget as $key => $value) {
            array_push($ids, $value->user_id);
        }

        $user = DB::table('users')
                ->leftJoin('departments', 'departments.id', '=', 'users.department_id')
                ->whereNotIn('users.id', $ids)
                ->where('users.user_lvl', '=', 6)
                ->select('users.id','users.name as username', 'departments.name as deptname')
                ->get();

        return Response::json($user);
    }

    public function budgetIndex($id){
        $budget = Budget::where('submission_id', $id)->get();
        return view('budget.submissions.budgetAllotment')->with('budgets', $budget)->with('submission_id', $id);
    }

    public function budgetModifyIndex($id){
        $budget = Budget::where('submission_id', $id)->get();

        $ids = [];
        foreach ($budget as $key => $value) {
            array_push($ids, $value->user_id);
        }

        $user = DB::table('users')
                ->leftJoin('departments', 'departments.id', '=', 'users.department_id')
                ->whereNotIn('users.id', $ids)
                ->where('users.user_lvl', '=', 6)
                ->select('users.id','users.name as username', 'departments.name as deptname')
                ->get();
        
        return view('budget.submissions.budgetAllotmentModify')->with('budgets', $budget)->with('submission_id', $id)->with('users', $user);
    }


    public function budgetStore(Request $request, $id){
        $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        $user_ids = request()->user_id;
        $amounts = request()->amount;
        if(sizeof($user_ids) !== sizeOf($amounts)){
            Session::flash('fail', 'Error adding buget');
            return redirect()->back();
        }else{
            foreach ($user_ids as $key => $value) {
                Budget::create([
                    'amount' => $amounts[$key],
                    'submission_id' => $id,
                    'user_id' => $user_ids[$key],
                    'remaining' => $amounts[$key],
                ]);
            }

            Session::flash('success', 'Success!');
            return redirect()->back(); 
        }
    }

    public function budgetStoreModified(Request $request, $id){
        $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        $user_ids = request()->user_id;
        $amounts = request()->amount;
        if(sizeof($user_ids) !== sizeOf($amounts)){
            Session::flash('fail', 'Error adding buget');
            return redirect()->back();
        }else{
            foreach ($user_ids as $key => $value) {
                $b = Budget::create([
                    'amount' => $amounts[$key],
                    'submission_id' => $id,
                    'user_id' => $user_ids[$key],
                    'remaining' => $amounts[$key],
                ]);

                Plan::create([
                    'name' => 'PPMP '.$b->user->department->name.' for year '.$b->submission->year,
                    'budget_id' => $b->id,
                    'state' => 5,
                    'remarks' => NULL,
                    'submission_id' => $id,
                   ]);

                // Nexmo::message()->send([
                //         'to' => $b->user->contact_no,
                //         'from' => '639359005736',
                //         'text' => 'Budget for PPMP '.$b->user->department->name.' for year '.$b->submission->year.' is ready'
                // ]);
            }

            Session::flash('success', 'Success!');
            return redirect()->back(); 
        }
    }


    public function budgetUpdate(Request $request, $id){
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $budget = Budget::find($id);
        $budget->amount = request()->amount;
        $budget->remaining = request()->amount;
        $budget->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->back(); 
    }

    public function budgetDelete($id){
        Budget::destroy($id);

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->back();      
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
