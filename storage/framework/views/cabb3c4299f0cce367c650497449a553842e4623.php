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
                    <div class="panel-heading">
                      <strong>Category</strong>: <?php echo e($category->name); ?>

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
                                    <td><?php echo e($item->mode_of_procurement_id); ?></td>
                                    <td class="text-center">
                                    <a href="<?php echo e(route('consolidation.item', [$item->id, $item->plan_year])); ?>"  class="btn btn-primary ">Details</a>
                                    </td>
                                <tr>                           
                                <?php endif; ?>
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('shared.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>