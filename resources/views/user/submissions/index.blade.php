@extends('user.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Active Submission</h1>
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
                                    <th>Title</th>
                                    <th>Instruction</th>
                                    <th>Deadline</th>
                                    <th>Active</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($submissions as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->instruction}}</td>
                                    <td>{{$item->deadline_submission}}</td>
                                    <td>
                                        @if ($item->active === 0 )
                                            No  
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td>{{$item->year}}</td>
                                    <td class="text-center btn-group">
                                        @if ($plans)
                                        <a href="{{route('user.plan.items', ['id' => $plans->id])}}" class="btn btn-warning ">View Plan</a>
                                        <a href="" data-toggle="modal" data-target="#v{{$item->id}}" class="btn btn-primary ">Submit</a>                                            
                                        @endif 

                                    </td>
                                </tr>
                                {{-- Modal Submit Plan --}}
                                <div class="modal fade" id="v{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header text-center">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                  <h4 class="modal-title w-100 font-weight-bold">Plans</h4>
                                            </div>
                                            <form action="{{route('user.plan.submit', ['id'=> $item->id])}}" method="POST" id="form_submit">
                                                {{csrf_field()}}
                                                <div class="modal-body mx-3">
                                                    <div class="md-form mb-5">
                                                        <select name="plan_id" id="" class="form-control validate">
                                                            @if ($plans)
                                                                @if ($plans->count() == 0)
                                                                    <option value="" disabled selected>No Plan Available</option>
                                                                @endif
                                                                <option value="{{$plans->id}}">{{$plans->name}}</option>                                                                 
                                                            @endif                                                       
                                                        </select>
                                                    </div>                   
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="text-center">
                                      
                                     </div>
                                {{-- Ending Modal Submit Plan --}}
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
            <h4 class="modal-title w-100 font-weight-bold">Create Submission</h4>
      </div>
    <form action="{{route('submission.store')}}" method="POST">
        {{csrf_field()}}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-title">Title</label>
          <input type="text" name="title" id="defaultForm-title" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-instruction">Instruction</label>
            <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-deadline_submission">Deadline</label>
            <input type="date" name="deadline_submission" id="defaultForm-deadline_submission" class="form-control validate">
        </div>

        <div class="md-form mb-4">

                <label data-error="wrong" data-success="right" for="defaultForm-active">Active</label>
                <select name="active" id="defaultForm-active" class="form-control validate">
                        <option value="0" selected>No</option>
                        <option value="1" selected>Yes</option>
                </select>   
        </div>    

      </div>
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success" id="submission">Add</button>
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
                responsive: true,
                'paging': false,
                'searching':false,
                'bInfo': false
            });
        });
        form_submit
        submitButton
        $('#form_submit').submit(function(){
          $('#submitButton').prop('disabled', true);
        });
</script>
@endsection