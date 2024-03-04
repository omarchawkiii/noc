@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Libraries </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Libraries</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Libraries</h4>
                    </div>
                    <div>
                        <a id="create_source_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create New
                        </a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="sources-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center  sorting_asc">Order #</th>
                                    <th class="sorting text-center ">Name</th>
                                    <th class="sorting text-center ">Server IP</th>
                                    <th class="sorting text-center ">Ingest Protocol</th>
                                    <th class="sorting text-center ">Remote Path</th>
                                    <th class="sorting text-center ">Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sources as $key => $source)
                                    <tr class="odd text-center  ">
                                        <td class="sorting_1">{{ $key + 1 }} </td>
                                        <td> {{ $source->serverName }} </td>
                                        <td>{{ $source->server_ip }} </td>
                                        <td>{{ $source->ingestProtocol }}</td>
                                        <td>{{ $source->path }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown"aria-haspopup="true" aria-expanded="false"> Actions </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6" style="">
                                                    <a class="btn btn-outline-primary dropdown-item edit_source">Edit</a>
                                                    <a class="btn btn-outline-primary dropdown-item edit_password_btn">Edit password</a>
                                                    <a class="btn btn-outline-primary dropdown-item delete_source">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="create_source_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create User</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_source_form" class="needs-validation" novalidate action="{{ route('ingestersources.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" style="text-align: left">
                                        <input name="defaultlocation_add_form" id="defaultlocation_add_form" type="checkbox" class="form-check-input" value="1"> Ingest Library <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" style="text-align: left">
                                        <input name="usb_content_add_form" id="usb_content_add_form"  type="checkbox" class="form-check-input" value="1"> Media Content Library <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" style="text-align: left">
                                        <input name="defaultContent_add_form" id="defaultContent_add_form"  type="checkbox" class="form-check-input" value="1"> Default Content Library <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Server Name</label>
                                        <input type="text" class="form-control" placeholder="Server Name"
                                            value="{{ old('serverName') }}" name="serverName" required>
                                        @error('serverName')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left">Server IP</label>
                                        <input type="text" class="form-control" placeholder="Server IP"
                                            value="{{ old('server_ip') }}" name="server_ip" required>
                                        @error('server_ip')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left">Ingest Protocol</label>
                                        <input type="text" class="form-control" placeholder="Ingest Protocol"
                                            value="{{ old('ingestProtocol') }}" name="ingestProtocol" required>
                                        @error('ingestProtocol')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left"> User Name </label>
                                        <input type="text" class="form-control" placeholder=" User Name "
                                            value="{{ old('usernameServer') }}" name="usernameServer" required>
                                        @error('usernameServer')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left"> Remote Path </label>
                                        <input type="password" class="form-control" placeholder=" Confirm Password "
                                            value="{{ old('passwordServer') }}" name="passwordServer" required>
                                        @error('passwordServer')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left"> Path </label>
                                        <input type="text" class="form-control" placeholder=" Path "
                                            value="{{ old('path') }}" name="path" required>
                                        @error('path')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" m-2">
                                    <button type="submit" class="btn btn-lg btn-success me-2">Submit</button>
                                    <button class="btn btn-dark btn-lg" data-bs-dismiss="modal" aria-label="Close" type="button" >Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>

        // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms =$( "#create_source_form" )

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
            })()
        </script>


    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#location-listing').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: "_INPUT_",
                        searchPlaceholder: "Search..."
                    }
                });

            });
        })(jQuery);
    </script>
    <!-- -------END  DATA TABLE ---- -->


    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>





    <script>
        (function($) {
            'use strict';
            $(function() {
                $('#sources-listing').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });
                $('#sources-listing').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_filter] input');
                    search_input.attr('placeholder', 'Search');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
            });
        })(jQuery);


        function get_sources(location) {

            $("#users-listing").dataTable().fnDestroy();
            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#users-listing tbody').html(loader_content)

            var url = "{{ url('') }}" + '/get_users/';
            var result = " ";

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    location: location,
                },
                success: function(response) {

                    $.each(response.users, function(index, value) {
                        var user_locations = "";

                        $.each(value.locations, function(index, value) {
                            console.log(value)
                            user_locations += '<div class="badge badge-outline-primary m-1">' +
                                value.name + '</div>';
                        })

                        index++;
                        var role="";
                        if(value.role ==1)
                        {
                            role="Admin";
                        }
                        else
                        {
                            role="Manager";
                        }
                        result = result +
                            '<tr class="odd text-center">' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' +
                            index + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .email + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + role + ' </td>' +
                            '<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> ' +
                            user_locations + '</a></td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' +
                            '<div class="dropdown">' +
                            '<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6" style="">' +
                            '<a class="btn btn-outline-primary dropdown-item edit_user" id="' + value
                            .id + '">Edit</a>' +
                            '<a class="btn btn-outline-primary dropdown-item edit_password_btn" id="' + value
                            .id + '">Edit Password</a>' +
                            '<a class="btn btn-outline-primary dropdown-item delete_user" id="' + value
                            .id + '">Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                    });
                    $('#users-listing tbody').html(result)

                    /***** refresh datatable **** **/

                    var spl_datatable = $('#users-listing').DataTable({
                        "iDisplayLength": 10,
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



        $(document).on('click', '#create_source_btn', function() {
            $('#create_source_modal').modal('show');
        })

        // fix page hight

        var t = $(window).height();
        $("#content_page").css("height", t - 300);
        $("#content_page").css("max-height", t - 300);
        $("#content_page").css("overflow-y", 'auto');
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* ***** Select 2 **** */

        .select2.select2-container.select2-container--default {
            width: 90% !important;
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

        .select2-container--open .select2-dropdown--below {
            z-index: 999999999;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            width: 100%;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice:nth-child(5n+1) {
            float: left;
        }

        #edit_user_modal .select2.select2-container.select2-container--default {
            width: 100% !important;
            background: #2a3038;
        }
        #create_user_modal .select2.select2-container.select2-container--default ,
        #edit_user_modal .select2.select2-container.select2-container--default
        {
            width: 100% !important;

        }

    </style>
@endsection
