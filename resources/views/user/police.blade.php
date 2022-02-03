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
    }
    #map {
        border: 8px solid #fff;
        border-radius: 10px;
        height: 60vh;
    }
    /* .info-container {
        position: relative;
        background: url('/img/121212.jpg');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 200px;
        overflow: hidden;
        z-index: -1;
    }
    .info-container::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        opacity: .5;
        z-index: 1;

    } */
    .list2 {
        font-size: 20px;
        z-index: 100;
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
            <div class="col-lg-6 d-flex align-items-center py-4">
                <div class="img-holder">
                    <img src="{{ asset('img/police.png')}}" alt="">
                </div>
                <div class="detail-holder ml-4">
                    <h1 id="title">FIRE RESCUE</h1>
                    <h5 id="mobile">Mobile Number</h5>
                    <h6 id="address">Address</h6>
                </div>
            </div>
            <div class="col-lg-6">
               <div class="message-holder">
                   <a href="#" id="makecall" class="btn-cta phone">Make a phone call</a>
               </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mt-1 mb-3">
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Location</label>
                          <select class="form-control" id="location" name="location" data-dependent="barangay">
                            <option selected disabled>--Select Location--</option>
                            @foreach ($stations as $station)
                                @foreach ($station->getLocations as $location)
                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                @endforeach
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">List of Barangay</label>
                            <select multiple class="form-control" id="list2">
                             
                            </select>
                          </div>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div id='map' class="mt-1 mb-5"></div>
        </div>
    </div>

</div>

@endsection

@push('mapbox-script')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

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
  
  <script>
      $(document).ready(function() {

        $(document).on('change', '#location', function() {
            let id = $(this).val();

            $('#title1').empty();
            $('#sub_location').empty();
            $('#sub_location').append(`<option selected disabled>--Select Barangay--</option>`);

            $.ajax({
                type: 'GET',
                url: 'getBarangay/' + id,
                success: function(data){

                    $('#list2').empty();
                    $('#sub_location').empty();
                    $('#sub_location').append(`<option selected disabled>--Select Barangay--</option>`);

                    data.get_barangays.forEach(function(e) {
                        $('#list2').append(`<option value="${e.barangay}" data-mobile="${e.mobile}"class="list2">${e.barangay}</option>`);
                    });
                }
            })
        })

        $('#list2').change(function(){
        var selected = $(this).find('option:selected');
            $('#title').html(selected.text()); 
            $('#address').html(selected.val().toUpperCase()); 
            $('#mobile').html(selected.data('mobile'));
            $("#makecall").attr("href", 'tel:'+selected.data('mobile')); 
        }).change();
      })
  </script>
  
@endpush