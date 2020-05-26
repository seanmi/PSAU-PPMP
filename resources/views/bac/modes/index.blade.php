@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">No Assigned Mode of Procurement Items</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
        @foreach ($errors->all() as $item)
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{$item}}
        </div>
        @endforeach
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Mode</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              {{$errors }}
                            @foreach ($modes as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#{{$item->id}}"   class="btn btn-primary ">Edit</a>                                            
                                            <a href="{{route('bac.modes.delete', ['id'=> $item->id])}}" class="btn btn-danger ">Delete</a>                                            
                                        </div>
                                    </td>    
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
                                            <form action="{{route('bac.modes.update', ['id' => $item->id])}}" method="POST">
                                                    {{csrf_field()}}
                                                <div class="modal-body mx-3">                                     
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-desc">Name</label>
                                                    <input type="text" id="defaultForm-desc" class="form-control validate" name="name"  value="{{$item->name}}">
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
                                </tr>
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
            <h4 class="modal-title w-100 font-weight-bold">Add Mode of Procurement</h4>
      </div>
    <form action="{{route('bac.modes.store')}}" method="POST" id="mode_form">
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

        $('#mode_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        });
</script>
@endsection