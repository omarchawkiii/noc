@extends('layouts.app')
@section('title') connexion  @endsection
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
                                                <td class="sorting_1">
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
                <div class="modal-body  p-4">


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


<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="{{asset('/assets/js/tooltips.js')}}"></script>
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
})(jQuery);

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
        var data ;
        $.ajax({
                url:"{{  url('') }}"+ "/get_playbak_detail",
                type: 'get',
                //cache: false,
                data: {
                    id: id,
                },
                success: function(response) {

                    $('#infos_modal .modal-header h4').html("Playback : " + response.playback.serverName)
                 //   $('#infos_modal .modal-body').html("Playback :" + response.playback.serverName)
                    data = '<p> <i class="align-middle icon-md mdi mdi-playlist-play"> </i> <span> Curent SPL :</span> '+response.playback.spl_title+' </p> '
                    +'<p> <i class="align-middle icon-md mdi mdi-play-circle"> </i> <span>  Curent CPL : </span>'+response.playback.cpl_title+' </p> '
                    +'<p> <i class="align-middle icon-md mdi mdi-timer"> </i> <span>  Time : </span> '+response.playback.elapsed_runtime+' / '+response.playback.remaining_runtime+' </p> '
                    +'<p> <i class="align-middle icon-md mdi mdi-assistant"> </i> <span>  playback generale status is :  </span>'+response.playback.storage_generale_status+'</p>'
                    +'<p> <i class="align-middle icon-md mdi mdi-security"> </i> <span>  Security Manager status is :  </span>'+response.playback.securityManager+'</p>'

                    $('#infos_modal .modal-body').html(data) ;


                    console.log(response)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });





    });
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
        margin-bottom: 8px ;
    }
    </style>
@endsection
