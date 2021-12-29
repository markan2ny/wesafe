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
        justify-content: flex-end;
    }
    .btn-cta {
        border: 1px dashed red;
        padding: 10px 0;
        display: inline-block;
    }
    #map {
        border: 8px solid #fff;
        border-radius: 10px;
        height: 60vh;
    }
</style>

@push('mapbox-style')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>

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
                    <strong>0922-222-2222</strong><br>
                    <strong>0922-222-2222</strong>
                    <p class="text-muted mb-0">Brgy. Puchuchu, Pulilan Bulacan</p>
                </div>
            </div>
            <div class="col-lg-6">
               <div class="message-holder">
                   <a href="#" class="btn-cta">Make a phone call</a>
                   <a href="#" class="btn-cta">Call to messenger</a>
               </div>
            </div>
        </div>
    </div>
<div id='map' class="mt-5 mb-5"></div>

</div>


@endsection

@push('mapbox-script')
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFya2FuMm55IiwiYSI6ImNreHF3aGhzMTU4a3Qyd3BmanUwbmh4anIifQ.aY6MrSmJZlwu2HGMUp0JSQ';

    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, { enableHighAccuracy: true });


    function successLocation(position) {
        setupMap([ position.coords.longitude, position.coords.latitude]);
    }

    function errorLocation() {
        setupMap([120.8458, 14.9124]);
    }

    function setupMap(center) {
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: center,
            zoom: 15
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

    }

  </script>
  
@endpush