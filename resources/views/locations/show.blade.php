@extends('layouts.app')
@section('title') connexion  @endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title">Locations </h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Location</li>
        </ol>
        </nav>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title "> Location Name : {{ $location->name }} </h4>
                    </div>

                    <div>
                        <a href="{{ route('location.getscreens' , $location) }}" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-refresh btn-icon-prepend"></i> Refresh Screens
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


          <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3>Location Configuration</h3>
                            <p> Location Name : {{ $location->name }} </p>
                            <p>Report Folder Title : {{ $location->folder_title }} </p>
                            <p>Connection IP : {{ $location->connection_ip }} </p>
                            <p>TMS System : {{ $location->tms_system }} </p>
                            <p>Rentrak ID : {{ $location->rentrak_id }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3>Location KDM Receiver</h3>
                            <p> Type : {{ $location->type }} </p>
                            <p>Hostname : {{ $location->hostname }} </p>
                            <p>E-mail Account : {{ $location->email }} </p>
                            <p>Password : {{ $location->password }} </p>
                            <p>Port : {{ $location->port }} </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Contact Informations</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <p> Location E-mail : {{ $location->location_email }} </p>
                                    <p>Phone Number : {{ $location->phone }} </p>
                                    <p>Support E-mail : {{ $location->support_email }} </p>
                                    <p>Modem : {{ $location->modem }} |  {{ $location->modem_value }}  </p>
                                    <p>Internet : {{ $location->internet }} |  {{ $location->internet_value }}  </p>
                                    <p>Address : {{ $location->address }} </p>
                                </div>
                                <div class="col-md-6">
                                    <p>City : {{ $location->city }} </p>
                                    <p>Zip Code : {{ $location->zip }} </p>
                                    <p>Country : {{ $location->country }} </p>
                                    <p>State : {{ $location->state }} </p>
                                    <p>Company / Owner : {{ $location->company }} </p>
                                    <p>Language : {{ $location->language }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>

          <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <h3 class="text-center">Screens</h3>
                                <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                    @foreach ($location->screens as $key=> $screen )
                                        <li class="nav-item">
                                            <a class="nav-link @if($key == 0 )  active @endif" id="{{ $screen->screen_name }}-tab" data-bs-toggle="tab" href="#tab-{{ $screen->id }}" role="tab" aria-controls="{{ $screen->screen_name }}" aria-selected="true"> {{ $screen->screen_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-10" id="content_screen">
                                <div class="tab-content tab-content-vertical">
                                    @foreach ($location->screens as $key=>  $screen )
                                        <div class="tab-pane fade @if($key == 0 ) show active @endif" id="tab-{{ $screen->id }}" role="tabpanel" aria-labelledby="{{ $screen->screen_name }}">
                                            <div class="row">
                                                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                                                    <div>
                                                        <h3 class="">{{ $screen->screen_name }}</h3>
                                                    </div>
                                                    <div>
                                                    <a href="{{ route('spls.get_spls' , [$location->id, $screen->id]) }}" class="btn btn-warning btn-icon-text">
                                                        <i class="mdi mdi-refresh btn-icon-prepend"></i> Get SPLs
                                                    </a>
                                                    <a href="{{ route('cpls.get_cpls' , [$location->id, $screen->id]) }}" class="btn btn-warning btn-icon-text">
                                                        <i class="mdi mdi-refresh btn-icon-prepend"></i> Get CPLs
                                                    </a>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body bg-dark">
                                                            <h3>Screen Infos</h3>
                                                            <p>id_server  : {{ $screen->id_server }}</p>
                                                            <p>Screen Model : {{ $screen->screenModel }}</p>
                                                            <p>Playback  : {{ $screen->playback }}</p>
                                                            <p>Sound : {{ $screen->sound }}</p>
                                                            <p>Server Ip  : {{ $screen->server_ip }}</p>
                                                            <p>Ingest Protocol  : {{ $screen->ingestProtocol_server }}</p>
                                                            <p>Managment IP: {{ $screen->managment_ip }}</p>
                                                            <p>Screen Number  : {{ $screen->screen_number }}  </p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body bg-dark">
                                                            <h3>Projector </h3>
                                                            <p>Projector Enable  : {{ $screen->projector_enable }}</p>
                                                            <p>Projector IP  : {{ $screen->projector_ip }}  </p>
                                                            <p>Projector Brand : {{ $screen->projector_brand }}</p>
                                                            <p>Projector Model : {{ $screen->projector_model }}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body bg-dark">
                                                            <h3>Sound  </h3>
                                                            <p>sound_enable  : @if($screen->sound_enable)   <span class="mdi mdi-power  icon-item text-success"></span> @else  <span class="mdi mdi-power  icon-item"></span> @endif</p>
                                                            <p>Sound IP  : {{ $screen->sound_ip }}  </p>
                                                            <p>Sound Brand : {{ $screen->sound_brand }}</p>
                                                            <p>Sound Model : {{ $screen->sound_model }}</p>
                                                            <p>Audio Enable  : {{ $screen->audio_enable }}</p>
                                                            <p>Audio IP : {{ $screen->audio_ip }}</p>
                                                            <p>Audio Brand : {{ $screen->audio_brand }}</p>
                                                            <p>Audio Model : {{ $screen->audio_model }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <div class="card-body bg-dark">
                                                            <h3>Automation </h3>
                                                            <p>Automation enable : {{ $screen->automation_enable }}</p>
                                                            <p>Automation ip  : {{ $screen->automation_ip }}  </p>
                                                            <p>Automation brand : {{ $screen->automation_brand }}</p>
                                                            <p>Automation model  : {{ $screen->automation_model }}</p>
                                                            <p>Automation username : {{ $screen->automation_username }}</p>
                                                            <p>Automation password  : {{ $screen->automation_password }}</p>
                                                            <p>Enable power control  : {{ $screen->enable_power_control }}  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5 ">
                                                <div class="col-md-12">
                                                    <h3>Powers </h3>
                                                    <div class="row">
                                                        @foreach ($screen->powers as $key=>  $power )
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="card-body bg-dark">
                                                                        <p>Model : {{ $power->model }}</p>
                                                                        <p>IP  : {{ $power->ip }}  </p>
                                                                        <p>Device Name  : {{ $power->device_name }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-xl-12 ">

                                                    <a type="button" href="{{ route('spls.spls_by_screen' , $screen) }}" class="btn btn-success btn-icon-text">
                                                      <i class="mdi mdi-information"></i> Show SPLs
                                                    </a>
                                                    <a type="button" href="{{ route('cpls.cpls_by_screen' , $screen) }}" class="btn btn-success btn-icon-text">
                                                        <i class="mdi mdi-information"></i> Show CPLs
                                                      </a>

                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
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

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('0c2ff678e201c7fe3754', {
      cluster: 'ap1'
    });



    var channel = pusher.subscribe('screen');


    channel.bind('screen', function(data,page_id) {
      //alert(JSON.stringify(data));
      $('#content_screen').load(document.URL +  ' #thisdiv');
      //location.reload(true)
    });





</script>
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


<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
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
</script>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">

<link rel="stylesheet" href="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.css')}}">
@endsection
