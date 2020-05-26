<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Active Submission</h1>
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
                                    <th>Title</th>
                                    <th>Instruction</th>
                                    <th>Deadline</th>
                                    <th>Active</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->instruction); ?></td>
                                    <td><?php echo e($item->deadline_submission); ?></td>
                                    <td>
                                        <?php if($item->active === 0 ): ?>
                                            No
                                        <?php else: ?>
                                            Yes
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->year); ?></td>
                                    <td class="text-center btn-group">
                                        <a href="" data-toggle="modal" data-target="#s<?php echo e($item->id); ?>"  class="btn btn-warning ">Submission</a>
                                        <a href="<?php echo e(route('bac.consolidation', ['id' => $item->id])); ?>"  class="btn btn-primary ">Items</a>
                                        <a href="<?php echo e(route('bac.consolidation.summary', ['id' => $item->id])); ?>" class="btn btn-success ">Consolidation</a>
                                    </td>
                                </tr>
                                
                                <div class="modal fade" id="s<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header text-center">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    <h4 class="modal-title w-100 font-weight-bold">Details</h4>
                                            </div>
                                                <div class="modal-body mx-3">
                                                <?php $__currentLoopData = $item->budget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($sub->plan): ?>
                                                        <div class="md-form mb-5">
                                                            <label data-error="wrong" data-success="right" for="defaultForm-title"><?php echo e($sub->plan->name); ?></label>
                                                            <input type="text" id="defaultForm-title" class="form-control validate" name="title" value="<?php echo e($sub->plan->submitted == 0 ? "Not Yet submitted" : "Submitted"); ?>" readonly>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                      

                                                    
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="text-center">
                                        
                                        </div>
                                
                                
                                <div class="modal fade" id="v<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header text-center">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                  <h4 class="modal-title w-100 font-weight-bold">Plans</h4>
                                            </div>
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


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Create Submission</h4>
      </div>
    <form action="<?php echo e(route('submission.store')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-title">Title</label>
          <input type="text" name="title" id="defaultForm-title" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-instruction">Instruction</label>
            <input type="text" name="instruction" id="defaultForm-instruction" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-deadline_submission">Deadline</label>
            <input type="date" name="deadline_submission" id="defaultForm-deadline_submission" class="form-control validate">
        </div>

        <div class="md-form mb-4">

                <label data-error="wrong" data-success="right" for="defaultForm-active">Active</label>
                <select name="active" id="defaultForm-active" class="form-control validate">
                        <option value="0" selected>No</option>
                        <option value="1" selected>Yes</option>
                </select>   
        </div>    

      </div>
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success" id="submission">Add</button>
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