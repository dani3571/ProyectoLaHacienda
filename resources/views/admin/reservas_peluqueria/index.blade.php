@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Reservaciones Peluqueria</h1>
@endsection

@section('content')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Éxito',
        text: '{{ session('success') }}',
        icon: 'success'
    });
</script>
@endif
@if(session('fail'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Error!',
        text: '{{ session('fail') }}',
        icon: 'error'
    });
</script>
@endif

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{route('reservas_peluqueria.create')}}">Registrar Reservación</a>
        <a class="btn btn-secondary" href="{{route('reservas_peluqueria.canceladas')}}">Reservaciones Canceladas</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora Recepcion</th>
                    <th>Hora Entrega</th>
                    <th>corte</th>
                    <th>Baño simple</th>
                    <th>tranquilizante</th>
                    <th>observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservas_peluqueria as $reserva )
                <tr>
                
                    <td>{{$reserva->id}}</td>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>{{$reserva->horaEntrega}}</td>
                    <td>@if($reserva->corte == '1') Si @else No @endif</td>
                    <td>@if($reserva->BanoSimple == '1') Si @else No @endif</td>
                    <td>@if($reserva->tranquilizante == '1') Si @else No @endif</td>
                    <td>{{$reserva->Observaciones}}</td>
                    
  
  
                    <td width="10px"><a href="{{route('reservas_peluqueria.edit', $reserva)}}" class="btn btn-primary btn-sm mb-2">Editar</a></td>

                    <td width="10px">
                       
                        <form action="{{ route('reservas_peluqueria.cancelar', $reserva->id) }}" method="POST">
                            @csrf
                            @method('PUT')      
                            <input type="submit" value="Cancelar" class="btn btn-danger btn-sm">
                        </form>

                    </td>
                </tr>
                
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
