@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-white">
        <div class="row mb-4">
            <div class="col-md-4">
                <img src="{{ asset('storage/fotos/' . $tatuador->photo) }}" class="img-fluid rounded"
                    alt="Foto de {{ $tatuador->name }}">
            </div>
            <div class="col-md-8">
                <h2>{{ $tatuador->name }}</h2>
                <h5 class="mt-3">Especialidades:</h5>
                <p>{!! nl2br(e($tatuador->specialties)) !!}</p>

                <h5>Correo:</h5>
                <p>{{ $tatuador->email }}</p>

                <a href="{{ url('/artistas') }}" class="btn btn-outline-light mt-3">← Volver a artistas</a>
            </div>
        </div>

        @if (Auth::guard('tatuador')->check() && Auth::guard('tatuador')->id() === $tatuador->id)
            <form action="{{ route('tatuador.actualizar') }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                {{-- Datos básicos --}}
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" value="{{ $tatuador->name }}" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="email">Correo:</label>
                    <input type="email" name="email" value="{{ $tatuador->email }}" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="specialties">Especialidades:</label>
                    <textarea name="specialties" rows="3" class="form-control">{{ $tatuador->specialties }}</textarea>
                </div>

                {{-- Contraseña --}}
                <hr class="my-4">
                <h5>Cambiar contraseña (opcional)</h5>

                <div class="form-group mt-3">
                    <label for="current_password">Contraseña actual:</label>
                    <input type="password" name="current_password" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="new_password">Nueva contraseña:</label>
                    <input type="password" name="new_password" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="new_password_confirmation">Confirmar nueva contraseña:</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-success mt-4">Actualizar datos y/o contraseña</button>
            </form>


            {{-- Formulario para subir nueva foto --}}
            <hr class="my-5">
            <h5>Subir nueva foto a la galería</h5>

            @if (isset($foto))
    <h5>Actualizar foto</h5>
    <form action="{{ route('tatuador.foto.actualizar', $foto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label for="ruta">Cambiar imagen (opcional):</label>
            <input type="file" name="ruta" class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="estilo">Estilo:</label>
            <input type="text" name="estilo" class="form-control" value="{{ $foto->estilo }}">
        </div>

        <div class="form-group mt-3">
            <label for="tamano">Tamaño:</label>
            <input type="text" name="tamano" class="form-control" value="{{ $foto->tamano }}">
        </div>

        <div class="form-group mt-3">
            <label for="zona">Ubicación:</label>
            <input type="text" name="zona" class="form-control" value="{{ $foto->zona }}">
        </div>

        <button type="submit" class="btn btn-warning mt-3">Actualizar foto</button>
    </form>
@else
    {{-- formulario original de subida --}}
    <form action="{{ route('tatuador.foto.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mt-3">
            <label for="ruta">Selecciona la imagen:</label>
            <input type="file" name="ruta" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="estilo">Estilo:</label>
            <input type="text" name="estilo" class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="tamano">Tamaño:</label>
            <input type="text" name="tamano" class="form-control">
        </div>

        <div class="form-group mt-3">
            <label for="zona">Ubicación:</label>
            <input type="text" name="zona" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning mt-3">Subir a galería</button>
    </form>
@endif

        @endif

        @if ($tatuador->fotos->count())
            <h4 class="mb-3">Galería de tatuajes:</h4>
            <div class="row">
                @foreach ($tatuador->fotos as $foto)
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('storage/galeria/' . $foto->ruta) }}" class="cuadrada img-fluid rounded shadow"
                            alt="Tatuaje de {{ $tatuador->name }}">

                        {{-- Botones de acción --}}
                        @if ( Auth::guard('tatuador')->id() === $tatuador->id)
                            
                        <form action="{{ route('tatuador.foto.eliminar', $foto->id) }}" method="POST"
                            class="d-inline mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Eliminar</button>
                        </form>

                        <form action="{{ route('tatuador.foto.editar', $foto->id) }}" method="GET" class="d-inline">
                            <button type="submit" class="btn btn-sm btn-info mt-2">Actualizar</button>
                        </form>
                        
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
