@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Locations </h3>
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

                    <a  href="{{ route('location.create') }}" class="btn btn-success btn-icon-text">
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
                                    <th class="sorting">Screen number</th>
                                    <th class="sorting">City </th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting">Creatred At</th>
                                    <th class="sorting">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $key => $location )
                                    <tr class="odd">
                                        <td class="sorting_1"><a href="{{ route('location.show',$location) }}"> {{  $key +1 }}</a> </td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->name }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->folder_title }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->screens->count() }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->city }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->state }}</a></td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" href="{{ route('location.show',$location) }}"> {{ $location->created_at }}</a></td>
                                        <td>
                                            <a class="btn btn-outline-primary" href="{{ route('location.edit',$location) }}">Edit</a>
                                            <a class="btn btn-outline-primary" href="{{ route('refresh_all_data_of_location',$location) }}">Refreesh Location </a>
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
        search: ""
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
</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
@endsection
