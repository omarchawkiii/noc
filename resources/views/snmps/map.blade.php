@extends('layouts.app')
@section('title') connexion  @endsection
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
            <div class="row">
                <div class="d-flex flex-row justify-content-between mt-2 mb-3">
                    <div>
                        <h4 class="card-title ">Errors</h4>
                    </div>
                </div>
                <div class="col-12">
                    <div id="map" class="map" style="height: 550px"></div>


                </div>
            </div>
        </div>
    </div>


    <div class=" modal fade " id="location_errors" tabindex="-1" role="dialog"  aria-labelledby="delete_client_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  ">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h4 >title </h4>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  p-4">


                </div>


            </div>
        </div>
        <!--end modal-content-->
    </div>

@endsection

@section('custom_script')

<!-- ------- DATA TABLE ---- -->
<script src="{{asset('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<!-- -------END  DATA TABLE ---- -->

<script src="{{asset('/assets/vendors/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>

<script>
    function getdata(zoomLevel)
    {


        var url = "{{  url('') }}"+ '/error_map/?data=data&zoomLevel='+zoomLevel ;
        $.ajax({
            url: url,
            method: 'GET',
            success:function(response)
            {


                 // Supprimer les anciens marqueurs
                map.getLayers().forEach(function (layer) {

                    if (layer instanceof ol.layer.Vector) {
                        layer.getSource().clear(); // Efface les features de la source du vecteur
                    }
                });


                var zoomLevel = map.getView().getZoom();



                $.each(response.data_location, function( index, state ) {
                        console.log(state)
                        // Display only states
                        var marker = new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([state.longitude, state.latitude]))
                        });

                        // Set marker style based on state status
                        var markerStyle = (state.status == 'green') ? greenMarkerStyle : redMarkerStyle;

                        marker.setStyle(markerStyle);

                        var vectorSource = new ol.source.Vector({
                            features: [marker]
                        });

                        var vectorLayer = new ol.layer.Vector({
                            source: vectorSource,
                            content : state.infos ,
                            title : state.location
                        });

                        map.addLayer(vectorLayer);

                })
                //   var data = JSON.parse(response.locations);
                //   addMarkers(data); // Call function to add markers to the map

            },
            error: function(response) {

            }
        })

    }

    getdata(6) ;

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
        if (currZoom != newZoom)
        {
            //console.log('zoom end, new zoom: ' + newZoom);
            getdata(newZoom) ;
            currZoom = newZoom;

        }
    });


    var greenMarkerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            src: "{{  url('') }}"+ '/assets/images/true.png',  // URL to the green marker icon provided by OpenLayers
            scale: 0.4  , // Adjust the scale as needed

        })
    });

    var redMarkerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            color: 'red',
           src: "{{  url('') }}"+ '/assets/images/false.png',  // URL to the red marker icon provided by OpenLayers
            scale: 0.4, // Adjust the scale as needed

        })
    });


    map.on('click', function(event) {
        map.forEachFeatureAtPixel(event.pixel, function(feature,layer) {
            console.log(feature.getId())
            console.log(layer.get('content'))

            $('#location_errors .modal-body ').html(layer.get('content'))
            $('#location_errors .modal-header h4 ').html( "Errors in location : " + layer.get('title'))
            $('#location_errors').modal('show');

        });
    });



</script>


@endsection

@section('custom_css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">



@endsection
