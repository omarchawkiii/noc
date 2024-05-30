@extends('layouts.app')
@section('title') Transfere content  @endsection
@section('content')
    <div class="page-header ingester-shadow">
        <h3 class="page-title  ">Transfere content </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transfere content</li>
        </ol>
        </nav>
    </div>
            <div class="row mb-2">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                    <h4 class="card-title ">Files</h4>
                    </div>

                </div>

                <div class="  col-md-12">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="logest-tab" data-bs-toggle="tab" href="#logest" role="tab" aria-controls="logest" aria-selected="true">Transfer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="monitor-tab" data-bs-toggle="tab" href="#monitor" role="tab" aria-controls="Monitor" aria-selected="false">Monitor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="logs-tab" data-bs-toggle="tab" href="#logs" role="tab" aria-controls="logs" aria-selected="false">Logs</a>
                                </li>

                            </ul>
                            <div class="tab-content" style="padding:25px ;">
                                <!-- tab Logest -->
                                <div class="tab-pane fade active show" id="logest" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mb-2 mt-2">
                                        <div class="  col-md-6" >

                                            <div class="card">
                                                <div class="card-body ">


                                                    <div class="row  ">

                                                        <button style="margin-right : 10px ; " type="button" class="btn btn-primary btn-icon-text col-md-3 ml-1" id="ingest_content">
                                                            <i class="mdi mdi-upload btn-icon-prepend"></i> Transfer
                                                        </button>

                                                        <button type="button" class="btn btn-danger  btn-icon-text col-md-3 ml-1 " id="delete_file">
                                                            <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete
                                                        </button>
                                                    </div>
                                                    <div class="row mt-4">

                                                        <div class="col-xl-12">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                                                                </div>
                                                                <input type="text" class="form-control" id="search_screens_source" placeholder="Search ">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="preview-list multiplex" id="files-listing" style="height: 391.742px; max-height: 391.742px; overflow-y: auto;">

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                        <div class="  col-md-6" >

                                            <div class="card">
                                                <div class="card-body ">
                                                    <div class="d-flex flex-row justify-content-between  mt-2">
                                                        <h4 class="card-title "></h4>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-xl-4">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                                                </div>
                                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                                                    <option selected="">Locations</option>
                                                                    @foreach ($locations as $location )
                                                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-8 ">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                                                                </div>
                                                                <input type="text" class="form-control" id="search_screens_destination" placeholder="Search ">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="preview-list multiplex" id="destination_results" style="height: 401.742px; max-height: 401.742px; overflow-y: auto;">


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
                                    <div class="  col-md-12">

                                        <div class="card">
                                            <div class="card-body ">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <h4 class="card-title ">Multiplex Monitor</h4>
                                                </div>
                                                <div class="row">

                                                    <div class="col-xl-4 ">
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="mdi mdi-magnify"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" id="search_monitor" placeholder="Search ">
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-8 ">
                                                        <button type="button" class="btn btn-secondary custom-btn btn-icon-text" id="refresh_monitoring">
                                                            <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh
                                                        </button>
                                                        <button type="button" class="btn btn-success custom-btn btn-icon-text" id="resume_ingesting">
                                                            <i class="mdi mdi-play btn-icon-prepend"></i> Resume
                                                        </button>
                                                        <button type="button" class="btn btn-primary custom-btn btn-icon-text" id="pause_ingesting">
                                                            <i class="mdi mdi-upload btn-icon-prepend"></i> Pause
                                                        </button>
                                                        <button type="button" class="btn btn-danger custom-btn btn-icon-text" id="cancel_ingesting">
                                                            <i class="mdi mdi-server-remove  btn-icon-prepend"></i> Cancel
                                                        </button>

                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="preview-list multiplex" id="monitor-card">
                                                            <div class="table-responsive">
                                                                <table class="table " id="table_monitor">
                                                                    <thead>
                                                                    <tr style="text-align: center">
                                                                        <th> State</th>
                                                                        <th> Progress</th>
                                                                        <th> Description</th>
                                                                        <th> Creation date</th>
                                                                        <th> Destination </th>
                                                                        <th> Option</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_monitor" style="text-align: center"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs">
                                    <div class="  col-md-12">

                                        <div class="card">
                                            <div class="card-body ">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <h4 class="card-title ">Logs</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                                            </div>
                                                            <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="locations_log">
                                                                <option selected="">Locations</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 ">


                                                        <select class="btn btn-dark  btn-fw" aria-label=".form-select-sm example" id="filter_logs" style="    text-align: left;">
                                                            <option value="all" selected="selected">All
                                                            </option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="Failed">Failed</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>


                                                        <button type="button" class="btn btn-secondary custom-btn btn-icon-text center-block">
                                                            <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh
                                                        </button>


                                                        <button type="button" class="btn btn-danger custom-btn btn-icon-text" id="delete_tasks">
                                                            <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete
                                                        </button>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="preview-list multiplex" id="logs-card" style="height: 619px; max-height: 619px;">
                                                            <div class="table-responsive">
                                                                <table class="table " id="table_logs">
                                                                    <thead>
                                                                    <tr style="text-align: center">
                                                                        <th> State</th>
                                                                        <th> Progress</th>
                                                                        <th> Description</th>
                                                                        <th> Creation date</th>
                                                                        <th> Location</th>
                                                                        <th> Option</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_logs" style="text-align: center"></tbody>
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
            </div>
        </div>
    </div>

    <div class="modal fade " id="no-file-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select File </h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <h4 class="text-center"> No File Selected!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                            data-bs-dismiss="modal" aria-label="Close">OK
                    </button>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="no-location-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select File </h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <h4 class="text-center"> No Location Selected!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                            data-bs-dismiss="modal" aria-label="Close">OK
                    </button>

                </div>

            </div>
        </div>
    </div>

    <div class=" modal fade " id="upload_kdm_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Uploaded Kdms infos </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">


                </div>


            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class="modal fade " id="details_modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Details</h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body row  ">

                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>
