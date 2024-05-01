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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('custom_css')
</head>

<body class="sidebar-fixed">
    <div class="container-scroller">
        @include('partiels.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('partiels.header')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>


     <!-- plugins:js -->
     <script src="{{asset('/assets/vendors/js/vendor.bundle.base.js')}}"></script>

     <script src="{{asset('/assets/vendors/chart.js/Chart.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
     <script src="{{asset('/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
     <script src="{{asset('/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
     <script src="{{asset('/assets/js/jquery.cookie.js')}}"></script>

     <script src="{{asset('/assets/js/off-canvas.js')}}"></script>
     <script src="{{asset('/assets/js/hoverable-collapse.js')}}"></script>
     <script src="{{asset('/assets/js/misc.js')}}"></script>
     <script src="{{asset('/assets/js/settings.js')}}"></script>
     <script src="{{asset('/assets/js/todolist.js')}}"></script>

     <script src="{{asset('/assets/js/dashboard.js')}}"></script>

     @yield('custom_script')

     <script>

         function getdata() {

            var url = "{{ url('') }}" + '/get_header_error';
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    var data ;


                    if(response.total_errors> 0 )
                    {
                        $('#notificationDropdown .count').html(response.total_errors )
                        $('#notificationDropdown .count').addClass("bg-warning").removeClass("bg-success");
                    }
                    else
                    {
                        $('#notificationDropdown .count').html('0')
                        $('#notificationDropdown .count').removeClass("bg-warning").addClass("bg-success");
                    }


                    if(response.kdm_errors> 0 )
                    {
                        $('#header_kdm_errors').html(response.kdm_errors +' Kdm Errors Detected ')
                        $('#icon_kdm_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_kdm_errors').html('Healthy')
                        $('#icon_kdm_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_sound_alert> 0 )
                    {
                        $('#header_sound_errors').html(response.nbr_sound_alert +' Kdm Errors Detected ')
                        $('#icon_sound_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_sound_errors').html('Healthy')
                        $('#icon_sound_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_projector_alert> 0 )
                    {
                        $('#header_projector_errors').html(response.nbr_projector_alert +' Kdm Errors Detected ')
                        $('#icon_projector_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_projector_errors').html('Healthy')
                        $('#icon_projector_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_server_alert> 0 )
                    {
                        $('#header_server_errors').html(response.nbr_server_alert +' Kdm Errors Detected ')
                        $('#icon_server_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_server_errors').html('Healthy')
                        $('#icon_server_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_storage_errors> 0 )
                    {
                        $('#header_storage_errors').html(response.nbr_storage_errors +' Kdm Errors Detected ')
                        $('#icon_storage_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_storage_errors').html('Healthy')
                        $('#icon_storage_errors').css("color", "rgb(48, 255, 48)");
                    }



                },
                error: function(response) {

                }
            })



        }

        getdata()  ;
     </script>

</body>


</html>
