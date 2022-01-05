@extends('layouts.app')

<style>
    * {
        text-decoration: none;
    }
    .lgu-card {
       border: initial !important;
       transition: .3s;
       border-radius: 4px !important;

    }
    .lgu-card:hover {
        transform: scale(1.1);
    }
    .card-header {
        text-align: center;
        font-size: 20px;
    }
    

</style>

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Welcome <strong>{{ Auth::user()->name }}</strong> Thank you for using WeSafe Web Application.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 col mb-5">
                    <a href="{{ route('firefighter') }}">
                        <div class="card lgu-card">
                            <div class="card-header lgu-title">
                                Fire Fighter
                            </div>
                            <div class="card-body ">
                                <img src="{{ asset('/img/fire-truck.png')}}" class="d-block m-auto" width="150" alt="">
                            </div>
                        </div>
                    </a>
                </div>
    
                <div class="col-lg-3 col-md-4 col-sm-12 col mb-5">
                    <a href="{{ route('ambulance')}}">
                        <div class="card lgu-card">
                            <div class="card-header">
                                Ambulance
                            </div>
                            <div class="card-body ">
                                <img src="{{ asset('/img/light.png')}}" class="d-block m-auto" width="150" alt="">
                            </div>
                        </div>
                    </a>
                </div>
               
    
                <div class="col-lg-3 col-md-4 col-sm-12 col mb-5">
                    <a href="{{ route('police') }}">
                        <div class="card lgu-card">
                            <div class="card-header">
                                Police
                            </div>
                            <div class="card-body ">
                                <img src="{{ asset('/img/police-badge.png')}}" class="d-block m-auto" width="150" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-12 col mb-5">
                    <a href="{{ route('sos') }}">
                        <div class="card lgu-card">
                            <div class="card-header">
                                Emergency | SOS
                            </div>
                            <div class="card-body ">
                                <img src="{{ asset('/img/emergency-call.png')}}" class="d-block m-auto" width="150" alt="">
                            </div>
                        </div>
                    </a>
                </div>
    
                {{-- <div class="col-lg-3 col-md-4 col-sm-12 col mb-5">
                    <a href="#">
                        <div class="card lgu-card">
                            <div class="card-header">
                                Geo Location
                            </div>
                            <div class="card-body ">
                                <img src="{{ asset('/img/google-maps.png')}}" class="d-block m-auto" width="150" alt="">
                            </div>
                        </div>
                    </a>
                </div> --}}
               
            </div>
        </div>
    </div>
@endsection