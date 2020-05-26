<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">For Approval</h1>
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
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $approvals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->plan->name); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                                
                                                <a href="<?php echo e(route('op.plan.items', ['id'=> $item->plan->id])); ?>"  class="btn btn-warning ">Plan Items</a>
                                                <a href="<?php echo e(route('op.approved', ['id' => $item->id])); ?>"  class="btn btn-primary " id="approve">Approve</a>
                                        </div>
                                    </td>
                                </tr>

                                
                                <div id="v<?php echo e($item->id); ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Items</h4>
                                            </div>
                                            <div class="modal-body" id="modal<?php echo e($item->id); ?>" >
                                                    <div class="row">
                                                            <div class="col-sm-1 form-group">
                                                            <label for="">ID</label>
                                                            </div>
                                                            <div class="col-sm-3 form-group">
                                                                <label for="">General Description</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Unit</label>
                                                            </div>    
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Price</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Quantity</label>
                                                            </div>  
                                                            <div class="col-sm-2 form-group">
                                                                <label for="">Estimated Budget</label>
                                                            </div>                                                      
                                                    </div>
                                                    <?php $__currentLoopData = $item->plan->planItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="row">
                                                            <div class="col-sm-1 form-group">
                                                            <input  class="form-control input-sm" readonly value="<?php echo e($i->id); ?>">
                                                            </div>
                                                            <div class="col-sm-3 form-group">
                                                                <input  class="form-control input-sm" readonly value="<?php echo e($i->general_description); ?>">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                                <input class="form-control input-sm"  readonly value="<?php echo e($i->unit); ?>">  
                                                            </div>            
                                                            <div class="col-sm-2 form-group">
                                                                <input  class="form-control input-sm"  readonly value="<?php echo e($i->price); ?>">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                                    <input  class="form-control input-sm"  readonly value="<?php echo e($i->pivot->quantity); ?>">
                                                            </div>
                                                            <div class="col-sm-2 form-group">
                                                                    <input  class="form-control input-sm" name="amount<?php echo e($item->id); ?>"  readonly value="<?php echo e($i->pivot->estimated_budget); ?>">
                                                            </div>
                                                        </div>                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <hr>
                                                    <div class="text-right" style="padding-right: 6rem" >
                                                        <strong id="total<?php echo e($item->id); ?>"> Total: ₱</strong>                               
                                                        </div>
                                                    
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
  
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        function calc(id){
            $('#modal'+id).val();
            // console.log($("#modal"+id+":input[name*='amount']"));
            var $inputs = $("#modal"+id+" >input[name*='amount']");

            var total = 0;

            $.each($('input[name*="amount'+id+'"]'),function(){

            total = parseInt($(this).val()) + parseInt(total);
            });
                 
            $("#total"+id).text("Total: ₱"+total+".00");

            
        }

        $('#approve').click(function(){
            $('#approve').remove();
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('op.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>