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
   <center><h2 class="titulo">REPORTE DE COMPRAS</h2>
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
                <th scope="col">Id</th>
                <th scope="col">Fecha de compra</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Cantidad Total</th>
                <th scope="col">Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra )
            <tr>
                <th>{{$compra->id}}</th>
                <td>{{$compra->fechaCompra}}</td>
                <td>
                    @foreach ($proveedores as $proveedor )
                        @if($proveedor->id == $compra->id_proveedor) 
                            {{$proveedor->nombre}}
                        @endif
                    @endforeach
                </td>
                <td>{{$compra->cantidadTotal}}</td>
                <td>{{$compra->precioTotal}} bs</td>
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