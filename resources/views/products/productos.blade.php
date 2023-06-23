@extends('layouts.base')

@section('styles')

 <link rel="stylesheet" href="{{ asset('css/base/css/producto.css') }}">


@endsection

@section('title', 'La Hacienda')

@section('content')

    @include('layouts.navbar')
    <div class="article-container">
        <!-- Listar artículos la variable articles la sacamos del controlador-->

    </div>

    <div class="article-container">
        <!-- Listar artículos la variable articles la sacamos del controlador-->
        @foreach ($productos as $producto)
            <article class="article">
                <div class="card-body">
                    <h2 class="title">{{ Str::limit($producto->nombre, 60, '...') }}</h2>
                    <img src="{{ asset('images/productos/' . basename($producto->image)) }}" alt="Imagen del producto"  width="100" height="100">
                    <div class="card-body">
                        <h2 class="title">{{ Str::limit($producto->precio, 60, '...') }}</h2>
                        <p class="introduction">{{ Str::limit($producto->descripcion, 30, '...') }}</p>
                    </div>
                </div>
            </article>
        @endforeach

    </div>

@endsection
