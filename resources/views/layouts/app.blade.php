<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- Incluye el token CSRF para la seguridad en formularios -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título de la página -->
    <title>{{ config('app.name', 'Conalep') }}</title>
        <link rel="icon" href="{{ asset('imagen/logo1.png') }}" type="image/png">


    <!-- Fuentes -->
    <!-- Prefetch de DNS para mejorar la carga de las fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- Incluye la fuente Nunito desde Bunny Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Archivos de Toastr -->
    <!-- Aquí se incluirían los archivos necesarios para Toastr, si fueran necesarios -->

    <!-- barras de busqueda-->
    <!-- Aquí se incluirían las barras de búsqueda, si fueran necesarias -->

    <!-- boton eliminar imagen -->
    <!-- Aquí se incluiría el botón para eliminar una imagen, si fuera necesario -->

    <!-- Scripts -->
    <!-- Utiliza Vite para compilar y enlazar los archivos de estilos y JavaScript -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <!-- Contenedor principal de la aplicación -->
    <div id="app">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Enlace a la página principal -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('imagen/logo_cona.jpg') }}" alt="Logo" style="height: 40px;">
                </a>
                <!-- Botón para colapsar la barra de navegación en pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido de la barra de navegación -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado izquierdo de la barra de navegación -->
                    <ul class="navbar-nav me-auto">
                        <!-- Enlace a la lista de materiales -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Material.index') }}">Lista de Materiales</a>
                        </li>
                        <!-- Enlace a la lista de préstamos -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Prestamo.index') }}">Lista de Préstamos</a>
                        </li>
                    </ul>

                    <!-- Lado derecho de la barra de navegación -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Verifica si el usuario no está autenticado -->
                        @guest
                            <!-- Enlace al inicio de sesión si la ruta existe -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            <!-- Enlace al registro si la ruta existe -->
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Menú desplegable para el usuario autenticado -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <!-- Opciones del menú desplegable -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Enlace para cerrar sesión -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <!-- Formulario para cerrar sesión -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Mensajes de éxito -->
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <!-- Mensajes de error -->
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <!-- Contenido principal de la página -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    @vite(['resources/js/app.js'])
</body>
</html>

