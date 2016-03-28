<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{action('DashboardController@getDashboard')}}">
            SMART CCTV ALARM LTD
        </a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</nav>
<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="active-menu" href="{{action('DashboardController@getDashboard')}}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{action('ProjectsController@getProjects')}}">
                    <i class="fa fa-desktop"></i> Projects
                </a>
            </li>
            <li>
                <a href="{{action('SalesController@getSales')}}">
                    <i class="fa fa-bar-chart-o"></i> Sales
                </a>
            </li>
            <li>
                <a href="{{action('UserController@getUsers')}}">
                    <i class="fa fa-qrcode"></i> Users
                </a>
            </li>

            <li>
                <a href="{{action('ReportsController@getReports')}}">
                    <i class="fa fa-table"></i> Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->