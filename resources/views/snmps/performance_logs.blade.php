@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')


    <div class="page-header performance-shadow ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Performance Logs</li>
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
        <div class="col-xl-4">
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                </div>
                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="screen">
                    <option value="null">Screen </option>

                </select>
            </div>
        </div>


        <div class="col-xl-4   ">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                </div>
                <input type="text" class="form-control" id="search_content_by_title" placeholder="Search "
                    data-property="" data-id="">
                    <div id="suggestions" class="row hide-search"></div>
            </div>
        </div>


        <div class="col-xl-4">
            <div id="datepicker-popup" class="input-group date datepicker">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
                <input type="text datepicker" class="form-control" id="from" placeholder="From">

            </div>
        </div>
        <div class="col-xl-4">
            <div id="datepicker-popup" class="input-group date datepicker">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
                <input type="text" class="form-control" id="to" placeholder="To">

            </div>
        </div>

        <div class="col-xl-4 ">
            <div class="input-group mb-2 mr-sm-2 " id="search_content">

                <button class="form-   form-control form-select-sm" style="  background-color: #297EEE!important"
                    aria-label=".form-select-sm example">
                    Search
                </button>
            </div>
        </div>

    </div>
    <div class="row  " style="    margin-top: 7px;">
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
        <div class="col-xl-2 ">
            <div class="input-group mb-2 mr-sm-2 " id="export_excel">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="mdi mdi-file-excel"></i></div>
                </div>
                <button class="form-   form-control form-select-sm" aria-label=".form-select-sm example">
                    EXCEL
                </button>
            </div>
        </div>

    </div>
    <div class="row ">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">

                    <div class="row">
                        <div class="col-12">
                            <div class="preview-list multiplex" id="parent_table-content"
                                style="height: 467px; max-height: 467px; overflow-y: auto;">
                                <div class="table-responsive" id="parent_table">
                                    <div id="table_logs_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="table_logs_length"><label>Show
                                                        <select name="table_logs_length" aria-controls="table_logs"
                                                            class="custom-select custom-select-sm form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> entries</label></div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="table_logs_filter" class="dataTables_filter">
                                                    <label>Search:<input type="search"
                                                            class="form-control form-control-sm" placeholder=""
                                                            aria-controls="table_logs"></label></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 1505.04px; padding-right: 0px;">
                                                            <table class="table no-footer dataTable"
                                                                aria-describedby="table_logs_info"
                                                                style="margin-left: 0px; width: 1505.04px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sorting sorting_asc" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 48.7891px;"
                                                                            aria-label="ID: activate to sort column descending"
                                                                            aria-sort="ascending">ID</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 58.7695px;"
                                                                            aria-label="recId: activate to sort column ascending">
                                                                            recId</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 164.59px;"
                                                                            aria-label="recDate: activate to sort column ascending">
                                                                            recDate</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 81.7383px;"
                                                                            aria-label="recType: activate to sort column ascending">
                                                                            recType</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 167.578px;"
                                                                            aria-label="recSubtype: activate to sort column ascending">
                                                                            recSubtype</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 107.676px;"
                                                                            aria-label="recPriority: activate to sort column ascending">
                                                                            recPriority</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 435.059px;"
                                                                            aria-label="recKeywords: activate to sort column ascending">
                                                                            recKeywords</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="table_logs" rowspan="1"
                                                                            colspan="1" style="width: 80.8398px;"
                                                                            aria-label="Screen: activate to sort column ascending">
                                                                            Screen</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; max-height: 600px; height: 600px; width: 100%;">
                                                        <table class="table no-footer dataTable" id="table_logs"
                                                            aria-describedby="table_logs_info" style="width: 100%;">
                                                            <thead>
                                                                <tr style="height: 0px;">
                                                                    <th class="sorting sorting_asc"
                                                                        aria-controls="table_logs" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 48.7891px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="ID: activate to sort column descending"
                                                                        aria-sort="ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">ID
                                                                        </div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 58.7695px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recId: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recId</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 164.59px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recDate: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recDate</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 81.7383px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recType: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recType</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 167.578px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recSubtype: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recSubtype</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 107.676px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recPriority: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recPriority</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 435.059px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="recKeywords: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            recKeywords</div>
                                                                    </th>
                                                                    <th class="sorting" aria-controls="table_logs"
                                                                        rowspan="1" colspan="1"
                                                                        style="width: 80.8398px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                        aria-label="Screen: activate to sort column ascending">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Screen</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="body_table_logs">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id="table_logs_processing" class="dataTables_processing card"
                                                    style="display: none;">Processing...</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="table_logs_info" role="status"
                                                    aria-live="polite">Showing 1 to 10 of 141 entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                    id="table_logs_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button page-item previous disabled"
                                                            id="table_logs_previous"><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="0"
                                                                tabindex="0" class="page-link">Previous</a></li>
                                                        <li class="paginate_button page-item active"><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="1"
                                                                tabindex="0" class="page-link">1</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="2"
                                                                tabindex="0" class="page-link">2</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="3"
                                                                tabindex="0" class="page-link">3</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="4"
                                                                tabindex="0" class="page-link">4</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="5"
                                                                tabindex="0" class="page-link">5</a></li>
                                                        <li class="paginate_button page-item disabled"
                                                            id="table_logs_ellipsis"><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="6"
                                                                tabindex="0" class="page-link">…</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="7"
                                                                tabindex="0" class="page-link">15</a></li>
                                                        <li class="paginate_button page-item next"
                                                            id="table_logs_next"><a href="#"
                                                                aria-controls="table_logs" data-dt-idx="8"
                                                                tabindex="0" class="page-link">Next</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="screen_off_line" class="style-offLine hide-div"> Screen
                                        OffLine
                                    </div>
                                </div>
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

    <script>
        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select a state",
                allowClear: true
                });
        });
    </script>

    <script>
        (function($) {
            $(' #location').change(function(){

            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            var country =  $('#country').val();
            var screen =  null;

            var url = "{{  url('') }}"+ '/get_screen_from_location/?location=' + location ;
            result =" " ;

            $.ajax({
                url: url,
                method: 'GET',
                success:function(response)
                {

                    if(response.screens!= null   )
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

                    /***** refresh datatable **** **/

                },
                error: function(response) {

                }
            })



        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd' // Adjust the format as per your requirement
        });




        })(jQuery);

        $(document).ready(function () {
            var location =  $('#location').val();

            $('#search_content_by_title').keyup(function () {

                /*$('#suggestions').html('<div class="text-center" style="    line-height: 8;">Searching...</div>');
                $('#suggestions').removeClass('hide-search');*/
                var searchText = $(this).val();
                if (searchText.length > 3) {
                    $.ajax({
                        url: 'get_suggestion_cpls', // Path to your PHP script for fetching suggestions
                        method: 'GET',
                        data: {
                            location : location  ,
                            searchText: searchText
                        },
                        success: function (response) {

                            console.log(response)
                            // Display suggestions in the suggestions div
                            var obj = response.cpls ;
                            var box = "";
                            if (obj.length > 0) {
                                for (var i = 0; i < obj.length; i++) {
                                    box += '' +
                                        '<div class="row item_result border-bottom" ' +
                                        'data-id="' + obj[i].uuid + '" ' +
                                        'data-title="' + obj[i].contentTitleText + '"  ' +
                                        'data-property="' + obj[i].contentTitleText + '" style="padding-left: 9px;font-size: 12px">\n' +
                                        '<div class="col-12 results">\n' +
                                        '    <div class="pt-4  ">\n' +
                                        obj[i].contentTitleText +
                                        '    </div>\n' +
                                        '</div> ' +
                                        '</div> ';
                                }
                                $('#suggestions').html(box);
                                $('#suggestions').removeClass('hide-search');
                            } else {
                                $('#search_content_by_title').attr('data-property', null);
                                $('#search_content_by_title').attr('data-id', null);

                                box += '' +
                                        '<div class="row item_result border-bottom" ' +

                                        '" style="padding-left: 9px;font-size: 12px">\n' +
                                        '<div class="col-12 results">\n' +
                                        '    <div class="pt-4  ">\n' +
                                            'No result '+
                                        '    </div>\n' +
                                        '</div> ' +
                                        '</div> ';
                                        $('#suggestions').html(box);
                                        $('#suggestions').removeClass('hide-search');
                               // $('#search_content_by_title').val("");
                            }

                        }
                    });
                } else {
                    $('#search_content_by_title').attr('data-property', null);
                    $('#search_content_by_title').attr('data-id', null);

                    $('#suggestions').addClass('hide-search');
                }

                // Make an Ajax request to fetch suggestions

            });

            // Event listener for the button click to get dates
            $('#search_content').click(function () {
                // Get the values of the 'from' and 'to' inputs
                var fromDate = $('#from').val();
                var toDate = $('#to').val();
                var id_source = $('#list_screens option:selected').val();
                let name_screen = $("#list_screens option:selected").text();
                // Do something with the obtained dates

                var id_content = $('#search_content_by_title').attr('data-id')
                if (id_content === undefined) {
                    id_content=null;
                }
                getListlogs(id_source, name_screen, fromDate, toDate, id_content);
            });
        });

        $(document).on('click', '.item_result', function (event) {
            $('.item_result').not(this).removeClass('selected');
            $(this).toggleClass("selected");

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
