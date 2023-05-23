@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva reservación</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('reservacionHotel.update', $reservacionHotel->id) }}">
        @csrf 
            @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $reservacionHotel->id }}">
                </div> 
                <div class="form-group">
                <label>No id:</label>
                <p>{{ $reservacionHotel->id }}<p>
                <div class="form-group">
          <label for="client-select">Seleccionar cliente:</label>
          <select class="form-control" id="client-select">
            <option value="cliente1">Cliente 1</option>
            <option value="cliente2">Cliente 2</option>
            <option value="cliente3">Cliente 3</option>
          </select>
        </div>
        <div class="form-group">
          <label for="pet-select">Seleccionar mascota:</label>
          <select class="form-control" id="pet-select">
            <option value="mascota1">Mascota 1</option>
            <option value="mascota2">Mascota 2</option>
            <option value="mascota3">Mascota 3</option>
          </select>
        </div>
        <div class="btn-group">
          <a href="" class="btn btn-primary">Registrar Cliente</a>
          <a href="" class="btn btn-primary">Registrar Mascota</a>
        </div>
            <!--<div class="form-group">
                <label>No</label>
                <input type="text" class="form-control" id="id" name='id' placeholder="id"
                value="{{ $reservacionHotel->id }}">

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> -->
            <div class="form-group">
                <label>Fecha Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name='fechaIngreso' placeholder="Fecha de Ingreso"
                value="{{ $reservacionHotel->fechaIngreso }}">

                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha Salida</label>
                <input type="date" class="form-control" id="fechaSalida" name='fechaSalida' placeholder="Fecha de Salida"
                value="{{ $reservacionHotel->fechaSalida }}">

                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>tratamientos</label>
                <input type="text" class="form-control" id="tratamientos" name='tratamientos' placeholder="tratamientos"
                value="{{ $reservacionHotel->tratamientos }}">

                    @error('tratamientos')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tranporte</label>
                <input type="number" class="form-control" id="tranporte" name='tranporte' placeholder="tranporte"
                value="{{ $reservacionHotel->tranporte }}">

                    @error('tranporte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>comida</label>
                <input type="number" class="form-control" id="comida" name='comida' placeholder="comida de la mascota"
                value="{{ $reservacionHotel->comida }}">

                    @error('comida')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>banioYCorte</label>
                <input type="number" class="form-control" id="banioYCorte" name='banioYCorte' placeholder="banioYCorte de la mascota"
                value="{{ $reservacionHotel->banioYCorte }}">

                    @error('banioYCorte')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>tratamiento</label>
                <input type="number" class="form-control" id="tratamiento" name='tratamiento' placeholder="costo de tratamiento"
                value="{{ $reservacionHotel->tratamiento }}">

                    @error('tratamiento')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>extras</label>
                <input type="number" class="form-control" id="extras" name='extras' placeholder="extras"
                value="{{ $reservacionHotel->extras }}">

                    @error('extras')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>total</label>
                <input type="number" class="form-control" id="total" name='total' placeholder="total de la mascota"
                value="{{ $reservacionHotel->total }}" readonly>

                    @error('total')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
                <label>usuario_id </label>
                <div class="form-group">
                    <select class="form-control" name="usuario_id" id="usuario_id">
                        <option value="{{ $reservacionHotel->usuario_id }}">Seleccione el tipo</option>
                   
                            <option value="1">1</option>
                            <option value="2">2</option>
            
                    </select>
                    @error('usuario_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <input type="submit" value="Registrar reservación" class="btn btn-primary">
     </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/sumartotalesreservacion.js') }}"></script>
@endsection