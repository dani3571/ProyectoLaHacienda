<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    
    <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/logo.png') }}">
     <!-- Estilos de bootstrap  utilizamos mix para minimizar los archivos css y js de nuestra apllicacion-->
   <link href="{{mix('css/app.css')}}">
   <link href="{{mix('js/app.js')}}">
  

    <!-- Estilos css generales -->
    <link href="{{ asset('css/base/css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
  
   <!--Integrando boostrap en linea-->
    <!--
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"   integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"   integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></  script>

    -->
   <!--Importamos bootstrap-->
   <!--info: https://innsotech.com/como-instalar-bootstrap-5-en-laravel-9-con-vite/-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Estilos cambiantes -->
     <!-- yield es una reservacion de espacio para cololar estilos -->
   @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- title tambien sera cambiante en cada ventana es por eso que usamos yield -->
    <title>@yield('title')</title>
</head>


<body>
    <div class="content">
        <!-- Incluir menú -->
         <!-- Include permite incluir una vista dentro de otra -->
       @include('layouts.menu')
      
   <!--La seccion tambien cambiara en las distintas vistas . usamos yield-->
    <section class="section">
    @yield('content')
    </section>
        <!-- Incluir footer -->
        @include('layouts.footer')
    </div>
     @yield('scripts')
    <!-- Scripts de bootstrap -->
    <script src="{{mix('js/app.js')}}"></script>
    
</body>

</html>