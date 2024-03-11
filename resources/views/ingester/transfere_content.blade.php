@extends('layouts.app')
@section('title') Transfere content  @endsection
@section('content')
    <div class="page-header ingester-shadow">
        <h3 class="page-title  ">Transfere content </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transfere content</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row mb-2">
                <div class="  col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <!--<div class="row mt-4">
                                <div class="col-xl-2 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="filter_logs_status">
                                            <option selected="All">All</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Failed">Failed</option>
                                            <option value="Canceled By User">Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-screwdriver"></i></div>
                                        </div>
                                        <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="filter_logs_type">
                                            <option value="All" selected="">All Elements</option>
                                            <option value="DCP">Content Playlist</option>

                                            <option value="SPL"> Show Playlist</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <button class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="details_logs">
                                            Details
                                        </button>

                                    </div>
                                </div>
                                <div class="col-xl-5 ">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="search_logs" placeholder="Search ">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">

                                    <div class="preview-list multiplex" id="div_ingest_logs" style="height: 92px; max-height: 92px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <table class="table " id="table_ingest_logs">
                                                <thead>
                                                <tr>
                                                    <th> State</th>
                                                    <th> File Name</th>
                                                    <th> size</th>

                                                </tr>
                                                </thead>
                                                <tbody id="body_ingest_logs"></tbody>
                                            </table>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="no-file-selected" tabindex="-1" role="dialog" aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Please Select File </h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body minauto">
                    <h4 class="text-center"> No File Selected!</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" style="margin: auto" class="btn btn-secondary btn-fw close"
                            data-bs-dismiss="modal" aria-label="Close">OK
                    </button>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('custom_script')
<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
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


<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="{{asset('/assets/js/tooltips.js')}}"></script>
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

    function displayFileTransfere() {
        $.ajax({
            url: '/noc/ingester/action_contoller',
            method: "POST",
            data: {action_control: "get_transfere_content"},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response)
                try {
                    let box_logs = "";
                    let box_pending = "";
                    var obj = JSON.parse(response);
                    var dcp = obj.dcp;
                    var spl = obj.spl;
                    if (dcp.length === 0) {
                        $('#body_ingest_logs').html("");
                    } else {
                        for (var i = 0; i < dcp.length; i++) {
                            box_logs += '<tr class="item_to_select logs-item" ' +
                                '  data-task_status="' + dcp[i].status + '" ' +
                                ' data-type="DCP"' +
                                '  data-id_cpl="' + dcp[i].cpl_id + '"   style="font-weight: bold">' +
                                '    <td class="status_control">' + getStatusDownload(dcp[i].status) + ' </td>  ' +
                                '    <td>' + dcp[i].cpl_description + '</td>\n' +
                                '    <td></td>\n' +
                                '</tr>';

                        }
                        $('#body_ingest_logs').html(box_logs);
                    }
                    let height_parent = $('.background-content').height();
                    $("#tab2-1").css("max-height", height_parent - 30);
                    $("#tab2-1").css("overflow-y", "auto");
                    $("#tab2-1").css("max-height", height_parent - 30);
                    $("#tab2-1").css("overflow-y", "auto");
                } catch (e) {
                    console.log(e);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            complete: function (jqXHR, textStatus) {
            }
        });
    }
    displayFileTransfere()

    //select element to Delete
    $(document).on('click', '.file-item', function (event) {
        $(this).toggleClass('selected');
    });

    //Delete Files
    $(document).on('click', '#delete_file', function (event) {

        var array_files = [];

        $("#files-listing .file-item.selected").each(function() {
                var id = $(this).data("id");
                array_files.push(id);
            });


        console.log(array_files)
        if (array_files.length ==  0) {
            $("#no-file-selected").modal('show');
        }else{
           var url = "{{  url('') }}"+ '/ingester/delete_transfered_file/';
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    array_files:array_files,

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                },
                success: function (response) {

                    var result ="" ;
                    if(response.screens.length>0)
                    {
                        $.each(response.screens, function( index, value ) {

                            result =  result +
                            '<li>'
                                +'<button type="button" class="btn btn-outline-secondary btn-fw" style="text-align: left;">'
                                    +'<label class="form-check-label custom-check2">'
                                        +'<input type="checkbox" class="form-check-input" name="screen_to_ingest" id="'+value.id+'" value="'+value.id+'" style="font-size: 20px;margin-bottom:  3px">'
                                        +'<span style="font-weight: bold;">'+value.name+'</span> <i class="input-helper"></i>'
                                    +'</label>'
                                +'</button>'
                            +'</li>'

                        });

                        $('#list_servers_cpls_to_delete').html(result)
                        $('#cpl_delete_model').modal('show')

                        $('#confirm_delete_cpl_group').click(function(){
                            alert('tset');
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                }
            });
        }
    });
})(jQuery);
</script>




@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">


@endsection
