@extends('layouts.app')

@section('content')
<div class="container my-5 text-white">
    <h2 class="mb-4">Panel de Reservas</h2>

    @forelse ($reservas as $fecha => $lista)
        @php
            $carbonFecha = \Carbon\Carbon::parse($fecha);
            $titulo = match(true) {
                $carbonFecha->isToday() => 'Hoy:',
                $carbonFecha->isTomorrow() => 'Mañana:',
                default => $carbonFecha->format('d/m/Y') . ':',
            };
        @endphp

        <div class="mb-5">
            <h4 class="mb-3">{{ $titulo }}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($lista as $reserva)
                    <div class="bg-dark p-4 rounded shadow text-white">
                        <h5 class="font-bold">{{ $reserva->hour }}</h5>
                        <p>Cliente: {{ $reserva->cliente->name ?? 'Sin nombre' }}</p>
                        <p>Teléfono: {{ $reserva->cliente->phone ?? 'Sin teléfono' }}</p>
                        <p>Email: {{ $reserva->cliente->email ?? '---' }}</p>
                        @if ($reserva->image)
                            <p>Tatuaje:</p>
                            <img src="{{ asset( $reserva->foto) }}" alt="Tatuaje" class="img-fluid mt-2 rounded">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p>No tienes reservas próximas.</p>
    @endforelse
</div>
@endsection
