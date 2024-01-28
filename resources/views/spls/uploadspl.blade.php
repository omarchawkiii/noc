@extends('layouts.app')
@section('title') Upload SPL  @endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Upload SPL </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload SPL</li>
        </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Upload SPL</h4>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('nocspl.uploadlocalspl') }}" id="upload_spl_form">
                                <div class="mb-3">
                                    <label for="splfiles" class="form-label">Multiple files input example</label>
                                    <input class="form-control" type="file" id="splfiles" name="splfiles[]" accept="*" multiple="" >
                                </div>
                                <input type="submit" class="btn btn-success btn-icon-text" id="start_upload_spl" />
                            </form>

                        </div>
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
<script src="{{asset('/assets/vendors/sweetalert/sweetalert.min.js')}}"></script>


<!-- -------END  DATA TABLE ---- -->
<script>

    (function($) {
        showSwal = function(type) {
        if (type === 'success-message') {
            swal({
                title: 'Congratulations!',
                text: '',
                icon: 'success',
                button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })

        }

        if (type === 'warning-message-and-cancel') {
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

        }

    })(jQuery);

    (function($) {
        'use strict';
        $( "#upload_spl_form").on( "submit", function( e ) {
            e.preventDefault();
            var file = $('#splfiles')[0].files[0];
           $.ajax({
                url: "{{ route('nocspl.uploadlocalspl') }}",
                type: 'POST',
                method: 'POST',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
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
                success:function(response)
                {

                    if(response == "Success")
                    {
                        swal.close();
                        $('#upload_spl_form').trigger("reset");
                        showSwal('success-message') ;
                    }
                    else
                    {
                        swal.close();
                        showSwal('warning-message-and-cancel')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.close();
                    showSwal('warning-message-and-cancel') ;

                    //console.log(response) ;
                }
            })
        });
    })(jQuery);


</script>


@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-file-upload/uploadfile.css')}}">

<style>
    .ajax-file-upload-container
    {
        min-height: 0;
    }
    .ajax-upload-dragdrop
    {
        padding: 20px ;
    }
    .ajax-file-upload
    {
        margin: 0 ;
    }
</style>
@endsection
