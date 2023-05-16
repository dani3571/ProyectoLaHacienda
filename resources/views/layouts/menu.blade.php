<style>
/* estilos generales para toda la página */
body {
	font-family: 'Underdog', cursive;
	margin: 0;
}

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

.bloque-texto-principal {
	margin-top:;
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
	.bg-img-principal {
		background-image: url("img/main_movil.png");
		background-size: cover;
		height: 500px;
		background-position: center center;	
	}	
}
.img-profile {
    width: 60px;
    border-radius: 3px;
    height: 60px;
  
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Underdog&display=swap" rel="stylesheet">

	<!-- nuestros estilos-->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- iconos de friconix-->
	<script defer src="https://friconix.com/cdn/friconix.js"></script>


<!-- INICIO NAVBAR -->
<!-- INICIO SECCIÓN INFORMES -->
@guest
<div class="container-fluid bg-color-info font-color-general" id="inicio">
	<div class="row">
		<div class="col-12 col-lg-6 text-center text-lg-left my-3 pl-5">
			Complejo la Hacienda, Ciudad de La Paz
		</div>

		<div class="col-12 col-lg-6 text-center text-lg-right my-3 pr-5">
			Lunes a Viernes de 9 am a 7 pm. <span class="font-weigth-bolder"><i class="fi-xnsuxl-smartphone-solid"></i> 5541554263</span> 
		</div>
	</div>
</div>
<nav class="navbar navbar-expand-lg sticky-top bg-light">
    <img src="{{asset('images/logo.png')}}" width="90" height="90">
	<span class="brand-name">La Hacienda</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="font-color-general"><i class="fi-xwsrxl-ellipsis"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link font-color-general mr-lg-3 ml-3" href="{{route('index.index')}}">Inicio</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link font-color-general mr-3 ml-3" href="{{route('nosotros.nosotros')}}">Nosotros</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link font-color-general mr-3 ml-3" href="{{route('servicios.servicios')}}">Servicios</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link font-color-general mr-3 ml-3" href="{{route('contactanos.contactanos')}}">Contacto</a>
            </li>
			<li class="nav-item active">
                <a class="nav-link font-color-general mr-3 ml-3" href="{{route('products.productos')}}">Productos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link font-color-general mr-3 ml-3" href="{{route('login')}}">Acceder</a>
            </li>
			
		</ul>
    </div>
</nav>


	@else
	<div class="container-fluid bg-color-info font-color-general" id="inicio">
		<div class="row">
			<div class="col-12 col-lg-6 text-center text-lg-left my-3 pl-5">
				Col. del Valle, Ciudad de México
			</div>
	
			<div class="col-12 col-lg-6 text-center text-lg-right my-3 pr-5">
				Lunes a Viernes de 9 am a 7 pm. <span class="font-weigth-bolder"><i class="fi-xnsuxl-smartphone-solid"></i> 5541554263</span> 
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg sticky-top bg-light">
		<img src="{{asset('images/logo.png')}}" width="90" height="90">
		<span class="brand-name">La Hacienda</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="font-color-general"><i class="fi-xwsrxl-ellipsis"></i></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<div class="dropdown">
					<img src="{{asset('images/user.png')}}" alt="Profile" class="img-profile">
					
					<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
					   data-bs-toggle="dropdown" aria-expanded="false">
					   <span class="nav-link font-color-general mr-lg-3 ml-3 name-user">{{Auth::user()->name}}</span>
					</a>
		
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					
						
		        <li><a class="dropdown-item" href="{{route('profiles.edit', ['profile' =>Auth::user()->id])}}">Perfil</a></li>
			
						
						
							<li><a class="dropdown-item" href="{{route('admin.index')}}">Ir al admin</a></li>
						
						<li>
							<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
							  @csrf  
							</form>
							<a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); 
								   document.getElementById('logout-form').submit();">Salir</a>
						</li>
					</ul>
				</div>

				</ul>
		</div>
	</nav>
	
	
@endguest
