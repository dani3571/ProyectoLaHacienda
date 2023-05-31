<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos CSS para el reporte */
        .logo {
            float: right;
            width: 100px; /* Ajusta el tamaño del logo según tus necesidades */
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
        <div class="logo">
            <img width="60px" height="60px" src="{{asset('images/logo.png')}}" alt="Logo de la empresa"> <!-- Ajusta la ruta de la imagen del logo -->
        </div>
        <h1 class="nombre-sistema">SISTEMA GENESIS</h1> <!-- Utiliza la variable $nombreSistema para mostrar el nombre del sistema -->
    </header>
   <center><h2 class="titulo">REPORTE DE ROLES</h2>
    @if (isset($fechaInicio) && isset($fechaFin))
    <p>Fechas de filtrado: {{ $fechaInicio }} - {{ $fechaFin }}</p>
    @endif
    </center>

    <div class="fecha-usuario">
        <p>Usuario: {{ $name }}</p> 
        <p class="fecha">Fecha y Hora: {{$fecha = date('Y-m-d')}} - {{ $hora = date('H:i')}}                </p> 
       
    </div>
    <table class="tabla">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
            </tr>
        </thead>
        <tbody>
        </thead>
        @foreach ($role as $roles )
                <tr>   
                    <td>{{$roles->id}}</td>
                    <td>{{$roles->name}}</td>
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