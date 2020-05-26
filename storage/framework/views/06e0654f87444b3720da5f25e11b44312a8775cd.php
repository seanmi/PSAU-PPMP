   <!-- jQuery -->
   <script src="<?php echo e(asset('css/vendor/jquery/jquery.min.js')); ?>"></script>
   <!-- Bootstrap Core JavaScript -->
   <script src="<?php echo e(asset('css/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
   <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo e(asset('css/vendor/metisMenu/metisMenu.min.js')); ?>"></script>
   <!-- Morris Charts JavaScript -->
   <script src="<?php echo e(asset('css/vendor/raphael/raphael.min.js')); ?>"></script>
   <script src="<?php echo e(asset('css/vendor/morrisjs/morris.min.js')); ?>"></script>
   <!-- Custom Theme JavaScript -->
   <script src="<?php echo e(asset('css/dist/js/sb-admin-2.js')); ?>"></script>
   <!-- DataTables JavaScript -->
   <script src="<?php echo e(asset('css/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
   <script src="<?php echo e(asset('css/vendor/datatables-plugins/dataTables.bootstrap.min.js')); ?>"></script>
   <script src="<?php echo e(asset('css/vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>
   <!-- Custom Theme JavaScript -->
   <script src="<?php echo e(asset('css/dist/js/sb-admin-2.js')); ?>"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
   <script>
           <?php if(Session::has('success')): ?>
            toastr.success('<?php echo e(Session::get('success')); ?>')
            <?php endif; ?>
            <?php if(Session::has('fail')): ?>
                  toastr.error('<?php echo e(Session::get('fail')); ?>')
            <?php endif; ?>
   </script>