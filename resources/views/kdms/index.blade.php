@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header playlistbuilder-shadow">
        <h3 class="page-title">KDMs </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">KDMs</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">KDMs</h4>
                    </div>
                </div>
                <div class="row">

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

                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Screen </th>

                                    <th class="sorting" style="width: 150px;">Content Name </th>
                                    <th class="sorting" style="width: 150px;">Begin Validity </th>
                                    <th class="sorting" style="width: 150px;">End Validity </th>
                                    <th class="sorting" style="width: 150px;">Content Present  </th>
                                    <th class="sorting " style="width: 150px;">Notes</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($screen)
                                    @foreach ($screen->kdms as $key => $kdm )
                                        <tr class="odd">
                                            <td class="sorting_1"><a>{{ $kdm->id }}</a> </td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $kdm->uuid }}</a> <br /></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $kdm->name }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $kdm->ContentKeysNotValidBefore }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $kdm->ContentKeysNotValidAfter }}</a></td>
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

    function dhm (ms) {
    const days = Math.floor(ms / (24*60*60*1000));
    const daysms = ms % (24*60*60*1000);
    const hours = Math.floor(daysms / (60*60*1000));
    const hoursms = ms % (60*60*1000);
    const minutes = Math.floor(hoursms / (60*1000));
    const minutesms = ms % (60*1000);
    const sec = Math.floor(minutesms / 1000);
    return days + "D " + hours + "H " + minutes + "M " + sec  + "S ";
    }


    (function($) {
    'use strict';
    $(function() {



    });
    })(jQuery);



    // filter location
    (function($) {

        var kdm_datatable = $('#location-listing').DataTable({

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
            if(screen == 'null')
            {
                var location =  $('#location').val();

            }
            else
            {
                var location =  null;
            }

            var url = '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;

            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    $.each(response.kdms, function( index, value ) {

                        if(value.content_present == 'yes' ){
                            content_present = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            content_present = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
                        }

                        const date1 = new Date();
                        const date2 = new Date(value.ContentKeysNotValidAfter);
                        let diffTime = Math.abs(date2 - date1);

                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        background_difftime=""

                        if(diffTime/100/60/60 > 48 )
                        {
                            background_difftime = "bg-success"
                            console.log(diffTime)
                        }
                        if(diffTime/100/60/60 < 48  && diffTime/100/60/60 > 0 )
                        {
                            background_difftime = "bg-warning"
                        }
                        if(diffTime/100/60/60 <= 0 )
                        {
                            background_difftime = "bg-danger"
                        }


                        result = result
                            +'<tr class="odd '+background_difftime+'">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.screen.screen_name+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">'+value.name+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+value.ContentKeysNotValidBefore+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+value.ContentKeysNotValidAfter+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                            +'</tr>';
                        });
                    console.log(response.kdms)

                    $('#location-listing tbody').html(result)
                    /***** refresh datatable ***** */

                    var kdm_datatable = $('#location-listing').DataTable({

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
            var screen =  null;

            var url = '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;
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

                    $.each(response.kdms, function( index, value ) {

                        if(value.content_present == 'yes' ){
                            content_present = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            content_present = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
                        }

                        const date1 = new Date();
                        const date2 = new Date(value.ContentKeysNotValidAfter);
                        let diffTime = Math.abs(date2 - date1);

                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        background_difftime=""

                        if(diffTime/100/60/60 > 48 )
                        {
                            background_difftime = "bg-success"
                            console.log(diffTime)
                        }
                        if(diffTime/100/60/60 < 48  && diffTime/100/60/60 > 0 )
                        {
                            background_difftime = "bg-warning"
                        }
                        if(diffTime/100/60/60 <= 0 )
                        {
                            background_difftime = "bg-danger"
                        }


                        result = result
                            +'<tr class="odd '+background_difftime+'">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.screen.screen_name+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">'+value.name+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+value.ContentKeysNotValidBefore+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+value.ContentKeysNotValidAfter+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)

                    console.log(response.kdms)
                    /***** refresh datatable **** **/

                    var kdm_datatable = $('#location-listing').DataTable({
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
@endsection
