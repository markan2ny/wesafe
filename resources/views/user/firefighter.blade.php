@extends('layouts.app')
<style>
   * {
       box-sizing: border-box;
   }
    .info-container {
        background: #fff;
        margin: 20px 0 10px;
        padding: 10px;
        border-radius: 10px;
    }
    .img-holder {
        padding: 20px;
        border: 2px solid #333;
        border-radius: 100%;
        width: 100px;
        height: 100px;
        overflow: hidden;
    }
    .img-holder img {
        width: 100%;
        object-fit: contain;
    }
    .detail-holder p {
        font-style: italic;
    }
    .message-holder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .btn-cta {
        /* border: 1px dashed red; */
        padding: 15px 20px;
        display: inline-block;
        background: crimson;
        color: #fff;
        border-radius: 24px;
        text-decoration: none !important;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        transition: .3s;
    }
    .btn-cta:hover {
        color: #fff !important;
        padding: 20px 25px;
    }
    #map {
        border: 8px solid #fff;
        border-radius: 10px;
        height: 60vh;
    }
</style>

@push('mapbox-style')
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

<link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

@endpush

@section('content')
<div class="container">
    <div class="info-container">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center py-4 justify-content-center">
                <div class="img-holder">
                    <img src="{{ asset('img/fire-truck.png')}}" alt="">
                </div>
                <div class="detail-holder ml-4">
                    <h3>Pulilan Fire Fighter</h3>
                    <strong>0922-222-2222</strong>
                    <p class="text-muted mb-0">Brgy. Puchuchu, Pulilan Bulacan</p>
                </div>
            </div>
            <div class="col-lg-6">
               <div class="message-holder">
                   <a href="tel:09222222222" class="btn-cta phone">Make a phone call</a>
               </div>
            </div>
        </div>
    </div>
<div id='map' class="mt-1 mb-5"></div>

</div>


@endsection

@push('mapbox-script')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFya2FuMm55IiwiYSI6ImNreHF3aGhzMTU4a3Qyd3BmanUwbmh4anIifQ.aY6MrSmJZlwu2HGMUp0JSQ';

    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, { enableHighAccuracy: true });

    setupMap();

    function successLocation(position) {
        setupMap([ position.coords.longitude, position.coords.latitude]);
    }

    function errorLocation() {
        setupMap([120.865291, 14.9020627]);
    }

    function setupMap(center) {
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: center,
            zoom: 16,
        });

        //Navigator
        const nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'top-right');

        //Directions
        const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        // unit: 'metric',
        // profile: 'mapbox/cycling'
        });
        map.addControl(directions, 'top-left');

        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                enableHighAccuracy: true
                },
                // When active the map will receive updates to the device's location as it changes.
                trackUserLocation: true,
                // Draw an arrow next to the location dot to indicate which direction the device is heading.
                showUserHeading: true
                })
        );

    }

  </script>
  
@endpush