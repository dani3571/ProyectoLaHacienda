@extends('layouts.base')
@section('styles')
<link rel="stylesheet" href="{{asset('css/base/general.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none !important;
    list-style: none;
}
#map {
  height: 800px;
  margin: 50px;
  
  background-color: rgb(67, 105, 176);
  border-radius: 40px;
   -webkit-box-shadow: 2.5px 1.5px 7.5px -0.5px #414141;
   -moz-box-shadow: 2.5px 1.5px 7.5px -0.5px #414141;
   box-shadow: 2.5px 1.5px 7.5px -0.5px #414141;
}

html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

body{
    background-color: rgba(177, 177, 177, 0.6) !important;
}

.line {
    line-height: 1.7 !important;
}

.content {
    display:flex;
    flex-flow: column nowrap;
    margin: 0 auto;
    width: 100%;
    max-width: 1920px;
}

.alert-red{
    color: red;
}

/* Aquí comienza la sección */
.section {
    min-height: calc(100vh - 185px);
}

/* Aquí termina la sección */

/* Imagen del autor y de perfil */
.img-author,
.img-profile {
    width: 58px;
    margin-top: 3px;
    border-radius: 3px;
    height: 43px;
}

.text-primary {
    text-align: center;
    font-size: 2.1em;
    margin: 1%;
}

.text-primary h2{
    color: black !important;
    font-weight: bold !important;
}

.text-center{
    text-align: center;
}

.link-paginate{
    display: block;
    width: 20%;
    padding: 20px;
    text-align: center;
    margin: 0 auto;
}

.link-paginate .justify-between{
    display: flex;
    justify-content: space-evenly;
}

.link-paginate .items-center{
    background-color: #1D448E;
    padding: 5px;
    color: white;
    border-radius: 5px;
}

.pagination{
    display: flex;
    flex-direction: row;
    font-size: 1em;
    padding: 2px;
    color: #1D448E;
}

.page-link{
    display: block;
    padding: 15px;
    font-size: 20px;
}

.title-page-admin h2{
    display: block;
    text-align: center;
    color: #343A40;
    font-size: 35px;
    font-weight: 400;
}

.btn-article{
    display: block;
    width: 8%;
    height: 20px;
    margin-left: 30%;
}

.btn-new-article{
    background: gray;
    padding: 4px;
    font-size: 1.2em;
    color: white;
    border-radius: 3px;
}

.links-paginate {
    text-align: center;
}

.links-paginate span{
    padding: 5px !important;;
    color: white !important;;
    border-radius: 4px;
    background-color: #007bff !important;
    margin-right: 6px;
}

.links-paginate a{
    padding: 5px !important;;
    color: white !important;;
    border-radius: 4px;
    background-color: #007bff !important;;
    margin-right: 6px;
}

.links-paginate a:hover{
    background-color: gray !important;;
}

/* Aquí termina el menú de categorias */

/* Aquí comienza el slogan */
.slogan {
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    margin: 1% auto;
}

.column1 {
    flex: 0 0 30%;
    max-width: 25%;
    margin-top: 6px;
}

.column1 h2 {
    font-size: 2.2em;
    color: #343a40;
    text-align: center;
    font-weight: bold;
}

.column2 {
    flex: 0 0 70%;
    max-width: 70%;
}

.column2 p {
    font-size: 1.2em;
    font-weight: 500;
    text-align: justify;
    line-height: 1.5;
}

/* Aquí termina el slogan */



@media (max-width: 1440px) {

    .section {
        min-height: calc(100vh - 163px);
    }

    .slogan {
        width: 60%;
        margin: 15px auto;
    }


}

@media (min-width: 1366px) and (max-width: 1399px) {
    .text-primary {
        font-size: 1.7em;
    }

    .slogan {
        width: 67%;
        margin: 25px auto;
    }

}

@media (min-width: 1280px) and (max-width: 1365px) {

    .section {
        min-height: calc(100vh - 160px);
    }

    .text-primary{
        font-size: 1.6em;
    }

    .slogan {
        width: 66%;
    }

    .slogan .column1 h2 {
        font-size: 2em;
    }

    .slogan .column2 p {
        font-size: 1em;
    }

}

/* 1024px * 600 */

@media (min-width: 1024px) and (max-width: 1279px) {
    .text-primary {
        font-size: 1.5em;
    }

    .section {
        min-height: calc(100vh - 151px);
    }

    .slogan {
        width: 75%;
        margin: 15px auto;
    }

    .slogan .column1 h2{
        font-size: 2em;
    }

    .slogan .column2 p{
        font-size: 1em;
    }
}



/*Inicio*/    
.bg-color-info {
	background-color: rgb(244, 246, 251);
}

.font-color-general {
	color: rgb(67, 105, 176);
}

.brand-name {
	font-size: 1.8rem;
	color: rgb(67, 105, 176);
	margin-left: 2rem;
}

.bg-img-principal {
	background-image: url("img/main.jpg");
	background-size: cover;
	height: 650px;
	background-position: center center;
}


.bg-color-azul {
	background-color: rgb(67, 105, 176);
}

.hrblanco {
	width: 10%;
	background-color: white;
}

.hrazul {
	width: 10%;
	background-color: rgb(244, 246, 251);
}


