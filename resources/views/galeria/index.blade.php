@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #9C9C9C; padding: 20px; border-radius: 10px;">
        <h1 class=" mb-4 text-center">GALERIA</h1>
        <form method="GET" action="{{ route('galeria') }}" class="row mb-4 g-2">
            <div class="col-md-3">
                <select name="estilo" id="estilo" class="form-select rounded-pill shadow-sm"
                    style="background-color: #D9D9D9; width: 100%; min-width: 250px;">
                    <option value="">Estilo:</option>
                    @foreach ($estilos as $estilo)
                        <option value="{{ $estilo }}" {{ request('estilo') == $estilo ? 'selected' : '' }}>
                            {{ ucfirst($estilo) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="zona" id="zona" class="form-select rounded-pill shadow-sm"
                    style="background-color: #D9D9D9; width: 100%; min-width: 250px;">
                    <option value="">Zona:</option>
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona }}" {{ request('zona') == $zona ? 'selected' : '' }}>
                            {{ ucfirst($zona) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="tamano" id="tamano" class="form-select rounded-pill shadow-sm"
                    style="background-color: #D9D9D9; width: 100%; min-width: 250px;">
                    <option value="">Tamaño:</option>
                    @foreach (['pequeño', 'mediano', 'grande'] as $tamano)
                        <option value="{{ $tamano }}" {{ request('tamano') == $tamano ? 'selected' : '' }}>
                            {{ ucfirst($tamano) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn w-100"
                    style="background-color: #D9D9D9; border-radius: 50px; min-width: 250px;">
                    Filtrar
                </button>
            </div>
        </form>

        {{-- Galería --}}
        <div class="row">
            @forelse($fotos as $foto)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('storage/galeria/' . $foto->ruta) }}" class="card-img-top"
                            style="height: 250px; object-fit: cover;" alt="Foto">
                    </div>
                </div>
            @empty
                <p>No hay fotos que coincidan con los filtros.</p>
            @endforelse
        </div>
    </div>
@endsection
