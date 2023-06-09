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
        <form method="POST" action="{{route('reservas_peluqueria.update', $reservacion_peluqueria->id)}}">
            @csrf 

            <div class="form-group">
                <input type="hidden" class="form-control" id="usuario_id" name='usuario_id'
                value="{{ $reservacion_peluqueria->usuario_id }}">
            </div>
            
            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                    <option value="">Seleccione la mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{$mascota->id}}" @if($reservacion_peluqueria->mascota_id == $mascota->id) selected @endif>{{$mascota->nombre}}</option>
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
                    <input type="hidden" name="id" value="{{ $reservacion_peluqueria->id }}">
                </div>

            <div class="form-group">
                <label>Fecha de la cita</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ (new DateTime('tomorrow'))-> format('Y-m-d') }}" 
                value="{{ $reservacion_peluqueria->fecha }}" onchange="handler(event);">

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
                <input type="text" class="form-control" id="horaEntrega" name="horaEntrega" placeholder = "Seleccione la hora de recepción" value="{{ $reservacion_peluqueria->horaEntrega }}" readonly>
            </div>
            
            <div class="form-group">
            <label>Elija el servicio que se le dara a la mascota</label><br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Corte de pelo</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="0" 
                    @if($reservacion_peluqueria->corte == '1' && $reservacion_peluqueria->BanoSimple == '0') checked @endif>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Baño Simple</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="1" 
                    @if($reservacion_peluqueria->BanoSimple == '1' && $reservacion_peluqueria->corte == '0') checked @endif>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Ambos</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="2" 
                    @if($reservacion_peluqueria->corte == '1' && $reservacion_peluqueria->BanoSimple == '1') checked @endif>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="corte" name='corte' value="{{ $reservacion_peluqueria->corte }}">
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="BanoSimple" name='BanoSimple' value="{{ $reservacion_peluqueria->BanoSimple }}">
            </div>

            <div class="form-group">
            <label>¿La mascota necesita tranquilizante?</label><br> 
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Si</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="1" @if($reservacion_peluqueria->tranquilizante == '1') checked @else  @endif>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">No</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="0" @if($reservacion_peluqueria->tranquilizante == '0') checked @else  @endif>
                </div>
                @error('tranquilizante')
                <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Observaciones</label>
                <input type="text" class="form-control" id="Observaciones" name='Observaciones' placeholder="indique sus observaciones"
                value="{{ $reservacion_peluqueria->Observaciones }}">

            </div>

            <input type="submit" value="Modificar Reservación" class="btn btn-primary">
            <a class="btn btn-danger" href="{{route('reservas_peluqueria.index')}}">Volver</a>
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
            
            @foreach ($reservas_peluqueria as $reserva)
                var fechaReserva = '{{ \Carbon\Carbon::parse($reserva->fecha)->format('Y-m-d') }}';
                if(fechaReserva == fecha && fechaReservacionOriginal != fecha){
                    horas.splice(horas.indexOf('{{ $reserva->horaRecepcion }}'), 1)
                }
            @endforeach
            
            var selectOptions = '<option value="">Seleccione la hora de recepción</option>';
            
            if(horas.length > 0){
                horas.forEach(hora => {
                    var isSelected = '{{ $reservacion_peluqueria->horaRecepcion }}' === hora ? 'selected' : '';
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