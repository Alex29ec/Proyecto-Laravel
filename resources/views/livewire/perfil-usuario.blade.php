<div class="container mt-4">
    <h2>Mi Perfil</h2>

    <div class="card p-3 mb-4">
        <h4>{{ auth()->user()->name }}</h4>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Números de Teléfono:</strong></p>
        <ul>
            @forelse ($telefonos as $telefono)
                <li>{{ $telefono->numero }}</li>
            @empty
                <li>No tienes números registrados.</li>
            @endforelse
        </ul>
        
        <button type="button" class="btn btn-primary">
            <a href="{{ route('admin.editar.usuario', Auth::user()->id) }}" class="btn  btn-sm">Editar Datos</a>
        </button>

        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('admin.index') }}" class="btn btn-warning">Panel de Administración</a>
        @endif
    </div>

    <h3>Mis Reservas</h3>
    @if($reservas->isEmpty())
        <p>No tienes reservas.</p>
    @else
        <div class="row">
            @foreach ($reservas as $reserva)
                <div class="col-md-4">
                    <div class="card mb-3">
                        @if($reserva->mesa)
                            <img src="{{ asset('storage/imagen/'.Auth()->user()->id.'/fotos' . $reserva->imagen) }}" class="card-img-top" alt="Reserva">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Mesa: {{ $reserva->mesa->nombre ?? 'Sin asignar' }}</h5>
                            <p><strong>Fecha:</strong> {{ $reserva->fecha_hora }}</p>
                            <p><strong>Personas:</strong> {{ $reserva->num_personas }}</p>
                            <p><strong>Estado:</strong> {{ $reserva->confirmada ? 'Confirmada' : 'Pendiente' }}</p>
                            <button wire:click="cancelarReserva({{ $reserva->id }})" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
