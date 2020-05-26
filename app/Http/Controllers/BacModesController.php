<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ModeOfProcurement;

use Session;

use DB;

class BacModesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bac.modes.index')->with('modes', ModeOfProcurement::all());
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
            'name' => 'required'
        ]);

        ModeOfProcurement::create([
            'name' => request()->name
        ]);

        Session::flash('success', 'Added Successfully!');

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
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $mode = ModeOfProcurement::find($id);
        $mode->name = request()->name;
        $mode->save();

        Session::flash('success','Updated Successfully!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function des($id)
    {
       
        $mode = ModeOfProcurement::find($id);
        $m = DB::table('procurement_categories')
            ->where('procurement_categories.mode_of_procurement_id', '=', $mode->id)
            ->first();
        
            if($m){
                Session::flash('fail', 'Unable to delete. Mode is in use');
                return redirect()->back();
            }else{
                $mode->delete();
                Session::flash('success', 'Deleted Successfully');
                return redirect()->back();
            }
    }
}
