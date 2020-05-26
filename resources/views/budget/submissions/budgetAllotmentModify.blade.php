@extends('budget.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Allot colleges/offices budget for PPMP  2018</h1>

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
                        <hr>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form  action="{{route('budget.store.modify', ['id' => $submission_id])}}" id="form" method="POST" class="form_budget">
                            {{csrf_field()}}
                            <div class="row" id="item_fields" >
                                    <div class="col-sm-1">
                                            <label for="email">ID</label>    
                                    </div>
                                    <div class="col-sm-3">
                                            <label for="email">User</label>    
                                    </div>
                                    <div class="col-sm-4">
                                            <label for="email">Department</label>    
                                    </div>
                                    <div class="col-sm-2">
                                            <label for="email">Budget Amount</label>    
                                    </div>  
                                    <div class="col-sm-2">
                                            <label for="email">Action</label>    
                                    </div>                          
                            </div>
                            <div class="row" id="fields"> 
                                @if ($users->count() ==0)
                                    <div class="col-sm-12 text-center">No user found</div>
                                @endif
                                @foreach ($users as $user)
                                    <div class="col-sm-1 form-group"><input type="text" name="user_id[]" value="{{$user->id}}"  class="form-control input-sm gen" readonly></div>
                                    <div class="col-sm-3 form-group"><input type="text" class="form-control input-sm gen" id="email" placeholder="{{$user->username}}" readonly></div>
                                    <div class="col-sm-4 form-group"><input type="text" class="form-control input-sm unit" id="email" placeholder="{{$user->deptname}}" readonly></div>
                                    <div class="col-sm-2 form-group"><input type="number" name="amount[]" class="form-control input-sm price" required></div>
                                    <div class="col-sm-2 form-group"><button type="button" class="btn btn-danger btn-sm" data-id="'+id+'">Remove</button></div>
                                @endforeach
                            </div>
                        
                    </div>
                    @if ($users->count() !==0)
                    <div class="panel-footer" style="text-align:right;"><input type="submit" id="submitButton" class="btn btn-primary" value="Submit"></div>
                    @endif 
                </form>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        {{-- <div class="panel">
            Select Users:
            <select name="" id="list_item" class="form-control">
                <option value="" id="default_selected" disabled selected>Select Users</option>
            </select>     
        </div> <br> --}}

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Inserted Budgets</h1>      
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <hr>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form  action="{{route('budget.store', ['id' => $submission_id])}}" id="form" method="POST">
                    {{csrf_field()}}
                    <div class="row" id="item_fields" >
                            <div class="col-sm-1">
                                    <label for="email">ID</label>    
                            </div>
                            <div class="col-sm-3">
                                    <label for="email">User</label>    
                            </div>
                            <div class="col-sm-3">
                                    <label for="email">Department</label>    
                            </div>
                            <div class="col-sm-3">
                                    <label for="email">Budget Amount</label>    
                            </div>               
                            <div class="col-sm-2">
                                    <label for="email">Action</label>    
                            </div>          
                    </div>
                </form>
                @foreach ($budgets as $item)
                    <div class="row" id="fields">
                        
                            <div class="col-sm-1 form-group">
                                <input type="email" class="form-control input-sm" readonly value="{{$item->id}}">
                            </div>
                            <div class="col-sm-2 form-group">
                                <input type="email" class="form-control input-sm" readonly value="{{$item->user->name}}">
                            </div>
                            <div class="col-sm-4 form-group">
                                <input type="email" class="form-control input-sm"  readonly value="{{$item->user->department->name}}">  
                            </div>            
                            <div class="col-sm-3 form-group">
                                <input type="email" class="form-control input-sm"  readonly value="₱{{number_format($item->amount,2)}}">
                            </div>
                            <div class="col-sm-2 form-group btn-group">
                                <a href="#" data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary btn-sm" >Edit</a>
                            </div> 
                            {{-- Modal --}}
                            <div class="modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                    <h4 class="modal-title w-100 font-weight-bold">Edit Budget</h4>
                                </div>
                            <form action="{{route('budget.update', ['id' => $item->id])}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-title">ID</label>
                                    <input type="text" name="title" id="defaultForm-title" class="form-control validate" value="{{$item->id}}" readonly>
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">User</label>
                                    <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate" value="{{$item->user->name}}" readonly>
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">Department</label>
                                    <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate" value="{{$item->user->department->name}}" readonly>
                                </div>

                                <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="defaultForm-instruction">Amount</label>
                                        <input type="number" name="amount" id="defaultForm-instruction" class="form-control validate" value="{{$item->amount}}">
                                </div>  

                                </div>
                                <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-primary" id="submission">Update</button>
                                </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            {{-- Modal --}}                              
                                          
                    </div>
                    @endforeach   
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
        });


        $elm = $('#aw');
            let isLoaded = 0;

            if(isLoaded === 0){
                getItems();                        
            }

            //function getItems
            function getItems(){
                $user_id = {!!Auth::user()->id!!};
                $submission_id = {{$submission_id}};
                axios.get('/api/users/'+$submission_id)
                
                .then(function(response){
                    console.log(response);
                    let counter = 0;
                    let list_container = "";
                    $items_list = $('#list_item');
                   
                    $.each(response.data, function(index, item){
                        list_container +=  '<option value="'+item.id+'" data-username="'+item.username+'" data-deptname="'+item.deptname+'" >'+item.username+'('+item.deptname+')'+'</option>'
                        ++counter;
                        
                        
                    });
                    $items_list.append(list_container);
                    
                });
                isLoaded = 1; 
                return "ok";
            }

            //function addItem

            function addItem(general_description, unit, price){
                axios.post('/api/item', {
                    'general_description': general_description,
                    'unit': unit,
                    'price': price
                })
                .then(function(response){
                    
                    $list_items = $('#list_item');
                    let item_container = $('#list_item');
                    $.each(response.data, function(index, item){
                        item_container  +=  '<option value="'+item.id+'" data-unit="'+item.unit+'" data-price="'+item.price+'" >'+item.general_description+'</option>'                      
                    }); 

                    $list_items.append(item_container);

                });
            }

            // addItem('wwww', 'pc', '12333');

             //form submitted
            $('#submit').click(function(){
                $(this).prop('disabled', true);
                var general_description = $('#defaultForm-general').val();
                var unit = $('#defaultForm-unit').val();
                var price = $('#defaultForm-price').val();
                
                addItem(general_description, unit, price);
                $(this).prop('disabled', false);
                $('#defaultForm-general').val('');
                $('#defaultForm-unit').val('');
                $('#defaultForm-price').val('');
                $('#modalitem').modal('hide');
            });

            //form fields

            $('#list_item').change(function(){ 
                console.log($(this).find(':selected').data('unit'));
                var username = $(this).find(':selected').data('username');
                var deptname  = $(this).find(':selected').data('deptname');
                var gen  = $(this).children("option:selected").text();
                var id = $(this).children("option:selected").val();
                console.log(gen);
                
                var addedItem = "";
                addedItem += '<div class="row" id="item_fields">';
                addedItem += '<div class="col-sm-1 form-group"><input type="text" name="user_id[]" value="'+id+'"  class="form-control input-sm gen" readonly></div>';
                addedItem += '<div class="col-sm-3 form-group"><input type="text" class="form-control input-sm gen" id="email" placeholder="'+username+'" readonly></div>';
                addedItem += '<div class="col-sm-4 form-group"><input type="text" class="form-control input-sm unit" id="email" placeholder="'+deptname+'" readonly></div>';
                addedItem += '<div class="col-sm-2 form-group"><input type="number" name="amount[]" class="form-control input-sm price" required></div>';
                addedItem += '<div class="col-sm-2 form-group"><button type="button" class="btn btn-danger btn-sm" data-id="'+id+'">Remove</button></div>';
                addedItem += '</div>';
                $('#form').append(addedItem);   

               //console.log($(this).find(':selected').data('unit'));  
                $(this).find(':selected').hide();
            });

            $("#form").on('click', 'button', function() {
               console.log( $(this).attr("data-id")); 
               $(this).attr("data-id")      
                $(this).parent('div').siblings().remove();
                $(this).parent('div').  remove();
               
                
                $('#list_item option[value="'+$(this).attr("data-id")+'"]').show();
                
                
        });

        $('.form_budget').submit(function(){
            console.log('sean');
          $('#submitButton').prop('disabled', true);
        });
</script>
@endsection

