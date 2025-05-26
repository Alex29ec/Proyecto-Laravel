@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4 ">
            <div class="banner text-center justify-content-center" style="background-image: url('{{ asset('storage/imagenes/fotoprincipal.png') }}'); background-size: cover; height: 250px; position: relative;">
                <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
                <div class="banner-text position-absolute top-50 start-50 translate-middle text-white">
                    <div class="mt-3 d-flex flex-column " style="background-color:gray ; width: 300px; margin: 10px,10px,10px,10px; padding: 15px;">
                        <a href="reservas/create" class="btn btn-light  mb-2">Pedir Cita</a>
                        <a href="/galeria" class="btn btn-light mb-2">Galería</a>
                        <a href="/contacto" class="btn btn-light">Contacto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="row justify-content-center">
    @foreach($tatuadores as $tatuador)
        <div class="col-md-3 mb-4 w-20 h-20">
            <div class="card bg-dark text-white border-light">
                @if($tatuador->photo)
                    <img src="{{ asset('storage/fotos/' . $tatuador->photo) }}" class="cuadrada card-img-top" alt="{{ $tatuador->name }}">
                @else
                    <img src="{{ asset('storage/fotos/default.png') }}" class="cuadrada card-img-top" alt="Sin foto">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{ strtoupper($tatuador->name) }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>
@endsection