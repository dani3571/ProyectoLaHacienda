@extends('adminlte::page')

@section('title', 'Panel de administracion')

@section('content_header')

@stop
@section('styles')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
<style>
/*SECCIÓN DE ACCIONES*/
#personal {
    background-color: #E8E8E8;
}

#Servicios {
    background-color: #E8E8E8;
}

#panel #Servicios .conte {
    cursor: pointer;
    height: max-content;
    background-color: #E8E8E8; /**/
    padding-bottom: 15px;
}
#panel #Servicios .conte .card {
    height: 40%;
    overflow: hidden;
}

#panel #Servicios .conte .card img {
     width: 100%;
     transition: transform 1s;
}

#panel #Servicios .conte .card img:hover {
     transform: scale( /*130%*/ 105%) /*rotate(10deg)*/;
}


/*INDIVIDUAL CARD*/
.conte {
    background: white !important;
    padding-left: 0px /*20px*/;
    height: 500px;
    width: 300px;
    border-radius: 20px;
    margin: 20px 10px;
    overflow: hidden;
    transition: transform .4s;
}

.conte:hover {
    transform: scale(103%)translateY(-2%);
}

.conte a {
    color: black;
    text-decoration: none;
}

.card {
    height: 70%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

    .card img {
        margin: auto;
        display: block;
        transition: transform 1s;
    }

#panel article {
    margin-right: 0px;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
}
</style>


@section('content')
<div id="panel">
    <h2 align="center">Acciones</h2>
	<br>
    <article id="">
    <div class="slogan">
    <!--<div class="column1">
        <h2>Reservar</h2>
    </div>
    
    <div class="column2">
        <p>aqui puedes reservar para los siguientes servicios</p>
    </div>-->
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="/admin/reservacionHotel/indexCLI"><img src="{{asset('images/hotel.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Hoteleria</h4>
                    <a type="button" href="/admin/reservacionHotel/createCLI" class="btn btn-outline-dark">Reservar</a>
                    <a type="button" href="/admin/reservacionHotel/indexCLI" class="btn btn-outline-dark">Ver mis reservas</a>
                </figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="/admin/reservas_veterinaria/indexCLI"><img src="{{asset('images/vete.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Veterinaria</h4>
                    <a type="button" href="/admin/reservas_veterinaria/createCLI" class="btn btn-outline-dark">Reservar</a>
                    <a type="button" href="/admin/reservas_veterinaria/indexCLI" class="btn btn-outline-dark">Ver mis reservas</a>
                </figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="effect-marley">
                <a href="/admin/reservas_peluqueria/indexCLI"><img src="{{asset('images/pelu.jpg')}}" alt="" class="img-responsive"  width="300" height="300"/></a>
                <figcaption>
                    <h4>Peluqueria</h4>
                    <a type="button" href="/admin/reservas_peluqueria/createCLI" class="btn btn-outline-dark">Reservar</a>
                    <a type="button" href="/admin/reservas_peluqueria/indexCLI" class="btn btn-outline-dark">Ver mis reservas</a>
                </figcaption>
                </figure>
            </div>
        </div>
    </div>
    
    <div id="personal">
    <h2 align="center">Personal</h2>
    <div>
    <article id="Servicios">
			<div class="conte">
				<a href="/admin/profile">
					<div class="card">
						<img src="{{asset('images/hacienda.png')}}">
					</div>
					<div class="box-reserva">
						<b class="reserva">VER MI PERFIL.</b>
					</div>
				</a>
			</div>

            <div class="conte">
				<a href="/admin/profile#mascotas">
					<div class="card">
						<img src="{{asset('images/hacienda.png')}}">
					</div>
					<div class="box-reserva">
						<b class="reserva">VER MIS MASCOTAS.</b>
					</div>
				</a>
			</div>

	</article>
</div>
</div>
@endsection