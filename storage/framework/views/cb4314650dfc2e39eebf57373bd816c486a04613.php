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
                    <div class="panel-heading ">
                        <div class="btn-group">
                        <a href="<?php echo e(route('budget.approved', ['id' => $plan_name->id])); ?>" class="btn btn-primary ">Approve</a>
                        <a href="" data-toggle="modal" data-target="#disapprove" class="btn btn-danger ">Disapprove</a>
                    </div>
                    <div  class="pull-right " >
                    <h4>Approve Budget: ₱<?php echo e(number_format($budget->amount, 2)); ?></h4>
                    </div>
                
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
                                        <label for="email">Estimated Budget</label>    
                                    </div>                           
                            </div>
                            <div class="row" id="fields">
                                <?php $__currentLoopData = $items->planItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-3 form-group"><input type="text" name="item_id[]" value="<?php echo e($item->general_description); ?>"  class="form-control input-sm gen" id="email" placeholder="'+gen+'" readonly></div>
                                    <div class="col-sm-2 form-group"><input type="text" value="<?php echo e($item->unit); ?>"  class="form-control input-sm unit" id="email"  readonly></div>
                                    <div class="col-sm-3 form-group"><input type="number" value="<?php echo e($item->price); ?>"   class="form-control input-sm price" id="email"  readonly></div>
                                    <div class="col-sm-2 form-group"><input type="number" value="<?php echo e($item->pivot->quantity); ?>"   class="form-control input-sm price" id="email"  readonly></div>
                                    <div class="col-sm-2 form-group"><input type="number" value="<?php echo e($item->pivot->estimated_budget); ?>"   class="form-control input-sm price estimated" id="email"  readonly></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            </div>
                        <div class="panel-footer">
                            <div class="text-right" style="padding-right: 6rem">
                            <strong id="total"></strong>                               
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
                                
                                <div class="modal fade" id="disapprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Remark</h4>
                                    </div>
                                    <form action="<?php echo e(route('budget.disapproved', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="remarks" >
                                        </div>
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="text-center">
                              
                              </div>
                            
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
            calculateSum();
            function calculateSum(){
                var sum = 0;
                $('.estimated').each(function() {
                    sum += Number($(this).val());
                    
                    
                });
                $('#total').text("Total: ₱ "+sum.toFixed(2));
            }

        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('budget.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>