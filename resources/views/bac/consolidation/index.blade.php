@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Consolidation</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        @foreach($categories as $category)
            @foreach ($items as $item)
            @if($item->category_id == $category->id)
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading " style="padding-bottom:2rem">
                            <strong>Category</strong>: {{$category->name}}
                            <div class="btn-group  pull-right ">
                                    <button class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#{{$category->id}}">Assign mode of procurement</button>
                                    <button class="btn btn-success  btn-sm"  data-toggle="modal" data-target="#s{{$category->id}}">Update</button>
                            </div>
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
                                            <td>
                                                @foreach ($mode_category as $s)
                                                    @if ($s->c_id == $category->id)
                                                        {{$s->name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                            <a href="{{route('bac.consolidation.item', [$item->id, $item->sub_id])}}"  class="btn btn-warning ">Details</a>
                                            </td>
                                        <tr>                           
                                        @endif
                                        {{-- Modal --}}
                                        <div class="modal fade" id="{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                <h4 class="modal-title w-100 font-weight-bold">Assign Mode of Procurement</h4>
                                            </div>
                                        <form action="{{route('bac.consolidation.mode', [$category->id, $submission_id ])}}" method="POST" id="form">
                                            {{csrf_field()}}
                                            <div class="modal-body mx-3">

                                            <div class="md-form mb-4">
                                                <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                                <select class="form-control validate" name="mode_of_procurement_id" id="">
                                                    @foreach ($modes as $mode)
                                                        <option value="{{$mode->id}}">{{$mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>   
                                            
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn btn-success" id="btn">Add</button>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                        </div>

                                        <div class="text-center">

                                        </div>
                                        {{-- Modal --}}
                                    {{-- Modal update mode --}}
                                    <div class="modal fade" id="s{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                <h4 class="modal-title w-100 font-weight-bold">Assign Mode of Procurement</h4>
                                            </div>

                                        <form action="{{route('bac.consolidation.mode.update', [$category->id, $submission_id ])}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="modal-body mx-3">

                                            <div class="md-form mb-4">
                                                <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                                <select class="form-control validate" name="mode_of_procurement_id" id="">
                                                    @foreach ($modes as $mode)
                                                        <option value="{{$mode->id}}">{{$mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>   
                                            
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                        </div>

                                        <div class="text-center">

                                        </div>
                                        {{-- Modal update mode --}}
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
            @break
            @endif
            @endforeach
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

        $('#form').submit(function(){
            console.log('Sean');
            
            $('#btn').remove();
        })
</script>
@endsection