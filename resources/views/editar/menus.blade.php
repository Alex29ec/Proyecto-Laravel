@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Menú</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.actualizar.menu', $menu->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $menu->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $menu->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio', $menu->precio) }}">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            @if ($menu->imagen)
                <p>Imagen actual:</p>
                
                <img src="{{ asset('storage/imagenes/' . $menu->imagen) }}" alt="Imagen del menú" width="150">
                @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Menú</button>
    </form>
</div>
@endsection
