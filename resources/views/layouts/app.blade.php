<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Tattoo Shop') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome desde CDN -->

    @livewireStyles
    <style>
        .cuadrada {
            width: 100%;
            aspect-ratio: 1 / 1;
            /* Hace la imagen cuadrada */
            object-fit: cover;
            /* Recorta y centra la imagen sin deformarla */
        }
    </style>
</head>

<body style="background-color: #3D3838;" class="font-tattooshop min-h-screen text-2xl flex flex-col">

    <nav class="navbar navbar-expand-lg navbar-dark h-100"
        style="background: url('{{ asset('storage/imagenes/banner.png') }}') no-repeat center center; background-size: cover; padding: 10px;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/imagenes/logo.png') }}" alt="Logo" style="height: 40px;">
            </a>
            <div class="d-flex flex-grow-1 justify-content-center">
                <ul class="navbar-nav d-flex flex-row gap-4">
                    <li class="nav-item"><a class="nav-link text-white" href="/artistas">ARTISTAS</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/galeria">GALERÍA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="reservas/create">RESERVAR</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/contacto">CONTACTO</a></li>
                    @if (Auth::guard('tatuador')->check())
                        <li class="nav-item"> <a class="nav-link text-white""
                                href="{{ route('tatuador.panel') }}">Horario</a></li>
                    @endif
                </ul>
            </div>
            <div>
                @auth('web')
                    <a href="{{ route('perfil') }}" class="nav-link text-white d-inline-block">
                        {{ Auth::guard('web')->user()->name }}
                    </a>
                    <a class="nav-link text-white d-inline-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @elseif (Auth::guard('tatuador')->check())
                    <a href="{{ route('artistas.show', Auth::guard('tatuador')->user()->id) }}"
                        class="nav-link text-white d-inline-block">

                        {{ Auth::guard('tatuador')->user()->name }}

                    </a>
                    <a class="nav-link text-white d-inline-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a class="nav-link text-white d-flex align-items-center gap-2" href="{{ route('loginunificado') }}">
                        <img src="{{ asset('storage/user-icon.png') }}" alt="User" style="height: 30px;">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </nav>

 <div class="min-h-screen flex flex-col bg-[#3D3838] font-tatooshop">
    @hasSection('content')
        @yield('content')
    @else
        {{ $slot }}
    @endif
</div>



    <footer class="bg-dark text-white py-8">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">

            <div>
                <h3 class="text-xl font-bold mb-2">TATTOO STUDIO</h3>
                <p>Arte en la piel, pasión en el alma.</p>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-2">Información Legal</h3>
                <a href="{{ route('terminos') }}" class="text-white underline hover:text-gray-300">
                    Términos y Condiciones
                </a>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-2">Contacto</h3>
                <p>Dirección: 23 Calle del Arte, Ciudad</p>
                <p>Tel: +123 456 789</p>
                <p>Email: info@tattoostudio.com</p>
                <p>Horario: Lun-Sab 10:00 - 20:00</p>
            </div>

        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @vite('resources/js/app.js')
    @livewireScripts
</body>

</html>
