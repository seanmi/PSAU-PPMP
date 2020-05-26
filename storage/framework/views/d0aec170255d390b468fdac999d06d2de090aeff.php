<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">No Assigned Mode of Procurement Items</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3><?php echo e($category->name); ?></h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >General Description</th>
                                    <th >Unit</th>
                                    <th >Price</th>
                                    <th >Mode of Procurement</th>
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
                                            <?php if($item->mode_of_procurement_id): ?>
                                            <td><?php echo e($item->mode->name); ?>                                           
                                            <?php else: ?>
                                            <td>
                                            <?php endif; ?>
                                        </td> 
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" data-toggle="modal" data-target="#modaledit"   class="btn btn-secondary ">Edit</a>                                            
                                            </div>
                                        </td>
                                        
                                    </tr>
                                <?php endif; ?>
                                
                                <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Item</h4>
                                    </div>
                                    <form action="<?php echo e(route('bac.item.update', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-procurement">Mode of Procurement</label>
                                                <select name="mode_of_procurement_id" id="" id="defaultForm-procurement"  class="form-control validate">
                                                    <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($mode->id); ?>" ><?php echo e($mode->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Plan</h4>
      </div>
    <form action="<?php echo e(route('user.plan.store')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
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
<?php echo $__env->make('bac.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>