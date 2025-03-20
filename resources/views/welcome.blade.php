@extends('layouts.app')

@section('content')
@livewire('components.alerta', ['mensaje' => '¡Bienvenido a la plataforma!', 'tipo' => 'success'])

    <div class="container">
        <h1>Menú</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))

    @livewire('components.alerta', ['mensaje' => session('error'), 'tipo' => 'danger'])

    @endif
        @if (Auth::check())
            <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">Hacer una Reserva</a>
        @else
            <p>Por favor, inicia sesión para realizar una reserva.</p>
        @endif

        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <!-- Imagen del menú -->
                        <img src="{{ asset('storage/imagenes/'.$menu->imagen) }}" class="card-img-top" alt="{{ $menu->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nombre }}</h5>
                            <p class="card-text">{{ $menu->descripcion }}</p>
                            <p class="card-text">Precio: {{ $menu->precio }}€</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection