<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>NOC | @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/modern-vertical/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}">
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

    <div class="modal fade show header-popup" id="header_kdm_errors_modal" tabindex="-1" aria-labelledby="ModalLabel"
        aria-modal="true" role="dialog">
        <div class="modal-dialog  modal-xl" role="document" style="max-width: 93%; width: 93%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> KDMS Errors List</h5>
                    <input type="hidden">
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">


                    <div id="list_kdm_errors" class="table-responsive preview-list multiplex">

                        <table class="table " id="header_table_list_kdm_errors">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>CPL UUID</th>
                                    <th>Annotation Text </th>
                                    <th>Details</th>
                                    <th width="10%">Screen</th>
                                    <th width="30%">Date</th>
                                </tr>
                            </thead>
                            <tbody id="header_body_list_kdm_errors">

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="modal fade show header-popup" id="header_server_errors_modal" tabindex="-1"
        aria-labelledby="ModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog  modal-xl" role="document" style="max-width: 93%; width: 93%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Sever Errors List</h5>
                    <input type="hidden">
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">


                    <div id="list_server_errors" class="table-responsive preview-list multiplex">

                        <table class="table " id="table_list_server_errors">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th> Event Id</th>
                                    <th> Date</th>
                                    <th> Class</th>
                                    <th> Type</th>
                                    <th> SubType</th>
                                    <th> Severity</th>
                                    <th> Error Code</th>
                                    <th> Screen</th>
                                </tr>
                            </thead>
                            <tbody id="header_body_list_server_errors">

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>


    <div class="modal fade show header-popup" id="header_projector_errors_modal" tabindex="-1"
        aria-labelledby="ModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog  modal-xl" role="document" style="max-width: 93%; width: 93%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Projector Errors List</h5>
                    <input type="hidden">
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">


                    <div id="list_projector_errors" class="table-responsive preview-list multiplex">

                        <table class="table " id="table_list_projector_errors">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th> Title</th>
                                    <th> Time</th>
                                    <th> Code</th>
                                    <th> Severity</th>
                                    <th> Message</th>
                                    <th> Screen</th>
                                </tr>
                            </thead>
                            <tbody id="header_body_list_projector_errors">

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="modal fade show" id="header_storage_errors_modal" tabindex="-1" aria-labelledby="ModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog  modal-xl"  role="document"  style="max-width: 93%; width: 93%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Storage Errors List</h5>
                    <input type="hidden">
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">


                    <div id="list_storage_errors"  class="table-responsive preview-list multiplex">

                        <table class="table " id="header_table_list_storage_errors">
                            <thead>
                            <tr>
                                <th> Stat</th>
                                <th> Screen</th>

                            </tr>
                            </thead>
                            <tbody id="header_body_list_storage_errors">

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>


    <!-- plugins:js -->
    <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ asset('/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.cookie.js') }}"></script>

    <script src="{{ asset('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/assets/js/misc.js') }}"></script>
    <script src="{{ asset('/assets/js/settings.js') }}"></script>
    <script src="{{ asset('/assets/js/todolist.js') }}"></script>

    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>

    @yield('custom_script')

    <script>
        function header_getdata() {

            var url = "{{ url('') }}" + '/get_header_error';
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    var data;


                    if (response.total_errors > 0) {
                        $('#notificationDropdown .count').html(response.total_errors)
                        $('#notificationDropdown .count').addClass("bg-warning").removeClass("bg-success");
                    } else {
                        $('#notificationDropdown .count').html('0')
                        $('#notificationDropdown .count').removeClass("bg-warning").addClass("bg-success");
                    }


                    if (response.kdm_errors > 0) {
                        $('#header_kdm_errors').html(response.kdm_errors + ' Kdm Errors Detected ')
                        $('#icon_kdm_errors').css("color", "rgb(255, 93, 93)");
                    } else {
                        $('#header_kdm_errors').html('Healthy')
                        $('#icon_kdm_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if (response.nbr_sound_alert > 0) {
                        $('#header_sound_errors').html(response.nbr_sound_alert + ' Sound Errors Detected ')
                        $('#icon_sound_errors').css("color", "rgb(255, 93, 93)");
                    } else {
                        $('#header_sound_errors').html('Healthy')
                        $('#icon_sound_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if (response.nbr_projector_alert > 0) {
                        $('#header_projector_errors').html(response.nbr_projector_alert +
                            ' Projector Errors Detected   ')
                        $('#icon_projector_errors').css("color", "rgb(255, 93, 93)");
                    } else {
                        $('#header_projector_errors').html('Healthy')
                        $('#icon_projector_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if (response.nbr_server_alert > 0) {
                        $('#header_server_errors').html(response.nbr_server_alert + ' Server Errors Detected ')
                        $('#icon_server_errors').css("color", "rgb(255, 93, 93)");
                    } else {
                        $('#header_server_errors').html('Healthy')
                        $('#icon_server_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if (response.nbr_storage_errors > 0) {
                        $('#header_storage_errors').html(response.nbr_storage_errors +
                            ' Storage Errors Detected ')
                        $('#icon_storage_errors').css("color", "rgb(255, 93, 93)");
                    } else {
                        $('#header_storage_errors').html('Healthy')
                        $('#icon_storage_errors').css("color", "rgb(48, 255, 48)");
                    }

                },
                error: function(response) {

                }
            })

        }

        header_getdata();


        $(document).on('click', '.header_kdm_errors_btn', function() {
            var location = $(this).data('location');
            header_get_kdms_errors_list(location)
            $('#header_kdm_errors_modal').modal('show');
        });

        function header_get_kdms_errors_list(location) {
            var url = "{{ url('') }}" + '/get_kdm_errors_list';
            $.ajax({
                url: url,
                data: {
                    location: location,
                },
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    var data;
                    if (response.kdms_errors_list.length > 0) {
                        $.each(response.kdms_errors_list, function(index, kdm) {

                            data +=
                                '<tr class="odd ">' +
                                '<td class="sorting_1"> ' + kdm.location.name + '  </td>' +
                                '<td class="sorting_1"> ' + kdm.cpl_id + '  </td>' +
                                '<td class="sorting_1"> ' + kdm.annotationText + '  </td>' +
                                '<td class="sorting_1"> ' + kdm.details + '  </td>' +
                                '<td class="sorting_1"> ' + kdm.serverName + '  </td>' +
                                '<td class="sorting_1"> ' + kdm.date_time + '  </td>' +
                                '</tr>'

                        })

                        $('#header_body_list_kdm_errors').html(data);

                    } else {
                        $('#header_body_list_kdm_errors').html(
                            '<div id="table_logs_processing" class="dataTables_processing card">No data available </div>'
                            );
                    }


                },
                error: function(response) {

                }
            })

        }

        $(document).on('click', '.header_server_errors_btn', function() {

            var location = $(this).data('location');
            console.log(location)
            header_get_server_errors_list(location)
            $('#header_server_errors_modal').modal('show');
        });

        function header_get_server_errors_list(location) {
            var url = "{{ url('') }}" + '/get_server_errors_list';
            $.ajax({
                url: url,
                data: {
                    location: location,
                },
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    var data;
                    if (response.server_errors_list.length > 0) {
                        $.each(response.server_errors_list, function(index, server) {
                            data +=
                                '<tr class="odd  ">' +
                                '<td class="sorting_1"> ' + server.location.name + '  </td>' +
                                '<td class="sorting_1"> ' + server.eventId + '  </td>' +
                                '<td class="sorting_1"> ' + server.date + '  </td>' +
                                '<td class="sorting_1" > ' + server.class + '  </td>' +
                                '<td class="sorting_1"> ' + server.type + '  </td>' +
                                '<td class="sorting_1"> ' + server.subType + '  </td>' +
                                '<td class="sorting_1"> ' + server.criticity + '  </td>' +
                                '<td class="sorting_1"> ' + server.errorCode + '  </td>' +
                                '<td class="sorting_1"> ' + server.serverName + '  </td>' +
                                '</tr>'

                        })

                        $('#header_body_list_server_errors').html(data);

                    } else {
                        $('#header_body_list_server_errors').html(
                            '<div id="table_logs_processing" class="dataTables_processing card">No data available </div>'
                            );
                    }


                },
                error: function(response) {

                }
            })
        }

        $(document).on('click', '.header_projector_errors_btn', function() {

            var location = $(this).data('location');
            console.log(location)
            header_get_projector_errors_list(location)
            $('#header_projector_errors_modal').modal('show');
        });

        function header_get_projector_errors_list(location) {
            var url = "{{ url('') }}" + '/get_projector_errors_list';
                $.ajax({
                    url: url,
                    data:
                    {
                        location: location,
                    },
                    method: 'GET',
                    success: function(response)
                    {
                        console.log(response)
                        var data;
                        if (response.projector_errors_list.length > 0) {

                            $.each(response.projector_errors_list, function(index, projector) {
                                data +=
                                    '<tr class="odd ">' +
                                    '<td class="sorting_1"> ' + projector.location.name + '  </td>' +
                                    '<td class="sorting_1"> ' + projector.title + '  </td>' +
                                    '<td class="sorting_1"> ' + projector.time_saved + '  </td>' +
                                    '<td class="sorting_1" > ' + projector.code + '  </td>' +
                                    '<td class="sorting_1"> ' + projector.severity + '  </td>' +
                                    '<td class="sorting_1"> ' + projector.message + '  </td>' +
                                    '<td class="sorting_1"> ' + projector.serverName + '  </td>'

                                    +
                                    '</tr>'

                            })
                            console.log(data);
                            $('#header_body_list_projector_errors').html(data);

                        } else
                        {
                            $('#header_body_list_projector_errors').html(
                                '<div id="table_logs_processing" class="dataTables_processing card">No data available </div>'
                                );
                        }


                    },
                    error: function(response) {

                    }
                })
        }




        $(document).on('click', '.show_storage_errors_details', function() {

            var location = $(this).data('location');
            console.log(location)
            header_get_storage_errors_list(location)
            $('#header_storage_errors_modal').modal('show');
        });
        function header_get_storage_errors_list(location)
        {

            var url = "{{ url('') }}" + '/get_storage_errors_list';
            $.ajax({
                url: url,
                data: {
                    location: location,
                },
                method: 'GET',
                success: function(response) {
                    var data ;
                    if(response.storage_errors_list.length > 0)
                    {

                        $.each(response.storage_errors_list, function(index, storage) {
                        data +=
                            '<tr class="odd ">'
                                +'<td class="sorting_1"> '+ storage.storage_generale_status+'  </td>'
                                +'<td class="sorting_1"> '+ storage.serverName+'  </td>'
                            +'</tr>'

                        })

                        $('#header_body_list_storage_errors').html(data) ;

                    }
                    else
                    {
                        $('#header_body_list_storage_errors').html('<div id="table_logs_processing" class="dataTables_processing card">No data available </div>') ;
                    }


                },
                error: function(response) {

                }
            })



        }
        /*let header_content_height = document.querySelector('.content-wrapper').offsetHeight - 100;


        $(".header-popup .modal-body").height(header_content_height);
        $(".header-popup .modal-body").css({
            "maxHeight": header_content_height
        }); */
    </script>

</body>


</html>
