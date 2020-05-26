@extends('budget.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Items of {{$plans->name}}</h1>

    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalitem" class="btn btn-success ">Add Item</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form  action="{{route('user.plan.items.store', ['id' => $plan_id])}}" id="form" method="POST">
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
                    <div class="panel-footer" style="text-align:right;"><button class="btn btn-primary" >Submit</button></div>
                </form>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="panel">
            Select Items:
            <select name="" id="list_item" class="form-control">
                <option value="" id="default_selected" disabled selected>Select item</option>
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
                $plan_id = {{$plan_id}};
                axios.get('/api/user/items/'+$user_id+'/'+$plan_id)
                .then(function(response){

                    let counter = 0;
                    let list_container = "";
                    $items_list = $('#list_item');
                   
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
                addedItem += '<div class="col-sm-3 form-group"><input type="text" name="item_id[]" value="'+id+'"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>';
                addedItem += '<div class="col-sm-2 form-group"><input type="text" class="form-control input-sm unit" id="email" placeholder="'+unit+'" readonly></div>';
                addedItem += '<div class="col-sm-3 form-group"><input type="number" class="form-control input-sm price" id="email" placeholder="'+price+'" readonly></div>';
                addedItem += '<div class="col-sm-2 form-group"><input type="number" name="quantity[]" class="form-control input-sm price" id="email" required></div>';
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
</script>
@endsection

