<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">PPMP</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo e(route('bac.edit.profile', ['id' => Auth::user()->id])); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li class="text-center">
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" >
                                        <?php echo e(csrf_field()); ?>

                            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-out fa-fw"></i>Logout</button>
                        </form>  
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu"> 
                    <li >
                    <h3 style="color:gray; padding-left:2rem;"><?php echo e(Auth::user()->name); ?></h3>     
                    </li>  
                    <li>    
                        <a href="<?php echo e(route('users')); ?>" class="<?php echo e(Route::currentRouteName() === 'users' ? 'active' : ''); ?>"><i class="fa fa-user" ></i>Users</a>
                    </li>    
                    <li>    
                        <a href="<?php echo e(route('departments')); ?>" class="<?php echo e(Route::currentRouteName() === 'departments' ? 'active' : ''); ?>"><i class="fa fa-university" ></i>Departments</a>
                    </li>          
                    <li>    
                        <a href="<?php echo e(route('positions')); ?>" class="<?php echo e(Route::currentRouteName() === 'positions' ? 'active' : ''); ?>"><i class="fa fa-table fa-fw " ></i>Positions</a>
                    </li>          
                    <li>    
                        <a href="<?php echo e(route('bac.modes')); ?>" class="<?php echo e(Route::currentRouteName() === 'bac.modes' ? 'active' : ''); ?>"><i class="fa fa-table fa-fw " ></i>Procurement Modes</a>
                    </li>
                    <li>    
                        <a href="<?php echo e(route('bac.submissions')); ?>" class="<?php echo e(Route::currentRouteName() === 'bac.submissions' ? 'active' : ''); ?>"><i class="fa fa-table fa-fw " ></i>Submissions</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>