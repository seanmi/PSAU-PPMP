<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Item;

use App\Category;

use App\Submission;

use App\Ready;

use DB;



class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorized = Item::where('category_id', '!=', 1)->get();
        $uncategorized = Item::where('category_id', '=', 1)->get();
        return view('procurement.items.index')->with('items', Item::all())->With('categorized',$categorized)->with('uncategorized', $uncategorized)->with('categories', Category::all());
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
            'general_description' => 'required|unique:items',
            'unit' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        Item::create([
            'general_description' => request()->general_description,
            'unit' => request()->unit,
            'price' =>request()->price,
            'category_id' =>request()->category_id,
        ]);

        Session::flash('success', 'Item Added');

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
            'general_description' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
        $submission = Submission::where('active', 1)->get(); 
        if($submission->count() !== 0){
            Session::flash('fail', 'Updating is disabled when there are active submissions');
            return redirect()->back();
        }

        $item = Item::find($id);
        $item->general_description = request()->general_description;
        $item->unit = request()->unit;
        $item->price = request()->price;
        $item->category_id = request()->category_id;
        $item->save();

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
        $item = Item::find($id);
        $items = DB::table('item_plan')
                    ->where('item_plan.item_id', '=', $item->id)
                    ->select('*')
                    ->get();
            
        if($items->count() !==0){
            Session::flash('fail', 'Unable to delete. Item is in use');
            return redirect()->back();
        }else{
            $item->delete();
            Session::flash('success', 'Deleted Successfully');
            return redirect()->back();            
        }
    }

    public function ready(){
        $r = Ready::first();
        $r->ready = 1;
        $r->save();

        Session::flash('success', 'Success');

        return redirect()->back();
    }

    public function unready(){
        $r = Ready::first();
        $r->ready = 0;
        $r->save();

        return redirect()->back();
    }
}
