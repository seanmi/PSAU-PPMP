@extends('user.layouts.app')

@section('content')
        @foreach ($errors->all() as $item)
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{$item}}
        </div>
        @endforeach
<div class="row">
    <div class="col-lg-12"><br>
        <div class="col-lg-6">
                <h3 >Items of {{$plan->name}}</h3>
        </div>
        <div class="col-lg-6">        
            <h3 style="float:right;" >Remaining Budget: ₱<span id="budget" data-budget="{{$budget->remaining}}">{{number_format($budget->remaining,2)}}</span></h3>
        </div>  

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
                        <form  action="{{route('user.plan.items.store', ['id' => $plan->id])}}" id="form" method="POST">
                            {{csrf_field()}}
                            <div class="row hidden-md hidden-sm" id="item_fields" >
                                    <div class="col-lg-1 col-md-12">
                                            <label for="email">ID</label>    
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                            <label for="email">General Description</label>    
                                    </div>
                                    <div class="col-lg-1 col-md-12">
                                            <label for="email">Unit</label>    
                                    </div>
                                    <div class="col-lg-1 col-md-12">
                                            <label for="email">Price</label>    
                                    </div>  
                                    <div class="col-lg-1 col-md-12">
                                        <label for="email">Quantity</label>    
                                    </div>
                                    <div class="col-lg-1 col-md-12">
                                        <label for="email">Q1</label>    
                                    </div>  
                                    <div class="col-lg-1 col-md-12">
                                        <label for="email">Q2</label>    
                                    </div>    
                                    <div class="col-lg-1 col-md-12">
                                        <label for="email">Q3</label>    
                                    </div>  
                                    <div class="col-lg-1 col-md-12">
                                        <label for="email">Q4</label>    
                                    </div>  
                                    <div class=" col-lg-1 col-md-12 ">
                                            <label for="email">Action</label>    
                                    </div>                          
                            </div>
                            <div class="row" id="fields">
                                    {{-- <div class="col-sm-4 form-group">
                                        <input type="email" class="form-control input-sm" id="email" readonly>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <input type="email" class="form-control input-sm" id="email" readonly>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <input type="email" class="form-control input-sm" id="email" readonly>
                                    </div>            
                                    <div class="col-sm-2 form-group">
                                        <button class="btn btn-danger btn-sm" >Remove</button>
                                    </div>                           
                                </div> --}}
                            </div>
                        
                    </div>
                    <div class="panel-footer" style="text-align:right;"><button class="btn btn-primary" id="buttonSubmit">Submit</button></div>
                </form>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="panel">
            Select Category:
            <select name="" id="categories_item" class="form-control input-sm">
                @foreach ($categories as $item)
                    <option value="{{$item->id}}" id="default_selected" selected>{{$item->name}}</option>                   
                @endforeach
            </select>     
            Select Items:
            <select name="" id="list_item" class="form-control input-sm">
            </select>     
        </div>


{{-- Modal --}}
<div class="modal fade" id="modalitem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Item</h4>
      </div>
    <form action="#" >
      <div class="modal-body mx-3">

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-general">General Description</label>
          <input type="text" name="general_description" id="defaultForm-general" class="form-control validate">
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
        <button id="submit" type="button" class="btn btn-success">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="text-center">

