@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">SPLS </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">SPLS</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">SPLS</h4>
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
                                    <th class="sorting">Playlist</th>
                                    <th class="sorting">Available On </th>
                                    <th class="sorting">Duration </th>
                                    <th class="sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($screen)
                                    @foreach ($screen->spls as $key => $spl )
                                        <tr class="odd">
                                            <td class="sorting_1"><a>{{ $spl->id }}</a> </td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->name }}</a> <br /></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->available_on }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $spl->duration }}</a></td>
                                            <td>
                                                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#spl_model_-{{ $spl->id }}" href="#"><i class="mdi mdi-magnify"> </i> </a>
                                                <div class=" modal fade " id="spl_model_-{{ $spl->id }}" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered  modal-xl">
                                                        <div class="modal-content border-0">
                                                            <div class="modal-header p-4 pb-0">
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                      <a class="nav-link active" id="Properties-tab" data-bs-toggle="tab" href="#Properties-{{ $spl->id }}" role="tab" aria-controls="home" aria-selected="true">Properties</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                      <a class="nav-link" id="cpls-tab" data-bs-toggle="tab" href="#cpls-{{ $spl->id }}" role="tab" aria-controls="Content CPLs" aria-selected="false">Content CPLs</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                      <a class="nav-link" id="schedules-tab" data-bs-toggle="tab" href="#schedules-{{ $spl->id }}" role="tab" aria-controls="schedules" aria-selected="false">Related Schedules</a>
                                                                    </li>
                                                                  </ul>
                                                                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center p-4">

                                                                <div class="tab-content border-0">
                                                                    <div class="tab-pane fade show active" id="Properties-{{ $spl->id }}" role="tabpanel" aria-labelledby="Properties-tab">
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
                                                                                        <p class="mb-0 text-muted"> {{ $spl->name }} </p>
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
                                                                                        <p class="mb-0 text-muted"> {{ $spl->uuid }} </p>
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
                                                                                        <p class="mb-0 text-muted">   {{ $spl->duration }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="cpls-{{ $spl->id }}" role="tabpanel" aria-labelledby="cpls-tab">
                                                                        <div class="">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>UUID</th>
                                                                                        <th>CPL Name</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($spl->cpls as $cpl )
                                                                                        <tr>
                                                                                            <td> {{  $cpl->uuid }}</td>
                                                                                            <td> {{  $cpl->contentTitleText }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                              </tbody>
                                                                            </table>
                                                                          </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="schedules-{{ $spl->id }}" role="tabpanel" aria-labelledby="schedules-tab">
                                                                     Lorem ipsum dolor sit amet consectetur adipisicing elit.<br />Fugiat ipsum facilis debitis similique, libero ratione labore laudantium <br />repellendus illum sit reprehenderit voluptatem laborum repudiandae molestias rem ea aperiam impedit praesentium.
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    <!--end modal-content-->
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

        var spl_datatable = $('#location-listing').DataTable({

        "iDisplayLength": 10,
            destroy: true,
            "bDestroy": true,

        });

        $('#screen').change(function(){

            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')


            var country =  $('#country').val();
            var screen =  $('#screen').val();
            if(screen == 'null')
            {
                var location =  $('#location').val();

            }
            else
            {
                var location =  null;
            }

            var url = '/get_spl_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;

            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    $.each(response.spls, function( index, value ) {

                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+ value.id+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.available_on+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                            +'<td><button type="button" class="btn btn-outline-primary"> <i class="mdi mdi-magnify"> </i> </button></td>'
                            +'</tr>';
                    });
                    console.log(response.spls)

                    $('#location-listing tbody').html(result)
                    /***** refresh datatable ***** */

                    var spl_datatable = $('#location-listing').DataTable({

                        "iDisplayLength": 10,
                        destroy: true,
                        "bDestroy": true,

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

            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  null;

            var url = '/get_spl_with_filter/?location=' + location + '&country='+ country +'&screen='+ screen;
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
                        $('#screen').html(screens)

                    $.each(response.spls, function( index, value ) {

                        result = result
                            +'<tr class="odd">'
                            +'<td class="sorting_1">'+ value.id+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.name+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.available_on+'</a></td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                            +'<td><button type="button" class="btn btn-outline-primary"> <i class="mdi mdi-magnify"> </i> </button></td>'
                            +'</tr>';
                    });
                    $('#location-listing tbody').html(result)

                    console.log(response.spls)
                    /***** refresh datatable **** **/

                    var spl_datatable = $('#location-listing').DataTable({
                        "iDisplayLength": 10,
                        destroy: true,
                        "bDestroy": true,
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
