@extends('layouts.app')
@section('title')
Planner
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Upload </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Planner </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link  active " id="plan-tab" data-bs-toggle="tab" href="#plan" role="tab" aria-controls="home" aria-selected="true">Plan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " id="features-tab" data-bs-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="false"> Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="spl-tab" data-bs-toggle="tab" href="#spl" role="tab" aria-controls="profile" aria-selected="false"> Generated SPLs</a>
                  </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active " id="plan" role="tabpanel" aria-labelledby="home-tab">
                    <button type="button " id="create_new_plan_btn" class=" btn btn-primary  btn-icon-text m-3 "><i class="mdi mdi-check "></i> Create New Plan </button>
                    <div class="preview-list multiplex  ">
                        <div class="table-responsive ">
                            <table id="planner-listing" class="table ">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc">No </th>
                                        <th class="sorting">Campaingn Name</th>
                                        <th class="sorting">Publish ID </th>
                                        <th class="sorting">CPL </th>
                                        <th class="sorting">Data Start</th>
                                        <th class="sorting">Date End </th>
                                        <th class="sorting">Target Location </th>
                                        <th class="sorting">Target Screen Type </th>
                                        <th class="sorting">Template </th>
                                        <th class="sorting">Marker</th>
                                        <th class="sorting">Priority</th>
                                        <th class="sorting">Target Feature</th>
                                        <th class="sorting">Film </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                </div>
                <div class="tab-pane fade" id="spl" role="tabpanel" aria-labelledby="spl-tab">
                    <div class="preview-list multiplex  ">
                        <div class="table-responsive ">
                            <table id="spl-listing" class="table ">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Creation Date</th>
                                        <th>UUID </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>

    <div class=" modal fade " id="Create_new_plan" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Create New Plan </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">

                    <form method="POST" action="" id="create_planner" class="needs-validation m-2" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  has-validation">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" id="name"  name="name"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model"> Target Location </label>
                                    <select class="form-control" id="location" name="location_id" required >
                                        <option value="" Selected>Select Location </option>
                                        @foreach ($locations as $location )
                                            <option value="{{ $location->id }}">{{ $location->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="screen-model"> CPL </label>
                                    <select class="form-control" id="cpl_uuid" name="cpl_uuid"  required>
                                        <option value="">Select Location  </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date Range Start </label>
                                    <div id="datepicker-popup" class="input-group date datepicker">
                                        <input type="date" class="form-control" name="date_start"  id="date_start" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date Range End </label>
                                    <div id="datepicker-popup" class="input-group date datepicker">
                                        <input type="date" class="form-control"  name="date_end"  id="date_end" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model"> Target Screen Type  </label>
                                    <select class="form-control" id="screen_type" name="screen_type" required>
                                        <option value="IMAP">IMAP </option>
                                        <option value="POP">POP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model"> Target Movie  </label>
                                    <select class="form-control" id="movie" name="movies_id" required>
                                        <option value="">Select Location </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model"> Template Selection   </label>
                                    <select class="form-control" id="template" name="template" required>
                                        <option value=""> Select Template</option>
                                        @foreach ($templates as $template)
                                            <option value="{{ $template->uuid }}">{{ $template->spl_title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model"> Template Position   </label>
                                    <select class="form-control" id="template_position" name="template_position" required>
                                        <option value="1">1 </option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11 </option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model">  Position   </label>
                                    <select class="form-control" id="position" name="position" required>
                                        <option value="1">1 </option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11 </option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model">  Marker   </label>
                                    <select class="form-control" id="marker" name="marker" required>
                                        <option value="" selected="selected">Select Marker</option>
                                        <option value="PATTERN">Pattern</option>
                                        <option value="ADVERTISEMENT">ADVERTISEMENT</option>
                                        <option value="FEATURE">FEATURE</option>
                                        <option value="POLICY">POLICY</option>
                                        <option value="PSA">PSA</option>
                                        <option value="SHORT">SHORT</option>
                                        <option value="TEASER">TEASER</option>
                                        <option value="TEST">TEST</option>
                                        <option value="TRAILER">TRAILER</option>
                                        <option value="SPL"> Show Playlist</option>
                                        <option value="MACROS"> Macros</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model">  Priority   </label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value=""> Priority</option>
                                        <option value="1">1 </option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="screen-model">  Target Feature   </label>
                                    <select class="form-control" id="feature" name="feature" required>
                                        <option value="All">All </option>
                                        <option value="Kingdom Of Apes">Kingdom Of Apes</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <button type="button " id="" class=" btn btn-primary  btn-icon-text " style="margin: 15px auto 0px auto; display: table;">
                                <i class="mdi mdi-check "></i> Save </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>


@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
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

        function get_plans()
        {
            $("#planner-listing").dataTable().fnDestroy();
            $('#planner-listing tbody').html('')
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#planner-listing tbody').html(loader_content)

                result =" " ;
                var url = "{{  url('') }}"+ '/get_plans';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data :{

                    },
                    success:function(response)
                    {
                        console.log(response)
                        $.each(response.plans, function( index, value ) {

                            correct_index = index + 1 ;
                            result = result
                                +'<tr class="odd ">'

                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+correct_index+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.name+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.id+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.cpl_uuid+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_start+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.date_end+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.location_name+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.screen_type+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.template_position+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.marker +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.priority +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.feature +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.movie_title+'</a></td>'
                                +'</tr>';
                        });


                        $('#planner-listing tbody').html(result)
                        /***** refresh datatable ***** */

                        var spl_datatable = $('#planner-listing').DataTable({

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
        get_plans();

       // Example starter JavaScript for disabling form submissions if there are invalid fields
       (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms =$( "#create_planner" )

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {

                    if (!form.checkValidity()) {

                    event.preventDefault()
                    event.stopPropagation()
                    }
                    else
                    {


                        event.preventDefault()

                        var name = $('#name').val();
                        var location_id = $('#location_id').val();
                        var cpl_uuid = $('#cpl_uuid').val();
                        var date_start = $('#date_start').val();
                        var date_end = $('#date_end').val();
                        var screen_type = $('#screen_type').val();
                        var movies_id = $('#movies_id').val();
                        var template = $('#template').val();
                        var template_position = $('#template_position').val();
                        var position = $('#position').val();
                        var marker = $('#marker').val();
                        var priority = $('#priority').val();
                        var feature = $('#feature').val();


                        $.ajax({
                            url: "{{  url('') }}"+ '/planner/store' ,
                            method: 'POST',
                            data :{
                                name:name,
                                location_id:location_id,
                                cpl_uuid:cpl_uuid,
                                date_start:date_start,
                                date_end:date_end,
                                screen_type:screen_type,
                                movies_id:movies_id,
                                template:template,
                                template_position:template_position,
                                position:position,
                                marker:marker,
                                priority:priority,
                                position:position,
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(response)
                            {
                                if(response="success")
                                {

                                    swal({
                                            title: 'Done!',
                                            text: 'Plan Created Successfully ',
                                            icon: 'success',
                                            button: {
                                                text: "Continue",
                                                value: true,
                                                visible: true,
                                                className: "btn btn-primary"
                                            }
                                        })
                                        get_plans()
                                        $('#Create_new_plan').modal('hide');
                                        $('#create_planner').trigger("reset");
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
                            error: function(response) {

                            }
                        })

                    }

                    form.classList.add('was-validated')
                }, false)
                })

        })(jQuery);


        $('#location').change(function() {
            var location = $('#location').val();


            var url = "{{ url('') }}" + '/get_palnner_form_data';
            var result = "";

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    location: location,
                },
                success: function(response) {

                    console.log(response.cpls)
                    console.log(response.movies)
                    result = '<option value=""> CPLs </option>';
                    $.each(response.cpls, function(index, value) {
                        result = result +
                        '<option value="'+value.uuid+'"> '+value.contentTitleText+' </option>'

                    });
                    $('#cpl_uuid').html(result)

                    result = '<option value=""> Movies </option>';
                    $.each(response.movies, function(index, value) {
                        result = result +
                        '<option value="'+value.id+'"> '+value.title+' </option>'

                    });
                    $('#movie').html(result)


                },
                error: function(response) {

                }
            })


        });

        $(document).on('click', '#create_new_plan_btn', function () {

            $('#Create_new_plan').modal('show');
        });




        function get_templates(id_location)
        {
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#spl-listing tbody').html(loader_content)

            var url = "{{  url('') }}"+   "/get_templates/";

            var result="";
            $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response)
                    {
                        $.each(response.templates, function( index, value ) {

                            result = result
                                +'<tr id="'+value.uuid+'">'
                                    +'<td style="font-size: 14px; line-height: 22px; width: 12vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.spl_title+'</td>'
                                    +'<td style="font-size: 14px;">'+value.created_at+'</td>'
                                    +'<td style="font-size: 14px; line-height: 22px; width: 18vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.uuid+'</td>'
                                +'</tr>'
                        });

                        $('#spl-listing tbody').html(result)

                    },
                    error: function(response) {

                    }
            })
        }
        $(document).on('click', '#spl-tab', function () {
            get_templates();
        });


    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
    <style>

    </style>
@endsection
