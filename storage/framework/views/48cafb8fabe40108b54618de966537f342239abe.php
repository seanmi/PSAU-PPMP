<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Consolidation</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading " style="padding-bottom:2rem">
                      <strong>Category</strong>: <?php echo e($category->name); ?>

                      <div class="btn-group  pull-right ">
                            <button class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#<?php echo e($category->id); ?>">Assign mode of procurement</button>
                            <button class="btn btn-success  btn-sm"  data-toggle="modal" data-target="#s<?php echo e($category->id); ?>">Update</button>
                      </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="300">General Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Total Quantity</th>
                                    <th>Total Estimated Budget</th>
                                    <th>Mode of Procurement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <?php if($item->category_id == $category->id): ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->general_description); ?></td>
                                    <td><?php echo e($item->unit); ?></td>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->total_quantity); ?></td>
                                    <td>₱<?php echo e(number_format($item->total_estimated_budget,2)); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $mode_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($s->c_id == $category->id): ?>
                                                <?php echo e($s->name); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="text-center">
                                    <a href="<?php echo e(route('bac.consolidation.item', [$item->id, $item->sub_id])); ?>"  class="btn btn-warning ">Details</a>
                                    </td>
                                <tr>                           
                                <?php endif; ?>
                                
                                <div class="modal fade" id="<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                        <h4 class="modal-title w-100 font-weight-bold">Assign Mode of Procurement</h4>
                                    </div>
                                <form action="<?php echo e(route('bac.consolidation.mode', [$category->id, $submission_id ])); ?>" method="POST" id="form">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-body mx-3">

                                    <div class="md-form mb-4">
                                        <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                        <select class="form-control validate" name="mode_of_procurement_id" id="">
                                            <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($mode->id); ?>"><?php echo e($mode->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>   
                                    
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-success" id="btn">Add</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                                </div>

                                <div class="text-center">

                                </div>
                                
                            
                            <div class="modal fade" id="s<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                        <h4 class="modal-title w-100 font-weight-bold">Assign Mode of Procurement</h4>
                                    </div>

                                <form action="<?php echo e(route('bac.consolidation.mode.update', [$category->id, $submission_id ])); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-body mx-3">

                                    <div class="md-form mb-4">
                                        <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                        <select class="form-control validate" name="mode_of_procurement_id" id="">
                                            <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($mode->id); ?>"><?php echo e($mode->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr class="">
                <p class="h4"> Total Estimated Budget: ₱<?php echo e(number_format($items->sum('total_estimated_budget'),2)); ?></p>   
        </tr>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "bPaginate": false,
                'searching': false,
                'info': false
            });
        });

        $('#form').submit(function(){
            console.log('Sean');
            
            $('#btn').remove();
        })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('bac.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>