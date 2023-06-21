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
            <div class="form-group">
                <input type="hidden" class="form-control" id="usuario_id" name='usuario_id'
                value="{{ $reservacion_veterinaria->usuario_id }}">
            </div>
            
            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{$mascota->id}}" @if($reservacion_veterinaria->mascota_id == $mascota->id) selected @endif>{{$mascota->nombre}}</option>
                    @endforeach
                </select>
                    @error('mascota')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $reservacion_veterinaria->id }}">
                </div>

            <div class="form-group">
                <label>Fecha de la cita</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ (new DateTime('tomorrow'))-> format('Y-m-d') }}" 
                value="{{ $reservacion_veterinaria->fecha }}" onchange="handler(event);">

                @error('fecha')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Hora de recepción de la mascota</label><br>
                <select class="form-control" id="horaRecepcion" name='horaRecepcion'>
                    <option value="">Seleccione la hora de recepción</option>
                </select>
                @error('horaRecepcion')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Hora de entrega de la mascota estimada (Procure estar puntual)</label><br>
                <input type="text" class="form-control" id="horaEntrega" name="horaEntrega" placeholder = "Seleccione la hora de recepción" value="{{ $reservacion_veterinaria->horaEntrega }}" readonly>
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
    <script src="{{ asset('js/control_eleccion_servicio_peluqueria.js') }}"></script>
    <script>
        if(document.getElementById("fecha").value != ""){
            var fechaReservacionOriginal = document.getElementById("fecha").value;
            controlHorasDisponibles(document.getElementById("fecha").value);
        }
        
        function handler(e){
            controlHorasDisponibles(e.target.value);
        }

        function controlHorasDisponibles(fecha){
            let horas = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00']
            
            @foreach ($reservas_veterinaria as $reserva)
                var fechaReserva = '{{ \Carbon\Carbon::parse($reserva->fecha)->format('Y-m-d') }}';
                if(fechaReserva == fecha){
                    if(fechaReservacionOriginal != fecha){
                        horas.splice(horas.indexOf('{{ $reserva->horaRecepcion }}'), 1)
                    }
                    else if('{{ $reserva->horaRecepcion }}' != '{{ $reservacion_veterinaria->horaRecepcion }}'){
                        horas.splice(horas.indexOf('{{ $reserva->horaRecepcion }}'), 1)
                    }
                }
            @endforeach
            
            var selectOptions = '<option value="">Seleccione la hora de recepción</option>';
            
            if(horas.length > 0){
                horas.forEach(hora => {
                    var isSelected = '{{ $reservacion_veterinaria->horaRecepcion }}' === hora ? 'selected' : '';
                    selectOptions += '<option value="' + hora + '" ' + isSelected + '>' + hora + '</option>';
                });
            }
            else{
                selectOptions += '<option value="">Esta fecha no tiene horarios disponibles</option>';
            }
            const horaRecepcion = document.getElementById("horaRecepcion");
            horaRecepcion.innerHTML = selectOptions;
        }
    </script>
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
