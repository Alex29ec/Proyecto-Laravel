@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h2>Crear Nuevo Tatuador</h2>
    <form method="POST" action="{{ route('tatuador.store') }}">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Especialidades</label>
            <input name="specialties" class="form-control">
        </div>
        <div class="form-group">
            <label>Ruta de Foto</label>
            <input name="photo" class="form-control">
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input name="password" type="password" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
@endsection
