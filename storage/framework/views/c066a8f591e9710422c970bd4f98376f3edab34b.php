<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Plans</h1>
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
                                    <th >Name</th>
                                    <th >Disapproved Remarks</th>
                                    <th >Approved by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php echo e($errors); ?>

                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->plan->name); ?></td>
                                    <?php if($item->plan->remarks): ?>
                                    <td><?php echo e($item->plan->remarks); ?></td>
                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>  
                                <td>
                                    <?php if($item->plan->submitted == 1): ?>
                                        <?php $__currentLoopData = $item->plan->approval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($item->user->name); ?>(<?php echo e($item->user->updated_at); ?>) <br>  
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php else: ?>
                                        Not Approved yet
                                    
                                    <?php endif; ?>

                                </td>  
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($item->plan->state == 5 && $item->submission->active == 1): ?>
                                                <a href="<?php echo e(route('user.plan.items', ['id' => $item->id])); ?>"  class="btn btn-success ">Insert Items</a>                                               
                                            <?php endif; ?>
                                            
                                                <a href="<?php echo e(route('user.plan.summary', ['id' => $item->plan->id])); ?>" class="btn btn-warning ">Summary</a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
                                <div class="modal fade" id="<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Plan</h4>
                                    </div>
                                    <form action="<?php echo e(route('user.plan.update', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="code" value="<?php echo e($item->name); ?>">
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
                            
                            <div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                    <h4 class="modal-title w-100 font-weight-bold">Items </h4>
                                </div>

                                <div class="panel panel-default" style="padding:3rem;">
                                        <div class="panel-heading">
                                            <a href=""  class="btn btn-success ">Insert Items</a>
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
                                                    
                                                </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <div class="text-right " style="padding-right: 17rem">
                                                            
                                                    </div>
                                                </div>    
                                            
                                        </div>
                                    </form>
                                        <!-- /.panel-body -->
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
<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>