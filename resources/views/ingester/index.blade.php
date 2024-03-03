@extends('layouts.app')
@section('title') connexion  @endsection
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

                            <div class="row mt-4">
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
                            <div class="row mt-4">
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
            }
            else
            {
                lms= true ;
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
                            content_present = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            content_present = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
                        }

                        if(value.kdm_installed == 'yes' ){
                            kdm_installed = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            kdm_installed = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
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
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ kdm_installed+'</a></td>'
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
            }
            else
            {
                $('#refresh_lms').hide();
            }

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
                            content_present = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            content_present = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
                        }
                        if(value.kdm_installed == 'yes' ){
                            kdm_installed = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            kdm_installed = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
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
                            content_present = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            content_present = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
                        }
                        if(value.kdm_installed == 'yes' ){
                            kdm_installed = '<i class= "mdi mdi-check-circle-outline text-white" > </i>'
                        }else{
                            kdm_installed = '<i class= "mdi mdi-checkbox-blank-circle-outline text-white" > </i>'
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
