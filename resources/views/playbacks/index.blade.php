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
                                                        <div class="icon icon-box-warning " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}">
                                                            <span class="mdi mdi-play-pause "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Stop')
                                                        <div class="icon icon-box-danger " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}">
                                                            <span class="mdi mdi-stop  "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Unknown' )
                                                        <div class="icon icon-box-warning " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}">
                                                            <span class="mdi mdi-comment-question-outline  "></span>
                                                        </div>
                                                    @endif
                                                    @if ($playback->playback_status == 'Play')
                                                        <div class="icon icon-box-success " style="margin-right: 5px; width: 34px; height: 28px;" data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="{{$playback->playback_status}}">
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

    $(document).on('click', '.info', function () {
        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#infos_modal .modal-body').html(loader_content)
        location_id = $(this).attr("id") ;
        var url = "{{  url('') }}"+  "location_infos/"+location_id ;
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log(response.location) ;

                        result =
                        '<div class="modal-header p-4 pb-0">'
                            +'<h3><i class="mdi mdi-home align-self-center me-3"></i> Location : '+ response.location.name +'</h3>'
                            +'<button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
                        +'</div>'
                        +'<div class="modal-body text-center p-4">'
                        +'<div class="row">'
                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  justify-content-start">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-login-variant icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Session :  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.session + ' </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-format-indent-decrease icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">type : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.type + ' </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-harddisk icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Total Space  : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.totalSpaceFormatted+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-harddisk icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Total Space Used: </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.usedSpaceFormatted+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-playlist-check icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">cpls Complete : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.cpls_complete+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-playlist-remove icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Cpls Incomplete : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.cpls_incomplete+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-key-remove icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Kdms Expired : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.Kdms_expired+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-key-remove icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Kdms Not Valid : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.Kdms_not_valid+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-key icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Kdms Valid : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.Kdms_valid+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="col-md-3">'
                                +'<div class="card rounded border mb-2">'
                                    +'<div class="card-body p-3">'
                                        +'<div class="media  d-flex justify-content-start mr-5">'
                                            +'<div class="media-body d-flex align-items-center">'
                                                +'<i class="mdi mdi-playlist-play icon-sm align-self-center me-3"></i>'
                                                +'<h6 class="mb-1">Spls Count : </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.diskusage.splCount+ '   </p>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                        +'</div>'
                        +'</div>'

                    $('#infos_modal .modal-content ').html(result)

                },
                error: function(response) {

                }
        })

    });
</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">

@endsection
