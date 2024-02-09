@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header playbck-shadow">
        <h3 class="page-title ">Locations </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Location</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                    <h4 class="card-title ">Locations</h4>
                    </div>

                    <div>

                    <a  href="{{ route('location.create') }}" class="btn btn-primary  btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Create Location
                    </a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Order #</th>
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Folder Title</th>
                                    <th class="sorting">Screen Count</th>
                                    <th class="sorting">City </th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting">Space</th>
                                    <th class="sorting">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $key => $location )
                                    <tr class="odd text-center  ">
                                        <td class="sorting_1"><a href="{{ route('location.show',$location) }}"> {{  $key +1 }}</a> </td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->name }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->folder_title }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->screens->count() }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->city }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->state }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}">

                                            @if($location->diskusage)
                                                @if($location->diskusage->free_space_percentage < 80 )

                                                    <div class="progress progress-lg">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ round( (int) $location->diskusage->free_space_percentage) }}%" aria-valuenow="{{ $location->diskusage->free_space_percentage }}" aria-valuemin="{{ $location->diskusage->free_space_percentage }}" aria-valuemax="{{ $location->diskusage->free_space_percentage }}">{{ $location->diskusage->free_space_percentage }}%</div>
                                                    </div>
                                                @elseif(($location->diskusage->free_space_percentage >= 80  && $location->diskusage->free_space_percentage < 90))
                                                    <div class="progress progress-lg">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ round( (int)$location->diskusage->free_space_percentage) }}%" aria-valuenow="{{ $location->diskusage->free_space_percentage }}" aria-valuemin="{{ $location->diskusage->free_space_percentage }}" aria-valuemax="{{ $location->diskusage->free_space_percentage }}">{{ $location->diskusage->free_space_percentage }}%</div>
                                                    </div>

                                                @else
                                                    <div class="progress progress-lg">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ round( (int)$location->diskusage->free_space_percentage) }}%" aria-valuenow="{{ $location->diskusage->free_space_percentage }}" aria-valuemin="{{ $location->diskusage->free_space_percentage }}" aria-valuemax="{{ $location->diskusage->free_space_percentage }}">{{ $location->diskusage->free_space_percentage }}%</div>
                                                    </div>
                                                @endif


                                            @endif

                                        </a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6" style="">
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('location.edit',$location) }}">Edit</a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_all_data_of_location',$location->id) }}">Refreesh All Data</a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_content_of_location',$location->id) }}">Refreesh Content DATA </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_lms_data_of_location',$location->id) }}">Refreesh LMS Content DATA </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_spl_content',$location->id) }}">Refreesh SPL Content </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_cpl_content',$location->id) }}">Refreesh CPL Content  </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('location.sync_spl_cpl',$location->id) }}">Sync CPL SPL Content  </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_kdm_content',$location->id) }}">Refreesh KDms Content</a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('schedules.getschedules',$location->id) }}">Refreesh Schedule Content</a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('snmp.getsnmp',$location->id) }}">Refreesh SNMP Content</a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('playback.getplayback',$location->id) }}">Refreesh Playback </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('refresh_macro_data_by_location',$location->id) }}">Refreesh Macros </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('moviescod.getmoviescods',$location->id) }}">Refreesh MoviesCods </a>
                                                    <a class="btn btn-outline-primary dropdown-item" href="{{ route('diskusage.getdiskusage',$location->id) }}">Refresh diskusage </a>



                                                </div>
                                              </div>
                                        </td>

                                    </tr>
                                @endforeach

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
