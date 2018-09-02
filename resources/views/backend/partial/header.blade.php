<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CENTRAREAL</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CENTRAREAL</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::asset('')}}img/avatar5.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->email}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{URL::asset('')}}img/avatar5.png" class="img-circle" alt="User Image">

                            <p>
                                {{Auth::user()->email}}
                                <small>Member since {{Auth::user()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Cá nhân</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('logout') }}" class="btn btn-default btn-flat">
                                    Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>