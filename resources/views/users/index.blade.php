@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header user-shadow">
        <h3 class="page-title ">Users </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">users</li>
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
    </div>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">

                    <div>
                    <h4 class="card-title ">Users</h4>
                    </div>

                    <div>

                    <a  href="{{ route('users.create') }}" class="btn btn-primary  btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Create user
                    </a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="users-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="sorting text-center  sorting_asc">Order #</th>
                                    <th class="sorting text-center ">Name</th>
                                    <th class="sorting text-center ">Email</th>
                                    <th class="sorting text-center ">Locations</th>
                                    <th class="sorting text-center ">option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user )

                                    <tr class="odd text-center  ">
                                        <td class="sorting_1">{{  $key +1 }} </td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $user->name }} </td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" > {{ $user->email }} </td>
                                        <td><a class="text-body align-middle fw-medium text-decoration-none" > @if($user->locations) @foreach ($user->locations as $location )  <div class="badge badge-outline-primary m-1">  {{ $location->name }} </div> @endforeach @endif </td>


                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6" style="">
                                                    <a class="btn btn-outline-primary dropdown-item edit_user" id="{{ $user->id }}">Edit</a>
                                                    <a class="btn btn-outline-primary dropdown-item delete_user" id="{{ $user->id }}">Delete</a>

                                                </div>
                                              </div>
                                        </td>

                                    </tr>
                                @endforeach

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
<script src="{{ asset('/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
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
})(jQuery);
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
})(jQuery);


    function get_users(location)
    {

        $("#users-listing").dataTable().fnDestroy();
        var loader_content  =
        '<div class="jumping-dots-loader">'
            +'<span></span>'
            +'<span></span>'
            +'<span></span>'
            +'</div>'
        $('#users-listing tbody').html(loader_content)

        var url = "{{  url('') }}"+ '/get_users/' ;
        var result =" " ;

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                location: location,
            },
            success:function(response)
            {
                $.each(response.users, function( index, value ) {
                    var user_locations = "" ;

                    $.each(value.locations, function( index, value ) {

                        user_locations += '<div class="badge badge-outline-primary m-1">' + value.name + '</div>';
                    })

                    index++ ;
                    result = result
                        +'<tr class="odd text-center">'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ index+' </td>'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.name+' </td>'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'+ value.email+' </td>'
                            +'<td><a class="text-body align-middle fw-medium text-decoration-none" style="width: 150px;"> '+ user_locations+'</a></td>'
                            +'<td class="text-body align-middle fw-medium text-decoration-none">'
                                +'<div class="dropdown">'
                                    +'<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>'
                                        +'<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton6" style="">'
                                            +'<a class="btn btn-outline-primary dropdown-item edit_user" id="'+value.id+'">Edit</a>'
                                            +'<a class="btn btn-outline-primary dropdown-item delete_user" id="'+value.id+'">Delete</a>'
                                        +'</div>'
                                +'</div>'
                            +'</td>'
                        +'</tr>';
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
    $('#location').change(function(){

        var location =  $('#location').val();

        get_users(location  )
    });

     //Delete NOC SPLs
    $(document).on('click', '.delete_user', function () {

        var id =  $(this).attr('id');
        var url = '{{  url("") }}'+ '/user/'+id+'/destroy' ;
        var location =  $('#location').val();
        swal({
                showCancelButton: true,
                title: 'User Deletion!',
                text: 'You are sure you want to delete this User',
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
                            get_users(location)
                            swal({
                                title: 'Done!',
                                text: 'Spls Deleted Successfully ',
                                icon: 'success',
                                button: {
                                    text: "Continue",
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




    // fix page hight

    var t = $(window).height();
    $("#content_page").css("height", t - 300);
    $("#content_page").css("max-height", t - 300);
    $("#content_page").css("overflow-y", 'auto');

</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
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
    </style>

@endsection
