@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('styles')


@endsection
@section('content_header')
    <h1>Lista de Mascotas del usuario {{ Auth()->user()->name }}</h1>
@endsection

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('fail'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('fail') }}',
                icon: 'error'
            });
        </script>
    @endif
    @foreach ($mascotas as $mascota)
    <div class="card tarjeta-ancho">
        <div class="card-body d-flex">
          
            <div class="foto-mascota">
                <img style="max-width:190px; max-height: 240px;" src="{{ asset('images/mascotas/' . basename($mascota->image)) }}" class="img-fluid" alt="{{ $mascota->nombre }}">
            </div>
            <div class="datos-mascota">
                <h2 class="card-title">{{ $mascota->nombre }}</h2>
                <div class="card-text columnas-atributos">
                    <div class="columna-atributos">
                        <p><strong>ID:</strong> {{ $mascota->id }}</p>
                        <p><strong>Tipo:</strong> {{ $mascota->tipo }}</p>
                        <p><strong>Raza:</strong> {{ $mascota->raza }}</p>
                        <p><strong>Color:</strong> {{ $mascota->color }}</p>
                
                    </div>
                    <div class="columna-atributos">
                           <p><strong>Fecha de Nacimiento:</strong> {{ $mascota->fechaNacimiento }}</p>
                        <p><strong>Carácter:</strong> {{ $mascota->caracter }}</p>
                        <p><strong>Sexo:</strong> {{ $mascota->sexo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <style>
        .tarjeta-ancho {
            width: 100%;
        }

        .foto-mascota {
            flex: 0 0 200px;
        }

        .card-title {
        font-size: 24px; /* Ajusta el tamaño de la fuente del nombre de la mascota */
        margin-bottom: 10px; /* Añade un espacio entre el título y los datos */
    }

    .card-text p {
        font-size: 18px; /* Ajusta el tamaño de la fuente de los datos */
        margin-bottom: 5px;
    }
    .datos-mascota {
        /* ... tus estilos existentes ... */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .columnas-atributos {
        display: flex;
        flex-wrap: wrap; /* Permite que los atributos se envuelvan a una nueva línea */
    }

    .columna-atributos {
        width: 50%; /* Distribuye los atributos en dos columnas */
    }
    </style>
@endsection

@section('scripts')

@endsection
