@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Departments</h1>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Department</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                    <th>Department Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($departments as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                      @if ($item->id ==1 || $item->id ==2 ||$item->id ==3 ||$item->id ==4 ||$item->id ==5 ||$item->id ==6 ||$item->id ==7 ||$item->id ==8)
                                          <button class="btn btn-primary" disabled>Admin Department</button>
                                      @else                                         
                                        <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        <a class="btn btn-danger" href="{{route('department.delete', ['id' => $item->id])}}">Delete</a>                                     
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Department</h4>
                                    </div>
                                    <form action="{{route('bac.department.update', ['id' => $item->id])}}" method="POST" id="department_update">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Department Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="{{$item->name}}">
                                        </div>
                                        
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-tag">Group</label>
                                            <select name="group_id" id="" class="form-control validate">
                                              @foreach ($groups as $group)
                                                <option value="{{$group->id}}" {{$group->id == $item->group_id ? 'selected' : ''}}>{{$group->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>   
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <input type="submit" class="btn btn-success" value="Update">
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
            <h4 class="modal-title w-100 font-weight-bold">Add Department</h4>
      </div>
    <form action="{{route('department.store.db')}}" method="POST" id="department_form">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Department Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-tag">Group</label>
            <select name="group_id" id="" class="form-control validate">
              @foreach ($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
              @endforeach
            </select>
        </div>   
          
      </div>
             
      <div class="modal-footer justify-content-center">
        <input type="submit" class="btn btn-success" value="Add">
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

        $('#department_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        }); 
        
</script>
@endsection