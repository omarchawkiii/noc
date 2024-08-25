@extends('layouts.app')
@section('title')
    Inventory In
@endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Inventory In </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventory In</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                        <h4 class="card-title ">Inventory In</h4>
                    </div>

                    <div>

                        <a id="create_inventory_in_btn" class="btn btn-primary  btn-icon-text">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Create New Inventory In
                        </a>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center ">Date In</th>
                                    <th class="sorting text-center ">Creator</th>
                                    <th class="sorting text-center ">Category</th>
                                    <th class="sorting text-center ">Part Number</th>
                                    <th class="sorting text-center ">Part Name</th>
                                    <th class="sorting text-center ">Quantity</th>
                                    <th class="sorting text-center ">Serials</th>
                                    <th class="sorting text-center ">Storage</th>
                                    <th class="sorting text-center ">Supplier</th>
                                    <th class="sorting text-center ">PO Reference</th>
                                    <th class="sorting text-center ">DO Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories_in as $key => $inventory_in)
                                    <tr class="odd text-center  ">
                                        <td> {{ $inventory_in->created_at }} </td>
                                        <td> {{ $inventory_in->user->name }} </td>
                                        <td> {{ $inventory_in->part->inventoryCategory->name }} </td>
                                        <td> {{ $inventory_in->part->part_number }} </td>
                                        <td> {{ $inventory_in->part->part_description }} </td>
                                        <td> {{ $inventory_in->quantity }} </td>
                                        <td>
                                            @foreach ( $inventory_in->serialNumbers as $serial)
                                                <div class="badge badge-outline-primary m-1"> {{ $serial->serial }} </div><br />
                                            @endforeach
                                            {{ $inventory_in->serials }}  </td>
                                        <td> {{ $inventory_in->storageLocation->name }} </td>
                                        <td> {{ $inventory_in->supplier->company_name }} </td>
                                        <td> {{ $inventory_in->po_reference }} </td>
                                        <td> {{ $inventory_in->do_reference }} </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="create_inventory_in_modal" class="modal hide fade" role="dialog" aria-labelledby="edit_user_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5>Create New Inventory In </h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div class="">
                        <form method="POST" id="create_inventory_in_form" class="needs-validation" novalidate >
                            @csrf
                            <div class="row">

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
                                         <label class="w-100 " style="text-align: left"> Quantity</label>
                                        <input type="number" class="form-control" placeholder="Quantity "
                                            name="quantity" id="quantity" required>
                                    </div>
                                </div>
                                <div id="serial-number-container"></div>


                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left" for="supplier_id"> Supplier</label>
                                         <select class="form-control form-control-sm" id="supplier_id" name="supplier_id" required>
                                            <option value="" selected>Please Select Supplier</option>
                                            @foreach ($suppliers as $supplier )
                                                <option value="{{ $supplier->id }}" >{{ $supplier->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> PO Reference #</label>
                                        <input type="text" class="form-control" placeholder="PO Reference # "
                                            name="po_reference" id="po_reference" required>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left"> DO Reference #</label>
                                        <input type="text" class="form-control" placeholder="DO Reference # "
                                            name="do_reference" id="do_reference" required>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group  has-validation">
                                         <label class="w-100 " style="text-align: left" for="storage_id"> Storage Name</label>
                                         <select class="form-control form-control-sm" id="storage_id" name="storage_id" required>
                                            <option value="" selected>Please Select Storage Name</option>
                                            @foreach ($storage_locations as $storage_location )
                                                <option value="{{ $storage_location->id }}" >{{ $storage_location->name }}</option>
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
            var forms =$( "#edit_inventory_in_form, #create_inventory_in_form" )

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
        function get_inventories_in() {

            $("#users-listing").dataTable().fnDestroy();
            var loader_content =
                '<div class="jumping-dots-loader">' +
                '<span></span>' +
                '<span></span>' +
                '<span></span>' +
                '</div>'
            $('#users-listing tbody').html(loader_content)

            var url = "{{ url('') }}" + '/inventory_in/get_inventories_in';
            var result = " ";
            console.log(url)
            $.ajax({
                url: url,
                method: 'GET',

                success: function(response) {

                    $.each(response.inventories_in, function(index, value) {

                        console.log(value)

                        var serialsHtml = '';
                        $.each(value.serial_numbers, function(i, serial) {
                            console.log(serial)
                            serialsHtml += '<div class="badge badge-outline-primary m-1">' + serial.serial + '</div><br />';
                        });
                        index++;

                        result = result +
                            '<tr class="odd text-center">' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + formatDate(value
                            .created_at) + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .user.name+ ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part.inventory_category.name+ ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part.part_number + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .part.part_description + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .quantity+ ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + serialsHtml  + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .storage_location.name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .supplier.company_name + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .po_reference + ' </td>' +
                            '<td class="text-body align-middle fw-medium text-decoration-none">' + value
                            .do_reference + ' </td>' +

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
        get_inventories_in()

        //Delete NOC SPLs
        $(document).on('click', '.delete', function() {

            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/inventory_in/' + id + '/destroy';

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
                                get_inventories_in()
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

        /*$(document).on('click', '.edit', function() {

            $('#edit_inventory_in_modal #edit_inventory_in_form')[0].reset();
            $('#edit_inventory_in_modal #inventory_in_id').val("")



            var id = $(this).attr('data-id');
            var url = '{{ url('') }}' + '/inventory_in/' + id + '/show';

            $('#edit_inventory_in_modal').modal('show');


            $.ajax({
                url: url,
                type: 'GET',
                method: 'GET',
                data: {
                    id: id,
                },

                success: function(response) {
                    console.log(response)


                    $('#edit_inventory_in_modal #inventory_in_number').val(response.inventory_in.inventory_in_number)
                    $('#edit_inventory_in_modal #inventory_in_description').val(response.inventory_in.inventory_in_description)
                    $('#edit_inventory_in_modal #serialized').val(response.inventory_in.serialized)
                    $('#edit_inventory_in_modal #inventory_category_id').val(response.inventory_in.inventory_category.id)
                    $('#edit_inventory_in_modal #inventory_in_id').val(response.inventory_in.id)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })
        })*/

        $(document).on('click', '#create_inventory_in_btn', function() {
            $('#create_inventory_in_modal #create_inventory_in_form')[0].reset();
            $('#create_inventory_in_modal').modal('show');
        })

        $(document).on("submit","#create_inventory_in_form" , function(event) {

            event.preventDefault();


            var inventory_category_id = $('#create_inventory_in_modal #inventory_category_id').val();
            var part_number = $('#create_inventory_in_modal #part_number').val();
            var quantity = $('#create_inventory_in_modal #quantity').val();
            //var serials = $('#create_inventory_in_modal #serials').val();
            var supplier_id = $('#create_inventory_in_modal #supplier_id').val();
            var po_reference = $('#create_inventory_in_modal #po_reference').val();
            var do_reference = $('#create_inventory_in_modal #do_reference').val();
            var storage_id = $('#create_inventory_in_modal #storage_id').val();
            var serials = [] ;
            $('input[name="serials[]"]').each(function() {
                serials.push($(this).val());
            });


            var url = '{{ url('') }}' + '/inventory_in/store';
            console.log(url)
            //$('#edit_user_modal').modal('show');
            $.ajax({
                url: url,
                type: 'POST',
                method: 'POST',
                data: {

                    inventory_category_id : inventory_category_id,
                    part_number : part_number,
                    quantity : quantity,
                    serials : serials,
                    supplier_id : supplier_id,
                    po_reference : po_reference,
                    do_reference : do_reference,
                    storage_id : storage_id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_inventories_in()
                        swal({
                            title: 'Done!',
                            text: 'Inventory Out Created Successfully ',
                            icon: 'success',
                            button: {
                                text: "Continue",
                                value: true,
                                visible: true,
                                className: "btn btn-primary"
                            }
                        })
                        $('#create_inventory_in_modal').modal('hide') ;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })


        })

        $(document).on("submit","#edit_inventory_in_form" , function(event) {

            event.preventDefault();

            var id = $('#edit_inventory_in_modal #inventory_in_id').val()
            var inventory_category_id = $('#edit_inventory_in_modal #inventory_category_id').val();
            var inventory_in_number = $('#edit_inventory_in_modal #inventory_in_number').val();
            var inventory_in_description = $('#edit_inventory_in_modal #inventory_in_description').val();
            var serialized = $('#edit_inventory_in_modal #serialized').val();

            console.log(id)
            var url = '{{ url('') }}' + '/inventory_in/update';

            $.ajax({
                url: url,
                type: 'PUT',
                method: 'PUT',
                data: {
                    inventory_category_id:inventory_category_id,
                    inventory_in_number:inventory_in_number,
                    inventory_in_description:inventory_in_description,
                    serialized:serialized,
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },

                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {

                    get_inventories_in()
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

                        $('#edit_inventory_in_modal').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(response);
                }
            })

        })

        $('#inventory_category_id').change(function() {
            var inventory_category_id = $('#inventory_category_id').val();


            var url = "{{ url('') }}" + '/inventory_in/get_part_from_category';
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

            var url = "{{ url('') }}" + '/inventory_in/get_description_from_part';
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

        $('#quantity').on('change', function() {
            var quantity = $(this).val();
            var serialNumberContainer = $('#serial-number-container');

            // Réinitialiser les champs de numéro de série
            serialNumberContainer.empty();

            for (var i = 0; i < quantity; i++) {

                serialNumberContainer.append('<div class="form-group has-validation"><label class="w-100 " style="text-align: left" for="serials_' + i + '">Serial Number ' + (i + 1) + ':</label><input type="text" name="serials[]" id="serials_' + i + '" class="form-control" ></div>');
            }
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
        #create_inventory_in_modal .modal-body
        {
            min-height: auto !important;

        }
        .form-control:disabled
        {
            background-color: #121f2b;
        }

    </style>
@endsection