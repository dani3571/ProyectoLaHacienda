@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones canceladas - Veterinaria</h1>
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
    <div class="card-header">
        <a class="btn btn-primary" href="{{route('reservas_veterinaria.index')}}">Volver</a>
        
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Hora Recepcion</th>
                    <th>Motivo Reservación</th>
                    <th>usuario_id</th>
                    <th>mascota_id</th>
                    <!--<th>created_at</th>
                    <th>updated_at</th>-->
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_veterinaria as $reserva )
                <tr>
                    <td>{{$reserva->id}}</td>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>{{$reserva->motivoReservacion}}</td>
                    <td>{{$reserva->usuario_id}}</td>
                    <td>{{$reserva->mascota_id}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
