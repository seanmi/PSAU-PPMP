<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Submission;

use App\Category;

use App\Item;

use App\ModeOfProcurement;

use App\ProcurementCategory;

use DB;

use Session;


class BacSubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bac.submission.index')->with('submissions', Submission::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consolidation($id)
    {
        $categories = Category::all();
        $modes = ModeOfProcurement::all();
        $submission = Submission::find($id);
        $data = DB::table("item_plan")
        ->join('items', 'items.id', '=', 'item_plan.item_id' )
        ->join('plans', 'plans.id', '=', 'item_plan.plan_id' )
        ->join('budgets', 'budgets.id', '=', 'plans.budget_id' )
        ->join('submissions', 'submissions.id', '=', 'budgets.submission_id')
        ->where('plans.state', '=', 1)
        ->where('submissions.id', '=', $submission->id)
        ->select('items.*','submissions.id as sub_id',DB::raw("SUM(item_plan.estimated_budget) as total_estimated_budget"),DB::raw("SUM(item_plan.quantity) as total_quantity"))
	    ->groupBy("item_plan.item_id")
        ->get();

        $mode_category = DB::table('procurement_categories')
            ->join('submissions', 'submissions.id', '=', 'procurement_categories.submission_id')
            ->join('categories', 'categories.id', '=', 'procurement_categories.category_id')
            ->join('mode_of_procurements', 'mode_of_procurements.id', '=', 'procurement_categories.mode_of_procurement_id')
            ->where('procurement_categories.submission_id', '=', $id)
            ->select('categories.id as c_id', 'mode_of_procurements.*')
            ->get();
 
  
        return view('bac.consolidation.index')->with('items', $data)->with('categories', $categories)->with('modes', $modes)->with('submission_id', $id)->with('mode_category', $mode_category)->with('submission', $submission);
    }

    public function consolidationItem($id, $sub_id){
        $item = Item::find($id);
        $data = DB::table('submissions')
            ->join('budgets', 'budgets.submission_id', '=', 'submissions.id')
            ->join('plans', 'plans.budget_id', '=', 'budgets.id')
            ->join('item_plan', 'item_plan.plan_id', '=', 'plans.id')
            ->join('items', 'items.id', '=', 'item_plan.item_id')
            ->where('submissions.id', '=', $sub_id)
            ->where('item_plan.item_id', '=', $id)
            ->where('plans.submitted', '=', 1)
            ->select('*')
            ->get();
        

        return view('bac.consolidation.itemSummary')->with('items', $data)->with('item', $item);
        
    }

    public function consolidationSummary($id){
        $categories = Category::all();
        $modes = ModeOfProcurement::all();
        $submission = Submission::find($id);
        $data = DB::table("item_plan")
        ->join('items', 'items.id', '=', 'item_plan.item_id' )
        ->leftjoin('categories', 'categories.id', '=', 'items.category_id' )
        ->join('plans', 'plans.id', '=', 'item_plan.plan_id' )
        ->join('budgets', 'budgets.id', '=', 'plans.budget_id' )
        ->join('submissions', 'submissions.id', '=', 'budgets.submission_id')
        ->leftjoin('procurement_categories', function($join){
            $join->on('procurement_categories.submission_id', '=', 'submissions.id');
            $join->on('procurement_categories.category_id', '=', 'categories.id');
        })
        ->leftjoin('mode_of_procurements', 'mode_of_procurements.id', '=', 'procurement_categories.mode_of_procurement_id')
        ->where('plans.state', '=', 1)
        ->where('submissions.id', '=', $submission->id)
        ->select('items.*','mode_of_procurements.name as modeName','submissions.id as sub_id','item_plan.*',DB::raw("SUM(item_plan.estimated_budget) as total_estimated_budget"),DB::raw("SUM(item_plan.quantity) as total_quantity"),DB::raw("SUM(item_plan.q1) as total_q1"), DB::raw("SUM(item_plan.q2) as total_q2"), DB::raw("SUM(item_plan.q3) as total_q3"),DB::raw("SUM(item_plan.q4) as total_q4"))
	    ->groupBy("item_plan.item_id")
        ->get();

        $mode_category = DB::table('procurement_categories')
            ->join('submissions', 'submissions.id', '=', 'procurement_categories.submission_id')
            ->join('categories', 'categories.id', '=', 'procurement_categories.category_id')
            ->join('mode_of_procurements', 'mode_of_procurements.id', '=', 'procurement_categories.mode_of_procurement_id')
            ->where('procurement_categories.submission_id', '=', $id)
            ->select('categories.id as c_id', 'mode_of_procurements.*')
            ->get();


        return view('bac.consolidation.viewItems')->with('items', $data)->with('categories', $categories)->with('modes', $modes)->with('submission_id', $id)->with('mode_category', $mode_category)->with('submission', $submission);
    }

    public function consolidationMode(Request $reqeust, $category_id, $submission_id){
        $this->validate($reqeust, [
            'mode_of_procurement_id' => 'required',
        ]);

        $p = ProcurementCategory::where('submission_id', $submission_id)->where('category_id', $category_id)->get();

        $plan_item = DB::table('categories')
                    ->join('items', 'items.category_id', '=', 'categories.id')
                    ->join('item_plan', 'item_plan.item_id', '=', 'items.id')
                    ->join('plans', 'plans.id', '=', 'item_plan.plan_id')
                    ->join('budgets', 'budgets.id', '=', 'plans.budget_id')
                    ->where('categories.id', '=', $category_id)
                    ->where('budgets.submission_id', '=', $submission_id)
                    ->select('*')
                    ->get();
                    
        if($plan_item->count() ==0){
            Session::flash('fail', 'No items found!');
            return redirect()->back();
        }        
        elseif($p->count() !== 0){
            Session::flash('fail', 'Mode of Procurement is already assigned');
            return redirect()->back(); 
        }else{
            ProcurementCategory::create([
                'mode_of_procurement_id' => request()->mode_of_procurement_id,
                'submission_id' => $submission_id,
                'category_id' => $category_id
            ]);
    
            Session::flash('success', 'Successfuly updated!');
    
            return redirect()->back();           
        }


    }

    public function consolidationModeUpdate(Request $reqeust, $category_id, $submission_id){
        $this->validate($reqeust,[
            'mode_of_procurement_id' => 'required'
        ]);

        $procurement = DB::table('procurement_categories')
                        ->where('submission_id', '=', $submission_id)
                        ->where('category_id', '=', $category_id)
                        ->first();
        if($procurement){
            DB::table('procurement_categories')
            ->where('submission_id', '=', $submission_id)
            ->where('category_id', '=', $category_id)
            ->update(['mode_of_procurement_id' => request()->mode_of_procurement_id]);

            Session::flash('success', 'Updated Successfully');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Nothing to update');
            return redirect()->back();
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
