
<header class="header">
    <div class="menu">

        <div class="logo">
            <!--Logo-->
            <a ><img width="115" height="115" src="{{asset('images/logo.png')}} " alt="Logo"></a>
        </div>
         <!--Utilizamos guest para usuarios que no esten registrados y asi mostrar la parte de acceder y crear cuenta ; con route('') ponermos la ruta del href-->

   
        <ul class="d-flex">
            <a href="{{route('login')}}" class="login">Acceder</a>
            <a href="{{route('register')}}" class="create">Crear cuenta</a>
        </ul>
       
        <!--Si esta autoenticado mostrara todo lo de abajo-->
        
        </nav>
    </div>


</header>

