<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Departments</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?php echo e($item); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Department</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                    <th>Department Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->id); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td class="text-center">
                                      <?php if($item->id ==1 || $item->id ==2 ||$item->id ==3 ||$item->id ==4 ||$item->id ==5 ||$item->id ==6 ||$item->id ==7 ||$item->id ==8): ?>
                                          <button class="btn btn-primary" disabled>Admin Department</button>
                                      <?php else: ?>                                         
                                        <a href="" data-toggle="modal" data-target="#<?php echo e($item->id); ?>" class="btn btn-primary ">Edit</a>
                                        <a class="btn btn-danger" href="<?php echo e(route('department.delete', ['id' => $item->id])); ?>">Delete</a>                                     
                                      <?php endif; ?>
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Department</h4>
                                    </div>
                                    <form action="<?php echo e(route('bac.department.update', ['id' => $item->id])); ?>" method="POST" id="department_update">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Department Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="<?php echo e($item->name); ?>">
                                        </div>
                                        
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-tag">Group</label>
                                            <select name="group_id" id="" class="form-control validate">
                                              <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($group->id); ?>" <?php echo e($group->id == $item->group_id ? 'selected' : ''); ?>><?php echo e($group->name); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>   
                                
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <input type="submit" class="btn btn-success" value="Update">
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


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            <h4 class="modal-title w-100 font-weight-bold">Add Department</h4>
      </div>
    <form action="<?php echo e(route('department.store.db')); ?>" method="POST" id="department_form">
        <?php echo e(csrf_field()); ?>

      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Department Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-tag">Group</label>
            <select name="group_id" id="" class="form-control validate">
              <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>   
          
      </div>
             
      <div class="modal-footer justify-content-center">
        <input type="submit" class="btn btn-success" value="Add">
      </div>
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

        $('#department_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        }); 
        
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('bac.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>