@extends('layouts.app')
@section('title')
    Upload SPL
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Upload </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload SPL</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="upload-spl-tab" data-bs-toggle="tab" href="#upload-spl" role="tab" aria-controls="home" aria-selected="true">Upload SPL</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="upload-kdm-tab" data-bs-toggle="tab" href="#upload-kdm" role="tab" aria-controls="profile" aria-selected="false">Upload KDM</a>
                </li>

              </ul>

              <div class="tab-content">
                <div class="tab-pane fade show active" id="upload-spl" role="tabpanel" aria-labelledby="home-tab">

                    <main>
                        <div id="app" @dragover.prevent @drop.prevent>
                            <form method="POST" action="{{ route('nocspl.uploadlocalspl') }}" id="upload_spl_form">
                                <div style="background-color: #000 ; margin-bottom: 47px;" class="d-flex justify-content-center align-items-center" @dragleave="fileDragOut" @dragover="fileDragIn" @drop="handleFileDrop" @drop="fileDragOut" >

                                    <br>
                                    <div class="file-wrapper">
                                        <input type="file" name="splfiles[]" id="splfiles" multiple="True" @change="handleFileInput" style="position: absolute; height: 100%; width: 100%; z-index : 999" accept="*" multiple="" >
                                         <h3 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50% ); width: 100%">Click or drag to insert.</h3>
                                    </div>

                                </div>
                                <ul class="">
                                    @verbatim

                                    <li v-for="(file, index) in files" class="d-flex justify-content-between align-items-center">
                                        <span v-if="typeof file.name !== 'undefined'">
                                            {{ file.name }} ({{ file.size }} b)
                                          </span>
                                        <button @click="removeFile(index)" title="Remove"> <i class="mdi mdi-delete-forever"></i></button>
                                    </li>
                                    @endverbatim
                                </ul>


                                <input type="submit" class="btn btn-lg btn-success btn-icon-text" id="start_upload_spl" />

                            </form>
                        </div>
                    </main>

                    <div class="row mt-3 preview-list multiplex">
                        <div class="col-12">
                            <h5>SPL Uploaded from NOC</h5>
                            <div class="table-responsive">
                                <table id="location-listing" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc">No #</th>
                                            <th class="sorting">Playlist</th>

                                            <th class="sorting">Duration </th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="upload-kdm" role="tabpanel" aria-labelledby="profile-tab">
                    <main>
                        <div id="app-kdm" @dragover.prevent @drop.prevent>
                            <form method="POST" action="{{ route('nockdm.uploadlocalkdm') }}" id="upload_kdm_form">
                                <div style="background-color: #000 ; margin-bottom: 47px;" class="d-flex justify-content-center align-items-center" @dragleave="fileDragOut" @dragover="fileDragIn" @drop="handleFileDrop" @drop="fileDragOut" >
                                    <br>
                                    <div class="file-wrapper">
                                        <input type="file" id="kdmfiles" name="kdmfiles[]" multiple="True" @change="handleFileInput" style="position: absolute; height: 100%; width: 100%; z-index : 999" >
                                         <h3 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50% ); width: 100%">Click or drag to insert.</h3>
                                    </div>

                                </div>
                                <ul class="">
                                    @verbatim

                                    <li v-for="(file, index) in files" class="d-flex justify-content-between align-items-center">
                                        <span v-if="typeof file.name !== 'undefined'">
                                            {{ file.name }} ({{ file.size }} b)
                                          </span>
                                        <button @click="removeFile(index)" title="Remove"> <i class="mdi mdi-delete-forever"></i></button>
                                    </li>
                                    @endverbatim
                                </ul>
                                <input type="submit" class="btn btn-lg btn-success btn-icon-text" id="start_upload_spl" />
                            </form>

                        </div>
                    </main>
                </div>

              </div>

        </div>
    </div>
@endsection

