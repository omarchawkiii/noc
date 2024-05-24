@extends('layouts.app')
@section('title') Schedules  @endsection
@section('content')
    <div class="page-header scheduler-shadow">
        <h3 class="page-title">Schedules </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedules</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Schedules</h4>
                    </div>
                    <div>
                        <button id="refresh" class="btn btn-light btn-fw  btn-icon-text"> <i class="mdi mdi-reload btn-icon-prepend"></i> Refresh</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 row">
                        <div class="col-xl-4">
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

                        <div class="col-xl-4">
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
                        <div class="col-xl-4">
                            <button type="button" id="linking_btn" class=" btn btn-primary btn-icon-text" >
                                <i class="mdi mdi-link-variant "></i>  Edit Links
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 row " id="scheduleDate" style="display: none">

                        <div class="col-xl-3 justify-content-end d-flex " >
                            <button type="button" id="btnPrevDate" class="btn btn-icon-text " style="color: rgb(111, 111, 111); background: rgb(42, 48, 56); height: 37px;">
                                <i class="mdi mdi-arrow-left"></i>Prev
                            </button>
                        </div>
                        <div class="col-xl-6 " >
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                                <input type="text" class="form-control"  id="scheduleDatePicker">

                            </div>
                        </div>
                        <div class="col-xl-3  d-flex " >
                            <button type="button" id="btnNextDate" class="btn btn-icon-text " style="color: rgb(111, 111, 111); background: rgb(42, 48, 56); height: 37px;">
                                Next <i class="mdi mdi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="preview-list multiplex  ">
                        <div class="table-responsive ">
                            <table id="location-listing" class="table ">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc">Type #</th>
                                        <th class="sorting">Screen</th>
                                        <th class="sorting">Movie </th>
                                        <th class="sorting">Date/Time </th>
                                        <th class="sorting">Spl</th>
                                        <th class="sorting">Note</th>
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
                                                    <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#infos_modal" href="#"><i class="mdi mdi-magnify"> </i> </a>


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
                          <a class="nav-link" id="cpls-tab" data-bs-toggle="tab" href="#cpls" role="tab" aria-controls="Content CPLs" aria-selected="false">Content CPLs</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="schedules-tab" data-bs-toggle="tab" href="#schedules" role="tab" aria-controls="schedules" aria-selected="false">Related Schedules</a>
                        </li>
                      </ul>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <p class="mb-0 text-muted m-1">   </p>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0 text-muted">  </p>
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
                                            <p class="mb-0 text-muted">  </p>
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
                                            <p class="mb-0 text-muted">    </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cpls" role="tabpanel" aria-labelledby="cpls-tab">
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
                        <div class="tab-pane fade" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
                        </div>
                    </div>


                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="linking_modal" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="no_linked_spls_movies_tab" data-bs-toggle="tab" href="#no_linked_spls_movies" role="tab" aria-controls="home" aria-selected="true">No linked</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="linked_spls_movies_tab" data-bs-toggle="tab" href="#linked_spls_movies" role="tab" aria-controls="Content CPLs" aria-selected="false">Linked </a>
                        </li>

                      </ul>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="tab-content border-0">
                        <div class="tab-pane fade show active" id="no_linked_spls_movies" role="tabpanel" aria-labelledby="no_linked_spls_movies_tab-tab">
                            <div class="row " >
                                <div class="col-md-6 preview-list multiplex">
                                    <div class="row">
                                        <h4 class="card-title col-xl-3" style="font-weight: bold;padding-bottom: 8px; width: fit-content">
                                            <span class="mdi mdi-format-list-bulleted-type   custom-icon " style="color: #26a1eb;"></span>
                                            SPLs List
                                        </h4>
                                        <div class="col-xl-8">
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="text" class="form-control" id="search_unlinked_spl" placeholder="Search ">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="spls_table">

                                    <tbody>

                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6  preview-list multiplex" >
                                    <div class="row">
                                        <h4 class="card-title col-xl-3" style="font-weight: bold;padding-bottom: 8px; width: fit-content ">
                                            <span class="mdi mdi-movie  custom-icon " style="color: #26a1eb;"></span>
                                            Films
                                        </h4>
                                        <div class="col-xl-8">
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="text" class="form-control" id="search_unlinked_film" placeholder="Search ">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="movies_table">

                                        <tbody>

                                    </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row " >
                                <div class="col-md-12 " >
                                    <button type="button " id="link_spl_movies_btn" class=" btn btn-primary  btn-icon-text " style="margin: 15px auto 0px auto; display: table;">
                                    <i class="mdi mdi-check "></i> Apply </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="linked_spls_movies" role="tabpanel" aria-labelledby="linked_spls_movies-tab">
                            <div class="row " >
                                <div class="col-md-12  preview-list multiplex" >
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="input-group mb-3 mr-sm-2">
                                                <input type="text" class="form-control" id="search_linked_spl_films" placeholder="Search In SPLs List Or Films">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <h4 class="card-title col-xl-3" style="font-weight: bold;padding-bottom: 8px; width: fit-content">
                                                <span class="mdi mdi-format-list-bulleted-type   custom-icon " style="color: #26a1eb;"></span>
                                                SPLs List
                                            </h4>

                                        </div>
                                        <div class="col-md-6 row">
                                            <h4 class="card-title col-xl-3" style="font-weight: bold;padding-bottom: 8px; width: fit-content">
                                                <span class="mdi mdi-movie  custom-icon " style="color: #26a1eb;"></span>
                                                Films
                                            </h4>

                                        </div>
                                    </div>

                                    <table class="table" id="linked_movies_spl_table">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class="modal fade " id="no-location-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select Location </h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <h4 class="text-center"> No Location Selected!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                            data-bs-dismiss="modal" aria-label="Close">OK
                    </button>


                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="ingest_spl" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <h4 class="text-center">This SPL does not exist on this location, would you like to ingest it?</h4>
                </div>
                <div class="modal-footer">
                    <button id="submit-ingest-form" type="button" style="margin: auto" class="btn btn-secondary btn-fw "
                            >OK
                    </button>


                </div>

            </div>
        </div>
    </div>
    <div class=" modal fade " id="ingest-response" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" style="border: 1px solid #5f5a5a">
            <div class="modal-content border-0">

                <div class="modal-header p-4 pb-0">
                    <h5></h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="" id="ingest-response-content" >

                    </div>
                    <div class="row mt-2">
                        <div class="col" style="text-align: center">
                            <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


    <!--   delete spl -->
    <div class="modal fade show" id="unlink-spl" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog"   role="document">
            <div class="modal-content" style="background: #000000">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Unlink</h5>
                    <button type="button"  data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <input type="hidden" id="id-mivie-to-unlink">
                <div class="modal-body minauto">

                </div>
                <div class="modal-footer" style="display: block;text-align: center">
                    <button type="button" class="btn btn-success" id="confirm_inlink">Confirm</button>
                    <button type="button" class="btn btn-light"  data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>

    </div>


    <div class=" modal fade " id="missing_cpls_schedule_check" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" >
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>Missing Cpls </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body ">
                    <div id="missing_cpls"></div>
                    <div id="unplayble_cpls"></div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="check_need_kdm_model" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" >
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>missing KDMs </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body ">

                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


    <!-- schedule Info -->


    <div class=" modal fade " id="sessions_details_modal" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered   modal-lg" >
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>Session Details </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body ">
                    <div class=" border row">
                        <div class="card-body col-md-4">
                            <div class="media  justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class=" mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text">SPL Title :   <span id="spl_title_details">PEMANDI JENAZAH [7-3]</span> </h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body col-md-5">
                            <div class="media  d-flex justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text" style="text-align: left!important;font-size: 13px">SPL UUID :   <span id="details_spl_uuid">urn:uuid:555b13dd-3dd0-4656-a87f-7805996e3933</span></h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body col-md-3">
                            <div class="media  d-flex justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text">Screen : <span id="session_screen_details">4</span></h6>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class=" border row">
                        <div class="card-body col-md-4">
                            <div class="media  justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class=" mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text">Session Start : <span id="session_start_details">2024-03-09 16:45:00</span> </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body col-md-4">
                            <div class="media  d-flex justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text">Session End : <span id="session_end_details">2024-03-09 18:46:50</span></h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body col-md-4">
                            <div class="media  d-flex justify-content-start">
                                <div class="media-body d-flex align-items-center">
                                    <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                    <h6 class="mb-1 custom-text">Type :  <span id="session_type_details">POS</span></h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class=" border row">
                        <div class=" row  ">
                            <!--<h4 class="card-title col-md-7 " style="padding-bottom: 8px;   margin-top: 20px; text-align: left">
                                <i class="mdi mdi-star icon-sm align-self-center me-3"></i>
                                Current CPL : <span id="current_cpl_details" style="font-size: 15px"> </span> <span id="current_cpl_playback_details"> </span>
                            </h4>

                            <h4 class="card-title col-md-5 " style="margin-top: 28px;">
                                <div class="progress " style="height: 19px">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="height: 19px ; width: 0%; " id="progress_play_details" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 col-12">
                                    <small id="details_elapsed_runtime"> </small>
                                    <small id="details_remaining_runtime"> </small>
                                </div>
                            </h4>-->
                            <h4 class="card-title col-md-4 " style="margin-top: 20px;">
                                <span class="mdi mdi-filmstrip   monitor-icons btn btn-primary " style="border-bottom: 1px solid white;margin-right: 7px; font-size: 24px;  padding: 4px;"></span>
                                <span style="border-bottom: 1px solid white;padding-bottom: 8px;">Composition Playlist :</span>
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="table_cpls_details">
                                <thead>
                                    <tr>
                                        <th> Title</th>
                                        <th>CPL Present</th>
                                        <th style="z-index: 999999;">Playable</th>
                                        <th>KDM</th>
                                        <th> CompositionPlaylistId</th>
                                        <th> Content Available On</th>
                                    </tr>
                                </thead>
                                <tbody id="body_cpls_details" style="height: 600px;max-height: 600px;overflow-y: scroll">
                                    <tr style="  ">
                                        <td class="text-white">Pemandijenaza_FTR-V1_S_IND-en_MLY_71_2K_ST_20240221_RIC_IOP_VF</td>
                                        <td class="text-white" style="font-weight: bold;font-size: 15px;color:#00d25b!important "> YES </td>
                                        <td class="text-white custom-td" style="font-weight: bold;font-size: 15px;color:#00d25b!important "> YES  </td>
                                        <td class="text-white" style="color: white!important">  <span style="color:#00d25b">KDM Available </span> <hr class="custom-hr"> KDM UUID : urn:uuid:2514183c-dbcf-4ba0-a359-02644c016d7a <hr class="custom-hr"> Device Target : IMS3000 <hr class="custom-hr"> <span class="btn btn-danger notes ">KDM Already Expired :2024-03-06 15:59:00</span> </td>
                                        <td style="color: white!important">urn:uuid:9b1d037d-e822-408b-b408-ce024a303c1c</td>
                                        <td class="text-white"> BEAN-02, S-1, S-2, S-3, S-4, S-5, S-6, S-7, S-8, S-9 </td>
                                    </tr>
                                </tbody>
                            </table>
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
<!-- -------END  DATA TABLE ---- -->
<script src="https://kendo.cdn.telerik.com/2021.2.616/js/kendo.all.min.js"></script>

