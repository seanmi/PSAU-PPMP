@extends('budget.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Submission</h1>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Set Deadline Submission</a>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{$errors }}
                                {{$submissions}}
                            @foreach ($submissions as $item)
                            <h1>{{$item->submissionUsers}}Sean</h1>
                            @endforeach --}}
                            @foreach ($submissions as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->instruction}}</td>
                                    <td>{{$item->deadline_submission}}</td>
                                    <td>
                                        @if ($item->active === 0 )
                                            <a href="{{route('submission.activate', ['id' => $item->id])}}" class="btn btn-info">Activate</a>
                                        @elseif($item->active == NULL)
                                        <button class="btn btn-danger" disabled>Deactivated</button>
                                        @else
                                        <button class="btn btn-info" disabled>Activated</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                                <a href="" data-toggle="modal" data-target="#v{{$item->id}}" class="btn btn-warning ">Details</a>                                             
                                                @if ($item->active == 0)
                                                    <a href="{{route('submission.budget', ['id' => $item->id])}}"  class="btn btn-success ">Budget</a> 
                                                @elseif($item->active == 2)
                                                    <button class="btn btn-success " disabled>Budget</button>  
                                                @else
                                                    <button class="btn btn-success " disabled>Budget</button>  
                                                @endif 
                                                @if ($item->active == 1)
                                                    <a href="{{route('submission.budget.modify', ['id' => $item->id])}}"  class="btn btn-info">Modify Budget</a>                                                         
                        
                                                @else
                                                <button class="btn btn-info" disabled>Modify Budget</button>    
                                                @endif
                                                @if ($item->active !== 2)
                                                <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>                                                    
                                                @endif                   
                                                {{-- <button class="btn btn-danger">Delete</button> --}}
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal Details --}}
                                <div class="modal fade" id="v{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header text-center">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                  <h4 class="modal-title w-100 font-weight-bold">Details</h4>
                                            </div>
                                                <div class="modal-body mx-3">
                                                @foreach ($item->budget as $sub)
                                                    @if ($sub->plan)
                                                        <div class="md-form mb-5">
                                                            <label data-error="wrong" data-success="right" for="defaultForm-title">{{$sub->plan->name }}</label>
                                                            <input type="text" id="defaultForm-title" class="form-control validate" name="title" value="{{$sub->plan->submitted == 0 ? "Not Yet submitted" : "Submitted"}}" readonly>
                                                        </div>
                                                    @endif
                                                @endforeach                                                      

                                                 
                                                    </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="text-center">
                                      
                                     </div>
                                {{-- Ending Modal Details --}}
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Submission</h4>
                                    </div>
                                    <form action="{{route('submission.update', ['id' => $item->id])}}" method="POST">
                                            {{csrf_field()}}
                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-title">Title</label>
                                        <input type="text" id="defaultForm-title" class="form-control validate" name="title" value="{{$item->title}}">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-instruction">Instruction</label>
                                            <input type="text" id="defaultForm-instruction" class="form-control validate" name="instruction"  value="{{$item->instruction}}">
                                        </div>

                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-deadline">Deadline</label>
                                            <input type="date" name="deadline_submission" id="defaultForm-deadline" class="form-control validate" value="{{$item->deadline_submission}}">
                                        </div>
                                
                                        {{-- <div class="md-form mb-4 " style="margin-top:1rem;">
                                        <a href="{{route('deactivate.submission', ['$item->id'])}}" class="btn btn-danger">Deactivate Submission</a>
                                        </div>      --}}
                                
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
            <h4 class="modal-title w-100 font-weight-bold">Create Submission</h4>
      </div>
    <form action="{{route('submission.store')}}" method="POST" id="submission_form">
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
                "searching": false,
                "paging": false
            });
        });

        $('#submission_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        });

</script>
@endsection