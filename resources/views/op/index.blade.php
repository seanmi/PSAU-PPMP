@extends('user.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Items</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Item</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="130">General Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Procurement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{$errors }}
                            @foreach ($items as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->general_description}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->mode_of_procurement}}</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        <button class="btn btn-danger">Delete</button>
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
                                    </div>
                                    <form action="{{route('item.update', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-code">Code</label>
                                        <input type="text" id="defaultForm-code" class="form-control validate" name="code" value="{{$item->code}}">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-desc">General Description</label>
                                            <input type="text" id="defaultForm-desc" class="form-control validate" name="general_description"  value="{{$item->general_description}}">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                            <input type="text" id="defaultForm-unit" class="form-control validate" name="unit" value="{{$item->unit}}">
                                        </div>   
                                        
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-price" >Price</label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">₱</span>
                                                <input type="text" id="defaultForm-price" class="form-control" name="price"  value="{{$item->price}}">
                                                <span class="input-group-addon">.00</span> 
                                            </div>
                                        </div>
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="text-center">
                              
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

{{-- Modal --}}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Item</h4>
      </div>
    <form action="{{route('item.store')}}" method="POST">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-code">Code</label>
          <input type="text" name="code" id="defaultForm-code" class="form-control validate">
        </div>

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-desc">General Description</label>
          <input type="text" name="general_description" id="defaultForm-desc" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
            <input type="text" name="unit" id="defaultForm-unit" class="form-control validate">
        </div>   
        
        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-price">Price</label>
            <div class="form-group input-group">
                <span class="input-group-addon">₱</span>
                <input type="number" name="price" min="1" id="defaultForm-price" class="form-control" >
                <span class="input-group-addon">.00</span> 
            </div>
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