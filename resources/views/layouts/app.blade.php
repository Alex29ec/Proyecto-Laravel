<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Restaurante') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>

<body style="background-color: #3D3838;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: url('{{ asset('storage/banner.png') }}') no-repeat center center; background-size: cover; padding: 10px;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" style="height: 40px;">
            </a>
            <div class="d-flex flex-grow-1 justify-content-center">
                <ul class="navbar-nav d-flex flex-row gap-4">
                    <li class="nav-item"><a class="nav-link text-white" href="#">ARTISTAS</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">GALERÍA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">RESERVAR</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">CONTACTO</a></li>
                </ul>
            </div>
            <div>
                @auth
                    <a href="{{ route('perfil')}}" class="nav-link text-white d-inline-block">{{ Auth::user()->name }}</a>
                    <a class="nav-link text-white d-inline-block" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a class="nav-link text-white" href="{{ route('login') }}">
                        <img src="{{ asset('storage/user-icon.png') }}" alt="User" style="height: 30px;">
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @livewireScripts
</body>
</html>
