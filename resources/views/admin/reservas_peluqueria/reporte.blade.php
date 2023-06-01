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
        .fecha-usuario {
            clear: both;
            margin-bottom: 20px;
        }
     
      
        .tabla {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 8px;
        }
        .tabla td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <!--<div class="logo">
            <img width="60px" height="60px" src="{{asset('images/logo.png')}}" alt="Logo de la empresa"> 
        </div>-->
        <h1 class="nombre-sistema">SISTEMA GENESIS</h1>
    </header>
   <center><h2 class="titulo">REPORTE DE RESERVAS COMPLETADAS - PELUQUERÍA</h2>
   @if (isset($fechaInicio) && isset($fechaFin))
   <p>Fechas de filtrado: {{ $fechaInicio }} - {{ $fechaFin }}</p>
   @endif
   </center>
   
    <div class="fecha-usuario">
        <p>Usuario: {{ $name }}</p> 
        <p class="fecha">Fecha y Hora: {{$fecha = date('Y-m-d');}} - {{ $hora = date('H:i'); }}                </p> 
       
    </div>
    <table class="tabla">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Mascota</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora Recepcion</th>
                <th scope="col">Hora Entrega</th>
                <th scope="col">corte</th>
                <th scope="col">Baño simple</th>
                <th scope="col">tranquilizante</th>
                <th scope="col">observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas_peluqueria as $reserva )
                <tr>
                    <td>{{$reserva->id}}</td>
                    <td>
                        @foreach ($users as $user )
                            @if($user->id == $reserva->usuario_id) 
                                {{$user->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mascotas as $mascota )
                            @if($mascota->id == $reserva->mascota_id) 
                                {{$mascota->nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{date('d/m/Y', strtotime($reserva->fecha))}}</td>
                    <td>{{$reserva->horaRecepcion}}</td>
                    <td>{{$reserva->horaEntrega}}</td>
                    <td>@if($reserva->corte == '1') Si @else No @endif</td>
                    <td>@if($reserva->BanoSimple == '1') Si @else No @endif</td>
                    <td>@if($reserva->tranquilizante == '1') Si @else No @endif</td>
                    <td>{{$reserva->Observaciones}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <hr style="width: 34%; margin-top: 150px;">
        Firma
    </div>
</body>
</html>