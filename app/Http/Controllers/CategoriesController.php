<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Item;
use Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('procurement.categories.index')->with('items', Category::all());
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

        Category::create([
            'name' => request()->name
        ]);

        Session::flash('success', 'Category Added!');

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
        $category = Category::find($id);

        if(request()->name){
            if(request()->name === $category->name){
                Session::flash('fail','Nothing Changed');
                return redirect()->back();
            }else{
                $category->name = request()->name;
                $category->save();
                Session::flash('success','Updated Successfully');
                return redirect()->back();
            }
        }else{
            Session::flash('fail','Nothing Changed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $item = Item::where('category_id', $category->id)->first();
        
        if($item){
            Session::flash('fail', 'Unable to delete. Category is in use!');
            return redirect()->back();
        }else{
            $category->delete();
            Session::flash('success', 'Deleted Successfully');
            return redirect()->back();
        }
    }
}
