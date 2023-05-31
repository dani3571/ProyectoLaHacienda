@extends('layouts.base')
@section('styles')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endsection