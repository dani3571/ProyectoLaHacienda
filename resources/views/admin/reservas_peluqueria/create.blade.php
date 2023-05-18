@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Crear Nueva Reservación</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('reservas_peluqueria.store')}}" method="POST" >
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
                <label>Hora de recepción</label>
                <select class="form-control" id="horaRecepcion" name='horaRecepcion' value="{{ old('horaRecepcion') }}">
                    <option value="">Seleccione la hora de recepción</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    
                </select>
                    @error('horaRecepcion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Hora de entrega estimada (Procure estar puntual)</label>
                <select class="form-control" id="horaEntrega" name='horaEntrega' readonly value="{{ old('horaEntrega') }}">
                    <option value="">Seleccione la hora de recepción</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    
                </select>
                    @error('horaEntrega')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>

            
            
            
            <div class="form-group">
            <label>Baño simple</label><br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Si</label>
                    <input class="form-check-input ml-2" type="radio" name='BanoSimple' value="1">
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">No</label>
                    <input class="form-check-input ml-2" type="radio" name='BanoSimple' value="0" checked>
                </div>
                @error('BanoSimple')
                <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror

            </div>

            <div class="form-group">
            <label>Corte</label><br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Si</label>
                    <input class="form-check-input ml-2" type="radio" name='corte' value="1">
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">No</label>
                    <input class="form-check-input ml-2" type="radio" name='corte' value="0" checked>
                </div>
                @error('corte')
                <span class="text-danger">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
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
@endsection