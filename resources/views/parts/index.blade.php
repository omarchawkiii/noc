@extends('layouts.app')
@section('title')
    Part
@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Parts </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Parts</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                        <h4 class="card-title ">Parts</h4>
                    </div>

                    <div>

                        <a id="create_part_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create New Part
                        </a>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center  sorting_asc">Order #</th>
                                    <th class="sorting text-center ">Category</th>
                                    <th class="sorting text-center ">Part Number</th>
                                    <th class="sorting text-center ">Part Description</th>
                                    <th class="sorting text-center ">Serialized</th>
                                    <th class="sorting text-center ">option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parts as $key => $part)
                                    <tr class="odd text-center  ">

                                        <td class="sorting_1">{{ $key + 1 }} </td>
                                        <td> {{ $part->InventoryCategory->name }} </td>
                                        <td> {{ $part->part_number }} </td>
                                        <td> {{ $part->part_description }} </td>
                                        <td> @if($part->serialized) Yes @else No @endif </td>
                                        <td>
                                            <button data-id="{{ $part->id }}" type="button" class="btn btn-inverse-warning btn-icon m-1 edit"><i class="mdi mdi-border-color "></i></button>
                                            <button data-id="{{ $part->id }}" type="button" class="btn btn-inverse-danger btn-icon m-1 delete"><i class="mdi mdi-delete-forever "></i></button>
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


    <div id="create_part_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create New Part </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_part_form" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Category</label>
                                         <select class="form-control form-control-sm" id="inventory_category_id" name="inventory_category_id">
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Part Number</label>
                                        <input type="text" class="form-control" placeholder="Part Number "
                                            value="{{ old('name') }}" name="part_number" id="part_number" required>
                                        @error('name')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="part_description" class="w-100 " style="text-align: left">Part Description</label>
                                        <textarea class="form-control" id="part_description" name="part_description" rows="4" placeholder="Part Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="serialized" class="w-100 " style="text-align: left">Serialized</label>
                                        <select class="form-control form-control-sm" id="serialized" name="serialized">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
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
    <div id="edit_part_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Edit Part</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body minauto text-center p-4">
                    <div class="">
                        <form method="PUT" class="needs-validation" novalidate id="edit_part_form">
                            <input type="hidden" id="part_id" value="">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Category</label>
                                         <select class="form-control form-control-sm" id="inventory_category_id" name="inventory_category_id">
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Part Number</label>
                                        <input type="text" class="form-control" placeholder="Part Number "
                                            value="{{ old('name') }}" name="part_number" id="part_number" required>
                                        @error('name')
                                            <div class="text-danger mt-1 ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="part_description" class="w-100 " style="text-align: left">Part Description</label>
                                        <textarea class="form-control" id="part_description" name="part_description" rows="4" placeholder="Part Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="serialized" class="w-100 " style="text-align: left">Serialized</label>
                                        <select class="form-control form-control-sm" id="serialized" name="serialized">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
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
            var forms =$( "#edit_part_form, #create_part_form" )

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
    <script src="{{ asset('/assets/js/select2.js') }}"></script>

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


        function get_parts() {

            $("#users-listing").dataTable().fnDestroy();
            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#users-listing tbody').html(loader_content)

            var url = "{{ url('') }}" + '/part/get_parts';
            var result = " ";
            console.log(url)
            $.ajax({
                url: url,
                method: 'GET',

                success: function(response) {

                    $.each(response.parts, function(index, value) {
                        console.log(value)
                        index++;

                        result = result +
                            '<tr class="odd text-center">' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' +
                            index + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .inventory_category.name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part_number + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part_description + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none"> ' + (value.serialized == 1 ? 'Yes' : 'No') + '</td>' +
                            '<td>'+
                                '<button data-id="'+value.id+'" type="button" class="btn btn-inverse-warning btn-icon m-1 edit"><i class="mdi mdi-border-color "></i></button>'+
                                '<button data-id="'+value.id+'" type="button" class="btn btn-inverse-danger btn-icon m-1 delete"><i class="mdi mdi-delete-forever "></i></button>'+
                            '</td>'+

                            '</tr>';
                    });
                    console.log(result)
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


        //Delete NOC SPLs
        $(document).on('click', '.delete', function() {

            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/part/' + id + '/destroy';

            swal({
                showCancelButton: true,
                title: 'Part Deletion!',
                text: 'You are sure you want to delete this Part',
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
                                get_parts()
                                swal({
                                    title: 'Done!',
                                    text: 'Part Deleted Successfully ',
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
                          //  showSwal('warning-message-and-cancel');

                            console.log(response) ;
                        }
                    })


                }

            })

        })

        $(document).on('click', '.edit', function() {

            $('#edit_part_modal #edit_part_form')[0].reset();
            $('#edit_part_modal #part_id').val("")



            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/part/' + id + '/show';

            $('#edit_part_modal').modal('show');


            $.ajax({
                url: url,
                type: 'GET',
                method: 'GET',
                data: {
                    id: id,
                },

                success: function(response) {
                    console.log(response)


                    $('#edit_part_modal #part_number').val(response.part.part_number)
                    $('#edit_part_modal #part_description').val(response.part.part_description)
                    $('#edit_part_modal #serialized').val(response.part.serialized)
                    $('#edit_part_modal #inventory_category_id').val(response.part.inventory_category.id)
                    $('#edit_part_modal #part_id').val(response.part.id)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })
        })

        $(document).on('click', '#create_part_btn', function() {
            $('#create_part_modal #create_part_form')[0].reset();
            $('#create_part_modal').modal('show');
        })

        $(document).on("submit","#create_part_form" , function(event) {

            event.preventDefault();


            var inventory_category_id = $('#create_part_modal #inventory_category_id').val();
            var part_number = $('#create_part_modal #part_number').val();
            var part_description = $('#create_part_modal #part_description').val();
            var serialized = $('#create_part_modal #serialized').val();
            console.log(serialized)
            var url = '{{ url('') }}' + '/part/store';
            console.log(url)
            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'POST',
                method: 'POST',
                data: {
                    inventory_category_id: inventory_category_id,
                    part_number: part_number,
                    part_description: part_description,
                    serialized: serialized,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_parts()
                        swal({
                            title: 'Done!',
                            text: 'Part Created Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#create_part_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })

        $(document).on("submit","#edit_part_form" , function(event) {

            event.preventDefault();

            var id = $('#edit_part_modal #part_id').val()
            var inventory_category_id = $('#edit_part_modal #inventory_category_id').val();
            var part_number = $('#edit_part_modal #part_number').val();
            var part_description = $('#edit_part_modal #part_description').val();
            var serialized = $('#edit_part_modal #serialized').val();

            console.log(id)
            var url = '{{ url('') }}' + '/part/update';

            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    inventory_category_id:inventory_category_id,
                    part_number:part_number,
                    part_description:part_description,
                    serialized:serialized,
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_parts()
                        swal({
                            title: 'Done!',
                            text: 'Category Updated Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })

                        $('#edit_part_modal').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })

        })


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
        #create_part_modal .modal-body
        {
            min-height: auto !important;
        }
    </style>
@endsection
