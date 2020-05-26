@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">No Assigned Mode of Procurement Items</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{$category->name}}</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >General Description</th>
                                    <th >Unit</th>
                                    <th >Price</th>
                                    <th >Mode of Procurement</th>
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
                                            @if($item->mode_of_procurement_id)
                                            <td>{{$item->mode->name}}                                           
                                            @else
                                            <td>
                                            @endif
                                        </td> 
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="modal" data-target="#modaledit"   class="btn btn-secondary ">Edit</a>                                            
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endif
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Item</h4>
                                    </div>
                                    <form action="{{route('bac.item.update', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-procurement">Mode of Procurement</label>
                                                <select name="mode_of_procurement_id" id="" id="defaultForm-procurement"  class="form-control validate">
                                                    @foreach ($modes as $mode)
                                                        <option value="{{$mode->id}}" >{{$mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="text-center">
                              
                              </div>
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
            @endforeach
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