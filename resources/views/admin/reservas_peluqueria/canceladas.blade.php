@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones canceladas - Peluqueria</h1>
@endsection

@section('content')
@if(session('success-create'))
<div class="alert alert-info">
     {{ session('success-create') }}
</div>
@elseif (session('success-update'))
<div class="alert alert-info">
    {{ session('success-update') }}
</div>
@elseif (session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de atencion</th>
                    <th>Hora de atencion</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>motivo</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_peluqueria as $reserva )
                <tr>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>
                        @foreach ($users as $user )
                            @if($user->id == $reserva->usuario_id) 
                                {{$user->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$reserva->motivoCancelacion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('css')
    <style>
        .nav-item {
            background: dark;
        }

        .menu-open {
            background-color: #4d5059 !important;
        }
    </style>
@endsection
