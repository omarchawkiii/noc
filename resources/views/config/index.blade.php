@extends('layouts.app')
@section('title') Composition Playlist  @endsection
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

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="LocationSettings-tab" data-bs-toggle="tab" href="#LocationSettings" role="tab" aria-controls="LocationSettings" aria-selected="true">PlayList Builder Settings</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- tab Logest -->
        <div class="tab-pane fade show active" id="LocationSettings" role="tabpanel" aria-labelledby="home-tab">
            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="d-flex flex-row justify-content-between mt-2">
                                <div>
                                    <h4 class="card-title ">PlayList Builder Settings</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list multiplex">
                                        <div class="row">
                                            <div class="col-md-12 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-4">
                                                                <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" id="#schedule-settings-tab" data-bs-toggle="tab" href="#schedule-settings" role="tab" aria-controls="profile" aria-selected="false">

                                                                            <span class="mdi mdi-calendar-today  ms-2" style="color: #00a5ff!important"></span>
                                                                            Schedule Settings
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link " id="home-tab" data-bs-toggle="tab" href="#home-2" role="tab" aria-controls="home" aria-selected="false"> <i class="mdi mdi-playlist-plus text-info ms-2" style="color:#F24EB1!important"></i>
                                                                            Playlist Builder Settings
                                                                        </a>
                                                                    </li>


                                                                </ul>
                                                            </div>
                                                            <div class="col-12 col-sm-8">
                                                                <div class="tab-content tab-content-vertical">
                                                                    <div class="tab-pane fade active show" id="schedule-settings" role="tabpanel" aria-labelledby="schedule-settings-tab">
                                                                        <h4 class="card-title"> Schedule Settings </h4>
                                                                        <div class="row">
                                                                            <div class="col-xl-4 ">
                                                                                <div class="form-group">

                                                                                    <label>Time Start : </label>
                                                                                    <div class="input-group date"  data-target-input="nearest">
                                                                                        <div class="input-group" data-bs-target="#timepicker-example" data-toggle="datetimepicker">
                                                                                            <input type="time"id="timeStart"  class="form-control form-control-sm datetimepicker-input" data-bs-target="#timepicker-example" name="timeStart" value="{{ $config->timeStart}}">
                                                                                            <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="label-status"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-xl-4 ">
                                                                                <div class="form-group">
                                                                                    <label>Day Start :</label>
                                                                                    <select type="text" class="form-control" id="dayStart" name="dayStart"  value="{{ $config->dayStart}}">
                                                                                        <option @if($config->dayStart =="Monday") selected @endif value="Monday">
                                                                                            Monday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Tuesday") selected @endif value="Tuesday">
                                                                                            Tuesday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Wednesday") selected @endif  value="Wednesday">
                                                                                            Wednesday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Thursday") selected @endif  value="Thursday">
                                                                                            Thursday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Friday") selected @endif  value="Friday">
                                                                                            Friday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Saturday") selected @endif  value="Saturday">
                                                                                            Saturday
                                                                                        </option>
                                                                                        <option @if($config->dayStart =="Sunday") selected @endif  value="Sunday">
                                                                                            Sunday
                                                                                        </option>
                                                                                    </select>
                                                                                    <div class="label-status"></div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-primary btn-fw col-md-2" id="edit_schedule_settings" style="margin: auto">
                                                                                <h4>Save</h4>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade " id="home-2" role="tabpanel" aria-labelledby="home-tab">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 ">
                                                                                <div class="col-md-12">
                                                                                    <h4 class="card-title">   Auto Ingest SPls   After  Editing </h4>
                                                                                    <div class="form-group row" style="margin-left: 10px;">
                                                                                        <div class="form-check col-md-6">
                                                                                            <label class="form-check-label">
                                                                                                <input type="radio" class="form-check-input" name="spl_auto_ingest" id="auto_ingest_enabled" value="1" @if($config->autoIngest)  checked @endif>
                                                                                                Enabled
                                                                                                <i class="input-helper"></i><i class="input-helper"></i></label>
                                                                                        </div>
                                                                                        <div class="form-check col-md-6">
                                                                                            <label class="form-check-label">
                                                                                                <input type="radio" class="form-check-input" name="spl_auto_ingest" id="auto_ingest_disabled" value="0" @if(!$config->autoIngest)  checked @endif>
                                                                                                Disabled
                                                                                                <i class="input-helper"></i><i class="input-helper"></i></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-primary btn-fw col-md-2" id="edit_spl_auto_ingest_settings" style="margin: auto">
                                                                                <h4>Save</h4>
                                                                            </button>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- end tab Logest -->




    </div>



@endsection

@section('custom_script')
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>

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

    // filter location
    (function($) {

        $(document).on("click","#edit_schedule_settings" , function(event) {

            event.preventDefault();
            var timeStart = $('#timeStart').val();
            var timeEnd = $('#timeStart').val();
            var dayStart = $('#dayStart').val();

            var url = '{{ url('') }}' + '/settings/update';
            console.log(timeStart) ;
            console.log(timeEnd) ;
            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    timeStart: timeStart,
                    timeEnd: timeEnd,
                    dayStart: dayStart,
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response)
                   if(response)
                    {
                        swal({
                            title: 'Done!',
                            text: 'Settings Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })

        $(document).on("click","#edit_spl_auto_ingest_settings" , function(event) {

            var spl_auto_ingest = $("input[name='spl_auto_ingest']:checked").val();
            console.log(spl_auto_ingest)
            event.preventDefault();
            var url = '{{ url('') }}' + '/settings/update_auto_ingest';

            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    spl_auto_ingest: spl_auto_ingest,
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response)
                    if(response)
                    {
                        swal({
                            title: 'Done!',
                            text: 'Settings Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                    }



                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


            })
    })(jQuery);


</script>

@endsection

@section('custom_css')


<style>
    #edit_HardDrive_settings, #edit_location_settings {
        margin: auto;
    }

    .selected_library {
        background: #15315c !important;
        font-weight: bold;
    }

    .form-group input {
        font-size: 16px;
        font-weight: bold;
        color: white;
    }

    .form-group select {
        font-size: 16px;
        font-weight: bold;
        color: white;
    }


    .label-status {
        text-align: center;
        color: #ff313a;
        font-size: 18px;
    }
    .tab-content.tab-content-vertical
    {
        border-top: 1px solid #2c2e33;
    }
    .tab-content {
    border: 1px solid #2c2e33;
    border-top: 0;
    padding: 2rem 1rem;
    text-align: justify;
}

</style>
@endsection
