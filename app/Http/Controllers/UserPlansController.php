<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plan;

use Session;

use App\Submission;

use Auth;

use App\Item;

use App\Category;

use Carbon\Carbon;

use Response;
use App\Budget;
use Nexmo;
use App\User;
use DB;

class UserPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $budget = Budget::where('user_id', Auth::user()->id)->get();
        
        return view('user.plans.index')->with('plans', $budget);
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
            'name' => 'required'
        ]);

        $date = new Carbon(Carbon::now()); 

        $plans = Plan::where('user_id', '=', Auth::id())
                ->where('plan_year', '=', $date->year)
                ->get();
        if($plans->count() !== 0){
            Session::flash('fail', 'Note: You have already created PPMP Plan for Year '.$date->year);
            return redirect()->back();
        }

        Plan:: create([
            'name' => request()->name,
            'user_id' => Auth::id(),
            'plan_year' => $date->year,
        ]);

        Session::flash('success', 'Plan Added');

        return redirect()->back();
    }

    public function planItemsStore (Request $request, $id){
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required',
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
        ]);
   

        $arrItems  =   request()->item_id;
        if(count($arrItems) != count(array_unique($arrItems))){
            Session::flash('fail', 'Duplicate item(s) found');
            return redirect()->back();
        }
     
        $arr_user = [Auth::user()->id];
        $plan = Plan::find($id);
        $counter = 0;
        $counter1 = 0;
        foreach (request()->item_id as $key => $value) {
            $item = request()->item_id[$key];
            $quantity = request()->quantity[$key];
            $q1 = request()->q1[$key];
            $q2 = request()->q2[$key];
            $q3 = request()->q3[$key];
            $q4 = request()->q4[$key];
            $sum  = $q1 + $q2 + $q3 + $q4;
            if($sum === (int)$quantity){
                $plan->planItem()->attach($item, ['quantity' => $quantity, 'plan_id' => $id, 'q1' => $q1, 'q2' => $q2, 'q3' => $q3, 'q4' => $q4,  ]);
                $counter1 += 1;
            }else{       
                $counter += 1;
            }

        }
        $temp = NULL;
        
        foreach ($plan->planItem as $key => $value) {
            $item = Item::where('id', $value->id)->first();
            $value->pivot->estimated_budget = ($item->price) * ($value->pivot->quantity);
            $temp += ($value->price) * ($value->pivot->quantity);
            $value->pivot->save();
        }

        // $budget = Budget::where('submission_id', $plan->submission_id)
        //                 ->where('user_id', Auth::user()->id)->first();
        $budget = $plan->budget;
      
        $budget->remaining = $budget->amount - $temp;
        $budget->save();

        if($counter1 ==0 && $counter !==0){
            Session::flash('fail', $counter.' item(s) was not added');
        }elseif($counter !==0  && $counter1 !==0){
            Session::flash('success', 'Added Successfully and'.$counter.'(s) were not added');
        }
        else{
            Session::flash('success', 'Added Successfully');
        }

        

        // return redirect()->route('user.plans');    
        return redirect()->back();    
    }

    public function planItemsEdit (Request $request, $id, $item_id){
        $this->validate($request, [
            'quantity' => 'required',
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
        ]);

        $plan = Plan::find($id);

        $budget = $plan->budget;

        $item = $plan->planItem()->where('item_id', $item_id)->first();

        $current_quanity = $item->pivot->quantity;

        $price = $item->price;

        if($current_quanity < request()->quantity){
            $budget->remaining = $budget->remaining - ((request()->quantity - $current_quanity) * $price);
        }elseif($current_quanity > request()->quantity){
            $budget->remaining = $budget->remaining + (($current_quanity - request()->quantity) * $price);
        }else{

        }

        $total_quantity = request()->q1 + request()->q2 + request()->q3 + request()->q4;

        if($total_quantity !== (int)request()->quantity){
            Session::flash('fail', 'The sum of quarter must be equal to the quantity!');
            return redirect()->back();
        }

        $item->pivot->quantity = request()->quantity;
        $item->pivot->q1 = request()->q1;
        $item->pivot->q2 = request()->q2;
        $item->pivot->q3 = request()->q3;
        $item->pivot->q4 = request()->q4;
        $item->pivot->estimated_budget = request()->quantity * $price;
        $item->pivot->save();
        $budget->save();

        Session::flash('success', 'Successfully Updated!');
        return redirect()->back();
        
    }

    public function plan_itemsGet($id){
    //    $plan = Plan::select('*')
    //         ->join('item_plan', 'plans.id', '=', 'item_plan.plan_id')
    //         ->join('items', 'items.id', '=', 'item_plan.item_id')
    //         ->where('plans.user_id', '=', Auth::user()->id)
    //         ->where('plans.id', '=', $id)
    //         ->get();
        $plan = Plan::find($id);
       $plan_name = Plan::find($id);

        return view('user.plans.viewItems')->with('items',$plan)->with('plan_name', $plan_name);
    }

    public function planSummary($id){

        $plan = Plan::find($id);

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


        return view('user.plans.summary')->with('plan', $plan)->with('categories', $user_item_categories)->with('vp', $user_vp);
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

    public function items($id){

        $plan = Plan::find($id);

        $categories = Category::orderBy('name', 'asc')->get();

        $submission = $plan->budget->submission->where('active', 1)->first();

        $budget = $plan->budget->where('submission_id', $submission->id)->where('user_id', Auth::user()->id)->first();

        // dd($submission);

        // $submission = DB::table('submissions')
        //                 ->join('plans', 'plans.submission_id', '=', 'submissions.id')
        //                 ->where('plans.id', '=', $id)
        //                 ->where('plans.user_id', '=', Auth::user()->id)
        //                 ->select('submissions.*')
        //                 ->first();
     
        // $budget = Budget::where('submission_id', $submission->id)
        //                 ->where('user_id', Auth::user()->id)
        //                 ->first();
        // $plan = Plan::where('submission_id', $submission->id)->where('user_id', Auth::user()->id)->first();

        // $plan_items = DB::table('item_plan')
        //                 ->join('items', 'items.id', '=', 'item_plan.item_id')
        //                 ->where('item_plan.plan_id', '=', $id)
        //                 ->where('item_plan.user_id', '=', Auth::user()->id)
        //                 ->select('*')
        //                 ->get();
            
        
        return view('user.plans.items')->with('plan_id', $id)->with('submission', $submission)->with('budget', $budget)->with('plan', $plan)->with('categories', $categories);
    }

    public function getItems($user_id, $plan_id, $category_id){
        $category = Category::find($category_id);
        $p = Plan::find($plan_id);
        $plan = Plan::select('items.id')
        ->join('item_plan', 'plans.id', '=', 'item_plan.plan_id')
        ->join('items', 'items.id', '=', 'item_plan.item_id')
        ->join('categories', 'categories.id', '=', 'items.category_id')
        ->where('plans.budget_id', '=', $p->budget->id)
        ->where('plans.id', '=', $plan_id)
        ->get();
        $item_array = [];

        if($plan->count() !==0){
            foreach ($plan as $key => $value) {
                array_push($item_array, $value->id);
            }
          
            $items = Item::whereNotIn('id', $item_array)->where('category_id', $category_id)
            ->orderBy('general_description', 'asc')->get();
        }else{
            $items = Item::where('category_id', $category_id)->get();
        }

        return Response::json($items);
    }

    public function storeItem(Request $request){
        $this->validate($request,[
            'general_description' => 'required|unique:items',
            'unit' => 'required',
            'price' => 'required',
        ]);

        $created_item = Item::create([
            'general_description' => request()->general_description,
            'unit' => request()->unit,
            'price' =>request()->price,
            'category_id' =>1,
        ]);

        $response = [
            'items' => $created_item,
        ];

        return Response::json($response);
    }

    public function removeItem($plan_id, $item_id){
        $item_plan = DB::table('item_plan')
        ->where('plan_id', '=', $plan_id)
        ->where('item_id', '=', $item_id)
        ->select('item_plan.estimated_budget')
        ->first();

        $plan = Plan::find($plan_id);
        $budget = Budget::where('submission_id', $plan->budget->submission->id)->where('user_id', Auth::user()->id)->first();
        $budget->remaining = $budget->remaining + $item_plan->estimated_budget;
        $budget->save();

        DB::table('item_plan')
        ->where('plan_id', '=', $plan_id)
        ->where('item_id', '=', $item_id)
        ->delete();

        Session::flash('success', 'Removed Successfully!');
        return redirect()->back();
    }

    public function submitPlan(Request $request,$id){
        $this->validate($request, [
            'plan_id' => 'required',
        ]);

        $user = User::find(8);

        $plan_id = request()->plan_id;

        $current_user = Auth::user()->id;
        $plan= Plan::find($plan_id);

        $submission = Submission::where('active', 1)->where('id', $id)->get();

        if ($submission->count() !==1) {
            Session::flash('fail', 'No active Submission found');
        }


        if($plan->planItem->count() === 0){
            Session::flash('fail', 'Plan does not contain any item');
            return redirect()->back();
        }

        if($current_user === $plan->budget->user_id){
            // Nexmo::message()->send([
            //     'to' => $user->contact_no,
            //     'from' => '639359005736',
            //     'text' =>'For Approval Plan.'.$plan->name
            // ]);
            
            $plan->state = 4;
            $plan->remarks = "";
            $plan->save();
            Session::flash('success', 'Plan submitted!');
            return redirect()->route('user.plan.submission');
        }else{
            Session::flash('fail', 'Unauthorized Submission');
            return redirect()->back();
        }
    }



    
}




