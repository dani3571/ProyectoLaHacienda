@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Crear Nueva Reservación</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('reservas_peluqueria.store')}}" >
            @csrf 
            

            <!--<div class="form-group">
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
            </div>-->

            <div class="form-group">
                <label>Fecha</label>
                <input type="date" class="form-control" id="fecha" name='fecha' min="{{ now()-> format('Y-m-d') }}" 
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

                @error('Observaciones')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Registrar Reservación" class="btn btn-primary">

     </form>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/control_horario.js') }}"></script>
    <script src="{{ asset('js/control_eleccion_servicio_peluqueria.js') }}"></script>
@endsection