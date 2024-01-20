@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')

            <div class="page-header playbck-shadow">
                <h3 class="page-title"> PlayList Builder </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">PlayList Builder </li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-xl-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                                </div>
                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location" name="location[]" multiple="multiple">


                                                    @foreach ($locations as $location )

                                                    <option  value="{{ $location->id }}">{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-7 ">
                                            <button type="button" class="btn btn-info btn-icon-text ">
                                                <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh
                                            </button>

                                            <button type="button" class="btn btn-warning btn-icon-text" id="ingest-spl">
                                                <i class="mdi mdi-grease-pencil  btn-icon-prepend"></i> Ingest SPL
                                            </button>

                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-xl-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                                </div>

                                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="filter_type">
                                                    <option value="all" selected="selected">All Elements</option>
                                                    <option value="Pattern">Pattern</option>
                                                    <option value="ADVERTISEMENT">ADVERTISEMENT</option>
                                                    <option value="FEATURE">FEATURE</option>
                                                    <option value="POLICY">POLICY</option>
                                                    <option value="PSA">PSA</option>
                                                    <option value="SHORT">SHORT</option>
                                                    <option value="TEASER">TEASER</option>
                                                    <option value="TEST">TEST</option>
                                                    <option value="TRAILER">TRAILER</option>
                                                    <option value="SPL"> Show Playlist</option>
                                                    <option value="Macros"> Macros</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-7 ">
                                            <div class="input-group palyback-form-text">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control"  placeholder="Search" id="search-dragula-left">

                                            </div>
                                        </div>


                                    </div>
                                    <div id="dragula-left" class="py-2  preview-list multiplex">
                                       <p class="text-center"> Please Select Location </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-4">
                                        <div class="col-xl-12 ">

                                            <button type="button" class="btn btn-success btn-icon-text" id="reset_spl_builder">
                                                <i class="mdi mdi-plus btn-icon-prepend"></i> New
                                            </button>
                                            <button type="button" class="btn btn-primary btn-icon-text"  id="display_spl_properties">
                                                <i class="mdi mdi-content-save btn-icon-prepend"></i> Save
                                            </button>

                                            <button type="button" class="btn btn-warning btn-icon-text" id="open_spl_list">
                                                <i class="mdi mdi-new-box  btn-icon-prepend"></i> Open
                                            </button>
                                            <button type="button" class="btn btn-info btn-icon-text" id="edit_spl_properties">
                                                <i class="mdi mdi-wrench btn-icon-prepend"></i> Propperties
                                            </button>

                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-xl-10 ">
                                            <div class="input-group mb-2 p-2 mr-sm-2 palyback-form-text">
                                                <span class="palyback-text" id="opened_spl" data-uuid="" data-hfr="" data-mod="" data-opened_spl_status="0">No Playlist Selected</span>

                                            </div>
                                        </div>
                                        <div class="col-xl-2">
                                            <a href="#" id="add_segment">
                                                <i class="btn btn-inverse-warning  mdi mdi-cube-outline" style=" margin-top: 2px;"></i>
                                            </a>
                                            <a href="#" id="show_marker_modal">
                                                <i class="btn btn-inverse-success  mdi mdi-map-marker" style=" margin-top: 2px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="dragula-right" class="py-2  preview-list multiplex">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class=" modal show " id="infos_modal" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
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
            <div class="modal fade show" id="macro-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Time Code   </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p class="text-center">The automation cue will be attached to the elements time code </p>
                                <h3 class="text-center">PreShow2DFlat XYZ </h3>
                                <p class="text-center">00 : 00 : 00</p>
                            </div>

                                <div class="row mt-2">
                                    <div class="form-group">
                                        <label>Offset </label>
                                        <div class="form-check mt-0">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> From the beginning of the clip  <i class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked=""> From the end of the clip <i class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Hours">Hours</label>
                                            <input type="number" class="form-control" id="Hours" placeholder="Hours">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Minutes">Minutes</label>
                                            <input type="number" class="form-control" id="Minutes" placeholder="Minutes">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Seconds">Seconds</label>
                                            <input type="number" class="form-control" id="Seconds" placeholder="Seconds">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col">

                                        <button type="submit" class="btn btn-primary me-2" id="confirm_add_macro">Confirm</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </div>
                                </div>


                        </div>

                    </div>
                </div>
            </div>

            <!--    macro  modal -->
            <div class="modal fade " id="no-cpl-selected"tabindex="-1" role="dialog"aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Please Select Playlist Item   </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center"> No CPL Selected!</h4>
                        </div>
                        <div class="modal-footer" >
                            <button  type="button" style="margin: auto" class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">OK</button>



                        </div>

                    </div>
                </div>
            </div>

            <!--   macro modal-->
            <div class="modal fade show" id="macro-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel"aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Time Code </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p class="text-center" style="font-size: 17px;">The automation cue will be attached to theelements time code </p>
                                <h3 class="text-center" id="macro_title" style="font-size: 17px;">PreShow2DFlat XYZ </h3>
                                <input type="hidden" value="" id="macro_command">
                                <input type="hidden" value="" id="macro_title_val">
                                <p class="text-center" style="font-size: 17px;" id="macro_time_hms">00 : 00 : 00</p>
                            </div>

                            <div class="row mt-2">
                                <div class="form-group">
                                    <label style="font-size: 17px;">Offset </label>
                                    <div class="form-check mt-0">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="Offset_macro"
                                                id="start_macro"
                                                value="Start"> From the beginning of the clip
                                            <i class="input-helper "></i><i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="Offset_macro"
                                                id="end_macro"
                                                value="End"
                                                checked=""> From the end of the clip
                                            <i class="input-helper "></i>
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Hours_macro" style="font-size: 17px;">Hours</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Hours_macro"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Minutes_macro" style="font-size: 17px;">Minutes</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Minutes_macro"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Seconds_macro" style="font-size: 17px;">Seconds</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Seconds_macro"
                                            value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col" style="text-align: center">

                                    <button type="button" class="btn btn-primary btn-fw" id="confirm_add_macro">Confirm</button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <!--    pattern modal -->
            <div class="modal fade " id="pattern_modal"  tabindex="-1" role="dialog"
                aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="ModalLabel">
                            <i class="mdi mdi-format-indent-increase" style="position: relative;top: 3px;font-size: 22px;color: #4b99ff;"></i>
                                Pattern Setup
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden"     id="pattern_title"  >

                                <h3 id="display_pattern_title" style="text-align: center"> </h3>
                                <p class="text-center font-weight-bold" style="font-size: 16px!important;">Output pattern duration:  <span id="pattern_in_seconds"></span> seconds   </p>
                            </div>

                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="form-group" >
                                            <label for="pattern_Minutes"  class="font-weight-bold" style="font-size: 17px!important">Minutes</label>
                                            <input type="number" class="form-control"  style="font-size: 17px!important" id="pattern_Minutes" value="0">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="pattern_Seconds" class="font-weight-bold" style="font-size: 17px!important">Seconds</label>
                                            <input type="number" class="form-control" style="font-size: 17px!important"  id="pattern_Seconds" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2" style="text-align: center">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary btn-fw" id="confirm_add_pattern">Confirm</button>
                                        <button  type="button" class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade show" id="spl-properties-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Save New Playlist Properties</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group custom-form-group">
                                            <label>SPL Title</label>
                                            <input type="text" class="form-control" id="spl_title" aria-label="SPL Title">
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <div class="form-group custom-form-group">
                                            <label>Display Mode</label>
                                            <select class="form-control" id="display_mode">
                                                <option>2D</option>
                                                <option>3D</option>
                                                <option>4K</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label hfr-label">
                                                <input type="checkbox" style=" opacity: 2; font-size: 28px;"
                                                    class="form-check-input " id="spl_properties_hfr"> HFR <i
                                                        class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="save_new_spl">Confirm</button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" modal fade " id="spl-list" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-xl">
                    <div class="modal-content border-0">

                        <div class="modal-header p-4 pb-0">
                            <h5>Playlists Available on NOC</h5>
                            <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <div class="" id="nocspls_content" >
                                <div class="">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Creation Date</th>
                                                <th>UUID </th>
                                                <th>Actions</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--end modal-content-->
                </div>
            </div>
            <div class="modal fade show" id="marker-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Marker Time Code </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p class="text-center" style="font-size: 17px;">The Marker will be attached to the elements time
                                    code : <span id="title_selected_item"></span></p>
                                <p class="text-center" style="font-size: 17px;">00 : 00 : 00</p>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label style="font-size: 17px;">Marker Label </label>
                                    <input type="text" id="marker_label" value=""/>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="form-group">
                                    <label style="font-size: 17px;">Offset </label>
                                    <div class="form-check mt-0">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="Offset_marker"
                                                id="start_marker"
                                                value="Start"> From the beginning of the clip
                                            <i class="input-helper "></i><i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="Offset_marker"
                                                id="end_marker"
                                                value="End"
                                                checked=""> From the end of the clip
                                            <i class="input-helper "></i>
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Hours_marker" style="font-size: 17px;">Hours</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Hours_marker"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Minutes_marker" style="font-size: 17px;">Minutes</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Minutes_marker"
                                            value="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Seconds_marker" style="font-size: 17px;">Seconds</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="Seconds_marker"
                                            value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="confirm_add_marker">Confirm
                                    </button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--      segment modal -->
            <div class="modal fade show" id="segment-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">
                                <i class="btn btn-inverse-warning  mdi mdi-cube-outline"  style="margin-right: 7px;"></i>Edit Pack Information </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group">
                                    <label for="pack_name">Pack Name</label>
                                    <input type="text" class="form-control" id="pack_name" value="">
                                    <input type="hidden" class="form-control" id="segment_uuid" value="">
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="confirm_add_segment">Confirm
                                    </button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade show" id="edit-marker-modal" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Marker Time Code </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p class="text-center" style="font-size: 17px;">The Marker will be attached to the elements time
                                    code : <span id="edit_title_selected_item"></span></p>
                                <p class="text-center" style="font-size: 17px;" id="edit_marker_time_hms">00 : 00 : 00</p>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label style="font-size: 17px;">Marker Label </label>
                                    <input type="text" id="edit_marker_label" value=""/>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="form-group">
                                    <label style="font-size: 17px;">Offset </label>
                                    <div class="form-check mt-0">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="edit_Offset_marker"
                                                id="edit_start_marker"
                                                value="Start"> From the beginning of the clip
                                            <i class="input-helper "></i><i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" style="font-size: 17px;">
                                            <input type="radio"
                                                class="form-check-input Offset"
                                                name="edit_Offset_marker"
                                                id="edit_end_marker"
                                                value="End"
                                                checked=""> From the end of the clip
                                            <i class="input-helper "></i>
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_Hours_marker" style="font-size: 17px;">Hours</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="edit_Hours_marker"
                                            value="0" min="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_Minutes_marker" style="font-size: 17px;">Minutes</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="edit_Minutes_marker"
                                            value="0" min="0">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_Seconds_marker" style="font-size: 17px;">Seconds</label>
                                        <input type="number" style="font-size: 17px;" class="form-control" id="edit_Seconds_marker"
                                            value="0" min="0">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="parent_uuid" value="">
                            <input type="hidden" id="marker_uuid" value="">
                            <div class="row mt-2">

                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="confirm_edit_marker">Confirm
                                    </button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--    no spl opened -->
            <div class="modal fade " id="no-spl-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="badge badge-warning" style="font-size: 18px;">Warning</div>

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4 class="text-center"> No SPL Selected!</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                                    data-bs-dismiss="modal" aria-label="Close">OK
                            </button>


                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade show" id="edit-spl-properties-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Save New Playlist Properties</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group custom-form-group">
                                            <label>SPL Title</label>
                                            <input type="hidden" class="form-control" id="uuid_spl_edit"  value="" >
                                            <input type="text" class="form-control" id="edit_spl_title" aria-label="SPL Title">
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <div class="form-group custom-form-group">
                                            <label>Display Mode</label>
                                            <select class="form-control" id="edit_display_mode">
                                                <option>2D</option>
                                                <option>3D</option>
                                                <option>4K</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label hfr-label">
                                                <input type="checkbox" style=" opacity: 2; font-size: 28px;"
                                                    class="form-check-input "> HFR <i class="input-helper"></i><i
                                                        class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="confirm_edit_spl_properties">
                                        Confirm
                                    </button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--   delete spl -->
            <div class="modal fade show" id="delete-spl" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog"   role="document">
                    <div class="modal-content" style="background: #000000">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">SPL Deletion</h5>
                            <button type="button"  data-bs-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <input type="hidden" id="id_spl_delete">
                        <div class="modal-body">
                            <p id="spl_title_to_delete">You will not be able to recover this .</p>
                            <p id="spl_uuid_to_delete">You will not be able to recover this .</p>
                            <p>You will not be able to recover this .</p>
                        </div>
                        <div class="modal-footer" style="display: block;text-align: center">
                            <button type="button" class="btn btn-success" id="confirm_delete_spl">Confirm</button>
                            <button type="button" class="btn btn-light"  data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Ingest Modal -->

            <div class=" modal fade " id="ingest-modal"  role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-xl">
                    <div class="modal-content border-0">

                        <div class="modal-header p-4 pb-0">
                            <h5>Playlists Available on NOC</h5>
                            <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center p-4">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3>SPL List </h3>
                                    <div id="ingest-spl-list"></div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Locations </h3>
                                    <div id="ingest-spl-location"></div>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col" style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-fw" id="submit-ingest-form">Ingest</button>
                                    <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--end modal-content-->
                </div>
            </div>


@endsection

@section('custom_script')
    <script src="{{ asset('assets/vendors/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragula.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        // Init multi select
$(document).ready(function() {
    $('#location').select2();
});



// *********************** functions ***** */

function formatDurationToHMS(duration) {
    //  console.log(new Date(duration  * 1000).toISOString().slice(11, 19));
    return new Date(duration * 1000).toISOString().slice(11, 19);

}
function convertHMSToSeconds(time) {
    var parts = time.split(":");
    var hours = parseInt(parts[0]);
    var minutes = parseInt(parts[1]);
    var seconds = parseInt(parts[2]);
    return hours * 3600 + minutes * 60 + seconds;
}

function convertSecondsToHMS(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds % 3600) / 60);
    var remainingSeconds = seconds % 60;

    // Add leading zeros if necessary
    hours = String(hours).padStart(2, '0');
    minutes = String(minutes).padStart(2, '0');
    remainingSeconds = String(remainingSeconds).padStart(2, '0');

    return hours + ':' + minutes + ':' + remainingSeconds;
}

