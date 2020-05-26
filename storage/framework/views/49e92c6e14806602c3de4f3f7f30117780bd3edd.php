<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo e($plan_name->name); ?></h1>

    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="<?php echo e(route('user.plan.items', ['id' => $plan_name->id])); ?>"  class="btn btn-success ">Insert Items</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form  action="" id="form" method="POST">
                            <?php echo e(csrf_field()); ?>

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
                                <?php $__currentLoopData = $items->planItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-3 form-group"><input type="text" name="item_id[]" value="<?php echo e($item->general_description); ?>"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>
                                    <div class="col-sm-2 form-group"><input type="text" value="<?php echo e($item->unit); ?>"  class="form-control input-sm unit" id="email"  readonly></div>
                                    <div class="col-sm-3 form-group"><input type="number" value="<?php echo e($item->price); ?>"   class="form-control input-sm price" id="email"  readonly></div>
                                    <div class="col-sm-2 form-group"><input type="number" value="<?php echo e($item->pivot->quantity); ?>"  class="form-control input-sm price" id="email" readonly></div>
                                    <div class="col-sm-2 form-group"><a href="<?php echo e(route('remove', ['id' =>$plan_name->id, 'item_id' => $item->item_id ])); ?>" type="button" class="btn btn-danger btn-sm" >Remove</a></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>