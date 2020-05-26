@extends('op.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
<br><br><br>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row ">
            <div class="col-lg-offset-3 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      <h4><strong>User Account</strong></h4>  
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                            <form class="form-horizontal" action="{{route('op.update.profile', ['id' => $user->id])}}" method="POST">
                              {{csrf_field()}}
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="name">Name</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="email">Username:</label>
                                  <div class="col-sm-10"> 
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="contact">Contact Number:</label>
                                  <div class="col-sm-10"> 
                                    <input type="number" class="form-control" name="contact_no" id="contact_no"value="{{$user->contact_no}}">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="password">Password:</label>
                                    <div class="col-sm-10"> 
                                      <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                  </div>
                                <div class="form-group"> 
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                  </div>
                                </div>
                              </form>
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

            $('#dataTables-second').DataTable({
                responsive: true
            });

        });
</script>
@endsection