@extends('shared.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Consolidation</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        @foreach($categories as $category)
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>Category</strong>: {{$category->name}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="300">General Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Total Quantity</th>
                                    <th>Total Estimated Budget</th>
                                    <th>Mode of Procurement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            @foreach ($items as $item)
                                @if($item->category_id == $category->id)
                                <tr class="odd gradeX ">
                                    <td>{{$item->general_description}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->total_quantity}}</td>
                                    <td>₱{{number_format($item->total_estimated_budget,2)}}</td>
                                    <td>{{$item->mode_of_procurement_id}}</td>
                                    <td class="text-center">
                                    <a href="{{route('consolidation.item', [$item->id, $item->plan_year])}}"  class="btn btn-primary ">Details</a>
                                    </td>
                                <tr>                           
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        @endforeach
        <tr class="">
                <p class="h4"> Total Estimated Budget: ₱{{  number_format($items->sum('total_estimated_budget'),2)  }}</p>   
        </tr>

@endsection

@section('footer-scripts')
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "bPaginate": false,
                'searching': false,
                'info': false
            });
        });
</script>
@endsection