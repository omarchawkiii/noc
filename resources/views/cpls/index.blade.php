@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header playlistbuilder-shadow">
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
                    <div class="col-xl-2">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                            </div>
                            <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="multiplex">
                                <option value="null">Multiplex</option>
                                <option value="linked">Linked</option>
                                <option value="unlinked">Unlinked</option>
                                <option value="Encryped">Encryped</option>
                                <option value="NoEncryped">No Encryped</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-xl-2">
                        <button type="button" id="refresh_lms"  class="btn btn-icon-text " style="color: #6f6f6f;background: #2a3038; height: 37px; display:none">
                            <i class="mdi mdi-server-network"></i> LMS </button>
                    </div>

                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="location-listing" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">No #</th>
                                    <th class="sorting">Cpl Name</th>
                                    <th class="sorting">Content Kind</th>
                                    <th class="sorting">Size</th>
                                    <th class="sorting" style="max-width: 250px">Available On </th>
                                    <th class="sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($screen)
                                    @foreach ($screen->cpls as $key => $cpl )
                                        <tr class="odd">
                                            <td class="sorting_1"><a>{{ $cpl->uuid }}</a> </td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $cpl->contentTitleText }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $cpl->contentKind }}</a></td>
                                            <td><a class="text-body align-middle fw-medium text-decoration-none" >{{ $cpl->available_on }}</a></td>
                                            <td>
                                                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cpl_model_-{{ $cpl->uuid }}" href="#"><i class="mdi mdi-magnify"> </i> </a>
                                                <div class=" modal fade " id="cpl_model_-{{ $cpl->uuid }}" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered  modal-xl">
                                                        <div class="modal-content border-0">
                                                            <div class="modal-header p-4 pb-0">
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                      <a class="nav-link active" id="Properties-tab" data-bs-toggle="tab" href="#Properties-{{ $cpl->uuid }}" role="tab" aria-controls="home" aria-selected="true">Properties</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                      <a class="nav-link" id="cpls-tab" data-bs-toggle="tab" href="#cpls-{{ $cpl->uuid }}" role="tab" aria-controls="Content CPLs" aria-selected="false">Content CPLs</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                      <a class="nav-link" id="schedules-tab" data-bs-toggle="tab" href="#schedules-{{ $cpl->uuid }}" role="tab" aria-controls="schedules" aria-selected="false">Related Schedules</a>
                                                                    </li>
                                                                  </ul>
                                                                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                                                            </div>
                                                            <div class="modal-body text-center p-4">

                                                                <div class="tab-content border-0">
                                                                    <div class="tab-pane fade show active" id="Properties-{{ $cpl->uuid }}" role="tabpanel" aria-labelledby="Properties-tab">
                                                                        <div class="card rounded border mb-2">
                                                                            <div class="card-body p-3">
                                                                                <div class="media  justify-content-start">
                                                                                    <div class="media-body d-flex align-items-center">
                                                                                        <i class=" mdi mdi-star icon-sm align-self-center me-3"></i>
                                                                                        <h6 class="mb-1">Title : </h6>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0  m-1">   </p>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0 "> {{ $cpl->contentTitleText }} </p>
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
                                                                                        <p class="mb-0  m-1">   </p>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0 "> {{ $cpl->uuid }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card rounded border mb-2">
                                                                            <div class="card-body p-3">
                                                                                <div class="media  d-flex justify-content-start mr-5">
                                                                                    <div class="media-body d-flex align-items-center">
                                                                                        <i class="mdi mdi-timer icon-sm align-self-center me-3"></i>
                                                                                        <h6 class="mb-1">Content Kind : </h6>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0  m-1">   </p>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0 "> {{ $cpl->contentKind }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="cpls-{{ $cpl->uuid }}" role="tabpanel" aria-labelledby="cpls-tab">
                                                                        <div class="">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>UUID</th>
                                                                                        <th>KDM Name</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($cpl->kdms as $kdm )
                                                                                        <tr>
                                                                                            <td> {{  $kdm->uuid }}</td>
                                                                                            <td> {{  $kdm->name }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                              </tbody>
                                                                            </table>
                                                                          </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="schedules-{{ $cpl->uuid }}" role="tabpanel" aria-labelledby="schedules-tab">
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
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">  </p>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">  </p>
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
                                            <p class="mb-0  m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 ">    </p>
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

function formatSize(sizeInBytes) {
    if (sizeInBytes >= 1024 * 1024 * 1024) {
        return (sizeInBytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    } else if (sizeInBytes >= 1024 * 1024) {
        return (sizeInBytes / (1024 * 1024)).toFixed(2) + ' MB';
    } else {
        return sizeInBytes + ' Bytes';
    }
}

</script>


<script>
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

       if(lms == true )
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
                                           +'<p class="mb-0  m-1">   </p>'
                                       +'</div>'
                                       +'<div class="media-body">'
                                           +'<p class="mb-0 "> '+ response.cpl.contentTitleText + ' </p>'
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
                                           +'<p class="mb-0  m-1">   </p>'
                                       +'</div>'
                                       +'<div class="media-body">'
                                           +'<p class="mb-0 "> '+ response.cpl.uuid + ' </p>'
                                       +'</div>'
                                   +'</div>'
                               +'</div>'
                           +'</div>'
                           +'<div class="card rounded border mb-2">'
                               +'<div class="card-body p-3">'
                                   +'<div class="media  d-flex justify-content-start mr-5">'
                                       +'<div class="media-body d-flex align-items-center">'
                                           +'<i class="mdi mdi-star icon-sm align-self-center me-3"></i>'
                                           +'<h6 class="mb-1">Kind : </h6>'
                                       +'</div>'
                                       +'<div class="media-body">'
                                           +'<p class="mb-0  m-1">   </p>'
                                       +'</div>'
                                       +'<div class="media-body">'
                                           +'<p class="mb-0 "> '+ response.cpl.contentKind + '   </p>'
                                       +'</div>'
                                   +'</div>'
                               +'</div>'
                           +'</div>'

                           +'<div class="card rounded border mb-2">'
                               +'<div class="card-body p-3">'
                                   +'<div class="media  d-flex justify-content-start mr-5 row">'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1"> <i class="mdi mdi-timer icon-sm align-self-center"></i>  Duration   '+ response.cpl.durationEdits + '  </h6>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1"> <i class="mdi mdi-table-edit icon-sm align-self-center "></i> Edit Rate    '+ response.cpl.EditRate + ' </h6>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1"><i class="mdi mdi-chart-pie icon-sm align-self-center "></i> Disk size   '+ formatSize(response.cpl.totalSize) + ' </h6>'
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
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.pictureHeight + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture width  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.pictureWidth + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture Encoding Algorithm   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.pictureEncodingAlgorithm + '</p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture Encryption Algorithm  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.pictureEncryptionAlgorithm + '</p>'
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
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.soundChannelCount + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Sound Encoding Algorithm </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.soundEncodingAlgorithm + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Sound Encryption   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0  m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 "> '+ response.cpl.soundEncryptionAlgorithm + '   </p>'
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


       if(lms == true )
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
                                       +'<th>SPL Name</th>'

                                   +'</tr>'
                               +'</thead>'
                               +'<tbody>'

                   $.each(response.spls, function( index, value ) {

                   result = result
                                   +'<tr>'
                                        +'<th>'+value.uuid_spl+'</th>'
                                        +'<th>'+value.spl.name+'</th>'


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

    // filter location
    (function($) {

        var cpl_datatable = $('#location-listing').DataTable({
            "iDicplayLength": 10,
            destroy: true,
            "bDestroy": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });

        function get_cpls(location , screen , lms , multiplex,refresh_screen)
        {

            result ="" ;
            var url = "{{  url('') }}"+ '/get_cpl_with_filter/';
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    location: location,
                    screen_id: screen,
                    multiplex: multiplex,
                    lms : lms,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(response)
                {
                    console.log(refresh_screen)
                    if(refresh_screen != false)
                    {
                        screens = '<option value="null" selected>All screen </option>';
                        $.each(response.screens, function( index_screen, screen ) {

                            screens = screens
                                +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                        });
                            $('#screen').html(screens)
                    }

                    if(response.cpls.length>0)
                    {
                        $.each(response.cpls, function( index, value ) {
                            index ++ ;
                            if( value.available_on)
                            {
                                available_on_array =  value.available_on.split(",");
                                available_on_content=""
                                for(i = 0 ; i< available_on_array.length ; i++ )
                                {
                                    if(i != 0 &&  i % 9 == 0 )
                                    {
                                        available_on_content = available_on_content + '<br />'
                                    }
                                    available_on_content = available_on_content + '<div class="badge badge-outline-primary m-1">'+ available_on_array[i]+'</div>'
                                }
                            }
                            else
                            {
                                available_on_content=""
                            }


                            playable =""
                            if(value.playable == 1)
                            {
                                playable = "bg-playable" ;
                            }
                            else
                            {
                                playable = "bg-no-playable";
                            }

                            var encrypted="";
                                if(value.pictureEncryptionAlgorithm=="None" || value.pictureEncryptionAlgorithm=="0"){
                                    encrypted="";
                                }else{
                                    encrypted="<i class=\"cpl_need_kdm mdi btn-success mdi-lock-outline p-1 m-1 rounded\"  ></i> ";
                                }


                                var style = (value.pictureEncryptionAlgorithm == "Flat") ? "color:#52d4f7;" :
                                (value.pictureEncryptionAlgorithm == "Scope") ? "color:#36ffb9;" :
                                    "color:white;";

                                var title= '<span '+style+'>' + value.contentTitleText +
                                    encrypted +
                                    (value.cpl_is_linked == "1" ? ' <span class=\"mdi mdi-calendar-clock custom-calendar p-1 m-1 btn-primary rounded\"  ></span>':"  ")
                                    +

                                    '  </span>';




                            result = result
                                +'<tr class="odd  '+playable+' text-center">'
                                +'<td class="sorting_1">'+ index+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none text-center" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+title+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none text-center">'+value.contentKind+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none text-center">' +formatSize(value.totalSize)+ '</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none text-center">' + available_on_content + '</a></td>'
                                +'<td><a class="btn btn-primary infos_modal text-center" data-bs-toggle="modal" data-bs-target="#infos_modal" href="#" id="'+value.id+' " data-location="'+value.location.id+'"> <i class="mdi mdi-magnify"> </i> </a></td>'
                                +'</tr>';
                        });
                    }

                    $('#location-listing tbody').html(result)


                    /***** refresh datatable **** **/

                    var cpl_datatable = $('#location-listing').DataTable({
                        "iDicplayLength": 10,
                        destroy: true,
                        "bDestroy": true,
                        "language": {
                            search: "_INPUT_",
                            searchPlaceholder: "Search..."
                        }
                    });

                },
                error: function(response) {

                }
            })
        }


        $('#screen').change(function(){

            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')

            var loader_content  =
           '<div class="jumping-dots-loader">'
               +'<span></span>'
               +'<span></span>'
               +'<span></span>'
               +'</div>'
            $('#location-listing tbody').html(loader_content)

            var country =  $('#country').val();
            var screen =  $('#screen').val();
            window.lms = false ;
            var location =  $('#location').val();
            var multiplex =  $('#multiplex').val();

            get_cpls(location , screen , false , multiplex,false)



        });

        $('#location').change(function(){
            $("#location-listing").dataTable().fnDestroy();
             $('#screen').find('option')
            .remove()
            .end()
            .append('<option value="null">All Screens</option>')

            var loader_content  =
           '<div class="jumping-dots-loader">'
               +'<span></span>'
               +'<span></span>'
               +'<span></span>'
               +'</div>'
            $('#location-listing tbody').html(loader_content)
            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var multiplex =  $('#multiplex').val();
            var screen =  null;
            window.lms = false ;
            if(location != "Locations")
            {
                $('#refresh_lms').show();
            }
            else
            {
                $('#refresh_lms').hide();
            }

            get_cpls(location , screen , false , multiplex,true)

        });



        $('#refresh_lms').click(function(){

            $("#location-listing").dataTable().fnDestroy();
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

            $('#screen').find('option')
            .remove()
            .end()
            .append('<option value="null">All Screens</option>')

            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var multiplex =  $('#multiplex').val();
            window.lms = true ;
            var screen =  null;
            get_cpls(location , screen , true , multiplex,true)


        });

        $('#multiplex').change(function(){
            $("#location-listing").dataTable().fnDestroy();

            var loader_content  =
           '<div class="jumping-dots-loader">'
               +'<span></span>'
               +'<span></span>'
               +'<span></span>'
               +'</div>'
            $('#location-listing tbody').html(loader_content)
            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var multiplex =  $('#multiplex').val();
            var screen =  null;
            window.lms = false ;
            if(location != "Locations")
            {
                $('#refresh_lms').show();
                get_cpls(location , screen , false , multiplex ,false)
            }
            else
            {
                $('#refresh_lms').hide();
            }





        });


    })(jQuery);


</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
@endsection
