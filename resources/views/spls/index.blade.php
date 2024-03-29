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
                            <button type="button" id="refresh_lms"  class="btn btn-icon-text " style="color: #6f6f6f;background: #2a3038; height: 37px; display:none">
                                <i class="mdi mdi-server-network"></i> LMS </button>
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


@endsection

@section('custom_script')
<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script>


</script>
<!-- -------END  DATA TABLE ---- -->


<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
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
})(jQuery);
</script>

<script>


    // filter location
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


        function get_spls(location , screen , lms , refresh_screen)
        {
            result =" " ;
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
                    $.each(response.spls, function( index, value ) {
                        index++ ;
                        if(value.available_on)
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
                            available_on_content="" ;
                        }



                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+index +' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+available_on_content+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                            +'<td><a class="btn btn-primary infos_modal" data-bs-toggle="modal" data-bs-target="#infos_modal" href="#" id="'+value.id+'"> <i class="mdi mdi-magnify"> </i> </a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)

                    console.log(response.spls)
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

        }

        $('#screen').change(function(){

            var location =  $('#location').val();
            if(this.id == "screen")
            {
                lms=false ;
                $('#lms_screen').hide();
                var screen =  $('#screen').val();
                get_spls(location , screen , lms , false)
            }
            else
            {
                lms= true ;
                var screen =  $('#lms_screen_content').val();
                get_spls(location , screen , lms , false)
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

            if(location != "Locations")
            {
                $('#refresh_lms').show();
                get_spls(location , screen , false , true)
            }
            else
            {
                $('#refresh_lms').hide();
                $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')

            }





        });

        $('#refresh_lms').click(function(){

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
            window.lms = true ;
            var screen =  null;


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
                                if(i != 0 &&  i % 9 == 0 )
                                {
                                    available_on_content = available_on_content + '<br />'
                                }
                                available_on_content = available_on_content + '<div class="badge badge-outline-primary m-1">'+ available_on_array[i]+'</div>'
                            }
                        }
                        else
                        {
                            available_on_content="" ;
                        }

                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+ index +' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+available_on_content+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                            +'<td><a class="btn btn-primary infos_modal" data-bs-toggle="modal" data-bs-target="#infos_modal" href="#" id="'+value.id+'"> <i class="mdi mdi-magnify"> </i> </a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)

                    console.log(response.spls)
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

        $('#Properties-tab').addClass('active');
        $('#cpls-tab').removeClass('active');
        $('#schedules-tab').removeClass('active');
        $('#Properties').addClass('show active ');
        $('#cpls').removeClass('show active');
        $('#schedules').removeClass('show active');

        if(lms == true )
        {
            var url = "{{  url('') }}"+ "/get_lmsspl_infos/"+spl_id ;
            $('#schedules-tab').hide();
        }
        else
        {
            var url = "{{  url('') }}"+ "/get_spl_infos/"+spl_id ;
            $('#schedules-tab').show();
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

        if(lms == true )
        {
            var url = "{{  url('') }}"+ "/get_lmsspl_infos/"+spl_id ;
        }
        else
        {
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
        var url = "{{  url('') }}"+ "/get_spl_infos/"+spl_id ;
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
                                            +'<th>Date</th>'
                                            +'<th>Screen Name</th>'
                                            +'<th>Screen Number</th>'
                                        +'</tr>'
                                    +'</thead>'
                                    +'<tbody>'

                        $.each(response.schedules, function( index, value ) {

                        result = result
                                        +'<tr>'
                                            +'<th>'+value.date_end+'</th>'
                                            +'<th>'+value.screen.screen_name+'</th>'
                                            +'<th>'+value.screen.screen_number+'</th>'

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

    $(".preview-item").click(function() {

        $(this).toggleClass("selected");
    });
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

</style>
@endsection
