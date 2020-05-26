    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(asset('css/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo e(asset('css/vendor/metisMenu/metisMenu.min.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/dist/css/sb-admin-2.css')); ?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo e(asset('css/vendor/morrisjs/morris.css')); ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo e(asset('css/vendor/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo e(asset('css/vendor/datatables-plugins/dataTables.bootstrap.css')); ?>" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('css/vendor/datatables-responsive/dataTables.responsive.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <?php echo $__env->yieldContent('xtraStyle'); ?>
  <style>
  @media  only screen and (max-width: 767.99px) {
    .hidden-xs {
        display: none;
    }
}

@media  only screen and (min-width: 768px) and (max-width: 991.99px) {
    .hidden-sm {
        display: none;
    }
}

@media  only screen and (min-width: 992px) and (max-width: 1199.99px) {
    .hidden-md {
        display: none;
    }
}

@media  only screen and (min-width: 1200px) {
    .hidden-lg {
        display: none;
    }
}
  </style>
    
    