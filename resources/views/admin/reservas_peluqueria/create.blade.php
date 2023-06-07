@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar Nueva Reservación</h1>
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
        <form method="POST" action="{{route('reservas_peluqueria.store')}}" >
            @csrf 

            <div class="form-group">
                <label>Cliente</label>
                <select class="form-control" id="usuario_id" name='usuario_id' onchange="val()">
                    <option value="">Seleccione al cliente</option>
                    @foreach ($users as $user )
                        <option value="{{$user->id}}" {{ old('usuario_id') == $user->id ? "selected" : "" }}>{{$user->name}}</option>
                    @endforeach
                </select>
                    @error('usuario_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>Mascota</label>
                <select class="form-control" id="mascota_id" name='mascota_id'>
                <option value="">Seleccione la mascota</option>
                </select>
                    @error('mascota_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>Fecha de la cita</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ (new DateTime('tomorrow'))-> format('Y-m-d') }}" 
                value="{{ old('fecha') }}" onchange="handler(event);">

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
                <input type="text" class="form-control" id="horaEntrega" name="horaEntrega" placeholder = "Seleccione la hora de recepción" readonly>
                
            </div>

            <div class="form-group">
            <label>Elija el servicio que se le dara a la mascota</label><br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Corte</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="0" {{ old('servicio') == 0 ? "checked" : "" }}>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Baño Simple</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="1" {{ old('servicio') == 1 ? "checked" : "" }}>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Ambos</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="2" {{ old('servicio') == 2 ? "checked" : "" }}>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="corte" name='corte' value="1">
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="BanoSimple" name='BanoSimple' value="0">
            </div>

            <div class="form-group">
            <label>¿La mascota necesita tranquilizante?</label><br> 
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Si</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="1"{{ old('tranquilizante') == 1 ? "checked" : "" }}>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">No</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="0"{{ old('tranquilizante') == 0 ? "checked" : "" }}>
                </div><br> 
                @error('tranquilizante')
                <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Observaciones</label>
                <input type="text" class="form-control" id="Observaciones" name='Observaciones' placeholder="indique sus observaciones"
                value="{{ old('Observaciones') }}">

           
            </div>

            <input type="submit" value="Registrar Reservación" class="btn btn-primary">
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
            controlHorasDisponibles(document.getElementById("fecha").value);
        }
        console.log(document.getElementById("usuario_id").value);
        if(document.getElementById("usuario_id").value != ""){
            val();
        }


        function val() {
            var user_id = document.getElementById("usuario_id").value;
            var selectOptions = '<option value="">Seleccione la mascota</option>';
            var count = 0;
            @foreach ($mascotas as $mascota)
                if({{ $mascota->usuario_id }} == user_id) {
                    selectOptions += '<option value="{{ $mascota->id }}" {{ old("mascota_id") == $mascota->id ? "selected" : "" }}>{{ $mascota->nombre }}</option>'; 
                    count++;
                }
            @endforeach
            if(count < 1){
                selectOptions += '<option value="">El cliente no tiene mascotas registradas</option>';
            }
            const mascota = document.getElementById("mascota_id");
            mascota.innerHTML = selectOptions;
        }
        function handler(e){
            controlHorasDisponibles(e.target.value);
        }

        function controlHorasDisponibles(fecha){
            let horas = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00']
            @foreach ($reservas_peluqueria as $reserva)
                var fechaReserva = '{{ \Carbon\Carbon::parse($reserva->fecha)->format('Y-m-d') }}';
                if(fechaReserva == fecha){
                    horas.splice(horas.indexOf('{{ $reserva->horaRecepcion }}'), 1)
                }
            @endforeach

            var selectOptions = '<option value="">Seleccione la hora de recepción</option>';
            if(horas.length > 0){
                horas.forEach(hora => {
                    selectOptions += '<option value="' + hora + '">' + hora + '</option>';
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