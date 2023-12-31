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


@endsection

@section('custom_script')

<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<!-- -------END  DATA TABLE ---- -->
<script src="https://kendo.cdn.telerik.com/2021.2.616/js/kendo.all.min.js"></script>

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

            if(screen == 'null')
            {
                var location =  $('#location').val();

            }
            else
            {
                var location =  null;
            }

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
                            icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
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

        $(' #location').change(function(){

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
                            icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
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
                            icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
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
                            icon_cpl = '<i class="mdi mdi-filmstrip text-warning">'
                        }

                        if(value.kdm  ==1 )
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-change text-success"> </i>'
                        }
                        else
                        {
                            icon_kdm = '</i> <i class="mdi mdi-key-remove text-warning"> </i>'
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
