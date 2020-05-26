@extends('user.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Plans</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <hr>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th >Disapproved Remarks</th>
                                    <th >Approved by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($plans as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->plan->name}}</td>
                                    @if($item->plan->remarks)
                                    <td>{{$item->plan->remarks}}</td>
                                    @else
                                    <td></td>
                                    @endif  
                                <td>
                                    @if($item->plan->submitted == 1)
                                        @foreach ($item->plan->approval as $item)
                                        {{$item->user->name}}({{$item->user->updated_at}}) <br>  
                                      @endforeach
                                    
                                    @else
                                        Not Approved yet
                                    
                                    @endif

                                </td>  
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @if ($item->plan->state == 5 && $item->submission->active == 1)
                                                <a href="{{route('user.plan.items', ['id' => $item->plan->id])}}"  class="btn btn-success ">Insert Items</a>                                               
                                            @endif
                                            {{-- <a href="{{route('show.items', ['id' => $item->id])}}" class="btn btn-secondary ">View Items</a> --}}
                                                <a href="{{route('user.plan.summary', ['id' => $item->plan->id])}}" class="btn btn-warning ">Summary</a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Plan</h4>
                                    </div>
                                    <form action="{{route('user.plan.update', ['id' => $item->id])}}" method="POST" id="item_form">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="code" value="{{$item->name}}">
                                        </div>
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <input type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="text-center">
                              
                              </div>
                            {{-- Modal --}}
                            <div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                    <h4 class="modal-title w-100 font-weight-bold">Items </h4>
                                </div>

                                <div class="panel panel-default" style="padding:3rem;">
                                        <div class="panel-heading">
                                            <a href=""  class="btn btn-success ">Insert Items</a>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <form  action="" id="form" method="POST">
                                                {{csrf_field()}}
                                                <div class="row" id="item_fields" >
                                                        <div class="col-sm-3">
                                                                <label for="email">General Description</label>    
                                                        </div>
                                                        <div class="col-sm-2">
                                                                <label for="email">Unit</label>    
                                                        </div>
                                                        <div class="col-sm-3">
                                                                <label for="email">Price</label>    
                                                        </div>  
                                                        <div class="col-sm-2">
                                                            <label for="email">Quantity</label>    
                                                        </div>  
                                                        <div class="col-sm-2">
                                                                <label for="email">Action</label>    
                                                        </div>                          
                                                </div>
                                                <div class="row" id="fields">
                                                    {{-- @foreach ($item->planItems as $res)
                                                        <div class="col-sm-3 form-group"><input type="text" name="item_id[]" value="{{$res->general_description}}"  class="form-control input-sm gen" id="email"  readonly></div>
                                                        <div class="col-sm-2 form-group"><input type="text" value=""  class="form-control input-sm unit" id="email"  readonly></div>
                                                        <div class="col-sm-3 form-group"><input type="number" value=""   class="form-control input-sm price" id="email"  readonly></div>
                                                        <div class="col-sm-2 form-group"><input type="number" value=""  class="form-control input-sm price" id="email" readonly></div>
                                                        <div class="col-sm-2 form-group"><a href="{{route('remove',['plan_id'=>$item->id,'item_id'=>$res->pivot->item_id])}}" type="button" class="btn btn-danger btn-sm" >Remove</a></div>
                                                    @endforeach --}}
                                                </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <div class="text-right " style="padding-right: 17rem">
                                                            {{-- @foreach($item->planItems as $order)
                                                            <strong > Total:{{  $order->pivot->sum('estimated_budget')  }}</strong>
                                                            @break
                                                            @endforeach --}}
                                                    </div>
                                                </div>    
                                            
                                        </div>
                                    </form>
                                        <!-- /.panel-body -->
                                    </div>
                            </div>
                            </div>
                            </div>

                            <div class="text-center">

                            </div>
                            {{-- Modal --}}
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

{{-- Modal --}}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Plan</h4>
      </div>
    <form action="{{route('user.plan.store')}}" method="POST">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
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
{{-- Modal --}}

@endsection

@section('footer-scripts')
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
</script>
@endsection