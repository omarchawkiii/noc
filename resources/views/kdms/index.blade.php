@extends('layouts.app')
@section('title') KDMs  @endsection
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
                    <div class="col-md-6 row ">
                        <div class="col-xl-3">
                            <button type="button" id="refresh_lms"  class="btn btn-icon-text " style="color: #6f6f6f;background: #2a3038; height: 37px; display:none">
                                <i class="mdi mdi-server-network"></i> LMS </button>
                        </div>

                        <div class="col-xl-4" style="display:none" id="lms_screen">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                </div>
                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="lms_screen_content">
                                    <option value="null">LMS Screen </option>
                                    @if($screens)
                                        @foreach ($screens as $all_screen )
                                            <option @if($all_screen->id == $screen->id) selected @endif  value="{{ $all_screen->id }}">{{ $all_screen->screen_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <a href="{{ route('spls.upload_spl', ['upload_missing_kmds'=>true]) }}" id=""  class="btn btn-icon-text "  style="color: #fff;background: #852b94; height: 37px; margin:auto; display : table ">
                                <i class="mdi mdi-upload "></i> Upload KDMs </a>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive preview-list multiplex">
                        <table id="location-listing" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Screen </th>

                                    <th class="sorting">Content Name </th>
                                    <th class="sorting">Begin Validity </th>
                                    <th class="sorting">End Validity </th>
                                    <th class="sorting">Content present</th>
                                    <th class="sorting">KDM</th>
                                    <th class="sorting ">Notes</th>
                                    <th class="sorting ">Device Target</th>

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

    function dhm (ms)
    {
        const days = Math.floor(ms / (24*60*60*1000));
        const daysms = ms % (24*60*60*1000);
        const hours = Math.floor(daysms / (60*60*1000));
        const hoursms = ms % (60*60*1000);
        const minutes = Math.floor(hoursms / (60*1000));
        const minutesms = ms % (60*1000);
        const sec = Math.floor(minutesms / 1000);
        return days + "D " + hours + "H " + minutes + "M " + sec  + "S ";
    }


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

        $('#screen , #lms_screen_content').change(function(){

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

            var location =  $('#location').val();
            if(this.id == "screen")
            {
                lms=false ;
                $('#lms_screen').hide();
                var screen =  $('#screen').val();
                $('#refresh_lms').removeClass("activated") ;
            }
            else
            {
                lms= true ;
                $('#refresh_lms').addClass("activated") ;
                var screen =  $('#lms_screen_content').val();
            }
            var url ="{{  url('') }}"+ '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen+'&lms='+ lms;

            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    $.each(response.kdms, function( index, value ) {

                        if(value.content_present == 'yes' ){
                            content_present = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; "> '
                        }else{
                            content_present = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                        }

                        if(value.kdm_installed == 'yes' ){
                            kdm_installed = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; ">'
                        }else{
                            kdm_installed = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                        }

                        /*const date1 = new Date();
                        const date2 = new Date(value.ContentKeysNotValidAfter);
                        let diffTime = Math.abs(date1 - date2);*/


                        const date1 = new Date(); // Date actuelle
                        const date2String = value.ContentKeysNotValidAfter; // Chaîne représentant la date

                        // Convertir la chaîne en objet Date
                        const date2 = new Date(date2String);

                        let diffTime = date2 - date1;

                        // Pour obtenir la différence en jours par exemple :
                        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));



                        //const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        background_difftime=""

                        if(diffTime/100/60/60 > 48 )
                        {
                            background_difftime = "bg-success"
                        }
                        if(diffTime/100/60/60 < 48  && diffTime/100/60/60 > 0 )
                        {
                            background_difftime = "bg-warning"
                        }
                        if(diffTime/100/60/60 <= 0 )
                        {
                            background_difftime = "bg-danger"
                        }

                        if(value.screen)
                        {
                            screen_name = value.screen.screen_name
                        }
                        else
                        {
                            screen_name = value.device_target;
                        }


                        result = result
                            +'<tr class="odd '+background_difftime+'">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ screen_name +' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidBefore).toLocaleString() +'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidAfter).toLocaleString() +'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">'+ kdm_installed+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">  '+value.device_target+' </a></td>'
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
            $('#refresh_lms').removeClass("activated") ;
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

            $('#lms_screen').hide();
            if(location != "Locations")
            {
                $('#refresh_lms').show();
                var url ="{{  url('') }}"+  '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;
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
                            $('#screen').html(screens);
                            $('#lms_screen_content').html(screens)

                        $.each(response.kdms, function( index, value ) {

                            if(value.content_present == 'yes' ){
                                content_present = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; "> '
                            }else{
                                content_present = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                            }

                            if(value.kdm_installed == 'yes' ){
                                kdm_installed = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; ">'
                            }else{
                                kdm_installed = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                            }


                            const date1 = new Date();
                            const date2 = new Date(value.ContentKeysNotValidAfter);
                            let diffTime = Math.abs(date2 - date1);

                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                            background_difftime=""

                            if(diffTime/100/60/60 > 48 )
                            {
                                background_difftime = "bg-success"
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
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidBefore).toLocaleString() +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidAfter).toLocaleString() +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ kdm_installed+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">  '+value.device_target+' </a></td>'
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
            $('#lms_screen').show();

            if( $('#refresh_lms').hasClass("activated"))
            {
                $('#refresh_lms').removeClass("activated") ;
                $('#lms_screen').hide();
                if(location != "Locations")
                {
                    var url ="{{  url('') }}"+  '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;
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
                                $('#screen').html(screens);
                                $('#lms_screen_content').html(screens)

                            $.each(response.kdms, function( index, value ) {

                                if(value.content_present == 'yes' ){
                                    content_present = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; "> '
                                }else{
                                    content_present = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                                }

                                if(value.kdm_installed == 'yes' ){
                                    kdm_installed = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; ">'
                                }else{
                                    kdm_installed = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                                }


                                const date1 = new Date();
                                const date2 = new Date(value.ContentKeysNotValidAfter);
                                let diffTime = Math.abs(date2 - date1);

                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                                background_difftime=""

                                if(diffTime/100/60/60 > 48 )
                                {
                                    background_difftime = "bg-success"
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
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidBefore).toLocaleString() +'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidAfter).toLocaleString() +'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ kdm_installed+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;">  '+value.device_target+' </a></td>'
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
                }
                else
                {
                    $('#refresh_lms').hide();
                    $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
                }
            }
            else
            {
                $('#refresh_lms').addClass("activated") ;
                var url ="{{  url('') }}"+  '/get_kdms_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen+'&lms='+ lms;
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
                            $('#screen').html(screens);
                            $('#lms_screen_content').html(screens)

                        $.each(response.kdms, function( index, value ) {

                            if(value.content_present == 'yes' ){
                                content_present = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; "> '
                            }else{
                                content_present = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                            }

                            if(value.kdm_installed == 'yes' ){
                                kdm_installed = '<input type="checkbox" class="form-check-input" checked="" style="font-size: 20px; ">'
                            }else{
                                kdm_installed = '<input type="checkbox" class="form-check-input"  style="font-size: 20px; ">'
                            }


                            const date1 = new Date();
                            const date2 = new Date(value.ContentKeysNotValidAfter);
                            let diffTime = Math.abs(date2 - date1);

                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                            background_difftime=""

                            if(diffTime/100/60/60 > 48 )
                            {
                                background_difftime = "bg-success"
                            }
                            if(diffTime/100/60/60 < 48  && diffTime/100/60/60 > 0 )
                            {
                                background_difftime = "bg-warning"
                            }
                            if(diffTime/100/60/60 <= 0 )
                            {
                                background_difftime = "bg-danger"
                            }
                            screen_name =""
                            if(value.screen)
                            {
                                screen_name = value.screen.screen_name
                            }
                            else
                            {
                                screen_name = value.device_target;
                            }



                            result = result
                                +'<tr class="odd '+background_difftime+'">'
                                    +'<td class="text-body align-middle fw-medium text-decoration-none">'+ screen_name+' </td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidBefore).toLocaleString() +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidAfter).toLocaleString() +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ content_present+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ kdm_installed+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ dhm (diffTime)+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ value.device_target +'</a></td>'
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
            }
        });

    })(jQuery);


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

    </style>
@endsection
