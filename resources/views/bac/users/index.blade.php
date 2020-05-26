@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Admin Users</h1>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add User</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $key=>$item)
                                <tr class="odd gradeX ">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td>{{$item->position->name}}</td>
                                    <td>{{$item->department->group->name}}</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#admin{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        @if ($item->user_lvl == 6)
                                        <a class="btn btn-danger" href="{{route('user.delete', ['id' => $item->id])}}" id="btn-delete">Delete</a>                                            
                                        @endif
                                    </td>
                                </tr>
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="admin{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Edit User</h4>
                                    </div>
                                    <form action="{{route('user.update.admin', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="{{$item->name}}">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
                                            <input type="text" id="defaultForm-email" class="form-control validate" name="email"  value="{{$item->email}}">
                                        </div>

                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
                                            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate" value="{{$item->contact_no}}">
                                        </div>

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
                                            <input type="password" id="defaultForm-password" class="form-control validate" name="password" >
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

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">End Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <hr>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-second">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($end_users as $key=>$item)
                                <tr class="odd gradeX ">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td>{{$item->department->group->name}}</td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        @if ($item->user_lvl == 6)
                                        <a class="btn btn-danger" href="{{route('user.delete', ['id' => $item->id])}}" id="btn-delete">Delete</a>                                            
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit User</h4>
                                    </div>
                                    <form action="{{route('user.update.user', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="{{$item->name}}">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
                                            <input type="text" id="defaultForm-email" class="form-control validate" name="email"  value="{{$item->email}}">
                                        </div>

                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
                                            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate" value="{{$item->contact_no}}">
                                        </div>

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
                                            <input type="password" id="defaultForm-password" class="form-control validate" name="password" >
                                        </div>
  
                                        <div class="md-form mb-4">
                                                <label data-error="wrong" data-success="right" for="defaultForm-department">Position</label>
                                                <select name="position" id="defaultForm-department" class="form-control validate">
                                                    <option value="" disabled selected>Position</option>
                                                    @foreach ($positions as $position)
                                                        <option value="{{$position->id}}" {{$position->id == $item->position_id ? 'selected' : ''}}>{{$position->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                               

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-department">Department</label>
                                            <select name="department" id="defaultForm-department" class="form-control validate">
                                                <option value="" disabled selected>Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{$department->id}}" {{$department->id == $item->department_id ? 'selected' : ''}}>{{$department->name}}</option>
                                                @endforeach
                                            </select>
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
            <h4 class="modal-title w-100 font-weight-bold">Add User</h4>
      </div>
    <form action="{{route('user.store')}}" method="POST" id="user_form">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
            <input type="text" name="email" id="defaultForm-email" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            @if ($positions->count() == 0)
                <br>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Position is required! Please Add</label>
                 <a href="{{route('positions')}}" target="blank">Click here to Add</a>               
            @else
                <label data-error="wrong" data-success="right" for="defaultForm-department">Position</label>
                <select name="position_id" id="defaultForm-department" class="form-control validate">
                    <option value="" disabled selected>Select Position</option>
                    @foreach ($positions as $position)
                        <option value="{{$position->id}}">{{$position->name}}</option>
                    @endforeach
                </select>   
            @endif
        </div>   

        <div class="md-form mb-4">
            @if ($departments->count() == 0)
                <br>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Department is required! Please Add</label>
                 <a href="{{route('departments')}}" target="blank">Click here to Add</a>               
            @else
                <label data-error="wrong" data-success="right" for="defaultForm-department">Department</label>
                <select name="department_id" id="defaultForm-department" class="form-control validate">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>   
            @endif
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

            $('#dataTables-second').DataTable({
                responsive: true
            });

            $('#user_form').submit(function(){
            $(this).find(':input[type=submit]').prop('disabled', true);
            });

        });
</script>
@endsection