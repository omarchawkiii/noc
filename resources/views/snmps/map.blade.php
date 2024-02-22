@extends('layouts.app')
@section('title')
    connexion
@endsection
@section('content')
    <div class="page-header playbck-shadow">
        <h3 class="page-title">Errors </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Errors</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row" id="map-container">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Errors</h4>
                    </div>
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle"
                        onclick="$('#map-container').toggleFullScreen(true)">
                        <i class="mdi mdi-fullscreen" style="font-size: 24px;"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div id="map" class="map" style="height: 73vh"></div>
                </div>



                <div class=" modal fade " id="location_errors" tabindex="-1" role="dialog"
                    aria-labelledby="delete_client_modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered   modal-xl ">
                        <div class="modal-content border-0">
                            <div class="modal-header">
                                <h4>title </h4>
                                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true"
                                        style="color:white;font-size: 26px;line-height: 18px;">×</span></button>
                            </div>
                            <div class="modal-body  p-4">


                            </div>


                        </div>
                    </div>
                    <!--end modal-content-->
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-sm-3 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row bg-success bg-gradient">
                                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                    <i class="icon-lg mdi  mdi-play-box-outline  ml-auto"></i>
                                </div>
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h3 class="mb-0" id="playing_screen"></h3>
                                    </div>
                                    <h6 class="font-weight-normal">Currently Playing</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row bg-info bg-gradient">
                                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                    <i class="icon-lg mdi mdi-stop-circle-outline   ml-auto"></i>
                                </div>
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h3 class="mb-0" id="pause_screen" ></h3>
                                    </div>
                                    <h6 class="font-weight-normal">Currently Pause</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row bg-warning bg-gradient">
                                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                    <i class="icon-lg mdi mdi-alert   ml-auto"></i>
                                </div>
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h3 class="mb-0" id="idle_screen" ></h3>
                                    </div>
                                    <h6 class="font-weight-normal">Currently Idle</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 grid-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="row bg-danger bg-gradient">
                                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                                    <i class="icon-lg mdi  mdi-wifi-off ml-auto"></i>
                                </div>
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h3 class="mb-0" id="offline_screen"></h3>
                                    </div>
                                    <h6 class="font-weight-normal">Currently Offline</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row mt-3">


                <div class="table-responsive">
                    <table id="error_table" class="table">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc text-center">Location</th>
                                <th class="sorting text-center" data-bs-toggle="tooltip" data-placement="right" title="" data-bs-original-title="Missing kdm"><i class="icon-md mdi mdi-key-variant  ml-auto"></i></th>
                                <th class="sorting text-center" data-bs-toggle="tooltip" data-placement="right" title="" data-bs-original-title="Diskusage"><i class="icon-md mdi mdi-chart-pie  ml-auto"></i></th>
                                <th class="sorting text-center" data-bs-toggle="tooltip" data-placement="right" title="" data-bs-original-title="Missing cpl"><i class="icon-md mdi mdi-monitor  ml-auto"></i></th>
                                <th class="sorting text-center" data-bs-toggle="tooltip" data-placement="right" title="" data-bs-original-title="Security Manager Status"><i class="icon-md mdi mdi-camera-rear  ml-auto"></i></th>
                                <th class="sorting text-center" data-bs-toggle="tooltip" data-placement="right" title="" data-bs-original-title="Playback Generale Status"><i class="icon-md mdi mdi-volume-high ml-auto"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

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

    <script src="{{ asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>


    <script src="{{ asset('/assets/js/jquery.fullscreen-min.js') }}"></script>

    <script>
        function getdata(zoomLevel , datacount) {

            var url = "{{ url('') }}" + '/error_map/?data=data&zoomLevel=' + zoomLevel;
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {


                    // Supprimer les anciens marqueurs
                    map.getLayers().forEach(function(layer) {

                        if (layer instanceof ol.layer.Vector) {
                            layer.getSource().clear(); // Efface les features de la source du vecteur
                        }
                    });


                    var zoomLevel = map.getView().getZoom();



                    $.each(response.data_location, function(index, state) {
                        //console.log(response)
                        // Display only states
                        var marker = new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([state.longitude,
                                state.latitude
                            ]))
                        });

                        // Set marker style based on state status
                        var markerStyle = (state.status == 'green') ? greenMarkerStyle : redMarkerStyle;

                        marker.setStyle(markerStyle);

                        var vectorSource = new ol.source.Vector({
                            features: [marker]
                        });

                        var vectorLayer = new ol.layer.Vector({
                            source: vectorSource,
                            content: state.infos,
                            title: state.location
                        });

                        map.addLayer(vectorLayer);

                    })

                    if(datacount)
                    {

                        var data ;
                        console.log(response)
                        $.each(response.data_count, function(index, error) {

                        data +=
                            '<tr class="odd text-center  ">'
                                +'<td class="sorting_1"> '+ error.location+'  </td>'
                                +'<td class="sorting_1"> '+ error.count_missing_kdm_error+'  </td>'
                                +'<td class="sorting_1"> '+ error.count_diskusage+'  </td>'
                                +'<td class="sorting_1"> '+ error.count_missing_cpl_error+'  </td>'
                                +'<td class="sorting_1"> '+ error.count_securityManager+'  </td>'
                                +'<td class="sorting_1"> '+ error.count_playback_generale_status+'  </td>'
                            +'</tr>'

                        })

                        $('#error_table tbody').html(data) ;
                        $('#idle_screen').html(response.idle_screen) ;
                        $('#offline_screen').html(response.offline_screen) ;
                        $('#playing_screen').html(response.playing_screen) ;
                        $('#pause_screen').html(response.pause_screen) ;

                    }
                    //   var data = JSON.parse(response.locations);
                    //   addMarkers(data); // Call function to add markers to the map

                },
                error: function(response) {

                }
            })



        }

        getdata(6 , true);

        var map = new ol.Map({
            target: 'map',

            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM() // Use OpenStreetMap as the base layer
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([102.2655, 4.2105]), // Center the map at Malaysia
                zoom: 6 // Adjust zoom level to focus on Malaysia
            })
        });

        var currZoom = map.getView().getZoom();
        map.on('moveend', function(e) {
            var newZoom = map.getView().getZoom();
            if (currZoom != newZoom) {
                //console.log('zoom end, new zoom: ' + newZoom);
                getdata(newZoom , false);
                currZoom = newZoom;

            }
        });


        var greenMarkerStyle = new ol.style.Style({
            image: new ol.style.Icon({
                src: "{{ url('') }}" +
                '/assets/images/true.png', // URL to the green marker icon provided by OpenLayers
                scale: 0.4, // Adjust the scale as needed

            })
        });

        var redMarkerStyle = new ol.style.Style({
            image: new ol.style.Icon({
                color: 'red',
                src: "{{ url('') }}" +
                '/assets/images/false.png', // URL to the red marker icon provided by OpenLayers
                scale: 0.4, // Adjust the scale as needed

            })
        });


        map.on('click', function(event) {
            map.forEachFeatureAtPixel(event.pixel, function(feature, layer) {
                /*console.log(feature.getId())
                console.log(layer.get('content'))*/

                $('#location_errors .modal-body ').html(layer.get('content'))
                $('#location_errors .modal-header h4 ').html("Errors in location : " + layer.get('title'))
                $('#location_errors').modal('show');

            });
        });
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
@endsection
