@extends('bac.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <strong>Item:</strong>  {{$item->general_description}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >Departments</th>
                                    <th >Quantity</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($items as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->quantity}}</td>
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