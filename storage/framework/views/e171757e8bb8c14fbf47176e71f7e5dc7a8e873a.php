<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Admin Users</h1>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add User</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->department->name); ?></td>
                                    <td><?php echo e($item->position->name); ?></td>
                                    <td><?php echo e($item->department->group->name); ?></td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#admin<?php echo e($item->id); ?>" class="btn btn-primary ">Edit</a>
                                        <?php if($item->user_lvl == 6): ?>
                                        <a class="btn btn-danger" href="<?php echo e(route('user.delete', ['id' => $item->id])); ?>" id="btn-delete">Delete</a>                                            
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <div class="modal fade" id="admin<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header text-center">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                          <h4 class="modal-title w-100 font-weight-bold">Edit User</h4>
                                    </div>
                                    <form action="<?php echo e(route('user.update.admin', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="<?php echo e($item->name); ?>">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
                                            <input type="text" id="defaultForm-email" class="form-control validate" name="email"  value="<?php echo e($item->email); ?>">
                                        </div>

                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
                                            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate" value="<?php echo e($item->contact_no); ?>">
                                        </div>

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
                                            <input type="password" id="defaultForm-password" class="form-control validate" name="password" >
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

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">End Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <hr>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-second">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $end_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->department->name); ?></td>
                                    <td><?php echo e($item->department->group->name); ?></td>
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#<?php echo e($item->id); ?>" class="btn btn-primary ">Edit</a>
                                        <?php if($item->user_lvl == 6): ?>
                                        <a class="btn btn-danger" href="<?php echo e(route('user.delete', ['id' => $item->id])); ?>" id="btn-delete">Delete</a>                                            
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit User</h4>
                                    </div>
                                    <form action="<?php echo e(route('user.update.user', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
                                        <input type="text" id="defaultForm-name" class="form-control validate" name="name" value="<?php echo e($item->name); ?>">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
                                            <input type="text" id="defaultForm-email" class="form-control validate" name="email"  value="<?php echo e($item->email); ?>">
                                        </div>

                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
                                            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate" value="<?php echo e($item->contact_no); ?>">
                                        </div>

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-password">Password</label>
                                            <input type="password" id="defaultForm-password" class="form-control validate" name="password" >
                                        </div>
  
                                        <div class="md-form mb-4">
                                                <label data-error="wrong" data-success="right" for="defaultForm-department">Position</label>
                                                <select name="position" id="defaultForm-department" class="form-control validate">
                                                    <option value="" disabled selected>Position</option>
                                                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($position->id); ?>" <?php echo e($position->id == $item->position_id ? 'selected' : ''); ?>><?php echo e($position->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>                                               

                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-department">Department</label>
                                            <select name="department" id="defaultForm-department" class="form-control validate">
                                                <option value="" disabled selected>Select Department</option>
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($department->id); ?>" <?php echo e($department->id == $item->department_id ? 'selected' : ''); ?>><?php echo e($department->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
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
            <h4 class="modal-title w-100 font-weight-bold">Add User</h4>
      </div>
    <form action="<?php echo e(route('user.store')); ?>" method="POST" id="user_form">
        <?php echo e(csrf_field()); ?>

      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <label data-error="wrong" data-success="right" for="defaultForm-name">Name</label>
          <input type="text" name="name" id="defaultForm-name" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-email">Username</label>
            <input type="text" name="email" id="defaultForm-email" class="form-control validate">
        </div>

        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-contact_no">Contact Number</label>
            <input type="number" name="contact_no" id="defaultForm-contact_no" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <?php if($positions->count() == 0): ?>
                <br>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Position is required! Please Add</label>
                 <a href="<?php echo e(route('positions')); ?>" target="blank">Click here to Add</a>               
            <?php else: ?>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Position</label>
                <select name="position_id" id="defaultForm-department" class="form-control validate">
                    <option value="" disabled selected>Select Position</option>
                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($position->id); ?>"><?php echo e($position->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>   
            <?php endif; ?>
        </div>   

        <div class="md-form mb-4">
            <?php if($departments->count() == 0): ?>
                <br>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Department is required! Please Add</label>
                 <a href="<?php echo e(route('departments')); ?>" target="blank">Click here to Add</a>               
            <?php else: ?>
                <label data-error="wrong" data-success="right" for="defaultForm-department">Department</label>
                <select name="department_id" id="defaultForm-department" class="form-control validate">
                    <option value="" disabled selected>Select Department</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>   
            <?php endif; ?>
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

            $('#dataTables-second').DataTable({
                responsive: true
            });

            $('#user_form').submit(function(){
            $(this).find(':input[type=submit]').prop('disabled', true);
            });

        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('bac.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>