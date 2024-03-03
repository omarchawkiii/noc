@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Users </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">users</li>
            </ol>
        </nav>
    </div>
    <div class="row  ">
        <div class="col-xl-4">
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                    </div>
                    <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example"
                        id="location" name="location[]" multiple="multiple">
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                        <h4 class="card-title ">Users</h4>
                    </div>

                    <div>

                        <a id="create_user_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create user
                        </a>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center  sorting_asc">Order #</th>
                                    <th class="sorting text-center ">Name</th>
                                    <th class="sorting text-center ">Email</th>
                                    <th class="sorting text-center ">Role</th>
                                    <th class="sorting text-center ">Locations</th>
                                    <th class="sorting text-center ">option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr class="odd text-center  ">
                                        <td class="sorting_1">{{ $key + 1 }} </td>
                                        <td> {{ $user->name }} </td>
                                        <td>{{ $user->email }} </td>
                                        <td>@if( $user->role =="1") Admin @else Manager @endif
                                        </td>
                                        <td>
                                                @if ($user->locations)
                                                    @foreach ($user->locations as $location)
                                                        <div class="badge badge-outline-primary m-1"> {{ $location->name }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                        </td>


                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> Actions </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6"
                                                    style="">
                                                    <a class="btn btn-outline-primary dropdown-item edit_user"
                                                        id="{{ $user->id }}">Edit</a>
                                                    <a class="btn btn-outline-primary dropdown-item edit_password_btn"
                                                        id="{{ $user->id }}">Edit password</a>
                                                    <a class="btn btn-outline-primary dropdown-item delete_user"
                                                        id="{{ $user->id }}">Delete</a>

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


    <div id="create_user_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create User</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_user_form" class="needs-validation" novalidate action="{{ route('users.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Name</label>
                                        <input type="text" class="form-control" placeholder="User Name"
                                            value="{{ old('name') }}" name="name" required>
                                        @error('name')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left">Email</label>
                                        <input type="Email" class="form-control" placeholder="Email"
                                            value="{{ old('email') }}" name="email" required>
                                        @error('email')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left">Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            value="{{ old('password') }}" name="password" required>
                                        @error('password')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                         <label class="w-100 " style="text-align: left"> Confirm Password </label>
                                        <input type="password" class="form-control" placeholder=" Confirm Password "
                                            value="{{ old('confirm_password') }}" name="confirm_password" required>
                                        @error('confirm_password')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <label class="w-100 " style="text-align: left"> Role </label>
                                        <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" name="role" required>
                                            <option selected="" value>Role</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Manager</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-2 mr-sm-2">
                                         <label class="w-100 " style="text-align: left"> Location </label>
                                        <div class="input-group">

                                            <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="location_create_user" name="location[]"
                                                multiple="multiple" required>


                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2">Submit</button>
                                    <button class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close" type="button" >Cancel</button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>


    <!-- Edit  user -->
    <div id="edit_user_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Edit User</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body minauto text-center p-4">
                    <div class="">
                        <form method="PUT" class="needs-validation" novalidate id="edit_user_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                        <label class="w-100 " style="text-align: left"> Name</label>
                                        <input id="name" type="text" class="form-control"
                                            placeholder="User Name" value="{{ old('name') }}" name="name" required>
                                        @error('name')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="w-100 " style="text-align: left">Email</label>
                                        <input id="Email" type="Email" class="form-control" placeholder="Email"
                                            value="{{ old('email') }}" name="email" required>
                                        @error('email')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <label class="w-100 " style="text-align: left"> Role </label>
                                        <select id="role" class="form-select  form-control form-select-sm" id="role" aria-label=".form-select-sm example" name="role" required>
                                                <option value>Role</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Manager</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <label class="w-100 " style="text-align: left"> Location </label>
                                        <div class="input-group">

                                            <select class="form-select  form-control form-select-sm"
                                                aria-label=".form-select-sm example" id="location_edit_user"
                                                name="location[]" multiple="multiple" required>


                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2" id="submit_update">Submit</button>
                                    <button data-bs-dismiss="modal" aria-label="Close" type="button"  class="btn btn-dark">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>

    <!-- Edit  Password -->
    <div id="edit_password_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Edit password</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body minauto text-center p-4">
                    <div class="">
                        <form method="PUT" class="needs-validation" novalidate id="edit_password_form">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="w-100 " style="text-align: left">Password</label>
                                        <input id="password" type="password" class="form-control"
                                            placeholder="Password" value="{{ old('password') }}" name="password"
                                            required>
                                        @error('password')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="id_user_password" value>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="w-100 " style="text-align: left"> Confirm Password </label>
                                        <input id="confirm_password" type="password" class="form-control"
                                            placeholder=" Confirm Password " value="{{ old('confirm_password') }}"
                                            name="confirm_password" required>
                                        @error('confirm_password')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2" id="submit_update_password">Submit</button>
                                    <button data-bs-dismiss="modal" aria-label="Close" type="button"  class="btn btn-dark">Cancel</button>
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
            var forms =$( "#edit_user_form, #edit_password_form, #create_user_form" )

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


        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select a location",
                allowClear: true
            });

            $('#location_edit_user').select2({
                placeholder: "Select a location",
                allowClear: true
            });

            $('#location_create_user').select2({
                placeholder: "Select a location",
                allowClear: true
            });


        });
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select a location",
                allowClear: true
            });
        });
    </script>


    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script>
        (function($) {

            @if (session('message'))

                $.toast({
                    heading: 'Success',
                    text: '{{ session('message') }}',
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
                $('#order-listing').DataTable({
                    "aLengthMenu": [
                        [5, 10, 15, -1],
                        [5, 10, 15, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });
                $('#order-listing').each(function() {
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


        function get_users(location) {

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
        $('#location').change(function() {
            var location = $('#location').val();
            get_users(location)
        });

        //Delete NOC SPLs
        $(document).on('click', '.delete_user', function() {

            var id = $(this).attr('id');
            var url = '{{ url('') }}' + '/user/' + id + '/destroy';
            var location = $('#location').val();
            swal({
                showCancelButton: true,
                title: 'User Deletion!',
                text: 'You are sure you want to delete this User',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true,
                    },

                    Confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                }
            }).then((result) => {
                console.log(result)
                if (result) {

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        method: 'DELETE',
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}",
                        },

                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
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



                            swal.close();

                            if (response == 'Success') {
                                get_users(location)
                                swal({
                                    title: 'Done!',
                                    text: 'Spls Deleted Successfully ',
                                    icon: 'success',
                                    button: {
                                        text: "Continue",
                                        value: true,
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                })

                            } else {
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
                            swal.close();
                            showSwal('warning-message-and-cancel');

                            //console.log(response) ;
                        }
                    })


                }

            })

        })

        $(document).on('click', '.edit_user', function() {

            var id = $(this).attr('id');
            var url = '{{ url('') }}' + '/user/' + id + '/show';
            var location = $('#location').val();
            var location_option =""  ;
            var selected = false ;

            $('#edit_user_modal').modal('show');

            $('#location_edit_user').select2({
                placeholder: "Select a location",
                allowClear: true
            });



            $.ajax({
                url: url,
                type: 'GET',
                method: 'GET',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response)
                    $('#edit_user_modal #name').val(response.user.name)
                    $('#edit_user_modal #Email').val(response.user.email)

                    $('#edit_user_modal #location').select2({
                        placeholder: "Select a location",
                        allowClear: true
                    });

                    $("#edit_user_modal #role option[value="+ response.user.role+"]").prop("selected", true)


                    $.each(response.locations, function(index, value) {

                        $.each(response.user.locations, function(index, selected_element) {
                            if(selected_element.id === value.id)
                            {
                                selected = true ;
                            }
                        })
                        if(selected)
                        {
                            location_option  =location_option
                            +'<option selected value="'+value.id+'">'+value.name+'</option>' ;
                        }
                        else
                        {
                            location_option  =location_option
                            +'<option value="'+value.id+'">'+value.name+'</option>' ;
                        }
                        selected = false ;
                    })
                    $('#edit_user_modal #location_edit_user').html(location_option)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })
        })

        $(document).on('click', '#create_user_btn', function() {
            $('#create_user_modal').modal('show');
        })

        $(document).on("submit","#edit_user_form" , function(event) {

            event.preventDefault();


            var name = $('#name').val();
            var email = $('#Email').val();
            var role = $('#role').val();
            var location = $('#location_edit_user').val();
            var url = '{{ url('') }}' + '/user/update';

            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    url: url,
                    name: name,
                    email: email,
                    role: role,
                    location: location,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response)
                    get_users(location)
                        swal({
                            title: 'Done!',
                            text: 'User Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#edit_user_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })


        $(document).on('click', '.edit_password_btn', function() {
            var id = $(this).attr('id');
            $('#id_user_password').val(id)
            $('#edit_password_modal').modal('show');
        })
        $(document).on("submit","#edit_password_form" , function(event) {
            event.preventDefault();
            var id = $('#id_user_password').val();
            var password = $('#password').val();
            var url = '{{ url('') }}' + '/user/update_password';

            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    id: id,
                    password: password,

                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                        swal({
                            title: 'Done!',
                            text: 'Password Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#edit_password_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })

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
