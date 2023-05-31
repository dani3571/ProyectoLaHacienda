@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva reservación</h1>
@endsection

@section('content')

<div class="card">
    <!--<div>
        <p>@foreach ($users as $user )
            {{$user->name}}
            @endforeach
        </p>
        <br>
        <p>@foreach ($mascotas as $mascota )
            {{$mascota->nombre}}
            @endforeach
        </p>
        </br>
    </div>-->
    <div class="card-body">
        <form id="formulario1" method="POST" action="{{route('reservacionHotel.store')}}">
            @csrf 
            <label>Seleccionar cliente:</label>
                <div class="form-group">
                    <select class="form-control" name="usuario_id" id="usuario_id">
                        <option value="">Cliente</option>
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
                <label>Seleccionar mascota:</label>
                <div class="form-group">
                    <select class="form-control" name="mascota_id" id="mascota_id">
                        <option value="">Mascota</option>
                            @foreach ($mascotas as $mascota )
                            <option value="{{$mascota->id}}">{{$mascota->nombre}}</option>
                            @endforeach
                    </select>
                    @error('mascota_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <!--<label>Seleccionar habitación:</label>
                <div class="form-group">
                    <select class="form-control" name="habitacion_id" id="habitacion_id">
                        <option value="">Habitación</option>
                            @foreach ($habitaciones as $habitacion )
                            <option value="{{$habitacion->id}}">{{$habitacion->nro_habitacion}}</option>
                            @endforeach
                    </select>
                    @error('habitacion_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror-->
        <!--<div class="btn-group">
          <a href="" class="btn btn-primary">Registrar Cliente</a>
          <a href="" class="btn btn-primary">Registrar Mascota</a>
        </div>-->
                <input type="text" class="form-control" id="id" name='id' placeholder="id"
                    value="{{ old('nombre') }}">

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>Fecha Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name='fechaIngreso' placeholder="Fecha de Ingreso"
                    value="{{ old('fechaIngreso') }}">

                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha Salida</label>
                <input type="date" class="form-control" id="fechaSalida" name='fechaSalida' placeholder="Fecha de Salida"
                    value="{{ old('fechaSalida') }}">

                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>tratamientos</label>
                <input type="text" class="form-control" id="tratamientos" name='tratamientos' placeholder="tratamientos"
                    value="{{ old('tratamientos') }}">

                    @error('tratamientos')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tranporte</label>
                <input type="number" class="form-control" id="tranporte" name='tranporte' placeholder="tranporte"
                    value="{{ old('tranporte') }}">

                    @error('tranporte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>comida</label>
                <input type="number" class="form-control" id="comida" name='comida' placeholder="comida de la mascota"
                    value="{{ old('comida') }}">

                    @error('comida')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>banioYCorte</label>
                <input type="number" class="form-control" id="banioYCorte" name='banioYCorte' placeholder="banioYCorte de la mascota"
                    value="{{ old('banioYCorte') }}">

                    @error('banioYCorte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tratamiento</label>
                <input type="number" class="form-control" id="tratamiento" name='tratamiento' placeholder="costo de tratamiento"
                    value="{{ old('tratamiento') }}">

                    @error('tratamiento')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>extras</label>
                <input type="number" class="form-control" id="extras" name='extras' placeholder="extras"
                    value="{{ old('extras') }}">

                    @error('extras')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>total</label>
                <input type="number" class="form-control" id="total" name='total' placeholder="total de la mascota"
                    value="{{ old('total') }}" readonly>

                    @error('total')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
                <input type="submit" value="Registrar reservación" class="btn btn-primary" onclick="enviarFormulario()">
     </form>
     <select id="nuevo_id" name="nuevo_id" onchange="actualizarActionURL()">
    <option value="1">Opción 1</option>
    <option value="2">Opción 2</option>
    <option value="3">Opción 3</option>
</select>



<form id="formulario2" action="{{ route('habitacion.asignaReservaHotel', ['id' => '__ID__']) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Seleccionar habitación:</label>
    <div class="form-group">
        <select class="form-control" name="reservacionHotel_id" id="habitacion_id">
            <option value="">Habitación</option>
            @foreach ($habitaciones as $habitacion)
                <option value="{{ $habitacion->id }}">{{ $habitacion->nro_habitacion }}</option>
            @endforeach
        </select>
        @error('reservacionHotel_id')
            <span class="text-danger">
                <span>{{ $message }}</span>
            </span>
        @enderror
    </div>
    <!-- Campo del formulario -->
    <!--<input type="text" name="reservacionHotel_id" value="{{ $habitacion->reservacionHotel_id }}">-->

    <!-- Botón de envío -->
    <button type="button" onclick="enviarFormulario()">Actualizar</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function actualizarActionURL() {
        var nuevoId = $('#nuevo_id').val();
        var url = $('#formulario2').attr('action');
        url = url.replace('__ID__', nuevoId);
        $('#formulario2').attr('action', url);
    }

    function enviarFormulario() {
        var form = $('#formulario2');
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                console.log(response);
                // Aquí puedes realizar cualquier acción adicional después de la actualización exitosa

                // Opcional: Mostrar un mensaje de éxito
                alert('Registro actualizado correctamente.');
            },
            error: function(xhr, textStatus, error) {
                console.error(xhr.statusText);

                // Opcional: Mostrar un mensaje de error
                alert('Ocurrió un error al actualizar el registro.');
            }
        });
    }
</script>

    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/sumartotalesreservacion.js') }}"></script>
@endsection