/* estilos específicos para pantallas menores a 992px (menor que lg de bootstrap) */
@media only screen and (max-width : 992px) {

	.brand-name {
		font-size: 1.8rem;
		color: rgb(67, 105, 176);
		margin-left: 1rem;
	}

	/* tenemos 1 imagen específica para móvil */
}

.dd{
    background-color: rgb(67, 105, 176);
    width: auto;
    height: 800px;
    padding-top: auto;
    margin-top: 262px;
}

</style>
<!-- Bootstrap CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- google fonts -->
<link href="https://fonts.googleapis.com/css?family=Underdog&display=swap" rel="stylesheet">

<!-- nuestros estilos-->
<link rel="stylesheet" type="text/css" href="style.css">

<!-- iconos de friconix-->
<script defer src="https://friconix.com/cdn/friconix.js"></script>

@endsection

@section('title', 'La Hacienda')

@section('content')
<div  class="row bg-img-principal align-items-center" style="background-image: url({{url('images/main_movil.png')}}) ; background-size: cover; background-position:center;	height: 700px; ">
      	
	<div class="offset-3 col-7 bg-light p-3 d-none d-lg-block">
		<h3 class="font-color-general" style="font-size:100px">SERVICIOS</h3>
	</div>


	<div class="col-10 mx-auto bg-light p-3 d-block d-lg-none">
		<h3 class="font-color-general">Complejo La Hacienda</h3>
	</div>
	  </div>
	<!-- INICIO SECCIÓN NOSOTROS class="container-fluid bg-color-azul p-3"-->

   
	<section  id="nosotros"  class="container-fluid bg-color-azul p-3" style="margin-top: 2px">
		<h4 class="text-white text-center p-3">
			Quienes somos?
		</h4>

		<hr class="hrblanco">

		<div class="row  align-items-center">
			<div class="col-12 col-lg-6">
				<img src="{{asset('images/hacienda.png')}}" width="600px" height="600px" class="img-fluid p-3" alt="nosotros">
			</div>
			
			<div class="col-12 col-lg-6 text-white p-3">
				<h4 class="my-3">
					Nosotros:
				</h4>
		
				<p  class="p-3" style="text-align: justify; font-size:x-large" >
					El Complejo Veterinario La Hacienda, fundado en 2009 por Gina Muñoz Reyes de la Barra, es un establecimiento ubicado en Huajchilla, La Paz, Bolivia, que brinda una amplia gama de servicios para mascotas, incluyendo atención veterinaria, hospedaje y peluquería.
				</p>
				<p  class="p-3" style="text-align: justify; font-size:x-large" >
					Desde su creación, La Hacienda se ha dedicado a brindar un servicio integral y de calidad a sus clientes, con un enfoque en el bienestar de los animales y la satisfacción de sus dueños. Con una amplia experiencia en el cuidado de mascotas, el personal altamente capacitado de La Hacienda se esfuerza por ofrecer un servicio personalizado y amable a cada uno de sus clientes, estableciendo relaciones duraderas basadas en la confianza y el respeto. 
				</p>
			</div>
		</div>

	</section>

	<!-- FIN SECCIÓN NOSOTROS-->


    <!-- INICIO SECCIÓN SERVICIOS-->
	<section class="container-fluid" id="servicios">

    <h4 class="text-white text-center p-3">
			Misión
		</h4>

		<hr class="hrblanco">

		<div class="row  align-items-center">
			<div class="col-12 col-lg-6 text-white p-3">
				<h4 class="my-3">
					Misión:
				</h4>
		
				<p  class="p-3" style="text-align: justify; font-size:x-large" >
                Nuestra empresa se dedica a proporcionar una atención de calidad y comodidad a las mascotas de nuestros clientes. Nos esforzamos por ofrecer servicios personalizados y adaptados a las necesidades individuales de cada animal, con el fin de mejorar su experiencia con nosotros. 
            </p>
			</div>
            <div class="col-12 col-lg-6">
				<img src="{{asset('images/hacienda.png')}}" width="600px" height="600px" class="img-fluid p-3" alt="nosotros">
			</div>
		</div>
	</section>
    <section  id="nosotros"  class="container-fluid bg-color-azul p-3" style="margin-top: 2px">
		<h4 class="text-white text-center p-3">
			Visión
		</h4>

		<hr class="hrblanco">

		<div class="row  align-items-center">
			<div class="col-12 col-lg-6">
				<img src="{{asset('images/hacienda.png')}}" width="600px" height="600px" class="img-fluid p-3" alt="nosotros">
			</div>
			
			<div class="col-12 col-lg-6 text-white p-3">
				<h4 class="my-3">
					Visión:
				</h4>
		
				<p  class="p-3" style="text-align: justify; font-size:x-large" >
                Nuestra visión es de llegar a ser una empresa conocida por dar servicios de atención de calidad y comodidad para mascotas. Nos esforzamos por llegar a ser reconocidos como un hogar lejos del hogar para las mascotas de nuestros clientes, y ser el primer destino al que los dueños de mascotas acuden para garantizar que sus animales reciban el mejor cuidado posible.  
                </p>
			</div>
		</div>

	</section>
	<!-- FIN SECCIÓN SERVICIOS-->
    @endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

@endsection



