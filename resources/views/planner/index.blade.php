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
                  <a class="nav-link " id="spl-tab" data-bs-toggle="tab" href="#spl" role="tab" aria-controls="profile" aria-selected="false"> SPL</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="plan" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" action="{{ route('planner.store') }}" id="create_planner" class="needs-validation m-5" novalidate>
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
                            <div class="col-md-12 ">
                                <button type="button " id="" class=" btn btn-primary  btn-icon-text " style="margin: 15px auto 0px auto; display: table;">
                                <i class="mdi mdi-check "></i> Save </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="spl" role="tabpanel" aria-labelledby="profile-tab">
                </div>
              </div>
        </div>
    </div>

    <div class=" modal fade " id="upload_kdm_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Uploaded Kdms infos </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">
                </div>
            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="upload_spl_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Uploaded SPLs infos </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">
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
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
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
                        '<option value="'+value.moviescods_id+'"> '+value.title+' </option>'

                    });
                    $('#movie').html(result)


                },
                error: function(response) {

                }
            })


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
