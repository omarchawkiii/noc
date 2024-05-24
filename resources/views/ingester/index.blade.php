@extends('layouts.app')
@section('title') Ingester  @endsection
@section('content')
    <div class="page-header ingester-shadow">
        <h3 class="page-title"> Ingester </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Ingester</li>
            </ol>
        </nav>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="scan-tab" data-bs-toggle="tab" href="#scan" role="tab"
               aria-controls="scan" aria-selected="true">Ingest Scan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="monitor-tab" data-bs-toggle="tab" href="#monitor" role="tab"
               aria-controls="Monitor" aria-selected="false">Monitor</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logs-tab" data-bs-toggle="tab" href="#logs" role="tab"
               aria-controls="Logs" aria-selected="false">Ingest Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="scan_error-tab" data-bs-toggle="tab" href="#scan_error" role="tab"
               aria-controls="scan_errors" aria-selected="false"> Scan Errors</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- tab Logest -->
        <div class="tab-pane fade show active" id="scan" role="tabpanel" aria-labelledby="home-tab">
            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="d-flex flex-row justify-content-between mt-2">
                                <div>
                                    <button type="button" class="btn btn-primary btn-icon-text"
                                            id="start_ingest">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i> Ingest
                                    </button>
                                    <button type="button" class="btn btn-info  btn-icon-text"
                                            id="refresh_scan">
                                        <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh
                                    </button>
                                    <button type="button" class="btn btn-success btn-icon-text">
                                        <label class="form-check-label custom-check">
                                            <input type="checkbox" class="form-check-input"
                                                   id="select_all_ingest_items"
                                                   style="font-size: 20px;margin-top: -3px">
                                            <span style="font-weight: bold;">Select All</span> <i
                                                    class="input-helper"></i>
                                        </label>
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-4 ">
                                <div class="col-xl-3 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-monitor"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example"
                                                id="list_source_ingest">
                                            <option selected="">Select Screen</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-screwdriver"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="filter_type">
                                            <option value="all" selected="">All elements</option>
                                            <option value="CompositionPlaylist">CompositionPlaylist
                                            </option>
                                            <option value="ShowPlaylist">ShowPlaylist</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <input type="text" class="form-control"
                                               id="search_ingest_scan" placeholder="Search ">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list multiplex" id="result_scan">
                                        <div class="no-source"> No Source Selected</div>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>


            </div>
        </div>
        <!-- end tab Logest -->
        <div class="tab-pane fade" id="monitor" role="tabpanel" aria-labelledby="monitor">
            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="d-flex flex-row justify-content-between mt-2" style="margin-bottom: 5px">
                                <div>
                                    <button type="button" class="btn btn-success btn-icon-text" id="resume_ingest">
                                        <i class="mdi mdi-play  btn-icon-prepend"></i> Resume
                                    </button>
                                    <button type="button" class="btn btn-warning  btn-icon-text" id="pause_ingest">
                                        <i class="mdi mdi-refresh  btn-icon-prepend"></i> Pause
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon-text" id="cancel_ingest">
                                        <i class="mdi mdi-server-remove btn-icon-prepend"></i> Cancel
                                    </button>
                                    <button type="button" class="btn btn-primary btn-icon-text" id="details_ingest">
                                        <i class="mdi mdi-magnify btn-icon-prepend"></i> Details
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list multiplex" id="div_ingest_monitor">
                                        <div class="table-responsive">
                                            <div class="d-flex flex-row  ">
                                                <h4 class="card-title " style="border-bottom: 1px solid white; padding-bottom: 8px;   margin-top: 20px;">
                                                    <span  class="mdi mdi-play monitor-icons btn btn-primary " style='margin-right: 7px'></span>
                                                    Running Tasks
                                                </h4>
                                            </div>
                                            <table class="table" id="table_ingest_running">
                                                <thead>
                                                <tr>
                                                    <th> State</th>
                                                    <th> Type</th>
                                                    <th> File Name</th>
                                                    <th> Source</th>
                                                    <th> Started</th>

                                                    <th> Overall Progress</th>
                                                </tr>
                                                </thead>
                                                <tbody id="body_ingest_running">


                                                </tbody>
                                            </table>


                                            <div class="  row empty-running-task col-md-12 "> Empty !</div>
                                            <hr style="    height: 8px;   width: 50%;  margin: auto; margin-top: 21px;   margin-bottom: 21px;"/>
                                            <div class="d-flex flex-row    ">
                                                <h4 class="card-title " style="border-bottom: 1px solid white; padding-bottom: 8px;   margin-top: 20px;">
                                                    <i   class="mdi mdi-av-timer   monitor-icons  btn btn-warning "    style='margin-right: 7px'></i>
                                                    Pending Tasks
                                                </h4>
                                            </div>
                                            <table class="table" id="table_ingest_pending">
                                                <thead>
                                                <tr>
                                                    <th> State</th>
                                                    <th> Type</th>
                                                    <th> File Name</th>
                                                    <th> Source</th>
                                                    <th> Created</th>

                                                </tr>
                                                </thead>
                                                <tbody id="body_ingest_pending">


                                                </tbody>
                                            </table>
                                            <div class="  row empty-pending-task col-md-12 "> Empty !</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- tab Logest -->
        <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs">
            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row mt-4 d-none">
                                <div class="col-xl-2 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-monitor"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="filter_logs_status">
                                            <option selected="All">All</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Failed">Failed</option>
                                            <option value="Canceled By User">Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-screwdriver"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="filter_logs_type">
                                            <option value="All" selected="">All Elements</option>
                                            <option value="DCP">Content Playlist</option>

                                            <option value="SPL"> Show Playlist</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i  class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <button class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="details_logs">
                                            Details
                                        </button>

                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i
                                                        class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <input type="text" class="form-control"
                                               id="search_logs" placeholder="Search ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                    <div class="preview-list multiplex" id="div_ingest_logs">
                                        <div class="table-responsive">
                                            <table class="table " id="table_ingest_logs">
                                                <thead>
                                                <tr>

                                                    <th> State</th>
                                                    <th> File Name</th>
                                                    <th> Source</th>
                                                    <th> Type</th>
                                                    <th> Started</th>
                                                    <th> Finished</th>
                                                    <th> Overall Progress</th>

                                                </tr>
                                                </thead>
                                                <tbody id="body_ingest_logs">


                                                <tr>
                                                    <td class="py-1 text-warning">
                                                        <span class="mdi mdi-timer-sand text-warning"></span>
                                                        Pending
                                                    </td>
                                                    <td>T</td>
                                                    <td class="text-white"> Messsy Adam</td>

                                                    <td class="text-white">2023-09-20 00:51:13</td>
                                                    <td class="text-white">2023-09-20 00:51:13</td>
                                                    <td class="text-white"> 100%</td>

                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end tab Logest -->
        <div class="tab-pane fade" id="scan_error" role="tabpanel" aria-labelledby="scan_error">
            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="d-flex flex-row justify-content-between mt-2">
                                <div>
                                    <button type="button" class="btn btn-danger btn-icon-text"
                                            id="delete_scan_logs">
                                        <i class="mdi mdi-server-remove btn-icon-prepend"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list multiplex" id="div_scan_error">
                                        <div class="table-responsive">
                                            <table class="table " id="errors_scan_table">
                                                <thead>
                                                <tr>

                                                    <th>id</th>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th> Source</th>
                                                    <th> Date</th>
                                                    <th> Content</th>
                                                    <th> Path</th>


                                                </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>


    <div class="modal fade show" id="details-ingest-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    <i class="btn btn-primary mdi mdi-magnify" style="margin-right: 5px"></i>
                        Ingest Details
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group custom-form-group" style="text-align: center">

                                <div class="row tab-pane fade show active"  id="ingest_details_content"   >

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col" style="text-align: center">
                            <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                    aria-label="Close">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade show" id="no-select-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">
                        <i class="mdi mdi-alert btn btn-warning " style="margin-right: 5px"></i>
                        Warning
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group" style="text-align: center">
                                    <label id="modal_no_select_text"> No Task Selected </label>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col" style="text-align: center">
                                <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                        aria-label="Close">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="empty-logs-warning-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">
                        <i class="mdi mdi-alert btn btn-warning " style="margin-right: 5px"></i>
                        Warning
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group" style="text-align: center">
                                    <label id="modal_no_select_text"> No Log Selected </label>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col" style="text-align: center">
                                <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                        aria-label="Close">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<!-- -------END  DATA TABLE ---- -->

