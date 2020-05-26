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
                    <li><a href="{{route('vp.edit.profile', ['id' => Auth::user()->id])}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li class="text-center">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        {{ csrf_field() }}
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
                    <h3 style="color:gray; padding-left:2rem;">{{Auth::user()->name}}</h3>     
                    </li>             
                    <li>    
                        <a href="{{route('vp.approvals')}}" class="{{Route::currentRouteName() === 'vp.approvals' ? 'active' : ''}}"><i class="fa fa-table fa-fw " ></i>For Approval</a>
                    </li>
                    <li>    
                        <a href="{{route('vp.approved.plans')}}" class="{{Route::currentRouteName() === 'vp.approved.plans' ? 'active' : ''}}"><i class="fa fa-table fa-fw " ></i>Approved</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>