@extends('shared.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Categorized Items</h3>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Item</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>General Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($categorized as $item)
                                <tr class="odd gradeX ">
                                    <td>{{$item->general_description}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->category->name}}</td>                                   
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                        <a class="btn btn-danger" href="{{route('item.delete', ['id' => $item->id])}}">Delete</a>
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
                                        <h1></h1>
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-category" >Category</label>
                                            <select name="category_id" id="defaultForm-category" class="form-control">
                                                @foreach ($categories as $category)     
                                                cateogryid{{$category->id}}  / item category{{$item->category_id}}   
                                                    <option value="{{$category->id}}" {{$category->id == $item->category_id ? "selected" : ""}}>{{$category->name}}</option>
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
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header p-1 m-1">Uncategorized Items</h3>
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
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-second">
                                    <thead>
                                        <tr>
                                            <th>General Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Procurement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                    @foreach ($uncategorized as $item)
                                        <tr class="odd gradeX ">
                                            <td>{{$item->general_description}}</td>
                                            <td>{{$item->unit}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->category->name}}</td>
                                            @if ($item->mode_of_procurement_id)
                                             <td>{{$item->mode->name}}</td>
                                            @else
                                            <td></td>                                               
                                             @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary ">Edit</a>
                                                <a class="btn btn-danger" href="{{route('item.delete', ['id' => $item->id])}}">Delete</a>
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
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-category" >Category</label>
                                                    <select name="category_id" id="defaultForm-category" class="form-control">
                                                        @foreach ($categories as $category)           
                                                            <option value="{{$category->id}}" {{$category->id == $item->category_id ? "selected" : ""}}>{{$category->name}}</option>
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
            <h4 class="modal-title w-100 font-weight-bold">Add Item</h4>
      </div>
    <form action="{{route('item.store')}}" method="POST" id="item_form">
        {{csrf_field()}}
      <div class="modal-body mx-3">

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
                <input type="number" step="any" name="price" min="1" id="defaultForm-price" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-price">Category</label>
            <select name="category_id" id="" class="form-control">
                    @if ($categories->count() === 0)
                        <option value="">No Categories to show</option> 
                    @else
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}
                        @endforeach
                    @endif
            </select>
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
        });

        $('#item_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        });
</script>
@endsection