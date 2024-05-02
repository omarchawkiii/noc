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

    <div class="modal fade show" id="kdm_errors_modal" tabindex="-1" aria-labelledby="ModalLabel"  aria-modal="true" role="dialog">
        <div class="modal-dialog" style="max-width: 93%; width: 93%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Errors </h5>
                    <input type="hidden">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="kdm-errors-tab" data-bs-toggle="tab" href="#kdm-errors-section" role="tab" aria-controls="kdm-errors" aria-selected="false">KDM Errors </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="server-Errors-tab" data-bs-toggle="tab" href="#server-Errors-section" role="tab" aria-controls="server-errors" aria-selected="false">Server Errors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Projector-errors-tab" data-bs-toggle="tab" href="#Projector-errors-section" role="tab" aria-controls="Projector" aria-selected="false">Projector Error</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="show-sound-errors-tab" data-bs-toggle="tab" href="#sound-errors-section" role="tab" aria-controls="show-playlist" aria-selected="false">Sound Error</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="show-storage-errors-tab" data-bs-toggle="tab" href="#storage-errors-section" role="tab" aria-controls="show-sto" aria-selected="false">Storage Error</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="height: 559px;">
                        <div class="tab-pane fade show active" id="kdm-errors-section" role="tabpanel" aria-labelledby="kdm-error">
                            <div id="list_kdm_errors" style="overflow: scroll; height: 570px">

                                <table class="table" id="table_list_kdm_errors">
                                    <thead>
                                    <tr>
                                        <th width="20%">CPL UUID</th>
                                        <th width="20%">Annotation Text </th>
                                        <th width="20%">Details</th>
                                        <th width="10%">Screen</th>
                                        <th width="30%">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_list_kdm_errors"><tr>    <td width="20%">urn:uuid:271f88ea-2d1e-4ab2-aa42-43e7399cf11a</td>
        <td width="20%">ROUND-UP-PUNISHMENT_FTR_S_KO-MSA-QMS-EN_MY_51_2K_MG_20240425_IOP_VF1</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-01</td>
        <td width="30%">2024-04-30 16:00:18</td></tr><tr>    <td width="20%">urn:uuid:9965adb1-485e-4b92-81d4-356f722ad499</td>
        <td width="20%">DUAHATIBIRUFNL_FTR_F-185_IND-ind_INT_71_4K_ST_20240417_RIC_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-01</td>
        <td width="30%">2024-04-25 04:49:02</td></tr><tr>    <td width="20%">urn:uuid:35df0266-42e9-4ee8-a503-6f2752eb9d52</td>
        <td width="20%">PEENAK4_FTR_S-239_TH-MSA-QMS-EN_MY_51_2K_FP_20240408_FP_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-02</td>
        <td width="30%">2024-04-24 09:20:17</td></tr><tr>    <td width="20%">urn:uuid:f8243746-53c3-4017-b598-aa0876d4d37f</td>
        <td width="20%">GodzillaXKong_FTR-2-2D_S_EN-MSA-QMS_MY_51_4K_WR_20240307_DLX_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-02</td>
        <td width="30%">2024-04-30 13:40:34</td></tr><tr>    <td width="20%">urn:uuid:75a95948-dca8-43b0-b4dd-c621fcb7f47c</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-MSA-QMS_MY_51_2K_FP_20240430_FP_SMPTE_VF</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-03</td>
        <td width="30%">2024-05-01 18:00:30</td></tr><tr>    <td width="20%">urn:uuid:b3e307b1-3b96-44b6-b4ed-6b9585179b0b</td>
        <td width="20%">Abigail_FTR-1_S_EN-MSA-QMS_MY_51_2K_UP_20240412_EKN_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-03</td>
        <td width="30%">2024-04-25 04:49:02</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-03</td>
        <td width="30%">2024-04-30 15:30:56</td></tr><tr>    <td width="20%">urn:uuid:698adacc-ef3b-4297-bdb5-adce18e6c10d</td>
        <td width="20%">CashOut_FTR-V3_S_EN-mly-chin_INT_51_2K_ST_20230920_RIC_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-03</td>
        <td width="30%">2024-04-24 02:35:18</td></tr><tr>    <td width="20%">urn:uuid:75a95948-dca8-43b0-b4dd-c621fcb7f47c</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-MSA-QMS_MY_51_2K_FP_20240430_FP_SMPTE_VF</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-04</td>
        <td width="30%">2024-05-01 18:00:31</td></tr><tr>    <td width="20%">urn:uuid:271f88ea-2d1e-4ab2-aa42-43e7399cf11a</td>
        <td width="20%">ROUND-UP-PUNISHMENT_FTR_S_KO-MSA-QMS-EN_MY_51_2K_MG_20240425_IOP_VF1</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-04</td>
        <td width="30%">2024-04-30 16:00:19</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-04</td>
        <td width="30%">2024-04-30 15:30:56</td></tr><tr>    <td width="20%">urn:uuid:b3e307b1-3b96-44b6-b4ed-6b9585179b0b</td>
        <td width="20%">Abigail_FTR-1_S_EN-MSA-QMS_MY_51_2K_UP_20240412_EKN_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-04</td>
        <td width="30%">2024-04-25 04:49:03</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-05</td>
        <td width="30%">2024-04-30 17:20:41</td></tr><tr>    <td width="20%">urn:uuid:b3e307b1-3b96-44b6-b4ed-6b9585179b0b</td>
        <td width="20%">Abigail_FTR-1_S_EN-MSA-QMS_MY_51_2K_UP_20240412_EKN_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-07</td>
        <td width="30%">2024-04-25 04:49:03</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-08</td>
        <td width="30%">2024-04-30 17:15:42</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-09</td>
        <td width="30%">2024-04-30 17:25:31</td></tr><tr>    <td width="20%">urn:uuid:35df0266-42e9-4ee8-a503-6f2752eb9d52</td>
        <td width="20%">PEENAK4_FTR_S-239_TH-MSA-QMS-EN_MY_51_2K_FP_20240408_FP_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Screen-09</td>
        <td width="30%">2024-04-24 09:20:18</td></tr><tr>    <td width="20%">urn:uuid:9965adb1-485e-4b92-81d4-356f722ad499</td>
        <td width="20%">DUAHATIBIRUFNL_FTR_F-185_IND-ind_INT_71_4K_ST_20240417_RIC_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Beanie-01</td>
        <td width="30%">2024-04-25 04:49:04</td></tr><tr>    <td width="20%">urn:uuid:35df0266-42e9-4ee8-a503-6f2752eb9d52</td>
        <td width="20%">PEENAK4_FTR_S-239_TH-MSA-QMS-EN_MY_51_2K_FP_20240408_FP_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Beanie-01</td>
        <td width="30%">2024-04-24 09:20:18</td></tr><tr>    <td width="20%">urn:uuid:9965adb1-485e-4b92-81d4-356f722ad499</td>
        <td width="20%">DUAHATIBIRUFNL_FTR_F-185_IND-ind_INT_71_4K_ST_20240417_RIC_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Beanie-02</td>
        <td width="30%">2024-04-25 04:49:04</td></tr><tr>    <td width="20%">urn:uuid:35df0266-42e9-4ee8-a503-6f2752eb9d52</td>
        <td width="20%">PEENAK4_FTR_S-239_TH-MSA-QMS-EN_MY_51_2K_FP_20240408_FP_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Beanie-02</td>
        <td width="30%">2024-04-24 09:20:19</td></tr><tr>    <td width="20%">urn:uuid:271f88ea-2d1e-4ab2-aa42-43e7399cf11a</td>
        <td width="20%">ROUND-UP-PUNISHMENT_FTR_S_KO-MSA-QMS-EN_MY_51_2K_MG_20240425_IOP_VF1</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Junior</td>
        <td width="30%">2024-04-30 16:00:20</td></tr><tr>    <td width="20%">urn:uuid:35df0266-42e9-4ee8-a503-6f2752eb9d52</td>
        <td width="20%">PEENAK4_FTR_S-239_TH-MSA-QMS-EN_MY_51_2K_FP_20240408_FP_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Junior</td>
        <td width="30%">2024-04-24 09:20:19</td></tr><tr>    <td width="20%">urn:uuid:bc7365e1-230c-43f9-a1cb-45c69c772960</td>
        <td width="20%">CheifOfStation_FTR_S-239_EN-XX_MY_51_2K_FP_20240422_FP_SMPTE_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Indulge--02</td>
        <td width="30%">2024-04-29 12:45:20</td></tr><tr>    <td width="20%">urn:uuid:698adacc-ef3b-4297-bdb5-adce18e6c10d</td>
        <td width="20%">CashOut_FTR-V3_S_EN-mly-chin_INT_51_2K_ST_20230920_RIC_IOP_OV</td>
        <td width="20%">Missing kdm detected </td>
        <td width="10%">Indulge--02</td>
        <td width="30%">2024-04-24 02:35:19</td></tr></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="server-Errors-section" role="tabpanel" aria-labelledby="server-Errors">
                            <div id="list_server_errors" style="overflow: scroll;height: 570px">
                                <table class="table" id="table_list_server_errors">
                                    <thead>
                                    <tr>
                                        <th> Event Id</th>
                                        <th> Date</th>
                                        <th> Class</th>
                                        <th> Type</th>
                                        <th> SubType</th>
                                        <th> Severity</th>
                                        <th> Error Code</th>
                                        <th> Details</th>
                                        <th> Screen</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_list_server_errors"><tr>    <td>1</td>    <td>2024-05-01 17:15:07</td>    <td>Performance</td>    <td>Playout</td>    <td>PlayoutAlert</td>    <td>Error</td>    <td>DCP-E00001001</td></tr><tr>    <td>1</td>    <td>2024-05-01 20:30:07</td>    <td>Performance</td>    <td>Playout</td>    <td>PlayoutAlert</td>    <td>Error</td>    <td>DCP-E00001001</td></tr><tr>    <td>2</td>    <td>2024-05-01 20:56:55</td>    <td>Performance</td>    <td>Playout</td>    <td>PlayoutAlert</td>    <td>Error</td>    <td>DCP-E00001001</td></tr></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="Projector-errors-section" role="tabpanel" aria-labelledby="projector-Errors">
                            <div id="list_projector_errors" style="overflow: scroll;height: 570px">
                                <table class="table" id="table_list_projector_errors">
                                    <thead>
                                    <tr>
                                        <th> Title</th>
                                        <th> Time</th>
                                        <th> Code</th>
                                        <th> Severity</th>
                                        <th> Message</th>
                                        <th> Screen</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_list_projector_errors"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="sound-errors-section" role="tabpanel" aria-labelledby="sound-Errors">
                            <div id="list_sound_errors" style="overflow: scroll;height: 570px">
                                <table class="table" id="table_list_sound_errors">
                                    <thead>
                                    <tr>
                                        <th> Alarm Id</th>
                                        <th>  Date Saved</th>
                                        <th> Severity</th>
                                        <th> Title</th>
                                        <th> Clearable</th>
                                        <th> Hardware</th>
                                        <th> Screen</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_list_sound_errors"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="storage-errors-section" role="tabpanel" aria-labelledby="storage-Errors">
                            <div id="list_storage_errors" style="overflow: scroll;height: 570px">
                                <table class="table" id="table_list_storage_errors">
                                    <thead>
                                    <tr>
                                        <th> Stat</th>
                                        <th> Screen</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_list_storage_errors"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

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
                        $('#header_sound_errors').html(response.nbr_sound_alert +' Sound Errors Detected ')
                        $('#icon_sound_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_sound_errors').html('Healthy')
                        $('#icon_sound_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_projector_alert> 0 )
                    {
                        $('#header_projector_errors').html(response.nbr_projector_alert +' Projector Errors Detected   ')
                        $('#icon_projector_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_projector_errors').html('Healthy')
                        $('#icon_projector_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_server_alert> 0 )
                    {
                        $('#header_server_errors').html(response.nbr_server_alert +' Server Errors Detected ')
                        $('#icon_server_errors').css("color", "rgb(255, 93, 93)");
                    }
                    else
                    {
                        $('#header_server_errors').html('Healthy')
                        $('#icon_server_errors').css("color", "rgb(48, 255, 48)");
                    }

                    if(response.nbr_storage_errors> 0 )
                    {
                        $('#header_storage_errors').html(response.nbr_storage_errors +' Storage Errors Detected ')
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
        $('.nav-item .dropdown-item').click(function(){
            $('#kdm_errors_modal').modal('show');
        });


     </script>

</body>


</html>
