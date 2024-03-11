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

            <div class="row">

                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Transfere content</h4>
                    </div>

                    <div>
                        <button class="btn btn-danger  btn-icon-text" id="delete_file">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Delete
                        </button>
                    </div>

                </div>

                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="files-listing" class="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="sorting sorting_asc">ID File</th>
                                    <th class="sorting">OriginalFileName</th>
                                    <th class="sorting">Size</th>
                                    <th class="sorting">Created Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $key => $file )

                                    <tr class="odd text-center file-item " data-id="{{ $file->id_file }}">
                                        <td class="sorting_1"> {{ $file->id_file }}  </td>
                                        <td class="sorting_1"> {{ $file->OriginalFileName }}  </td>
                                        <td class="sorting_1"> {{ $file->Size }}  </td>
                                        <td class="sorting_1"> {{ $file->date_create_ingest }}  </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

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
