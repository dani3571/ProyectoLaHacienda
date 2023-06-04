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

.section {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.section h1 {
    font-size: 35px;
    color: #343a40;
    margin-bottom: 20px;
    text-align: center;
}

.section p {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 15px;
}

.section ul {
    list-style: none;
    padding-left: 0;
}

.section ul li {
    margin-bottom: 10px;
}

.section ul li a {
    color: #007bff;
    display: flex;
    align-items: center;
}

.section ul li a img {
    margin-right: 10px;
}

ul li a:hover img {
    transform: scale(1.2); /* Escala el ícono al 120% */
    transition: transform 0.3s ease-in-out; /* Agrega una transición suave */
}

ul li a:hover {
    background-color: #486cb4;
    color: white;
}

@media (max-width: 576px) {
    .section {
        padding: 20px;
    }
}

#map {
  height: 400px;
}

@media (max-width: 576px) {
  #map {
    margin-left: auto;
    margin-right: auto;
  }
}

#contacto p,
#contacto a {
    font-size: 20px; /* Tamaño de fuente deseado */
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

@section('content')
<section class="container-fluid bg-color-azul p-3" style="margin-top: 2px">
<div class="row align-items-stretch">
<div class="col-12 col-lg-6">
    <div class="section" id="contacto">
        <h1>Contacto</h1>
        <p>Para cualquier consulta o solicitud de información, no dudes en ponerte en contacto con nosotros.</p>
        <p>Puedes contactarnos a través de los siguientes medios:</p>
        <br>
        <ul>
            <li><a href="tel:76563649" target="_blank"><img src="https://freesvg.org/img/phone-call-icon.png" alt="Llamar" width="30" height="30" class="icon-lg"> Llamar</a></li>
            <li><a href="mailto:lahacienda@gmail.com" target="_blank"><img src="https://cdn.pixabay.com/photo/2019/10/19/17/24/gmail-4561841_1280.png" alt="Enviar correo electrónico" width="30" height="30" class="icon-lg"> Enviar correo electrónico</a></li>
            <li><a href="https://wa.me/76563649" target="_blank"><img src="https://cdn.pixabay.com/photo/2021/05/22/11/38/whatsapp-6273368_1280.png" alt="WhatsApp" width="30" height="30" class="icon-lg"> WhatsApp</a></li>
            <li><a href="https://www.google.com/maps/dir//9X63%2BP8Q+Hotel+Canino+La+Hacienda,+La+Paz/@-16.5665384,-68.1636657,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x915f2f555b6167a7:0xf0c72d6cb0364cfa!2m2!1d-68.0466162!2d-16.6382067?entry=ttu" target="_blank"><img src="https://media.istockphoto.com/id/1162532344/vector/animal-paw-or-footprint-in-location-marker-pin-icon-pet-shop-pet-store-location-icon-concept.jpg?s=612x612&w=0&k=20&c=itFccXy1dkz0Ue4p54Rgex2qCuvVQBIbpn5jQlCq1ZU=" alt="Dirección" width="30" height="30" class="icon-lg">Ir a dirección del complejo veterinario.</a></li>
        </ul>
        <br>
    <p>Para acceder a funciones como reservación de hotel para mascotas, veterinaria y peluquería, puedes <a href="{{ route('login') }}">Iniciar sesión.</a><p>
    <p>Si no estás registrado, puedes <a href="{{ route('register') }}">registrarte aquí</a> para acceder a más funciones.</p>    
    </div>
</div>
<div class="col-12 col-lg-6">
    <div class="section">
        <h4>Dirección:</h4>
        <ul>
        <li><a href="https://www.google.com/maps/dir//9X63%2BP8Q+Hotel+Canino+La+Hacienda,+La+Paz/@-16.5665384,-68.1636657,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x915f2f555b6167a7:0xf0c72d6cb0364cfa!2m2!1d-68.0466162!2d-16.6382067?entry=ttu" target="_blank"><img src="https://media.istockphoto.com/id/1162532344/vector/animal-paw-or-footprint-in-location-marker-pin-icon-pet-shop-pet-store-location-icon-concept.jpg?s=612x612&w=0&k=20&c=itFccXy1dkz0Ue4p54Rgex2qCuvVQBIbpn5jQlCq1ZU=" alt="Dirección" width="30" height="30" class="icon-lg">Carretera Principal río abajo, entrada Los Jardines, Frente a la Parroquia del Santísimo Sacramento de Huajchilla, La Paz, Bolivia.</a></li>
        </ul>
        <div id="map"></div>
    </div>
</div>
</div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('js/map.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwW..." crossorigin="anonymous"></script>
<script>
    function initMap() {
        var options = {
            zoom: 12,
            center: {lat: -16.500000, lng: -68.150000} // Coordenadas del centro del mapa
        }

        // Nuevo mapa
        var map = new google.maps.Map(document.getElementById('map'), options);

        // Marcador
        var marker = new google.maps.Marker({
            position: {lat: lat: -16.637996289362487, lng: -68.04656417274363}, // Coordenadas del marcador
            map: map,
            title: 'La Hacienda' // Título del marcador
        });
    }
</script>
<!-- Código para cargar el mapa -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMQFfw2HqvUqtEOpdtOdumiOT6M3DOW3Y&callback=initMap" async defer></script>

@endsection



