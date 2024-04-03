@extends('layouts.app')
@section('title')
    Asset Reports
@endsection
@section('content')


    <div class="page-header performance-shadow ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Asset Reports</li>
            </ol>
        </nav>
    </div>
    <div class="row mb-2 ">

        <div class="col-xl-5">
            <div class="input-group mb-2 mr-sm-2">

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
        </div>
        <div class="col-xl-5">
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                </div>
                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="screen">
                    <option value="null">Screen </option>

                </select>
            </div>
        </div>
        <div class="col-xl-2 ">
            <div class="input-group mb-2 mr-sm-2 " id="export_pdf">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="mdi mdi-file-pdf-box"></i></div>
                </div>
                <button class="form-   form-control form-select-sm" aria-label=".form-select-sm example"
                    id="export_Pdf">
                    Export PDF
                </button>
            </div>
        </div>





    </div>

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body " id="content_page">

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="asset_infos_listing" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc">Location </th>
                                            <th class="sorting">Screen No </th>
                                            <th class="sorting">Screen name </th>
                                            <th class="sorting">Server Product Name </th>
                                            <th class="sorting">server E-S/N</th>
                                            <th class="sorting">Server Software</th>
                                            <th class="sorting ">Projector Model Number</th>
                                            <th class="sorting ">Projector Serial Number</th>
                                            <th class="sorting ">Sound Model</th>
                                            <th class="sorting ">Sound Chasis Serial</th>
                                            <th class="sorting ">Sound E-S/N</th>
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
</div>

@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- -------END  DATA TABLE ---- -->

    <script src="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select a location",
                allowClear: true
                });
        });
    </script>

    <script>
        (function($) {

            function get_asset_infos(location, screen, refresh_screen)
            {
                $("#asset_infos_listing").dataTable().fnDestroy();
                var loader_content  =
                '<div class="jumping-dots-loader">'
                    +'<span></span>'
                    +'<span></span>'
                    +'<span></span>'
                    +'</div>'
                $('#asset_infos_listing tbody').html(loader_content)

                var url = "{{  url('') }}"+ '/get_asset_infos_with_filter/' ;
                var result ='';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data :
                    {
                        location: location ,
                        screen: screen ,

                    },
                    success:function(response)
                    {
                        console.log(response)

                        // refersh screen list
                        if(refresh_screen)
                        {
                            if(response.screens != null)
                            {
                                $('#screen').prop('disabled', false);
                                screens = '<option value="null" selected>All screen </option>';
                                $.each(response.screens, function( index_screen, screen ) {
                                    screens = screens
                                        +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                                });
                            }
                            else
                            {
                                screens = '<option value="null" selected>All screen </option>';
                                $('#screen').prop('disabled', 'disabled');
                            }
                            $('#screen').html(screens)
                        }



                        //display data
                        $.each(response.asset_infos, function( index, value ) {

                            result = result
                                +'<tr class="odd">'
                                    +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.location.name+' </td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.screen_number+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.screen_name +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.server_product_name +'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.server_esn+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.server_software+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.projector_model_number+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.projector_serial_number+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.sound_model+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.sound_chasis_serial+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+ value.sound_esn+'</a></td>'
                                +'</tr>';
                        });
                        $('#asset_infos_listing tbody').html(result)


                        var spl_datatable = $('#asset_infos_listing').DataTable({
                            "iDisplayLength": 10,
                            destroy: true,
                            "bDestroy": true,
                            "language": {
                                search: "_INPUT_",
                                searchPlaceholder: "Search..."
                            }
                        });

                        /***** refresh datatable **** **/



                    },
                    error: function(response) {

                    }
                })
            }



            $('#location').change(function(){

                //$('#location-listing tbody').html('')
                var location =  $('#location').val();
                console.log(location) ;
                var refresh_screen = true  ;
                var screen =  null;
                get_asset_infos(location, screen, refresh_screen)

            });

            $('#screen').change(function(){

                //$('#location-listing tbody').html('')
                var location =  $('#location').val();
                var screen =  $('#screen').val();
                console.log(screen)
                var refresh_screen = false  ;
                get_asset_infos(location, screen, refresh_screen)

            });




        })(jQuery);

        $(document).ready(function () {



             // Event listener for Download PDF report
            $('#export_Pdf').click(function () {
                // Get the values of the 'from' and 'to' inputs
                var location =  $('#location').val();
                var screen =  $('#screen').val();

                var url = "{{  url('') }}"+ '/generate_pdf_asset_info?location='+location+'&screen='+screen;
                console.log(location.length)
                if(location.length ==0)
                {
                    swal({
                            title: 'Failed!',
                            text: 'Please Select Locations     ',
                            icon: 'warning',
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
                else
                {
                    //  window.open('pdfReport.php?id_source='+id_source+'&name_screen='+name_screen+'&fromDate='+fromDate+'&toDate='+toDate+'&id_content='+id_content+'&title_content='+title_content, '_blank');
                    window.open(url);
                    //   generate_pdf_report(id_location, id_screen, fromDate, toDate)

                    /*if (id_content === undefined) {
                            id_content=null;
                    }*/
                }
            });

            // function to generete PDF report
            function generate_pdf_report(id_location, id_screen, fromDate, toDate)
            {

                var result ='';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data :
                    {
                        id_location: id_location ,
                        id_screen: id_screen ,
                        fromDate: fromDate ,
                        toDate: toDate ,
                    },
                    success:function(response)
                    {
                            console.log(response)

                    },
                    error: function(response) {

                    }
                })
            }


            // fix page hight

            var t = $(window).height();
            $("#content_page").css("height", t - 300);
            $("#content_page").css("max-height", t - 300);
            $("#content_page").css("overflow-y", 'auto');

        });

        $(document).on('click', '.item_result', function (event) {
            $('.item_result').not(this).removeClass('selected');
            $(this).toggleClass("selected");
            console.log($(this).hasClass('selected'))
            if ($(this).hasClass('selected')) {
                // Get the value of the data-title attribute
                var id = $(this).attr('data-id');
                var property = $(this).attr('data-property');
                var dataTitle = $(this).attr('data-title');

                $('#search_content_by_title').attr('data-property', property);
                $('#search_content_by_title').attr('data-id', id);
                $('#search_content_by_title').val(dataTitle)
            }

            $('#suggestions').addClass('hide-search');


        });



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



        /* ************* */
         .hide-div {
                display: none;
            }

            .execute-macro {
                font-weight: bold;
                font-size: 17px;
            }

            .macro-icon {
                font-weight: bold;
            }

            .style-offLine {
                font-size: 25px;
                width: 94%;
                margin: auto;
                text-align: center;
                line-height: 10;
                font-weight: bold;
            }

            .macro-item {
                height: 20px;
            }

            #suggestions {
                position: absolute;
                bottom: 0;
                top: 50px;
                left: 0;
                color: white;
                width: 100%;
                background-color: #000;
                border: 1px solid #ccc;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);

                max-height: 200px;
                overflow-y: auto;
                z-index: 99999999999999;
                height: 5000px;

            }

            .hide-search {
                display: none;
            }

            .item_result {
                height: 70px;
            }

            /* Adjustments for smaller screens */
            @media (max-width: 768px) {
                #suggestions {
                    max-height: 150px; /* Adjust max height for smaller screens */
                }
            }


            .form-select:disabled
            {
                background-color: #2a3038;
            }
    </style>
@endsection
