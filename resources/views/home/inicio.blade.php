@extends('layouts.base')

@section('styles')

@endsection

@section('title', 'La Hacienda')

@section('content')

@include('layouts.navbar')
<div class="slogan">
 
    <div class="column1">
        <h2>Reservar</h2>
    </div>
    
    <div class="column2">
        <p>aqui puedes reservar para los siguientes servicios</p>
    </div>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="Cocina.html"><img src="{{asset('images/hotel.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Hoteleria</h4>
                    <button type="button" class="btn btn-outline-dark">Reservar</button>
                </figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="Oficina.html"><img src="{{asset('images/vete.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Veterinaria</h4>
                    <button type="button" class="btn btn-outline-dark">Reservar</button>
                </figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="SetUp.html"><img src="{{asset('images/pelu.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Peluqueria</h4>
                    <button type="button" class="btn btn-outline-dark">Reservar</button>
                </figcaption>
                </figure>
            </div>
        </div>
    </div>
</div>


@endsection