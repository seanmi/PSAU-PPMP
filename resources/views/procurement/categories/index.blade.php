@extends('shared.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categories</h1>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Category</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{$errors }}
                            @foreach ($items as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        <a class="btn btn-danger" href="{{route('category.delete', ['id' => $item->id])}}">Delete</a>
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Cateogry</h4>
                                    </div>
                                    <form action="{{route('category.update', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Category Name</label>
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
            <h4 class="modal-title w-100 font-weight-bold">Add Category</h4>
      </div>
    <form action="{{route('category.store')}}" method="POST" id="category_form">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Category Name</label>
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

        $('#category_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        });
</script>
@endsection