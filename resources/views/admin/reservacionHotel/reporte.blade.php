<!DOCTYPE html>
<html>
<head>
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
<body>
    <header>
        <div class="logo">
            <img width="60px" height="60px" src="{{asset('images/logo.png')}}" alt="Logo de la empresa"> 
        </div>
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
            @foreach ($reservacionHotel as $reserva)
                <tr class="encabezado">
                    <td colspan="3">Reserva N° {{ $reserva->id }}</td>
                </tr>
                <tr>
                    <td>
                        <span class="titulo-campo">Usuario:</span>
                        @foreach ($users as $user)
                            @if ($user->id == $reserva->usuario_id) 
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <span class="titulo-campo">Mascota:</span>
                        @foreach ($mascotas as $mascota)
                            @if ($mascota->id == $reserva->mascota_id) 
                                {{ $mascota->nombre }} <br> <span class="titulo-campo">Raza:</span>{{ $mascota->raza }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <span class="titulo-campo">Habitación:</span>
                        @foreach ($habitaciones as $habitacion)
                            @if ($habitacion->id == $reserva->habitacion_id) 
                                {{ $habitacion->nro_habitacion }} <br> <span class="titulo-campo">Ocupante:</span>{{ $habitacion->tipo_ocupante }}
                            @endif
                        @endforeach
                    </td>
                </tr>
     
                <tr>
                    <td>
                        <span class="titulo-campo">Fecha y hora ingreso:</span>
                        {{date('d/m/Y', strtotime($reserva->fechaIngreso))}} - {{ $reserva->horaRecepcion }}
                    </td>
                    <td>
                        <span class="titulo-campo">Fecha salida:</span>
                        {{date('d/m/Y', strtotime($reserva->fechaSalida))}}
                    </td>
                    <td>
                        <span class="titulo-campo">Check-in:</span>
                        {{ $reserva->horaCheckin }} - 
                        <span class="titulo-campo">Check-out:</span> 
                        {{ $reserva->horaCheckout }}
                    </td>
                </tr>
                    

                <tr>
                    <td>
                        <span class="titulo-campo">Tratamiento veterinario:</span>
                        @if($reserva-> tratamiento_veterinaria == '1') Realizado @else No realizado @endif
                        <br>
                        <span class="titulo-campo">Corte y baño:</span>
                        @if($reserva-> tratamiento_corte_banio == '1') Realizado @else No resalizado @endif
                    </td>
                    <td>
                        <span class="titulo-campo">Observaciones:</span>
                        {{ $reserva->observaciones }}
                    </td>
                    <td>
                        <span class="titulo-campo">Dirección:</span>
                        {{ $reserva->zona_direccion }} - {{ $reserva->direccion }}
                    </td>
                </tr>
                <tr class="encabezado">
                    <td colspan="3">Costos (Bs):</td>
                </tr>
                <tr>
                    <td>
                        <span class="titulo-campo">Transporte:</span>
                        {{ $reserva->costo_transporte }}
                    </td>
                    <td>
                        <span class="titulo-campo">Alimentación:</span>
                        {{ $reserva->costo_comida }}
                    </td>
                    <td>
                        <span class="titulo-campo">Veterinaria:</span>
                        {{ $reserva->costo_veterinaria }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <span class="titulo-campo">Corte y baño:</span>
                        {{ $reserva->costo_corte_banio }}
                    </td>
                    <td>
                        <span class="titulo-campo">Extras:</span>
                        {{ $reserva->costo_extras }}
                    </td>
                    <td>
                        <span class="titulo-campo">Total:</span>
                        {{ $reserva->costo_total }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    
    <div class="footer">
        <hr style="width: 34%; margin-top: 150px;">
        Firma
    </div>
</body>
</html>
