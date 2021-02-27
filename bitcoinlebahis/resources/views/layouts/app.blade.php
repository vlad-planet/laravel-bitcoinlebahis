<!DOCTYPE html>
<html ng-app="mainApp">
<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <!-- App Favicon -->



    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">



    <!-- App title -->

    <style>
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
            display: none;
        }
    </style>
    @if (array_key_exists('title', View::getSections()))
        <title>@yield('title')</title>
    @else
        <title>bitcoinlebahis.com</title>
    @endif


<!-- App CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/cryptofont.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.8/angular.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

    @yield('css')
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="/" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>bitcoinlebahis</span>
                </a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav pull-right">

                    <li class="nav-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>

            </div> <!-- end menu-extras -->
            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                @include('layouts.menu.main')
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container wrapper-content">

        <div class="content">
            @yield('content')
        </div>
        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        2016 © bitcoinlebahis.com
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


    </div> <!-- container -->

</div> <!-- End wrapper -->




<script>
    var resizefunc = [];
</script>



<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<?/*<script src="{{ asset('assets/js/waves.js') }}"></script> */?>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>



<!-- Counter Up  -->
<script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('assets/js/jquery.app.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>


@yield('js')
</body>
</html>