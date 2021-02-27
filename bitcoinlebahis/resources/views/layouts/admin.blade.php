<!DOCTYPE html>
<html ng-app="mainApp" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- App title -->
    <title>{{ config('app.name', 'Dashbord') }}</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets_adm/plugins/morris/morris.css') }}">

    <!-- Switchery css -->
    <link href="{{ asset('assets_adm/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

    <!-- App CSS -->
    <link href="{{ asset('assets_adm/css/style.css?c=4') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_adm/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets_adm/js/modernizr.min.js') }}"></script>
    @yield('css')
</head>


<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/" class="logo">
                <i class="zmdi zmdi-group-work icon-c-logo"></i>
                <span>{{ config('app.name', 'Dashbord') }}</span></a>
        </div>


        <nav class="navbar navbar-custom">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="zmdi zmdi-menu"></i>
                    </button>
                </li>

            </ul>

            <div class="pull-right" style="display: flex; align-items: center;">

                <ul class="nav navbar-nav" style="display: inline-block">


                    <li class="nav-item dropdown notification-list">
                        <select style="display: inline-block; margin-top: 20px;" class="form-control" ONCHANGE="location = this.options[this.selectedIndex].value;">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option <?if(LaravelLocalization::getCurrentLocale() == $localeCode):?>selected<?endif;?> value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</option>
                            @endforeach
                        </select>
                    </li>


                    <li class="nav-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('assets_adm/images/users/avatar-1.jpg') }}" alt="user" class="img-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow"><small>Welcome {{Auth::user()->name}}</small> </h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i>
                                <span onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       <span>Logout</span>
                                    </span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </a>

                        </div>
                    </li>



                </ul>
            </div>

        </nav>

    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                @include('layouts.menu.admin')


                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">

        <!-- Start content -->
        <div class="content">
            <div class="container">
                @yield('content')
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <footer class="footer text-right">
        @if (array_key_exists('footer', View::getSections()))
            @yield('footer')
        @else
            {{config('app.name', 'Dashbord')}}
        @endif
    </footer>


</div>
<!-- END wrapper -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ asset('assets_adm/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets_adm/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
<script src="{{ asset('assets_adm/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets_adm/js/detect.js') }}"></script>
<script src="{{ asset('assets_adm/js/fastclick.js') }}"></script>
<script src="{{ asset('assets_adm/js/jquery.slimscroll.js') }}"></script>

<?/*


        <script src="{{ asset('assets_adm/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets_adm/js/waves.js') }}"></script>
        <script src="{{ asset('assets_adm/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets_adm/js/jquery.scrollTo.min.js') }}"></script>

        <script src="{{ asset('assets_adm/plugins/switchery/switchery.min.js') }}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets_adm/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets_adm/plugins/raphael/raphael-min.js') }}"></script>

        <!-- Counter Up  -->
        <script src="{{ asset('assets_adm/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
        <script src="{{ asset('assets_adm/plugins/counterup/jquery.counterup.min.js') }}"></script>
        */?>
<!-- App js -->
<script src="{{ asset('assets_adm/js/jquery.core.js') }}"></script>
<script src="{{ asset('assets_adm/js/jquery.app.js') }}"></script>

<!-- Page specific js -->
<script src="{{ asset('assets_adm/pages/jquery.dashboard.js') }}"></script>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<script src="{{ asset('assets_adm/js/app.js') }}"></script>


@yield('js')

</body>
</html>