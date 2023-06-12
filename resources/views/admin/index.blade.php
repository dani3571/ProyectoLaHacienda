@extends('adminlte::page')

@section('title', 'Panel de administracion')

@section('content_header')

@stop

@section('content')

    <div class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
        <br>
        <h1 style="font-family: nunito,arial,verdana; font-size:20px">PANEL DE CONTROL</h1>
        <br>
        <div class="w-full h-full rounded border-dashed border-2 border-gray-300">
            <div class="mt-8 row">

                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-lg text-gray-400">Cantidad de productos registrados</div>
                            <div class="d-flex align-items-center pt-1">
                                <div class="text-4x1 font-medium text-gray-600">
                                    <?php
                                    use Illuminate\Support\Facades\DB;
                                    $cantidad = DB::table('productos')->count();
                                    
                                    echo $cantidad;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="text-blue-500">
                                <ion-icon name="cart-outline" size="large"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-lg text-gray-400">Ventas</div>
                            <div class="d-flex align-items-center pt-1">
                                <div class="text-4x1 font-medium text-gray-600">
                                    <?php
                                    $fecha = DB::table('ventas')
                                        ->whereDate('fechaVenta', DB::raw('CURDATE()'))
                                        ->count();
                                    
                                    echo $fecha;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="text-blue-500">
                                <ion-icon name="bag-check-outline" size="large"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-lg text-gray-400">Ganancia</div>
                            <div class="d-flex align-items-center pt-1">
                                <div class="text-4x1 font-medium text-gray-600">

                                    <?php
                                    $fechaHoy = date('Y-m-d');
                                    $resultado = DB::table('detalle_ventas as a')
                                        ->join('ventas as c', 'a.id', '=', 'c.id')
                                    
                                        ->whereDate('c.fechaVenta', $fechaHoy)
                                        ->selectRaw('SUM(a.subtotal) as suma')
                                        ->first();
                                    
                                    if ($resultado->suma == 0) {
                                        echo '0 Bs';
                                    } else {
                                        echo $resultado->suma . ' Bs';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="text-blue-500">
                                <ion-icon name="cash-outline" size="large"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    //Dashboard
    //Obteniendo los datos
    
    /* ----------Día---------- */
    $diaActual = date('d');
    
    // Usuarios
    $usuariosRegistrados = DB::table('users')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    // Ventas
    $ventasRealizadas = DB::table('ventas')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    // Compras
    $comprasRealizadas = DB::table('compras')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    // Veterinarias
    $veterinariasReservadas = DB::table('reservacion_veterinarias')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    // Hotel
    $hotelReservado = DB::table('reservacion_hotels')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    // Peluquería
    $peluqueriasReservadas = DB::table('reservacion_peluquerias')
        ->whereDay('created_at', $diaActual)
        ->count();
    
    /* ----------MES----------*/
    $mesActual = date('m');
    
    //usuarios
    $registrosUsuarios = DB::table('users')
        ->whereMonth('created_at', $mesActual)
        ->count();
    //ventas
    $registrosVentas = DB::table('ventas')
        ->whereMonth('created_at', $mesActual)
        ->count();
    //compras
    $registrosCompras = DB::table('compras')
        ->whereMonth('created_at', $mesActual)
        ->count();
    //veterinarias
    $registrosVet = DB::table('reservacion_veterinarias')
        ->whereMonth('created_at', $mesActual)
        ->count();
    //hotel
    $registrosHotel = DB::table('reservacion_hotels')
        ->whereMonth('created_at', $mesActual)
        ->count();
    //peluqueria
    $registrosPeluqueria = DB::table('reservacion_peluquerias')
        ->whereMonth('created_at', $mesActual)
        ->count();
    
    /* ----------TRIMESTRE----------*/
    //Dashboard
    //Obteniendo los datos
    $fechaActual = date('Y-m-d');
    $trimestreActual = ceil($mesActual / 3);
    //usuarios
    $registrosUsuarios2 = DB::table('users')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    //ventas
    $registrosVentas2 = DB::table('ventas')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    //compras
    $registrosCompras2 = DB::table('compras')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    //veterinarias
    $registrosVet2 = DB::table('reservacion_veterinarias')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    //hotel
    $registrosHotel2 = DB::table('reservacion_hotels')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    //peluqueria
    $registrosPeluqueria2 = DB::table('reservacion_peluquerias')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 2, $trimestreActual * 3])
        ->count();
    
    /* ----------SEMESTRE----------*/
    
    $trimestreActual = ceil($mesActual / 3);
    $registrosUsuariosSemestre = DB::table('users')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    $registrosVentasSemestre = DB::table('ventas')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    $registrosComprasSemestre = DB::table('compras')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    $registrosVetSemestre = DB::table('reservacion_veterinarias')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    $registrosHotelSemestre = DB::table('reservacion_hotels')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    $registrosPeluqueriaSemestre = DB::table('reservacion_peluquerias')
        ->whereBetween(DB::raw('MONTH(created_at)'), [$trimestreActual * 3 - 5, $mesActual])
        ->count();
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="card">
        <div class="card-body">
            <div class="chart-container" style="width: 100%; height: 800px;">
                <div style="display: flex; flex-wrap: wrap;">
                    <div style="width: 50%; height: 50%;">
                        <center>
                            <h4>Grafico general</h4>
                        </center>
                        <canvas id="myChart" style="width: 100%; max-height: 100%;"></canvas>
                    </div>
                    <div style="width: 50%; height: 50%;">
                        <center>
                            <h4>Grafico del dia - Torta</h4>
                        </center>
                        <canvas id="myChart2" style="width: 100%; max-height: 88%;"></canvas>
                    </div>
                </div>
                <div style="display: flex; flex-wrap: wrap; margin-top:30px">
                    <div style="width: 50%; max-height: 50%;">
                        <center>
                            <h4>Pronostico de ventas</h4>
                        </center>
                        <canvas id="salesChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                    <div style="width: 50%; max-height: 50%;">
                        <center>
                            <h4>Pronostico de ganancias</h4>
                        </center>
                        <canvas id="earningsChart" style="width: 100%; max-height: 88%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart');
            //semestre
            const registrosUsuarios = {!! json_encode($registrosUsuarios) !!};
            const registrosVentas = {!! json_encode($registrosVentas) !!};
            const $registrosCompras = {!! json_encode($registrosCompras) !!};
            const $registrosVet = {!! json_encode($registrosVet) !!};
            const $registrosHotel = {!! json_encode($registrosHotel) !!};
            const $registrosPeluqueria = {!! json_encode($registrosPeluqueria) !!};
            //trimestre
            const registrosUsuarios2 = {!! json_encode($registrosUsuarios2) !!};
            const registrosVentas2 = {!! json_encode($registrosVentas2) !!};
            const registrosCompras2 = {!! json_encode($registrosCompras2) !!};
            const registrosVet2 = {!! json_encode($registrosVet2) !!};
            const registrosHotel2 = {!! json_encode($registrosHotel2) !!};
            const registrosPeluqueria2 = {!! json_encode($registrosPeluqueria2) !!};
            //semestre
            const registrosUsuariosSemestre = {!! json_encode($registrosUsuariosSemestre) !!};
            const registrosVentasSemestre = {!! json_encode($registrosVentasSemestre) !!};
            const registrosComprasSemestre = {!! json_encode($registrosComprasSemestre) !!};
            const registrosVetSemestre = {!! json_encode($registrosVetSemestre) !!};
            const registrosHotelSemestre = {!! json_encode($registrosHotelSemestre) !!};
            const registrosPeluqueriaSemestre = {!! json_encode($registrosPeluqueriaSemestre) !!};

            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Ventas', 'Compras', 'Usuarios Registrados', 'Reservacion hotel',
                        'Reservacion veterinaria', 'Reservacion peluqueria'
                    ],
                    datasets: [{
                            label: '# Reporte del mes',
                            data: [registrosVentas, $registrosCompras, registrosUsuarios,
                                $registrosHotel, $registrosVet, $registrosPeluqueria
                            ],
                            backgroundColor: [
                                'rgba(0, 0, 255, 0.2)', // Cambiar el color y la opacidad aquí
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 0, 255, 1)', // Cambiar el color del borde aquí
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2

                        },
                        {
                            label: '# Reporte del trimestre',
                            data: [registrosVentas2, registrosCompras2, registrosUsuarios2,
                                registrosHotel2, registrosVet2, registrosPeluqueria2
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2

                        },

                        {
                            label: '# Reporte del semestre',

                            data: [registrosVentasSemestre, registrosComprasSemestre,
                                registrosUsuariosSemestre,
                                registrosHotelSemestre, registrosVetSemestre,
                                registrosPeluqueriaSemestre
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2
                        },



                    ]


                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    if (index === values.length - 1) {

                                    }

                                    return value;
                                },
                                padding: 10,
                            }

                        }
                    }
                }

            });
        }, true);
    </script>
    <!--Grafico torta-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart2');
            //dia actual
            const usuariosRegistrados = {!! json_encode($usuariosRegistrados) !!};
            const ventasRealizadas = {!! json_encode($ventasRealizadas) !!};
            const comprasRealizadas = {!! json_encode($comprasRealizadas) !!};
            const veterinariasReservadas = {!! json_encode($veterinariasReservadas) !!};
            const hotelReservado = {!! json_encode($hotelReservado) !!};
            const peluqueriasReservadas = {!! json_encode($peluqueriasReservadas) !!};

            const myChart2 = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Ventas', 'Compras', 'Usuarios Registrados', 'Reservacion hotel',
                        'Reservacion veterinaria', 'Reservacion peluqueria'
                    ],
                    datasets: [{
                        label: '# Reporte del dia',
                        data: [ventasRealizadas, comprasRealizadas, usuariosRegistrados,
                            hotelReservado, veterinariasReservadas, peluqueriasReservadas
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }, ]
                }
            });
        }, true);
    </script>

    <!--REGRESION LINEAL-->
    <script src={{ asset('js/regression-js-master/dist/regression.js') }}></script>
    <script>
        // Obtener los datos del controlador
        var labels = @json($labels);
        var values = @json($values);
        var prediction = @json($prediction);

        var transformedValues = values.map(value => Math.log(value));
        // Crear una matriz de puntos de datos en el formato [x, y]
        var datas = transformedValues.map((value, index) => [index + 1, value]);

        // Calcular la línea de regresión utilizando la función regression
        var result = regression.linear(datas);

        // var result = regression.linear([[0, 1], [32, 67], [12, 79]]);

        // Obtener los coeficientes de la línea de regresión
        var slope = result.equation[0];
        var intercept = result.equation[1];


        // Generar los puntos de la línea de regresión extendida hasta julio
        var regressionLineData = [];
        for (var i = 1; i <= values.length + 1; i++) {
            var transformedX = Math.log(i);
            var transformedY = slope * transformedX + intercept;
            var y = Math.exp(transformedY);
            regressionLineData.push({
                x: i,
                y: y
            });
        }

        // Configurar el gráfico
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Ventas',
                        data: values,
                        backgroundColor: 'rgba(0, 123, 255, 0.6)'
                    },
                    {
                        label: 'Línea de Regresión',
                        data: regressionLineData,
                        type: 'line',
                        fill: false,
                        borderColor: 'rgba(255, 0, 0, 1)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('earningsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Ganancia',
                    data: {!! json_encode($earnings) !!},
                    borderColor: 'rgba(0, 123, 255, 1)',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' Bs';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y + ' Bs';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>

@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('css')
    <style>
        .chart-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .horizontal-label {
            display: inline-block;
            transform: rotate(-90deg);
            white-space: nowrap;
        }

        .nav-item {
            background: dark;
        }

        .menu-open {
            background-color: #4d5059 !important;
        }
    </style>

@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ocultar el menú Veterinaria si no tiene submenús
            var submenuVeterinaria = $('#menuVeterinaria .treeview-menu');
            if (submenuVeterinaria.children().length === 0) {
                $('#menuVeterinaria').hide();
            }
    /*
            // Ocultar el menú Productos si no tiene submenús
            var submenuProductos = $('#menuProductos .nav-item has-treeview menu-is-opening menu-open');
            if (submenuProductos.children().length === 0) {
                $('#menuProductos').hide();
            }
    */
            // Ocultar el menú Mascotas si no tiene submenús
            var submenuMascotas = $('#menuMascotas .nav nav-treeview');
            if (submenuMascotas.children().length === 0) {
                $('#menuMascotas').hide();
            }
        });
    </script>
@stop
