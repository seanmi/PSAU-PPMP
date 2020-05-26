<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Department;

use App\Plan;
use App\Position;
use App\Budget;
use DB;

use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $end_users = User::where('user_lvl', '=', 6)->get();
        $users = User::where('user_lvl', '!=', 6)->get();
        return view('bac.users.index')->with('users',$users)->with('end_users', $end_users)->with('departments', Department::all())->with('positions', Position::all());
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
            'name' => 'required|unique:users',
            'email' => 'required|unique:users,email',
            'contact_no' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
        ]);

        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'contact_no' => request()->contact_no,
            'department_id' => request()->department_id,
            'position_id' => request()->position_id,
            'password' => bcrypt('password'),
            'user_lvl' => 6,
        ]);

        Session::flash('success', 'User Added');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
        ]);

        $user = User::find($id);
        $u = User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->contact_no = request()->contact_no;
        if($request->has('password') && request()->password !==NULL){
        $user->password = bcrypt(request()->password);
        }
        $user->save();
        Session::flash('success','Successfully Updated');
        return redirect()->back();
    }

    public function updateUser(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'position' => 'required',
            'department' => 'required',
        ]);   

        $user = User::find($id);

        $user->name = request()->name;
        $user->email = request()->email;
        $user->position_id = request()->position;
        $user->contact_no = request()->contact_no;
        $user->department_id = request()->department;
        if($request->has('password') && request()->password !==NULL){
            $user->password = bcrypt(request()->password);
        }
        $user->save();
        Session::flash('success','Successfully Updated');
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
    
        $user = User::find($id);

        $budget = Budget::where('user_id', $user->id)->first();

        if($budget){
            Session::flash('fail', 'Unable to delete');
            return redirect()->back();
        }else{
            $user->delete();
            Session::flash('success', 'Deleted Successfully');
            return redirect()->back();
        }
    }
}
