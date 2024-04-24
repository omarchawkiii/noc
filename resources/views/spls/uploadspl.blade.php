@extends('layouts.app')
@section('title')
    Upload
@endsection
@section('content')
    <div class="page-header library-shadow">
        <h3 class="page-title">Upload </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload </li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="upload-spl-tab" data-bs-toggle="tab" href="#upload-spl" role="tab" aria-controls="home" aria-selected="true">Upload Show Playlists</a>
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

                                    <li v-for="(file, index) in files" class="d-flex  flex justify-content-between align-items-center">
                                        <span v-if="typeof file.name !== 'undefined'">
                                            {{ file.name }} ({{ file.size }} b)
                                          </span>
                                        <a @click="removeFile(index)" title="Remove" href="javascript:void(0);"> <i class="mdi mdi-delete-forever"></i></a>
                                    </li>
                                    @endverbatim
                                </ul>


                                <input @click="dropAllFiles()" type="submit" class="btn btn-lg btn-success btn-icon-text" id="start_upload_spl" />

                            </form>
                        </div>
                    </main>
                    <div class="row mt-2">
                        <h3>Show Playlists Uploaded from NOC</h3>
                    </div>
                    <div class="row mt-3 preview-list multiplex">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table id="location-listing" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc">No #</th>
                                            <th class="sorting">Playlist</th>

                                            <th class="sorting">Duration </th>
                                            <th class="sorting">Delete </th>
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

                                    <li v-for="(file, index) in files" class="d-flex flex justify-content-between align-items-center">
                                        <span v-if="typeof file.name !== 'undefined'">
                                            {{ file.name }} ({{ file.size }} b)
                                          </span>
                                        <a @click="removeFile(index)" title="Remove" href="javascript:void(0);" > <i class="mdi mdi-delete-forever"></i></a>
                                    </li>
                                    @endverbatim
                                </ul>
                                <input  @click="dropAllFiles()" type="submit" class="btn btn-lg btn-success btn-icon-text" id="start_upload_spl" />
                            </form>

                        </div>
                    </main>

                    <div class="row mt-3 preview-list multiplex">

                        <div class="row">
                            <h3>KDM Uploaded from NOC</h3>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-3">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-home-map-marker"></i></div>
                                    </div>
                                    <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="location">
                                        <option selected="" value="null">Locations</option>
                                        @foreach ($locations as $location )
                                            <option   value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="mdi mdi-monitor"></i></div>
                                    </div>
                                    <select class="form-select  form-control form-select-sm" aria-label=".form-select-sm example" id="screen">
                                        <option value="null">Screens</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <!--<button id="ingest_kdm" class="btn btn-primary  btn-icon-text " style="float: right">
                                    <i class="mdi mdi-plus btn-icon-prepend"></i> Ingest KDMS
                                </button> -->

                                <button id="delete_all_kdms" class="btn btn-danger  btn-icon-text " style="float: right">
                                    <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Clear List
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <div class="table-responsive">
                                    <table id="kdm-listing" class="table text-center">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_asc">Screen </th>
                                                <th class="sorting">Location</th>
                                                <th class="sorting">Content Name </th>
                                                <th class="sorting">Begin Validity </th>
                                                <th class="sorting">End Validity </th>
                                                <th class="sorting">TMS Ingested</th>
                                                <th class="sorting ">Error / Notes</th>
                                                <th class="sorting ">Action</th>

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
    </div>

    <div class=" modal fade " id="upload_kdm_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Uploaded Kdms infos </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">


                </div>


            </div>
        <!--end modal-content-->
        </div>
    </div>

    <div class=" modal fade " id="upload_spl_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4>Uploaded SPLs infos </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">


                </div>


            </div>
        <!--end modal-content-->
        </div>
    </div>


    <div class=" modal fade " id="ingest_kdm_vide" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"
                            style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                </div>
                <div class="modal-body  p-4">
                    <h3>Please Select one or more KDMs to ingest </h3>
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
    <script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/assets/js/vue.min.js') }}"></script>



    <script>
        var spl_formData = new FormData();

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
                        spl_formData.append('splfiles[]', f);
                    });
                    this.color = "#444444"
                },
                handleFileInput(e) {
                    let files = e.target.files;
                    files = e.target.files
                    if (!files) return;
                    // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                    ([...files]).forEach(f => {
                        spl_formData.append('splfiles[]', f);
                        this.files.push(f);
                    });
                },
                dropAllFiles()
                {
                    $('#app ul').html("");

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
     var kdm_formData = new FormData();
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
                        kdm_formData.append('kdmfiles[]', f);
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
                        kdm_formData.append('kdmfiles[]', f);
                        this.files.push(f);
                    });
                },
                dropAllFiles()
                {
                    $('#app-kdm ul').html("");
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
                        text: 'Spls Uploaded Successfully ',
                        icon: 'success',
                        button: {
                            text: "Continue",
                            value: true,
                            visible: true,
                            className: "btn btn-primary"
                        }
                    })

                }


                if (type === 'success-message-kdm') {
                    swal({
                        title: 'Done!',
                        text: 'Kdms Uploaded Successfully ',
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

                if (type === 'no_kdms_selected') {
                    swal({
                        title: 'No KDMS Selected ',
                        text: "Please Select one or more KDMs to ingest.",
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

                if(spl_formData.get("splfiles[]") != null  ){

                    var file = $('#splfiles')[0].files[0];
                    $.ajax({
                        url: "{{ route('nocspl.uploadlocalspl') }}",
                        type: 'POST',
                        method: 'POST',
                        data: spl_formData,
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
                            if (response.ingest_status.status == 1 )
                            {
                                var result  =" " ;
                                if (response.ingest_errors.length> 0 )
                                {
                                    swal.close();
                                    $('#upload_spl_errors').modal('show') ;
                                    result = "<h4> Failed SPLs Ingest  </h4>" ;
                                    $.each(response.ingest_errors, function( index, value ) {

                                        result = result
                                        +'<p>'
                                            +'<span class="align-middle fw-medium text-danger ">'+value.originalName+' </span>'
                                            +'<span class="align-middle fw-medium text-danger "> Can not be uploaded </span>'
                                        +'</p>';
                                    });

                                    if (response.ingest_success.length> 0 )
                                    {
                                    result = result + "<br /> <br /> <h4>  Succeeded  SPLs Ingest   </h4>" ;
                                        $.each(response.ingest_success, function( index, value ) {

                                            result = result
                                            +'<p>'
                                                +'<span class="align-middle fw-medium text-success">'+value.originalName+' </span>'
                                                +'<span class="align-middle fw-medium text-success" >  Uploaded Successfully </span>'
                                            +'</p>';
                                        });
                                    }


                                    $('#upload_spl_errors .modal-body').html(result) ;
                                    //showSwal('warning-message-and-cancel')
                                    $('#upload_spl_form').trigger("reset");
                                    load_splnoc();


                                } else {

                                    swal.close();
                                    $('#upload_spl_form').trigger("reset");
                                    showSwal('success-message');
                                    load_splnoc();


                                }
                            }
                            else
                            {
                                swal.close();
                                console.log(response.ingest_status.message)
                                swal({
                                    title: 'Failed',
                                    text: "Error occurred while sending the request!.",
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

                            for (var key of spl_formData.keys()) {
                                // here you can add filtering conditions
                                spl_formData.delete(key)
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.close();
                            showSwal('warning-message-and-cancel');

                            //console.log(response) ;
                        }
                    })
                }
                else
                {
                    swal({
                            title: 'Form Is Empty',
                            text: "Please Select One or more SPL  ",
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
            });

            //upload KDMs
            $("#upload_kdm_form").on("submit", function(e) {

                e.preventDefault();
               // var file = $('#kdmfiles')[0].files[0];

                 if(kdm_formData.get("kdmfiles[]") != null  ){


                    $.ajax({
                        url: "{{ route('nockdm.uploadlocalkdm') }}",
                        type: 'POST',
                        method: 'POST',
                        data: kdm_formData,
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
                            var result ;
                            console.log(response) ;
                            if (response.ingest_status.status == 1 )
                            {
                                if (response.ingest_errors.length> 0 )
                                {
                                    swal.close();
                                    $('#upload_kdm_errors').modal('show') ;
                                    result = "<h4> Failed kdms Ingest  </h4>" ;
                                    $.each(response.ingest_errors, function( index, value ) {

                                        result = result
                                        +'<p>'
                                            +'<span class="align-middle fw-medium text-danger ">'+value.originalName+' </span>'
                                            +'<span class="align-middle fw-medium text-danger "> '+value.AnnotationText+' </span>'
                                        +'</p>';
                                    });

                                    if (response.ingest_success.length> 0 )
                                    {
                                    result = result + "<br /> <br /> <h4>  Succeeded  kdms Ingest   </h4>" ;
                                        $.each(response.ingest_success, function( index, value ) {

                                            result = result
                                            +'<p>'
                                                +'<span class="align-middle fw-medium text-success">'+value.originalName+' </span>'
                                                +'<span class="align-middle fw-medium text-success" >'+value.AnnotationText+' </span>'
                                            +'</p>';
                                        });
                                    }


                                    $('#upload_kdm_errors .modal-body').html(result) ;
                                    //showSwal('warning-message-and-cancel')
                                    load_kdmnoc();


                                } else {

                                    swal.close();
                                    $('#upload_kdm_form').trigger("reset");
                                    showSwal('success-message-kdm');
                                    load_kdmnoc();


                                }
                            }
                            else
                            {
                                 swal.close();
                                 console.log(response.ingest_status.message)
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
                            for (var key of kdm_formData.keys()) {
                                // here you can add filtering conditions
                                kdm_formData.delete(key)
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.close();
                            showSwal('warning-message-and-cancel');

                            //console.log(response) ;
                        }
                    })
                }
                else
                {
                    swal({
                            title: 'Form Is Empty',
                            text: "Please Select One or more KDM  ",
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
            });
            function dhm (ms)
            {
                const days = Math.floor(ms / (24*60*60*1000));
                const daysms = ms % (24*60*60*1000);
                const hours = Math.floor(daysms / (60*60*1000));
                const hoursms = ms % (60*60*1000);
                const minutes = Math.floor(hoursms / (60*1000));
                const minutesms = ms % (60*1000);
                const sec = Math.floor(minutesms / 1000);
                return days + "D " + hours + "H " + minutes + "M " + sec  + "S ";
            }


            function load_splnoc()
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

                //$('#location-listing tbody').html('')




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
                                +'<td><a class="text-body align-middle fw-medium text-decoration-none"> <i class="mdi mdi-delete-forever text-danger delete_spl" data-id="'+value.id+'" > </i></a></td>'
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

            function load_kdmnoc(location , screen )
            {
                    $("#kdm-listing").dataTable().fnDestroy();
                    var loader_content  =
                    '<div class="jumping-dots-loader">'
                        +'<span></span>'
                        +'<span></span>'
                        +'<span></span>'
                        +'</div>'
                    $('#kdm-listing tbody').html(loader_content)

                    var url = "{{  url('') }}"+ '/get_nockdm/' ;
                    var result =" " ;
                    var screens  =" " ;
                    console.log(location)
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            location: location,
                            screen: screen,
                        },
                        success:function(response)
                        {

                            console.log(response)
                            if(location != null)
                            {
                                screens = '<option value="null" selected>All Screens</option>';
                                $.each(response.screens, function( index_screen, screen ) {

                                    screens = screens
                                        +'<option  value="'+screen.id+'">'+screen.screen_name+'</option>';
                                });
                                $('#screen').html(screens);
                            }

                            $.each(response.nockdms, function( index, value ) {
                                index++ ;



                                const date1 = new Date();
                                const date2 = new Date(value.ContentKeysNotValidAfter);
                                let diffTime = Math.abs(date2 - date1);

                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                                var background_difftime=""

                                if(diffTime/100/60/60 > 48 )
                                {
                                    background_difftime = "bg-success"
                                }
                                if(diffTime/100/60/60 < 48  && diffTime/100/60/60 > 0 )
                                {
                                    background_difftime = "bg-warning"
                                }
                                if(diffTime/100/60/60 <= 0 )
                                {
                                    background_difftime = "bg-danger"
                                }
                                var tms_ingested ="No" ;
                                if(value.tms_ingested)
                                {
                                    var tms_ingested ='<span class=" text-success " > Yes </span>' ;
                                }
                                else
                                {
                                    var tms_ingested ='<span class=" text-danger " > No </span>' ;
                                }


                                result = result
                                    +'<tr class="odd" data-id="'+value.id+'">'
                                        +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.screen.screen_name+' </td>'
                                        +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.location.name+' </td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="line-height: 22px; width: 10vw; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word;">'+value.name+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidBefore).toLocaleString() +'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ new Date(value.ContentKeysNotValidAfter).toLocaleString() +'</a></td>'

                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+tms_ingested+' </a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+value.error+' </a></td>'
                                        if(value.tms_ingested == 1 )
                                        {
                                            result = result +'<td> <i  data-id="'+value.id+'" style="font-size: 22px; cursor: pointer;" class=" ingest_kdm mdi mdi-upload  btn-icon-prepend text-info"></i>  <i style="font-size: 22px; cursor: pointer;" class=" text-danger mdi mdi-delete-forever btn-icon-prepend delete_kdm" data-id="'+value.id+'"></i> </td>'
                                        }
                                        else
                                        {
                                            result = result +'<td> <i style="font-size: 22px; cursor: pointer;"  class="text-danger mdi mdi-delete-forever btn-icon-prepend delete_kdm" data-id="'+value.id+'"></i> </td>'
                                        }

                                    +'</tr>';
                            });
                            $('#kdm-listing tbody').html(result)

                            console.log(response.nockdms)
                            /***** refresh datatable **** **/

                            var spl_datatable = $('#kdm-listing').DataTable({
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
            load_kdmnoc(null , null )



            function dhm (ms)
            {
                const days = Math.floor(ms / (24*60*60*1000));
                const daysms = ms % (24*60*60*1000);
                const hours = Math.floor(daysms / (60*60*1000));
                const hoursms = ms % (60*60*1000);
                const minutes = Math.floor(hoursms / (60*1000));
                const minutesms = ms % (60*1000);
                const sec = Math.floor(minutesms / 1000);
                return days + "D " + hours + "H " + minutes + "M " + sec  + "S ";
            }




            $('#screen').change(function(){

                var location =  $('#location').val();
                var screen =  $('#screen').val();
                load_kdmnoc(location , screen )
            });

            $('#location').change(function(){
                //$('#location-listing tbody').html('')
                var location =  $('#location').val();
                var screen =null
                load_kdmnoc(location , screen )
            });

            // select kdms to ingest
            /*$(document).on('click', '#kdm-listing tbody tr', function () {
                $(this).toggleClass('selected') ;
            })*/

            // upload existing KDM
            //this functionality was removed because we decided to ingest the KDM automatically
            /*$(document).on('click', '#ingest_kdm', function () {

                var kdms_id = $('#kdm-listing tr.selected').map(function(){
                    return $(this).data('id');
                }).get();

                if(kdms_id.length > 0 )
                {
                    $.ajax({
                        url: "{{ route('nockdm.uploadexistingkdm') }}",
                        type: 'POST',
                        method: 'POST',
                        data: {
                            kdms_id: kdms_id,
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
                            var result ;
                            console.log(response) ;
                            if (response.ingest_errors.length> 0 )
                            {
                                swal.close();
                                $('#upload_kdm_errors').modal('show') ;
                                $.each(response.ingest_errors, function( index, value ) {
                                    result = "<h4> ingested kdms successfully </h4>" ;
                                    result = result
                                    +'<tr class="odd">'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.id+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.AnnotationText+'</a></td>'
                                    +'</tr>';
                                });

                                if (response.ingest_success.length> 0 )
                                {
                                    $.each(response.ingest_errors, function( index, value ) {
                                        result = result + "<h4> Failed kdms Ingest  </h4>" ;
                                        result = result
                                        +'<tr class="odd">'
                                            +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.id+'</a></td>'
                                            +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.AnnotationText+'</a></td>'
                                        +'</tr>';
                                    });
                                }


                                $('#upload_kdm_errors .modal-body').html(result) ;
                                //showSwal('warning-message-and-cancel')



                            } else {

                                swal.close();
                                $('#upload_kdm_form').trigger("reset");
                                showSwal('success-message-kdm');
                                load_kdmnoc();


                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.close();
                            showSwal('warning-message-and-cancel');

                            //console.log(response) ;
                        }
                    })
                }
                else
                {
                    showSwal('no_kdms_selected');
                }

            }) */

            //Delete NOC SPLs
            $(document).on('click', '.delete_spl', function () {

                var id =  $(this).data('id');
                var url = '{{  url("") }}'+ '/localspl/'+id+'/destroy' ;

                swal({
                        showCancelButton: true,
                        title: 'SPL Deletion!',
                        text: 'You are sure you want to delete this spl',
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

                                if(response == 'Success')
                                {
                                    load_splnoc()
                                    swal({
                                        title: 'Done!',
                                        text: 'Spls Deleted Successfully ',
                                        icon: 'success',
                                        button: {
                                            text: "Close",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-primary"
                                        }
                                    })

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
                                swal.close();
                                showSwal('warning-message-and-cancel');

                                //console.log(response) ;
                            }
                        })


                    }

                })

            })

            //Delete NOC KDM
            $(document).on('click', '.delete_kdm', function () {

                var id =  $(this).data('id');

                var url = '{{  url("") }}'+ '/localkdm/'+id+'/destroy' ;

                swal({
                        showCancelButton: true,
                        title: 'KDM Deletion!',
                        text: 'You are sure you want to delete this KDM',
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

                                if(response == 'Success')
                                {
                                    load_kdmnoc()
                                    swal({
                                        title: 'Done!',
                                        text: 'KDM Deleted Successfully ',
                                        icon: 'success',
                                        button: {
                                            text: "Close",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-primary"
                                        }
                                    })
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
                                swal.close();
                                showSwal('warning-message-and-cancel');

                                //console.log(response) ;
                            }
                        })


                    }

                })

            })

            //Delete All KDMs
            $(document).on('click', '#delete_all_kdms', function () {

                var id =  $(this).data('id');
                var url = '{{  url("") }}'+ '/localkdm/delete_all' ;

                swal({
                        showCancelButton: true,
                        title: 'Delete All KDMs !',
                        text: 'You are sure you want to delete All KDMs',
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

                                if(response == 'Success')
                                {
                                    load_kdmnoc()
                                    swal({
                                        title: 'Done!',
                                        text: 'KDMs Deleted Successfully ',
                                        icon: 'success',
                                        button: {
                                            text: "Close",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-primary"
                                        }
                                    })
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
                                swal.close();
                                showSwal('warning-message-and-cancel');

                                //console.log(response) ;
                            }
                        })


                    }

                })

            })

            // Ingest KDM
            $(document).on('click', '.ingest_kdm', function () {

                var kdm_id  = $(this).attr("data-id") ;

                $.ajax({
                    url: "{{ route('nockdm.uploadexistingkdm') }}",
                    type: 'POST',
                    method: 'POST',
                    data: {
                        kdm_id: kdm_id,
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
                        var result ;
                        console.log(response) ;
                        if (response.ingest_errors.length> 0 )
                        {
                            swal.close();
                            $('#upload_kdm_errors').modal('show') ;
                            $.each(response.ingest_errors, function( index, value ) {
                                result = "<h4> ingested kdms successfully </h4>" ;
                                result = result
                                +'<tr class="odd">'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.id+'</a></td>'
                                    +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.AnnotationText+'</a></td>'
                                +'</tr>';
                            });

                            if (response.ingest_success.length> 0 )
                            {
                                $.each(response.ingest_errors, function( index, value ) {
                                    result = result + "<h4> Failed kdms Ingest  </h4>" ;
                                    result = result
                                    +'<tr class="odd">'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none">'+value.id+'</a></td>'
                                        +'<td><a class="text-body align-middle fw-medium text-decoration-none"> '+value.AnnotationText+'</a></td>'
                                    +'</tr>';
                                });
                            }


                            $('#upload_kdm_errors .modal-body').html(result) ;
                            //showSwal('warning-message-and-cancel')
                            load_kdmnoc();


                        } else {

                            swal.close();
                            $('#upload_kdm_form').trigger("reset");
                            showSwal('success-message-kdm');
                            load_kdmnoc();


                        }
                    },

                    success: function(response) {
                        var result ;
                        console.log(response) ;
                        if (response.ingest_status.status == 1 )
                        {
                            if (response.ingest_errors.length> 0 )
                            {
                                swal.close();
                                $('#upload_kdm_errors').modal('show') ;
                                result = "<h4> Failed kdms Ingest  </h4>" ;
                                $.each(response.ingest_errors, function( index, value ) {

                                    result = result
                                    +'<p>'
                                        +'<span class="align-middle fw-medium text-danger ">'+value.originalName+' </span>'
                                        +'<span class="align-middle fw-medium text-danger "> '+value.AnnotationText+' </span>'
                                    +'</p>';
                                });

                                if (response.ingest_success.length> 0 )
                                {
                                result = result + "<br /> <br /> <h4>  Succeeded  kdms Ingest   </h4>" ;
                                    $.each(response.ingest_success, function( index, value ) {

                                        result = result
                                        +'<p>'
                                            +'<span class="align-middle fw-medium text-success">'+value.originalName+' </span>'
                                            +'<span class="align-middle fw-medium text-success" >'+value.AnnotationText+' </span>'
                                        +'</p>';
                                    });
                                }


                                $('#upload_kdm_errors .modal-body').html(result) ;
                                //showSwal('warning-message-and-cancel')
                                load_kdmnoc();


                            } else {

                                swal.close();
                                $('#upload_kdm_form').trigger("reset");
                                showSwal('success-message-kdm');
                                load_kdmnoc();


                            }
                        }
                        else
                        {
                                swal.close();
                                console.log(response.ingest_status.message)
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
                        for (var key of kdm_formData.keys()) {
                            // here you can add filtering conditions
                            kdm_formData.delete(key)
                        }
                    },


                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.close();
                        showSwal('warning-message-and-cancel');

                        //console.log(response) ;
                    }
                })



            })


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
            min-width: 500px;
            margin: auto;
            display: table;
            margin-bottom: 47px;
        }
        #upload_spl_form ul li,
        #upload_kdm_form ul li
        {
            padding: 10px ;
        }
        #upload_spl_form ul a ,
        #upload_kdm_form ul a
        {
            background: red;
            color: white;
            border: none;
        }
        #upload_spl_form ul a i,
        #upload_kdm_form ul a i
        {
            padding: 5px;
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

        .selected {
            background-color: rgb(0 210 91 / 35%) !important;
        }

        .delete_spl ,
        .delete_kdm
        {
            font-size: 20px ;
        }
        .preview-list.multiplex, .fixed-hight
        {
            max-height: 850px !important ;
        }
    </style>
@endsection
