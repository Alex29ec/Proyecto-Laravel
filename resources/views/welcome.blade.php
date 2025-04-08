@extends('layouts.app')
@section('content')

<div class="container text-center">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="banner" style="background-image: url('{{ asset('storage/imagenes/banner.png') }}'); background-size: cover; height: 250px; position: relative;">
                <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
                <div class="banner-text position-absolute top-50 start-50 translate-middle text-white">
                    <h1>Bienvenido</h1>
                    <div class="mt-3">
                        <a href="#" class="btn btn-light">Pedir Cita</a>
                        <a href="#" class="btn btn-light">Preguntas</a>
                        <a href="#" class="btn btn-light">Reseñas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white border-light">
                <img src="{{ asset('storage/imagenes/miguel.jpg') }}" class="card-img-top" alt="Miguel">
                <div class="card-body">
                    <h5 class="card-title">MIGUEL</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white border-light">
                <img src="{{ asset('storage/imagenes/sergio.jpg') }}" class="card-img-top" alt="Sergio">
                <div class="card-body">
                    <h5 class="card-title">SERGIO</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white border-light">
                <img src="{{ asset('storage/imagenes/juan.jpg') }}" class="card-img-top" alt="Juan">
                <div class="card-body">
                    <h5 class="card-title">JUAN</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white border-light" style="width: 120%;">
                <img src="{{ asset('storage/imagenes/tatuador.jpg') }}" class="card-img-top" alt="Tatuador">
                <div class="card-body">
                    <h5 class="card-title">TATUADOR DESTACADO</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
