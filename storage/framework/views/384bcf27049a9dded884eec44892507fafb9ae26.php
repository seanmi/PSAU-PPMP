<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Categorized Items</h3>
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
                        <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-success ">Add Item</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>General Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Procurement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $categorized; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX ">
                                    <td><?php echo e($item->general_description); ?></td>
                                    <td><?php echo e($item->unit); ?></td>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->category->name); ?></td>
                                    <?php if($item->mode_of_procurement_id): ?>
                                    <td><?php echo e($item->mode->name); ?></td>
                                    <?php else: ?>
                                    <td></td> 
                                    <?php endif; ?>
                                    
                                    <td class="text-center">
                                        <a href="" data-toggle="modal" data-target="#<?php echo e($item->id); ?>" class="btn btn-primary ">Edit</a>
                                        <a class="btn btn-danger" href="<?php echo e(route('item.delete', ['id' => $item->id])); ?>">Delete</a>
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
                                          <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
                                    </div>
                                    <form action="<?php echo e(route('item.update', ['id' => $item->id])); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-body mx-3">
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-desc">General Description</label>
                                            <input type="text" id="defaultForm-desc" class="form-control validate" name="general_description"  value="<?php echo e($item->general_description); ?>">
                                        </div>
                                
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                            <input type="text" id="defaultForm-unit" class="form-control validate" name="unit" value="<?php echo e($item->unit); ?>">
                                        </div>   
                                        
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-price" >Price</label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">₱</span>
                                                <input type="text" id="defaultForm-price" class="form-control" name="price"  value="<?php echo e($item->price); ?>">
                                                <span class="input-group-addon">.00</span> 
                                            </div>
                                        </div>
                                        <h1></h1>
                                        <div class="md-form mb-4">
                                            <label data-error="wrong" data-success="right" for="defaultForm-category" >Category</label>
                                            <select name="category_id" id="defaultForm-category" class="form-control">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
                                                cateogryid<?php echo e($category->id); ?>  / item category<?php echo e($item->category_id); ?>   
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $item->category_id ? "selected" : ""); ?>><?php echo e($category->name); ?></option>
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
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header p-1 m-1">Uncategorized Items</h3>
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
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-second">
                                    <thead>
                                        <tr>
                                            <th>General Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Procurement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                    <?php $__currentLoopData = $uncategorized; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="odd gradeX ">
                                            <td><?php echo e($item->general_description); ?></td>
                                            <td><?php echo e($item->unit); ?></td>
                                            <td><?php echo e($item->price); ?></td>
                                            <td><?php echo e($item->category->name); ?></td>
                                            <?php if($item->mode_of_procurement_id): ?>
                                             <td><?php echo e($item->mode->name); ?></td>
                                            <?php else: ?>
                                            <td></td>                                               
                                             <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="" data-toggle="modal" data-target="#<?php echo e($item->id); ?>" class="btn btn-primary ">Edit</a>
                                                <a class="btn btn-danger" href="<?php echo e(route('item.delete', ['id' => $item->id])); ?>">Delete</a>
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
                                                  <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
                                            </div>
                                            <form action="<?php echo e(route('item.update', ['id' => $item->id])); ?>" method="POST">
                                                    <?php echo e(csrf_field()); ?>

                                                <div class="modal-body mx-3">
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-desc">General Description</label>
                                                    <input type="text" id="defaultForm-desc" class="form-control validate" name="general_description"  value="<?php echo e($item->general_description); ?>">
                                                </div>
                                        
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
                                                    <input type="text" id="defaultForm-unit" class="form-control validate" name="unit" value="<?php echo e($item->unit); ?>">
                                                </div>   
                                                
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-price" >Price</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">₱</span>
                                                        <input type="text" id="defaultForm-price" class="form-control" name="price"  value="<?php echo e($item->price); ?>">
                                                        <span class="input-group-addon">.00</span> 
                                                    </div>
                                                </div>
                                                <div class="md-form mb-4">
                                                    <label data-error="wrong" data-success="right" for="defaultForm-category" >Category</label>
                                                    <select name="category_id" id="defaultForm-category" class="form-control">
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
                                                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $item->category_id ? "selected" : ""); ?>><?php echo e($category->name); ?></option>
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
            <h4 class="modal-title w-100 font-weight-bold">Add Item</h4>
      </div>
    <form action="<?php echo e(route('item.store')); ?>" method="POST" id="item_form">
        <?php echo e(csrf_field()); ?>

      <div class="modal-body mx-3">

        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right" for="defaultForm-desc">General Description</label>
          <input type="text" name="general_description" id="defaultForm-desc" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-unit">Unit</label>
            <input type="text" name="unit" id="defaultForm-unit" class="form-control validate">
        </div>   
        
        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-price">Price</label>
            <div class="form-group input-group">
                <span class="input-group-addon">₱</span>
                <input type="number" name="price" min="1" id="defaultForm-price" class="form-control" >
                <span class="input-group-addon">.00</span> 
            </div>
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-price">Category</label>
            <select name="category_id" id="" class="form-control">
                    <?php if($categories->count() === 0): ?>
                        <option value="">No Categories to show</option> 
                    <?php else: ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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
        });

        $('#item_form').submit(function(){
          $(this).find(':input[type=submit]').prop('disabled', true);
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('shared.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>