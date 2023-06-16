@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Registrar nueva reservación</h1>
@endsection

@section('content')
<div class="card">
    <div id="factura" class="card-body">
        <form method="POST" action="{{ route('habitacion.update', $habitacion->id) }}">
        @csrf 
            @method('PUT')
                <div class="form-group">
                    <br><p>{{ $habitacion->id }}</p>
                </div> 
            <div class="form-group">
                <label>No</label>
                <br><p>{{ $habitacion->id }}</p>

                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            
            <div class="form-group">
                <label>nro_habitacion</label>
                <br><p>{{ $habitacion->nro_habitacion }}</p>

                    @error('nro_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>costo_habitacion</label>
                <br><p>{{ $habitacion->costo_habitacion }}</p>

                    @error('costo_habitacion')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 
            <div class="form-group">
                <label>capacidad</label>
                <br><p>{{ $habitacion->capacidad }}</p>

                    @error('capacidad')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
            <div class="form-group">
                <label>capacidad</label>
                <br><p>{{ $habitacion->reservacionHotel_id }}</p>

                    @error('reservacionHotel_id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div>
     </form>
    </div>
    <div id="buttonWhiteSpaces">
        <!--<button id="btn-print" class="btn btn-success btn-lg">Imprimir PDF</button>-->
        <button id="btn-savepdf" class="btn btn-success btn-lg">Generar reporte</button>
        <br><br>
      </div>
</div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/mostrarDetalleJS.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
@endsection