@extends('op.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">For Approval</h1>
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
                                    <th>Plan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($approvals as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->plan->name}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                                {{-- <a href="" data-toggle="modal" data-target="#v{{$item->id}}" onclick="calc({{$item->id}})" class="btn btn-warning ">Plan Items</a> --}}
                                                <a href="{{route('op.plan.items', ['id' => $item->plan->id])}}" class="btn btn-warning ">Plan Items</a>                                     
                                        </div>
                                    </td>
                                </tr>
                                  {{-- Modal Edit --}}
                                  <div class="modal fade" id="disapprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                  aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Remarks</h4>
                                      </div>
                                      <form action="{{route('vp.disapproved', ['id' => $item->id])}}" method="POST">
                                              {{csrf_field()}}
                                          <div class="modal-body mx-3">
                                          <div class="md-form mb-5">
                                          <input type="text" id="defaultForm-name" class="form-control validate" name="remarks" required>
                                          </div>
                                  
                                          </div>
                                          <div class="modal-footer justify-content-center">
                                          <button type="submit" class="btn btn-danger" id="disapproved">Disapprove</button>
                                          </div>
                                      </form>
                                  </div>
                                  </div>
                              </div>
                              
                              <div class="text-center">
                              
                              </div>

                                {{-- Modal Edit --}}
                                <div id="v{{$item->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Items</h4>
                                            </div>
                                        <div class="modal-body" id="modal{{$item->id}}">
                                                    <div class="row">
                                                            <div class="col-sm-1 form-group">
                                                            <label for="">ID</label>
                                                            </div>
                                                            <div class="col-sm-3 form-group">
                                                                <label for="">General Description</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Unit</label>
                                                            </div>    
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Price</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Quantity</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Estimated Budget</label>
                                                            </div>                                                      
                                                    </div>
                                                    @foreach ($item->plan->planItem as $i)
                                                        <div class="row">
                                                            <div class="col-sm-1 form-group">
                                                            <input  class="form-control input-sm" readonly value="{{$i->id}}">
                                                            </div>
                                                            <div class="col-sm-3 form-group">
                                                                <input  class="form-control input-sm" readonly value="{{$i->general_description}}">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                                <input class="form-control input-sm"  readonly value="{{$i->unit}}">  
                                                            </div>            
                                                            <div class="col-sm-2 form-group">
                                                                <input  class="form-control input-sm"  readonly value="{{$i->price}}">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                                    <input  class="form-control input-sm"  readonly value="{{$i->pivot->quantity}}">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                            <input  class="form-control input-sm" type="number" name="amount{{$item->id}}" readonly value="{{$i->pivot->estimated_budget}}">
                                                            </div>
                                                        </div>                                                        
                                                    @endforeach
                                                    <hr>
                                                    <div class="text-right" style="padding-right: 6rem" >
                                                        <strong id="total{{$item->id}}"> Total: ₱</strong>                               
                                                        </div>
                                                    
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>
                                {{-- End Modal Edit --}}
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

@endsection

@section('footer-scripts')
<script>
  
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        function calc(id){
            $('#modal'+id).val();
            // console.log($("#modal"+id+":input[name*='amount']"));
            var $inputs = $("#modal"+id+" >input[name*='amount']");

            var total = 0;

            $.each($('input[name*="amount'+id+'"]'),function(){
            // alert($(this).val());
            total = parseInt($(this).val()) + parseInt(total);
            });
                 
            $("#total"+id).text("Total: ₱"+total+".00");
        }

        $('#approve').click(function(){
            $('#approve').remove();
        });



        
</script>
@endsection