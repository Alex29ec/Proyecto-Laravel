@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">404</h1>
    <h2 class="mb-4">¡POR LAS BARBAS DE NEPTUNO! Página no encontrada</h2>
    <p class="lead">La página que estás buscando no existe o ha sido movida.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver al inicio</a>
</div>
@endsection