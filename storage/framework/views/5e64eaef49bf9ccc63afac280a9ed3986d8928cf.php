<?php $__env->startSection('content'); ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e($item); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="row">
    <div class="col-lg-12"><br>
        <div class="col-lg-6">
                <h3 >Items of <?php echo e($plan->name); ?></h3>
        </div>
        <div class="col-lg-6">        
            <h3 style="float:right;" >Remaining Budget: ₱<span id="budget" data-budget="<?php echo e($budget->remaining); ?>"><?php echo e(number_format($budget->remaining,2)); ?></span></h3>
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
                        <form  action="<?php echo e(route('user.plan.items.store', ['id' => $plan->id])); ?>" id="form" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row" id="item_fields" >
                                    <div class="col-sm-1">
                                            <label for="email">ID</label>    
                                    </div>
                                    <div class="col-sm-2">
                                            <label for="email">General Description</label>    
                                    </div>
                                    <div class="col-sm-1">
                                            <label for="email">Unit</label>    
                                    </div>
                                    <div class="col-sm-1">
                                            <label for="email">Price</label>    
                                    </div>  
                                    <div class="col-sm-1">
                                        <label for="email">Quantity</label>    
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="email">Q1</label>    
                                    </div>  
                                    <div class="col-sm-1">
                                        <label for="email">Q2</label>    
                                    </div>    
                                    <div class="col-sm-1">
                                        <label for="email">Q3</label>    
                                    </div>  
                                    <div class="col-sm-1">
                                        <label for="email">Q4</label>    
                                    </div>  
                                    <div class="col-sm-1">
                                            <label for="email">Action</label>    
                                    </div>                          
                            </div>
                            <div class="row" id="fields">
                                    
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
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>" id="default_selected" selected><?php echo e($item->name); ?></option>                   
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>     
            Select Items:
            <select name="" id="list_item" class="form-control input-sm">
            </select>     
        </div>



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
                <form  action="<?php echo e(route('budget.store', ['id' => 1])); ?>" id="form" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="row" id="item_fields" >
                            <div class="col-sm-1">
                                    <label for="email">ID</label>    
                            </div>
                            <div class="col-sm-2">
                                    <label for="email">General Description</label>    
                            </div>
                            <div class="col-sm-1">
                                    <label for="email">Unit</label>    
                            </div>
                            <div class="col-sm-1">
                                    <label for="email">Price</label>    
                            </div>
                            <div class="col-sm-1">
                                <label for="email">Quantity</label>    
                            </div>      
                            <div class="col-sm-1">
                                <label for="email">Q1</label>    
                            </div>              
                            <div class="col-sm-1">
                                <label for="email">Q2</label>    
                            </div>       
                            <div class="col-sm-1">
                                <label for="email">Q3</label>    
                            </div>    
                            <div class="col-sm-1">
                                <label for="email">Q4</label>    
                            </div>   
                            <div class="col-sm-2">
                                    <label for="email">Action</label>    
                            </div>          
                    </div>
                </form>
                    <div class="row" id="fields">
                        <?php if($plan->planItem->count() ==0): ?>
                        <div class="col-sm-12 form-group text-center">
                            <h5>No Data Available</h5>
                        </div>                            
                        <?php endif; ?>
                        <?php $__currentLoopData = $plan->planItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="col-sm-1 form-group">
                            <input  class="form-control input-sm" readonly value="<?php echo e($item->id); ?>">
                            </div>
                            <div class="col-sm-2 form-group">
                                <input  class="form-control input-sm" readonly value="<?php echo e($item->general_description); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input class="form-control input-sm"  readonly value="<?php echo e($item->unit); ?>">  
                            </div>            
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->price); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->pivot->quantity); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->pivot->q1); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->pivot->q2); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->pivot->q3); ?>">
                            </div>
                            <div class="col-sm-1 form-group">
                                <input  class="form-control input-sm"  readonly value="<?php echo e($item->pivot->q4); ?>">
                            </div>
                            <div class="col-sm-2 form-group btn-group">
                                <a href="<?php echo e(route('remove', [$plan->id, $item->id])); ?>" class="btn btn-danger btn-sm">Remove</a>
                            </div> 
                            
                            <div class="modal fade" id="<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                    <h4 class="modal-title w-100 font-weight-bold">Edit Budget</h4>
                                </div>
                            <form action="<?php echo e(route('budget.update', ['id' => $item->id])); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-title">ID</label>
                                    <input type="text" name="title" id="defaultForm-title" class="form-control validate" value="<?php echo e($item->id); ?>" readonly>
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">User</label>
                                    <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate" value="" readonly>
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="defaultForm-instruction">Department</label>
                                    <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate" value="" readonly>
                                </div>

                                <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="defaultForm-instruction">Amount</label>
                                        <input type="number" name="amount" id="defaultForm-instruction" class="form-control validate" value="">
                                </div>  

                                </div>
                                <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-primary" id="submission">Update</button>
                                </div>
                            </form>
                            </div>
                            </div>
                            </div>
                                                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                          
                    </div>
                
            </div>


            <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
                <!-- /.col-lg-12 -->
            </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
    var quantity = "";

    
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
                $user_id = <?php echo Auth::user()->id; ?>;
                $plan_id = <?php echo e($plan->id); ?>;
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
                addedItem += '<div class="col-sm-1 form-group"><input type="text" name="item_id[]" value="'+id+'"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>';
                addedItem += '<div class="col-sm-2 form-group"><input type="text" class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="text" class="form-control input-sm unit" id="email" placeholder="'+unit+'" readonly></div>';
                addedItem += '<div class="col-sm-1  form-group"><input type="number" class="form-control input-sm price" id="email" placeholder="'+price+'" readonly></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="number" data-price="'+price+'" name="quantity[]" class="form-control input-sm price" id="email" required></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="number"  name="q1[]" class="form-control input-sm price" id="email" required></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="number"  name="q2[]" class="form-control input-sm price" id="email" required></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="number"  name="q3[]" class="form-control input-sm price" id="email" required></div>';
                addedItem += '<div class="col-sm-1 form-group"><input type="number"  name="q4[]" class="form-control input-sm price" id="email" required></div>';
                addedItem += '<div class="col-sm-2 form-group"><button type="button" class="btn btn-danger btn-sm" data-price="'+price+'" data-id="'+id+'">Remove</button></div>';
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>