</div>
{{-- Modal --}}

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Inserted Items</h3>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <hr>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form  action="{{route('budget.store', ['id' => 1])}}" id="form" method="POST">
                    {{csrf_field()}}
                    <div class="row hidden-sm hidden-md" id="item_fields" >
                            <div class="col-lg-1 col-md-12">
                                    <label for="email">ID</label>    
                            </div>
                            <div class="col-lg-2 col-md-12">
                                    <label for="email">General Description</label>    
                            </div>
                            <div class="col-lg-1 col-md-12">
                                    <label for="email">Unit</label>    
                            </div>
                            <div class="col-lg-1 col-md-12">
                                    <label for="email">Price</label>    
                            </div>
                            <div class="col-lg-1 col-md-12">
                                <label for="email">Quantity</label>    
                            </div>      
                            <div class="col-lg-1 col-md-12">
                                <label for="email">Q1</label>    
                            </div>              
                            <div class="col-lg-1 col-md-12">
                                <label for="email">Q2</label>    
                            </div>       
                            <div class="col-lg-1 col-md-12">
                                <label for="email">Q3</label>    
                            </div>    
                            <div class="col-lg-1 col-md-12">
                                <label for="email">Q4</label>    
                            </div>   
                            <div class="col-lg-2 col-md-12">
                                    <label for="email">Action</label>    
                            </div>          
                    </div>
                </form>
                    <div class="row" id="fields">
                        @if ($plan->planItem->count() ==0)
                        <div class="col-sm-12 form-group text-center">
                            <h5>No Data Available</h5>
                        </div>                            
                        @endif
                        @foreach ($plan->planItem as $item)

                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">ID</label>
                            <input  class="form-control input-sm" readonly value="{{$item->id}}">
                            </div>
                            <div class="col-lg-2 col-md-12 form-group">
                            <label class="hidden-lg" for="id">General Description</label>
                                <input  class="form-control input-sm" readonly value="{{$item->general_description}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Unit</label>
                                <input class="form-control input-sm"  readonly value="{{$item->unit}}">  
                            </div>            
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Price</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->price}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Quantity</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->pivot->quantity}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Q1</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->pivot->q1}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Q2</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->pivot->q2}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Q3</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->pivot->q3}}">
                            </div>
                            <div class="col-lg-1 col-md-12 form-group">
                            <label class="hidden-lg" for="id">Q4</label>
                                <input  class="form-control input-sm"  readonly value="{{$item->pivot->q4}}">
                            </div>
                            <div class="col-lg-2 col-md-12 form-group btn-group">
                                <a  data-toggle="modal" data-target="#{{$item->id}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('remove', [$plan->id, $item->id])}}" class="btn btn-danger btn-sm">Remove</a>
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
                                    <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
                                </div>
                            <form action="{{route('user.plan.items.edit', [$plan->id, $item->id])}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-title">Quantity</label>
                                    <input type="text" name="quantity" id="defaultForm-title" class="form-control validate" value="{{$item->pivot->quantity}}" >
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">Q1</label>
                                    <input type="text" name="q1" id="defaultForm-instruction" class="form-control validate" value="{{$item->pivot->q1}}" >
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">Q2</label>
                                    <input type="text" name="q2" id="defaultForm-instruction" class="form-control validate" value="{{$item->pivot->q2}}" >
                                </div>

                                <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="defaultForm-instruction">Q3</label>
                                        <input type="number" name="q3" id="defaultForm-instruction" class="form-control validate" value="{{$item->pivot->q3}}">
                                </div>  

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">Q4</label>
                                    <input type="number" name="q4" id="defaultForm-instruction" class="form-control validate" value="{{$item->pivot->q4}}">
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
                        @endforeach                          
                    </div>
                
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
    var quantity = "";

    $('[data-toggle="tooltip"]').tooltip(); 
        $(document).ready(function() {           
            $('#dataTables-example').DataTable({
                responsive: true
            });

            // $('#form').on('change','input[name="quantity[]"]', function(){
            //         $quantity = $(this).val();
            //         $budget = $('#budget').data('budget');                   
            //         $price = $(this).data('price');  
            //         if($quantity !== "" || $quantity !== NULL){
            //             $difference = $budget - ($price * $quantity);
            //             quantity = $quantity;
            //             $('#budget').text($difference.toFixed(2))
            //             console.log();
                        
            //             console.log('₱'+$difference.toFixed(2));
            //         }       
                    


                    
                    
            // });
        });


        $elm = $('#aw');
            let isLoaded = 0;

            if(isLoaded === 0){
                getItems();              
            }

            $('#categories_item').on('change', function(){
                console.log( $('#categories_item').find(":selected").val());
                $('#list_item').children().remove();
                getItems();      
            })

            console.log($('#categories_item').find(":selected").val());
            //function getItems
            function getItems(){
                $category_id = $('#categories_item').find(":selected").val();
                $user_id = {!!Auth::user()->id!!};
                $plan_id = {{$plan->id}};
                axios.get('/api/user/items/'+$user_id+'/'+$plan_id+'/'+$category_id)
                .then(function(response){

                    let counter = 0;
                    let list_container = "";
                    $items_list = $('#list_item');
                    list_container +=  '<option value="" disabled selected>Select Item</option>'
                    $.each(response.data, function(index, item){
                        
                        list_container +=  '<option value="'+item.id+'" data-unit="'+item.unit+'" data-price="'+item.price+'" >'+item.general_description+'</option>'
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
                var unit = $(this).find(':selected').data('unit');
                var price  = $(this).find(':selected').data('price');
                var gen  = $(this).children("option:selected").text();
                var id = $(this).children("option:selected").val();
                console.log(gen);
                
                var addedItem = ""; 
                addedItem += '<div class="row" id="item_fields">'; 
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">ID</label><input type="text" id="id" name="item_id[]" value="'+id+'"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>';
                addedItem += '<div class="col-lg-2 col-md-12 form-group"><label class="hidden-lg" for="id">General Description</label><input type="text" class="form-control input-sm gen" id="email" placeholder="'+gen+'" data-toggle="tooltip" title="'+gen+'" readonly></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Unit</label><input type="text" class="form-control input-sm unit" id="email" placeholder="'+unit+'" data-toggle="tooltip" title="'+unit+'" readonly></div>';
                addedItem += '<div class="col-lg-1 col-md-12  form-group"><label class="hidden-lg" for="id">Price</label><input type="number" class="form-control input-sm price" id="email" placeholder="'+"₱"+price+'" data-toggle="tooltip" title="'+"₱"+price+'"  readonly></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Quantity</label><input type="number" data-price="'+price+'" name="quantity[]" class="form-control input-sm price" id="email" placeholder="Quantity" min="1" required></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Q1</label><input type="number"  name="q1[]" class="form-control input-sm price" id="email" placeholder="Quarter 1" required></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Q2</label><input type="number"  name="q2[]" class="form-control input-sm price" id="email" placeholder="Quarter 2" required></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Q3</label><input type="number"  name="q3[]" class="form-control input-sm price" id="email" placeholder="Quarter 3" required></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><label class="hidden-lg" for="id">Q4</label><input type="number"  name="q4[]" class="form-control input-sm price" id="email" placeholder="Quarter 4" required></div>';
                addedItem += '<div class="col-lg-1 col-md-12 form-group"><button type="button" class="btn btn-danger btn-sm" data-price="'+price+'" data-id="'+id+'">Remove</button></div>';
                addedItem += '</div><hr class="hidden-lg">';
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

                $quantity = $(this).val();
                    // $budget = $('#budget').data('budget');                   
                    $budget = $('#budget').text();                   
                    $price = $(this).attr('data-price');                   
                    $difference = ($price * quantity) + parseInt($budget) ;
                    $budget = $('#budget').text($difference+".00");   
                    console.log("dif:"+ $difference);
                    
                    // $('#budget').text('₱'+$difference.toFixed(2))
            
            });

            $('#form').submit(function(){
                $('#buttonSubmit').prop('disabled', true);
            });

        


       
</script>
@endsection