<script src="{{asset('/assets/js/ingester.js')}}"></script>
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>


<script>

    // filter location
    (function($) {


        $(document).on('click', '#logs-tab', function (e) {
            e.preventDefault();
            console.log('tes')
            var url = "{{  url('') }}"+ "/ingest/logs" ;
            $.ajax({
               url: url,
               method: 'GET',
               success:function(response)
               {
                console.log(response)
                var result ="" ;
                if(response.dcp_trensfers.length>0)
                {
                    $.each(response.spls, function( index, value ) {
                        result = result
                            +'<tr class="odd" >'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" >'+value.status+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" >'+value.name+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> DCP</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.created_at+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.updated_at+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.progress+'</a></td>'
                            +'</tr>';
                    });
                    $('#body_ingest_logs').html(result)
                }
                else
                {
                    $('#body_ingest_logs').html('<div id="table_logs_processing" class="dataTables_processing card">No Data</div>')
                }

               },
               error: function(response) {

               }
            })


        });

    })(jQuery);


</script>
@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
<style>
    .custom-icon {
        font-size: 21px;
        padding: 1px 4px 1px 4px;
    }

    .custom-border {
        border-color: white;
        border-width: 3px !important;
        margin-bottom: 3px;
        border-bottom: 2px solid !important;
    }

    #result_scan {
        margin-bottom: 3px;
        border-top: 2px solid white;
    }

    .no-source {

    }

    .monitor-icons {
        margin-right: 5px;
        font-weight: bold;
        font-size: 19px;
        padding: 2px;
        padding-bottom: 0px;
    }

    .hidden-icon {
        opacity: 0 !important;
    }

    .running-icon {
        opacity: 1;
        transition: opacity 0.5s ease; /* Smooth transition over 0.5 seconds */
    }

    .table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
        vertical-align: middle;
        font-size: 0.875rem;
        line-height: 1;
        white-space: nowrap;
        padding: 0.9375rem;
        color: white;
    }
    #modal_content_text{
        width: 100%;
        font-size: 16px;
        font-weight: bold;
    }
    #modal_no_select_text{
        width: 100%;
        font-size: 16px;
        font-weight: bold;
    }
   #list_details_mxf {
        height: 300px;
        max-height: 300px;
        overflow-y: scroll;
    }
   .empty-running-task{
       display: block;
       margin: auto;
       text-align: center;
       font-size: 27px;
       font-weight: bold;
       padding: 25px;
   }
    .empty-pending-task{
        display: block;
        margin: auto;
        text-align: center;
        font-size: 27px;
        font-weight: bold;
        padding: 25px;
    }
    .adapt-text {
        line-height: 22px!important;

        white-space: pre-wrap !important;
        word-break: break-word;
        overflow-wrap: break-word;
        color: white;

    }
    .dt-head-nowrap{
        white-space: nowrap;
    }
</style>
@endsection
