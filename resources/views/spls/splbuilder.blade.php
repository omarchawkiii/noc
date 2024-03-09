@extends('layouts.app')
@section('title')
    Playlist Builder
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
                                        <select class="form-select  form-control form-select-sm"
                                            aria-label=".form-select-sm example" id="location" name="location[]"
                                            multiple="multiple">


                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
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

                                        <select class="form-select  form-control form-select-sm"
                                            aria-label=".form-select-sm example" id="filter_type">
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
                                        <input type="text" class="form-control" placeholder="Search"
                                            id="search-dragula-left">

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
                                    <button type="button" class="btn btn-primary btn-icon-text"
                                        id="display_spl_properties">
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
                                        <span class="palyback-text" id="opened_spl" data-uuid="" data-hfr=""
                                            data-mod="" data-opened_spl_status="0">No Playlist Selected</span>

                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <a href="#" id="add_segment">
                                        <i class="btn btn-inverse-warning  mdi mdi-cube-outline"
                                            style=" margin-top: 2px;"></i>
                                    </a>
                                    <a href="#" id="show_marker_modal">
                                        <i class="btn btn-inverse-success  mdi mdi-map-marker"
                                            style=" margin-top: 2px;"></i>
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
    <div class=" modal fade " id="spl-list" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>Playlists Available on NOC</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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

    <!--   macro modal-->
    <div class="modal fade " id="macro_modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Time Code </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">The automation cue will be attached to the elements time code </p>
                        <h3 class="text-center">PreShow2DFlat XYZ </h3>
                        <p class="text-center">00 : 00 : 00</p>
                    </div>
                    <form>
                        <div class="row mt-2">
                            <div class="form-group">
                                <label>Offset </label>
                                <div class="form-check mt-0">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios"
                                            id="optionsRadios1" value=""> From the beginning of the clip <i
                                                class="input-helper"></i><i class="input-helper"></i></label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios"
                                            id="optionsRadios2" value="option2" checked=""> From the end of the clip
                                        <i class="input-helper"></i><i class="input-helper"></i></label>
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

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-dark">Cancel</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--    pattern modal -->
    <div class="modal fade " id="pattern_modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="ModalLabel">
                        <i class="mdi mdi-format-indent-increase"
                        style="position: relative;top: 3px;font-size: 22px;color: #4b99ff;"></i>
                        Pattern Setup
                    </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="pattern_title">
                        <input type="hidden" id="uuid_before_item">
                        <input type="hidden" id="type_action" value="db_click">
                        <h3 id="display_pattern_title" style="text-align: center"></h3>
                        <p class="text-center font-weight-bold" style="font-size: 16px!important;">Output pattern
                            duration: <span id="pattern_in_seconds"></span> seconds </p>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="pattern_Minutes" class="font-weight-bold" style="font-size: 17px!important">Minutes</label>
                                <input type="number" class="form-control" style="font-size: 17px!important"
                                    id="pattern_Minutes" value="0" min="0">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pattern_Seconds" class="font-weight-bold" style="font-size: 17px!important">Seconds</label>
                                <input type="number" class="form-control" style="font-size: 17px!important"
                                    id="pattern_Seconds" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="text-align: center">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-fw" id="confirm_add_pattern">Confirm
                            </button>
                            <button type="button" class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="edit-pattern_modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="ModalLabel">
                        <i class="mdi mdi-format-indent-increase"
                        style="position: relative;top: 3px;font-size: 22px;color: #4b99ff;"></i>
                        Pattern Setup
                    </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_pattern_title">


                        <h3 id="edit_display_pattern_title" style="text-align: center"></h3>
                        <p class="text-center font-weight-bold" style="font-size: 16px!important;">Output pattern
                            duration: <span id="edit_pattern_in_seconds"></span> seconds </p>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="pattern_Minutes" class="font-weight-bold" style="font-size: 17px!important">Minutes</label>
                                <input type="number" class="form-control" style="font-size: 17px!important"
                                    id="edit_pattern_Minutes" value="0" min="0">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pattern_Seconds" class="font-weight-bold" style="font-size: 17px!important">Seconds</label>
                                <input type="number" class="form-control" style="font-size: 17px!important"
                                    id="edit_pattern_Seconds" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="text-align: center">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-fw" id="confirm_edit_pattern">Confirm
                            </button>
                            <button type="button" class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--    no cpl selected-->
    <div class="modal fade " id="no-cpl-selected" tabindex="-1" role="dialog"
        aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select Playlist Item </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center"> No CPL Selected!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                            data-bs-dismiss="modal" aria-label="Close">OK
                    </button>


                </div>

            </div>
        </div>
    </div>
    <!--    no spl opened -->
    <div class="modal fade " id="no-spl-selected" tabindex="-1" role="dialog"
        aria-labelledby="delete_client_modalLabel" aria-hidden="true">>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="badge badge-warning" style="font-size: 18px;">Warning</div>

                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body minauto ">
        <!--           <h5 class="modal-title" id="ModalLabel">Please Select a Playlist  </h5>-->
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
    <!--    macro  modal -->
    <div class="modal fade show" id="macro-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Time Code </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" style="font-size: 17px;">The automation cue will be attached to the
                            elements time code : <br/> <span id="parent_title"></p>
                        <input type="hidden" value="" id="parent_macro_duration">
                        <h3 class="text-center" id="macro_title" style="font-size: 17px;"> </h3>
                        <input type="hidden" value="" id="macro_command">
                        <input type="hidden" value="" id="macro_title_val">
        <!--     <p class="text-center" style="font-size: 17px;" id="macro_time_hms">00 : 00 : 00</p>-->
                        <p class="text-center" style="font-size: 17px;" id="macro_time_hms">
                        <div class="label-status"></div>
                        <span id="display_start_macro_hours"></span>
                            <span id="display_start_macro_minutes"></span>
                            <span id="display_start_macro_seconds"></span>
                        </p>
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
                                        value="Start"
                                        checked=""> From the beginning of the clip
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
                                            > From the end of the clip
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
                                    value="0" min="0" max="24">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Minutes_macro" style="font-size: 17px;">Minutes</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="Minutes_macro"
                                    value="0" min="0" max="60">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Seconds_macro" style="font-size: 17px;">Seconds</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="Seconds_macro"
                                    value="0" min="0" max="60">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col" style="text-align: center">
                            <input type="hidden" id="action_macro" value="add">
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

    <div class="modal fade show" id="edit-macro-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Time Code </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" style="font-size: 17px;">
                            The automation cue will be attached to the elements time code :
                            <br/> <span id="edit_parent_title"></span>
                        </p>
                        <input type="hidden" value="" id="edit_parent_macro_duration">
                        <h3 class="text-center" id="edit_macro_title" style="font-size: 17px;">  </h3>
                        <input type="hidden" value="" id="edit_macro_command">
                        <input type="hidden" value="" id="edit_macro_title_val">
                        <input type="hidden" value="" id="edit_macro_uuid">
                        <input type="hidden" id="edit_macro_parent_uuid" value="">

                        <p class="text-center" style="font-size: 17px;" id="edit_macro_time_hms"> </p>
                        <div class="label-status"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group">
                            <label style="font-size: 17px;">Offset </label>
                            <div class="form-check mt-0">
                                <label class="form-check-label" style="font-size: 17px;">
                                    <input type="radio"
                                        class="form-check-input Offset"
                                        name="edit_Offset_macro"
                                        id="edit_start_macro"
                                        value="Start"> From the beginning of the clip
                                    <i class="input-helper "></i><i class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" style="font-size: 17px;">
                                    <input type="radio"
                                        class="form-check-input Offset"
                                        name="edit_Offset_macro"
                                        id="edit_end_macro"
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
                                <input type="number" style="font-size: 17px;" class="form-control" id="edit_Hours_macro"
                                    value="0" min="0" max="24">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Minutes_macro" style="font-size: 17px;">Minutes</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="edit_Minutes_macro"
                                    value="0" min="0" max="60">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Seconds_macro" style="font-size: 17px;">Seconds</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="edit_Seconds_macro"
                                    value="0" min="0" max="60">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col" style="text-align: center">

                            <button type="button" class="btn btn-primary btn-fw" id="confirm_edit_macro">Confirm</button>
                            <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel
                            </button>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!--    marker  modal -->
    <div class="modal fade show" id="marker-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Marker Time Code </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" style="font-size: 17px;">The Marker will be attached to the elements time
                            code : <span id="title_selected_item"></span></p>
                        <p class="text-center" style="font-size: 17px;" id="marker_time_hms">00 : 00 : 00</p>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label style="font-size: 17px;">Marker Label </label>
                            <input type="text" id="marker_label" value=""/>
                            <div class="label-status"></div>
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
                                    value="0" min="0">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Minutes_marker" style="font-size: 17px;">Minutes</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="Minutes_marker"
                                    value="0" min="0">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Seconds_marker" style="font-size: 17px;">Seconds</label>
                                <input type="number" style="font-size: 17px;" class="form-control" id="Seconds_marker"
                                    value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <input type="hidden" id="action_marker" value="add">
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

    <div class="modal fade show" id="edit-marker-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Marker Time Code </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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
                            <div class="label-status"></div>
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
    <!--      segment modal -->
    <div class="modal fade show" id="segment-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">
                        <i class="btn btn-inverse-warning  mdi mdi-cube-outline"  style="margin-right: 7px;"></i>Edit Pack Information </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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
    <!--    spl properties-->
    <div class="modal fade show" id="spl-properties-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
          <h5 class="modal-title" id="save_spl_title">
                            <i class="mdi mdi-library-plus btn btn-primary"></i> Save New Playlist Properties</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <input type="hidden"  id="spl_action" value="insert">
                        <input type="hidden"  id="spl_uuid_edit" value="">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group">
                                    <label>SPL Title</label>
                                    <input type="text" class="form-control" id="spl_title" aria-label="SPL Title">
                                    <div class="label-status"></div>
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
                            <div class="col-md-12">
                                    <div class="form-group custom-form-group">
                                        <div class="edit-status" id="status_edit"></div>
                                    </div>
                           </div>
                           <div class="col-md-12 row " id="auto_ingest_on_after_edit">

                           </div>
                           <div class="col-md-12 row " id="available_on_after_edit">

                           </div>
                           <div class="col-md-12 row " id="available_on_after_edit_ingest_result">

                           </div>
                        </div>

                    </div>
                         <div class="row mt-2">
                            <div class="col hide_div"  id="parent_upload_spl_after_edit" style="text-align: center"  >
                                <button type="button" class="btn btn-primary btn-fw" id="upload_spl_after_edit">Upload</button>
                            </div>
                            <div class="col" style="text-align: center" id="block_save_new_spl">
                                <button type="button" class="btn btn-primary btn-fw" id="save_new_spl">Save</button>
                                <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                        aria-label="Close" style="font-size: 16px;font-weight: bold;">Cancel
                                </button>
                            </div>
                            <div class="col hide_div" style="text-align: center" id="block_edit_spl">
                                <button type="button" class="btn btn-primary btn-fw" id="save_edited_spl">Save</button>
                                <button type="button" class="btn btn-primary btn-fw" id="save_as_new_spl">Save As New
                                    SPL
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="edit-spl-properties-modal" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Save New Playlist Properties</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group">
                                    <label>SPL Title</label>
                                    <input type="hidden" class="form-control" id="uuid_spl_edit"  value="" >
                                    <input type="text" class="form-control" id="edit_spl_title" aria-label="SPL Title">
                                    <div class="label-status"></div>
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
                                            class="form-check-input " id="edit_hfr_spl"> HFR <i class="input-helper"></i><i
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

    <div class=" modal fade " id="ingest-modal" role="dialog" aria-labelledby="delete_client_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">

                <div class="modal-header">
                    <h5>Playlists Available on NOC</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true" style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
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
                    <div class="row mt-5">
                        <div class="col" style="text-align: center">
                            <button type="button" class="btn btn-primary btn-fw" id="submit-ingest-form">Ingest</button>
                            <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="ingest-response" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">

                <div class="modal-header p-4 pb-0">
                    <h5></h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                <div class="modal-body minauto">
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
    <!--  empty-spl-modal -->
    <div class="modal fade" id="empty-spl-modal" tabindex="-1" aria-labelledby="delete_client_modalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><i class="mdi mdi-alert btn btn-warning"></i> Warning
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <div class="tab-pane fade active show" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group custom-form-group" style="text-align: center">
                                    <label> PlayList can't be empty </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col" style="text-align: center">
                                <button class="btn btn-secondary btn-fw close" data-bs-dismiss="modal" aria-label="Close">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
    <script src="{{ asset('assets/vendors/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragula.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#location').select2();
        });
    </script>

    <script>
        let content_height = document.querySelector('.content-wrapper').offsetHeight;
        let navbar_height = document.querySelector('.navbar').offsetHeight;
        //let footer_height = document.querySelector('.footer').offsetHeight;
        let page_header_height = document.querySelector('.page-header ').offsetHeight;
        let content_max_height = content_height - navbar_height - page_header_height - 200;

        $(".multiplex").height(content_max_height);

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".preview-item").click(function() {

            $(this).toggleClass("selected");
        });
    </script>

    <script>
        $('#location').change(function() {

            var box = "";
            var box_kind = "";
            var detail = "";

            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#dragula-left').html(loader_content)

            var location = $('#location').val();

            var url = "{{ url('') }}" + '/get_cpl_with_filter_for_noc/?location=' + location +'&lms=true&playlist_builder=true';
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $.each(response.cpls, function(index, value) {

                        if (value.contentKind.localeCompare(box_kind) == 0) {
                            box_kind = value.contentKind;
                        } else {
                            box_kind = value.contentKind;
                            box += '<div class=" filtered  div_list title-kind  "   ' +
                                '        data-type="' + value.contentKind + '">' + value
                                .contentKind + '  </div>';
                        }
                        if (value.contentKind.match(
                            /^(SPL|Automation|Trigger|Cues|Pattern)$/)) {

                        }

                        box +=
                            '   <div class="card rounded border mb-2 left-side-item"' +
                            '       data-side="left"   ' +
                            '       data-auditorium="' + value.id_auditorium + '" ' +
                            '       data-uuid="' + value.uuid + '"' +
                            '       data-title="' + value.contentTitleText + '"' +
                            '       data-time="' + value.duration + '"  ' +
                            '       data-time_seconds="' + value.durationEdits + '"  ' +
                            '       data-time_Duration_frames="' + value.durationEdits + '"  ' +
                            '       data-type_component="cpl"' +
                            '       data-id="' + value.id + '"' +
                            '       data-idcpl="' + value.id + '"' +
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
                            '                       <p class="mb-0 text-muted float-left">' + formatDurationToHMS(value.durationEdits) + ' <span class="detail-cpl">  Subtitle, VI, HI, DBox </span>   </p>\n' +
                            '                       <p class="mb-0 text-muted float-right">\n' +
                            '                          <span class="icon-prop-cpl">' +
                            (value.is_3D == 1 ? '3D' : '2D') +
                            '                          </span>\n' +
                            '                          <span class="flat">  ' +
                            (value.aspect_Ratio == "unknown" ? value.type
                                : value.aspect_Ratio + ' ' + value.cinema_DCP) +
                            '                           </span>\n' +
                            '                          <span class="flat">' + value.soundChannelCount + ' </span>\n' +
                            '                          <span class="flat"> ST  </span>\n' +
                            '                          <span  class=" infos_modal" href="#" ' +
                            '                                data-uuid="' + value.uuid + '"' +
                            '                                 id="' + value.id + '"' +
                            '                                data-need_kdm="' + ((value
                                .pictureEncryptionAlgorithm == "None" || value
                                .pictureEncryptionAlgorithm == 0) ? 0 : 1) + '"' +
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
                    $.each(response.macros, function(index, value) {
                        box +=
                        '<div  style="padding:5px" class="macro_item   div_list card rounded border mb-2 left-side-item" ' +
                        '       data-command="' + value.command + '" data-title="' + value.title + '" data-id="' + value.idmacro_config + '" data-type="Macros">' +
                        '       <div class="card-body p-3">\n' +
                        '                 <div class="media-body float-left">\n' +
                        '                    <div class="title-content col-md-12"> <i class="btn btn-inverse-primary  mdi mdi-server-network"></i> ' + value.title + ' </div>' +
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

        // filter files by kind
        $(document).on('change', '#filter_type', function(event) {
            var criteria = $(this).val();

            if (criteria == 'all') {
                $('.left-side-item').show();
                $('.title-kind').show();
                return;
            }
            $('#dragula-left .left-side-item').each(function(i, option) {
                if ($(this).data("type") == criteria) {

                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#dragula-left .title-kind').each(function(i, option) {
                if ($(this).data("type") == criteria) {

                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        //search  content left side
        var search_content = document.getElementById('search-dragula-left');

        search_content.onkeyup = function() {
            var searchTerms = $(this).val();
            $('#dragula-left .left-side-item ').each(function() {

                var hasMatch = searchTerms.length == 0 ||
                    $(this).text().toLowerCase().indexOf(searchTerms.toLowerCase()) > 0;
                $(this).toggle(hasMatch);

            });
        }
        // display cpl details

        // get cpl details left/right sides
        /*$(document).on('click', '#dragula-left .cpl-details', function() {
            let id_cpl = $(this).data("uuid");
            let need_kdm = $(this).data("need_kdm");
            getCplDetails(id_cpl, need_kdm);
        }); */
        /*$(document).on('click', '#dragula-right .cpl-details', function() {
            let id_cpl = $(this).data("uuid");

            getCplDetails(id_cpl, 0);
        });*/
        //  *****************************   macros
        $(document).on('click', '.macro-details', function() {


            let macro_uuid = this.closest('.macro-box').getAttribute("data-uuid");
            let data_hours = this.closest('.macro-box').getAttribute("data-hours");
            let data_minutes = this.closest('.macro-box').getAttribute("data-minutes");
            let data_seconds = this.closest('.macro-box').getAttribute("data-seconds");
            let data_time = this.closest('.macro-box').getAttribute("data-time");
            let title = this.closest('.macro-box').getAttribute("data-title");
            let offset = this.closest('.macro-box').getAttribute("data-offset");
            let command = this.closest('.macro-box').getAttribute("data-command");
            let duration_seconds = this.closest('.macro-box').getAttribute("data-time_seconds");
            // get uuid parent cpl/pattern
            var leftSideItem = $(this).closest('.left-side-item');
            var macro_box = $(this).closest('.macro-box');
            var parent_uuid = leftSideItem.data('uuid');
            var parent_title = leftSideItem.data('title');
            var parent_duration = leftSideItem.data('time_seconds');
            if (offset == "End") {

                $('#edit_macro_time_hms').html(convertSecondsToHMS(parent_duration - duration_seconds));
            } else {
                $('#edit_macro_time_hms').html(convertSecondsToHMS(duration_seconds));
            }
            $("#edit_macro_parent_uuid").html(parent_uuid);
            $("#edit_parent_title").html(parent_title);
            $("#edit_parent_macro_duration").val(parent_duration);
            $("#edit_macro_uuid").val(macro_uuid);
            $("#edit_macro_title").html(title);
            $("#edit_macro_title_val").val(title);
            $("#edit_macro_command").val(command);

            $("#edit_Hours_macro").val(parseInt(data_hours));
            $("#edit_Minutes_macro").val(parseInt(data_minutes));
            $("#edit_Seconds_macro").val(parseInt(data_seconds));

            if (offset === "Start") {
                $("#edit_start_macro").prop("checked", true);
            } else if (offset === "End") {
                $("#edit_end_macro").prop("checked", true);
            }
            $("#edit-macro-modal").modal('show');
        });
        $(document).on('click', '#confirm_add_macro', function() {
            var macro_command = $('#macro_command').val();
            var macro_title = $('#macro_title_val').val();
            var Hours_macro = $('#Hours_macro').val();
            var Minutes_macro = $('#Minutes_macro').val();
            var Seconds_macro = $('#Seconds_macro').val();
            var offset = $('input[name=Offset_macro]:checked').val();
            var time_macro = Hours_macro + ' : ' + Minutes_macro + ' : ' + Seconds_macro;
            var time_seconds = parseInt(Hours_macro) * 60 * 60 + parseInt(Minutes_macro) * 60 + parseInt(
                Seconds_macro);
            var macro_box = '' +
                '<div class="media-body macro-box col-md-8" data-title="' + macro_title + '"' +
                '      data-offset="' + offset + '" ' +
                '      data-command="' + $.trim(macro_command) + '" ' +
                '      data-time="' + convertSecondsToHMS(time_seconds) + '"  data-time_seconds="' + time_seconds +
                '"' +
                '      data-Hours="' + Hours_macro + '" ' + 'data-Minutes="' + Minutes_macro + '" ' +
                'data-Seconds="' + Seconds_macro + '" ' +
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



            if ($.trim($('#macro_time_hms').text()) !== "error") {
                var selectedCard = $('#dragula-right .left-side-item.selected-item');

                // Check if selectedCard is not empty
                if (selectedCard.length > 0) {
                    // Get the last .media-body element inside the selected item
                    var macro_body = selectedCard.find('.macro-list');
                    macro_body.removeClass('hide_div');

                    // Append the macro_box content after the last .media-body
                    macro_body.append(macro_box);
                }
                $('#macro_time_hms').next().text("  ");
                $("#macro-modal").modal("hide");
                // reporder list items afetr append macro
                var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                    macroTime);
                            } else if (macroKind === "End") {
                                console.log(composition_end_time);
                                console.log(macroTime);
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }

                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('.mb-0.text-muted.float-left').innerText =
                                convertSecondsToHMS(macroStartTime);
                        }
                    }

                    var macroList = items[i].querySelector('.card-body.macro-list');
                    reorderMacroList(macroList);
                }
            } else {
                $('#macro_time_hms').next().text(" Time parameters can't be applied !");
            }

        });


        $(document).on('input', '#Hours_macro', function() {
            var parent_duration = parseInt($('#parent_macro_duration').val());
            var seconds = $('#Seconds_macro').val();
            var minutes = $('#Minutes_macro').val();
            var hours = $('#Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }

            // updateSecond('display_start_macro_hours','hours')
        });
        $(document).on('input', '#Minutes_macro', function() {
            var parent_duration = parseInt($('#parent_macro_duration').val());
            var seconds = $('#Seconds_macro').val();
            var minutes = $('#Minutes_macro').val();
            var hours = $('#Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }
        });
        $(document).on('input', '#Seconds_macro', function() {
            var parent_duration = parseInt($('#parent_macro_duration').val());
            var seconds = $('#Seconds_macro').val();
            var minutes = $('#Minutes_macro').val();
            var hours = $('#Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="Offset_macro"]:checked').val();

            if ((parent_duration - time_seconds) <= 0) {
                $('#macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }
        });
        $('input[name="Offset_macro"]').change(function() {

            var parent_duration = parseInt($('#parent_macro_duration').val());
            var seconds = $('#Seconds_macro').val();
            var minutes = $('#Minutes_macro').val();
            var hours = $('#Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="Offset_macro"]:checked').val();

            if ((parent_duration - time_seconds) <= 0) {
                $('#macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }

            // Add your code to handle the change event here
        });

        $(document).on('click', '#confirm_edit_macro', function() {
            var macro_uuid = $('#edit_macro_uuid').val();
            var parent_uuid = $('#edit_macro_parent_uuid').val();
            var macro_command = $('#edit_macro_command').val();
            var macro_title = $('#edit_macro_title_val').val();
            var Hours_macro = $('#edit_Hours_macro').val();
            var Minutes_macro = $('#edit_Minutes_macro').val();
            var Seconds_macro = $('#edit_Seconds_macro').val();
            var offset = $('input[name=edit_Offset_macro]:checked').val();
            var time_seconds = parseInt(Hours_macro) * 60 * 60 + parseInt(Minutes_macro) * 60 + parseInt(
                Seconds_macro);


            //  var markerBox = parentItem.find('.macro-list .macro-box[data-uuid="' + macro_uuid + '"]');

            var macro_box = '' +
                macro_title +
                '  <p class="mb-0 text-muted float-left"> ' + convertSecondsToHMS(time_seconds) + ' </p> ' +
                '   <span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span>' +
                '  <p class="mb-0 text-muted float-right">\n' +
                '        <span class=" ">\n' +
                '            <i class="btn btn-primary  mdi mdi-magnify custom-search  macro-details" ' +
                '                style="font-size: 18px; "></i>\n' +
                '            <i class="btn btn-danger mdi mdi-delete-forever remove-macro custom-search" style="font-size: 18px;"></i>' +
                '        </span>' +
                '    </p>\n';

            // Check if selectedCard is not empty
            var selected_item = $('#dragula-right .left-side-item.selected-item');
            var selected_macro = $(
                '#dragula-right .left-side-item.selected-item .macro-list .macro-box[data-uuid="' + macro_uuid +
                '"]');
            selected_macro.attr('data-title', macro_title);
            selected_macro.attr('data-offset', offset);
            selected_macro.attr('data-command', macro_command);
            selected_macro.attr('data-time', convertSecondsToHMS(time_seconds));
            selected_macro.attr('data-Hours', Hours_macro);
            selected_macro.attr('data-Minutes', Minutes_macro);
            selected_macro.attr('data-Seconds', Seconds_macro);

            if ($.trim($('#edit_macro_time_hms').text()) !== "error") {
                if (selected_item.length > 0) {
                    selected_macro.html(macro_box);
                }
                $('#edit_macro_time_hms').next().text("  ");
                $("#edit-macro-modal").modal("hide");

                // reporder list items afetr append macro
                var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                    macroTime);
                            } else if (macroKind === "End") {
                                console.log(composition_end_time);
                                console.log(macroTime);
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }

                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('.mb-0.text-muted.float-left').innerText =
                                convertSecondsToHMS(macroStartTime);
                        }
                    }

                    var macroList = items[i].querySelector('.card-body.macro-list');
                    reorderMacroList(macroList);
                }
            } else {
                $('#edit_macro_time_hms').next().text(" Time parameters can't be applied !");

            }

        });

        $(document).on('input', '#edit_Hours_macro', function() {
            var parent_duration = parseInt($('#edit_parent_macro_duration').val());
            var seconds = $('#edit_Seconds_macro').val();
            var minutes = $('#edit_Minutes_macro').val();
            var hours = $('#edit_Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="edit_Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#edit_macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }

            // updateSecond('display_start_macro_hours','hours')
        });
        $(document).on('input', '#edit_Minutes_macro', function() {
            var parent_duration = parseInt($('#edit_parent_macro_duration').val());
            var seconds = $('#edit_Seconds_macro').val();
            var minutes = $('#edit_Minutes_macro').val();
            var hours = $('#edit_Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="edit_Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#edit_macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }
        });
        $(document).on('input', '#edit_Seconds_macro', function() {
            var parent_duration = parseInt($('#edit_parent_macro_duration').val());
            var seconds = $('#edit_Seconds_macro').val();
            var minutes = $('#edit_Minutes_macro').val();
            var hours = $('#edit_Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="edit_Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#edit_macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }
        });
        $('input[name="edit_Offset_macro"]').change(function() {

            var parent_duration = parseInt($('#edit_parent_macro_duration').val());
            var seconds = $('#edit_Seconds_macro').val();
            var minutes = $('#edit_Minutes_macro').val();
            var hours = $('#edit_Hours_macro').val();
            var time_seconds = parseInt(hours) * 60 * 60 + parseInt(minutes) * 60 + parseInt(seconds);
            var selectedOffset = $('input[name="edit_Offset_macro"]:checked').val();
            if ((parent_duration - time_seconds) <= 0) {
                $('#edit_macro_time_hms').html(' error');
            } else {
                if (selectedOffset == "End") {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(parent_duration - time_seconds));
                } else {
                    $('#edit_macro_time_hms').html(convertSecondsToHMS(time_seconds));
                }

            }
        });
        $(document).on('click', '.remove-macro', function() {

            $(this).parent().parent().parent().remove();
            // re-order items
            var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                            macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                macroTime);
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

        //  end macro

        // *****************************  marker
        $(document).on('click', '#show_marker_modal', function() {

            var selectedCard = $('#dragula-right .left-side-item.selected-item');

            // Check if selectedCard is not empty
            if (selectedCard.length > 0) {
                var dataTitleValue = selectedCard.data('title');
                $("#title_selected_item").html(dataTitleValue);
                // Get the last .media-body element inside the selected item
                // var marker_body = selectedCard.find('.marker-list');
                // marker_body.removeClass('hide_div');
                $("#action_marker").val("add");
                $('#marker_label').next().text(" ");
                $('#marker_label').val(" ");
                $('#Hours_marker').val(0);
                $('#Minutes_marker').val(0);
                $('#Seconds_marker').val(0);
                $('#start_marker').prop('checked', true);
                $('#end_marker').prop('checked', false);
                $("#marker-modal").modal('show');
            } else {
                $("#no-cpl-selected").modal('show');
            }

        });
        $(document).on('click', '#confirm_add_marker', function() {

            var marker_label = $('#marker_label').val();
            var uuid = $.trim('urn:uuid:' + uuidv4());
            var Hours_marker = $('#Hours_marker').val();
            var Minutes_marker = $('#Minutes_marker').val();
            var Seconds_marker = $('#Seconds_marker').val();
            var offset = $('input[name=Offset_marker]:checked').val();
            var time_marker = Hours_marker + ' : ' + Minutes_marker + ' : ' + Seconds_marker;
            var time_seconds = parseInt(Hours_marker) * 60 * 60 + parseInt(Minutes_marker) * 60 + parseInt(
                Seconds_marker);

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
                if ($.trim(marker_label) !== '') {
                    $('#marker_label').next().text(" ");
                    // Get the last .media-body element inside the selected item
                    var marker_body = selectedCard.find('.marker-list');
                    marker_body.removeClass('hide_div');

                    // Append the macro_box content after the last .media-body
                    marker_body.append(marker_box);
                    $("#marker-modal").modal("hide");
                } else {
                    $('#marker_label').next().text("Marker Label can't be empty.");
                }


            }


        });
        $(document).on('click', '.remove-marker', function() {

            $(this).parent().parent().parent().remove();
            // re-order items
            var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                            macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                macroTime);
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
        $(document).on('click', '.marker-details', function() {
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
        $(document).on('click', '#confirm_edit_marker', function() {

            var marker_label = $('#edit_marker_label').val();
            var uuid = $('#marker_uuid').val();
            var parent_id = $('#parent_uuid').val();
            var Hours_marker = $('#edit_Hours_marker').val();
            var Minutes_marker = $('#edit_Minutes_marker').val();
            var Seconds_marker = $('#edit_Seconds_marker').val();
            var offset = $('input[name=edit_Offset_marker]:checked').val();
            var time_seconds = parseInt(Hours_marker) * 60 * 60 + parseInt(Minutes_marker) * 60 + parseInt(
                Seconds_marker);


            var parentItem = $('#dragula-right .left-side-item[data-uuid="' + parent_id + '"]');

            var markerBox = parentItem.find('.marker-list .marker-box[data-uuid="' + uuid + '"]');

            var marker_box = marker_label +
                '<p class="mb-0 text-muted float-left">' + convertSecondsToHMS(time_seconds) + ' </p>' +
                '<span class="mb-0 text-muted float-left" style="margin: 0px 2px 0px 20px; ">  ---  </span> ' +
                ' <p class="mb-0 text-muted float-right">' +
                '  <span class=" ">' +
                '       <i class="btn btn-primary  mdi mdi-magnify custom-search  marker-details" data-uuid="' +
                uuid + '" style="font-size: 18px; "></i>' +
                '       <i class="btn btn-danger mdi mdi-delete-forever remove-marker custom-search" style="font-size: 18px;"></i>  ' +
                '  </span>' +
                ' </p> ';
            if ($.trim(marker_label) !== '') {
                $('#edit_marker_label').next().text(" ");
                markerBox.html(marker_box);
                markerBox.attr('data-title', marker_label);
                markerBox.attr('data-time', convertSecondsToHMS(time_seconds));
                markerBox.attr('data-offset', offset);
                markerBox.attr('data-uuid', uuid);
                markerBox.attr('data-hours', Hours_marker);
                markerBox.attr('data-minutes', Minutes_marker);
                markerBox.attr('data-seconds', Seconds_marker);

                $("#edit-marker-modal").modal('hide');
            } else {
                $('#edit_marker_label').next().text("Marker Label can't be empty.");
            }


        });

        // edit marker

        // **************************  segment

        $(document).on('click', '#add_segment', function () {
            var uuid_segment = 'urn:uuid:' + uuidv4();
            var segment_box = '' +
                '<div class="card rounded border mb-2  left-side-item   segment-style" data-side="right" ' +
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
        $(document).on('click', '.segment-details', function() {
            //let title = $(this).parent().parent().parent().parent().parent().data("title");
            let title = $(this).closest('.card[data-title]').data("title");
            let uuid = $(this).parent().parent().parent().parent().parent().data("uuid");

            $("#pack_name").val(title);
            $("#segment_uuid").val(uuid);

            $("#segment-modal").modal('show');
        });
        $(document).on('click', '#confirm_add_segment', function() {
            var title = $('#pack_name').val();
            var uuid = $('#segment_uuid').val();
            var type = "segment";
            var targetItem = $('#dragula-right .card[data-uuid="' + uuid + '"][data-type="' + type + '"]');
            if (targetItem.length > 0) {
                // Change the text inside mb-0 text-muted float-left

                targetItem.attr('data-title', title).promise().done(function() {
                    // Retrieve the updated data-title value
                    var updatedTitle = targetItem.attr('data-title');

                });
                targetItem.find('.mb-0.text-muted.float-left').html(
                    '<i class="btn btn-inverse-warning  mdi mdi-package-variant-closed"></i> ' + title);
            }

        });

        // end marker

        // ******************  pattern
        $(document).on('click', '#confirm_add_pattern', function() {
            var type_action = $('#type_action').val();
            var pattern_title = $('#pattern_title').val();
            var pattern_Seconds = $('#pattern_Seconds').val();


            var pattern_Minutes = $('#pattern_Minutes').val();

            var time_seconds = parseInt(pattern_Minutes) * 60 + parseInt(pattern_Seconds);

            if (pattern_title == "Black 3D 48") {
                var editrate_numerator = "48";
                var editrate_denominator = "1";
            } else {
                var editrate_numerator = "24";
                var editrate_denominator = "1";
            }
            var icon = pattern_title == "Black" ? " " : ' <span class="icon_pattern">3D</span> ';
            var pattern_box =
                '<div class="card rounded border mb-2 left-side-item" data-side="left" ' +
                '     data-type="Pattern"' +
                '     data-id="' + uuidv4() + '"' +
                '     data-uuid="urn:uuid:' + uuidv4() + '"' +
                '     data-source=""' +
                '     data-title="' + pattern_title + '"' +
                '     data-editrate_denominator="' + editrate_denominator + '"' +
                '     data-editrate_numerator="' + editrate_numerator + '"' +
                '     data-minutes="' + pattern_Minutes + '"' +
                '     data-seconds="' + pattern_Seconds + '"' +
                '     data-version="new_item"' +
                '     data-time_seconds="' + time_seconds + '"' +
                '     data-time="' + convertSecondsToHMS(time_seconds) + '"' +
                '  >   ' +
                '   <div class="card-body  ">\n' +
                '      <div class="media-body  ">\n' +
                '          <h6 class="mb-1" style=" font-size: 18px">' + pattern_title + '</h6>\n' +
                '      </div>\n' +
                '      <div class="media-body">\n' +
                '         <p class="mb-0 text-muted float-left">' + convertSecondsToHMS(time_seconds) + '</p>\n' +
                '         <p class="mb-0 text-muted float-right">\n' +
                '            <span class=" ">\n' +
                '              <i class="btn btn-primary  mdi mdi-magnify custom-search  pattern-details" data-uuid="urn:uuid:e83235b4-f50d-4f46-906f-2ce2cca1ba52" ></i>\n' +
                '              <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>\n' +
                '            </span>' +
                '         </p>\n' +
                '       </div>\n' +
                '   </div>\n' +
                '   <div class="card-body macro-list  hide_div"></div>' +
                '   <div class="card-body marker-list hide_div"></div>' +
                '</div>';
            if (type_action == "db_click") {
                $('#dragula-right').append(pattern_box);
            } else {
                var uuid_before = $('#uuid_before_item').val();
                // var before_item = $('#dragula-right .left-side-item[data-uuid="' + uuid_before + '"]');
                if (uuid_before == "default_uuid") {
                    $('#dragula-right').append(pattern_box);
                } else {
                    $('#dragula-right .left-side-item').each(function() {
                        var currentUuid = $(this).data('uuid');

                        // Check if the current card's uuid matches the one to insert before
                        if (currentUuid === uuid_before) {
                            // Insert the new card before the current card
                            $(this).before(pattern_box);
                            return false; // Exit the loop after inserting the new card
                        }
                    });
                }

            }


            //  $('#dragula-right').append(pattern_box);
            // re-order items
            var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                            macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                macroTime);
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
            reorderRightList();
        });

        $(document).on('click', '.pattern-details', function() {
            // let id_cpl = $(this).data("uuid");
            // let title = $(this).data("title");
            // let title = $(this).data("title");
            // let title = $(this).data("title");
            //
            var title = this.closest('.left-side-item ').getAttribute("data-title");
            var minutes = this.closest('.left-side-item ').getAttribute("data-minutes");
            var seconds = this.closest('.left-side-item ').getAttribute("data-seconds");
            $('#edit_display_pattern_title').html(title);
            $('#edit_pattern_title').val(title);
            $('#edit_pattern_Minutes').val(minutes);
            $('#edit_pattern_Seconds').val(seconds);
            $('#edit_pattern_in_seconds').html(this.closest('.left-side-item ').getAttribute("data-time_seconds"));

            $("#edit-pattern_modal").modal('show');
        });

        $(document).on('click', '#confirm_edit_pattern', function() {


            var pattern_Seconds = $('#edit_pattern_Seconds').val();
            var pattern_Minutes = $('#edit_pattern_Minutes').val();
            var time_seconds = parseInt(pattern_Minutes) * 60 + parseInt(pattern_Seconds);


            var selected_item = $('#dragula-right .left-side-item.selected-item');

            selected_item.attr('data-time_seconds', time_seconds);
            selected_item.attr('data-time', convertSecondsToHMS(time_seconds));
            selected_item.attr('data-minutes', pattern_Minutes);
            selected_item.attr('data-seconds', pattern_Seconds);

            reorderRightList();
        });

        $(document).on('dblclick', '#dragula-left .left-side-item', function(e) {
            var clonedElement = $(this).clone();
            if (clonedElement.data('type') === "Macros") {

                var selected_item = $('#dragula-right .left-side-item.selected-item');
                if (selected_item.length === 0) {
                    $("#no-cpl-selected").modal('show');
                } else {
                    var destination_title = selected_item.data('title');
                    var destination_duration = selected_item.data('time_seconds');
                    $("#parent_title").html(destination_title);
                    $("#macro_title").html(clonedElement.data('title'));
                    $("#parent_macro_duration").val(destination_duration);
                    $("#macro_command").val(clonedElement.data('command'));
                    $("#macro_title_val").val(clonedElement.data('title'));
                    $("#macro_time_hms").html('00:00:00');
                    $("#Hours_macro").val(0);
                    $("#Minutes_macro").val(0);
                    $("#Seconds_macro").val(0);
                    $('#macro_time_hms').next().text("  ");
                    $("#start_macro").prop("checked", true);
                    $("#end_macro").prop("checked", false);
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
            } else if (clonedElement.data('type') === "Pattern") {
                $("#type_action").val('db_click');
                $("#pattern_Minutes").val('0');
                $("#pattern_Seconds").val('0');
                $("#pattern_title").val(clonedElement.data('title'));
                $("#display_pattern_title").html(clonedElement.data('title'));
                $("#pattern_modal").modal('show');


            } else if (clonedElement.data('type') === "SPL") {

            } else {

                modifyContentBeforeDrop(clonedElement.get(0));

                $('#dragula-right').append(clonedElement);

                // re-order items
                var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                                macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                    macroTime);
                            } else if (macroKind === "End") {
                                macroStartTime = composition_end_time - convertHMSToSeconds(macroTime);
                            } else {
                                // Handle other cases if needed
                                macroStartTime = 0;
                            }
                            // Update the macro_time div with the calculated start time
                            macroItems[j].querySelector('#macro_time').innerText = convertSecondsToHMS(
                                macroStartTime);
                        }
                    }
                }
            }

        });

        // *************************  Top menu Right Side

        //click btn new spl
        $(document).on('click', '#reset_spl_builder', function() {
            //$('#actual_spl_title').text("No SPL Selected , Create New One");
            //  $('#id_spl_opened').text(0);
            $('#opened_spl').attr('data-opened_spl_status', 0);
            $('#opened_spl').attr('data-hfr', 0);
            $('#opened_spl').attr('data-mod', "2D");
            $('#opened_spl').attr('data-uuid', "");
            $('#opened_spl').attr('data-title', "");
            $("#dragula-right").empty();
            $('#opened_spl').html('No Playlist Selected');
            // $('#id_spl_opened').attr('data-hfr', 0 );
            // $('#id_spl_opened').attr('data-mod', "" );
            // $('#id_spl_opened').attr('data-spl_uuid', 0 );
            // prepareSortablReorder();
        });
        // click open (display spls list
        $(document).on('click', '#open_spl_list', function ()
        {

            $("#spl-list").modal('show');

            get_spl_list_data()

        });
        function get_spl_list_data()
        {
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
                                            +'<td style="font-size: 14px; line-height: 22px; width: 12vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.spl_title+'</td>'
                                            +'<td style="font-size: 14px;">'+value.created_at+'</td>'
                                            +'<td style="font-size: 14px; line-height: 22px; width: 18vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.uuid+'</td>'
                                            +'<td> '
                                                +'<i class="btn btn-primary mdi mdi-tooltip-edit open_spl" data-title="'+value.spl_title+'" data-uuid="'+value.uuid+'"></i> '
                                                +'<i class="btn btn-danger mdi   mdi-delete-forever delete_spl" data-title="'+value.spl_title+'" data-uuid="'+value.uuid+'"></i>'
                                            +'</td>'
                                        +'</tr>'
                        });
                        result = result
                                    +'</tbody>'
                                +'</table>'
                            +'</div>'

                        $('#nocspls_content').html(result)





                    },
                    error: function(response) {

                    }
            })
        }
        $(document).on('click', '#display_spl_properties', function() {
            if ($('#dragula-right').children().length === 0) {
                $("#empty-spl-modal").modal('show');
            }
             else {
         $("#status_edit").html("");
        $("#status_edit").removeClass("badge-danger");
        $("#status_edit").removeClass("badge-success");
        var opened_spl_status = $('#opened_spl').attr("data-opened_spl_status");
        $("#auto_ingest_on_after_edit").html("");
        $("#available_on_after_edit").html("");
        $("#available_on_after_edit_ingest_result").html(" ");
        $("#parent_upload_spl_after_edit").addClass('hide_div');

        if (opened_spl_status == 1) {
            $('#spl_action').val("edit");
            $('#block_save_new_spl').addClass("hide_div");
            $('#block_edit_spl').removeClass("hide_div");

            $('#save_spl_title').html("<i class=\"btn btn-primary mdi mdi-tooltip-edit  \"  ></i> Edit Playlist");
            var id_spl = $('#opened_spl').data("uuid");
            $('#spl_uuid_edit').val(id_spl);
            var title = $('#opened_spl').text();
            var mod = $('#opened_spl').attr("data-mod");
            var hfr = $('#opened_spl').attr("data-hfr");
            if (hfr == 1) {
                $('#spl_properties_hfr').prop('checked', true);
            } else {
                $('#spl_properties_hfr').prop('checked', false);

            }
            $('#uuid_spl_edit').val(id_spl);
            $('#spl_title').val(title);
            $('#display_mode').val(mod);
            $("#spl-properties-modal").modal('show');
        } else {
            $('#block_edit_spl').addClass("hide_div");
            $('#block_save_new_spl').removeClass("hide_div");
            $('#save_spl_title').html(" <i class=\"mdi mdi-library-plus btn btn-primary\"></i>  Save New Playlist Properties");
            $('#spl_action').val("insert");
            $('#spl_uuid_edit').val(0);
            $('#spl_title').val(" ");
            $('#spl_properties_hfr').prop('checked', false);
            $("#spl-properties-modal").modal('show');
        }
            }

        });
        //click btn save new spl
        $(document).on('click', '#save_new_spl', function() {
            let array_spl = [];
            let items_spl = [];
            let items_macro = [];
            let items_marker = [];
            let items_intermission = [];
            var title_spl = $('#spl_title').val();

            if (title_spl == "") {
                $('#spl_title').next().text("SPL Title can't be empty.");
            } else {
                $('#spl_title').next().text(" ");
                var display_mode = $('#display_mode').val();

                var hfr = 0;
                if ($('#spl_properties_hfr').is(":checked")) {
                    hfr = 1;
                }
                $('#dragula-right > .left-side-item').map(function() {
                    items_macro = [];
                    items_marker = [];
                    items_intermission = [];
                    var edit_rate_denominator = $(this).data('editrate_denominator');
                    var edit_rate_numerator = $(this).data('editrate_numerator');
                    var marco_divs = $(this).find('.macro-box');
                    var marker_divs = $(this).find('.marker-box');

                    let intermission_divs = $(this).children('.intermission_list').children(
                        '.intermission_style');
                    marco_divs.map(function() {
                        console.log($(this).data('time'));
                        console.log($(this));
                        items_macro.push({
                            'id': $(this).data('uuid'),
                            'uuid': $(this).data('uuid'),
                            'title': $(this).data('title'),
                            'offset': $(this).data('offset'),
                            'time': $(this).data('time'),
                            'time_frames': convertStringToSeconds($(this).data('time')) *
                                edit_rate_numerator / edit_rate_denominator
                        });
                    });
                    if (items_macro.length == 0) {
                        items_macro = null;
                    }
                    marker_divs.map(function() {
                        items_marker.push({
                            'uuid': $(this).data('uuid'),
                            'title': $(this).data('title'),
                            'offset': $(this).data('offset'),
                            'time': $(this).data('time'),
                            'time_frames': convertStringToSeconds($(this).data('time')) *
                                edit_rate_numerator / edit_rate_denominator

                        });
                    });
                    if (items_marker.length == 0) {
                        items_marker = null;
                    }
                    intermission_divs.map(function() {
                        items_intermission.push({
                            'uuid': $(this).data('uuid'),
                            'title': $(this).data('title'),
                            'offset': $(this).data('offset'),
                            'time': $(this).data('time'),
                            'time_frames': convertStringToSeconds($(this).data('time')) *
                                edit_rate_numerator / edit_rate_denominator
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
                    $('#opened_spl').attr('data-mod', display_mode);
                    var hfr = 0;
                    if ($('#spl_properties_hfr').is(":checked")) {
                        hfr = 1;
                        $('#opened_spl').attr('data-hfr', 1);
                    } else {
                        $('#opened_spl').attr('data-hfr', 0);
                    }
                    $('#opened_spl').text(spl_title);


                    $('#opened_spl').attr('data-title', spl_title);


                    //console.log(items_spl);
                    $.ajax({
                        url:"{{  url('') }}"+ "/createlocalspl",
                        type: 'post',
                        cache: false,
                        data: {
                            array_spl: array_spl,
                            title_spl: spl_title,
                            display_mode: display_mode,

                            hfr: hfr,
                            action_control: action_control,
                            items_spl: items_spl,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            try {
                                console.log(response);
                                var obj = JSON.parse(response);
                         if (obj['status'] == 1) {

                            $("#status_edit").html("SPL List Saved Successfully");
                            $("#status_edit").removeClass("badge-danger");
                            $("#status_edit").addClass("badge-success");
                            $('#opened_spl').text(spl_title);
                            $('#opened_spl').attr('data-title', spl_title);
                            $('#opened_spl').attr('data-opened_spl_status', 1);
                            $('#opened_spl').attr('data-uuid', obj['uuid']);
                        } else {
                            $("#status_edit").html("SPL List wasn't saved  Correctly ");
                            $("#status_edit").removeClass("badge-success");
                            $("#status_edit").addClass("badge-danger");

                            $('#opened_spl').attr('data-title', spl_title);
                            $('#opened_spl').attr('data-opened_spl_status', 0);
                        }

                            } catch (e) {
                                console.log(e);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        complete: function(jqXHR, textStatus) {}
                    });
                }
                array_spl = [];
                window.array_length = 0;
                $("#save_spl_form").trigger('reset');


            }
        });
        $(document).on('click', '#save_as_new_spl', function () {
    let array_spl = [];
    let items_spl = [];
    let items_macro = [];
    let items_marker = [];
    let items_intermission = [];
    var title_spl = $('#spl_title').val();
    var action_type = $('#spl_action').val();
    if (title_spl == "") {
        $('#spl_title').next().text("SPL Title can't be empty.");
    } else {
        $('#spl_title').next().text(" ");
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

            var spl_title = $('#spl_title').val();

            var display_mode = $('#display_mode').val();
            $('#opened_spl').attr('data-mod', display_mode);
            var hfr = 0;
            if ($('#spl_properties_hfr').is(":checked")) {
                hfr = 1;
                $('#opened_spl').attr('data-hfr', 1);
            } else {
                $('#opened_spl').attr('data-hfr', 0);
            }

            //console.log(items_spl);
            $.ajax({

                url:"{{  url('') }}"+ "/createlocalspl",
                type: 'post',
                cache: false,
                data: {
                    array_spl: array_spl,
                    title_spl: spl_title,
                    display_mode: display_mode,
                    action_type: action_type,
                    hfr: hfr,
                    action_control: "save_as_new_spl",
                    items_spl: items_spl,
                     "_token": "{{ csrf_token() }}",


                },
                success: function (response) {
                    try {
                        var obj = JSON.parse(response);
                        if (obj['status'] == 1) {

                            $("#status_edit").html("SPL List Saved Successfully");
                            $("#status_edit").removeClass("badge-danger");
                            $("#status_edit").addClass("badge-success");
                            $('#opened_spl').text(spl_title);
                            $('#opened_spl').attr('data-title', spl_title);
                            $('#opened_spl').attr('data-opened_spl_status', 1);
                            $('#opened_spl').attr('data-uuid', obj['uuid']);
                        } else {
                            $("#status_edit").html("SPL List wasn't saved  Correctly ");
                            $("#status_edit").removeClass("badge-success");
                            $("#status_edit").addClass("badge-success");

                            $('#opened_spl').attr('data-title', spl_title);
                            $('#opened_spl').attr('data-opened_spl_status', 0);
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

$(document).on('click', '#save_edited_spl', function () {
    let array_spl = [];
    let items_spl = [];
    let items_macro = [];
    let items_marker = [];
    let items_intermission = [];
    var title_spl = $('#spl_title').val();
    var action_type = $('#spl_action').val();
    if (title_spl == "") {
        $('#spl_title').next().text("SPL Title can't be empty.");
    } else {
        $('#spl_title').next().text(" ");
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
            var action_control = "edit_existing_spl";
            var spl_title = $('#spl_title').val();
            var spl_uuid_edit = $('#spl_uuid_edit').val();
            var file_name = $('#file_name').val();
            var display_mode = $('#display_mode').val();
            $('#opened_spl').attr('data-mod', display_mode);
            var hfr = 0;
            if ($('#spl_properties_hfr').is(":checked")) {
                hfr = 1;
                $('#opened_spl').attr('data-hfr', 1);
            } else {
                $('#opened_spl').attr('data-hfr', 0);
            }
            $('#opened_spl').text(spl_title);


            $('#opened_spl').attr('data-title', spl_title);


            //console.log(items_spl);
            $.ajax({


                type: 'post',
                cache: false,


                url:"{{  url('') }}"+ "/createlocalspl",
                type: 'post',
                cache: false,
                data: {
                    array_spl: array_spl,
                    title_spl: spl_title,
                    spl_uuid_edit: spl_uuid_edit,
                    display_mode: display_mode,
                    action_type: action_type,
                    hfr: hfr,
                    action_control: action_control,
                    items_spl: items_spl,
                     "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    try {
                        console.log(response);
                        var obj = JSON.parse(response);
                        // $('#actual_spl_title').text(title_spl);
                        // $('#id_spl_opened').text(obj['uuid']);
                        $('#opened_spl').attr('data-uuid', obj.uuid);
                        if (obj.status == "1") {
                            $("#status_edit").html("SPL List Edited Successfully");
                            $("#status_edit").removeClass("badge-danger");
                            $("#status_edit").addClass("badge-success");
                            $("#available_on_after_edit").html(" ");
                            $("#auto_ingest_on_after_edit").html("");
                            if (obj.auto_ingest == "0") {
                                var list_available_in = obj.available_in;
                                var available_on = "";

                                $("#auto_ingest_on_after_edit").html(
                                    '<div class="col-md-12 style-modal-edit"  >PlayListBuilder Auto Ingest Offline'+'</div>'+
                                    '<div class="col-md-12 style-modal-edit">SPL Title : <span data-uuid="'+obj.uuid+'">'+obj.title+'</span> </div>'+
                                    '<div class="col-md-12">  Available in the below screens : </div>'
                                     );
                                for (var i = 0; i < list_available_in.length; i++) {
                                    available_on+=
                                        '<div class="row style-modal-edit item-available_in" data-id="'+list_available_in[i].id_server+'">' +
                                          '<div class="col-md-4">'+list_available_in[i].server_name+'</div>' +
                                           (list_available_in[i].session_id !== null ? "<div class='col-md-4' style='color:green'>Screen Online</div>"
                                              :"<div  class='col-md-4'  style='color:red'>Screen Offline</div>"
                                          ) +
                                        '</div>';
                                }
                                $("#available_on_after_edit").html(available_on);
                                $("#parent_upload_spl_after_edit").removeClass('hide_div');
                                $("#block_edit_spl").addClass('hide_div');

                            }
                        } else {
                            $("#status_edit").html("SPL List wasn't Updated Correctly ");
                            $("#status_edit").removeClass("badge-success");
                            $("#status_edit").addClass("badge-success");
                        }


                        array_spl = [];
                        array_length = 0;
                        window.array_length = 0;


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



        $(document).on('input', '#spl_title', function() {
            checkAvailability();
        });
        $(document).on('input', '#edit_spl_title', function() {
            checkAvailabilityEditForm();
        });
        $(document).ready(function() {
            $(document).on('click', '#edit_spl_properties', function() {

                var opened_spl_status = $('#opened_spl').attr("data-opened_spl_status");
                if (opened_spl_status == 1) {
                    var id_spl = $('#opened_spl').data("uuid");
                    var title = $('#opened_spl').text();
                    var mod = $('#opened_spl').attr("data-mod");
                    var hfr = $('#opened_spl').attr("data-hfr");
                    if (hfr == 1) {
                        $('#edit_hfr_spl').prop('checked', true);
                    } else {
                        if (hfr == 1) {
                            $('#edit_hfr_spl').prop('checked', false);
                        }
                    }
                    $('#uuid_spl_edit').val(id_spl);
                    $('#edit_spl_title').val(title);
                    $('#edit_display_mode').val(mod);
                    $("#edit-spl-properties-modal").modal('show');
                } else {
                    $("#no-spl-selected").modal('show');
                }

            });
        });


        $(document).on('click', '.open_spl', function() {
            var action_control = "open_spl";

            $('#opened_spl').attr('data-opened_spl_status', 1);
            var id_spl = $(this).data("uuid");
            var title = $(this).data("title");
            openSpl(id_spl);
            $('#opened_spl').html(title);
            $('#opened_spl').attr('data-opened_spl_status', 1);
            $("#spl-list").modal("hide");


        });
        // remove cpl right list
        $(document).on('click', '.remove-cpl', function() {

            $(this).parent().parent().parent().parent().parent().remove();
            // re-order items
            var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                            macroStartTime = convertHMSToSeconds(composition_start_time) + convertHMSToSeconds(
                                macroTime);
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


        $(document).ready(function() {
            $(document).on('click', '.delete_spl', function() {
                var spl_uuid = $(this).data('uuid');
                var title = $(this).data('title');

                $("#spl_title_to_delete").html(title);
                $("#spl_uuid_to_delete").html(spl_uuid);
                $("#id_spl_delete").val(spl_uuid);
                $("#delete-spl").modal('show');

                //  deleteSplSelected(spl_uuid);
            });
        });
        $(document).ready(function() {
            $(document).on('click', '#confirm_delete_spl', function() {
                var spl_uuid = $("#id_spl_delete").val();
                deleteSplSelected(spl_uuid);
                $("#delete-spl").modal("hide");
                get_spl_list_data()
            });
        });


        // ************** select items right side list
        $('#dragula-right').on('click', '.left-side-item', function() {
            // Remove 'selected' class from all items
            $('.left-side-item').removeClass('selected-item');
            $('.mb-0.text-muted.float-left').removeClass("color-white");

            // Add 'selected' class to the clicked item
            $(this).toggleClass('selected-item');
            $(this).find('.mb-0.text-muted.float-left').addClass("color-white");

        });

        // *********************** functions
        function displayStorageContent(target_devices) {
            $.ajax({
                url: 'system/controller_playlist_builder.php',
                type: 'post',
                data: {
                    action_control: target_devices
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
                    swal.close();
                    try {
                        $("#wait").modal("hide");
                        var box = "";
                        var box_kind = "";

                        var obj = JSON.parse(response);

                        let cpls = obj.cpl_content;
                        let spls = obj.spl_content;
                        let macros = obj.macros;

                        // prepare menu sort by ContentKind
                        let option_kind = ' <option value="all" selected="selected">All Elements</option>' +
                            '<option value="Pattern" >Pattern</option>';
                        var kinds = [...new Set(cpls.map(item => item.ContentKind))];
                        $.each(kinds, function(indexes, values) {
                            option_kind += ' <option value="' + values + '" >' + values + '</option>';
                        });
                        option_kind += ' ' +
                            ' <option value="SPL"> Show Playlist</option> ' +
                            '<option value="Macros"> Macros</option>';
                        $('#filter_type').html(option_kind);
                        $("#filter_type option:first").attr('selected', 'selected');

                        // cpls list
                        for (var i = 0; i < cpls.length; i++) {

                            if (cpls[i].ContentKind.localeCompare(box_kind) == 0) {
                                box_kind = cpls[i].ContentKind;
                            } else {
                                box_kind = cpls[i].ContentKind;
                                box += '<div class=" filtered  div_list title-kind  "   ' +
                                    '        data-type="' + cpls[i].ContentKind + '">' + cpls[i].ContentKind +
                                    '  </div>';
                            }
                            if (cpls[i].ContentKind.match(/^(SPL|Automation|Trigger|Cues|Pattern)$/)) {

                            }
                            box +=
                                '   <div class="card rounded border mb-2 left-side-item"' +
                                '       data-side="left"   ' +
                                '       data-auditorium="' + cpls[i].id_auditorium + '" ' +
                                '       data-uuid="' + cpls[i].cpl_uuid + '"' +
                                '       data-title="' + cpls[i].ContentTitleText + '"' +
                                '       data-time="' + cpls[i].Duration + '"  ' +
                                '       data-time_seconds="' + cpls[i].Duration_seconds + '"  ' +
                                '       data-time_Duration_frames="' + cpls[i].Duration_frames + '"  ' +
                                '       data-type_component="cpl"' +
                                '       data-id="' + cpls[i].id_dcp + '"' +
                                '       data-version="left_tab"' +
                                '       data-type="' + cpls[i].ContentKind + '"' +
                                '       data-editRate_denominator="' + cpls[i].editRate_denominator + '"' +
                                '       data-editRate_numerator="' + cpls[i].editRate_numerator + '"' +
                                '       data-id_server="' + cpls[i].id_server + '"' +
                                '       data-source="' + cpls[i].source + '"' +
                                '       data-need_kdm="' + ((cpls[i].pictureEncryptionAlgorithm == "None" ||
                                    cpls[i].pictureEncryptionAlgorithm == 0) ? 0 : 1) + '"' +
                                '> ' +
                                '       <div class="card-body  "  >\n' +

                                '                 <div class="media-body  ">\n' +
                                '                      <h6 class="mb-1"  style="font-size: 17px;color:' +
                                (cpls[i].type_ScreenAspectRatio.type === "Flat" ? "#52d4f7" :
                                    (cpls[i].type_ScreenAspectRatio.type === "Scope" ? "#00d25b" : "white")) +
                                '">' + cpls[i].ContentTitleText +
                                ((cpls[i].pictureEncryptionAlgorithm == "None" || cpls[i]
                                        .pictureEncryptionAlgorithm == 0) ? " " :
                                    "<i class=\"mdi mdi-lock-outline  cpl_need_kdm\" aria-hidden=\"true\"></i>"
                                    ) +
                                '</h6>\n' +
                                '                  </div>\n' +
                                '                  <div class="media-body">\n' +
                                '                       <p class="mb-0 text-muted float-left">' +
                                formatDurationToHMS(cpls[i].Duration_seconds) +
                                ' <span class="detail-cpl">  Subtitle, VI, HI, DBox </span>   </p>\n' +
                                '                       <p class="mb-0 text-muted float-right">\n' +
                                '                          <span class="icon-prop-cpl">' +
                                (cpls[i].is_3D == 1 ? '3D' : '2D') +
                                '                          </span>\n' +
                                '                          <span class="flat">  ' +
                                (cpls[i].type_ScreenAspectRatio.aspect_Ratio == "unknown" ? cpls[i]
                                    .type_ScreenAspectRatio.type :
                                    cpls[i].type_ScreenAspectRatio.aspect_Ratio + ' ' + cpls[i]
                                    .type_ScreenAspectRatio.cinema_DCP) +
                                '                           </span>\n' +
                                '                          <span class="flat">' + cpls[i].soundChannelCount +
                                ' </span>\n' +
                                '                          <span class="flat"> ST  </span>\n' +
                                '                          <span class="cpl-details"  ' +
                                '                                data-uuid="' + cpls[i].cpl_uuid + '"' +
                                '                                data-need_kdm="' + ((cpls[i]
                                    .pictureEncryptionAlgorithm == "None" || cpls[i]
                                    .pictureEncryptionAlgorithm == 0) ? 0 : 1) + '"' +
                                '                            > <i class="btn btn-primary  custom-search mdi mdi-magnify"> </i></span>\n' +
                                '                       </p>\n' +
                                '                    </div> ' +
                                '              </div>\n' +
                                '              <div class="card-body macro-list hide_div"></div> ' +
                                '              <div class="card-body marker-list hide_div"></div>' +

                                '   </div>';
                        }
                        // append pattern
                        box +=
                            '<div class=" filtered  div_list   title-kind  " data-type="Pattern"> Pattern   </div>';
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
                        box +=
                            '<div class=" filtered  div_list title_kind title-kind" data-type="Macros"> Macros  </div>';
                        for (var i = 0; i < macros.length; i++) {
                            box +=
                                '<div  style="padding:5px" class="macro_item   div_list card rounded border mb-2 left-side-item" ' +
                                '       data-command="' + macros[i].command + '" data-title="' + macros[i]
                                .title + '" data-id="' + macros[i].idmacro_config + '" data-type="Macros">' +
                                '       <div class="card-body p-3">\n' +
                                '                 <div class="media-body float-left">\n' +
                                '                    <div class="title-content col-md-12"> <i class="btn btn-inverse-primary  mdi mdi-server-network"></i> ' +
                                macros[i].title + ' </div>' +
                                '                       <i class="fa fa-arrow-circle-right icon_drag_to_left" aria-hidden="true"></i>' +
                                '                 </div>' +
                                '        </div>' +
                                '</div>';
                        }

                        $('#dragula-left').html(box);

                        var t = $(window).height();
                        $("#dragula-left").css("height", t - 135);
                        $("#dragula-left").css("max-height", t - 135);
                        $("#dragula-left").css("overflow-y", 'auto');
                        $("#dragula-right").css("height", t - 135);
                        $("#dragula-right").css("max-height", t - 135);
                        $("#dragula-right").css("overflow-y", 'auto');

                        $("#content-div").css("height", t - 120);
                        $("#content-div").css("max-height", t - 120);
                        $("#content-div").css("overflow-y", 'auto');

                    } catch (e) {
                        console.log(e);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.close();
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {
                    swal.close();
                }
            });
        }

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
            return (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (secs < 10 ?
                "0" + secs : secs);
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

                success: function(response) {

                    var obj = JSON.parse(response);
                    var detail_cpl = obj.details_cpl;
                    if (detail_cpl == false) {

                    }

                    var details_spl_contains_cpl = obj.details_spl_contains_cpl;
                    $('#date_create_ingest_details').html("Creation Date :" + detail_cpl.date_create_ingest);
                    $('#details_title').html(detail_cpl.contentTitleText);
                    $('#details_uuid').html(detail_cpl.uuid);
                    $('#details_kind').html(detail_cpl.contentKind);
                    let duration_Seconds = detail_cpl.durationEdits * detail_cpl.editRate_denominator /
                        detail_cpl.editRate_numerator;

                    duration_Seconds = convertSecondsToHMS(Math.round(duration_Seconds));
                    $('#details_duration').html(duration_Seconds);
                    $('#details_edit_rate').html(detail_cpl.editRate_numerator + " " + detail_cpl
                        .editRate_denominator);
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
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });
        }

        // open selected spl

        function reorderMacroList(macroList) {


            // Get all the media-body elements within the container
            var macroBoxes = Array.from(macroList.querySelectorAll('.media-body.macro-box'));

            // Sort the media-body elements based on the text content of the target element
            macroBoxes.sort(function(a, b) {
                var timeA = a.querySelector('.mb-0.text-muted.float-left').innerText;
                var timeB = b.querySelector('.mb-0.text-muted.float-left').innerText;
                // Assuming the time format is HH:mm:ss, you may need to modify the comparison logic accordingly
                return timeA.localeCompare(timeB);
            });

            // Clear the existing content in the container
            macroList.innerHTML = '';

            // Append the sorted media-body elements back to the container
            macroBoxes.forEach(function(box) {
                macroList.appendChild(box);
            });
        }

        function extractEditRateValues(editRate) {
            var editRateArray = editRate.split(" ");
            var editRate_numerator = editRateArray[0];
            var editRate_denominator = editRateArray[1];

            return [editRate_numerator, editRate_denominator];
        }

        function reorderRightList() {
            var items = $('#dragula-right').find('.left-side-item:not([data-type="segment"])');
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
                        macroItems[j].querySelector('.mb-0.text-muted.float-left').innerText = convertSecondsToHMS(
                            macroStartTime);
                    }
                }

                var macroList = items[i].querySelector('.card-body.macro-list');
                reorderMacroList(macroList);
            }
        }

        function setSplOpenedData(capabilities) {
            const obj = {
                "capabilities": capabilities
            };
            $('#opened_spl').attr('data-hfr', 0);

            $('#opened_spl').attr('data-mod', "2D");
            if (typeof obj.capabilities === 'object' && obj.capabilities.hasOwnProperty('capability1') && obj.capabilities
                .capability1 === null) {
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

                        }
                    }
                }
            }
        }


        function openSpl(id_spl) {
            $.ajax({
                url : "{{  url('') }}"+   "/open_nocspl",
                type: 'get',
                data: {
                    action_control: "open_spl",
                    id_spl: id_spl,
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

                               // var events = pack.EventList.Event;
                              var events = Array.isArray(pack.EventList.Event) ? pack.EventList.Event : [pack.EventList.Event];

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
                                    }
                                    else if (mainElement.hasOwnProperty('Pattern')) {
                                        var Pattern = mainElement.Pattern;
                                        var IntrinsicDuration = Pattern.Duration;
                                        var EditRate = extractEditRateValues(Pattern.EditRate);
                                        var editRate_numerator = EditRate[0];
                                        var editRate_denominator = EditRate[1];
                                          var duration_seconds = Pattern.Duration * editRate_denominator / editRate_numerator;
                                var hms_time = convertSecondsToHMS(duration_seconds);
                                var components_time = secondsToMinutesAndSeconds(duration_seconds);

                                        box +=
                                                '<div class="card rounded border mb-2 left-side-item "' +
                                    '      data-side="left" data-type="Pattern" ' +
                                    '      data-id="' + eventId + '"' +
                                    '      data-uuid="' + Pattern.Id + '" ' +
                                    '      data-title="' + Pattern.AnnotationText + '"' +
                                    '      data-editrate_denominator="' + editRate_denominator + '" data-editrate_numerator="' + editRate_numerator + '"' +
                                    '        data-minutes="' + components_time.minutes + '"' +
                                    '        data-seconds="' + components_time.seconds + '"' +
                                    '      data-version="new_item" ' +
                                    '      data-time_seconds="' + duration_seconds + '"' +
                                    '      data-time="' + hms_time + '"' +
                                    '      data-starttime="00:00:00">     ' +
                                    '    <div class="card-body  ">\n' +
                                    '       <div class="media-body  ">\n' +
                                    '          <h6 class="mb-1" style=" font-size: 18px">' + Pattern.AnnotationText + '</h6>\n' +
                                    '       </div>\n' +
                                    '       <div class="media-body">\n' +
                                    '         <p class="mb-0 text-muted float-left color-white">00:00:00</p>\n' +
                                    '         <p class="mb-0 text-muted float-right">\n' +
                                    '            <span class=" ">\n' +
                                    '              <i class="btn btn-primary  mdi mdi-magnify custom-search  pattern-details"' + Pattern.Id + '"></i>\n' +
                                    '              <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>\n' +
                                    '            </span>       ' +
                                    '           </p>\n' +
                                    '       </div>\n' +
                                    '   </div>\n' +
                                    '    <div class="card-body macro-list  ' + list_macro_style + ' ">' + macro_box + '</div> ' +
                                    '    <div class="card-body marker-list   ' + list_marker_style + '">' + marker_box + '</div>' +
                                    '</div>';
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
                           reorderRightList();

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


        function deleteSplSelected(spl_uuid) {

            $.ajax({
                url : "{{  url('') }}"+   "/delete_nocspl",
                type: 'get',
                cache: false,
                data: {
                    spl_uuid: spl_uuid,
                    action_control: "delete_spl_selected",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
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
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function(jqXHR, textStatus) {}
            });
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

        function secondsToMinutesAndSeconds(totalSeconds) {


            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;

            return {
                minutes,
                seconds
            };
        }

        function checkAvailability() {
            var spl_title_state = false;
            var spl_title = $('#spl_title').val().trim();
            if (spl_title == '') {
                $('#spl_title').next().removeClass("form_success");
                $('#spl_title').next().addClass("form_error");
                $('#spl_title').next().text('Title cant be empty');
                $('#save_new_spl').prop('disabled', true);
            } else {
                $.ajax({

                    url:"{{  url('') }}"+ "/checkAvailability",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'spl_title': spl_title
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 'taken') {
                            spl_title_state = false;
                            $('#spl_title').next().removeClass("form_success");
                            $('#spl_title').next().addClass("form_error");
                            $('#spl_title').next().html('Title Already Taken')
                            $('#save_new_spl').prop('disabled', true);
                        } else if (response == 'not_taken') {
                            spl_title_state = true;
                            $('#spl_title').next().removeClass("form_error");
                            $('#spl_title').next().addClass("form_success");
                            $('#spl_title').next().html("Title  Available");

                            $('#save_new_spl').prop('disabled', false);

                        }
                    }
                });
            }
        }

        function checkAvailabilityEditForm() {
            var spl_title_state = false;
            var spl_title = $('#edit_spl_title').val().trim();
            if (spl_title == '') {
                $('#edit_spl_title').next().removeClass("form_success");
                $('#edit_spl_title').next().addClass("form_error");
                $('#edit_spl_title').next().text('Title cant be empty');

                $('#confirm_edit_spl_properties').prop('disabled', true);
            } else {
                $.ajax({
                    url: 'system/controller_playlist_builder.php',
                    type: 'post',
                    data: {
                        'action_control': 'check_spl_file_name',
                        'spl_title': spl_title
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 'taken') {
                            spl_title_state = false;
                            $('#edit_spl_title').next().removeClass("form_success");
                            $('#edit_spl_title').next().addClass("form_error");
                            $('#edit_spl_title').next().html('File Name Already Taken')
                            $('#confirm_edit_spl_properties').prop('disabled', true);
                        } else if (response == 'not_taken') {
                            spl_title_state = true;
                            $('#edit_spl_title').next().removeClass("form_error");
                            $('#edit_spl_title').next().addClass("form_success");
                            $('#edit_spl_title').next().html("Title  available");

                            $('#confirm_edit_spl_properties').prop('disabled', false);

                        }
                    }
                });
            }
        }


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
    </script>

    <script>
        $(document).on('click', '.infos_modal , .cpl-details', function () {
                $("#infos_modal").modal('show');
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

            if(true)
                {
                    var url = "{{  url('') }}"+   "/get_lmscpl_infos/"+cpl_id;
                    $('#kdms-tab').hide();
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


            if( true )
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
                                            +'<th>'+value.uuid_spl+'</th>'
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


        $(document).on('click', '#submit-ingest-form', function ()
            {
                var spl_id = $('#nos-spl').val() ;
                var location =  $('#ingest-location').val();
                var url = "{{  url('') }}"+   "/sendXmlFileToApi";

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
    </script>

@endsection

@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/dragula/dragula.min.css') }}">
    <style>
        /* ** custom ****/
        #dragula-left,
        #dragula-right {
            border: 1px solid #2c2e33;
        }

        .select2.select2-container.select2-container--default {
            width: 80% !important;
            background: #2a3038;
        }

        .select2-container--default .select2-selection--multiple {
            border: none;
            background: #2a3038;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1) {
            font-size: 14px;
            background: #2a3038;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #297eee;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 5px;
            padding-left: 21px;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
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
          font-size: 18px;
        }
        .label-status{
            text-align: center;
            color: #ff313a;
            font-size: 18px;
        }
        .table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
            vertical-align: middle;
            line-height: 1;
            white-space: nowrap;
            padding: 0.9375rem;
            font-size: 18px;
            color: white;
        }

        </style>
@endsection
