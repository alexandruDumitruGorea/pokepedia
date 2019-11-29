<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <title>Pokepedia</title>
</head>
<body>
    <div class="wrapper">
        <header class="header-container">
            <div class="container">
                <div class="header">
                    <div class="header-logo">
                        <img src="{{ url('assets/img/logo-pokemon.png') }}" alt="Logo Pokemon">
                    </div>
                    <div class="main-menu">
                        <ul class="main-menu-list">
                            <li class="main-menu-item">
                                <a href="{{ url('/') }}" class="main-menu-link">Inicio</a>
                            </li>
                            <li class="main-menu-item">
                                <a href="{{ url('post') }}" class="main-menu-link">Posts</a>
                            </li>
                            @auth
                                <li class="main-menu-item main-menu-item_user">
                                    <p>Hola {{ Auth::user()->name }}!</p>
                                </li>
                                <li class="main-menu-item">
                                    <form id='frm-logout' action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-info" value="Cerrar sesión"/>
                                    </form>
                                </li>
                            @else
                                <li class="main-menu-item">
                                    <a href="{{ url('login') }}" class="main-menu-link main-menu-link_login">Iniciar Sesión</a>
                                </li>
                                <li class="main-menu-item">
                                    <a href="{{ url('register') }}" class="main-menu-link main-menu-link_register">Registrate</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </header>
         <!-- CONTENIDO A RELLENAR -->
         @yield('content')
    </div>
    <script src="{{ url('assets/js/main.js') }}"></script>
</body>
</html>