function convertStringToSeconds(timeString) {

    var timeParts = timeString.split(':');
    var hours = parseInt(timeParts[0], 10);
    var minutes = parseInt(timeParts[1], 10);
    var seconds = parseInt(timeParts[2], 10);
    return (hours * 3600) + (minutes * 60) + seconds;

}

function formatSize(sizeInBytes) {
    if (sizeInBytes >= 1024 * 1024 * 1024) {
        return (sizeInBytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    } else if (sizeInBytes >= 1024 * 1024) {
        return (sizeInBytes / (1024 * 1024)).toFixed(2) + ' MB';
    } else {
        return sizeInBytes + ' Bytes';
    }
}

function formatTime(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds - (hours * 3600)) / 60);
    var secs = Math.floor(seconds - (hours * 3600) - (minutes * 60));
    return (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (secs < 10 ? "0" + secs : secs);
}

function uuidv4() {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

function getCplDetails(id_cpl, need_kdm) {
    $.ajax({
        url: 'system/controller_playlist_builder.php',
        type: 'post',

        data: {
            action_control: "get_cpl_details_left_sid",
            id_cpl: id_cpl,
            need_kdm: need_kdm
        },

        success: function (response) {

            var obj = JSON.parse(response);
            var detail_cpl = obj.details_cpl;
            if (detail_cpl == false) {

            }

            var details_spl_contains_cpl = obj.details_spl_contains_cpl;
            $('#date_create_ingest_details').html("Creation Date :" + detail_cpl.date_create_ingest);
            $('#details_title').html(detail_cpl.contentTitleText);
            $('#details_uuid').html(detail_cpl.uuid);
            $('#details_kind').html(detail_cpl.contentKind);
            let duration_Seconds = detail_cpl.durationEdits * detail_cpl.editRate_denominator / detail_cpl.editRate_numerator;

            duration_Seconds = convertSecondsToHMS(Math.round(duration_Seconds));
            $('#details_duration').html(duration_Seconds);
            $('#details_edit_rate').html(detail_cpl.editRate_numerator + " " + detail_cpl.editRate_denominator);
            $('#details_dcp_size').html(formatSize(detail_cpl.packageSizeInBytes));
            $('#details_pictureHeight').html(detail_cpl.pictureHeight);
            $('#details_pictureWidth').html(detail_cpl.pictureWidth);
            $('#details_pictureEncodingAlgorithm').html(detail_cpl.pictureEncodingAlgorithm);
            $('#details_pictureEncryptionAlgorithm').html(detail_cpl.pictureEncryptionAlgorithm);
            $('#details_soundChannelCount').html(detail_cpl.soundChannelCount);
            $('#details_soundEncodingAlgorithm').html(detail_cpl.soundEncodingAlgorithm);
            $('#details_soundEncryptionAlgorithm').html(detail_cpl.soundEncryptionAlgorithm);
            $("#cpl_detail_model_left").modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        },
        complete: function (jqXHR, textStatus) {
        }
    });
}

// open selected spl

function reorderMacroList(macroList) {


    // Get all the media-body elements within the container
    var macroBoxes = Array.from(macroList.querySelectorAll('.media-body.macro-box'));

    // Sort the media-body elements based on the text content of the target element
    macroBoxes.sort(function (a, b) {
        var timeA = a.querySelector('.mb-0.text-muted.float-left').innerText;
        var timeB = b.querySelector('.mb-0.text-muted.float-left').innerText;
        // Assuming the time format is HH:mm:ss, you may need to modify the comparison logic accordingly
        return timeA.localeCompare(timeB);
    });

    // Clear the existing content in the container
    macroList.innerHTML = '';

    // Append the sorted media-body elements back to the container
    macroBoxes.forEach(function (box) {
        macroList.appendChild(box);
    });
}

function extractEditRateValues(editRate) {
    var editRateArray = editRate.split(" ");
    var editRate_numerator = editRateArray[0];
    var editRate_denominator = editRateArray[1];

    return [editRate_numerator, editRate_denominator];
}

function reorderRightList(){
    var items = $('#dragula-right').find('.left-side-item');
    var startTime = 0;
    for (var i = 0; i < items.length; i++) {

        var duration = parseInt(items[i].getAttribute('data-time_seconds'));
        items[i].setAttribute('data-starttime', formatTime(startTime));
        var composition_start_time = items[i].getAttribute('data-starttime');
        startTime += duration;
        var composition_end_time = startTime;
        // Process the macro_list within the current item if it exists
        var macroItems = items[i].querySelectorAll('.macro-box ');

        if (macroItems.length > 0) {
            for (var j = 0; j < macroItems.length; j++) {
                var macroTime = macroItems[j].getAttribute('data-time');
                var macroKind = macroItems[j].getAttribute('data-offset');
                // Calculate the macro start time based on Kind
                var macroStartTime;
                if (macroKind === "Start") {
                    console.log(composition_start_time);
                    console.log(macroTime);
                    macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                } else if (macroKind === "End") {
                    console.log(composition_end_time);
                    console.log(macroTime);
                    macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                } else {
                    // Handle other cases if needed
                    macroStartTime = 0;
                }

                // Update the macro_time div with the calculated start time
                macroItems[j].querySelector('.mb-0.text-muted.float-left').innerText = convertSecondsToHMS(macroStartTime);
            }
        }

        var macroList = items[i].querySelector('.card-body.macro-list');
        reorderMacroList(macroList);
    }
}
function extractTimeComponents(timeString) {
    // Split the time string into hours, minutes, and seconds
    const [hours, minutes, seconds] = timeString.split(':').map(Number);

    return {
        hours,
        minutes,
        seconds
    };
}
function setSplOpenedData(capabilities) {
    const obj = {"capabilities": capabilities};
    $('#id_spl_opened').attr('data-hfr', 0);
    $('#id_spl_opened').attr('data-mod', "2D");
    if (typeof obj.capabilities === 'object' && obj.capabilities.hasOwnProperty('capability1') && obj.capabilities.capability1 === null) {
        $('#opened_spl').attr('data-mod', "2D");
    } else if (Object.keys(obj.capabilities).length === 0) {

        $('#opened_spl').attr('data-mod', "2D");
    } else {
        for (const key in obj.capabilities) {
            if (obj.capabilities.hasOwnProperty(key)) {
                const capability = obj.capabilities[key];

                if (capability[0] === "HFR_CONTENT") {
                    $('#opened_spl').attr('data-hfr', 1);
                }
                if (capability[0] === "4K_CONTENT") {

                    $('#opened_spl').attr('data-mod', "4k");
                }
                if (capability[0] === "STEREOSCOPIC_CONTENT") {
                    $('#opened_spl').attr('data-mod', "3D");
                    $("#spl_properties_display_mode").val("3D");
                }
            }
        }
    }
}

function deleteSplSelected(spl_uuid){

    $.ajax({
        url : "{{  url('') }}"+   "/delete_nocspl",
        type: 'get',
        cache: false,

        data: {
            spl_uuid: spl_uuid,
            action_control: "delete_spl_selected",
            "_token": "{{ csrf_token() }}",
        },
        success: function (response) {
            try {
                console.log(response);
                var obj = JSON.parse(response);
                if (obj['status'] === "Failed") {
                    sweetAlert("Oops...", "Something went wrong!", "error");

                }
                if (obj['status'] === "success") {
                    $('#'+spl_uuid).remove();
                    swal("Done!", "Playlist deleted successfully!", "success");
                    $('#order-listing').DataTable().ajax.reload();

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
}


$(document).on('click', '.open_spl', function () {
    var action_control = "open_spl";

    $('#opened_spl').attr('data-opened_spl_status', 1);
    var id_spl = $(this).data("uuid");
    var title = $(this).data("title");
    openSpl(id_spl);
    $('#opened_spl').html(title);


    $('#opened_spl').attr('data-opened_spl_status', 1);
});


function openSpl(id_spl) {
    $.ajax({
        url : "{{  url('') }}"+   "/open_nocspl",
        type: 'get',
        data: {
            action_control: "open_spl",
            id_spl: id_spl ,
            "_token": "{{ csrf_token() }}",
        },
        success: function (response) {
            var response = JSON.parse(response);
            var obj = response.spl_file;
            var capabilities = response.capabilities;
            let box = "";

            try {


                $('#opened_spl').attr('data-uuid', obj.Id);


                setSplOpenedData(capabilities);


                if (obj.hasOwnProperty('EventList') && !obj.hasOwnProperty('PackList')) {
                    var pack = [obj.EventList];
                    var obj = {
                        "EventList": obj.EventList
                    };
                    var packList = [obj];

                } else {
                    var packList = obj.PackList;

                    if (Array.isArray(packList.Pack)) {
                        packList = obj.PackList.Pack;

                    } else if (typeof packList.Pack === 'object') {

                        var packList = [packList.Pack];

                    }
                }

                for (var packId in packList) {
                    var pack = packList[packId];

                    if (Object.keys(pack.EventList).length === 0) {
                        box +=
                            '<div class="card rounded border mb-2  segment-style"' +
                            '    data-uuid="' + pack.Id + '"' +
                            '    data-title="' + pack.PackName + '" ' +
                            '    data-type="segment" data-type_component="segment"' +
                            '    data-action="add"> ' +
                            '    <div class="card-body"  > ' +
                            '      <div class="media-body">' +
                            '            <p class="mb-0 text-muted float-left">  ' +
                            '                <i class="btn btn-inverse-warning  mdi mdi-package-variant-closed"></i> ' +
                            pack.PackName +
                            '            </p>' +
                            '            <p class="mb-0 text-muted float-right">\n' +
                            '                 <span class=" ">\n' +
                            '                    <i class="btn btn-primary  mdi mdi-magnify custom-search  segment-details" data-uuid="' + pack.Id + '"></i>\n' +
                            '                    <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>\n' +
                            '                 </span>   ' +
                            '            </p>' +
                            '      </div>' +
                            '    </div>' +
                            '</div>';
                    } else {

                        var events = pack.EventList.Event;
                        // if (Array.isArray(pack.EventList.Event)) {
                        //     var events = pack.EventList.Event;
                        //
                        // }
                        //
                        // if (typeof pack.EventList.Event === 'object'){
                        //     var  events =[  pack.EventList.Event]  ;
                        //
                        // }
                        // if (typeof events === 'object'){
                        //       events =[events]  ;
                        //
                        // }else{
                        //      events = pack.EventList.Event;
                        // }
                        console.log(events);
                        for (var i = 0; i < events.length; i++) {

                            console.log(events[i]);
                            var macro_box = '';
                            var marker_box = '';
                            var event = events[i];

                            // Access event properties
                            var eventId = event.Id;
                            var ElementList = event.ElementList;
                            var mainElement = event.ElementList.MainElement;
                            var list_macro_style = " hide_div ";
                            var list_marker_style = " hide_div "
                            // check macro
                            if (ElementList.hasOwnProperty('AutomationCue')) {
                                if (Array.isArray(ElementList.AutomationCue)) {
                                    var macro_list = ElementList.AutomationCue;
                                } else {
                                    var macro_list = [ElementList.AutomationCue];
                                }

                                if (macro_list.length > 0) {
                                    for (let i = 0; i < macro_list.length; i++) {
                                        var macro_time=convertSecondsToHMS(macro_list[i].Offset * 1 / 24);
                                        var components_time=  extractTimeComponents(macro_time);
                                        macro_box +=
                                            '   <div class="media-body macro-box col-md-8" data-title="' + macro_list[i].Action + '" ' +
                                            '        data-offset="' + macro_list[i].Kind + '"' +
                                            '        data-time="' + convertSecondsToHMS(macro_list[i].Offset * 1 / 24) + '"' +
                                            '        data-time_seconds="'+macro_list[i].Offset * 1 / 24 +'"' +
                                            '        data-hours="'+components_time.hours+'"' +
                                            '        data-minutes="'+components_time.minutes+'"' +
                                            '        data-seconds="'+components_time.seconds+'"' +
                                            '        data-uuid="' + macro_list[i].Id + '"' +
                                            '        data-idmacro="">' + macro_list[i].Action +
                                            '      <p class="mb-0 text-muted float-left">' + convertSecondsToHMS(macro_list[i].Offset * 1 / 24) + '</p> ' +
                                            '      <span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span>' +
                                            '      <p class="mb-0 text-muted float-right">\n' +
                                            '        <span class=" ">\n' +
                                            '            <i class="btn btn-primary  mdi mdi-magnify custom-search  macro-details" style="font-size: 18px; "></i>\n' +
                                            '            <i class="btn btn-danger mdi mdi-delete-forever remove-macro custom-search" style="font-size: 18px;"></i>    ' +
                                            '         </span>   ' +
                                            '       </p>' +
                                            '    </div>';
                                    }
                                    list_macro_style = " "
                                } else {

                                }
                            }
                            // check markers
                            if (ElementList.hasOwnProperty('Marker')) {
                                if (Array.isArray(ElementList.Marker)) {
                                    var Marker_list = ElementList.Marker;
                                } else {
                                    var Marker_list = [ElementList.Marker];
                                }

                                if (Marker_list.length > 0) {
                                    for (let i = 0; i < Marker_list.length; i++) {
                                        var t=convertSecondsToHMS(Marker_list[i].Offset * 1 / 24);
                                        var components_time=  extractTimeComponents(t);
                                        marker_box +=
                                            '<div class="media-body marker-box col-md-8"' +
                                            '      data-title="' + Marker_list[i].Label + '" data-offset="' + Marker_list[i].Kind + '"' +
                                            '      data-time="00:01:00" ' +
                                            '      data-uuid="' + Marker_list[i].Id + '" ' +
                                            '      data-hours="'+components_time.hours+'" ' +
                                            '      data-minutes="'+components_time.minutes+'" ' +
                                            '      data-seconds="'+components_time.seconds+'"> '   + Marker_list[i].Label +
                                            '    <p class="mb-0 text-muted float-left"> ' + convertSecondsToHMS(Marker_list[i].Offset * 1 / 24) + '</p> ' +
                                            '    <span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span> ' +
                                            '    <p class="mb-0 text-muted float-right">\n' +
                                            '        <span class=" ">\n' +
                                            '            <i class="btn btn-primary  mdi mdi-magnify custom-search  marker-details" ' +
                                            '               data-uuid="' + Marker_list[i].Id + '" style="font-size: 18px; "></i>\n' +
                                            '            <i class="btn btn-danger mdi mdi-delete-forever remove-marker custom-search" style="font-size: 18px;"></i>    ' +
                                            '         </span>  ' +
                                            '  </p>\n' +
                                            '</div>' ;
                                            //
                                            // '<div class="col-md-12 marker_item marker_style" style="margin-left: 0px!important;"' +
                                            // ' data-title="' + Marker_list[i].Label + '"' +
                                            // ' data-offset="' + Marker_list[i].Kind + '" ' +
                                            // ' data-time="' + convertSecondsToHMS(Marker_list[i].Offset * 1 / 24) + '"' +
                                            // ' data-uuid="16b06cf1-2e7b-40ef-9807-d22485bb7c36"> ' +
                                            // '   <div class="col-md-2" style="padding-left:12px;">|------</div> ' +
                                            // '   <div class="col-md-2" id="marker_time">' + convertSecondsToHMS(Marker_list[i].Offset * 1 / 24) + '</div>' +
                                            // '   <div class="col-md-6" id="macrker_title">' + Marker_list[i].Label + '</div>  ' +
                                            // '   <i class="fa fa-search col-sd-1 search-marker_item"></i>' +
                                            // '   <i class="fa fa-close col-sd-1  delete-marker_item"></i>' +
                                            // '</div>';
                                    }
                                    list_marker_style = " "
                                } else {

                                }
                                console.log(marker_box);
                            }
                            if (mainElement.hasOwnProperty('Composition')) {

                                var Composition = mainElement.Composition;

                                var IntrinsicDuration = Composition.IntrinsicDuration;
                                var EditRate = extractEditRateValues(Composition.EditRate);
                                var editRate_numerator = EditRate[0];
                                var editRate_denominator = EditRate[1];
                                var duration_seconds = Composition.IntrinsicDuration * editRate_denominator / editRate_numerator;
                                var hms_time = convertSecondsToHMS(duration_seconds);
                                console.log("composition");
                                box +=
                                    '<div class="card rounded border mb-2 left-side-item"' +
                                    '      data-type="Composition"' +
                                    '      data-id="' + eventId + '"' +
                                    '      data-uuid="' + Composition.CompositionPlaylistId + '" ' +
                                    '      data-source="undefined"' +
                                    '      data-title="' + Composition.AnnotationText + '"' +
                                    '      data-editrate_denominator="' + editRate_denominator + '" ' +
                                    '      data-editrate_numerator="' + editRate_numerator + '"' +
                                    '      data-id_server="undefined"' +
                                    '      data-version="new_item" data-time_seconds="' + duration_seconds + '"' +
                                    '      data-time="' + hms_time + '" data-starttime="00:00:00" ' +
                                    '      draggable="false" style=""> ' +
                                    '    <div class="card-body  ">\n' +
                                    '       <div class="media-body  ">\n' +
                                    '            <h6 class="mb-1" style="font-size: 17px;color:#52d4f7">' + Composition.AnnotationText + ' </h6>\n' +
                                    '       </div>\n' +
                                    '      <div class="media-body">\n' +
                                    '            <p class="mb-0 text-muted float-left">00:00:00</p>\n' +
                                    '            <p class="mb-0 text-muted float-right">\n' +
                                    '              <span class=" ">\n' +
                                    '                <i class="btn btn-primary  mdi mdi-magnify custom-search  cpl-details" data-uuid="' + Composition.CompositionPlaylistId + '"  ></i>\n' +
                                    '                <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>\n' +
                                    '              </span>' +
                                    '             </p>\n' +
                                    '       </div>' +
                                    '    </div>' +
                                    '    <div class="card-body macro-list ' + list_macro_style + '">' + macro_box + '</div> ' +
                                    '    <div class="card-body marker-list  ' + list_marker_style + '">' + marker_box + '</div> ' +
                                    '    <div class="col-md-10 intermission_list"></div>' +
                                    '</div>';
                            } else if (mainElement.hasOwnProperty('Pattern')) {
                                var Pattern = mainElement.Pattern;
                                var IntrinsicDuration = Pattern.Duration;
                                var EditRate = extractEditRateValues(Pattern.EditRate);
                                var editRate_numerator = EditRate[0];
                                var editRate_denominator = EditRate[1];
                                var duration_seconds = Pattern.Duration * editRate_denominator / editRate_numerator;
                                var hms_time = convertSecondsToHMS(duration_seconds);

                                box +=
                                    '<div class="macro_list_sortable list-group-item div_list row cpl_component_to_select cpl_component component"' +
                                    '      data-type="pattern" ' +
                                    '      data-id="' + eventId + '"' +
                                    '      data-uuid="' + Pattern.Id + '" ' +
                                    '      data-source="undefined"' +
                                    '      data-title="' + Pattern.AnnotationText + '"' +
                                    '      data-editrate_denominator="' + editRate_denominator + '" ' +
                                    '      data-editrate_numerator="' + editRate_numerator + '" data-id_server="undefined"' +
                                    '      data-version="new_item" data-time_seconds="' + duration_seconds + '"' +
                                    '      data-time="' + hms_time + '" data-starttime="00:00:00" ' +
                                    '      draggable="false" style=""> ' +
                                    '   <div class="title-content col-md-7 left_panel_title">' +

                                    (Pattern.AnnotationText == "Black 3D" || Pattern.AnnotationText == "Black 3D 48" ? '<span class="icon_pattern">3D</span> '
                                        : "") +
                                    Pattern.AnnotationText +
                                    '   </div>  ' +
                                    '   <div class="details-content col-md-3" style="">      ' +
                                    '      <div class=" ">          ' +
                                    '          <i class="fa fa-clock-o" aria-hidden="true"></i>         ' +
                                    '         <span class="start_time">00:00:00</span>       ' +
                                    '      </div> ' +
                                    '  </div>\n' +
                                    '  <i class="fa fa-search col-sd-1 search-spl_item"></i>  ' +
                                    '  <i class="fa fa-close col-sd-1  delete-spl_item"></i>  ' +
                                    '    <div class="col-md-12 macro_list" style="padding :0px"> ' +
                                    macro_box +
                                    '    </div>   ' +
                                    '    <div class="col-md-10 marker_list">' +
                                    marker_box +
                                    '    </div>   ' +
                                    '    <div class="col-md-10 intermission_list"></div>' +
                                    '</div>';
                                console.log(marker_box);
                            }
                            macro_box = "";
                            marker_box = "";
                        }
                    }

                }

                $('#dragula-right').html(box);
                var items = $('#dragula-right').find('.left-side-item');

                var startTime = 0;
                for (var i = 0; i < items.length; i++) {
                    console.log(items[i]);
                    var duration = parseInt(items[i].getAttribute('data-time_seconds'));

                    items[i].setAttribute('data-starttime', formatTime(startTime));
                    var composition_start_time = items[i].getAttribute('data-starttime');
                    items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
                    // $(items[i]).find('div:nth-child(2) span').html(formatTime(startTime));
                    startTime += duration;
                    var composition_end_time = startTime;
                    // Process the macro_list within the current item if it exists
                    var macroItems = items[i].querySelectorAll('.macro_item');
                    if (macroItems.length > 0) {
                        for (var j = 0; j < macroItems.length; j++) {
                            var macroTime = macroItems[j].getAttribute('data-time');
                            var macroKind = macroItems[j].getAttribute('data-offset');

                            // Calculate the macro start time based on Kind
                            var macroStartTime;
                            if (macroKind === "Start") {
                                // console.log(composition_start_time);
                                // console.log(macroTime);
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                            } else if (macroKind === "End") {
                                // console.log(composition_end_time);
                                // console.log(macroTime);
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }

                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                        }
                    }


                    var markerItems = items[i].querySelectorAll('.marker_item');

                    if (markerItems.length > 0) {
                        for (var j = 0; j < markerItems.length; j++) {
                            var markerTime = markerItems[j].getAttribute('data-time');
                            var markerKind = markerItems[j].getAttribute('data-offset');

                            // Calculate the macro start time based on Kind
                            var markerStartTime;
                            if (markerKind === "Start") {

                                markerStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(markerTime);

                            } else if (markerKind === "End") {
                                console.log(composition_end_time);
                                console.log(markerTime);
                                markerStartTime = composition_end_time - convertHMSToSeconds(markerTime);
                            } else {
                                // Handle other cases if needed
                                markerTime = 0;
                                d
                            }

                            // Update the macro_time div with the calculated start time
                            markerItems[j].querySelector('#marker_time').innerText = convertSecondsToHMS(markerStartTime);
                        }
                    }
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
    })
}

    $(document).on('click', '.infos_modal', function () {
        $(".infos_modal").modal('show');

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
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.cpl.contentTitleText + ' </p>'
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
                                            +'<p class="mb-0 text-muted"> '+ response.cpl.uuid + ' </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                            +'<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  d-flex justify-content-start mr-5">'
                                        +'<div class="media-body d-flex align-items-center">'
                                            +'<i class="mdi mdi-timer icon-sm align-self-center me-3"></i>'
                                            +'<h6 class="mb-1">Kind : </h6>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted m-1">   </p>'
                                        +'</div>'
                                        +'<div class="media-body">'
                                            +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'

                            +'<div class="card rounded border mb-2">'
                                +'<div class="card-body p-3">'
                                    +'<div class="media  d-flex justify-content-start mr-5 row">'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Duration   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.durationEdits + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Edit Rate   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.EditRate + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-4 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Disk size   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.totalSize + '   </p>'
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
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture width  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture Encoding Algorithm   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Picture Encryption Algorithm  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
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
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.soundChannelCount + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Sound Encoding Algorithm </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1">Sound Encryption   </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
                                            +'</div>'
                                        +'</div>'

                                        +'<div class="col-md-3 text-center" >'
                                            +'<div class="media-body ">'
                                                +'<h6 class="mb-1"> Algorithm  </h6>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted m-1">   </p>'
                                            +'</div>'
                                            +'<div class="media-body">'
                                                +'<p class="mb-0 text-muted"> '+ response.cpl.contentKind + '   </p>'
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
                                       +'<th>CPL Name</th>'

                                   +'</tr>'
                               +'</thead>'
                               +'<tbody>'

                   $.each(response.spls, function( index, value ) {

                   result = result
                                   +'<tr>'
                                       +'<th>'+value.uuid+'</th>'
                                       +'<th>'+value.name+'</th>'

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

        $('#location').change(function(){

            var box = "";
            var box_kind = "";
            var detail = "";

            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#dragula-left').html(loader_content)


            var  location =  $('#location').val();

            var url = "{{  url('') }}"+ '/get_cpl_with_filter_for_noc/?location=' + location+'&lms=true&playlist_builder=true' ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {
                    $.each(response.cpls, function( index, value ) {

                        if (value.contentKind.localeCompare(box_kind) == 0) {
                                box_kind = value.contentKind;
                            } else {
                                box_kind = value.contentKind;
                                box += '<div class=" filtered  div_list title-kind  "   ' +
                                    '        data-type="' + value.contentKind + '">' + value.contentKind + '  </div>';
                            }
                            if (value.contentKind.match(/^(SPL|Automation|Trigger|Cues|Pattern)$/)) {

                            }
                            box +=
                                '   <div class="card rounded border mb-2 left-side-item"' +
                                '       data-side="left"   ' +
                                '       data-auditorium="' + value.id_auditorium + '" ' +
                                '       data-uuid="' + value.uuid + '"' +
                                '       data-title="' + value.contentTitleText + '"' +
                                '       data-time="' + value.Duration + '"  ' +
                                '       data-time_seconds="' + value.duration_seconds + '"  ' +
                                '       data-time_Duration_frames="' + value.durationEdits + '"  ' +
                                '       data-type_component="cpl"' +
                                '       data-id="' + value.id_dcp + '"' +
                                '       data-version="left_tab"' +
                                '       data-type="' + value.contentKind + '"' +
                                '       data-editRate_denominator="' + value.editRate_denominator + '"' +
                                '       data-editRate_numerator="' + value.editRate_numerator + '"' +
                                '       data-id_server="' + value.id_server + '"' +
                                '       data-source="' + value.source + '"' +
                                '       data-need_kdm="' + ((value.pictureEncryptionAlgorithm == "None" || value.pictureEncryptionAlgorithm == 0) ? 0 : 1) + '"' +
                                '> ' +
                                '       <div class="card-body  "  >\n' +

                                '                 <div class="media-body  ">\n' +
                                '                      <h6 class="mb-1"  style="font-size: 17px;color:' +
                                (value.type === "Flat" ? "#52d4f7" :
                                    (value.type === "Scope" ? "#00d25b" : "white"))
                                + '">' + value.contentTitleText +
                                ((value.pictureEncryptionAlgorithm == "None" || value.pictureEncryptionAlgorithm == 0) ? " " : "<i class=\"mdi mdi-lock-outline  cpl_need_kdm\" aria-hidden=\"true\"></i>") +
                                '</h6>\n' +
                                '                  </div>\n' +
                                '                  <div class="media-body">\n' +
                                '                       <p class="mb-0 text-muted float-left">' + formatDurationToHMS(value.duration_seconds) + ' <span class="detail-cpl">  Subtitle, VI, HI, DBox </span>   </p>\n' +
                                '                       <p class="mb-0 text-muted float-right">\n' +
                                '                          <span class="icon-prop-cpl">' +
                                (value.is_3D == 1 ? '3D' : '2D') +
                                '                          </span>\n' +
                                '                          <span class="flat">  ' +
                                (value.ScreenAspectRatio == "unknown" ? value.type
                                    : value.ScreenAspectRatio + ' ' + value.cinema_DCP) +
                                '                           </span>\n' +
                                '                          <span class="flat">' + value.soundChannelCount + ' </span>\n' +
                                '                          <span class="flat"> ST  </span>\n' +
                                '                          <span data-bs-toggle="modal" data-bs-target="#infos_modal" class=" infos_modal" href="#" ' +
                                '                                data-uuid="' + value.uuid + '"' +
                                '                                 id="' + value.id + '"' +
                                '                                data-need_kdm="' + ((value.pictureEncryptionAlgorithm == "None" || value.pictureEncryptionAlgorithm == 0) ? 0 : 1) + '"' +
                                '                            > <i class="btn btn-primary  custom-search mdi mdi-magnify"> </i></span>\n' +
                                '                       </p>\n' +
                                '                    </div> ' +
                                '              </div>\n' +
                                '              <div class="card-body macro-list hide_div"></div> ' +
                                '              <div class="card-body marker-list hide_div"></div>' +

                                '   </div>';
                    });
                    // append pattern
                    box += '<div class=" filtered  div_list   title-kind  " data-type="Pattern"> Pattern   </div>';
                    box += '' +
                        '<div class="list-group-item div_list card rounded border mb-2 left-side-item" ' +
                        '         data-side="left" ' +
                        '         data-type="Pattern" ' +
                        '         data-version="left_tab"' +
                        '         data-title="Black"  >' +
                        '        <span></span>' +
                        '        <div class="title-content"> ' +
                        '          Black <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i>' +
                        '        </div>' +
                        '        <div class="card-body macro-list hide_div"></div> ' +
                        '</div>';
                    box +=
                        '<div class="list-group-item div_list card rounded border mb-2 left-side-item " ' +
                        '         data-side="left" ' +
                        '         data-type="Pattern" ' +
                        '         data-version="left_tab"' +
                        '         data-title="Black 3D">' +
                        '      <div class="title-content"> ' +
                        '            <span class="icon_pattern">3D</span>' +
                        '            Black 3D <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i>' +
                        '      </div>' +
                        '      <div class="card-body macro-list hide_div"></div>' +
                        '</div>';
                    box +=
                        '<div class="list-group-item div_list card rounded border mb-2 left-side-item" ' +
                        '         data-side="left" ' +
                        '         data-type="Pattern" ' +
                        '         data-version="left_tab"' +
                        '         data-title="Black 3D 48"  >' +
                        '   <div class="title-content"> ' +
                        '       <span class="icon_pattern">3D</span>' +
                        '       Black 3D 48 <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"  ></i>' +
                        '   </div>' +
                        '   <div class="card-body macro-list hide_div"></div>' +
                        '</div>';
                    // append macros
                    box += '<div class=" filtered  div_list title_kind title-kind" data-type="Macros"> Macros  </div>';
                        $.each(response.macros, function( index, value ) {
                            box +=
                            '<div  style="padding:5px" class="macro_item   div_list card rounded border mb-2 left-side-item" ' +
                            '       data-command="' +value.command + '" data-title="' +value.title + '" data-id="' +value.idmacro_config + '" data-type="Macros">' +
                            '       <div class="card-body p-3">\n' +
                            '                 <div class="media-body float-left">\n' +
                            '                    <div class="title-content col-md-12"> <i class="btn btn-inverse-primary  mdi mdi-server-network"></i> ' +value.title + ' </div>' +
                            '                       <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"></i>' +
                            '                 </div>' +
                            '        </div>' +
                            '</div>';
                        });

                    $('#dragula-left').html(box);
                },
                error: function(response) {

                }
            })
        });
        function formatDurationToHMS(duration){
            //  console.log(new Date(duration  * 1000).toISOString().slice(11, 19));
            return   new Date(duration  * 1000).toISOString().slice(11, 19);

        }

        // filter files by kind
        $(document).on('change', '#filter_type', function (event) {
            var criteria = $(this).val();

            if (criteria == 'all') {
                $('.left-side-item').show();
                $('.title-kind').show();
                return;
            }
            $('#dragula-left .left-side-item').each(function (i, option) {
                if ($(this).data("type") == criteria) {

                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#dragula-left .title-kind').each(function (i, option) {
                if ($(this).data("type") == criteria) {

                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        // search  content left side
        var search_content = document.getElementById('search-dragula-left');

        search_content.onkeyup = function () {
            var searchTerms = $(this).val();
            $('#dragula-left .left-side-item ').each(function () {

                var hasMatch = searchTerms.length == 0 ||
                    $(this).text().toLowerCase().indexOf(searchTerms.toLowerCase()) > 0;
                $(this).toggle(hasMatch);

            });
        }

        $(document).on('dblclick', '#dragula-left .left-side-item', function (e) {
            var clonedElement = $(this).clone();

            if (clonedElement.data('type') === "Macros") {


                var selected_item = $('#dragula-right .left-side-item.selected-item');
                if (selected_item.length === 0) {
                    $("#no-cpl-selected").modal('show');
                } else {
                    $("#macro_title").html(clonedElement.data('title'));
                    $("#macro_command").val(clonedElement.data('command'));
                    $("#macro_title_val").val(clonedElement.data('title'));

                    $("#macro-modal").modal('show');
                }

                // if (check == 1) {
                //     $(this).data('type');
                //     $('#titl_macro').html($(this).parent().data('title'));
                //     $('#id_macro_item').html($(this).parent().data('id'));
                //     $('#id_macro_item').attr('data-id', $(this).parent().data('id'));
                //     resetMacroTimeInputs();
                //     $("#macro_modal").modal('show');
                // }
                }
            else if(clonedElement.data('type') === "Pattern"){
                console.log($(this).parent().parent().data('title'));
                $('#pattern_title').val($(this).parent().parent().data('title'));
                $("#pattern_modal").modal('show');
            }

            else if(clonedElement.data('type') === "SPL"){

            }
            else{

                console.log(clonedElement.get(0))
                modifyContentBeforeDrop(clonedElement.get(0));
                $('#dragula-right').append(clonedElement);

                // re-order items
                var items =  $('#dragula-right').find('.left-side-item');
                var startTime = 0;

                for (var i = 0; i < items.length; i++) {
                    var duration = parseInt(items[i].getAttribute('data-time_seconds'));
                    items[i].setAttribute('data-starttime',   formatTime(startTime));
                    var composition_start_time=   items[i].getAttribute('data-starttime');
                    items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
                    startTime += duration;
                    var composition_end_time=   startTime;
                    // Process the macro_list within the current item if it exists
                    var macroItems = items[i].querySelectorAll('.macro_item');
                    if (macroItems.length > 0) {
                        for (var j = 0; j < macroItems.length; j++) {
                            var macroTime = macroItems[j].getAttribute('data-time');
                            var macroKind = macroItems[j].getAttribute('data-offset');
                            // Calculate the macro start time based on Kind
                            var macroStartTime;
                            if (macroKind === "Start") {
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                            } else if (macroKind === "End") {
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }
                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                        }
                    }
                }
            }

        });
        $(document).on('click', '#edit_spl_properties', function () {

            var opened_spl_status = $('#opened_spl').data("opened_spl_status");
            if (opened_spl_status == 1) {
                var id_spl = $('#opened_spl').data("uuid");


                var title = $('#opened_spl').text();

                var mod = $('#opened_spl').data("mod");

                var hfr = $('#opened_spl').data("hfr");
                $('#uuid_spl_edit').val(id_spl);
                $('#edit_spl_title').val(title);
                $('#edit_display_mode').val(mod);
                $("#edit-spl-properties-modal").modal('show');
            } else {
                $("#no-spl-selected").modal('show');

            }

        });

    </script>


    <script>

        let content_height = document.querySelector('.content-wrapper').offsetHeight;
        let navbar_height = document.querySelector('.navbar').offsetHeight;
        let footer_height = document.querySelector('.footer').offsetHeight;
        let page_header_height = document.querySelector('.page-header ').offsetHeight;
        let content_max_height =  content_height - navbar_height - footer_height - page_header_height - 450;

        $(".multiplex").height(content_max_height);


            $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })


        $(".preview-item").click(function(){

        $(this).toggleClass("selected");
        });
    </script>



<script>


    $(document).on('click', '#reset_spl_builder', function () {
        //$('#actual_spl_title').text("No SPL Selected , Create New One");
        //  $('#id_spl_opened').text(0);
        $('#opened_spl').attr('data-opened_spl_status', 0);
        $("#dragula-right").empty();
        $('#opened_spl').html('No Playlist Selected');
        // $('#id_spl_opened').attr('data-hfr', 0 );
        // $('#id_spl_opened').attr('data-mod', "" );
        // $('#id_spl_opened').attr('data-spl_uuid', 0 );
        // prepareSortablReorder();
    });
    $(document).on('click', '#display_spl_properties', function () {
        $("#spl-properties-modal").modal('show');
    });


    $(document).on('click', '#save_new_spl', function () {
        let array_spl = [];
        let items_spl = [];
        let items_macro = [];
        let items_marker = [];
        let items_intermission = [];
        var title_spl = $('#spl_title').val();

        if (title_spl == "") {
            $("#spl-properties-modal").modal({"backdrop": "static"});
        } else {
            var display_mode = $('#display_mode').val();

            var hfr = 0;
            if ($('#spl_properties_hfr').is(":checked")) {
                hfr = 1;
            }
            $('#dragula-right > .left-side-item').map(function () {
                items_macro = [];
                items_marker = [];
                items_intermission = [];
                var edit_rate_denominator = $(this).data('editrate_denominator');
                var edit_rate_numerator = $(this).data('editrate_numerator');
                var marco_divs = $(this).find('.macro-box');
                var marker_divs = $(this).find('.marker-box');

                let intermission_divs = $(this).children('.intermission_list').children('.intermission_style');
                marco_divs.map(function () {
                    console.log($(this).data('time'));
                    console.log($(this));
                    items_macro.push({
                        'id': $(this).data('uuid'),
                        'uuid': $(this).data('uuid'),
                        'title': $(this).data('title'),
                        'offset': $(this).data('offset'),
                        'time': $(this).data('time'),
                        'time_frames': convertStringToSeconds($(this).data('time')) * edit_rate_numerator / edit_rate_denominator
                    });
                });
                if (items_macro.length == 0) {
                    items_macro = null;
                }
                marker_divs.map(function () {
                    items_marker.push({
                        'uuid': $(this).data('uuid'),
                        'title': $(this).data('title'),
                        'offset': $(this).data('offset'),
                        'time': $(this).data('time'),
                        'time_frames': convertStringToSeconds($(this).data('time')) * edit_rate_numerator / edit_rate_denominator

                    });
                });
                if (items_marker.length == 0) {
                    items_marker = null;
                }
                intermission_divs.map(function () {
                    items_intermission.push({
                        'uuid': $(this).data('uuid'),
                        'title': $(this).data('title'),
                        'offset': $(this).data('offset'),
                        'time': $(this).data('time'),
                        'time_frames': convertStringToSeconds($(this).data('time')) * edit_rate_numerator / edit_rate_denominator
                    });
                });
                if (items_intermission.length == 0) {
                    items_intermission = null;
                }
                array_spl.push($(this).data('uuid'));
                items_spl.push({
                    'kind': $(this).data('type'),
                    'id': $(this).data('id'),
                    'uuid': $(this).data('uuid'),
                    'source': $(this).data('source'),
                    'title': $(this).data('title'),
                    'IntrinsicDuration': $(this).data('time'),
                    'start_time': $(this).data('starttime'),
                    'time_seconds': $(this).data('time_seconds'),
                    'editrate_denominator': $(this).data('editrate_denominator'),
                    'editrate_numerator': $(this).data('editrate_numerator'),
                    'id_server': $(this).data('id_server'),
                    'macro_list': items_macro,
                    'marker_list': items_marker,
                    'items_intermission': items_intermission
                });
            });
            var array_length = 0;
            array_length = array_spl.length;


            if (array_length > 0) {
                var action_control = "save_new_spl";
                var spl_title = $('#spl_title').val();
                var file_name = $('#file_name').val();
                var display_mode = $('#display_mode').val();
                $('#id_spl_opened').attr('data-mod', display_mode);
                var hfr = 0;
                if ($('#insert_spl_properties_hfr').is(":checked")) {
                    hfr = 1;
                    $('#id_spl_opened').attr('data-hfr', 1);
                } else {
                    $('#id_spl_opened').attr('data-hfr', 0);
                }
                $('#actual_spl_title').text(spl_title);


                $('#id_spl_opened').attr('data-title', spl_title);


                //console.log(items_spl);
                $.ajax({
                    url:"{{  url('') }}"+ "/createlocalspl",
                    type: 'post',
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        array_spl: array_spl,
                        title_spl: spl_title,
                        display_mode: display_mode,

                        hfr: hfr,
                        action_control: action_control,
                        items_spl: items_spl
                    },
                    success: function (response) {
                        try {
                            console.log(response);
                            var obj = JSON.parse(response);
                            $('#actual_spl_title').text(title_spl);
                            $('#id_spl_opened').text(obj['uuid']);
                            $('#id_spl_opened').attr('data-spl_uuid', obj['uuid']);
                            $(jQuery.parseJSON(response)).each(function () {
                                status = this.status;
                            });

                            if (status === "Failed") {
                                $("#success_message_update").css("background-color", "rgb(224 114 114)");
                                $('#success_message_update').fadeIn().html("Execution Failed");
                                setTimeout(function () {
                                    $('#success_message_update').fadeOut("slow");
                                }, 2000);
                            }
                            if (status === "saved" ) {
                                $('#container2 > .div_list').map(function () {
                                    if ($(this).data('version') === "new_item") {
                                        this.setAttribute('data-version', "old");
                                    }
                                });

                                array_spl = [];
                                array_length = 0;
                                window.array_length = 0;

                                $('#success_message_update').css({"background": "#CCF5CC"});
                                $('#success_message_update').fadeIn().html("SPL saved successfully");
                                setTimeout(function () {
                                    $('#success_message_update').fadeOut("slow");
                                }, 2000);
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
            }
            array_spl = [];
            window.array_length = 0;
            $("#save_spl_form").trigger('reset');


        }
    });
    // click open (display spls list
    $(document).on('click', '#open_spl_list', function ()
    {

        $("#spl-list").modal('show');
        var loader_content  =
           '<div class="jumping-dots-loader">'
               +'<span></span>'
               +'<span></span>'
               +'<span></span>'
               +'</div>'
       $('#nocspls_content').html(loader_content)

       var url = "{{  url('') }}"+   "/get_nocspl/";
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
                                        +'<th>Title</th>'
                                        +'<th>Creation Date</th>'
                                        +'<th>UUID </th>'
                                        +'<th>Actions</th>'
                                   +'</tr>'
                               +'</thead>'
                               +'<tbody>'

                   $.each(response.nocspls, function( index, value ) {

                   result = result
                                   +'<tr id="'+value.uuid+'">'
                                       +'<th>'+value.spl_title+'</th>'
                                       +'<th>'+value.created_at+'</th>'
                                       +'<th>'+value.uuid+'</th>'
                                       +'<th> '
                                        +'<i class="btn btn-primary mdi mdi-tooltip-edit open_spl" data-title="'+value.spl_title+'" data-uuid="'+value.uuid+'"></i> '
                                        +'<i class="btn btn-danger mdi   mdi-delete-forever delete_spl" data-title="'+value.spl_title+'" data-uuid="'+value.uuid+'"></i>'
                                       +'</th>'

                                   +'</tr>'
                   });
                   result = result
                               +'</tbody>'
                           +'</table>'
                       +'</div>'
                       console.log(result)
                   $('#nocspls_content').html(result)





               },
               error: function(response) {

               }
       })


    });





    // remove cpl right list
    $(document).on('click', '.remove-cpl', function () {

        $(this).parent().parent().parent().parent().parent().remove();
        // re-order items
        var items = $('#dragula-right').find('.left-side-item');
        var startTime = 0;

        for (var i = 0; i < items.length; i++) {
            var duration = parseInt(items[i].getAttribute('data-time_seconds'));
            items[i].setAttribute('data-starttime', formatTime(startTime));
            var composition_start_time = items[i].getAttribute('data-starttime');
            items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
            startTime += duration;
            var composition_end_time = startTime;
            // Process the macro_list within the current item if it exists
            var macroItems = items[i].querySelectorAll('.macro_item');
            if (macroItems.length > 0) {
                for (var j = 0; j < macroItems.length; j++) {
                    var macroTime = macroItems[j].getAttribute('data-time');
                    var macroKind = macroItems[j].getAttribute('data-offset');
                    // Calculate the macro start time based on Kind
                    var macroStartTime;
                    if (macroKind === "Start") {
                        macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                    } else if (macroKind === "End") {
                        macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                    } else {
                        // Handle other cases if needed
                        macroStartTime = 0;
                    }
                    // Update the macro_time div with the calculated start time
                    macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                }
            }
        }

        });

    //remove macro right list
    $(document).on('click', '.remove-macro', function () {

        $(this).parent().parent().parent().remove();
        // re-order items
        var items = $('#dragula-right').find('.left-side-item');
        var startTime = 0;

        for (var i = 0; i < items.length; i++) {
            var duration = parseInt(items[i].getAttribute('data-time_seconds'));
            items[i].setAttribute('data-starttime', formatTime(startTime));
            var composition_start_time = items[i].getAttribute('data-starttime');
            items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
            startTime += duration;
            var composition_end_time = startTime;
            // Process the macro_list within the current item if it exists
            var macroItems = items[i].querySelectorAll('.macro_item');
            if (macroItems.length > 0) {
                for (var j = 0; j < macroItems.length; j++) {
                    var macroTime = macroItems[j].getAttribute('data-time');
                    var macroKind = macroItems[j].getAttribute('data-offset');
                    // Calculate the macro start time based on Kind
                    var macroStartTime;
                    if (macroKind === "Start") {
                        macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                    } else if (macroKind === "End") {
                        macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                    } else {
                        // Handle other cases if needed
                        macroStartTime = 0;
                    }
                    // Update the macro_time div with the calculated start time
                    macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                }
            }
        }

        });

        $(document).on('click', '.remove-marker', function () {

            $(this).parent().parent().parent().remove();
            // re-order items
            var items = $('#dragula-right').find('.left-side-item');
            var startTime = 0;

            for (var i = 0; i < items.length; i++) {
                var duration = parseInt(items[i].getAttribute('data-time_seconds'));
                items[i].setAttribute('data-starttime', formatTime(startTime));
                var composition_start_time = items[i].getAttribute('data-starttime');
                items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
                startTime += duration;
                var composition_end_time = startTime;
                // Process the macro_list within the current item if it exists
                var macroItems = items[i].querySelectorAll('.macro_item');
                if (macroItems.length > 0) {
                    for (var j = 0; j < macroItems.length; j++) {
                        var macroTime = macroItems[j].getAttribute('data-time');
                        var macroKind = macroItems[j].getAttribute('data-offset');
                        // Calculate the macro start time based on Kind
                        var macroStartTime;
                        if (macroKind === "Start") {
                            macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                        } else if (macroKind === "End") {
                            macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                        } else {
                            // Handle other cases if needed
                            macroStartTime = 0;
                        }
                        // Update the macro_time div with the calculated start time
                        macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(macroStartTime);
                    }
                }
            }

            });
            $(document).on('click', '.marker-details', function () {
            let marker_uuid = $(this).data("uuid");

            let data_hours = this.closest('.marker-box').getAttribute("data-hours");
            let data_minutes = this.closest('.marker-box').getAttribute("data-minutes");
            let data_seconds = this.closest('.marker-box').getAttribute("data-seconds");
            let data_time = this.closest('.marker-box').getAttribute("data-time");
            let title = this.closest('.marker-box').getAttribute("data-title");
            let offset = this.closest('.marker-box').getAttribute("data-offset");

            // get uuid parent cpl/pattern
            var leftSideItem = $(this).closest('.left-side-item');
            var parent_uuid = leftSideItem.data('uuid');
            var parent_title = leftSideItem.data('title');
            $("#edit_title_selected_item").html(parent_title);
            $("#edit_marker_label").val(title);
            $("#parent_uuid").val(parent_uuid);
            $("#marker_uuid").val(marker_uuid);

            $("#edit_marker_time_hms").html(data_time);
            $("#edit_Hours_marker").val(parseInt(data_hours));
            $("#edit_Minutes_marker").val(parseInt(data_minutes));
            $("#edit_Seconds_marker").val(parseInt(data_seconds));
            $("#edit_Offset_marker").val(offset);
            $("#edit-marker-modal").modal('show');
            });
            $(document).on('click', '#confirm_edit_marker', function () {

            var marker_label = $('#edit_marker_label').val();
            var uuid = $('#marker_uuid').val();
            var parent_id = $('#parent_uuid').val();
            var Hours_marker = $('#edit_Hours_marker').val();
            var Minutes_marker = $('#edit_Minutes_marker').val();
            var Seconds_marker = $('#edit_Seconds_marker').val();
            var offset = $('input[name=edit_Offset_marker]:checked').val();
            var time_seconds = parseInt(Hours_marker) * 60 * 60 + parseInt(Minutes_marker) * 60 + parseInt(Seconds_marker);


            var parentItem = $('#dragula-right .left-side-item[data-uuid="' + parent_id + '"]');

            var markerBox = parentItem.find('.marker-list .marker-box[data-uuid="' + uuid + '"]');

            var marker_box = marker_label +
                '<p class="mb-0 text-muted float-left">' + convertSecondsToHMS(time_seconds) + ' </p>' +
                '<span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span> ' +
                ' <p class="mb-0 text-muted float-right">' +
                '  <span class=" ">' +
                '       <i class="btn btn-primary  mdi mdi-magnify custom-search  marker-details" data-uuid="' + uuid + '" style="font-size: 18px; "></i>' +
                '       <i class="btn btn-danger mdi mdi-delete-forever remove-marker custom-search" style="font-size: 18px;"></i>  ' +
                '  </span>' +
                ' </p> ';
            markerBox.html(marker_box);
            markerBox.attr('data-title', marker_label);
            markerBox.attr('data-time', convertSecondsToHMS(time_seconds));
            markerBox.attr('data-offset', offset);
            markerBox.attr('data-uuid', uuid);
            markerBox.attr('data-hours', Hours_marker);
            markerBox.attr('data-minutes', Minutes_marker);
            markerBox.attr('data-seconds', Seconds_marker);

            $("#edit-marker-modald").modal('hide');

            });
        // click marker icon
        $(document).on('click', '#show_marker_modal', function () {

            var selectedCard = $('#dragula-right .left-side-item.selected-item');

            // Check if selectedCard is not empty
            if (selectedCard.length > 0) {
                var dataTitleValue = selectedCard.data('title');
                $("#title_selected_item").html(dataTitleValue);
                // Get the last .media-body element inside the selected item
                // var marker_body = selectedCard.find('.marker-list');
                // marker_body.removeClass('hide_div');
                $("#marker-modal").modal('show');
            } else {
                $("#no-cpl-selected").modal('show');
            }

        });

        //confirm ad marker
        $(document).on('click', '#confirm_add_marker', function () {

            var marker_label = $('#marker_label').val();
            var uuid = $.trim('urn:uuid:' + uuidv4());
            var Hours_marker = $('#Hours_marker').val();
            var Minutes_marker = $('#Minutes_marker').val();
            var Seconds_marker = $('#Seconds_marker').val();
            var offset = $('input[name=Offset_marker]:checked').val();
            var time_marker = Hours_marker + ' : ' + Minutes_marker + ' : ' + Seconds_marker;
            var time_seconds = parseInt(Hours_marker) * 60 * 60 + parseInt(Minutes_marker) * 60 + parseInt(Seconds_marker);

            var marker_box = '' +
                '<div class="media-body marker-box col-md-8" data-title="' + $.trim(marker_label) + '"' +
                '     data-offset="' + offset + '" ' +
                '     data-time="' + convertSecondsToHMS(time_seconds) + '"' +
                '     data-uuid="' + uuid + '"' +
                '     data-hours="' + Hours_marker + '"' +
                '     data-minutes="' + Minutes_marker + '"' +
                '     data-seconds="' + Seconds_marker + '">' + marker_label +
                '  <p class="mb-0 text-muted float-left"> ' + convertSecondsToHMS(time_seconds) + ' </p> ' +
                '   <span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span>' +
                '  <p class="mb-0 text-muted float-right">\n' +
                '        <span class=" ">\n' +
                '            <i class="btn btn-primary  mdi mdi-magnify custom-search  marker-details" ' +
                '               data-uuid="' + uuid + '"' +
                '                style="font-size: 18px; "></i>\n' +
                '            <i class="btn btn-danger mdi mdi-delete-forever remove-marker custom-search" style="font-size: 18px;"></i>' +
                '        </span>' +
                '    </p>\n' +
                '</div>';
            var selectedCard = $('#dragula-right .left-side-item.selected-item');

            // Check if selectedCard is not empty
            if (selectedCard.length > 0) {
                // Get the last .media-body element inside the selected item
                var marker_body = selectedCard.find('.marker-list');
                marker_body.removeClass('hide_div');

                // Append the macro_box content after the last .media-body
                marker_body.append(marker_box);

            }


        });

        $(document).on('click', '#add_segment', function () {
            var uuid_segment = 'urn:uuid:' + uuidv4();
            var segment_box = '' +
                '<div class="card rounded border mb-2  segment-style" data-side="right" ' +
                '     data-uuid="' + uuid_segment + '" data-title="New Segment"  ' +
                '     data-type_component="segment"    data-type="segment"   >   ' +
                '     <div class="card-body  ">\n' +

                '         <div class="media-body">\n' +
                '              <p class="mb-0 text-muted float-left">' +
                '                    <i class="btn btn-inverse-warning  mdi mdi-package-variant-closed"></i>  New Segment ' +

                '              </p>\n' +
                '              <p class="mb-0 text-muted float-right">\n' +
                '                 <span class=" ">\n' +
                '                    <i class="btn btn-primary  mdi mdi-magnify custom-search  segment-details" data-uuid="' + uuid_segment + '"  ></i>\n' +
                '                    <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>\n' +
                '                 </span>' +
                '               </p>\n' +
                '           </div>            ' +
                '     </div>' +
                '</div>';
            $('#dragula-right').append(segment_box);
        });
        $(document).on('click', '.segment-details', function () {
            //let title = $(this).parent().parent().parent().parent().parent().data("title");
            let title = $(this).closest('.card[data-title]').data("title");
            let uuid = $(this).parent().parent().parent().parent().parent().data("uuid");

            $("#pack_name").val(title);
            $("#segment_uuid").val(uuid);

            $("#segment-modal").modal('show');
        });
        $(document).on('click', '#confirm_add_segment', function () {
            var title = $('#pack_name').val();
            var uuid = $('#segment_uuid').val();
            var type = "segment";
            var targetItem = $('#dragula-right .card[data-uuid="' + uuid + '"][data-type="' + type + '"]');
            if (targetItem.length > 0) {
                // Change the text inside mb-0 text-muted float-left

                targetItem.attr('data-title', title).promise().done(function () {
                    // Retrieve the updated data-title value
                    var updatedTitle = targetItem.attr('data-title');

                });
                targetItem.find('.mb-0.text-muted.float-left').html('<i class="btn btn-inverse-warning  mdi mdi-package-variant-closed"></i> ' + title);
            }

        });


    $('#dragula-right').on('click', '.left-side-item', function () {
        // Remove 'selected' class from all items
        $('.left-side-item').removeClass('selected-item');
        $('.mb-0.text-muted.float-left').removeClass("color-white");

        // Add 'selected' class to the clicked item
        $(this).toggleClass('selected-item');
        $(this).find('.mb-0.text-muted.float-left').addClass("color-white");

    });

    $(document).on('click', '#confirm_add_macro', function () {
        var macro_command = $('#macro_command').val();
        var macro_title = $('#macro_title_val').val();
        var Hours_macro = $('#Hours_macro').val();
        var Minutes_macro = $('#Minutes_macro').val();
        var Seconds_macro = $('#Seconds_macro').val();
        var offset = $('input[name=Offset_macro]:checked').val();
        var time_macro = Hours_macro + ' : ' + Minutes_macro + ' : ' + Seconds_macro;
        var time_seconds = parseInt(Hours_macro) * 60 * 60 + parseInt(Minutes_macro) * 60 + parseInt(Seconds_macro);
        var macro_box = '' +
            '<div class="media-body macro-box col-md-8" data-title="' + macro_title + '"' +
            '      data-offset="' + offset + '" ' +
            '      data-command="' + $.trim(macro_command) + '" ' +
            '      data-time="' + convertSecondsToHMS(time_seconds) + '"  data-time_seconds="' + time_seconds + '"' +
            '      data-Hours="' + Hours_macro + '" ' + 'data-Minutes="' + Minutes_macro + '" ' + 'data-Seconds="' + Seconds_macro + '" ' +
            '      data-Uuid="urn:uuid:' + uuidv4() + '">' +
            macro_title +
            '  <p class="mb-0 text-muted float-left"> ' + convertSecondsToHMS(time_seconds) + ' </p> ' +
            '   <span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span>' +
            '  <p class="mb-0 text-muted float-right">\n' +
            '        <span class=" ">\n' +
            '            <i class="btn btn-primary  mdi mdi-magnify custom-search  macro-details" ' +
            '                style="font-size: 18px; "></i>\n' +
            '            <i class="btn btn-danger mdi mdi-delete-forever remove-macro custom-search" style="font-size: 18px;"></i>' +
            '        </span>' +
            '    </p>\n' +
            '</div>';
        var selectedCard = $('#dragula-right .left-side-item.selected-item');

        // Check if selectedCard is not empty
        if (selectedCard.length > 0) {
            // Get the last .media-body element inside the selected item
            var macro_body = selectedCard.find('.macro-list');
            macro_body.removeClass('hide_div');

            // Append the macro_box content after the last .media-body
            macro_body.append(macro_box);
        }
        // reporder list items afetr append macro
        var items = $('#dragula-right').find('.left-side-item');
        var startTime = 0;
        for (var i = 0; i < items.length; i++) {

            var duration = parseInt(items[i].getAttribute('data-time_seconds'));
            items[i].setAttribute('data-starttime',   formatTime(startTime));
            var composition_start_time=   items[i].getAttribute('data-starttime');
            startTime += duration;
            var composition_end_time=   startTime;
            // Process the macro_list within the current item if it exists
            var macroItems = items[i].querySelectorAll('.macro-box ');

            if (macroItems.length > 0)
            {
                for (var j = 0; j < macroItems.length; j++) {
                    var macroTime = macroItems[j].getAttribute('data-time');
                    var macroKind = macroItems[j].getAttribute('data-offset');
                    // Calculate the macro start time based on Kind
                    var macroStartTime;
                    if (macroKind === "Start") {
                        console.log(composition_start_time);
                        console.log(macroTime);
                        macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(macroTime);
                    } else if (macroKind === "End") {
                        console.log(composition_end_time);
                        console.log(macroTime);
                        macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                    } else {
                        // Handle other cases if needed
                        macroStartTime = 0;
                    }

                    // Update the macro_time div with the calculated start time
                    macroItems[j].querySelector('.mb-0.text-muted.float-left').innerText = convertSecondsToHMS(macroStartTime);
                }
            }

            var macroList = items[i].querySelector('.card-body.macro-list');
            reorderMacroList(macroList);
        }
    });

    $(document).on('click', '#confirm_edit_spl_properties', function () {
        var title_spl = $('#spl_title').val();
        var uuid = $('#uuid_spl_edit').val();
        var display_mode = $('#display_mode').val();
        var hfr = 0;
        if ($('#spl_properties_hfr').is(":checked")) {
            hfr = 1;
        }
        $.ajax({
            url:"{{  url('') }}"+ "/editlocalspl",
            type: 'post',
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",

                title_spl: spl_title,
                display_mode: display_mode,
                hfr: hfr,
                uuid: uuid ,
            },
            success: function (response) {
                try {
                    if (status === "saved" ) {
                        $('#container2 > .div_list').map(function () {
                            if ($(this).data('version') === "new_item") {
                                this.setAttribute('data-version', "old");
                            }
                        });

                        array_spl = [];
                        array_length = 0;
                        window.array_length = 0;

                        $('#success_message_update').css({"background": "#CCF5CC"});
                        $('#success_message_update').fadeIn().html("SPL saved successfully");
                        setTimeout(function () {
                            $('#success_message_update').fadeOut("slow");
                        }, 2000);
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

    $(document).ready(function () {
        $(document).on('click', '.delete_spl', function () {

            var spl_uuid = $(this).data('uuid');
            var title = $(this).data('title');

            $("#spl_title_to_delete").html(title);
            $("#spl_uuid_to_delete").html(spl_uuid);
            $("#id_spl_delete").val(spl_uuid);
            $("#delete-spl").modal('show');

        //  deleteSplSelected(spl_uuid);
        });
    });
    $(document).ready(function () {
        $(document).on('click', '#confirm_delete_spl', function () {
            var spl_uuid =     $("#id_spl_delete").val();
        deleteSplSelected(spl_uuid);
        });
    });


    $(document).on('click', '#ingest-spl', function ()
    {

        $("#ingest-modal").modal('show');
        var loader_content  =
           '<div class="jumping-dots-loader">'
               +'<span></span>'
               +'<span></span>'
               +'<span></span>'
               +'</div>'
               $('#ingest-spl-list').html(loader_content)
               $('#ingest-spl-location').html(loader_content)

       var url = "{{  url('') }}"+   "/get_nocspl/";
       $.ajax({
               url: url,
               method: 'GET',
               success:function(response)
               {
                   console.log(response.spls) ;

                    locations =
                        '<select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="ingest-location" name="location"  >'

                    $.each(response.locations, function( index, location ) {

                        locations = locations
                        +'<option  value="'+location.id+'" data-locationip="'+location.connection_ip+'">'+location.name+'</option>'
                    });
                    locations = locations
                    +'</select>'

                    $('#ingest-spl-location').html(locations)

                   spl =
                   '<select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="nos-spl" name="nos-spl" >'

                   $.each(response.nocspls, function( index, value ) {

                    spl = spl
                    +'<option  value="'+value.uuid+'" data-title="'+value.spl_title+'"  data-duration="'+value.duration+'"  data-filepath="'+value.xmlpath+'">'+value.spl_title+'</option>'

                   });
                   spl = spl
                    +'</select>'
                   $('#ingest-spl-list').html(spl)


               },
               error: function(response) {

               }
       })


    });

    $(document).on('click', '#submit-ingest-form', function ()
    {
        var uuid =  $('#nos-spl').val();
        var ingest_location =  $('#ingest-location').val();
        var duration = $('#nos-spl option').data('duration');
        var title = $('#nos-spl option').data('title');
        //var url = $('#ingest-location option').data('locationip');
        //var url = "http://localhost/tms_front/system/api3.php";
        var url = "{{  url('') }}"+   "/sendXmlFileToApi/";
        var apiUrl = "http://localhost/tms_front/system/api3.php" ;
        path = $('#nos-spl option').data('filepath');  ;

        $.ajax({
            url:url,
            type: 'get',
            cache: false,
            data: {
                uuid: uuid,
                ingest_location: uuid,
                duration: duration,
                title: title,
                path: path,
                apiUrl : apiUrl,
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                try {
                    console.log(response)

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

</script>
@endsection

@section('custom_css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/dragula/dragula.min.css') }}">
    <style>


        /* ** custom ****/
        #dragula-left ,
        #dragula-right
        {
            border : 1px solid #2c2e33 ;
        }
        .select2.select2-container.select2-container--default
        {
            width : 80% !important ;
            background: #2a3038 ;
        }
        .select2-container--default .select2-selection--multiple
        {
            border : none ;
            background: #2a3038 ;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1)
        {
            font-size: 14px ;
            background: #2a3038 ;
        }
        .select2-container--default .select2-results__option--selected
        {
            background-color :#297eee ;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice
        {
            padding: 5px;
            padding-left: 21px ;

        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove
        {
            padding: 5px;
        }


        /** *************** **/

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .icon-prop-cpl {
            border: 1px solid aliceblue;
            padding: 7px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 13px;
            margin-right: 4px;
            display: inline-block;
            width: 35px;
            height: 35px;
            text-align: center;
        }

        .flat {
            background: radial-gradient(black, transparent);
            border: 1px solid #485968;
            padding: 7px;
            color: #fff;
            border-radius: 5px;
            margin-right: 3px;
            font-family: sans-serif;
            font-size: 16px;
            font-weight: bold;

        }

        .custom-check {
            cursor: pointer;
        }

        .title-kind {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            padding: 7px;

            background: black;
            margin-bottom: 7px;
        }

        .drag-over {
            border: 2px dashed #007BFF; /* Example: Add a dashed border when dragging over */
            background-color: #f0f0f0; /* Example: Add a light background color when dragging over */
            /* Add any other styling you want for the drop area */
        }

        .cpl_need_kdm {
            font-size: 26px;
            color: #36ffb9;
            margin-left: 13px;
        }

        .cpl-details {
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;

            cursor: pointer;
        }
        .pattern-details{
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;

            cursor: pointer;
        }
        .marker-details{
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;

            cursor: pointer;
        }
        .segment-details{
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;

            cursor: pointer;
        }

        .macro-details {
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;

            cursor: pointer;
        }

        .remove-cpl {
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;
            cursor: pointer;
        }
        .segment-style{
            border: 1px solid #b4ee29!important;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        .remove-segment {
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;
            cursor: pointer;
        }
        .remove-macro {
            font-size: 22px;
            color: white;
            text-shadow: 0px 0px #ffffff;
            font-weight: bold;
            cursor: pointer;
        }

        .close-cpl-details {
            border: solid #5f95cce0;
            padding: 8px;
            line-height: 0;
        }

        .custom-search {
            font-size: 23px;

            padding: 1px 4px 1px 4px;
        }

        .table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
            vertical-align: middle;

            line-height: 1;
            white-space: nowrap;
            padding: 0.9375rem;


            font-size: 16px;
            color: white;
        }

        #Properties {
            height: 500px;
        }

        #spls {
            height: 500px;
        }

        #kdms {
            height: 500px;
        }

        .selected-item {
            background: black;
            box-shadow: 0 0 10px rgb(231 221 221 / 50%);
            border: 3px solid #fff2f2 !important;
        }

        .color-white {
            color: white !important;
        }

        .macro-box {

            height: 37px;
            border: 1px solid #297eee;
            margin: 6px;
            padding: 3px;
            padding-top: 5px;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            padding-left: 14px;
            font-size: 18px;
            font-weight: bold;
            line-height: 1;
        }

        .marker-box {

            height: 37px;
            border: 1px solid #29ee4c;
            margin: 6px;
            padding: 3px;
            padding-top: 5px;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            padding-left: 14px;
            font-size: 18px;
            font-weight: bold;
            line-height: 1;
        }

     .hide_div {
            display: none;
        }

        #title_selected_item {
            font-size: 15px;
            font-weight: bold;
        }

        .hfr-label {
            color: white !important;
            font-size: 21px !important;
            margin-left: 6px !important;
            cursor: pointer;
        }

        .custom-form-group label {
            line-height: 1;
            vertical-align: top;
            font-size: 19px !important;
        }
        #order-listing{
            height: 688px;
        }

    </style>
@endsection