@endsection

@section('custom_script')
<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>

<script>

(function($) {
  'use strict';
  $(function() {
    $('#location-listing').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: "_INPUT_",
        searchPlaceholder: "Search..."
      }
    });

  });
})(jQuery);

</script>
<!-- -------END  DATA TABLE ---- -->



<script src="{{asset('/assets/js/tooltips.js')}}"></script>
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<script>
    (function($) {


    function getStatusDownload(status)
    {
        let icon =
            (status == "running") ? "<i class=\"btn btn-primary running-icon custom-icon mdi mdi-play-circle-outline\"   style='margin-left: 1px; font-size: 23px; background: none;      border: 0; color: #297EEE;'   \"></i> Running"
                : status == "Complete" ? "<i class='fa fa-check ' aria-hidden='true' style='color: #60eb47'></i> Complete"
                    : status == "Failed" ? "<i class='fa  fa-exclamation-triangle' aria-hidden='true' style='color: #ff4545 '></i> Failed"
                        : status == "Canceled By User" ? "<i class='fa fa-close' aria-hidden='true' style='color:#b7b7b7;'></i> <span >Canceled By User</span>"
                            : "<i class='fa fa-clock-o' aria-hidden='true' style='color:#ffcb57;'></i> Pending";

        return icon;
    }

    function displayFileTransfere() {

        $.ajax({
            url: '/noc/ingester/action_contoller',
            method: "POST",
            data: {action_control: "get_transfere_content"},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response)
                try {
                    let box_logs = "";
                    let box_pending = "";
                    var obj = JSON.parse(response);
                    var dcp = obj.dcp;
                    var spl = obj.spl;
                    var result="" ;
                    if (dcp.length === 0) {
                        $('#files-listing').html("");
                    } else {
                        for (var i = 0; i < dcp.length; i++) {

                            result = result
                            +'<div data-id_cpl="' + dcp[i].cpl_id + '" data-type="DCP" class="preview-item border-bottom dd-item item-content item_to_select " data-id="' + dcp[i].id + '"  data-uri="/data/assets/35c044fa-d7eb-4e29-8cd9-5bcdabab4918/pkl_17fb0d47-176c-427f-8c99-39803397fd2f.xml">'
                                +'<div class="icon icon-box-primary">'
                                    +'<i class="mdi mdi-content-save-settings text-primary" style="color:#ffab00 !important;"></i>'
                                +'</div>'
                                +'<div class="preview-item-content d-sm-flex flex-grow">'
                                    +'<div class="flex-grow">'
                                        +'<h6 class="preview-subject">'+ dcp[i].cpl_description+'</h6>'
                                    +'</div>'
                                +'</div>'
                            +'</div>' ;


                        }
                        $('#files-listing').html(result);
                    }
                    let height_parent = $('.background-content').height();
                    $("#tab2-1").css("max-height", height_parent - 30);
                    $("#tab2-1").css("overflow-y", "auto");
                    $("#tab2-1").css("max-height", height_parent - 30);
                    $("#tab2-1").css("overflow-y", "auto");
                } catch (e) {
                    console.log(e);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            complete: function (jqXHR, textStatus) {
            }
        });
    }
    displayFileTransfere()

    //select element to Delete
    $(document).on('click', '.item_to_select', function (event) {
        $(this).toggleClass('selected');
    });

    //Delete Files
    $(document).on('click', '#delete_file', function (event) {

        var array_files = [];

        $("#files-listing .item_to_select.selected").each(function() {
                var id = $(this).data("id_cpl");
                array_files.push(id);
            });


        console.log(array_files)
        if (array_files.length ==  0) {
            $("#no-file-selected").modal('show');
        }else{
           var url = "{{  url('') }}"+ '/ingester/delete_transfered_file';
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    array_files:array_files,

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                },
                success: function (response) {
                    if(response)
                    {
                        displayFileTransfere()
                                swal({
                                    title: 'Done!',
                                    text: 'File Deleted Successfully ',
                                    icon: 'success',
                                    button: {
                                        text: "Continue",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                })
                    }
                    else
                    {
                        swal({
                                    title: 'Failed',
                                    text: "Error occurred while sending the request.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3f51b5',
                                    cancelButtonColor: '#ff4081',
                                    confirmButtonText: 'Great ',
                                    buttons: {
                                        cancel: {
                                            text: "Cancel",
                                            value: null,
                                            visible: true,
                                            className: "btn btn-danger",
                                            closeModal: true,
                                        },
                                    }
                                })
                    }


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });
        }
    });

    $(document).on('click', '#ingest_content', function (event) {
       // alert('Comming soon ') ;
       var location =  $('#location').val();

        var array_files = [];
        $("#files-listing  .item-content.selected").each(function() {
            var id = $(this).data("id_cpl");
            array_files.push(id);
        });
        if(location != "Locations")
        {
            if (array_files.length ==  0 ) {
                $("#no-file-selected").modal('show');
            }else{
            var url = "{{  url('') }}"+ '/ingester/generate_torrent_file';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        array_files:array_files,
                        location:location,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                    },
                    success: function (response) {
                        var result ;
                        console.log(response) ;
                        if (response.ingest_status.status == 1 )
                        {
                            if (response.ingest_errors.length> 0 )
                            {

                                $('#cpl_ingest_error').modal('show') ;
                                result = "<h4> Failed Cpls Ingest  </h4>" ;
                                $.each(response.ingest_errors, function( index, value ) {

                                    result = result
                                    +'<p>'
                                        +'<span class="align-middle fw-medium text-danger ">'+value.pkl_description+' </span>'
                                        +'<span class="align-middle fw-medium text-danger "> '+value.message+' </span>'
                                    +'</p>';
                                });

                                if (response.ingest_success.length> 0 )
                                {
                                    result = result + "<br /> <br /> <h4>  Succeeded  kdms Ingest   </h4>" ;
                                    $.each(response.ingest_success, function( index, value )
                                    {
                                        result = result
                                        +'<p>'
                                            +'<span class="align-middle fw-medium text-danger ">'+value.pkl_description+' </span>'
                                            +'<span class="align-middle fw-medium text-danger "> '+value.message+' </span>'
                                        +'</p>';
                                    });
                                }
                                $('#cpl_ingest_error .modal-body').html(result) ;


                            }
                            else
                            {


                                swal({
                                    title: 'Done!',
                                    text: 'Ingest Created Successfully ',
                                    icon: 'success',
                                    button: {
                                        text: "Close",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                })

                            }
                        }
                        else
                        {


                                swal({
                                title: 'Failed',
                                text: "Error occurred while sending the request.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3f51b5',
                                cancelButtonColor: '#ff4081',
                                confirmButtonText: 'Great ',
                                buttons: {
                                    cancel: {
                                        text: "Cancel",
                                        value: null,
                                        visible: true,
                                        className: "btn btn-danger",
                                        closeModal: true,
                                    },
                                }
                            })
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
                    complete: function (jqXHR, textStatus) {
                    }
                });
            }
        }
        else
        {
            $("#no-location-selected").modal('show');
        }
    });

    // search source
    var search_screens_source = document.getElementById('search_screens_source');
    search_screens_source.onkeyup = function () {
        var searchTerms = $(this).val();
        $('#files-listing h6.preview-subject').each(function () {
            var hasMatch = searchTerms.length == 0 ||
                $(this).text().toLowerCase().indexOf(searchTerms.toLowerCase()) > -1;
            $(this).toggle(hasMatch);
        });
    }



    //  Right side

    function get_cpls(location , screen , lms , multiplex,refresh_screen)
    {
        result ="" ;
        var url = "{{  url('') }}"+ '/get_cpl_with_filter/';
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                location: location,
                screen_id: screen,
                multiplex: multiplex,
                lms : lms,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success:function(response)
            {
                console.log(refresh_screen)
                if(refresh_screen != false)
                {
                    screens = '<option value="null" selected>All screen </option>';
                    $.each(response.screens, function( index_screen, screen ) {

                        screens = screens
                            +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                    });
                        $('#screen').html(screens)
                }

                if(response.cpls.length>0)
                {
                    $.each(response.cpls, function( index, value ) {
                        index ++ ;
                        if( value.available_on)
                        {
                            available_on_array =  value.available_on.split(",");
                            available_on_content=""
                            for(i = 0 ; i< available_on_array.length ; i++ )
                            {
                                if(i != 0 &&  i % 9 == 0 )
                                {
                                    available_on_content = available_on_content + '<br />'
                                }
                                available_on_content = available_on_content + '<div class="badge badge-outline-primary m-1">'+ available_on_array[i]+'</div>'
                            }
                        }
                        else
                        {
                            available_on_content=""
                        }


                        playable =""
                        if(value.playable == 1 || lms == true )
                        {
                            playable = "bg-playable" ;
                        }
                        else
                        {
                            playable = "bg-no-playable";
                        }

                        var encrypted="";
                            if(value.pictureEncryptionAlgorithm=="None" || value.pictureEncryptionAlgorithm=="0"){
                                encrypted="";
                            }else{
                                encrypted="<i class=\"cpl_need_kdm mdi btn-success mdi-lock-outline p-1 m-1 rounded\"  ></i> ";
                            }
                            var style = "" ;
                            if(value.type == "Flat")
                            {
                                style = "color:#52d4f7;" ;
                            }
                            else if(value.type == "Scope")
                            {
                                style = "color:#36ffb9;" ;
                            }
                            else
                            {
                                style = "color:white;" ;
                            }
                            /* var style = (value.type == "Flat") ? "color:#52d4f7;" :
                            (value.type == "Scope") ? "color:#36ffb9;" :
                                "color:white;";
                                */

                            var title= '<span style="'+style+'"">' + value.contentTitleText +
                                encrypted +
                                (value.cpl_is_linked == "1" ? ' <span class=\"mdi mdi-calendar-clock custom-calendar p-1 m-1 btn-primary rounded\"  ></span>':"  ")
                                +

                                '  </span>';




                        result = result
                            +'<div class="preview-item border-bottom dd-item item-content " data-uuid="urn:uuid:35c044fa-d7eb-4e29-8cd9-5bcdabab4918" data-description="311023-CowayAis-ENG-030-TGV-19LUFS" data-uri="/data/assets/35c044fa-d7eb-4e29-8cd9-5bcdabab4918/pkl_17fb0d47-176c-427f-8c99-39803397fd2f.xml">'
                                +'<div class="icon icon-box-primary">'
                                    +'<i class="mdi mdi-content-save-settings text-primary" style="color:#ffab00 !important;"></i>'
                                +'</div>'
                                +'<div class="preview-item-content d-sm-flex flex-grow">'
                                    +'<div class="flex-grow">'
                                        +'<h6 class="preview-subject">'+value.contentTitleText+'</h6>'
                                    +'</div>'
                                +'</div>'
                            +'</div>' ;



                    });
                }

                $('#destination_results').html(result)


                /***** refresh datatable **** **/

                var cpl_datatable = $('#location-listing').DataTable({
                    "iDicplayLength": 10,
                    destroy: true,
                    "bDestroy": true,
                    "language": {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });

            },
            error: function(response) {

            }
        })
    }

    $('#location').change(function(){
        $("#location-listing").dataTable().fnDestroy();
            $('#screen').find('option')
        .remove()
        .end()
        .append('<option value="null">All Screens</option>')

        var loader_content  =
        '<div class="jumping-dots-loader">'
            +'<span></span>'
            +'<span></span>'
            +'<span></span>'
            +'</div>'
        $('#location-listing tbody').html(loader_content)
        //$('#location-listing tbody').html('')
        var location =  $('#location').val();
        var country =  $('#country').val();
        var multiplex =  $('#multiplex').val();
        var screen =  null;

        if(location != "Locations")
        {
            //$('#refresh_lms').show();
            get_cpls(location , screen , true , multiplex,true)
        }
        else
        {
            //$('#refresh_lms').hide();
            $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
        }

    });

    // search destination
    var search_screens_destination = document.getElementById('search_screens_destination');
    search_screens_destination.onkeyup = function () {
        var searchTerms = $(this).val();
        $('#destination_results div').each(function () {
            var hasMatch = searchTerms.length == 0 ||
                $(this).text().toLowerCase().indexOf(searchTerms.toLowerCase()) > -1;
            $(this).toggle(hasMatch);
        });
    }


    //Logs
    function calculatePercentage(part, total) {
        if (total === 0) {
            return 0 ;
        }
        return (part / total) * 100;
    }

    function get_logs_tab(location_log,state_log,refresh_locations)
    {
        var url = "{{  url('') }}"+ "/ingest/logs" ;
        var status ="" ;
        $.ajax({
            url: url,
            method: 'GET',
            data :{
                location_log :location_log,
                state_log:state_log
            },
            success:function(response)
            {
                var result ="" ;
                if(refresh_locations)
                {
                    locations_log = '<option value="null" selected>All Location </option>';
                        $.each(response.locations, function( index_location_log, location_log ) {

                            locations_log = locations_log
                                +'<option  value="'+location_log.id+'">'+location_log.name+'</option>';
                        });
                            console.log(locations_log)
                            $('#locations_log').html(locations_log)

                }

                if(response.dcp_trensfers.length>0)
                {
                    $.each(response.dcp_trensfers, function( index, value ) {
                        if(value.status == "Completed")
                        {
                            status ='<span class="mdi mdi-check-all text-success"> Completed </span>' ;
                        }
                        else
                        {
                            status ='<i class="mdi mdi-alert text-danger"> Failed</i> ';
                        }
                        var progress_Percentage = calculatePercentage(value.progress, value.pkl_size)

                        result = result
                            +'<tr class="odd" >'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" >'+status+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+Math.round( progress_Percentage ) +' %</a></td>'

                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" >'+value.cpl_description+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.updated_at+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none">  <span class="btn btn-primary  custom-search mdi mdi-magnify logs_details" data-id="'+ value.id+'" >  </span> </a></td>'

                            +'</tr>';
                    });

                    $('#tbody_logs').html(result)
                }
                else
                {
                    $('#tbody_logs').html('<div id="table_logs_processing" class="dataTables_processing card">No Data</div>')
                }

            },
            error: function(response) {

            }
        })
    }

    $(document).on('click', '#logs-tab', function (e) {
        e.preventDefault();

        var location_log ="null";
        var state_log = "all";
        get_logs_tab(location_log,state_log,true);

    });
    function formatBytes(bytes, decimals = 2) {
        if (!+bytes) return '0 Bytes'

        const k = 1024
        const dm = decimals < 0 ? 0 : decimals
        const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']

        const i = Math.floor(Math.log(bytes) / Math.log(k))

        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
    }
    $(document).on('click', '.logs_details', function (e) {

        e.preventDefault();
        var id  =$(this).attr("data-id") ;
        console.log(id)
        var url = "{{  url('') }}"+ "/ingest/logs_details" ;



        $.ajax({
            url: url,
            method: 'GET',
            data :{
                id :id,
            },
            success:function(response)
            {
                var result ="" ;
                var status="" ;
                var status_text="" ;


                if(response.dcp_trensfer.status == "Completed")
                {
                    status ='mdi mdi-check-all text-success ' ;
                    status_text ='<i class="text-success"> Completed </i>' ;
                }
                if(response.dcp_trensfer.status == "Running")
                {
                    status = ' mdi mdi-check  text-primary';
                    status_text ='<i class="text-primary"> Running</i> ';
                }
                if(response.dcp_trensfer.status == "Pending")
                {

                    status ='mdi mdi-alert  text-warning ';
                    status_text ='<i class="text-warning"> Pending</i> ';
                }
                if(response.dcp_trensfer.status == "Failed")
                {
                    status =' mdi mdi-alert text-danger ';
                    status_text ='<i class="text-danger"> Failed</i> ';
                }



                result = result
                +'<p class="col-md-3"> <i class="align-middle icon-md  mdi mdi-play-circle"> </i> <span> Description  </span></p><p class="col-md-9" style="margin-top:15px"> '+response.dcp_trensfer.cpl_description+' </p>'
                +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-play-circle"> </i> <span> CPL UUID   </span></p><p class="col-md-9" style="margin-top:15px"> '+response.dcp_trensfer.cpl_id+' </p>'
                +'<p class="col-md-3"> <i class="align-middle icon-md  mdi '+status+'"> </i> <span> Status  </span></p><p class="col-md-9" style="margin-top:15px"> '+status_text+' </p>'
                +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi mdi-scale-bathroom"> </i> <span> Size  </span></p><p class="col-md-9" style="margin-top:15px"> '+formatBytes(response.dcp_trensfer.pkl_size)+' </p>'
                +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-home-modern"> </i> <span> Destination  </span></p><p class="col-md-9" style="margin-top:15px"> '+response.dcp_trensfer.name+' </p>'


                $('#details_modal .modal-body  ').html(result);
                $('#details_modal').modal('show');
            },
            error: function(response) {

            }
        })

        // get_logs_tab(location_log,state_log,true);

    });



    $('#locations_log').change(function(){
        var locations_log =  $('#locations_log').val();
        var state_log =  $('#filter_logs').val();
        get_logs_tab(locations_log,state_log, false);
    });
    $('#filter_logs').change(function(){
        var locations_log =  $('#locations_log').val();
        var state_log =  $('#filter_logs').val();
        get_logs_tab(locations_log,state_log ,false);
    });


    function get_monitor_tab()
    {
        var url = "{{  url('') }}"+ "/ingest/monitors" ;
        var status ="" ;
        $.ajax({
            url: url,
            method: 'GET',
            success:function(response)
            {
                var result ="" ;
                if(response.dcp_trensfers.length>0)
                {
                    $.each(response.dcp_trensfers, function( index, value ) {
                        if(value.status == "Running")
                        {
                            status ='<span class="mdi mdi-checkbox-multiple-marked-circle-outline text-primary"> Running </span>' ;
                        }
                        else
                        {
                            status ='<i class="mdi mdi-alert text-warning"> Pending</i> ';
                        }




                        var progress_Percentage = calculatePercentage(value.progress, value.pkl_size)
                        progress_Percentage = Math.round( progress_Percentage )
                        var progress_Percentage_bar = progress_Percentage
                        if(progress_Percentage > 100)
                        {
                            progress_Percentage_bar = 100;
                        }

                        if(progress_Percentage < 100)
                        {
                            var progress_bar =' <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="height: 17px ; width: '+progress_Percentage+'%; " aria-valuenow="'+progress_Percentage+'" aria-valuemin="0" aria-valuemax="100">'+progress_Percentage+' %</div>' ;
                        }
                        else
                        {
                            var progress_bar =' <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="height: 17px ; width: '+progress_Percentage+'%; " aria-valuenow="'+progress_Percentage+'" aria-valuemin="0" aria-valuemax="100">'+progress_Percentage+' %</div>' ;
                        }

                        result = result
                            +'<tr class="odd" >'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" >'+status+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+progress_bar +' </a></td>'
                                +'<td class="cpl-item cpl_description"><a class="text-body align-middle fw-medium text-decoration-none" >'+value.cpl_description+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.updated_at+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none">  <span class="btn btn-primary  custom-search mdi mdi-magnify logs_details" data-id="'+ value.id+'" >  </span> </a></td>'

                            +'</tr>';
                    });

                    $('#tbody_monitor').html(result)
                }
                else
                {
                    $('#tbody_monitor').html('<div id="table_logs_processing" class="dataTables_processing card">No Data</div>')
                }

            },
            error: function(response) {

            }
        })
    }

    $(document).on('click', '#monitor-tab', function (e) {
        e.preventDefault();
        get_monitor_tab();
    });
    const interval = setInterval(function() {
    //    get_monitor_tab();
    }, 5000);


    $("#search_monitor").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_monitor td.cpl_description").filter(function() {
        $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


})(jQuery);
</script>




@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">


@endsection
