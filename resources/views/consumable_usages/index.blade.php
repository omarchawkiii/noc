@extends('layouts.app')
@section('title')
    Transfer Request

@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Transfer Request </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transfer Request</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                        <h4 class="card-title ">Transfer Request</h4>
                    </div>

                    <div>

                        <a id="create_transfer_request_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create New Transfer Request
                        </a>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>

                                    <th class="sorting text-center ">Requester</th>
                                    <th class="sorting text-center ">From (Storage Name)</th>
                                    <th class="sorting text-center ">To (Cinema Location)</th>
                                    <th class="sorting text-center ">Part Number</th>
                                    <th class="sorting text-center ">Part Name</th>
                                    <th class="sorting text-center ">Status</th>
                                    <th class="sorting text-center ">Approved By</th>
                                    <th class="sorting text-center ">Approved Date</th>
                                    <th class="sorting text-center ">Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfer_requests as $key => $transfer_request)
                                    <tr class="odd text-center  ">
                                        <td> {{ $transfer_request->user->name }} </td>
                                        <td> {{ $transfer_request->storageLocation->name }} </td>
                                        <td> {{ $transfer_request->CinemaLocation->name }} </td>
                                        <td> {{ $transfer_request->part->part_number }} </td>
                                        <td> {{ $transfer_request->part->part_description }} </td>
                                        <td>  @if($transfer_request->approvedBy) Approved @else disapprove @endif </td>
                                        <td> @if($transfer_request->approvedBy) {{ $transfer_request->approvedBy->name }}@else - @endif</td>
                                        <td> {{ $transfer_request->approved_date }} </td>
                                        <td><button data-id="{{ $transfer_request->id }}" type="button" class="btn btn-inverse-success  m-1 approve"><i class="mdi mdi-check-circle "></i> Approve</button></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="create_transfer_request_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create New Transfer Request </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_transfer_request_form" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left" for="storage_id"> From (Storage Name)</label>
                                         <select class="form-control form-control-sm" id="storage_id" name="storage_id" required>
                                            <option value="" selected>Please Select Storage Name</option>
                                            @foreach ($storage_locations as $storage_location )
                                                <option value="{{ $storage_location->id }}" >{{ $storage_location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Category</label>
                                         <select class="form-control form-control-sm" id="inventory_category_id" name="inventory_category_id" required>
                                            <option value="" selected>Please Select Category</option>
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left" for="part_number"> Part Number</label>
                                         <select class="form-control form-control-sm" id="part_number" name="part_number" required>
                                            <option value="" selected>Please Select Catygory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="part_description" class="w-100 " style="text-align: left">Part Description</label>
                                        <textarea class="form-control" id="part_description" name="part_description" rows="4" placeholder="Part Description" disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Serials  (If the part is serialized)</label>
                                        <input type="text" class="form-control" placeholder="Serials "
                                            name="serials" id="serials" >

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> Reason for Request  </label>
                                        <input type="text" class="form-control" placeholder="Reason for Request"
                                            name="reason" id="reason" >

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left" for="cinema_location_id"> To (Cinema Location)</label>
                                         <select class="form-control form-control-sm" id="cinema_location_id" name="cinema_location_id" required>
                                            <option value="" selected>Please Select Cinema Name</option>
                                            @foreach ($cinema_locations as $cinema_location )
                                                <option value="{{ $cinema_location->id }}" >{{ $cinema_location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class=" m-2">
                                    <button type="submit" class="btn btn-success me-2">Submit</button>
                                    <button class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close" type="button" >Cancel</button>

                                </div>

                                <br />
                                <br />
                                <br />
                                <br />


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
            var forms =$( "#edit_transfer_request_form, #create_transfer_request_form" )

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

        function formatDate(dateStr) {
            let date = new Date(dateStr);
            let year = date.getFullYear();
            let month = ('0' + (date.getMonth() + 1)).slice(-2); // Mois de 0-11 à 1-12
            let day = ('0' + date.getDate()).slice(-2);
            let hours = ('0' + date.getHours()).slice(-2);
            let minutes = ('0' + date.getMinutes()).slice(-2);
            return `${year}-${month}-${day} ${hours}:${minutes}`;
        }
        function get_transfer_requests() {

            $("#users-listing").dataTable().fnDestroy();
            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#users-listing tbody').html(loader_content)

            var url = "{{ url('') }}" + '/transfer_request/get_transfer_requests';
            var result = " ";
            console.log(url)
            $.ajax({
                url: url,
                method: 'GET',

                success: function(response) {

                    $.each(response.transfer_requests, function(index, value) {
                        console.log(value,value.quantity)
                        index++;

                        if(value.approved_by != null )
                        {
                            var approved_by  = value.approved_by.name
                            var approved_date  = formatDate(value.approved_date)
                            var btn_approve  = '<span  class="  text-success "><i class="mdi mdi-check-circle "></i> Approved</button>'
                            var status = "Approved" ;
                        }
                        else
                        {
                            var approved_by  = '-'
                            var approved_date  = '-'
                            var btn_approve = '<button data-id="'+value.id+'" type="button" class="btn btn-inverse-success  m-1 approve"><i class="mdi mdi-check-circle "></i> Approve</button>'
                            var status = "disapprove" ;
                        }


                        result = result +
                            '<tr class="odd text-center">' +


                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .user.name+ ' </td>' +

                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .storage_location.name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .cinema_location.name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part.part_number + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part.part_description + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + status + ' </td>' +

                            '<td class="text-body align-middle fw-medium text-decoration-none">' + approved_by + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + approved_date + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + btn_approve + ' </td>' +

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
        get_transfer_requests()

        //Delete NOC SPLs
        $(document).on('click', '.approve', function() {

            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/transfer_request/' + id + '/approuve';

            swal({
                showCancelButton: true,
                title: 'Transfer Request Approuve!',
                text: 'You are sure you want to approuve this Transfer Request ',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },

                    Confirm: {
                        text: "Yes, Approuve it!",
                        value: true,
                        visible: true,
                        className: "btn btn-success",
                        closeModal: true,
                    },
                }
            }).then((result) => {
                console.log(result)
                if (result) {

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        method: 'PUT',
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
                                get_transfer_requests()
                                swal({
                                    title: 'Done!',
                                    text: 'Transfer Request Approuved Successfully ',
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
                        }
                    })


                }

            })

        })


        $(document).on('click', '#create_transfer_request_btn', function() {
            $('#create_transfer_request_modal #create_transfer_request_form')[0].reset();
            $('#create_transfer_request_modal').modal('show');
        })

        $(document).on("submit","#create_transfer_request_form" , function(event) {

            event.preventDefault();

            var part_number = $('#create_transfer_request_modal #part_number').val();
            var serials = $('#create_transfer_request_modal #serials').val();
            var cinema_location_id = $('#create_transfer_request_modal #cinema_location_id').val();
            var reason = $('#create_transfer_request_modal #reason').val();
            var storage_id = $('#create_transfer_request_modal #storage_id').val();

            var url = '{{ url('') }}' + '/transfer_request/store';
            console.log(url)
            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'POST',
                method: 'POST',
                data: {
                    part_number : part_number,
                    reason : reason,
                    serials : serials,
                    cinema_location_id : cinema_location_id,
                    storage_id : storage_id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_transfer_requests()
                        swal({
                            title: 'Done!',
                            text: 'Transfer Request Created Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#create_transfer_request_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })

        $(document).on("submit","#edit_transfer_request_form" , function(event) {

            event.preventDefault();

            var id = $('#edit_transfer_request_modal #transfer_request_id').val()
            var inventory_category_id = $('#edit_transfer_request_modal #inventory_category_id').val();
            var transfer_request_number = $('#edit_transfer_request_modal #transfer_request_number').val();
            var transfer_request_description = $('#edit_transfer_request_modal #transfer_request_description').val();
            var serialized = $('#edit_transfer_request_modal #serialized').val();

            console.log(id)
            var url = '{{ url('') }}' + '/transfer_request/update';

            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    inventory_category_id:inventory_category_id,
                    transfer_request_number:transfer_request_number,
                    transfer_request_description:transfer_request_description,
                    serialized:serialized,
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_transfer_requests()
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

                        $('#edit_transfer_request_modal').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })

        })

        $('#inventory_category_id').change(function() {
            var inventory_category_id = $('#inventory_category_id').val();


            var url = "{{ url('') }}" + '/transfer_request/get_part_from_category';
            var result = "";

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    inventory_category_id: inventory_category_id,
                },
                success: function(response) {

                    result = '<option value=""> Part Number </option>';
                    $.each(response.parts, function(index, value) {
                        result = result +
                        '<option value="'+value.id+'"> '+value.part_number+' </option>'

                    });
                    $('#part_number').html(result)
                },
                error: function(response) {
                }
            })


        });
        $('#part_number').change(function() {
            var part_id = $('#part_number').val();

            var url = "{{ url('') }}" + '/transfer_request/get_description_from_part';
            var result = "";
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    part_id: part_id,
                },
                success: function(response) {
                    $('#part_description').val(response.part.part_description)
                },
                    error: function(response) {
                }
            })


        });

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
        #create_transfer_request_modal .modal-body
        {
            min-height: auto !important;

        }
        .form-control:disabled
        {
            background-color: #121f2b;
        }

    </style>
@endsection
