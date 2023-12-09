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
            <div class="d-flex flex-row justify-content-between mt-2">

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
              <table class="table-responsive" id="order-listing">
                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="order-listing_length"><label>Show <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="order-listing_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search" aria-controls="order-listing"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="order-listing" class="table dataTable no-footer" aria-describedby="order-listing_info">
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
                            <td class="sorting_1"><a href="{{ route('location.show',$location) }}"> {{  $key }}</a> </td>
                            <td><a href="{{ route('location.show',$location) }}"> {{ $location->name }}</a></td>
                            <td><a href="{{ route('location.show',$location) }}"> {{ $location->folder_title }}</a></td>
                            <td ><a href="{{ route('location.show',$location) }}"> {{ $location->screens->count() }}</a></td>
                            <td><a href="{{ route('location.show',$location) }}"> {{ $location->city }}</a></td>
                            <td><a href="{{ route('location.show',$location) }}"> {{ $location->state }}</a></td>
                            <td><a href="{{ route('location.show',$location) }}"> {{ $location->created_at }}</a></td>
                            <td><a class="btn btn-outline-primary" href="{{ route('location.edit',$location) }}">Edit</a></td>
                        </tr>
                    @endforeach

                </tbody>
                </table>

            </div>
          </div>
        </div>
      </div>



@endsection

@section('custom_script')


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


<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
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
