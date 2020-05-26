@extends('user.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$plan_name->name}}</h1>

    </div>
    <!-- /.col-lg-12 -->
</div><h1></h1>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{route('user.plan.items', ['id' => $plan_name->id])}}"  class="btn btn-success ">Insert Items</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form  action="" id="form" method="POST">
                            {{csrf_field()}}
                            <div class="row" id="item_fields" >
                                    <div class="col-sm-3">
                                            <label for="email">General Description</label>    
                                    </div>
                                    <div class="col-sm-2">
                                            <label for="email">Unit</label>    
                                    </div>
                                    <div class="col-sm-3">
                                            <label for="email">Price</label>    
                                    </div>  
                                    <div class="col-sm-2">
                                        <label for="email">Quantity</label>    
                                    </div>  
                                    <div class="col-sm-2">
                                            <label for="email">Action</label>    
                                    </div>                          
                            </div>
                            <div class="row" id="fields">
                                @foreach ($items->planItems as $item)
                            <div class="col-sm-3 form-group"><input type="text" name="item_id[]" value="{{$item->general_description}}"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>
                                    <div class="col-sm-2 form-group"><input type="text" value="{{$item->unit}}"  class="form-control input-sm unit" id="email"  readonly></div>
                                    <div class="col-sm-3 form-group"><input type="number" value="{{$item->price}}"   class="form-control input-sm price" id="email"  readonly></div>
                                    <div class="col-sm-2 form-group"><input type="number" value="{{$item->pivot->quantity}}"  class="form-control input-sm price" id="email" readonly></div>
                                    <div class="col-sm-2 form-group"><a href="{{route('remove', ['id' =>$plan_name->id, 'item_id' => $item->item_id ])}}" type="button" class="btn btn-danger btn-sm" >Remove</a></div>
                                @endforeach
                            </div>
                            </div>
                        
                    </div>
                </form>
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
        });
</script>
@endsection