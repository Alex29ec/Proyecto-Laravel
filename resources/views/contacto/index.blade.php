@extends('layouts.app')

@section('content')
<div class="container my-5" style="background-color: #9C9C9C; padding: 20px; border-radius: 10px;">
    <div class="row align-items-center">
        <!-- Foto izquierda -->
        <div class="col-md-3 text-center mb-4 mb-md-0">
            <img src="{{ asset('storage/contacto/estudio1.png') }}" class="img-fluid rounded" style="height: 100%; max-height: 500px; object-fit: cover;">
        </div>

        <!-- Información central -->
        <div class="col-md-6 text-center p-4">
            <h2 class="mb-4 text-light">Contáctanos</h2>
            <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad</p>
            <p><strong>Teléfono:</strong> +34 600 000 000</p>
            <p><strong>Email:</strong> contacto@tupagina.com</p>
            <p><strong>Horario:</strong> Lunes a Viernes - 10:00 a 20:00</p>

            <!-- Redes Sociales -->
            <div class="mt-4">
                <h5>Síguenos</h5>
                <a href="#" class="mx-2 text-dark"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="mx-2 text-dark"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="mx-2 text-dark"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="mx-2 text-dark"><i class="fab fa-tiktok fa-2x"></i></a>
            </div>
        </div>
        <!-- Foto derecha -->
        <div class="col-md-3 text-center mt-4 mt-md-0">
            <img src="{{ asset('storage/contacto/estudio2.png') }}" class="img-fluid rounded" style="height: 100%; max-height: 500px; object-fit: cover;">
        </div>
    </div>
</div>
@endsection
