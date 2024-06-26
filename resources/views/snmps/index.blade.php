@extends('layouts.app')
@section('title') Snmp  @endsection
@section('content')
    <div class="page-header playbck-shadow">
        <h3 class="page-title">Snmp </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Snmp</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Snmp</h4>
                    </div>
                    <div>
                        <button id="refresh" class="btn btn-light btn-fw  btn-icon-text"> <i class="mdi mdi-reload btn-icon-prepend"></i> Refresh</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 row">
                        <div class="col-xl-4">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                </div>
                                <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                    <option selected="">Locations</option>
                                    @foreach ($locations as $location )
                                        <option  value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-12">
                    <div class="table-responsive preview-list multiplex">
                        <table id="location-listing" class="table text-center">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">Screen #</th>
                                    <th class="sorting">Date</th>
                                    <th class="sorting">Error Message</th>
                                    <th class="sorting">Device Type </th>
                                    <th class="sorting">Category </th>
                                    <th class="sorting">Error Type</th>
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




@endsection

@section('custom_script')

<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- -------END  DATA TABLE ---- -->



<script>
    function extractTextWithinQuotes(inputText)
    {
        var regex = /"([^"]+)"/g;
        var result = [];
        var match;
        while ((match = regex.exec(inputText)) !== null) {
            result.push(match[1]);
        }
        return result;
    }

    (function($) {

        var spl_datatable = $('#location-listing').DataTable({
        "iDisplayLength": 10,
            destroy: true,
            "bDestroy": true,
            "language": {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }

        });

        function get_snmp(location)
        {

            $("#location-listing").dataTable().fnDestroy();
            var loader_content  =
            '<div class="jumping-dots-loader">'
                +'<span></span>'
                +'<span></span>'
                +'<span></span>'
                +'</div>'
            $('#location-listing tbody').html(loader_content)

             $('#screen').find('option')
            .remove()
            .end()
            .append('<option value="null">All Screens</option>')

            if(location != "Locations")
            {
                var url = "{{  url('') }}"+ '/snmp/?location=' + location ;
                result =" " ;

                $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response)
                    {
                        $.each(response.snmps, function( index, value ) {
                            result = result
                                +'<tr class="odd ">'
                                +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.serverName+' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.snmp_created_at+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;"> '+ extractTextWithinQuotes(value.trap_data)+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.type+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.category+' </i></a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.severity+'</a></td>'
                                +'</tr>';
                        });
                        $('#location-listing tbody').html(result)


                        var spl_datatable = $('#location-listing').DataTable({
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
            else
            {
                $('#location-listing tbody').html('<div id="table_logs_processing" class="dataTables_processing card">Please Select Location</div>')
            }
        }

        $('#location').change(function(){


            //$('#location-listing tbody').html('')
            var location =  $('#location').val();
            get_snmp(location)

        });


        $(document).on('click', '#refresh', function () {
            var location = $('#location').val() ;


            var url ="{{  url('') }}"+ "/refresh_snmp_data/"+location;
            if(location == 'Locations')
            {
                swal({
                        title: '',
                        text: "Please Select Locaion.",
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
            else
            {
                $.ajax({
                        url:url,
                        type: 'get',

                        beforeSend: function () {
                            swal({
                                title: 'Refreshing',
                                closeOnEsc: false,
                                allowOutsideClick: false,
                                timerProgressBar: true,
                                onOpen: () => {
                                    swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            swal.close();
                            if(response.status)
                            {
                                swal({
                                        title: 'Done !',
                                        text: 'Data Refreshed Successfully ',
                                        icon: 'success',
                                        button: {
                                            text: "Ok",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-primary"
                                        }
                                    })
                                    get_snmp(location)

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
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        complete: function(jqXHR, textStatus) {}
                });
            }
        });

    })(jQuery);
</script>

<script>
    let content_height = document.querySelector('.content-wrapper').offsetHeight;
    let navbar_height = document.querySelector('.navbar').offsetHeight;
    //let footer_height = document.querySelector('.footer').offsetHeight;
    let page_header_height = document.querySelector('.page-header ').offsetHeight;
    let content_max_height = content_height - navbar_height - page_header_height - 150;
    $(".multiplex").height(content_max_height);
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /*$(".preview-item").click(function() {
        $(this).toggleClass("selected");
    });*/
</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">

<style>
    .dataTables_processing.card,
    .jumping-dots-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
</style>

@endsection
