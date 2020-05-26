@extends('user.layouts.app')

@section('xtraStyle')
<style>
    .header > h2, h6{
        line-height: 2px;

    }
    .header{
        text-align: center;
        margin-bottom: 4rem;
    }
    td {
        border-color: black !important;
        font-size: 1rem;
        height: 10px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
      
    }
    .table>tbody>tr>td{
        vertical-align: middle;
        border: 1px solid black !important;
    }
    @media print {
        .categories {
            background-color: green !important;

        }
    }
    hr{
        margin-top: 0;
        margin-bottom: 0;
        border-top: 1px solid black;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary</h1>
        <button class="btn btn primary" id="button">Print</button>
    </div>
    <!-- /.col-lg-12 -->
</div><h1></h1>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="" id="print">
                    <div class="header">
                        <div>
                                <h6 class="first">Republic of the Philippines</h6>
                        </div>
                        <div>
                                <h3>Pampanga State Agricultural</h3>
                        </div>
                        <div>
                                <h6><i>PAC, San Agustin, Magalang, Pampanga</i></h6>
                        </div>
                        <div>
                                <h2>PROJECT PROCUREMENT MANAGEMENT PLAN 2019</h2>
                        </div>
                    </div>
                    <table class="table table-bordered" id="table">
                        <tbody>
                            <tr>
                                <td colspan="4">DEPARTMENT: Fill Up Font Red</td>
                                <td colspan="4">Section</td>
                                <td colspan="4">Office or Project Title</td>
                            </tr>
                            <tr>
                                <td>Fund</td>
                                <td>101</td>
                                <td></td>
                                <td colspan="5" rowspan="2"></td>
                            <td colspan="4" rowspan="2">{{Auth::user()->department->name}}</td>
                            </tr>
                            <tr>
                                <td>Projects, Programs and Activities (PAPs)</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="2">Code</td>
                                <td rowspan="2">General Description</td>
                                <td rowspan="2">Units</td>
                                <td rowspan="2">Unit Price</td>
                                <td rowspan="2">Quantity/Size</td>
                                <td rowspan="2">Estimated Budget</td>
                                <td rowspan="2">Mode of Procurement</td>
                                <td colspan="4">Schedule Milestone of Activities</td>
                                <td rowspan="2">Note/Remarks if any changes</td>
                            </tr>
                            <tr>
                                <td >1st Quarter</td>
                                <td >2nd Quarter</td>
                                <td  >3rd Quarter</td>
                                <td>4th Quarter</td>
                            </tr>
                            <tr style="background-color:yellow;">
                                <td>50203010</td>
                                <td colspan="6">A-1. COMMON-USE OFFICE SUPPLIES</td>
                                <td colspan="5"></td>
                            </tr>

                            @if ($categories->count() ==0)
                            <tr> {{-- Category --}}
                                <td colspan="12" class="categories" style="text-align: center; background-color: green;"><i>No Item found</i></td>
                            </tr>   
                            @endif
                            
                            @foreach ($categories as $category)
                                @foreach ($plan->planItem as $item)
                                    @if ($item->category_id == $category->id) 
                                        <tr> {{-- Category --}}
                                            <td colspan="12" class="categories" style="text-align: center; background-color: green;"><i>{{$category->name}}</i></td>
                                        </tr>
                                        @break   
                                    @endif                    
                                @endforeach      

                                @foreach ($plan->planItem as $item)
                                    @if ($item->category_id == $category->id)
                                        <tr> {{-- Items --}}
                                            <td></td>
                                            <td>{{$item->general_description}}</td>
                                            <td>{{$item->unit}}</td>
                                            <td>₱{{number_format($item->price, 2)}}</td>
                                            <td> {{$item->pivot->quantity}}</td>
                                            <td>₱{{number_format($item->pivot->estimated_budget, 2)}}</td>
                                            <td></td>
                                            <td >{{$item->pivot->q1}}</td>
                                            <td>{{$item->pivot->q2}}</td>
                                            <td>{{$item->pivot->q3}}</td>
                                            <td>{{$item->pivot->q4}}</td>
                                            <td>{{$item->remarks}}</td>
                                        </tr>                                           
                                    @endif                               
                                @endforeach      

                            @endforeach
            
                            <tr >
                                <td style="border-color:white !important; border-bottom: black !important"></td>
                            </tr>
                            <tr >
                                    <td  colspan="2">Total Budget</td>
                                    <td colspan="3" style="text-align: right !important"> 
                                        ₱{{number_format($plan->planItem()->sum('estimated_budget'), 2)}}
                                    </td>
                            </tr>
                            <tr>
                                <td colspan="2">+ 10% Provision for Inflation</td>
                                <td colspan="3" style="text-align: right !important">₱{{number_format($plan->planItem()->sum('estimated_budget')* .10, 2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">+ 10% Contingency</td>
                                <td colspan="3" style="text-align: right !important">₱{{number_format($plan->planItem()->sum('estimated_budget')* .10, 2)}}</td>
                            </tr>
                            <tr>
                                    <td colspan="2"><strong>TOTAL ESTIMATED BUDGET:</strong></td>
                                    <td colspan="3" style="text-align: right !important">₱{{ number_format( (($plan->planItem()->sum('estimated_budget')* .10)*2)+ $plan->planItem()->sum('estimated_budget') ,  2)  }}</td>
                                </tr>
                            </table>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-4"> <strong> Prepared by:</strong></div>
                        <div class="col-sm-4"> <strong>Recommending Approval:</strong></div>
                        <div class="col-sm-4"> <strong>Approved by:</strong></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4"><strong>{{Auth::user()->name}}</strong><hr></div>
                        <div class="col-sm-4"><strong>{{$vp->name}}</strong><hr></div>
                        <div class="col-sm-4"> <strong>HONORIO M. SORIANO JR.</strong> <hr></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4">End User</div>
                        <div class="col-sm-4">VP for {{$vp->department->group->name}}</div>
                        <div class="col-sm-4">University President</div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

@endsection

@section('footer-scripts')
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        
        $('#button').on('click',function(){
            var printContents = document.getElementById('print').innerHTML;     
            var originalContents = document.body.innerHTML;       
            document.body.innerHTML = printContents;      
            window.print();      
            document.body.innerHTML = originalContents;
            window.location.reload(); 
        })
</script>
@endsection