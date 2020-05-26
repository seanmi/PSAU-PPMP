@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Groups</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Position</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{$errors }}
                            @foreach ($positions as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                      @if ($item->id ==1 || $item->id ==2 || $item->id ==3 || $item->id ==4||$item->id ==5 || $item->id ==6 || $item->id ==7 || $item->id ==8 )
                                        <button class="btn btn-primary" disabled>Admin Position</button>                         
                                      @else
                                      <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                      <a class="btn btn-danger" href="{{route('position.delete', ['id' => $item->id])}}">Delete</a>  
                                      @endif
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Position</h4>
                                    </div>
                                    <form action="{{route('position.update', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Position</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="{{$item->name}}">
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
            <h4 class="modal-title w-100 font-weight-bold">Add Position</h4>
      </div>
    <form action="{{route('position.store')}}" method="POST">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Position</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
        </div>

      </div>       
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success">Add</button>
      </div>
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