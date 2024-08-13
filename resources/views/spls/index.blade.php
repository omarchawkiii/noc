@extends('layouts.app')
@section('title') Show Playlist  @endsection
@section('content')
    <div class="page-header playlistbuilder-shadow">
        <h3 class="page-title">SPLS </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">SPLS</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">SPLS</h4>
                    </div>
                    <div>
                        <button id="refresh" class="btn btn-light btn-fw  btn-icon-text"> <i class="mdi mdi-reload btn-icon-prepend"></i> Refresh</button>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 row">
                        <div class="col-xl-2">
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

                        <div class="col-xl-2">
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
                        <div class="col-xl-2">
                            <button type="button" class="btn btn-danger btn-icon-text" id="delete_spl">
                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete
                            </button>
                        </div>
                        <div class="col-xl-2">
                            <button type="button" class="btn btn-danger btn-icon-text" id="clean_spl">
                                <i class="mdi mdi-delete-sweep btn-icon-prepend"></i> Clean SPLs
                            </button>
                        </div>

                        <div class="col-xl-2">
                            <button type="button" id="refresh_lms"  class="btn btn-icon-text " style="color: #6f6f6f;background: #2a3038; height: 37px; display:none">
                                <i class="mdi mdi-server-network"></i> LMS </button>
                        </div>
                        <div class="col-xl-2">
                            <button type="button" class="btn btn-icon-text" id="noc_local_storage"  style="color: #6f6f6f;background: #2a3038; height: 37px; ">
                                <i class="mdi mdi-file-tree btn-icon-prepend"></i> NOC Local Storage
                            </button>
                        </div>

                    </div>

                </div>

                <div class="col-12">
                    <div class="table-responsive  preview-list multiplex ">
                        <table id="location-listing" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">No #</th>
                                    <th class="sorting">Playlist</th>
                                    <th class="sorting">Available On </th>
                                    <th class="sorting">Duration </th>
                                    <th class="sorting">Action</th>
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
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">  </p>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">  </p>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">    </p>
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

    <div class="modal fade " id="empty-warning-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel"  aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="mdi mdi-alert btn btn-warning"></i> Warning
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group" style="text-align: center">
                                    <label id="warning-content"> No SPLs Selected </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col" style="text-align: center">
                                <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="spl_delete_model" tabindex="-1" aria-labelledby="ModalLabel"aria-modal="true" role="dialog">
        <div class="modal-dialog" style="max-width: 60%; width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <h5 class="modal-title" id=" " style="font-size: 23px;">
                        <i class="mdi mdi-delete-sweep custom-search  btn-inverse-danger "></i>SPL Deletion </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="list_s">
                    <form class="row">

                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-inverse-primary btn-fw" style="background: none;  border-radius: 0;  text-align: left;margin-bottom: 9px;">
                                <input type="checkbox" class="check_all form-check-input " name="check_all_server" id="check_all_server" style="font-size: 20px;">
                                <label for="check_all_server" class="style_label_deletion" style="font-size: 20px;">
                                    All Screens Storage </label>
                            </button>
                            <ul class="list_deletion all_screens" id="list_servers_spls_to_delete">
                                <li>
                                    <button type="button" class="btn btn-outline-secondary btn-fw" style="text-align: left;">
                                        <label class="form-check-label custom-check2">
                                            <input type="checkbox" class="form-check-input check_all" name="screen_to_ingest" id="" value="" style="font-size: 20px;margin-bottom:  3px">
                                            <span style="font-weight: bold;">Screen-01</span> <i class="input-helper"></i>
                                        </label>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <div class="spinner-border text-danger  " id="delete_cpl_progress" style="display: none;" role="status">
                        <span class="sr-only"> </span>
                    </div>

                    <div class="row" id="deleted_cpls"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirm_delete_cpl_group" class="btn btn-danger" style=" margin: auto;font-size: 21px;font-weight: bold;" data-dismiss="modal">
                        Create Delete Task
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="spl_deleted_model" tabindex="-1" aria-labelledby="ModalLabel"aria-modal="true" role="dialog">
        <div class="modal-dialog" style="max-width: 60%; width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <h5 class="modal-title" id=" " style="font-size: 23px;">
                        <i class="mdi mdi-delete-sweep custom-search  btn-inverse-danger "></i>SPL Deletion Infos </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" >


                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="spl_to_clean_model" tabindex="-1" aria-labelledby="ModalLabel"aria-modal="true" role="dialog">
        <div class="modal-dialog" style="max-width: 60%; width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <h5 class="modal-title" id=" " style="font-size: 23px;">
                        <i class="mdi mdi-delete-sweep custom-search  btn-inverse-danger "></i>Screen SPLs to Clean  </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="spl_to_clean_table">
                        <thead>
                            <tr>
                                <th>UUID</th>
                                <th>SPL Name</th>
                                <th>Issue Date</th>

                            </tr>
                        </thead>
                        <tbody>

                      </tbody>
                    </table>
                </div>
                <div class="modal-footer" style=" margin: auto;">
                    <button type="button" id="confirm_clean_spl" class="btn btn-danger"  data-dismiss="modal">
                        Confirm
                    </button>
                    <button  data-bs-dismiss="modal" aria-label="Close" type="button"  class="btn btn-light" data-dismiss="modal" >
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('custom_script')
<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>


