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
        <h1 class="nombre-sistema">{{ $nombreSistema }}</h1> <!-- Utiliza la variable $nombreSistema para mostrar el nombre del sistema -->
    </header>
   <center><h2 class="titulo">REPORTE DE MASCOTAS</h2>
   @if (isset($fechaInicio) && isset($fechaFin))
   <p>Fechas de filtrado: {{ $fechaInicio }} - {{ $fechaFin }}</p>
   @endif
</center>
    <div class="fecha-usuario">
        <p>Usuario: {{ $name }}</p> 
        <p class="fecha">Fecha y Hora: {{ $fecha }} - {{ $hora }}              </p> 
 
    
    </div>
    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Raza</th>
                <th>Color</th>
                <th>Fecha de Nacimiento</th>
                <th>Caracter</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mascotas as $mascota )
            <tr>
                <td>{{$mascota->id}}</td>
                <td>{{$mascota->nombre}}</td>
                <td>{{$mascota->tipo}}</td>
                <td>{{$mascota->raza}}</td>
                <td>{{$mascota->color}}</td>
                <td>{{$mascota->fechaNacimiento}}</td>
                <td>{{$mascota->caracter}}</td>
                <td>{{$mascota->sexo}}</td>
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