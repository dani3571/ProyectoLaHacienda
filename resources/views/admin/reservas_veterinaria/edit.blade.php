@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Modificar Reservación</h1>
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
    <div class="card-body">
        <form method="POST" action="{{ route('reservas_veterinaria.update', $reservacion_veterinaria->id) }}">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id }}" @if($mascota->id == $reservacion_veterinaria->mascota_id) selected @endif>{{ $mascota->nombre }}</option>
                    @endforeach
                </select>
                @error('mascota_id')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Fecha</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ now()->format('Y-m-d') }}" 
                value="{{ $reservacion_veterinaria->fecha }}">

                @error('fecha')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Hora de recepción</label><br>
                <input type="time" id="horaRecepcion" name="horaRecepcion" min="09:00" max="18:00" value="{{ $reservacion_veterinaria->horaRecepcion }}">
                @error('horaRecepcion')
                <span class="text-danger">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Motivo de Reservación</label>
                <input type="text" class="form-control" id="motivoReservacion" name='motivoReservacion' placeholder="Indique el motivo de la reservación"
                value="{{ $reservacion_veterinaria->motivoReservacion }}">

                @error('motivoReservacion')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Modificar Reservación" class="btn btn-primary">
            <a class="btn btn-danger" href="{{ route('reservas_veterinaria.index') }}">Volver</a>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/control_horario.js') }}"></script>
@endsection