<script>


    // filter location
    (function($) {

        function sToTime(s) {
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;

            return hrs + ':' + mins + ':' + secs;
        }
        var spl_datatable = $('#location-listing').DataTable({
        "iDisplayLength": 100,
            destroy: true,
            "bDestroy": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });

        function get_spls(location , screen , lms , refresh_screen,noc_local_storage)
        {
            result =" " ;
            var head="" ;
            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)
            var url = "{{  url('') }}"+ '/get_spl_with_filter';
            $.ajax({
                url: url,
                data: {
                    location: location,
                    screen: screen,
                    lms : lms,
                    noc_local_storage:noc_local_storage,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                success:function(response)
                {
                    console.log(response)
                    if(refresh_screen)
                    {
                        screens = '<option value="null" selected>All Screens</option>';
                        $.each(response.screens, function( index_screen, screen ) {
                            screens = screens
                                +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                        });
                        $('#screen').html(screens)
                        $('#lms_screen_content').html(screens)
                    }

                    if( noc_local_storage)
                    {
                        head ='<tr>'
                                +'<th class="sorting sorting_asc">No #</th>'
                                +'<th class="sorting">Playlist</th>'
                                +'<th class="sorting">Duration </th>'
                                +'<th class="sorting">Is Template </th>'
                                +'<th class="sorting">Action</th>'
                            +'</tr>'

                        $.each(response.spls, function( index, value ) {
                            index++ ;

                            var is_template='No' ;
                            if(value.is_template == 1 )
                            {
                                is_template='Yes' ;
                            }

                            var duration =  sToTime(value.duration);
                            result = result
                                +'<tr class="odd" data-id="'+value.uuid+'">'
                                +'<td class="sorting_1 cpl-item">'+index +' </td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.spl_title+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+ duration +'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+is_template+'</a></td>'
                                +'<td > <a href="#" id="'+value.uuid+'" href="" class="btn btn-success   mdi mdi-download download_spl" ></a></td>'
                                +'</tr>';
                        });
                    }
                    else
                    {
                        head ='<tr>'
                                +'<th class="sorting sorting_asc">No #</th>'
                                +'<th class="sorting">Playlist</th>'
                                +'<th class="sorting">Available On </th>'
                                +'<th class="sorting">Duration </th>'
                                +'<th class="sorting">Action</th>'
                            +'</tr>'


                        $.each(response.spls, function( index, value ) {
                            index++ ;
                            if(value.available_on)
                            {
                                available_on_array =  value.available_on.split(",");
                                available_on_content=""
                                for(i = 0 ; i< available_on_array.length ; i++ )
                                {
                                    if(available_on_array[i] != " " && available_on_array[i] != "" && available_on_array[i] != "  ")
                                    {
                                        if(i != 0 &&  i % 9 == 0  )
                                        {
                                            available_on_content = available_on_content + '<br />'
                                        }
                                        available_on_content = available_on_content + '<div class="badge badge-outline-primary m-1">'+ available_on_array[i]+'</div>'
                                    }
                                }
                            }
                            else
                            {
                                available_on_content="" ;
                            }

                            result = result
                                +'<tr class="odd" data-id="'+value.uuid+'">'
                                +'<td class="sorting_1 cpl-item">'+index +' </td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+available_on_content+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                                +'<td ><a class="btn btn-primary infos_modal"  href="#" id="'+value.id+'"> <i class="mdi mdi-magnify"> </i>  </a> <a  href="#" id="'+value.uuid+'" href="" class="btn btn-success   mdi mdi-download download_spl" ></a></td>'
                                +'</tr>';
                        });
                    }
                    $('#location-listing thead').html(head)
                    $('#location-listing tbody').html(result)



                    var spl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 100,
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

        $('#screen').change(function(){

            var location =  $('#location').val();
            $('#refresh_lms').removeClass("activated") ;
            if(this.id == "screen")
            {
                lms=false ;
                $('#lms_screen').hide();
                var screen =  $('#screen').val();
                get_spls(location , screen , lms , false, false)
            }
            else
            {
                lms= true ;
                var screen =  $('#lms_screen_content').val();
                get_spls(location , screen , lms , false, false)
            }
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
            window.lms = false ;
            $('#refresh_lms').removeClass("activated") ;
            if(location != "Locations")
            {
                $('#refresh_lms').show();
                get_spls(location , screen , false , true, false)
            }
            else
            {
                $('#refresh_lms').hide();
                $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
            }

        });

        $('#refresh_lms').click(function(){

            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            window.lms = true ;
            var screen =  null;

            if( $('#refresh_lms').hasClass("activated"))
            {
                get_spls(location , screen , false , true, false)
                $('#refresh_lms').removeClass("activated") ;
            }
            else
            {
                head ='<tr>'
                                +'<th class="sorting sorting_asc">No #</th>'
                                +'<th class="sorting">Playlist</th>'
                                +'<th class="sorting">Available On </th>'
                                +'<th class="sorting">Duration </th>'
                                +'<th class="sorting">Action</th>'
                            +'</tr>'
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

                var url = "{{  url('') }}"+ '/get_spl_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen+'&lms='+ lms;
                result =" " ;

                $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response)
                    {

                        screens = '<option value="null" selected>All Screens</option>';
                        $.each(response.screens, function( index_screen, screen ) {

                            screens = screens
                                +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                        });
                            $('#screen').html(screens)

                        $.each(response.spls, function( index, value ) {
                            index++ ;
                            if(value.available_on)
                            {
                                available_on_array =  value.available_on.split(",");
                                available_on_content=""

                                    for(i = 0 ; i< available_on_array.length ; i++ )
                                    {
                                        if(available_on_array[i] != " " && available_on_array[i] != "" && available_on_array[i] != "  ")
                                        {

                                            if(i != 0 &&  i % 9 == 0 )
                                            {
                                                available_on_content = available_on_content + '<br />'
                                            }
                                            available_on_content = available_on_content + '<div class="badge badge-outline-primary m-1">'+ available_on_array[i]+'</div>'
                                        }
                                    }

                            }
                            else
                            {
                                available_on_content="" ;
                            }

                            result = result
                                +'<tr class="odd"  data-id="'+value.uuid+'">'
                                +'<td class="cpl-item class="sorting_1">'+ index +' </td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+available_on_content+'</a></td>'
                                +'<td class="cpl-item"><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                                +'<td><a class="btn btn-primary infos_modal"  href="#" id="'+value.id+'"> <i class="mdi mdi-magnify"> </i>  </a> <a  href="#" id="'+value.uuid+'" href="" class="btn btn-success   mdi mdi-download download_spl" ></a></td>'
                                +'</tr>';
                        });
                        $('#refresh_lms').addClass("activated") ;
                        $('#location-listing thead').html(head)
                        $('#location-listing tbody').html(result)

                        console.log(response.spls)
                        /***** refresh datatable **** **/

                        var spl_datatable = $('#location-listing').DataTable({
                            "iDisplayLength": 100,
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

        });

        $('#noc_local_storage').click(function(){
            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var lms = false ;
            var screen =  null;

            $('#screen').find('option')
            .remove()
            .end()
            .append('<option value="null">All Screens</option>')

            if( $('#noc_local_storage').hasClass("activated"))
            {
                $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
                $('#noc_local_storage').removeClass("activated") ;
                $('#refresh_lms').removeClass("activated") ;
                $('#refresh_lms').hide();
            }
            else
            {
                $("#location").val('Locations');
                get_spls(location , screen , false ,'null', true, true)
                $(this).addClass("activated") ;
                $('#refresh_lms').removeClass("activated") ;
                $('#refresh_lms').hide();

            }
        });


        $(document).on('click', '.cpl-item', function (event) {
            $(this).parent('tr').toggleClass('selected');
        });
        $(document).ready(function() {
            // Handle the change event of the #check_all_server checkbox
            $('#check_all_server').change(function() {
                // Check if the #check_all_server checkbox is checked
                if ($(this).is(':checked')) {
                    // If checked, set all checkboxes within the list to checked
                    $('#list_servers_spls_to_delete').find('input[type="checkbox"]').prop('checked', true);
                } else {
                    // If unchecked, set all checkboxes within the list to unchecked
                    $('#list_servers_spls_to_delete').find('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
        $(document).on('click', '#delete_spl', function (event) {

            var screen =  $('#screen').val();
            var multiplex =  $('#multiplex').val();
            var array_spls = [];
            var location = $('#location').val() ;
            var lms = false ;
            if( $('#noc_local_storage').hasClass("activated"))
            {
                var noc_local_storage = true ;
            }
            else
            {
                var noc_local_storage = false ;
            }
            if( $('#refresh_lms').hasClass("activated"))
            {
                lms = true ;
            }
            else
            {
                lms = false ;
            }

            $("#location-listing tr.selected").each(function() {
                var id = $(this).data("id");
                array_spls.push(id);
            });

            $('#check_all_server').prop('checked', false);

            if (array_spls.length ==  0) {
                $("#empty-warning-modal").modal('show');
            }else{

                if(noc_local_storage)
                {
                    $.ajax({
                        url : "{{  url('') }}"+ '/spls/delete_spls',
                        type: 'GET',
                        data: {
                            array_spls:array_spls,
                            lms:false,
                            noc_local_storage:noc_local_storage
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                        },
                        success: function (response) {
                            result ="" ;
                            if (response.status )
                            {
                                swal({
                                    title: 'Done !',
                                    text: 'NOC Local Storage SPLs Deleted Successfully ',
                                    icon: 'success',
                                    button: {
                                        text: "Ok",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                })
                                //get_cpls(location , screen , true , multiplex,noc_local_storage)
                                get_spls(location , screen , false , multiplex, true)

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
                else
                {
                    var url = "{{  url('') }}"+ '/get_screens_from_spls/';
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            array_spls:array_spls,
                            location :location,
                            lms:lms,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                        },
                        success: function (response) {

                            var result = '<li>'
                                        +'<button type="button" class="btn btn-outline-secondary btn-fw" style="text-align: left;">'
                                            +'<label class="form-check-label custom-check2">'
                                                +'<input id="delete_from_lms" type="checkbox" class="form-check-input" name="lms" style="font-size: 20px;margin-bottom:  3px; margin-right:  5px">'
                                                +'<span style="font-weight: bold; display: inline-block; margin-top: 6px;">LMS</span> <i class="input-helper"></i>'
                                            +'</label>'
                                        +'</button>'
                                    +'</li>' ;

                                $.each(response.screens, function( index, value ) {

                                    if(value.playback_status == "Unknown")
                                    {
                                        result =  result +
                                        '<li>'
                                            +'<button type="button" class="btn btn-outline-secondary btn-fw" style="text-align: left;">'
                                                +'<label class="form-check-label custom-check2">'
                                                    +'<input disabled="true" type="checkbox" class="form-check-input" name="screen_to_ingest" data-id="'+value.id_server+'" value="'+value.id_server+'" style="font-size: 20px;margin-bottom:  3px; margin-right:  5px">'
                                                    +'<span style=" color:red; font-weight: bold; display: inline-block; margin-top: 6px;"> '+value.name+' ( Screen offline ) </span> <i class="input-helper"></i>'
                                                +'</label>'
                                            +'</button>'
                                        +'</li>'

                                    }
                                    else
                                    {
                                        result =  result +
                                        '<li>'
                                            +'<button type="button" class="btn btn-outline-secondary btn-fw" style="text-align: left;">'
                                                +'<label class="form-check-label custom-check2">'
                                                    +'<input type="checkbox" class="form-check-input" name="screen_to_ingest" data-id="'+value.id_server+'" value="'+value.id_server+'" style="font-size: 20px;margin-bottom:  3px; margin-right:  5px">'
                                                    +'<span style="font-weight: bold; display: inline-block; margin-top: 6px;">'+value.name+'</span> <i class="input-helper"></i>'
                                                +'</label>'
                                            +'</button>'
                                        +'</li>'
                                    }

                                });

                                $('#list_servers_spls_to_delete').html(result)
                                $('#spl_delete_model').modal('show')

                                $('#confirm_delete_cpl_group').click(function(){
                                    var array_screens = [];
                                $("#list_servers_spls_to_delete [name='screen_to_ingest']:checked").each(function() {
                                        var screen_id = $(this).data("id");
                                        array_screens.push(screen_id);
                                    });

                                    var delete_from_lms = $('#delete_from_lms' ).is(":checked")
                                    if(delete_from_lms)
                                    {
                                        delete_from_lms = 1 ;
                                    }
                                    else
                                    {
                                        delete_from_lms = 0 ;
                                    }

                                    $.ajax({
                                        url : "{{  url('') }}"+ '/spls/delete_spls',
                                        type: 'GET',
                                        data: {
                                            array_spls:array_spls,
                                            location :location,
                                            array_screens:array_screens,
                                            lms:delete_from_lms,
                                            noc_local_storage:noc_local_storage
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        beforeSend: function () {
                                        },
                                        success: function (response) {
                                            result ="" ;
                                            if (response.status )
                                            {
                                                if (response.errors.length> 0 )
                                                {

                                                    $('#spl_deleted_model').modal('show') ;
                                                    result = "<h4> Failed  Spls Deleted</h4>" ;
                                                    $.each(response.errors, function( index, value ) {

                                                        result = result
                                                        +'<p>'
                                                            +'<span class="align-middle fw-medium text-danger ">'+value.uuid+' |  </span>'
                                                            +'<span class="align-middle fw-medium text-danger "> '+value.ShowTitleText+' </span>'
                                                            +'<span class="align-middle fw-medium text-danger "> : '+value.status+' </span>'
                                                            +'<span class="align-middle fw-medium text-success" > From Screen : '+value.screen+' </span>'
                                                        +'</p>';
                                                    });
                                                }

                                                if (response.deleted_spls.length> 0 )
                                                {
                                                    result = result + "<br /> <br /> <h4>  Succeeded  SPLs Deleted   </h4>" ;
                                                        $.each(response.deleted_spls, function( index, value ) {

                                                            result = result
                                                            +'<p>'
                                                                +'<span class="align-middle fw-medium text-success">'+value.uuid+' |</span>'
                                                                +'<span class="align-middle fw-medium text-success" >'+value.ShowTitleText+' </span>'
                                                                +'<span class="align-middle fw-medium text-success" >'+value.status+' </span>'
                                                                +'<span class="align-middle fw-medium text-success" > From Screen : '+value.screen+' </span>'
                                                            +'</p>';
                                                        });
                                                }

                                                $('#spl_delete_model').modal('hide');
                                                $('#spl_deleted_model .modal-body').html(result) ;
                                                $('#spl_deleted_model').modal('show') ;
                                                //showSwal('warning-message-and-cancel')
                                                if( $('#refresh_lms').hasClass("activated"))
                                                {
                                                    get_spls(location , screen , true , multiplex, false)
                                                }
                                                else
                                                {
                                                get_spls(location , screen , false , multiplex, false)
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


                                    console.log(array_screens)

                                });

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        complete: function (jqXHR, textStatus) {
                        }
                    });
                }

            }
        });

        $(document).on('click', '.download_spl', function (event) {
            var spl_id = $(this).attr("id") ;
            var location = $('#location').val() ;

            var url = "{{  url('') }}"+ '/spls/download_spl/';
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    spl_id:spl_id,
                    location :location
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                },
                success: function (response) {
                    console.log(response)
                    var blob = new Blob([response], { type: "application/xml" });
                        if (window.navigator.msSaveBlob) {
                            // Pour Internet Explorer et Microsoft Edge
                            window.navigator.msSaveBlob(blob, spl_id + '.xml');
                        } else {
                            // Pour les autres navigateurs
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = spl_id + '.xml';
                            link.click();
                        }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        });

        $(document).on('click', '#refresh', function () {
            var location = $('#location').val() ;
            var screen =  null ;

            if( $('#refresh_lms').hasClass("activated"))
            {
                lms = true ;
                var url ="{{  url('') }}"+ "/refresh_lmsspl_content/"+location;
            }
            else
            {
                lms = false ;
                var url ="{{  url('') }}"+ "/refresh_spl_content/"+location;
            }

            if(location == 'Locations')
            {
                swal({
                        title: '',
                        text: "Please Select Locaion.",
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
            else
            {
                $.ajax({
                        url:url,
                        type: 'get',

                        beforeSend: function () {
                            swal({
                                title: 'Refreshing',
                                closeOnEsc: false,
                                allowOutsideClick: false,
                                timerProgressBar: true,
                                onOpen: () => {
                                    swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            swal.close();
                            if(response.status)
                            {

                                 get_spls(location , screen , lms , true)

                                swal({
                                        title: 'Done !',
                                        text: 'Data Refreshed Successfully ',
                                        icon: 'success',
                                        button: {
                                            text: "Ok",
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
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        complete: function(jqXHR, textStatus) {}
                });
            }
        });

        $(document).on('click', '#clean_spl', function (event) {

            var location = $('#location').val() ;
            var screen =  $('#screen').val();
            var lms = false ;
            if( $('#refresh_lms').hasClass("activated"))
            {
                lms = true ;
                $('#spl_to_clean_model h5.modal-title').html("LMS SPLs to Clean")
            }
            else
            {
                lms = false ;
                $('#spl_to_clean_model h5.modal-title').html("Screen SPLs to Clean")
            }
            if(screen == 'null' && lms == false )
            {
                swal({
                        title: '',
                        text: "Please Select Locaion And Screen .",
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
            else
            {


                var url = "{{  url('') }}"+ '/spls/clean_spls/';
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        location :location,
                        lms :lms ,
                        screen:screen
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                    },
                    success: function (response) {
                        if(response.list_spls.length>0 )
                        {
                            var result="" ;
                            $.each(response.list_spls, function( index, value ) {
                                result =  result +
                                    '<tr>'
                                        +'<td>'+value.uuid+'</td>'
                                        +'<td>'+value.title+'</td>'
                                        +'<td>'+value.IssueDate+'</td>'
                                    +'</t>'
                            });


                            $('#spl_to_clean_table tbody').html(result)
                            $('#spl_to_clean_model').modal('show');

                            /*$('#confirm_clean_spl').click(function(){

                                $.ajax({
                                    url : "{{  url('') }}"+ '/cpls/confirm_clean_cpls/',
                                    type: 'GET',
                                    data: {
                                        location :location,
                                        lms :lms,
                                        screen:screen
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    beforeSend: function () {
                                    },
                                    success: function (response) {
                                        result ="" ;
                                        if (response.status )
                                        {

                                            $('#cpl_delete_model').modal('hide');
                                            $('#cpl_deleted_model .modal-body').html(result) ;
                                            $('#cpl_deleted_model').modal('show') ;
                                            //showSwal('warning-message-and-cancel')
                                            if( $('#refresh_lms').hasClass("activated"))
                                            {
                                                get_cpls(location , screen , true , multiplex)
                                            }
                                            else
                                            {
                                                get_cpls(location , screen , false , multiplex)
                                            }

                                        } else {
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

                            });*/

                        }
                        else
                        {
                            swal({
                                title: '',
                                text: "Nothnothing To Delete .",
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

    })(jQuery);

</script>

<script>
     $(document).on('click', '.infos_modal', function (e) {
        e.preventDefault() ;

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#Properties').html(loader_content)

        window.spl_id = $(this).attr("id") ;

        $('#Properties-tab').addClass('active');
        $('#cpls-tab').removeClass('active');
        $('#schedules-tab').removeClass('active');
        $('#Properties').addClass('show active ');
        $('#cpls').removeClass('show active');
        $('#schedules').removeClass('show active');

        if(lms == true )
        {
            var url = "{{  url('') }}"+ "/get_lmsspl_infos/"+spl_id ;
            //$('#schedules-tab').hide();
        }
        else
        {
            var url = "{{  url('') }}"+ "/get_spl_infos/"+spl_id ;
            //$('#schedules-tab').show();
        }

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
                                            +'<p class="mb-0  m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 "> '+ response.spl.name + ' </p>'
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
                                            +'<p class="mb-0  m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 "> '+ response.spl.uuid + ' </p>'
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
                                            +'<p class="mb-0  m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 "> '+ response.spl.duration + '   </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'




                    $('#Properties').html(result)

                    $('#infos_modal').modal('show');



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
        var lms ;
        if( $('#refresh_lms').hasClass("activated"))
        {
            lms = true ;
            var url = "{{  url('') }}"+ "/get_lmsspl_infos/"+spl_id ;
        }
        else
        {
            lms = false ;
            var url = "{{  url('') }}"+ "/get_spl_infos/"+spl_id ;
        }




        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log(response.cpls) ;
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
                                        +'<th>'+value.CompositionPlaylistId+'</th>'
                                        +'<th>'+value.AnnotationText+'</th>'

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
        if(lms == true )
        {
            var url = "{{  url('') }}"+ "/get_lmsspl_infos/"+spl_id ;
            //$('#schedules-tab').hide();
        }
        else
        {
            var url = "{{  url('') }}"+ "/get_spl_infos/"+spl_id ;
            //$('#schedules-tab').show();
        }
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log(response) ;
                    if(response.schedules.length)
                    {
                        result =
                            '<div class="">'
                                +'<table class="table">'
                                    +'<thead>'
                                        +'<tr>'
                                            +'<th>Start Time</th>'
                                            +'<th>Movie Title</th>'
                                            +'<th>screen_name</th>'
                                        +'</tr>'
                                    +'</thead>'
                                    +'<tbody>'

                        $.each(response.schedules, function( index, value ) {

                        result = result
                                        +'<tr>'
                                            +'<th>'+value.date_start+'</th>'
                                            +'<th>'+value.ShowTitleText+'</th>'
                                            +'<th>'+value.screen.screen_name+'</th>'

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
    let content_height = document.querySelector('.content-wrapper').offsetHeight;
    let navbar_height = document.querySelector('.navbar').offsetHeight;
    //let footer_height = document.querySelector('.footer').offsetHeight;
    let page_header_height = document.querySelector('.page-header ').offsetHeight;
    let content_max_height = content_height - navbar_height - page_header_height - 150;

    $(".multiplex").height(content_max_height);

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /*$(".preview-item").click(function() {

        $(this).toggleClass("selected");
    });*/
</script>
@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">

<style>

.dataTables_processing.card,
.jumping-dots-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 200px;
    margin-left: -100px;
    margin-top: -26px;
    text-align: center;
    padding: 1em 0;
}


#list_servers_spls_to_delete ,#list_servers_spls_to_delete{
        list-style: none;
    }

    #list_servers_spls_to_delete li {
        float: left;
        font-size: 20px;
        margin: 3px;
    }
    #list_servers_spls_to_delete li {
        float: left;
        font-size: 20px;
        margin: 3px;
    }
    #list_servers_spls_to_delete li button {
        width: 171px !important;
    }


</style>
@endsection
