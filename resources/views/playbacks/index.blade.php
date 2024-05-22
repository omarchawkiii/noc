@extends('layouts.app')
@section('title') Playback  @endsection
@section('content')
    <div class="page-header ingester-shadow">
        <h3 class="page-title  ">Playback </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Playback</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Playback</h4>
                    </div>
                    <div>
                        <button id="refresh" class="btn btn-light btn-fw  btn-icon-text"> <i class="mdi mdi-reload btn-icon-prepend"></i> Refresh</button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Location</th>
                                    <th class="sorting">1</th>
                                    <th class="sorting">2</th>
                                    <th class="sorting">3</th>
                                    <th class="sorting">4</th>
                                    <th class="sorting">5</th>
                                    <th class="sorting">6</th>
                                    <th class="sorting">7</th>
                                    <th class="sorting">8</th>
                                    <th class="sorting">9</th>
                                    <th class="sorting">10</th>
                                    <th class="sorting">11</th>
                                    <th class="sorting">12</th>
                                    <th class="sorting">13</th>
                                    <th class="sorting">14</th>
                                    <th class="sorting">15</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $key => $location )

                                    <tr class="odd text-center  ">
                                        <td class="sorting_1"> {{ $location->name }}  </td>
                                        @if($location->playbacks->count() >0  )
                                            @foreach ( $location->playbacks as  $playback)
                                                <td class="sorting_1" id="{{ $playback->location_id }}-{{ $playback->screen_id }}">
                                                    @if ($playback->playback_status == 'Pause' )
                                                        <div class="icon icon-box-warning  playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}" data-id="{{ $playback->id }}">
                                                            <span class="mdi mdi-play-pause "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Stop')
                                                        <div class="icon icon-box-danger playback_icon " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}" data-id="{{ $playback->id }}">
                                                            <span class="mdi mdi-stop  "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Unknown' )
                                                        <div class="icon icon-box-warning  playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}" data-id="{{ $playback->id }}">
                                                            <span class="mdi mdi-comment-question-outline  "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Play')
                                                        <div class="icon icon-box-success playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}" data-id="{{ $playback->id }}">
                                                            <span class="mdi mdi-play "></span>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endforeach
                                        @else

                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="icon icon-box-secondary  " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="">
                                                    <span class=" "></span>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

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
                <div class="modal-header">
                    <h4>title </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  row p-4 pt-0">


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
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
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




    <script>
        function calculateRuntimeDifference(remainingTime, elapsedTime) {

            if(elapsedTime=="0")
            {
                return "00:00:00";
            }

            // Parse time strings into Date objects
            const remainingTimeParts = remainingTime.split(':').map(part => parseInt(part, 10));
            const elapsedParts = elapsedTime.split(':').map(part => parseInt(part, 10));

            // Convert time parts into milliseconds
            const remainingMilliseconds = (remainingTimeParts[0] * 3600 + remainingTimeParts[1] * 60 + remainingTimeParts[2]) * 1000;
            const elapsedMilliseconds = (elapsedParts[0] * 3600 + elapsedParts[1] * 60 + elapsedParts[2]) * 1000;

            // Calculate the difference
            const differenceMilliseconds = remainingMilliseconds - elapsedMilliseconds;

            // Calculate hours, minutes, and seconds
            let hours = Math.floor(differenceMilliseconds / (1000 * 60 * 60));
            let minutes = Math.floor((differenceMilliseconds % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((differenceMilliseconds % (1000 * 60)) / 1000);
            console.log(hours)
            // Ensure leading zeros if necessary
            //hours = (hours < 10) ? 0 ${hours} : hours;
            hours = (hours < 10) ? '0'+hours:hours;
            minutes = (minutes < 10) ? '0'+minutes:minutes;
            seconds = (seconds < 10) ? '0'+seconds:seconds;
            /*minutes = (minutes < 10) ? 0${minutes} : minutes;
            seconds = (seconds < 10) ? 0${seconds} : seconds;*/

            // Return the formatted difference
            return hours+':'+minutes+':'+seconds;
        }

    (function($) {



    function get_playback_data()
    {
        $.ajax({
                url:"{{  url('') }}"+ "/playback",
                type: 'get',
                //cache: false,
                data: {
                    type : "ajax"
                },
                success: function(response) {
                    //  console.log(response)
                    $.each(response.playbacks, function( index, value ) {
                        var playback_status =" " ;
                        if (value.playback_status == 'Pause' )
                        {
                            playback_status = '<div class="icon icon-box-warning  playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="'+value.playback_status+'" data-id="'+value.id+'">'
                                +'<span class="mdi mdi-play-pause "></span>'
                            +'</div>'
                            }
                        if (value.playback_status == 'Stop')
                        {
                            playback_status = '<div class="icon icon-box-danger playback_icon " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="'+value.playback_status+'" data-id="'+value.id+'">'
                                +'<span class="mdi mdi-stop  "></span>'
                            +'</div>'
                            }
                        if (value.playback_status == 'Unknown' )
                        {
                            playback_status = '<div class="icon icon-box-warning  playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="'+value.playback_status+'" data-id="'+value.id+'">'
                                +'<span class="mdi mdi-comment-question-outline  "></span>'
                            +'</div>'
                            }
                        if (value.playback_status == 'Play')
                        {
                            playback_status = '<div class="icon icon-box-success playback_icon" style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="'+value.playback_status+'" data-id="'+value.id+'">'
                                +'<span class="mdi mdi-play "></span>'
                            +'</div>'
                            }
                        $('#'+value.location_id +'-'+value.screen_id).html(playback_status)
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {

                }
        });
    }
    const interval = setInterval(function() {
        get_playback_data() ;
    }, 5000);


    'use strict';
    $(function() {
        $('#order-listing').DataTable({
        "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        }
        });
        $('#order-listing').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
        });
    });

    var playback_icon_interval ;
    $(document).on('click', '.playback_icon', function () {
        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#infos_modal .modal-body').html(loader_content)
        $('#infos_modal').modal('show')
        var id = this.getAttribute("data-id")

        get_playback_screen_infos(id) ;

         playback_icon_interval = setInterval(function() {
            get_playback_screen_infos(id) ;
        }, 5000);


    });
    $(document).on('hidden.bs.modal', '#infos_modal', function () {

        if (playback_icon_interval !== undefined) {
            clearInterval(playback_icon_interval);
        }

    });
    function get_playback_screen_infos(id)
    {
        var data ;
        $.ajax({
                url:"{{  url('') }}"+ "/get_playbak_detail",
                type: 'get',
                //cache: false,
                data: {
                    id: id,
                },
                success: function(response) {
                    console.log(response)
                    var _time = calculateRuntimeDifference(response.playback.remaining_runtime ,response.playback.elapsed_runtime)
                      var progress_bar= '<div class="col-md-8">'
                                        +'<div class="progress progress-lg p-0 " style="margin-top:15px">'
                                            +'<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="height: 17px ; width: '+response.playback.progress_bar+'%; " aria-valuenow="'+response.playback.progress_bar+'" aria-valuemin="0" aria-valuemax="100">'+ parseFloat(response.playback.progress_bar).toFixed(2) +'%</div>'
                                        +'</div>'
                                        +'<div class="d-flex justify-content-between mt-2">'
                                            +'<span>'+response.playback.elapsed_runtime+'</span>'
                                            +'<span>'+ response.playback.elapsed_runtime+'/'+ response.playback.remaining_runtime+'</span>'
                                        +'</div>'
                                    +'</div>'


                    var sound_status =""
                    var projector_status =""
                    var lamp_status =""
                    var dowser_status=""


                    if(response.playback.projector_status == 0)
                    {
                        projector_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class="mdi mdi-monitor btn-icon-prepend"></i> Offline </button>';
                        lamp_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class="mdi mdi-lightbulb-outline btn-icon-prepend"></i> Off </button>';
                        dowser_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class="mdi mdi-wifi-off btn-icon-prepend"></i> Closed </button>';
                    }
                    else
                    {

                        projector_status = '<button type="button" class="btn btn-inverse-success btn-icon-text"><i class="mdi mdi-monitor btn-icon-prepend"></i> Online  </button>';
                        if(response.playback.lamp_status =="On")
                        {
                            lamp_status = '<button type="button" class="btn btn-inverse-success btn-icon-text"><i class="mdi mdi-lightbulb btn-icon-prepend"></i> On </button>';

                        }
                        else
                        {
                            lamp_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class="mdi mdi-lightbulb-outline btn-icon-prepend"></i> Off </button>';
                        }

                        if(response.playback.dowser_status =="Open")
                        {
                            dowser_status = '<button type="button" class="btn btn-inverse-success btn-icon-text"><i class=" btn-icon-prepend"></i> Open </button>';

                        }
                        else
                        {
                            dowser_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class=" btn-icon-prepend"></i> Closed </button>';
                        }

                    }


                    if(response.playback.ip_sound_status == 0)
                    {
                        sound_status = '<button type="button" class="btn btn-inverse-danger btn-icon-text"><i class="mdi mdi-wifi-off btn-icon-prepend"></i> Offline </button>';
                    }
                    else
                    {
                        if(response.playback.sound_status !="OK")
                        {
                            sound_status = '<button type="button" class="btn btn-inverse-warning btn-icon-text"><i class="mdi mdi-alert btn-icon-prepend"></i> ' + response.playback.sound_status + ' </button>' ;
                        }
                        else
                        {
                            sound_status = '<button type="button" class="btn btn-inverse-success btn-icon-text"><i class="mdi mdi mdi-check btn-icon-prepend"></i> OK </button>' ;
                        }

                    }







                   // $('#infos_modal .modal-header h4').html("Playback : " + response.playback.serverName)
                   $('#infos_modal .modal-body').html("Playback :" + response.playback.serverName)
                    data = '<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-playlist-play"> </i> <span> Curent SPL </span></p><p class="col-md-9"  style="margin-top:15px"> '+response.playback.spl_title+' </p> '
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-play-circle"> </i> <span>  Curent CPL </span></p><p class="col-md-9"  style="margin-top:15px">'+response.playback.cpl_title+' </p> '
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-timer"> </i> <span>  Time </span></p>'+ progress_bar
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-assistant"> </i> <span> playback generale status </span></p><p class="col-md-9"  style="margin-top:15px">'+response.playback.storage_generale_status+'</p>'
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-security"> </i> <span>  Security Manager status </span></p><p class="col-md-9"  style="margin-top:15px">'+response.playback.securityManager+'</p>'
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-volume-high"> </i> <span>  Sound Status    </span></p><p class="col-md-9"  style="margin-top:15px">'+sound_status+'</p>'

                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-projector-screen"> </i> <span>  Projector Status   </span></p><p class="col-md-9"  style="margin-top:15px">'+projector_status+'</p>'
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi mdi-lightbulb"> </i> <span>  Lamp Status   </span></p><p class="col-md-9"  style="margin-top:15px">'+lamp_status+'</p>'
                    +'<p class="col-md-3"> <i class="align-middle icon-md mdi mdi-google-chrome"> </i> <span>  Dowser Status   </span></p><p class="col-md-9"  style="margin-top:15px">'+dowser_status+'</p>'


                    $('#infos_modal .modal-body').html(data) ;
                    $('#infos_modal .modal-header h4').html("Screen : " + response.screen_info.screen_name) ;


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
        });
    }

    $(document).on('click', '#refresh', function () {
        $.ajax({
                url:"{{  url('') }}"+ "/refresh_playback",
                type: 'get',
                beforeSend: function () {
                    swal({
                        title: 'Refreshing',
                        closeOnEsc: false,
                        allowOutsideClick: false,

                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    swal.close();
                    if(response.status)
                    {
                        get_playback_data() ;
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
    });





})(jQuery);



</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">

<style>
    #infos_modal .modal-body p
    {
        font-size: 18px ;

    }
    #infos_modal .modal-body p
    {
        margin-bottom: 0 ;
    }
    </style>
@endsection
