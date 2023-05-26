@extends('adminlte::page')

@section('title', 'Panel de administracion')

@section('content_header')
@stop

@section('content')
_____________________________________

_____________________________________

_____________________________________

_____________________________________

_____________________________________

_____________________________________

_____________________________________
_____________________________________
_____________________________________
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<br>

<canvas id="myChart" width="1000px" height="200px"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Ventas', 'Compras', 'Usuarios Registrados', 'Reservacion hotel', 'Reservacion veterinaria', 'Reservacion peluqueria'],
                    datasets: [{
                        label: '# Reporte del dia',
                        data: [12, 19, 3, 5, 2, 10],
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
                    }]
                }
            });
        }, true);
    </script>

@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop

<style>
  #contenedores{
    position:relative;
    background-color:red;
    width: 200px;  
    left:0px;
    margin-left:0px;
    padding-left:0px;
}
.padre{
   border: 1px;
   display: inline-block;
   width: auto;
   margin: auto;
   text-align: left;
}
.box {
  width: 200px;
}
.minibox {
  width: 50px;
}
.width {
  width: 100%;
}
.max {
  max-width: 100%;
}


</style>