@section('custom_script')
    <!-- ------- DATA TABLE ---- -->
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>



    <script>
        var app = new Vue({
            el: '#app',
            data: {
                files: [],
                color: '#444444',
            },
            methods: {
                handleFileDrop(e) {
                    let droppedFiles = e.dataTransfer.files;
                    if (!droppedFiles) return;
                    // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                    ([...droppedFiles]).forEach(f => {

                        this.files.push(f);
                    });
                    this.color = "#444444"
                },
                handleFileInput(e) {
                    let files = e.target.files;
                    files = e.target.files
                    if (!files) return;
                    // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                    ([...files]).forEach(f => {

                        this.files.push(f);
                    });
                },
                removeFile(fileKey) {
                    this.files.splice(fileKey, 1)
                },
                fileDragIn() {
                    // alert("oof")
                    // alert("color")
                    this.color = "white"
                },
                fileDragOut() {
                    this.color = "#444444"
                }
            }
        })
    </script>
    <script>
        var app = new Vue({
            el: '#app-kdm',
            data: {
                files: [],
                color: '#444444',
            },
            methods: {
                handleFileDrop(e) {
                    let droppedFiles = e.dataTransfer.files;
                    if (!droppedFiles) return;
                    // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                    ([...droppedFiles]).forEach(f => {

                        this.files.push(f);
                    });
                    this.color = "#444444"
                },
                handleFileInput(e) {
                    let files = e.target.files;
                    files = e.target.files
                    if (!files) return;
                    // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                    ([...files]).forEach(f => {

                        this.files.push(f);
                    });
                },
                removeFile(fileKey) {
                    this.files.splice(fileKey, 1)
                },
                fileDragIn() {
                    // alert("oof")
                    // alert("color")
                    this.color = "white"
                },
                fileDragOut() {
                    this.color = "#444444"
                }
            }
        })
    </script>
    <!-- -------END  DATA TABLE ---- -->
    <script>
        (function($) {
            showSwal = function(type) {
                if (type === 'success-message') {
                    swal({
                        title: 'Done!',
                        text: 'Spls Uploaded S8uccessfully ',
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

            //upload spl
            $("#upload_spl_form").on("submit", function(e) {
                e.preventDefault();
                var file = $('#splfiles')[0].files[0];
                $.ajax({
                    url: "{{ route('nocspl.uploadlocalspl') }}",
                    type: 'POST',
                    method: 'POST',
                    data: new FormData(this),
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
                    success: function(response) {

                        if (response == "Success") {
                            swal.close();
                            $('#upload_spl_form').trigger("reset");
                            showSwal('success-message');
                        } else {
                            swal.close();
                            showSwal('warning-message-and-cancel')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.close();
                        showSwal('warning-message-and-cancel');

                        //console.log(response) ;
                    }
                })
            });

            //upload KDMs
            $("#upload_kdm_form").on("submit", function(e) {
                e.preventDefault();
                var file = $('#kdmfiles')[0].files[0];
                $.ajax({
                    url: "{{ route('nockdm.uploadlocalkdm') }}",
                    type: 'POST',
                    method: 'POST',
                    data: new FormData(this),
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
                    success: function(response) {
                        console.log(response) ;
                        if (response == "Success") {
                            swal.close();
                            $('#upload_kdm_form').trigger("reset");
                            showSwal('success-message');
                        } else {
                            swal.close();
                            showSwal('warning-message-and-cancel')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.close();
                        showSwal('warning-message-and-cancel');

                        //console.log(response) ;
                    }
                })
            });



           function load_splnoc(){

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

                //$('#location-listing tbody').html('')


                window.lms = false ;

                if(location != "Locations")
                {
                    $('#refresh_lms').show();
                }
                else
                {
                    $('#refresh_lms').hide();
                }
                var url = "{{  url('') }}"+ '/get_nocspl/' ;
                var result =" " ;

                $.ajax({
                    url: url,
                    method: 'GET',
                    success:function(response)
                    {

                        console.log(response)
                        $.each(response.nocspls, function( index, value ) {
                            index++ ;



                            result = result
                                +'<tr class="odd">'
                                +'<td class="sorting_1">'+index +' </td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.spl_title+'</a></td>'
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.duration+'</a></td>'
                                +'</tr>';
                        });
                        $('#location-listing tbody').html(result)

                        console.log(response.spls)
                        /***** refresh datatable **** **/

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
            load_splnoc()


        })(jQuery);
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/jquery-file-upload/uploadfile.css') }}">

    <style>
        .ajax-file-upload-container {
            min-height: 0;
        }

        .ajax-upload-dragdrop {
            padding: 20px;
        }

        .ajax-file-upload {
            margin: 0;
        }

        #start_upload_spl
        {
            margin: auto ;
            display: table ;

        }
        #upload_spl_form,
        #upload_kdm_form
        {
            min-height: 250px;
            background: #000;
            padding: 25px;
            border : 6px dashed #d2d2d2 !important ;
        }
        #app,
        #app-kdm
        {
            padding: 25px;
            background: #000;
        }
        #upload_spl_form ul,
        #upload_kdm_form ul
        {
            list-style: none;
            text-align: center;
            color:  #e8e6e6 ;
            font-size: 16px;
            margin-top: 10px;
            text-align: left;
            min-width: 321px;
            margin: auto;
            display: table;
            margin-bottom: 47px;
        }
        #upload_spl_form ul li,
        #upload_kdm_form ul li
        {
            padding: 10px ;
        }
        #upload_spl_form ul button ,
        #upload_kdm_form ul button
        {
            background: red;
            color: white;
            border: none;
        }
        .card
        {

        }
main {
  margin-top: 30px;
  height: 100%;
}
.container {
  border: 2px dashed pink;
  min-height: 150px;
}

.file-wrapper {
  text-align: center;
  width: 300px;
  height: 5em;
  vertical-align: middle;
  display: table-cell;
  position: relative;
  overflow: hidden;
  background: #122c4e; /* and other things to make it pretty */
}


.file-wrapper input {

    right: 0; /* not left, because only the right part of the input seems to
                 be clickable in some browser I can't remember */
    cursor: pointer;
    opacity: 0.0;
    filter: alpha(opacity=0); /* and all the other old opacity stuff you
                                 want to support */

}

    </style>
@endsection
