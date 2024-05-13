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

                            </ul>
                            <div class="tab-content" style="height: 567px; max-height: 567px;">
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
                                                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Search ">
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
                                                        <div class="preview-list multiplex" id="parent_table_monitoring" style="height: 411.742px; max-height: 411.742px;">
                                                            <div class="table-responsive">
                                                                <table class="table " id="table_monitoring" style="overflow-y: auto;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th> State</th>
                                                                        <th> Destination</th>
                                                                        <th> Progress</th>
                                                                        <th> Contenty Type</th>
                                                                        <th> Description</th>
                                                                        <th> Creation date</th>

                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="table_monitoring_body" style="overflow-y: hidden;"><div class="no-screen-select-msg">Tasks List Empty !</div></tbody>
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

                            <!--<div class="row">

                                    <div class="preview-list multiplex" id="div_ingest_logs">
                                        <div class="table-responsive">
                                            <table class="table " id="files-listing">
                                                <thead>
                                                <tr>
                                                    <th> State</th>
                                                    <th> File Name</th>
                                                    <th> Available On On</th>

                                                </tr>
                                                </thead>
                                                <tbody id="body_ingest_logs"></tbody>
                                            </table>
                                        </div>
                                    </div>

                            </div> -->

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


<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="{{asset('/assets/js/tooltips.js')}}"></script>
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<script>
    (function($) {

    @if (session('message'))

        $.toast({
            heading: 'Success',
            text: '{{ session("message") }}',
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right',
            timeout: 5000
        })
    @endif
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

        var array_files = [];
        $("#files-listing  .item-content.selected").each(function() {
            var id = $(this).data("id_cpl");
            array_files.push(id);
        });
        console.log(array_files)
        if (array_files.length ==  0 ) {
            $("#no-file-selected").modal('show');
        }else{
        var url = "{{  url('') }}"+ '/ingester/generate_torrent_file';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    array_files:array_files,

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
            $('#refresh_lms').show();
            get_cpls(location , screen , true , multiplex,true)
        }
        else
        {
            $('#refresh_lms').hide();
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




})(jQuery);
</script>




@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">


@endsection
