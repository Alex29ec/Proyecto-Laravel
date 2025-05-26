@extends('layouts.app')

@section('content')
    
        <div class="container mt-5" style="background-color: #9C9C9C; padding: 20px; border-radius: 10px;">
            <h1 class="text-white mb-4 text-center">ARTISTAS</h1>

            <div class="row">
                @foreach ($tatuadores as $tatuador)
                    <div class="col-md-6 mb-4 border-rounded">
                        {{-- Tarjeta del artista --}}
                        <a href="{{ route('artistas.show', $tatuador->id) }}" class="text-decoration-none">
                            <div class="card flex-row shadow">
                                <img src="{{ asset('storage/fotos/' . $tatuador->photo) }}" class="cuadrada card-img-left"
                                    style="width: 200px; object-fit: cover;" alt="Foto de {{ $tatuador->name }}">
                                <div class="card-body bg-secondary text-white">
                                    <h4 class="card-title">{{ strtoupper($tatuador->name) }}:</h4>
                                    <p class="card-text">
                                        {!! nl2br(e($tatuador->specialties)) !!}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
