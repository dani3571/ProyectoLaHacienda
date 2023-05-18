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
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
	//Listener
	/*document.querySelector('#btn-print').addEventListener('click', function () {
		html2canvas(document.querySelector('#factura')).then((canvas) => {
			// create a new window
			var nWindow = window.open('');
			// Anexar el canvas al body
			nWindow.document.body.appendChild(canvas);
			// Enfocar la ventana
			nWindow.focus();
			// Imprimir la ventana
			nWindow.print();
			// Recargar la página
			location.reload();
			//Cerrar ventana
			nWindow.close();
		});
	});*/
	//Listener
	document.querySelector('#btn-savepdf').addEventListener('click', function () {
		html2canvas(document.querySelector('#factura')).then((canvas) => {
			let base64image = canvas.toDataURL('image/png');
			// Definir tamaño de PDF
			let pdf = new jsPDF('p', 'px', [1600, 1131]);
			pdf.addImage(base64image, 'PNG', 15, 15, 1110, 360);
			//Obtener fecha
			var date = new Date();
			var current_time = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + "-" + date.getHours() + ":" + date.getMinutes();
			//Guardar PDF
			pdf.save(current_time + "Detalle.pdf");
		});
	});
});
</script>
</head>

<div class="card">
    <div class="card-body">
  <div  id="factura" class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="title">Reservación de hotelería</h1>
        
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $reservacionHotel->id }}">
                </div> 
            <div class="form-group">
                <label>No Id</label><br>
                <p>{{ $reservacionHotel->id }}</p>
                    @error('id')
                        <span class="text-danger">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
            </div> 

        <div class="dates-group">
          <div class="form-group">
            <label for="checkin-date">Fecha de ingreso:</label><br>
            <p>"{{ $reservacionHotel->fechaIngreso }}"</p>
                @error('fechaIngreso')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
          </div>
          <div class="form-group">
            <label for="checkout-date">Fecha de salida:</label>
            <br>
                <p>{{ $reservacionHotel->fechaSalida }}</p>
                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="treatments">Tratamientos:</label>
          <br>
                <p>{{ $reservacionHotel->tratamientos }}</p>
                @error('fechaSalida')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="costs-title">Costos</h2>
        <div class="costs-group">
          <label for="cost1">Costo Transporte:</label>
          <br><p>{{$reservacionHotel->tranporte}}</p>
        </div>
        <div class="costs-group">
          <label for="cost2">Costo comida:</label>
          <br><p>{{$reservacionHotel->comida}}</p>
        </div>
        <div class="costs-group">
          <label for="cost3">Costo baño y corte:</label>
          <br><p>{{$reservacionHotel->banioYCorte}}</p>
        </div>
        <div class="costs-group">
          <label for="cost4">Costo Tratamiento:</label>
          <br><p>{{$reservacionHotel->tratamiento}}</p>
        </div>
        <div class="costs-group">
          <label for="cost5">Costos Adicionales (extras):</label>
          <br><p>{{$reservacionHotel->extra}}</p>
        </div>
        <div class="costs-group">
          <label for="cost6">Costo Total:</label>
          <br><p>{{$reservacionHotel->total}}</p>
        </div>
        
    </div>
  </div>
  
</div>
<div id="buttonWhiteSpaces">
        <!--<button id="btn-print" class="btn btn-success btn-lg">Imprimir PDF</button>-->
        <button id="btn-savepdf" class="btn btn-success btn-lg">Generar reporte</button>
        <br><br>
      </div>
</div>
@endsection
