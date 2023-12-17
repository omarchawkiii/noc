@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">CPLS </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">CPLS</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">CPLS</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-2">
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


                    <div class="col-xl-2">
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

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">No #</th>
                                    <th class="sorting">Cpl Name</th>
                                    <th class="sorting">Content Kind</th>
                                    <th class="sorting" style="max-width: 250px">Available On </th>
                                    <th class="sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($screen)
                                    @foreach ($screen->cpls as $key => $cpl )
                                        <tr class="odd">
                                            <td class="sorting_1"><a>{{ $cpl->id }}</a> </td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $cpl->contentTitleText }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $cpl->contentKind }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > @if($cpl->cpl_is_linked) <i class="mdi mdi-link-variant text-success"> </i> @else  <i class="mdi mdi-link-variant-off text-danger"> </i> @endif</a></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#cpl_model_{{ $cpl->id }}"><i class="mdi mdi-magnify"> </i></button>
                                                <div class="modal fade" id="cpl_model_{{ $cpl->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                          ...
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif

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


    (function($) {
    'use strict';
    $(function() {



    });
    })(jQuery);



    // filter location
    (function($) {

        var cpl_datatable = $('#location-listing').DataTable({

        "iDisplayLength": 10,
            destroy: true,
            "bDestroy": true,
            'columnDefs': [
                {'max-width': '20%', 'targets': 0}
            ]

        });

        $('#screen').change(function(){

            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')

            var location =  null;
            var country =  $('#country').val();
            var screen =  $('#screen').val();

            var url = '/get_cpl_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;

            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    $.each(response.cpls, function( index, value ) {

                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+ value.id+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.contentTitleText+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.contentKind+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">' + value.cpl_is_linked + '</a></td>'
                            +'<td><button type="button" class="btn btn-outline-primary"> <i class="mdi mdi-magnify"> </i> </button></td>'
                            +'</tr>';
                    });
                    console.log(response.cpls)

                    $('#location-listing tbody').html(result)
                    /***** refresh datatable ***** */

                    var cpl_datatable = $('#location-listing').DataTable({

                        "iDisplayLength": 10,
                        destroy: true,
                        "bDestroy": true,
                        'columnDefs': [
                            {'max-width': '20%', 'targets': 0}
                        ]

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
            .append('<option value="null">Screens</option>')

            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  null;

            var url = '/get_cpl_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;
            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    screens = '<option value="null" selected>Screens</option>';
                    $.each(response.screens, function( index_screen, screen ) {

                        screens = screens
                            +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                    });
                        $('#screen').html(screens)

                    $.each(response.cpls, function( index, value ) {

                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+ value.id+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.contentTitleText+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.contentKind+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">' + value.cpl_is_linked + '</a></td>'
                            +'<td><button type="button" class="btn btn-outline-primary"> <i class="mdi mdi-magnify"> </i> </button></td>'
                            +'</tr>';
                    });
                    console.log(response.cpls)
                    $('#location-listing tbody').html(result)

                    console.log(response.cpls)
                    /***** refresh datatable **** **/

                    var cpl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 10,
                        destroy: true,
                        "bDestroy": true,
                        'columnDefs': [
                            {'max-width': '20%', 'targets': 0}
                        ]
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
@endsection
