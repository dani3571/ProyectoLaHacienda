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
                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                <label>Hora de entrega estimada (Procure estar puntual)</label><br>
                <input type="time" id="horaEntrega" name="horaEntrega" min="11:00" max="20:00" value="11:00" readonly>
                @error('horaEntrega')
                    <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>

            <div class="form-group">
            <label>Elija servicio</label><br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Corte</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="0" checked>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Baño Simple</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="1">
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Ambos</label>
                    <input class="form-check-input ml-2" type="radio" name='servicio' value="2">
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="corte" name='corte' value="1">
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="BanoSimple" name='BanoSimple' value="0">
            </div>

            <div class="form-group">
            <label>¿Necesita tranquilizante?</label><br> 
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Si</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="1">
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">No</label>
                    <input class="form-check-input ml-2" type="radio" name='tranquilizante' value="0" checked>
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
        function val() {
            var user_id = document.getElementById("usuario_id").value;
            var s = '<option value="">Seleccione la mascota</option>';
            var count = 0;
            @foreach ($mascotas as $mascota)
                if({{ $mascota->usuario_id }} == user_id) {
                    s += '<option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>';
                    count++;
                }
            @endforeach
            if(count < 1){
                s += '<option value="">El cliente no tiene mascotas registradas</option>';
            }

            console.log(user_id);
            const mascota = document.getElementById("mascota_id");
            mascota.innerHTML = s;
        }
    </script>
@endsection