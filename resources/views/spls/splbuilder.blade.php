@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')

            <div class="page-header playbck-shadow">
                <h3 class="page-title"> PlayList Builder </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">PlayList Builder </li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-xl-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                                </div>
                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                                    <option selected="">Locations</option>
                                                    <option  value="all">All locations</option>
                                                    @foreach ($locations as $location )

                                                    <option  value="{{ $location->id }}">{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-9 ">
                                            <button type="button" class="btn btn-success btn-icon-text">
                                                <i class="mdi mdi-check-all btn-icon-prepend"></i> Display Multiplex
                                            </button>
                                            <button type="button" class="btn btn-info btn-icon-text ">
                                                <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh
                                            </button>

                                            <button type="button" class="btn btn-warning btn-icon-text">
                                                <i class="mdi mdi-grease-pencil  btn-icon-prepend"></i> Ingest SPL
                                            </button>

                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-xl-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                                </div>

                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="filter_type">
                                                    <option value="all" selected="selected">All Elements</option>
                                                    <option value="Pattern">Pattern</option>
                                                    <option value="ADVERTISEMENT">ADVERTISEMENT</option>
                                                    <option value="FEATURE">FEATURE</option>
                                                    <option value="POLICY">POLICY</option>
                                                    <option value="PSA">PSA</option>
                                                    <option value="SHORT">SHORT</option>
                                                    <option value="TEASER">TEASER</option>
                                                    <option value="TEST">TEST</option>
                                                    <option value="TRAILER">TRAILER</option>
                                                    <option value="SPL"> Show Playlist</option>
                                                    <option value="Macros"> Macros</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-7 ">
                                            <div class="input-group palyback-form-text">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Search ">

                                            </div>
                                        </div>


                                    </div>
                                    <div id="dragula-left" class="py-2  preview-list multiplex">
                                       <p class="text-center"> Please Select Location </p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row mb-4">
                                        <div class="col-xl-12 ">

                                            <button type="button" class="btn btn-success btn-icon-text" id="reset_spl_builder">
                                                <i class="mdi mdi-plus btn-icon-prepend"></i> New
                                            </button>
                                            <button type="button" class="btn btn-primary btn-icon-text">
                                                <i class="mdi mdi-content-save btn-icon-prepend"></i> Save
                                            </button>

                                            <button type="button" class="btn btn-warning btn-icon-text">
                                                <i class="mdi mdi-new-box  btn-icon-prepend"></i> Open
                                            </button>
                                            <button type="button" class="btn btn-info btn-icon-text">
                                                <i class="mdi mdi-wrench btn-icon-prepend"></i> Propperties
                                            </button>
                                            <button type="button" class="btn btn-danger btn-icon-text">
                                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-xl-12 ">
                                            <div class="input-group p-2 mr-sm-2 palyback-form-text">
                                                <span class=" palyback-text">No Playlist Selected</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dragula-right" class="py-2  preview-list multiplex">

                                    </div>
                                </div>
                                <div class="col-md-1" style="padding-top: 29px;">
                                    <ul class="right-list " style="    list-style: none;font-size: 21px;">

                                        <li class="root-level right_icon tooltipIcons" style="margin-top: 10px;">
                                            <a href="#" id="segment">

                                                <i class="mdi mdi-cube-outline"></i>


                                            </a>
                                        </li>
                                        <li class="root-level right_icon tooltipIcons" style="margin-top: 10px;">

                                            <a href="#" id="show_marker_modal">

                                                <i class="mdi mdi-map-marker"></i>


                                            </a>
                                        </li>


                                    </ul>

                                </div>
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
                                  <a class="nav-link" id="spls-tab" data-bs-toggle="tab" href="#spls" role="tab" aria-controls="Content CPLs" aria-selected="false">SPL(S)</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="kdms-tab" data-bs-toggle="tab" href="#kdms" role="tab" aria-controls="schedules" aria-selected="false">Keys Messages</a>
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
                                <div class="tab-pane fade" id="spls" role="tabpanel" aria-labelledby="spls-tab">
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
                                <div class="tab-pane fade" id="kdms" role="tabpanel" aria-labelledby="schedules-tab">
                                </div>
                            </div>


                        </div>
                    </div>
                <!--end modal-content-->
                </div>
            </div>

@endsection

@section('custom_script')
    <script src="{{ asset('assets/vendors/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragula.js') }}"></script>



    <script>

// *********************** functions
        function formatDurationToHMS(duration){
            //  console.log(new Date(duration  * 1000).toISOString().slice(11, 19));
            return   new Date(duration  * 1000).toISOString().slice(11, 19);

        }

        function convertHMSToSeconds(time) {
            var parts = time.split(":");
            var hours = parseInt(parts[0]);
            var minutes = parseInt(parts[1]);
            var seconds = parseInt(parts[2]);
            return hours * 3600 + minutes * 60 + seconds;
        }

        function convertSecondsToHMS(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var remainingSeconds = seconds % 60;

            // Add leading zeros if necessary
            hours = String(hours).padStart(2, '0');
            minutes = String(minutes).padStart(2, '0');
            remainingSeconds = String(remainingSeconds).padStart(2, '0');

            return hours + ':' + minutes + ':' + remainingSeconds;
        }

        function formatSize(sizeInBytes) {
            if (sizeInBytes >= 1024 * 1024 * 1024) {
                return (sizeInBytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
            } else if (sizeInBytes >= 1024 * 1024) {
                return (sizeInBytes / (1024 * 1024)).toFixed(2) + ' MB';
            } else {
                return sizeInBytes + ' Bytes';
            }
        }

        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds - (hours * 3600)) / 60);
            var secs = Math.floor(seconds - (hours * 3600) - (minutes * 60));
            return (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (secs < 10 ? "0" + secs : secs);
        }

        function getCplDetails(id_cpl,need_kdm){
            $.ajax({
                url: 'system/controller_playlist_builder.php',
                type: 'post',

                data: {
                    action_control: "get_cpl_details_left_sid",
                    id_cpl: id_cpl,
                    need_kdm:need_kdm
                },

                success: function (response) {

                    var obj = JSON.parse(response);
                    var detail_cpl=obj.details_cpl;
                    if(detail_cpl==false){

                    }

                    var details_spl_contains_cpl=obj.details_spl_contains_cpl;
                    $('#date_create_ingest_details').html("Creation Date :"+detail_cpl.date_create_ingest);
                    $('#details_title').html(detail_cpl.contentTitleText);
                    $('#details_uuid').html(detail_cpl.uuid);
                    $('#details_kind').html(detail_cpl.contentKind);
                    let duration_Seconds= detail_cpl.durationEdits *detail_cpl.editRate_denominator/detail_cpl.editRate_numerator;

                    duration_Seconds=convertSecondsToHMS(Math.round(duration_Seconds));
                    $('#details_duration').html(duration_Seconds);
                    $('#details_edit_rate').html(detail_cpl.editRate_numerator+" "+detail_cpl.editRate_denominator);
                    $('#details_dcp_size').html( formatSize(detail_cpl.packageSizeInBytes)  );
                    $('#details_pictureHeight').html(detail_cpl.pictureHeight);
                    $('#details_pictureWidth').html(detail_cpl.pictureWidth);
                    $('#details_pictureEncodingAlgorithm').html(detail_cpl.pictureEncodingAlgorithm);
                    $('#details_pictureEncryptionAlgorithm').html(detail_cpl.pictureEncryptionAlgorithm);
                    $('#details_soundChannelCount').html(detail_cpl.soundChannelCount);
                    $('#details_soundEncodingAlgorithm').html(detail_cpl.soundEncodingAlgorithm);
                    $('#details_soundEncryptionAlgorithm').html(detail_cpl.soundEncryptionAlgorithm);
                    $("#cpl_detail_model_left").modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });
        }

        // open selected spl

        function openSpl(id_spl) {
            $.ajax({
                url: 'system/controller_playlist_builder.php',
                type: 'post',
                data: {
                    action_control: "open_spl",
                    id_spl: id_spl
                },
                success: function (response) {
                    var response = JSON.parse(response);
                    var obj= response.spl_file;
                    var capabilities= response.capabilities;
                    let box = "";

                    try {
                        $('#actual_spl_title').text(obj.AnnotationText);
                        $('#id_spl_opened').text(obj.Id);
                        $('#id_spl_opened').attr('data-spl_uuid', obj.Id );
                        $('#id_spl_opened').attr('data-title', obj.AnnotationText);

                        setSplOpenedData(capabilities);





                        if (obj.hasOwnProperty('EventList') && !obj.hasOwnProperty('PackList') ) {
                            var pack =[obj.EventList]  ;
                            var obj = {
                                "EventList": obj.EventList
                            };
                            var packList=[obj];

                        }
                        else{
                            var packList = obj.PackList;

                            if (Array.isArray(packList.Pack)) {
                                packList = obj.PackList.Pack;

                            }else if (typeof packList.Pack === 'object'){

                                var packList =[packList.Pack]  ;

                            }
                        }

                        for (var packId in packList) {
                            var pack = packList[packId];

                            if( Object.keys(pack.EventList).length === 0){
                                console.log(pack);
                                box +='<div class="list-group-item div_list segment_list row segment"' +
                                    '  data-id="'+pack.Id+'"' +
                                    '  data-title="'+pack.PackName+'" ' +
                                    '  data-type="segment" ' +
                                    '  data-action="add" draggable="false"> ' +
                                    '   <div class="title-content col-md-7" style="font-size: 12px;"> ' +
                                    '      <i class="fa fa-link" aria-hidden="true" style="color:#a2b927;"></i> ' +
                                    pack.PackName +
                                    '   </div>   ' +
                                    '    <div class="details-content col-md-3" style=""> ' +
                                    '       <div class="col-12 col-md-7">  </div>  ' +
                                    '    </div>  ' +
                                    '    <i class="fa fa-search  segment_properties"></i>  ' +
                                    '    <i class="fa fa-close delete-spl_item"></i> ' +
                                    '</div>';
                            }
                            else{

                                var events = pack.EventList.Event;
                                // if (Array.isArray(pack.EventList.Event)) {
                                //     var events = pack.EventList.Event;
                                //
                                // }
                                //
                                // if (typeof pack.EventList.Event === 'object'){
                                //     var  events =[  pack.EventList.Event]  ;
                                //
                                // }
                                // if (typeof events === 'object'){
                                //       events =[events]  ;
                                //
                                // }else{
                                //      events = pack.EventList.Event;
                                // }
                                console.log(events);
                                for (var i = 0; i < events.length; i++) {

                                    console.log(events[i]);
                                    var macro_box='';
                                    var marker_box='';
                                    var event = events[i];

                                    // Access event properties
                                    var eventId = event.Id;
                                    var ElementList = event.ElementList ;
                                    var mainElement = event.ElementList.MainElement;

                                    // check macro
                                    if(ElementList.hasOwnProperty('AutomationCue')){
                                        if (Array.isArray(ElementList.AutomationCue)) {
                                            var macro_list = ElementList.AutomationCue;
                                        }else  {
                                            var macro_list  =[ElementList.AutomationCue]  ;
                                        }
                                        for (let i=0;i<  macro_list.length;i++) {
                                            macro_box+=
                                                '   <div class="col-md-10 macro_item macro_style" data-title="'+macro_list[i].Action+'" ' +
                                                'data-offset="'+macro_list[i].Kind+'"' +
                                                ' data-time="'+convertSecondsToHMS(macro_list[i].Offset*1/24)+'"' +
                                                ' data-uuid="'+macro_list[i].Id+'"' +
                                                ' data-idmacro="">' +
                                                '         <div class="col-md-2" style="padding-left:12px;">|------</div>' +
                                                '         <div class="col-md-2" id="macro_time">'+convertSecondsToHMS(macro_list[i].Offset*1/24)+'</div>' +
                                                '         <div class="col-md-6" id="macro_title">'+macro_list[i].Action+'</div>' +
                                                '         <i class="fa fa-search col-sd-1 search-macro_item"></i>' +
                                                '         <i class="fa fa-close col-sd-1  delete-macro_item"></i>' +
                                                '   </div>   ';
                                        }
                                    }
                                    // check markers
                                    if(ElementList.hasOwnProperty('Marker')){
                                        if (Array.isArray(ElementList.Marker)) {
                                            var Marker_list = ElementList.Marker;
                                        }else  {
                                            var Marker_list  =[ElementList.Marker]  ;
                                        }
                                        for (let i=0;i<  Marker_list.length;i++) {
                                            marker_box+=
                                                '<div class="col-md-12 marker_item marker_style" style="margin-left: 0px!important;"' +
                                                ' data-title="'+Marker_list[i].Label+'"' +
                                                ' data-offset="'+Marker_list[i].Kind+'" ' +
                                                ' data-time="'+convertSecondsToHMS(Marker_list[i].Offset*1/24)+'"' +
                                                ' data-uuid="16b06cf1-2e7b-40ef-9807-d22485bb7c36"> ' +
                                                '   <div class="col-md-2" style="padding-left:12px;">|------</div> ' +
                                                '   <div class="col-md-2" id="marker_time">'+convertSecondsToHMS(Marker_list[i].Offset*1/24)+'</div>' +
                                                '   <div class="col-md-6" id="macrker_title">'+Marker_list[i].Label+'</div>  ' +
                                                '   <i class="fa fa-search col-sd-1 search-marker_item"></i>' +
                                                '   <i class="fa fa-close col-sd-1  delete-marker_item"></i>' +
                                                '</div>';
                                        }
                                        console.log(marker_box);
                                    }
                                    if(mainElement.hasOwnProperty('Composition')){

                                        var Composition=mainElement.Composition;

                                        var IntrinsicDuration=Composition.IntrinsicDuration;
                                        var EditRate= extractEditRateValues(Composition.EditRate);
                                        var editRate_numerator =EditRate[0];
                                        var editRate_denominator  =EditRate[1];
                                        var duration_seconds=Composition.IntrinsicDuration*editRate_denominator/editRate_numerator;
                                        var hms_time= convertSecondsToHMS(duration_seconds);
                                        console.log("composition");
                                        box +=
                                            '<div class="macro_list_sortable list-group-item div_list row cpl_component_to_select cpl_component component"' +
                                            '      data-type="Composition"' +
                                            '      data-id="'+eventId+'"' +
                                            '      data-uuid="'+Composition.CompositionPlaylistId+'" ' +
                                            '      data-source="undefined"' +
                                            '      data-title="'+Composition.AnnotationText+'"' +
                                            '      data-editrate_denominator="'+editRate_denominator+'" ' +
                                            '      data-editrate_numerator="'+editRate_numerator+'"' +
                                            '      data-id_server="undefined"' +
                                            '      data-version="new_item" data-time_seconds="'+duration_seconds+'"' +
                                            '      data-time="'+hms_time+'" data-starttime="00:00:00" ' +
                                            '      draggable="false" style=""> ' +
                                            '   <div class="title-content col-md-7 left_panel_title">' +
                                            '     <i class="fa fa-list content_pack" aria-hidden="true"></i> ' +
                                            Composition.AnnotationText +
                                            '   </div>  ' +
                                            '   <div class="details-content col-md-3" style="">      ' +
                                            '      <div class=" ">          ' +
                                            '          <i class="fa fa-clock-o" aria-hidden="true"></i>         ' +
                                            '         <span class="start_time">00:00:00</span>       ' +
                                            '      </div> ' +
                                            '  </div>\n' +
                                            '  <i class="fa fa-search col-sd-1 search-spl_item"></i>  ' +
                                            '  <i class="fa fa-close col-sd-1  delete-spl_item"></i>  ' +

                                            '   <div class="col-md-12 macro_list" style="padding :0px"> ' +
                                            macro_box+
                                            '   </div>   ' +
                                            '   <div class="col-md-10 marker_list">' +
                                            marker_box+
                                            '   </div>   ' +
                                            '   <div class="col-md-10 intermission_list"></div>' +
                                            '</div>';
                                    }
                                    else if(mainElement.hasOwnProperty('Pattern')){
                                        console.log("Pattern");

                                        var Pattern=mainElement.Pattern;
                                        console.log(Pattern);

                                        var IntrinsicDuration=Pattern.Duration;
                                        var EditRate= extractEditRateValues(Pattern.EditRate);
                                        var editRate_numerator =EditRate[0];
                                        var editRate_denominator  =EditRate[1];
                                        var duration_seconds=Pattern.Duration*editRate_denominator/editRate_numerator;
                                        var hms_time= convertSecondsToHMS(duration_seconds);

                                        box +=
                                            '<div class="macro_list_sortable list-group-item div_list row cpl_component_to_select cpl_component component"' +
                                            '      data-type="pattern" ' +
                                            '      data-id="'+eventId+'"' +
                                            '      data-uuid="'+Pattern.Id+'" ' +
                                            '      data-source="undefined"' +
                                            '      data-title="'+Pattern.AnnotationText+'"' +
                                            '      data-editrate_denominator="'+editRate_denominator+'" ' +
                                            '      data-editrate_numerator="'+editRate_numerator+'" data-id_server="undefined"' +
                                            '      data-version="new_item" data-time_seconds="'+duration_seconds+'"' +
                                            '      data-time="'+hms_time+'" data-starttime="00:00:00" ' +
                                            '      draggable="false" style=""> ' +
                                            '   <div class="title-content col-md-7 left_panel_title">' +

                                            (Pattern.AnnotationText=="Black 3D" || Pattern.AnnotationText=="Black 3D 48"?'<span class="icon_pattern">3D</span> '
                                                :  "")+
                                            Pattern.AnnotationText +
                                            '   </div>  ' +
                                            '   <div class="details-content col-md-3" style="">      ' +
                                            '      <div class=" ">          ' +
                                            '          <i class="fa fa-clock-o" aria-hidden="true"></i>         ' +
                                            '         <span class="start_time">00:00:00</span>       ' +
                                            '      </div> ' +
                                            '  </div>\n' +
                                            '  <i class="fa fa-search col-sd-1 search-spl_item"></i>  ' +
                                            '  <i class="fa fa-close col-sd-1  delete-spl_item"></i>  ' +
                                            '    <div class="col-md-12 macro_list" style="padding :0px"> ' +
                                            macro_box+
                                            '    </div>   ' +
                                            '    <div class="col-md-10 marker_list">' +
                                            marker_box+
                                            '    </div>   ' +
                                            '    <div class="col-md-10 intermission_list"></div>' +
                                            '</div>';
                                        console.log(marker_box);
                                    }
                                    macro_box="";
                                    marker_box="";
                                }
                            }

                        }

                        $('#dragula-right').html(box);
                        var items = container2.querySelectorAll('.component');
                        var startTime = 0;
                        for (var i = 0; i < items.length; i++) {
                            console.log(items[i]);
                            var duration = parseInt(items[i].getAttribute('data-time_seconds'));

                            items[i].setAttribute('data-starttime',   formatTime(startTime));
                            var composition_start_time=   items[i].getAttribute('data-starttime');

                            $(items[i]).find('div:nth-child(2) span').html(formatTime(startTime));
                            startTime += duration;
                            var composition_end_time=   startTime;
                            // Process the macro_list within the current item if it exists
                            var macroItems = items[i].querySelectorAll('.macro_item');
                            if (macroItems.length > 0) {
                                for (var j = 0; j < macroItems.length; j++) {
                                    var macroTime = macroItems[j].getAttribute('data-time');
                                    var macroKind = macroItems[j].getAttribute('data-offset');

                                    // Calculate the macro start time based on Kind
                                    var macroStartTime;
                                    if (macroKind === "Start") {
                                        console.log(composition_start_time);
                                        console.log(macroTime);
                                        macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                                    } else if (macroKind === "End") {
                                        console.log(composition_end_time);
                                        console.log(macroTime);
                                        macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                                    } else {
                                        // Handle other cases if needed
                                        macroStartTime = 0;
                                    }

                                    // Update the macro_time div with the calculated start time
                                    macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                                }
                            }


                            var markerItems = items[i].querySelectorAll('.marker_item');

                            if (markerItems.length > 0) {
                                for (var j = 0; j < markerItems.length; j++) {
                                    var markerTime = markerItems[j].getAttribute('data-time');
                                    var markerKind = markerItems[j].getAttribute('data-offset');

                                    // Calculate the macro start time based on Kind
                                    var markerStartTime;
                                    if (markerKind === "Start") {

                                        markerStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(markerTime);

                                    } else if (markerKind === "End") {
                                        console.log(composition_end_time);
                                        console.log(markerTime);
                                        markerStartTime = composition_end_time - convertHMSToSeconds(markerTime);
                                    } else {
                                        // Handle other cases if needed
                                        markerTime = 0;d
                                    }

                                    // Update the macro_time div with the calculated start time
                                    markerItems[j].querySelector('#marker_time').innerText = convertSecondsToHMS(markerStartTime);
                                }
                            }
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
            })
        }



        $(document).on('click', '.infos_modal', function () {

           var loader_content  =
               '<div class="jumping-dots-loader">'
                   +'<span></span>'
                   +'<span></span>'
                   +'<span></span>'
                +'</div>'
           $('#Properties').html(loader_content)

            $('#Properties-tab').addClass('active');
            $('#spls-tab').removeClass('active');
            $('#kdms-tab').removeClass('active');
            $('#Properties').addClass('show active ');
            $('#spls').removeClass('show active');
            $('#kdms').removeClass('show active');

           window.cpl_id = $(this).attr("id") ;
           window.location_id = $(this).attr("data-location")

           if(true  )
            {
                var url = "{{  url('') }}"+   "/get_lmscpl_infos/"+cpl_id;
                $('#kdms-tab').hide();
            }
            else
            {
                var url = "{{  url('') }}"+ "/get_cpl_infos/"+location_id+"/"+cpl_id ;
                $('#kdms-tab').show();
            }
           $.ajax({
                   url: url,
                   method: 'GET',
                   success:function(response)
                   {
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
                                               +'<p class="mb-0 text-muted"> '+ response.cpl.contentTitleText + ' </p>'
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
                                               +'<p class="mb-0 text-muted"> '+ response.cpl.uuid + ' </p>'
                                           +'</div>'
                                       +'</div>'
                                   +'</div>'
                               +'</div>'
                               +'<div class="card rounded border mb-2">'
                                   +'<div class="card-body p-3">'
                                       +'<div class="media  d-flex justify-content-start mr-5">'
                                           +'<div class="media-body d-flex align-items-center">'
                                               +'<i class="mdi mdi-timer icon-sm align-self-center me-3"></i>'
                                               +'<h6 class="mb-1">Kind : </h6>'
                                           +'</div>'
                                           +'<div class="media-body">'
                                               +'<p class="mb-0 text-muted m-1">   </p>'
                                           +'</div>'
                                           +'<div class="media-body">'
                                               +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                           +'</div>'
                                       +'</div>'
                                   +'</div>'
                               +'</div>'

                               +'<div class="card rounded border mb-2">'
                                   +'<div class="card-body p-3">'
                                       +'<div class="media  d-flex justify-content-start mr-5 row">'

                                            +'<div class="col-md-4 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Duration   </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.durationEdits + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-4 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Edit Rate   </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.EditRate + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-4 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Disk size   </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.totalSize + '   </p>'
                                                +'</div>'
                                            +'</div>'



                                       +'</div>'
                                   +'</div>'
                               +'</div>'



                               +'<div class="card rounded border mb-2">'
                                   +'<div class="card-body p-3">'
                                       +'<div class="media  d-flex justify-content-start mr-5 row">'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Picture Height  </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Picture width  </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Picture Encoding Algorithm   </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Picture Encryption Algorithm  </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                       +'</div>'
                                   +'</div>'
                               +'</div>'

                               +'<div class="card rounded border mb-2">'
                                   +'<div class="card-body p-3">'
                                       +'<div class="media  d-flex justify-content-start mr-5 row">'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Sound Channel Count  </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.soundChannelCount + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Sound Encoding Algorithm </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1">Sound Encryption   </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
                                            +'</div>'

                                            +'<div class="col-md-3 text-center" >'
                                                +'<div class="media-body ">'
                                                    +'<h6 class="mb-1"> Algorithm  </h6>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted m-1">   </p>'
                                                +'</div>'
                                                +'<div class="media-body">'
                                                    +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                                +'</div>'
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

        $(document).on('click', '#spls-tab', function () {

           var loader_content  =
               '<div class="jumping-dots-loader">'
                   +'<span></span>'
                   +'<span></span>'
                   +'<span></span>'
                   +'</div>'
           $('#spls').html(loader_content)


           if(true )
            {
                var url = "{{  url('') }}"+   "/get_lmscpl_infos/"+cpl_id;
                $('#kdms-tab').hide();
            }
            else
            {
                var url = "{{  url('') }}"+ "/get_cpl_infos/"+location_id+"/"+cpl_id ;
                $('#kdms-tab').show();
            }




           $.ajax({
                   url: url,
                   method: 'GET',
                   success:function(response)
                   {
                       console.log(response.spls) ;
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

                       $.each(response.spls, function( index, value ) {

                       result = result
                                       +'<tr>'
                                           +'<th>'+value.uuid+'</th>'
                                           +'<th>'+value.name+'</th>'

                                       +'</tr>'
                       });
                       result = result
                                   +'</tbody>'
                               +'</table>'
                           +'</div>'
                       $('#spls').html(result)





                   },
                   error: function(response) {

                   }
           })

       });

       $(document).on('click', '#kdms-tab', function () {

           var loader_content  =
               '<div class="jumping-dots-loader">'
                   +'<span></span>'
                   +'<span></span>'
                   +'<span></span>'
                   +'</div>'
           $('#kdms').html(loader_content)

           var url = "{{  url('') }}"+ "/get_cpl_infos/"+location_id+"/"+cpl_id ;


           $.ajax({
                   url: url,
                   method: 'GET',
                   success:function(response)
                   {
                       console.log(response) ;
                       if(response.kdms.length)
                       {
                           result =
                               '<div class="">'
                                   +'<table class="table">'
                                       +'<thead>'
                                           +'<tr>'
                                               +'<th>Screen</th>'
                                               +'<th>Note Valide Before </th>'
                                               +'<th>Note Valid After</th>'
                                               +'<th>UUID</th>'
                                           +'</tr>'
                                       +'</thead>'
                                       +'<tbody>'

                           $.each(response.kdms, function( index, value ) {

                           result = result
                                           +'<tr>'
                                               +'<th>'+value.screen.screen_name+'</th>'
                                               +'<th>'+value.ContentKeysNotValidBefore+'</th>'
                                               +'<th>'+value.ContentKeysNotValidAfter+'</th>'
                                               +'<th>'+value.uuid+'</th>'

                                           +'</tr>'
                           });
                           result = result
                                       +'</tbody>'
                                   +'</table>'
                               +'</div>'
                           $('#kdms').html(result)
                       }
                       else
                       {
                           $('#kdms').html('No data ')
                       }



                   },
                   error: function(response) {

                   }
           })

       });
    </script>


    <script>

        $('#location').change(function(){

            var box = "";
            var box_kind = "";
            var detail = "";

            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#dragula-left').html(loader_content)

            var location =  $('#location').val();
            var url = "{{  url('') }}"+ '/get_cpl_with_filter/?location=' + location+'&lms=true&playlist_builder=true' ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    $.each(response.cpls, function( index, value ) {

                        if (value.contentKind.localeCompare(box_kind) == 0) {
                        box_kind = value.contentKind;
                    } else {
                        box_kind = value.contentKind;
                        box += '<div class=" filtered  div_list title-kind  "   ' +
                            '        data-type="' + value.contentKind + '">' + value.contentKind + '  </div>';
                    }
                    if (value.contentKind.match(/^(SPL|Automation|Trigger|Cues|Pattern)$/)) {

                    }


                        box +=
                                '   <div class="card rounded border mb-2 left-side-item"' +
                                '       data-side="left"   ' +
                                '       data-auditorium="' + value.id_auditorium +'" ' +
                                '       data-uuid="'+value.uuid +'"' +
                                '       data-title="'+value.contentTitleText+'"' +
                                '       data-time="'+value.duration +'"  ' +
                                '       data-time_seconds="'+value.duration_seconds+ '"  ' +
                                '       data-time_Duration_frames="'+value.Duration_frames+ '"  ' +
                                '       data-type_component="cpl"'+
                                '       data-id="'+value.id+'"'+
                                '       data-version="left_tab"'+
                                '       data-type="'+ value.contentKind+'"' +
                                '       data-editRate_denominator="'+ value.editRate_denominator+'"' +
                                '       data-editRate_numerator="'+ value.editRate_numerator+'"' +
                                '       data-id_server="'+ value.id_server+'"' +
                                '       data-source="'+ value.source+'"' +
                                '>\n' +
                                '       <div class="card-body  "  >\n' +
                                '            <div>\n' +
                                '                 <div class="media-body  ">\n' +
                                '                      <h6 class="mb-1"  style="color:'+
                                                        (value.type === "Flat" ? "#52d4f7" :
                                                        (value.type === "Scope" ? "#00d25b" : "white"))
                                +'">'+value.contentTitleText+
                                ( (value.pictureEncryptionAlgorithm=="None" || value.pictureEncryptionAlgorithm== 0 ) ?" ": "<i class=\"mdi mdi-lock-outline  cpl_need_kdm\" aria-hidden=\"true\"></i>") +
                                '</h6>\n' +
                                '                  </div>\n' +
                                '                  <div class="media-body">\n' +
                                '                       <p class="mb-0 text-muted float-left">'+ value.duration + ' Subtitle, VI, HI, DBox    </p>\n' +
                                '                       <p class="mb-0 text-muted float-right">\n' +
                                '                          <span class="icon-prop-cpl">' +
                                                            (value.is_3D == 1?'3D':'2D')+
                                '                          </span>\n' +
                                '                          <span class="flat">  ' +
                                                            (value.aspect_Ratio=="unknown"? value.type
                                                                : value.aspect_Ratio+' '+value.cinema_DCP  )+
                                '                           </span>\n' +
                                '                          <span class="flat">'+value.soundChannelCount+' </span>\n' +
                                '                          <span class="flat"> ST  </span>\n' +
                                '                          <i class="cpl-details infos_modal" id="'+value.id+'" class="flat" data-bs-toggle="modal" data-bs-target="#infos_modal"> <i class="mdi mdi-magnify"> </i></i>\n' +
                                '                       </p>\n' +
                                '                   </div>\n' +
                                '              </div>\n' +
                                '       </div>\n' +
                                '   </div>';
                            });

                    box += '<div class=" filtered  div_list   title-kind  " data-type="Pattern "> Pattern   </div>';
                        box += '' +
                            '<div class="list-group-item div_list card rounded border mb-2 left-side-item" ' +
                            '         data-side="left" ' +
                            '         data-type="Pattern" ' +
                            '         data-version="left_tab"'+
                            '         data-title="Black"  >' +
                            '        <span></span>'+
                            '        <div class="title-content"> Black <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i></div>' +
                            '</div>';
                        box +=
                            '<div class="list-group-item div_list card rounded border mb-2 left-side-item " ' +
                            '         data-side="left" ' +
                            '         data-type="Pattern" ' +
                            '         data-version="left_tab"'+
                            '         data-title="Black 3D">' +
                            '      <div class="title-content"> ' +
                            '            <span class="icon_pattern">3D</span>' +
                            '            Black 3D <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i>' +
                            '      </div>' +
                            '</div>';
                        box +=
                            '<div class="list-group-item div_list card rounded border mb-2 left-side-item" ' +
                            '         data-side="left" ' +
                            '         data-type="Pattern" ' +
                            '         data-version="left_tab"'+
                            '         data-title="Black 3D 48"  >' +
                            '   <div class="title-content"> ' +
                            '       <span class="icon_pattern">3D</span>' +
                            '       Black 3D 48 <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i>' +
                            '   </div>' +
                            '</div>';
                        // append macros
                        box += '<div class=" filtered  div_list title_kind title-kind" data-type="Macros"> Macros  </div>';

                        $.each(response.macros, function( index, value ) {
                        box +=
                        '<div  style="padding:5px" class="macro_item   div_list card rounded border mb-2 left-side-item" data-title="' + value.command + '" data-id="' + value.idmacro_config + '" data-type="Macros">' +
                        '       <div class="card-body p-3">\n' +
                        '                 <div class="media-body float-left">\n' +
                        '                    <div class="title-content col-md-12"> <i class="mdi mdi-server-network"></i> ' + value.command + ' </div>' +
                        '                       <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"></i>' +
                        '                 </div>'+
                        '        </div>'+
                        '</div>';
                        });

                    $('#dragula-left').html(box);
                },
                error: function(response) {

                }
            })
        });
        function formatDurationToHMS(duration){
            //  console.log(new Date(duration  * 1000).toISOString().slice(11, 19));
            return   new Date(duration  * 1000).toISOString().slice(11, 19);

        }

        $(document).on('change', '#filter_type', function (event) {
            var criteria = $(this).val();

            if (criteria == 'all') {
                $('.left-side-item').show();
                return;
            }
            $('#dragula-left .left-side-item').each(function (i, option) {
                if ($(this).data("type") == criteria) {

                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $(document).on('dblclick', '#dragula-left .left-side-item', function (e) {
            var clonedElement = $(this).clone();
            console.log(clonedElement.data('type'))
            if (clonedElement.data('type') === "Macros") {
                let check = getCplSelected();
                if (check == 1) {
                    $(this).data('type');
                    $('#titl_macro').html($(this).parent().data('title'));
                    $('#id_macro_item').html($(this).parent().data('id'));
                    $('#id_macro_item').attr('data-id', $(this).parent().data('id'));
                    resetMacroTimeInputs();
                    $("#macro_modal").modal('show');
                } else {
                    $("#empty_properties_cpl_model").modal('show');
                }
            }
            else if(clonedElement.data('type') === "Pattern"){
                console.log($(this).parent().parent().data('title'));
                $('#pattern_title').val($(this).parent().parent().data('title'));
                $("#pattern_modal").modal('show');
            }

            else if(clonedElement.data('type') === "SPL"){

            }
            else{

                console.log(clonedElement.get(0))
                modifyContentBeforeDrop(clonedElement.get(0));
                $('#dragula-right').append(clonedElement);

                // re-order items
                var items =  $('#dragula-right').find('.left-side-item');
                var startTime = 0;

                for (var i = 0; i < items.length; i++) {
                    var duration = parseInt(items[i].getAttribute('data-time_seconds'));
                    items[i].setAttribute('data-starttime',   formatTime(startTime));
                    var composition_start_time=   items[i].getAttribute('data-starttime');
                    items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
                    startTime += duration;
                    var composition_end_time=   startTime;
                    // Process the macro_list within the current item if it exists
                    var macroItems = items[i].querySelectorAll('.macro_item');
                    if (macroItems.length > 0) {
                        for (var j = 0; j < macroItems.length; j++) {
                            var macroTime = macroItems[j].getAttribute('data-time');
                            var macroKind = macroItems[j].getAttribute('data-offset');
                            // Calculate the macro start time based on Kind
                            var macroStartTime;
                            if (macroKind === "Start") {
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                            } else if (macroKind === "End") {
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }
                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                        }
                    }
                }
            }

        });


    </script>


    <script>

        let content_height = document.querySelector('.content-wrapper').offsetHeight;
        let navbar_height = document.querySelector('.navbar').offsetHeight;
        let footer_height = document.querySelector('.footer').offsetHeight;
        let page_header_height = document.querySelector('.page-header ').offsetHeight;
        let content_max_height =  content_height - navbar_height - footer_height - page_header_height - 450;

        $(".multiplex").height(content_max_height);


            $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })


        $(".preview-item").click(function(){

        $(this).toggleClass("selected");
        });
    </script>



<script>


    $(document).on('click', '#reset_spl_builder', function () {
        //$('#actual_spl_title').text("No SPL Selected , Create New One");
    //  $('#id_spl_opened').text(0);
        $("#dragula-right").empty();
        // $('#id_spl_opened').attr('data-hfr', 0 );
        // $('#id_spl_opened').attr('data-mod', "" );
        // $('#id_spl_opened').attr('data-spl_uuid', 0 );
        // prepareSortablReorder();
    });
    // click open (display spls list
    $(document).on('click', '#open_spl_list', function () {
        $("#spl-list").modal('show');
        $("#order-listing").dataTable().fnDestroy();
        $('#order-listing').DataTable({
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            // "iDisplayLength": 20,
            "scrollY": "600px", // Set the height of the scrolling area
            "scrollCollapse": true, // Enable scroll collapse
            "ajax": 'system/controller_playlist_builder.php?action_control=get_spl_available',
            'columnDefs': [
                {
                    'targets': 3,
                    'searchable': false,
                    'orderable': false,

                    'className': 'dt-body-center',
                    'render': function (data, type, row) {
                        //+row[1]+ for getting parameters by position
                        return ' <i class="btn btn-primary mdi mdi-tooltip-edit open_spl" data-uuid="'+row[2]+'"></i>' +
                            '    <i class="btn btn-danger mdi   mdi-delete-forever" data-uuid="'+row[2]+'"></i>     '    ;
                    }
                }],
        });

    });


    $(document).on('click', '.open_spl', function () {
        var action_control = "open_spl";
        var id_spl= $(this).data("uuid");

        openSpl(id_spl);
    });
    // remove cpl right list
    $(document).on('click', '.remove-cpl', function () {

        $(this).parent().parent().parent().parent().parent().parent().remove();
        // re-order items
        var items =  $('#dragula-right').find('.left-side-item');
        var startTime = 0;

        for (var i = 0; i < items.length; i++) {
            var duration = parseInt(items[i].getAttribute('data-time_seconds'));
            items[i].setAttribute('data-starttime',   formatTime(startTime));
            var composition_start_time=   items[i].getAttribute('data-starttime');
            items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
            startTime += duration;
            var composition_end_time=   startTime;
            // Process the macro_list within the current item if it exists
            var macroItems = items[i].querySelectorAll('.macro_item');
            if (macroItems.length > 0) {
                for (var j = 0; j < macroItems.length; j++) {
                    var macroTime = macroItems[j].getAttribute('data-time');
                    var macroKind = macroItems[j].getAttribute('data-offset');
                    // Calculate the macro start time based on Kind
                    var macroStartTime;
                    if (macroKind === "Start") {
                        macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                    } else if (macroKind === "End") {
                        macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                    } else {
                        // Handle other cases if needed
                        macroStartTime = 0;
                    }
                    // Update the macro_time div with the calculated start time
                    macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                }
            }
        }

    });


</script>
@endsection

@section('custom_css')

    <link rel="stylesheet" href="{{ asset('assets/vendors/dragula/dragula.min.css') }}">
    <style>
        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .icon-prop-cpl {
            border: 1px solid aliceblue;
            padding: 7px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 13px;
            margin-right: 4px;
            display: inline-block;
            width: 35px;
            height: 35px;
            text-align: center;
        }

        .flat {

            border: 1px solid #485968;
            padding: 6px;
            color: white;
            border-radius: 5px;
            margin-right: 3px;
            font-size: 12px;

        }
        .title-kind{
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            padding: 7px;
            border: 1px solid white!important;
            background: black;
            margin-bottom: 7px;
        }
        .drag-over {
            border: 2px dashed #007BFF; /* Example: Add a dashed border when dragging over */
            background-color: #f0f0f0;  /* Example: Add a light background color when dragging over */
            /* Add any other styling you want for the drop area */
        }
        .cpl_need_kdm{
            font-size: 26px;
            color: #36ffb9;
            margin-left: 13px;
        }
        #dragula-left ,
        #dragula-right
        {
            border : 1px solid #2c2e33 ;
        }

    </style>
@endsection
