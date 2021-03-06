<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">No Assigned Mode of Procurement Items</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Mode</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php echo e($errors); ?>

                            <?php $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->name); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#<?php echo e($item->id); ?>"   class="btn btn-primary ">Edit</a>                                            
                                            <a href="<?php echo e(route('bac.modes.delete', ['id'=> $item->id])); ?>" class="btn btn-danger ">Delete</a>                                            
                                        </div>
                                    </td>    
                                                                   
                                <div class="modal fade" id="<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header text-center">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                  <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
                                            </div>
                                            <form action="<?php echo e(route('bac.modes.update', ['id' => $item->id])); ?>" method="POST">
                                                    <?php echo e(csrf_field()); ?>

                                                <div class="modal-body mx-3">                                     
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-desc">Name</label>
                                                    <input type="text" id="defaultForm-desc" class="form-control validate" name="name"  value="<?php echo e($item->name); ?>">
                                                </div>
                                                                     
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="text-center">
                                      
                                      </div>
                                            
                                </tr>
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


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Mode of Procurement</h4>
      </div>
    <form action="<?php echo e(route('bac.modes.store')); ?>" method="POST">
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