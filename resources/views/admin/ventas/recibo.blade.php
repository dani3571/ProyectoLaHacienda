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
        <h1 class="nombre-sistema">SISTEMA GENESIS</h1>
    </header>
   <center><h2 class="titulo">RECIBO DE LA VENTA</h2>
   @if (isset($fechaInicio) && isset($fechaFin))
   <p>Fechas de filtrado: {{ $fechaInicio }} - {{ $fechaFin }}</p>
   @endif
   </center>
   
    <div class="fecha-usuario">
        <p>Usuario: {{ $name }}</p> 
        <p class="fecha">Fecha y Hora: {{$fecha = date('Y-m-d');}} - {{ $hora = date('H:i'); }}                </p> 
       
    </div>
    <h4 class="text-center">Venta</h4>
    <table class="tabla">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha de la Venta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta_individual as $item)
                    <tr>
                        <th>{{$item->id_venta}}</th>
                        <td>{{$item->usuario}}</td>
                        <td>{{$item->cliente}}</td>
                        <td>{{$item->cantidad}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->fechaVenta}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    <h4 class="text-center">Productos</h4>
            <table class="tabla">
                <thead>
                    <tr>
                        <th scope="col">Id Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Individual</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($ventas as $venta)
                    <tr>
                        <th>{{$venta->id_producto}}</th>
                        <td>{{$venta->usuario}}</td>
                        <td>{{$venta->cantidad_individual}}</td>
                        <td>{{$venta->precio}}</td>
                        <td>{{$venta->subtotal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</body>
</html>