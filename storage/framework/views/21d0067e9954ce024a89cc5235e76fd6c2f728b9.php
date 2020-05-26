<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PPMP</title>
    <?php echo $__env->make('shared.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php if(Auth::user()->user_lvl ===4): ?>
            <?php echo $__env->make('procurement.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>           
        <?php endif; ?>
        <?php if(Auth::user()->user_lvl ===1): ?>
            <?php echo $__env->make('user.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
        <?php endif; ?>
                
        <div id="page-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <?php echo $__env->make('shared.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('footer-scripts'); ?>
</body>

</html>
