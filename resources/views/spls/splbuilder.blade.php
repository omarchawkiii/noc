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
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                                </div>
                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                                    <option selected="">Locations</option>
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
                                            <div class="input-group mb-2 mr-sm-2">
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
                                            <div class="input-group mb-2 mr-sm-2 palyback-form-text">
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
                                    <div class="row mb-3">
                                        <div class="col-xl-12 ">

                                            <button type="button" class="btn btn-success btn-icon-text">
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
                                            <div class="input-group mb-2 p-2 mr-sm-2 palyback-form-text">


                                                <span class=" palyback-text">No Playlist Selected</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dragula-right" class="py-2">
                                        <div class="card rounded border mb-2">
                                            <div class="card-body p-3">
                                                <div class="media">
                                                    <i class="mdi mdi-account icon-sm align-self-center me-3"></i>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Prohect details</h6>
                                                        <p class="mb-0 text-muted"> Get new project details from Greg </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded border mb-2">
                                            <div class="card-body p-3">
                                                <div class="media">
                                                    <i class="mdi mdi-apps icon-sm align-self-center me-3"></i>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Leave approval</h6>
                                                        <p class="mb-0 text-muted"> Approve leaves for Mike </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded border mb-2">
                                            <div class="card-body p-3">
                                                <div class="media">
                                                    <i class="mdi mdi-bank icon-sm align-self-center me-3"></i>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Make reservations at hotel</h6>
                                                        <p class="mb-0 text-muted"> Book rooms for vacation </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded border mb-2">
                                            <div class="card-body p-3">
                                                <div class="media">
                                                    <i class="mdi mdi-calendar icon-sm align-self-center me-3"></i>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Meeting with client</h6>
                                                        <p class="mb-0 text-muted"> New project meeting </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


@endsection

@section('custom_script')
    <script src="{{ asset('assets/vendors/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragula.js') }}"></script>

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
                                '       data-uuid="'+value.cpl_uuid +'"' +
                                '       data-title="'+value.contentTitleText+'"' +
                                '       data-time="'+value.Duration +'"  ' +
                                '       data-time_seconds="'+value.Duration_seconds+ '"  ' +
                                '       data-time_Duration_frames="'+value.Duration_frames+ '"  ' +
                                '       data-type_component="cpl"'+
                                '       data-id="'+value.id_dcp+'"'+
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
                                '                          <span class="cpl-details" data-uuid="urn:uuid:e83235b4-f50d-4f46-906f-2ce2cca1ba52" class="flat"> <i class="mdi mdi-magnify"> </i></span>\n' +
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
