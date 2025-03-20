@extends('layouts.app')
@section('content')
    <div class="container">

        <!-- Formulario para editar el perfil -->
        <form method="POST" action="{{ route('profile.update', ['usuarioId' => $user->id]) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

        <!-- Mostrar los teléfonos del usuario -->
        <h3>Mis Teléfonos</h3>
        @if ($errors->has('telefono'))
    <div class="alert alert-danger">
        {{ $errors->first('telefono') }}
    </div>
@endif
        <form method="POST" action="{{ route('profile.agregarTelefono', ['usuarioId' => $user->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="telefono" class="form-label">Nuevo Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Agregar Teléfono</button>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->telefonos as $telefono)
    <tr>
        <td>{{ $telefono->id }}</td>
        <td>{{ $telefono->numero }}</td>
        <td>
            <form method="POST" action="{{ route('profile.eliminarTelefono', ['usuarioId' => $user->id, 'telefonoId' => $telefono->id]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>

        @if (session('status'))
            <div class="alert alert-success mt-4">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
