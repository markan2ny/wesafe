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
</style>

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
</div>


@endsection