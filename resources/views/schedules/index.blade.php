@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header scheduler-shadow">
        <h3 class="page-title">Schedules </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedules</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Schedules</h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 row">
                        <div class="col-xl-4">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                </div>
                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                    <option selected="">Locations</option>
                                    @foreach ($locations as $location )

                                        <option @if($screen) @if( $screen->location->id == $location->id) selected @endif @endif  value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                </div>
                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="screen">
                                    <option value="null">Screens</option>
                                    @if($screens)
                                        @foreach ($screens as $all_screen )
                                            <option @if($all_screen->id == $screen->id) selected @endif  value="{{ $all_screen->id }}">{{ $all_screen->screen_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <button type="button" id="linking_btn" class=" btn btn-primary btn-icon-text" >
                                <i class="mdi mdi-link-variant "></i> Linking </button>
                        </div>
                    </div>
                    <div class="col-md-6 row " id="scheduleDate" style="display: none">

                        <div class="col-xl-3 justify-content-end d-flex " >
                            <button type="button" id="btnPrevDate" class="btn btn-icon-text " style="color: rgb(111, 111, 111); background: rgb(42, 48, 56); height: 37px;">
                                <i class="mdi mdi-arrow-left"></i>Prev
                            </button>
                        </div>
                        <div class="col-xl-6 " >
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                                <input type="text" class="form-control"  id="scheduleDatePicker">

                            </div>
                        </div>
                        <div class="col-xl-3  d-flex " >
                            <button type="button" id="btnNextDate" class="btn btn-icon-text " style="color: rgb(111, 111, 111); background: rgb(42, 48, 56); height: 37px;">
                                Next <i class="mdi mdi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Type #</th>
                                    <th class="sorting">Screen</th>
                                    <th class="sorting">Movie </th>
                                    <th class="sorting">Date/Time </th>
                                    <th class="sorting">Spl</th>
                                    <th class="sorting">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($screen)
                                    @foreach ($screen->spls as $key => $spl )
                                        <tr class="odd">
                                            <td class="sorting_1"><a>{{ $spl->id }}</a> </td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->name }}</a> <br /></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->available_on }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->duration }}</a></td>
                                            <td>
                                                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#infos_modal" href="#"><i class="mdi mdi-magnify"> </i> </a>


                                            </td>

                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=" modal fade " id="infos_modal" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="Properties-tab" data-bs-toggle="tab" href="#Properties" role="tab" aria-controls="home" aria-selected="true">Properties</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="cpls-tab" data-bs-toggle="tab" href="#cpls" role="tab" aria-controls="Content CPLs" aria-selected="false">Content CPLs</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="schedules-tab" data-bs-toggle="tab" href="#schedules" role="tab" aria-controls="schedules" aria-selected="false">Related Schedules</a>
                        </li>
                      </ul>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">

                    <div class="tab-content border-0">
                        <div class="tab-pane fade show active" id="Properties" role="tabpanel" aria-labelledby="Properties-tab">
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media  justify-content-start">
                                        <div class="media-body d-flex align-items-center">
                                            <i class=" mdi mdi-star icon-sm align-self-center me-3"></i>
                                            <h6 class="mb-1">Title : </h6>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted">  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media  d-flex justify-content-start">
                                        <div class="media-body d-flex align-items-center">
                                            <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                            <h6 class="mb-1">UUID : </h6>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted">  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded border mb-2">
                                <div class="card-body p-3">
                                    <div class="media  d-flex justify-content-start mr-5">
                                        <div class="media-body d-flex align-items-center">
                                            <i class="mdi mdi-timer icon-sm align-self-center me-3"></i>
                                            <h6 class="mb-1">Duration : </h6>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted">    </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cpls" role="tabpanel" aria-labelledby="cpls-tab">
                            <div class="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>UUID</th>
                                            <th>CPL Name</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
                        </div>
                    </div>


                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="linking_modal" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="no_linked_spls_movies_tab" data-bs-toggle="tab" href="#no_linked_spls_movies" role="tab" aria-controls="home" aria-selected="true">No linked</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="linked_spls_movies_tab" data-bs-toggle="tab" href="#linked_spls_movies" role="tab" aria-controls="Content CPLs" aria-selected="false">Linked </a>
                        </li>

                      </ul>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="tab-content border-0">
                        <div class="tab-pane fade show active" id="no_linked_spls_movies" role="tabpanel" aria-labelledby="no_linked_spls_movies_tab-tab">
                            <div class="row " >
                                <div class="col-md-6  preview-list multiplex" >
                                    <table class="table" id="movies_table">
                                        <thead>
                                            <tr>
                                                <th>Movies</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6  preview-list multiplex">
                                    <table class="table" id="spls_table">
                                        <thead>
                                            <tr>
                                                <th>SPL</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row " >
                                <div class="col-md-12 " >
                                    <button type="button" id="link_spl_movies_btn" class=" btn btn-primary btn-icon-text " style="float: right">
                                    <i class="mdi mdi-check "></i> Link </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="linked_spls_movies" role="tabpanel" aria-labelledby="linked_spls_movies-tab">
                            <div class="row " >
                                <div class="col-md-12  preview-list multiplex" >
                                    <table class="table" id="linked_movies_spl_table">
                                        <thead>
                                            <tr>
                                                <th>Movies</th>
                                                <th>SPL</th>

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
        <!--end modal-content-->
        </div>
    </div>

    <div class="modal fade " id="no-location-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select Location </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
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

    <div class="modal fade " id="ingest_spl" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select Location </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">This SPL does not exist on this location, would you like to ingest it?</h4>
                </div>
                <div class="modal-footer">
                    <button id="submit-ingest-form" type="button" style="margin: auto" class="btn btn-secondary btn-fw "
                            >OK
                    </button>


                </div>

            </div>
        </div>
    </div>
    <div class=" modal fade " id="ingest-response" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" style="border: 1px solid #5f5a5a">
            <div class="modal-content border-0">

                <div class="modal-header p-4 pb-0">
                    <h5></h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="" id="ingest-response-content" >

                    </div>
                    <div class="row mt-2">
                        <div class="col" style="text-align: center">
                            <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


    <!--   delete spl -->
    <div class="modal fade show" id="unlink-spl" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog"   role="document">
            <div class="modal-content" style="background: #000000">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Unlink</h5>
                    <button type="button"  data-bs-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <input type="hidden" id="id-mivie-to-unlink">
                <div class="modal-body">

                </div>
                <div class="modal-footer" style="display: block;text-align: center">
                    <button type="button" class="btn btn-success" id="confirm_inlink">Confirm</button>
                    <button type="button" class="btn btn-light"  data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>

    </div>


    <div class=" modal fade " id="missing_cpls_schedule_check" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" >
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>Missing Cpls </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div id="missing_cpls"></div>
                    <div id="unplayble_cpls"></div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="check_need_kdm_model" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" >
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>missing KDMs </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

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
<!-- -------END  DATA TABLE ---- -->
<script src="https://kendo.cdn.telerik.com/2021.2.616/js/kendo.all.min.js"></script>

