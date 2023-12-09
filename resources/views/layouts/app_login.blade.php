<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>NOC | @yield('title')  </title>

    <link rel="stylesheet" href="{{asset('/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/css/vendor.bundle.base.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/vendors/jvectormap/jquery-jvectormap.css')}}" >
    <link rel="stylesheet" href="{{asset('/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/modern-vertical/style.css')}}">

    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.png')}}" >


    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">


    @yield('customcss')
</head>

<body class="sidebar-icon-only">


    <div class="container-scroller">
        @yield('content')
    </div>


    <script src="{{asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
     <!-- plugins:js -->
     <script src="assets/vendors/js/vendor.bundle.base.js"></script>

     <script src="{{asset('/assets/vendors/chart.js/Chart.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
     <script src="{{asset('/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
     <script src="{{asset('/assets/js/jquery.cookie.js" type="text/javascript')}}"></script>

     <script src="{{asset('/assets/js/off-canvas.js')}}"></script>
     <script src="{{asset('/assets/js/hoverable-collapse.js')}}"></script>
     <script src="{{asset('/assets/js/misc.js')}}"></script>
     <script src="{{asset('/assets/js/settings.js')}}"></script>
     <script src="{{asset('/assets/js/todolist.js')}}"></script>

     <script src="{{asset('/assets/js/dashboard.js')}}"></script>

</body>


</html>
