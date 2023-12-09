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
                            <div class="col-12 col-sm-3">
                                <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                    @foreach ($location->screens as $key=> $screen )
                                        <li class="nav-item">
                                            <a class="nav-link @if($key == 0 )  active @endif" id="{{ $screen->name }}-tab" data-bs-toggle="tab" href="#tab-{{ $screen->id }}" role="tab" aria-controls="{{ $screen->name }}" aria-selected="true"> {{ $screen->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-9">
                                <div class="tab-content tab-content-vertical">
                                    @foreach ($location->screens as $key=>  $screen )
                                        <div class="tab-pane fade @if($key == 0 ) show active @endif" id="tab-{{ $screen->id }}" role="tabpanel" aria-labelledby="{{ $screen->name }}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h3>Audiotoriem</h3>
                                                    <p>Screen Name : {{ $screen->name }}</p>
                                                    <p>Seat  : {{ $screen->seat }}</p>
                                                    <p>Api Namespace : {{ $screen->api_namespace }}</p>

                                                </div>
                                                <div class="col-md-3">
                                                    <h3>Screen</h3>
                                                    <p>Screen Type : {{ $screen->type }}</p>
                                                    <p>Masking Movment  : {{ $screen->masking_movement }}</p>
                                                    <p>Screen Size : {{ $screen->screen_h }} | {{ $screen->screen_w }} | {{ $screen->screen_d }} </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <h3>Projector</h3>
                                                    <p>Projector Brand : {{ $screen->projector_brand }}</p>
                                                    <p>Projector Model  : {{ $screen->projector_model }}</p>
                                                    <p>Ip Address LAN  : {{ $screen->projector_ip_lan }}  </p>
                                                    <p>Lens Model : {{ $screen->lens_model }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <h3>Server</h3>
                                                    <p>Server Brand : {{ $screen->server_brand }}</p>
                                                    <p>Server Model  : {{ $screen->server_model }}</p>
                                                    <p>Ip Address LAN  : {{ $screen->server_ip_lan }}  </p>
                                                    <p>Ingest Capabilities : {{ $screen->ingest_capabilities }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <h3>3D System</h3>
                                                    <p>3D Brand : {{ $screen->d_brand }}</p>
                                                    <p>3D Model  : {{ $screen->d_model }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <h3>Automation</h3>
                                                    <p>Automation Brand : {{ $screen->automation_brand }}</p>
                                                    <p>Automation Model  : {{ $screen->automation_model }}</p>
                                                    <p>Ip Address LAN  : {{ $screen->automation_ip_lan }}  </p>
                                                </div>

                                                <div class="col-md-3">
                                                    <h3>Satellite / Live Transmission</h3>
                                                    <p>Satellite Or Live : {{ $screen->satelite_or_live }}</p>
                                                    <p>Transmission Ip Address LAN  : {{ $screen->transmission_ip_lan }}  </p>
                                                    <p>Transmission Brand : {{ $screen->transmission_brand }}</p>
                                                    <p>Transmission Model  : {{ $screen->transmission_model }}</p>
                                                </div>

                                                <div class="col-md-3">
                                                    <h3>Processor</h3>
                                                    <p>Processor Brand : {{ $screen->processor_brand }}</p>
                                                    <p>Processor Model  : {{ $screen->processor_model }}</p>
                                                    <p>Processor Ip Address LAN  : {{ $screen->processor_ip_lan }}  </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <h3>Audio</h3>
                                                    <p>Type : {{ $screen->audio_type }}</p>
                                                    <p>Brand : {{ $screen->audio_brand }}</p>
                                                    <p>Model : {{ $screen->audio_model }}  </p>
                                                    <p>For Channel : {{ $screen->audio_channel }}  </p>
                                                    <p>For Frequency : {{ $screen->audio_frequency }}  </p>
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