<script src="{{asset('/assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

<script>

(function($) {
        showSwal = function(type) {
        if (type === 'success-message') {
            swal({
                title: 'Congratulations!',
                //text: 'SPL and movie are linked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }
        if (type === 'link-spl') {
            swal({
                title: 'Done!',
                text: 'SPL and movie are linked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }

        if (type === 'unlink-spl') {
            swal({
                title: 'Done!',
                text: 'SPL and movie are unlinked',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }

        if (type === 'warning-message-and-cancel') {
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

        }

    })(jQuery);


    (function($) {

        var spl_datatable = $('#location-listing').DataTable({
        "iDisplayLength": 100,
            destroy: true,
            "bDestroy": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }

        });

        function get_schedule(location, screen, date, refresh_screen)
        {
            $("#location-listing").dataTable().fnDestroy();
            $('#location-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)
            if(location != "Locations")
            {
                $('#scheduleDate').show();
                result =" " ;
                date = date.toLocaleDateString('en-GB')+' 00' ;
                //var url = "{{  url('') }}"+ '/get_schedules_with_filter/?location=' + location  +'&screen='+ screen+'&date='+ date.toLocaleDateString('en-GB')+' 00';
                var url = "{{  url('') }}"+ '/get_schedules_with_filter';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data :{
                        location : location ,
                        screen : screen ,
                        date : date ,
                    },
                    success:function(response)
                    {
                        console.log(response)
                        if(refresh_screen)
                        {
                            screens = '<option value="null" selected>All Screens</option>';
                            $.each(response.screens, function( index_screen, screen ) {

                                screens = screens
                                    +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                            });
                            $('#screen').html(screens)
                        }


                        $.each(response.schedules, function( index, value ) {
                            bg_status="" ;
                            if(value.status !="linked" )
                            {
                                bg_status = "bg-danger"
                            }
                            icon_spl = ""
                            icon_cpl = ""
                            icon_kdm = ""
                            statu_content=""
                            statu_content = value.kdm_status ;

                            if(value.status !="linked" )
                            {
                                icon_spl = '<i class="mdi mdi-playlist-play text-danger"> </i>'
                                if(value.type == "pos")
                                {
                                    statu_content = '<spn class="text-danger" >Unlinked  </span>'
                                }

                                icon_kdm = '</i> <i data-scheduleidd = "'+value.id+'" class="mdi mdi-key-remove get_schedule_infos text-warning"> </i>'
                                icon_cpl = '<i class="mdi mdi-filmstrip text-warning ">'
                            }
                            else
                            {
                                //statu_content = '<spn class="text-success" > Linked</span>'
                                if(value.kdm_status =="")
                                {
                                    statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-danger get_schedule_infos  btn-fw"> KDM Missing Detected  </button>'
                                }
                                icon_spl =  '<i class="mdi mdi-playlist-play text-success"> </i>'
                                if(value.cpls ==1)
                                {
                                    icon_cpl = '<i class="mdi mdi-filmstrip text-success">'
                                    if(value.kdm  ==1 )
                                    {
                                        icon_kdm = '</i> <i data-scheduleidd = "'+value.id+'" class="mdi mdi-key-change text-success get_schedule_infos"> </i>'
                                    }
                                    else
                                    {
                                        icon_kdm = '</i> <i class="mdi mdi-key-remove text-danger check_need_kdm" data-scheduleidd = "'+value.id+'"> </i>'
                                    }

                                }
                                else
                                {
                                    icon_kdm = '</i> <i data-scheduleidd = "'+value.id+'"  class="mdi mdi-key-remove text-warning get_schedule_infos"> </i>'
                                    icon_cpl = '<i class="mdi mdi-filmstrip text-danger   spl_not_linked" data-scheduleidd = "'+value.id+'">'
                                    statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-danger get_schedule_infos  btn-fw"> CPL Missing Detected  </button>'
                                }

                            }
                            /*if(value.kdm_status =="not_valid_yet")
                            {
                                statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-warning btn-fw get_schedule_infos"> KDM Valide in :  '+value.date_expired+'</button>'
                            }
                            if(value.kdm_status =="expired")
                            {
                                statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-danger get_schedule_infos  btn-fw"> KDM Already Expired : '+value.date_expired+'</button>'
                            }
                            if(value.kdm_status =="warning")
                            {
                                statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-warning get_schedule_infos btn-fw">KDM Expired in : '+value.date_expired+'</button>'
                            }
                            if(value.kdm_status =="valid")
                            {
                                statu_content = '<button data-scheduleidd = "'+value.id+'" type="button" class="btn btn-success get_schedule_infos btn-fw"> KDM Expired in  : '+value.date_expired+'</button>'
                            }*/

                            var name =" " ;
                            if(value.type == "pos")
                            {
                                if(value.status== "linked" )
                                {
                                    var name =value.ShowTitleText  ;
                                }
                                else
                                {
                                    var name =value.titleShort  ;
                                }
                            }
                            else
                            {
                                var name =value.ShowTitleText  ;
                            }


                            result = result
                                +'<tr class="odd ">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.type+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen.screen_name+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+name+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ icon_spl + icon_cpl + icon_kdm +' </i></a></td>'
                                +'<td>'+statu_content+'</td>'
                                +'</tr>';
                        });
                        console.log(response.schedules)

                        $('#location-listing tbody').html(result)
                        /***** refresh datatable ***** */

                        var spl_datatable = $('#location-listing').DataTable({

                            "iDisplayLength": 100,
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
            else
            {
                $('#scheduleDate').hide();
                $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
            }
        }
        $('#screen').change(function(){
            var screen =  $('#screen').val();
            var date = new Date($('#scheduleDatePicker').val());
            var location =  $('#location').val();

            get_schedule(location, screen, date,false)

        });

        $('#location').change(function(){
            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  null;
            var date = new Date($('#scheduleDatePicker').val());

            get_schedule(location, screen, date,true)

        });

        $(document).on('click', '#linking_btn , #no_linked_spls_movies_tab', function () {
            $('#search_unlinked_spl').val('') ;
            $('#search_unlinked_film').val('') ;
            var location =  $('#location').val();
            if(location == 'Locations')
            {
                $('#no-location-selected').modal('show');
            }
            else
            {
                $('#linking_modal').modal('show');

                var loader_content  =
                '<div class="jumping-dots-loader">'
                    +'<span></span>'
                    +'<span></span>'
                    +'<span></span>'
                    +'</div>'
                $('#movies_table tbody').html(loader_content)
                $('#spls_table tbody').html(loader_content)

            var url = "{{  url('') }}"+ "/get_spl_and_movies/"+location ;
                var movies_table="" ;
                var noc_spl_table="";

            $.ajax({
                    url: url,
                    method: 'GET',

                    success:function(response)
                    {

                        $.each(response.movies, function( index, value ) {
                            movies_table +=
                            '<tr>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.id+'"  >'+ value.title+' </td>'
                            '</tr >'
                        });
                        $('#movies_table tbody').html(movies_table)

                        noc_spl_table ="" ;
                        $.each(response.lms_spl, function( index, value ) {
                            noc_spl_table +=
                            '<tr>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.uuid+'"  >'+ value.spl_title+' </td>'
                            '</tr >'

                        });
                        $.each(response.nos_spls, function( index, value ) {
                            noc_spl_table +=
                            '<tr>'
                                +'<td class="text-body align-middle fw-medium text-decoration-none" data-id="'+ value.uuid+'"  >'+ value.spl_title+' </td>'
                            '</tr >'

                        });


                        $('#spls_table tbody').html(noc_spl_table)

                    },
                    error: function(response) {

                    }
            })
            }





        });

        $(document).on('click', '#linked_spls_movies_tab', function () {

            var location =  $('#location').val();
                var loader_content  =
                '<div class="jumping-dots-loader">'
                    +'<span></span>'
                    +'<span></span>'
                    +'<span></span>'
                    +'</div>'
                $('#linked_movies_spl_table tbody').html(loader_content)

            var url = " {{  url('') }}"+ "/get_spl_and_movies_linked/"+location ;

                var movies_table="" ;


            $.ajax({
                    url: url,
                    method: 'GET',

                    success:function(response)
                    {

                        console.log(response)
                        //console.log(response.spl.name) ;
                        $.each(response.movies, function( index, value ) {
                            movies_table +=
                            '<tr id="'+value.id+'">'
                                +'<td style="width:50%" class="text-body spl_title align-middle fw-medium text-decoration-none" data-id="'+ value.nocspl_id+'"  >'+ value.title_spl+' </td>'
                                  +'<td style="width:50%" class="text-body film_title align-middle fw-medium text-decoration-none" data-id="'+ value.id+'"  >'+ value.title+' </td>'

                            '</tr >'
                        });
                        $('#linked_movies_spl_table tbody').html(movies_table)



                    },
                    error: function(response) {

                    }
            })






        });

        $(document).on('click', '#movies_table td', function () {
            $('#movies_table td').removeClass('selected') ;
            $(this).addClass('selected') ;
        })

        $(document).on('click', '#spls_table td', function () {
            $('#spls_table td').removeClass('selected') ;
            $(this).addClass('selected') ;
        })

        $(document).on('click', '#link_spl_movies_btn', function () {

            var spl_id = $('#spls_table td.selected').attr('data-id') ;
            var movie_id = $('#movies_table td.selected').attr('data-id') ;

            $.ajax({
                url:"{{  url('') }}"+ "/add_movies_to_spls",
                type: 'post',
                cache: false,
                data: {
                    movie_id: movie_id,
                    spl_id: spl_id,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    swal({
                        title: 'Refreshing',
                        allowEscapeKey: false,
                        allowOutsideClick: true,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {



                    if(response == "Success")
                    {
                        swal.close();
                        $('#spls_table td').removeClass('selected') ;
                        $('#movies_table td.selected').remove() ;
                        showSwal('link-spl') ;
                    }
                    else if(response == "missing")
                    {
                        swal.close();
                        $('#ingest_spl').modal('show') ;
                    }
                    else
                    {
                        swal.close();
                        showSwal('warning-message-and-cancel')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });




        })

        $(document).on('click', '#linked_movies_spl_table tbody tr', function () {
            movie_id = $(this).attr("id") ;
            movie_title = $(this).children('td:first-child').text()
            spl_title = $(this).children('td:nth-child(2)').text()


            $('#unlink-spl .modal-body').html('<p> Do you want to unlink '+movie_title+' from '+spl_title+'</p>')
            $('#id-mivie-to-unlink').val(movie_id) ;
            $('#unlink-spl').modal('show')

        })

        $(document).on('click', '#confirm_inlink', function () {
            var movie_id = $('#id-mivie-to-unlink').val() ;
            var location =  $('#location').val();
            $.ajax({
                url:"{{  url('') }}"+ "/unlink_spl_movie",
                type: 'post',
                cache: false,
                data: {
                    movie_id: movie_id,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    swal({
                        title: 'Refreshing',
                        allowEscapeKey: false,
                        allowOutsideClick: true,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if(response == "Success")
                    {
                        swal.close();
                        $('#unlink-spl').modal('hide')
                        $('#'+movie_id+'').remove() ;
                        showSwal('unlink-spl') ;
                    }
                    else
                    {
                        swal.close();
                        showSwal('warning-message-and-cancel')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });
        })

        $(document).on('click', '#submit-ingest-form', function ()
        {
            var spl_id = $('#spls_table td.selected').attr('data-id') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/sendXmlFileToApi";
            $('#ingest_spl').modal('hide');

            /*var uuid =  $('#nos-spl').val();
            var ingest_location =  $('#ingest-location').val();
            var duration = $('#nos-spl option').data('duration');
            var title = $('#nos-spl option').data('title');
            var apiUrl = $('#ingest-location option').data('locationip');*/


           // var apiUrl ="http://localhost/tms/system/api2.php" ;
            //path = $('#nos-spl option:selected').data('filepath');

            $.ajax({
                url:url,

                method: 'POST',
                cache: false,
                data: {
                    spl_id: spl_id,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {

                    try {
                        var missing_cpls  ;
                        $("#ingest-modal").modal('hide');
                        if(response.status == 1)
                        {
                            missing_cpls ='<p class="text-success">'+response.success+'</p>' ;
                            if(response.missing_cpls.length > 0)
                            {
                                missing_cpls +=
                                    '<p> there are CPLs missing in this location</p>'
                                    +'<table class="table">'
                                        +'<thead>'
                                            +'<tr>'
                                                +'<th>UUID </th>'
                                                +'<th>Title</th>'
                                            +'</tr>'
                                        +'</thead>'
                                        +'<tbody>'


                                $.each(response.missing_cpls, function(index, value) {
                                    missing_cpls +=
                                            '<tr>'
                                                +'<td style="font-size: 14px;">'+value.CPLId+'</td>'
                                                +'<td style="font-size: 14px;">'+value.AnnotationText+'</td>'
                                            +'</tr>' ;

                                })
                                missing_cpls +=
                                    '</tbody>'
                                    +'</table>' ;

                            }
                            $("#ingest-response").modal('show');
                                $('#ingest-response #ingest-response-content ').html(missing_cpls)
                        }
                        else
                        {
                            $("#ingest-response").modal('show');
                            $('#ingest-response #ingest-response-content ').html('<p class="text-danger">Error occurred while sending the request.</p>')
                        }

                    } catch (e) {
                        console.log(e);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });


        });


        $(document).on('click', '.spl_not_linked', function ()
        {
            var schedule_idd = $(this).attr('data-scheduleidd') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/get_unlinked_spl";
            var missing_cpls ="<h5 class=''> Missing CPLs </h5>" ;
            var unplayable_cpls ="<h5 class='mt-4'> Unplayble CPLs </h5>" ;
            $.ajax({
                url:url,

                method: 'GET',
                cache: false,
                data: {
                    schedule_idd: schedule_idd,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if(response.missing_cpls.length > 0)
                    {
                        missing_cpls +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.missing_cpls, function(index, value) {
                        missing_cpls +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        missing_cpls +=
                            '</tbody>'
                            +'</table>' ;
                            $("#missing_cpls_schedule_check").modal('show');
                            $('#missing_cpls_schedule_check #missing_cpls ').html(missing_cpls)
                    }
                    else
                    {
                        missing_cpls +=
                        '<p> No Data </p>'
                        $("#missing_cpls_schedule_check").modal('show');
                        $('#missing_cpls_schedule_check #missing_cpls').html(missing_cpls)
                    }

                    if(response.unplayable_cpls.length > 0)
                    {
                        unplayable_cpls +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.unplayable_cpls, function(index, value) {
                            unplayable_cpls +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        unplayable_cpls +=
                            '</tbody>'
                            +'</table>' ;
                            $("#missing_cpls_schedule_check").modal('show');
                            $('#missing_cpls_schedule_check #unplayble_cpls').html(unplayable_cpls)
                    }
                    else
                    {
                        unplayable_cpls +=
                        '<p> No Data </p>'
                        $("#missing_cpls_schedule_check").modal('show');
                        $('#missing_cpls_schedule_check #unplayble_cpls').html(unplayable_cpls)
                    }


                    console.log(response)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        });

        $(document).on('click', '.check_need_kdm', function ()
        {
            var schedule_idd = $(this).attr('data-scheduleidd') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/get_need_kdm";
            var missing_kdms ="" ;

            $.ajax({
                url:url,

                method: 'GET',
                cache: false,
                data: {
                    schedule_idd: schedule_idd,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if(response.missing_kdms.length > 0)
                    {
                        missing_kdms +=
                            '<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID </th>'
                                        +'<th>Title</th>'
                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'
                        $.each(response.missing_kdms, function(index, value) {
                        missing_kdms +=
                                '<tr>'
                                    +'<td style="font-size: 14px;">'+value.uuid+'</td>'
                                    +'<td style="font-size: 14px;">'+value.contentTitleText+'</td>'
                                +'</tr>' ;

                        })
                        missing_kdms +=
                            '</tbody>'
                            +'</table>' ;
                            $("#check_need_kdm_model").modal('show');
                            $('#check_need_kdm_model .modal-body ').html(missing_kdms)
                    }
                    else
                    {
                        missing_kdms +=
                        '<p> No Data </p>'
                        $("#check_need_kdm_model").modal('show');
                        $('#check_need_kdm_model .modal-body').html(missing_kdms)
                    }
                    console.log(response)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        });

        // get schedule infos
        $(document).on('click', '.get_schedule_infos', function ()
        {
            var schedule_idd = $(this).attr('data-scheduleidd') ;
            var location =  $('#location').val();
            var url = "{{  url('') }}"+   "/get_schedule_infos";
            $('#sessions_details_modal').modal('show') ;
            $.ajax({
                url:url,
                method: 'GET',
                cache: false,
                data: {
                    schedule_idd: schedule_idd,
                    location:location,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                   //alert(response.spl)
                    if(response.spl == null)
                    {
                        $('.modal-body').html('No Data') ;
                    }
                    else
                    {
                        $('#spl_title_details').html(response.spl.name)
                        $('#details_spl_uuid').html(response.spl.uuid)
                        $('#session_screen_details').html(response.schedule.screen.screen_name)
                        $('#session_start_details').html(response.schedule.date_start)
                        $('#session_end_details').html(response.schedule.date_end)
                        $('#session_type_details').html(response.schedule.type)
                        var result ="" ;
                        $.each(response.cpls_with_kdms, function( index, value ) {
                            var kdm_data_info ="" ;

                            if(value.kdm_infos.length !=0)
                            {
                                kdm_data_info ='<span style="color:#00d25b">KDM Available </span>'
                                            +'<hr class="custom-hr">'
                                            +'KDM UUID : '+value.kdm_infos['kdm_uuid'] +' '
                                            +'<hr class="custom-hr">'
                                            +' Device Target : '+value.kdm_infos['device_target'] +' '
                                            +'<hr class="custom-hr">'
                                            +'<span class="">'+value.kdm_infos['kdm_status'] +'</span>'
                            }
                            else
                            {
                                kdm_data_info =value.kdm ;
                            }
                            result = result

                                +'<tr class="odd ">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.title+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.cpl_present+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.cpl_playable+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+kdm_data_info+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.cpl_uuid+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.available_on+'</a></td>'


                                +'</tr>';

                        });
                        $('#body_cpls_details').html(result)
                    }


                    console.log(response)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });

        })

        $(document).on('click', '#refresh', function () {
            var location = $('#location').val() ;
            var screen =  null ;
            var date = new Date($('#scheduleDatePicker').val());
            var url ="{{  url('') }}"+ "/refresh_schedule_content/"+location;

            if(location == 'Locations')
            {
                swal({
                        title: '',
                        text: "Please Select Locaion.",
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
            else
            {
                $.ajax({
                        url:url,
                        type: 'get',

                        beforeSend: function () {
                            swal({
                                title: 'Refreshing',
                                closeOnEsc: false,
                                allowOutsideClick: false,
                                timerProgressBar: true,
                                onOpen: () => {
                                    swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            swal.close();
                            if(response.status)
                            {
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

                                    get_schedule(location, screen, date, true)

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
            }
        });


        var currentDate = new Date();
         var selectedDate = new Date();
         var startDate = new Date();
         var endDate = new Date();

         selectedDate.setDate(currentDate.getDate());
         startDate.setDate(currentDate.getDate() - 7);
         endDate.setDate(currentDate.getDate() + 7);

         $("#scheduleDatePicker").kendoDatePicker({
            value: selectedDate,
            min: startDate,
            max: endDate,
            change: function (e) {

                var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');

                selectedDate.setDate(datepicker.value().getDate());

                if (selectedDate.getDate() == endDate.getDate()) {
                     //$('#btnNextDate').prop('disabled', true);
                 } else if (selectedDate.getDate() == startDate.getDate()) {
                     //$('#btnPrevDate').prop('disabled', true);
                 }

                 if (selectedDate.getDate() != endDate.getDate()) {
                     //$('#btnNextDate').prop('disabled', false);
                 }
                 if (selectedDate.getDate() != startDate.getDate()) {
                     //$('#btnPrevDate').prop('disabled', false);
                 }

            }
         });

         $('#btnPrevDate').on('click', function () {
            //$('#btnPrevDate').prop('disabled', true);
            var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');
            selectedDate.setDate(selectedDate.getDate() - 1);
            datepicker.value(selectedDate);

            //$('#btnNextDate').prop('disabled', false);

            /*if (selectedDate.getDate() == startDate.getDate()) {
                $(this).prop('disabled', true);
            }*/

            var location =  $('#location').val();

            var screen =  $('#screen').val();
            var date = selectedDate;

            get_schedule(location, screen, date,false)

         });

         $('#btnNextDate').on('click', function () {
            //$('#btnNextDate').prop('disabled', true);
            var datepicker = $('#scheduleDatePicker').data('kendoDatePicker');
            selectedDate.setDate(selectedDate.getDate() + 1);
            datepicker.value(selectedDate);

            //$('#btnPrevDate').prop('disabled', false);

            /*if (selectedDate.getDate() == endDate.getDate()) {
                $(this).prop('disabled', true);
            }*/

            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  $('#screen').val();
            var date = selectedDate ;
            get_schedule(location, screen, date,false)

         });

    })(jQuery);

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

        window.spl_id = $(this).attr("id") ;

        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    //console.log(response.spl.name) ;

                        result =
                        '<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  justify-content-start">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class=" mdi mdi-star icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">Title :  </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.name + ' </p>'
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
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.uuid + ' </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  d-flex justify-content-start mr-5">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class="mdi mdi-timer icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">Duration : </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.spl.duration + '   </p>'
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

     $(document).on('click', '#cpls-tab', function () {

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#cpls').html(loader_content)
        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;

        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    //console.log(response.spl.name) ;
                    result =
                        '<div class="">'
                            +'<table class="table">'
                                +'<thead>'
                                    +'<tr>'
                                        +'<th>UUID</th>'
                                        +'<th>CPL Name</th>'

                                    +'</tr>'
                                +'</thead>'
                                +'<tbody>'

                    $.each(response.cpls, function( index, value ) {

                    result = result
                                    +'<tr>'
                                        +'<th>'+value.uuid+'</th>'
                                        +'<th>'+value.contentTitleText+'</th>'

                                    +'</tr>'
                    });
                    result = result
                                +'</tbody>'
                            +'</table>'
                        +'</div>'
                    $('#cpls').html(result)





                },
                error: function(response) {

                }
        })

    });

    $(document).on('click', '#schedules-tab', function () {

        var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
        $('#schedules').html(loader_content)
        var url = "{{  url('') }}"+ "get_spl_infos/"+spl_id ;
        $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    console.log() ;
                    if(response.schedules.length)
                    {
                        result =
                            '<div class="">'
                                +'<table class="table">'
                                    +'<thead>'
                                        +'<tr>'
                                            +'<th>Date</th>'
                                            +'<th>Screen Name</th>'
                                            +'<th>Screen Number</th>'
                                        +'</tr>'
                                    +'</thead>'
                                    +'<tbody>'

                        $.each(response.schedules, function( index, value ) {

                        result = result
                                        +'<tr>'
                                            +'<th>'+value.ContentKeysNotValidBefore+'</th>'
                                            +'<th>'+value.screen_name+'</th>'
                                            +'<th>'+value.screen_number+'</th>'

                                        +'</tr>'
                        });
                        result = result
                                    +'</tbody>'
                                +'</table>'
                            +'</div>'
                        $('#schedules').html(result)
                    }
                    else
                    {
                        $('#schedules').html('No data ')
                    }



                },
                error: function(response) {

                }
        })

    });




</script>



<script>
    (function($) {


    })(jQuery);

    //search Spls

    $("#search_unlinked_spl").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#spls_table td").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#search_unlinked_film").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#movies_table td").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });




    //search Films and films from linked list
    $("#search_linked_spl_films").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#linked_movies_spl_table tr").filter(function() {
            console.log($(this).parent('tr').text())
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



</script>
<script>
    let content_height = document.querySelector('.content-wrapper').offsetHeight;
    let navbar_height = document.querySelector('.navbar').offsetHeight;
    //let footer_height = document.querySelector('.footer').offsetHeight;
    let page_header_height = document.querySelector('.page-header ').offsetHeight;
    let content_max_height = content_height - navbar_height - page_header_height - 170;

    $(".multiplex").height(content_max_height);

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /*$(".preview-item").click(function() {

        $(this).toggleClass("selected");
    });*/
</script>
@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2021.2.616/styles/kendo.default-v2.min.css"/>

<style>
    #scheduleDatePicker
    {
        background: #2a3038;
        border-radius: 0;
        color: #4b5564 ;
    }
    .k-select
    {
        display: none !important ;
    }

    .dataTables_processing.card,
    .jumping-dots-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
</style>

<style>
    .custom-td {
        display: block;
        text-decoration: none;
        font-size: 0.9375rem;
        position: relative;
        padding: 0.75rem 1.7rem 0.75rem 1.25rem;
        padding-right: 1.7rem;
        color: #ffffff;
        font-weight: 500;
    }

    .custom-hr {
        width: 50%;
        margin-top: 9px;
        margin-bottom: 9px;
        color: white;
        height: 1px;
    }

    .notes {
        font-weight: bold;
    }

    .custom-btn {
        font-weight: bold;
        font-size: 17px;
    }

    #ingest_result {
        height: 400px;
        max-height: 400px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    #list_servers li button {
        width: 171px !important;
    }

    #list_servers {
        list-style: none;
    }

    #list_servers li {
        float: left;
        font-size: 20px;

        margin: 3px;
    }

    #list_servers .custom-check {
        line-height: 2 !important;
        font-size: 17px !important;
    }

    .select2-container--open {
        z-index: 9999; /* Adjust z-index as needed */
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        font-size: 14px;
        padding: 4px;
        font-weight: bold;
    }

    /*calendar */

    #schedule {
        display: grid;
        grid-template-rows: 30px repeat(4, 1fr);

        grid-template-columns: repeat(289, 1fr);
        border: 1px solid black;

        max-width: 2000px;
        width: 2000px;

        flex-grow: 1;
        position: relative;

        padding: 0px;

        /* adjust as needed */
    }


    .time-header, .auditorium {
        border: 1px solid black;
        text-align: center;
        position: sticky;
    }

    .time-header {
        border: 1px solid black;
        text-align: center;
        font-size: 11px;
        color: #e8e5e5;
        position: sticky;
        top: 0;

    }

    .fixed-width {
        width: 10px;
        font-size: 6px;
    }

    .cell > .event {
        grid-row: unset;
        grid-column: unset;
    }

    .auditorium, .cell {
        border: 1px solid #0000004f;
        text-align: center;
        height: 52px;
        color: white;
        padding: 2px;
    }

    .close-icon {
        cursor: pointer;

        font-size: 22px;
        width: 5%;
        float: right;
        margin: 2px;
        margin-top: -2px;

        color: #8b2424;
    }

    .cell.event-container {
        border: none;
    }

    .type_session_calendar {
        position: relative;
        top: -3px;
        font-size: 15px;
        font-weight: bolder;
        margin: 3px;
        float: left;
    }

    .event {
        cursor: pointer;
        border: 1px solid black;
        text-align: center;
        width: 100%;
        overflow: hidden;
        float: left;
    }

    .auditorium-header {
        left: 0;
        width: 109px;
        text-align: center;
        line-height: 4;
    }

    .header-hours {
        border: 1px solid #b1ffc67a;
        line-height: 2;
        font-size: 13px;
        z-index: 999999999 !important;
    }

    .sticky-header {
        position: -webkit-sticky; /* For Safari */
        position: sticky;
        z-index: 10; /* optional, to ensure headers are displayed above other content */
    }

    .sticky-header.hour {

        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 10;
        border: 1px solid #b1ffc67a;
    }

    .sticky-header.min {
        top: 20px; /* Adjust this value based on the height of the "hours" row */
    }

    .header-minutes {
        height: 25px !important;
    }

    .time-header {
        top: 0;
    }

    .current-time {
        ont-weight: bold;
        font-size: 12px;
        margin-top: 12px;
        display: block;
        color: #dbedec;
        background: black;
        width: 42px;
    }

    .time-header, .auditorium-header {
        position: sticky;
        z-index: 9999999;
        background-color: black;
        color: white;
    }

    .session_warning {
        color: yellow;
        height: 26px;
        padding: 4px;
        width: 26px;
        float: right;
        margin-left: 4px;
        margin-bottom: 7px;
        display: block;
    }

    .session-warning:hover {
        color: red; /* Change the color to red when hovered */
    }

    #parentContainer {
        display: flex;
    }

    .preview-list.multiplex, .fixed-hight {

        padding: 5px;
        height: auto;
        overflow: auto;
        text-align: justify;
        overflow-x: hidden;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #ffffff;
        font-weight: bold;
        background-color: #18263e;
        border-color: #2c2e33 #2c2e33 black;
    }

    .close-cpl-details {
        border: solid #5f95cce0;
        padding: 8px;
        line-height: 0;
    }
    #table_cpls_details {
        width: 100%;
    }

    #table_cpls_details thead th {
        position: sticky;
        top: 0;
        background-color: #18263e;
        font-weight: bold;
        font-size: 17px;
        color: white;
    }

    /*.table-responsive {
        max-height: 600px;
        overflow-y: auto;
    }*/
    #table_cpls_details td:nth-child(2),
    #table_cpls_details th:nth-child(2) {
        width: 160px; /* Set the desired width */
        max-width: 160px; /* Optionally, set a maximum width */
        overflow: hidden; /* Hide overflow content */
        text-overflow: ellipsis; /* Display ellipsis for overflow content */
        text-align: center;
    }

    /* Adjust the width of the "Playable" column */
    #table_cpls_details td:nth-child(3),
    #table_cpls_details th:nth-child(3) {
        width: 160px; /* Set the desired width */
        max-width: 160px; /* Optionally, set a maximum width */
        overflow: hidden; /* Hide overflow content */
        text-overflow: ellipsis; /* Display ellipsis for overflow content */
    }
    #table_cpls_details td:nth-child(1),
    #table_cpls_details th:nth-child(1) {
        width: 340px; /* Set the desired width */
        max-width: 340px; /* Optionally, set a maximum width */
       /* Hide overflow content */
        white-space: normal; /* Allow text to wrap */
    }
    #table_cpls_details td {
        height: 60px; /* Set the height you prefer */
        vertical-align: top; /* Align content vertically */
    }
    .hidden-icon {
        opacity: 0 !important;
    }
    .running-icon {
        opacity: 1;
        transition: opacity 0.5s ease; /* Smooth transition over 0.5 seconds */
    }
    .playback-tab-view{
        padding: 0px!important;
        margin-left: 4px!important;
        font-size: 20px!important;

        border: 0!important;

        line-height: 1!important;
    }
    .mr-1
    {
        margin-right: 5px !important ;
    }
    .check_need_kdm,
    .get_schedule_infos
    {
        cursor: pointer;
    }
</style>

@endsection
