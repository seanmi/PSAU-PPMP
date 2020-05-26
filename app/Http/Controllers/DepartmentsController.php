<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

use App\User;
use App\Group;

use Session;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bac.departments.index')->with('departments', Department::all())->with('groups', Group::all());
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
        $this->validate($request, [
            'name' => 'required|unique:departments',
            'group_id' => 'required'
        ]);

        Department::create([
            'name' => request()->name,
            'group_id' => request()->group_id,
        ]);

        Session::flash('success', 'Department Added');

        return redirect()->back();
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
        $this->validate($request, [
            'name' => 'required',
            'group_id' => 'required'
        ]);

        $dept = Department::find($id);

        $dept->name = request()->name;
        $dept->group_id = request()->group_id;
        $dept->save();

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
        $dept = Department::find($id);
        $user = User::where('department_id', $dept->id)->first();

        if($user){
            Session::flash('fail', 'Unable to delete. Department is in use');
            return redirect()->back();
        }
        else{
            $dept->delete();
            Session::flash('success', 'Deleted Successfully!');
            return redirect()->back();
        }
    }
}
