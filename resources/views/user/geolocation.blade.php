@extends('layouts.app')

@push('map-style')

@endpush

@section('content')
    
    <div id="map"></div>

@endsection

@push('map-script')
    <script
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly"
    async
    ></script>
    
@endpush