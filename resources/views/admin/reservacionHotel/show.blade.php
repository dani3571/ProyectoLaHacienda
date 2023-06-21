@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
<h1>Detalle</h1>
@endsection

@section('content')

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      padding: 20px;
    }
    
    .title {
      color: blue;
      font-size: 24px;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .btn-group {
      margin-bottom: 20px;
    }
    
    .dates-group {
      margin-bottom: 20px;
    }
    
    .costs-title {
      font-size: 18px;
      margin-top: 30px;
      margin-bottom: 10px;
    }
    
    .costs-group {
      margin-bottom: 10px;
    }
    
    .btn-right {
      margin-left: 10px;
    }
    #buttonWhiteSpaces{
        text-align: right;
        padding-right: 250px;
    }
    <style>
        .logo {
            float: right;
            width: 100px;
            height: auto;
        }
        .nombre-sistema {
            font-size: 18px;
        }
        .titulo {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .fecha-usuario {
            clear: both;
            margin-bottom: 20px;
        }
        .tabla-wrapper {
            max-height: 400px; /* Establece la altura máxima de la tabla */
            overflow-y: auto; /* Habilita la barra de desplazamiento vertical si se excede la altura máxima */
        }
        .tabla {
            display: table;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }
        .fila {
            display: table-row;
        }
        .celda {
            display: table-cell;
            padding: 8px;
            border: 1px solid #ddd;
        }
        .encabezado {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .titulo-campo {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .center {
            text-align: center;
        }
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
  </style>
</head>

<div class="card">
    <div class="card-body">
  <div  id="factura" class="container">
  <header>
        <!--<div class="logo">
            <img width="60px" height="60px" src="{{asset('images/logo.png')}}" alt="Logo de la empresa"> 
        </div>-->
        <h1 class="nombre-sistema">SISTEMA GENESIS</h1>
    </header>
    <center>
        <h2 class="titulo">REPORTE DE RESERVAS COMPLETADAS - HOTEL DE MASCOTAS</h2>
        @if (isset($fechaInicio) && isset($fechaFin))
            <p>Fechas de filtrado: {{ $fechaInicio }} - {{ $fechaFin }}</p>
        @endif
    </center>
   
    <div class="fecha-usuario">
        <p>Usuario: {{ $name }}</p> 
        <p class="fecha">Fecha y Hora: {{$fecha = date('Y-m-d');}} - {{ $hora = date('H:i'); }}</p> 
    </div>
    

    <div class="tabla-wrapper">
        <table class="tabla">
                <tr class="encabezado">
                    <td colspan="3">Reserva N° {{ $reservacionHotel->id }}</td>
                </tr>
                <tr>
                    <td>
                        <span class="titulo-campo">Usuario:</span>
                        @foreach ($users as $user)
                            @if ($user->id == $reservacionHotel->usuario_id) 
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <span class="titulo-campo">Mascota:</span>
                        @foreach ($mascotas as $mascota)
                            @if ($mascota->id == $reservacionHotel->mascota_id) 
                                {{ $mascota->nombre }} <br> <span class="titulo-campo">Raza:</span>{{ $mascota->raza }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <span class="titulo-campo">Habitación:</span>
                        @foreach ($habitaciones as $habitacion)
                            @if ($habitacion->id == $reservacionHotel->habitacion_id) 
                                {{ $habitacion->nro_habitacion }} <br> <span class="titulo-campo">Ocupante:</span>{{ $habitacion->tipo_ocupante }}
                            @endif
                        @endforeach
                    </td>
                </tr>
     
                <tr>
                    <td>
                        <span class="titulo-campo">Fecha y hora ingreso:</span>
                        {{date('d/m/Y', strtotime($reservacionHotel->fechaIngreso))}} - {{ $reservacionHotel->horaRecepcion }}
                    </td>
                    <td>
                        <span class="titulo-campo">Fecha salida:</span>
                        {{date('d/m/Y', strtotime($reservacionHotel->fechaSalida))}}
                    </td>
                    <td>
                        <span class="titulo-campo">Check-in:</span>
                        {{ $reservacionHotel->horaCheckin }} - 
                        <span class="titulo-campo">Check-out:</span> 
                        {{ $reservacionHotel->horaCheckout }}
                    </td>
                </tr>
                    

                <tr>
                    <td>
                        <span class="titulo-campo">Tratamiento veterinario:</span>
                        @if($reservacionHotel-> tratamiento_veterinaria == '1') Realizado @else No realizado @endif
                        <br>
                        <span class="titulo-campo">Corte y baño:</span>
                        @if($reservacionHotel-> tratamiento_corte_banio == '1') Realizado @else No realizado @endif
                    </td>
                    <td>
                        <span class="titulo-campo">Observaciones:</span>
                        {{ $reservacionHotel->observaciones }}
                    </td>
                    <td>
                        <span class="titulo-campo">Dirección:</span>
                        @if($reservacionHotel-> zona_direccion == null) No transporte @else
                        {{ $reservacionHotel->zona_direccion }} - {{ $reservacionHotel->direccion }} @endif
                    </td>
                </tr>
                <tr class="encabezado">
                    <td colspan="3">Costos (Bs):</td>
                </tr>
                <tr>
                    <td>
                        <span class="titulo-campo">Transporte:</span>
                        {{ $reservacionHotel->costo_transporte }}
                    </td>
                    <td>
                        <span class="titulo-campo">Alimentación:</span>
                        {{ $reservacionHotel->costo_comida }}
                    </td>
                    <td>
                        <span class="titulo-campo">Veterinaria:</span>
                        {{ $reservacionHotel->costo_veterinaria }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <span class="titulo-campo">Corte y baño:</span>
                        {{ $reservacionHotel->costo_corte_banio }}
                    </td>
                    <td>
                        <span class="titulo-campo">Extras:</span>
                        {{ $reservacionHotel->costo_extras }}
                    </td>
                    <td>
                        <span class="titulo-campo">Total:</span>
                        {{ $reservacionHotel->costo_total }}
                    </td>
                </tr>
        </table>
    </div>

    
    <div class="footer">
        <hr style="width: 34%; margin-top: 150px;">
        Firma
    </div>
</div>
<br><br><br>
<div id="buttonWhiteSpaces">
        <!--<button id="btn-print" class="btn btn-success btn-lg">Imprimir PDF</button>-->
        <button id="btn-savepdf" class="btn btn-primary btn-lg">Generar reporte</button>
        <br><br>
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