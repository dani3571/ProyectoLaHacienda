@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Crear Nueva Reservación</h1>
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
        <form method="POST" action="{{route('reservas_veterinaria.store')}}" >
            @csrf 
            

            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota )
                        <option value="{{$mascota->id}}">{{$mascota->nombre}}</option>
                    @endforeach
                </select>
                    @error('tipo')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>Fecha</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ (new DateTime('tomorrow'))-> format('Y-m-d') }}" 
                value="{{ old('fecha') }}">

                @error('fecha')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Hora de recepción</label><br>
                <input type="time" id="horaRecepcion" name="horaRecepcion" min="09:00" max="18:00" value="09:00">
                @error('horaRecepcion')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Motivo de Reservacion</label>
                <input type="text" class="form-control" id="motivoReservacion" name='motivoReservacion' placeholder="indique el motivo de reservacion"
                value="{{ old('motivoReservacion') }}">

                @error('motivoReservacion')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            
            <input type="submit" value="Registrar Reservación" class="btn btn-primary">
            <a class="btn btn-danger" href="{{route('reservas_veterinaria.index')}}">Volver</a>
     </form>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/control_horario.js') }}"></script>
@endsection