<script src="{{asset('/assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

<script>

(function($) {
        showSwal = function(type) {
        if (type === 'success-message') {
            swal({
                title: 'Congratulations!',
                //text: 'SPL and movie are linked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }
        if (type === 'link-spl') {
            swal({
                title: 'Done!',
                text: 'SPL and movie are linked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }

        if (type === 'unlink-spl') {
            swal({
                title: 'Done!',
                text: 'SPL and movie are unlinked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }

        if (type === 'warning-message-and-cancel') {
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

        }

    })(jQuery);


    (function($) {

        var spl_datatable = $('#location-listing').DataTable({
        "iDisplayLength": 10,
            destroy: true,
            "bDestroy": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }

        });

        $('#screen').change(function(){

            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

            var country =  $('#country').val();
            var screen =  $('#screen').val();
            var date = new Date($('#scheduleDatePicker').val());
            var location =  $('#location').val();


            var url = "{{  url('') }}"+ '/get_schedules_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen+'&date='+ date.toLocaleDateString('en-GB')+' 00';

            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    $.each(response.schedules, function( index, value ) {
                        bg_status="" ;
                        if(value.status !="linked" )
                        {
                            bg_status = "bg-danger"
                        }
                        icon_spl = ""
                        icon_cpl = ""
                        icon_kdm = ""
                        statu_content=""
                        if(value.status !="linked" )
                        {
                            icon_spl = '<i class="mdi mdi-playlist-play text-danger"> </i>'
                            statu_content = '<spn class="text-danger" >Unlinked  </span>'
                        }
                        else
                        {
                            icon_spl =  '<i class="mdi mdi-playlist-play text-success"> </i>'
                            statu_content = '<spn class="text-success" > Linled</span>'
                        }

                        if(value.cpls ==1)
                        {
                            icon_cpl = '<i class="mdi mdi-filmstrip text-success">'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-warning ">'
                            }
                            else
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-danger   spl_not_linked" data-scheduleidd = "'+value.id+'">'
                            }
                            //icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {

                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
                            }
                            else
                            {
                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-danger check_need_kdm" data-scheduleidd = "'+value.id+'"> </i>'

                            }
                        }


                        result = result
                            +'<tr class="odd ">'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.type+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen.screen_name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ icon_spl + icon_cpl + icon_kdm +' </i></a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+statu_content+'</a></td>'
                            +'</tr>';
                    });
                    console.log(response.schedules)

                    $('#location-listing tbody').html(result)
                    /***** refresh datatable ***** */

                    var spl_datatable = $('#location-listing').DataTable({

                        "iDisplayLength": 10,
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




        });

        $('#location').change(function(){

            $("#location-listing").dataTable().fnDestroy();
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

             $('#screen').find('option')
            .remove()
            .end()
            .append('<option value="null">All Screens</option>')


            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  null;
            var date = new Date($('#scheduleDatePicker').val());

            if(location != "Locations")
            {
                $('#scheduleDate').show();
            }
            else
            {
                $('#scheduleDate').hide();
            }

            var url = "{{  url('') }}"+ '/get_schedules_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen+'&date='+ date.toLocaleDateString('en-GB')+' 00';
            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log(response)
                    screens = '<option value="null" selected>All Screens</option>';
                    $.each(response.screens, function( index_screen, screen ) {

                        screens = screens
                            +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                    });
                        $('#screen').html(screens)

                    $.each(response.schedules, function( index, value ) {
                        bg_status="" ;
                        if(value.status !="linked" )
                        {
                            bg_status = "bg-danger"
                        }

                        icon_spl = ""
                        icon_cpl = ""
                        icon_kdm = ""
                        statu_content=""
                        if(value.status !="linked" )
                        {
                            icon_spl = '<i class="mdi mdi-playlist-play text-danger"> </i>'
                            statu_content = '<spn class="text-danger" >Unlinked  </span>'
                        }
                        else
                        {
                            icon_spl =  '<i class="mdi mdi-playlist-play text-success"> </i>'
                            statu_content = '<spn class="text-success" > Linled</span>'
                        }

                        if(value.cpls ==1)
                        {
                            icon_cpl = '<i class="mdi mdi-filmstrip text-success">'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-warning ">'
                            }
                            else
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-danger   spl_not_linked" data-scheduleidd = "'+value.id+'">'
                            }
                            //icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {

                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
                            }
                            else
                            {
                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-danger check_need_kdm" data-scheduleidd = "'+value.id+'"> </i>'

                            }
                        }


                        result = result
                            +'<tr class="odd ">'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.type+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen.screen_name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ icon_spl + icon_cpl + icon_kdm +' </i></a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+statu_content+'</a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)

                    console.log(response.schedules)
                    /***** refresh datatable **** **/

                    var spl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 10,
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

        });
        $(document).on('click', '#linking_btn , #no_linked_spls_movies_tab', function () {

            var location =  $('#location').val();
            if(location == 'Locations')
            {
                $('#no-location-selected').modal('show');
            }
            else
            {
                $('#linking_modal').modal('show');

                var loader_content  =
                '<div class="jumping-dots-loader">'
                    +'<span></span>'
                    +'<span></span>'
                    +'<span></span>'
                    +'</div>'
                $('#movies_table tbody').html(loader_content)
                $('#spls_table tbody').html(loader_content)

            var url = "{{  url('') }}"+ "/get_spl_and_movies/"+location ;
                var movies_table="" ;
                var noc_spl_table="";

            $.ajax({
                    url: url,
                    method: 'GET',

                    success:function(response)
                    {
                        //console.log(response.spl.name) ;
                        $.each(response.movies, function( index, value ) {
                            movies_table +=
                            '<tr>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.id+'"  >'+ value.title+' </td>'
                            '</tr >'
                        });
                        $('#movies_table tbody').html(movies_table)

                        $.each(response.nos_spls, function( index, value ) {
                            noc_spl_table +=
                            '<tr>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.id+'"  >'+ value.spl_title+' </td>'
                            '</tr >'

                        });
                        $('#spls_table tbody').html(noc_spl_table)

                    },
                    error: function(response) {

                    }
            })
            }





        });

        $(document).on('click', '#linked_spls_movies_tab', function () {

            var location =  $('#location').val();
                var loader_content  =
                '<div class="jumping-dots-loader">'
                    +'<span></span>'
                    +'<span></span>'
                    +'<span></span>'
                    +'</div>'
                $('#linked_movies_spl_table tbody').html(loader_content)

            var url = " {{  url('') }}"+ "/get_spl_and_movies_linked/"+location ;

                var movies_table="" ;


            $.ajax({
                    url: url,
                    method: 'GET',

                    success:function(response)
                    {
                        //console.log(response)
                        //console.log(response.spl.name) ;
                        $.each(response.movies, function( index, value ) {
                            movies_table +=
                            '<tr id="'+value.id+'">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.id+'"  >'+ value.title+' </td>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.nocspl.id+'"  >'+ value.nocspl.spl_title+' </td>'
                            '</tr >'
                        });
                        $('#linked_movies_spl_table tbody').html(movies_table)



                    },
                    error: function(response) {

                    }
            })






        });

        $(document).on('click', '#movies_table td', function () {
            $('#movies_table td').removeClass('selected') ;
            $(this).addClass('selected') ;
        })

        $(document).on('click', '#spls_table td', function () {
            $('#spls_table td').removeClass('selected') ;
            $(this).addClass('selected') ;
        })

        $(document).on('click', '#link_spl_movies_btn', function () {

            var spl_id = $('#spls_table td.selected').attr('data-id') ;
            var movie_id = $('#movies_table td.selected').attr('data-id') ;

            $.ajax({
                url:"{{  url('') }}"+ "/add_movies_to_spls",
                type: 'post',
                cache: false,
                data: {
                    movie_id: movie_id,
                    spl_id: spl_id,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    swal({
                        title: 'Refreshing',
                        allowEscapeKey: false,
                        allowOutsideClick: true,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {



                    if(response == "Success")
                    {
                        swal.close();
                        $('#spls_table td').removeClass('selected') ;
                        $('#movies_table td.selected').remove() ;
                        showSwal('link-spl') ;
                    }
                    else if(response == "missing")
                    {
                        swal.close();
                        $('#ingest_spl').modal('show') ;
                    }
                    else
                    {
                        swal.close();
                        showSwal('warning-message-and-cancel')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });




        })

        $(document).on('click', '#linked_movies_spl_table tbody tr', function () {
            movie_id = $(this).attr("id") ;
            movie_title = $(this).children('td:first-child').text()
            spl_title = $(this).children('td:nth-child(2)').text()


            $('#unlink-spl .modal-body').html('<p> Do you want to unlink '+movie_title+' from '+spl_title+'</p>')
            $('#id-mivie-to-unlink').val(movie_id) ;
            $('#unlink-spl').modal('show')

        })

        $(document).on('click', '#confirm_inlink', function () {
            var movie_id = $('#id-mivie-to-unlink').val() ;
            var location =  $('#location').val();
            $.ajax({
                url:"{{  url('') }}"+ "/unlink_spl_movie",
                type: 'post',
                cache: false,
                data: {
                    movie_id: movie_id,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    swal({
                        title: 'Refreshing',
                        allowEscapeKey: false,
                        allowOutsideClick: true,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if(response == "Success")
                    {
                        swal.close();
                        $('#unlink-spl').modal('hide')
                        $('#'+movie_id+'').remove() ;
                        showSwal('unlink-spl') ;
                    }
                    else
                    {
                        swal.close();
                        showSwal('warning-message-and-cancel')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });
        })

        $(document).on('click', '#submit-ingest-form', function ()
        {
            var spl_id = $('#spls_table td.selected').attr('data-id') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/sendXmlFileToApi";
            $('#ingest_spl').modal('hide');

            /*var uuid =  $('#nos-spl').val();
            var ingest_location =  $('#ingest-location').val();
            var duration = $('#nos-spl option').data('duration');
            var title = $('#nos-spl option').data('title');
            var apiUrl = $('#ingest-location option').data('locationip');*/


           // var apiUrl ="http://localhost/tms/system/api2.php" ;
            //path = $('#nos-spl option:selected').data('filepath');

            $.ajax({
                url:url,

                method: 'POST',
                cache: false,
                data: {
                    spl_id: spl_id,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {

                    try {
                        var missing_cpls  ;
                        $("#ingest-modal").modal('hide');
                        if(response.status == 1)
                        {
                            missing_cpls ='<p class="text-success">'+response.success+'</p>' ;
                            if(response.missing_cpls.length > 0)
                            {
                                missing_cpls +=
                                    '<p> there are CPLs missing in this location</p>'
                                    +'<table class="table">'
                                        +'<thead>'
                                            +'<tr>'
                                                +'<th>UUID </th>'
                                                +'<th>Title</th>'
                                            +'</tr>'
                                        +'</thead>'
                                        +'<tbody>'


                                $.each(response.missing_cpls, function(index, value) {
                                    missing_cpls +=
                                            '<tr>'
                                                +'<td style="font-size: 14px;">'+value.CPLId+'</td>'
                                                +'<td style="font-size: 14px;">'+value.AnnotationText+'</td>'
                                            +'</tr>' ;

                                })
                                missing_cpls +=
                                    '</tbody>'
                                    +'</table>' ;

                            }
                            $("#ingest-response").modal('show');
                                $('#ingest-response #ingest-response-content ').html(missing_cpls)
                        }
                        else
                        {
                            $("#ingest-response").modal('show');
                            $('#ingest-response #ingest-response-content ').html('<p class="text-danger">Error occurred while sending the request.</p>')
                        }

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


        });



        $(document).on('click', '.spl_not_linked', function ()
        {
            var schedule_idd = $(this).attr('data-scheduleidd') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/get_unlinked_spl";
            var missing_cpls ="<h5 class=''> Missing CPLs </h5>" ;
            var unplayable_cpls ="<h5 class='mt-4'> Unplayble CPLs </h5>" ;
            $.ajax({
                url:url,

                method: 'GET',
                cache: false,
                data: {
                    schedule_idd: schedule_idd,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if(response.missing_cpls.length > 0)
                    {
                        missing_cpls +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.missing_cpls, function(index, value) {
                        missing_cpls +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        missing_cpls +=
                            '</tbody>'
                            +'</table>' ;
                            $("#missing_cpls_schedule_check").modal('show');
                            $('#missing_cpls_schedule_check #missing_cpls ').html(missing_cpls)
                    }
                    else
                    {
                        missing_cpls +=
                        '<p> No Data </p>'
                        $("#missing_cpls_schedule_check").modal('show');
                        $('#missing_cpls_schedule_check #missing_cpls').html(missing_cpls)
                    }

                    if(response.unplayable_cpls.length > 0)
                    {
                        unplayable_cpls +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.unplayable_cpls, function(index, value) {
                            unplayable_cpls +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        unplayable_cpls +=
                            '</tbody>'
                            +'</table>' ;
                            $("#missing_cpls_schedule_check").modal('show');
                            $('#missing_cpls_schedule_check #unplayble_cpls').html(unplayable_cpls)
                    }
                    else
                    {
                        unplayable_cpls +=
                        '<p> No Data </p>'
                        $("#missing_cpls_schedule_check").modal('show');
                        $('#missing_cpls_schedule_check #unplayble_cpls').html(unplayable_cpls)
                    }


                    console.log(response)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        });

        $(document).on('click', '.check_need_kdm', function ()
        {
            var schedule_idd = $(this).attr('data-scheduleidd') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/get_need_kdm";
            var missing_kdms ="" ;

            $.ajax({
                url:url,

                method: 'GET',
                cache: false,
                data: {
                    schedule_idd: schedule_idd,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if(response.missing_kdms.length > 0)
                    {
                        missing_kdms +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.missing_kdms, function(index, value) {
                        missing_kdms +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        missing_kdms +=
                            '</tbody>'
                            +'</table>' ;
                            $("#check_need_kdm_model").modal('show');
                            $('#check_need_kdm_model .modal-body ').html(missing_kdms)
                    }
                    else
                    {
                        missing_kdms +=
                        '<p> No Data </p>'
                        $("#check_need_kdm_model").modal('show');
                        $('#check_need_kdm_model .modal-body').html(missing_kdms)
                    }
                    console.log(response)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        });



    })(jQuery);

</script>

<script>
     $(document).on('click', '.infos_modal', function () {

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#Properties').html(loader_content)

        window.spl_id = $(this).attr("id") ;

        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    //console.log(response.spl.name) ;

                        result =
                        '<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  justify-content-start">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class=" mdi mdi-star icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">Title :  </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.name + ' </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  d-flex justify-content-start">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class="mdi mdi-star icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">UUID : </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.uuid + ' </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  d-flex justify-content-start mr-5">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class="mdi mdi-timer icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">Duration : </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.duration + '   </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'




                    $('#Properties').html(result)





                },
                error: function(response) {

                }
        })

     });

     $(document).on('click', '#cpls-tab', function () {

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#cpls').html(loader_content)
        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;

        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    //console.log(response.spl.name) ;
                    result =
                        '<div class="">'
                            +'<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID</th>'
                                        +'<th>CPL Name</th>'

                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'

                    $.each(response.cpls, function( index, value ) {

                    result = result
                                    +'<tr>'
                                        +'<th>'+value.uuid+'</th>'
                                        +'<th>'+value.contentTitleText+'</th>'

                                    +'</tr>'
                    });
                    result = result
                                +'</tbody>'
                            +'</table>'
                        +'</div>'
                    $('#cpls').html(result)





                },
                error: function(response) {

                }
        })

    });

    $(document).on('click', '#schedules-tab', function () {

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#schedules').html(loader_content)
        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log() ;
                    if(response.schedules.length)
                    {
                        result =
                            '<div class="">'
                                +'<table class="table">'
                                    +'<thead>'
                                        +'<tr>'
                                            +'<th>Date</th>'
                                            +'<th>Screen Name</th>'
                                            +'<th>Screen Number</th>'
                                        +'</tr>'
                                    +'</thead>'
                                    +'<tbody>'

                        $.each(response.schedules, function( index, value ) {

                        result = result
                                        +'<tr>'
                                            +'<th>'+value.ContentKeysNotValidBefore+'</th>'
                                            +'<th>'+value.screen_name+'</th>'
                                            +'<th>'+value.screen_number+'</th>'

                                        +'</tr>'
                        });
                        result = result
                                    +'</tbody>'
                                +'</table>'
                            +'</div>'
                        $('#schedules').html(result)
                    }
                    else
                    {
                        $('#schedules').html('No data ')
                    }



                },
                error: function(response) {

                }
        })

    });


</script>



<script>
    (function($) {


         var currentDate = new Date();
         var selectedDate = new Date();
         var startDate = new Date();
         var endDate = new Date();

         selectedDate.setDate(currentDate.getDate());
         startDate.setDate(currentDate.getDate() - 7);
         endDate.setDate(currentDate.getDate() + 7);

         $("#scheduleDatePicker").kendoDatePicker({
            value: selectedDate,
            min: startDate,
            max: endDate,
            change: function (e) {

                var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');

                selectedDate.setDate(datepicker.value().getDate());

                if (selectedDate.getDate() == endDate.getDate()) {
                     $('#btnNextDate').prop('disabled', true);
                 } else if (selectedDate.getDate() == startDate.getDate()) {
                     $('#btnPrevDate').prop('disabled', true);
                 }

                 if (selectedDate.getDate() != endDate.getDate()) {
                     $('#btnNextDate').prop('disabled', false);
                 }
                 if (selectedDate.getDate() != startDate.getDate()) {
                     $('#btnPrevDate').prop('disabled', false);
                 }

            }
         });

         $('#btnPrevDate').on('click', function () {
            $('#btnPrevDate').prop('disabled', true);
            var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');
            selectedDate.setDate(selectedDate.getDate() - 1);
            datepicker.value(selectedDate);

            $('#btnNextDate').prop('disabled', false);

            if (selectedDate.getDate() == startDate.getDate()) {
                $(this).prop('disabled', true);
            }

           $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  $('#screen').val();

            var url = "{{  url('') }}"+ '/get_schedules_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen +'&date='+ selectedDate.toLocaleDateString('en-GB')+' 00' ;
            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    $.each(response.schedules, function( index, value ) {
                        bg_status="" ;
                        if(value.status !="linked" )
                        {
                            bg_status = "bg-danger"
                        }

                        icon_spl = ""
                        icon_cpl = ""
                        icon_kdm = ""
                        statu_content=""
                        if(value.status !="linked" )
                        {
                            icon_spl = '<i class="mdi mdi-playlist-play text-danger"> </i>'
                            statu_content = '<spn class="text-danger" >Unlinked  </span>'
                        }
                        else
                        {
                            icon_spl =  '<i class="mdi mdi-playlist-play text-success"> </i>'
                            statu_content = '<spn class="text-success" > Linled</span>'
                        }

                        if(value.cpls ==1)
                        {
                            icon_cpl = '<i class="mdi mdi-filmstrip text-success">'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-warning ">'
                            }
                            else
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-danger   spl_not_linked" data-scheduleidd = "'+value.id+'">'
                            }
                            //icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {

                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
                            }
                            else
                            {
                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-danger check_need_kdm" data-scheduleidd = "'+value.id+'"> </i>'

                            }
                        }

                        result = result
                            +'<tr class="odd ">'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.type+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen.screen_name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ icon_spl + icon_cpl + icon_kdm +' </i></a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+statu_content+'</a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)
                    $('#btnPrevDate').prop('disabled', false);
                    console.log(response.schedules)
                    /***** refresh datatable **** **/

                    var spl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 10,
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


         });

         $('#btnNextDate').on('click', function () {
            $('#btnNextDate').prop('disabled', true);
            var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');
            selectedDate.setDate(selectedDate.getDate() + 1);
            datepicker.value(selectedDate);

            $('#btnPrevDate').prop('disabled', false);

            if (selectedDate.getDate() == endDate.getDate()) {
                $(this).prop('disabled', true);
            }

            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  $('#screen').val();

            var url = "{{  url('') }}"+ '/get_schedules_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen +'&date='+ selectedDate.toLocaleDateString('en-GB')+' 00' ;
            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {



                    $.each(response.schedules, function( index, value ) {
                        bg_status="" ;
                        if(value.status !="linked" )
                        {
                            bg_status = "bg-danger"
                        }

                        icon_spl = ""
                        icon_cpl = ""
                        icon_kdm = ""
                        statu_content=""
                        if(value.status !="linked" )
                        {
                            icon_spl = '<i class="mdi mdi-playlist-play text-danger"> </i>'
                            statu_content = '<spn class="text-danger" >Unlinked  </span>'
                        }
                        else
                        {
                            icon_spl =  '<i class="mdi mdi-playlist-play text-success"> </i>'
                            statu_content = '<spn class="text-success" > Linled</span>'
                        }

                        if(value.cpls ==1)
                        {
                            icon_cpl = '<i class="mdi mdi-filmstrip text-success">'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-warning ">'
                            }
                            else
                            {
                                icon_cpl = '<i class="mdi mdi-filmstrip text-danger   spl_not_linked" data-scheduleidd = "'+value.id+'">'
                            }
                            //icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            if(value.status !="linked" )
                            {

                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
                            }
                            else
                            {
                                icon_kdm = '</i> <i class="mdi mdi-key-remove text-danger check_need_kdm" data-scheduleidd = "'+value.id+'"> </i>'

                            }
                        }

                        result = result
                            +'<tr class="odd ">'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.type+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen.screen_name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ icon_spl + icon_cpl + icon_kdm +' </i></a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+statu_content+'</a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)
                    $('#btnNextDate').prop('disabled', false);
                    console.log(response.schedules)
                    /***** refresh datatable **** **/

                    var spl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 10,
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

         });
    })(jQuery);
</script>
@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2021.2.616/styles/kendo.default-v2.min.css"/>

<style>
    #scheduleDatePicker
    {
        background: #2a3038;
        border-radius: 0;
        color: #4b5564 ;
    }
    .k-select
    {
        display: none !important ;
    }
</style>
@endsection
