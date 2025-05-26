

<div class="container mt-4" style="background-color: #9C9C9C; padding: 20px; border-radius: 10px;">
    <h1 class="mb-4 text-center text-white">Perfil</h1>

    <div class="d-flex align-items-start  p-4 mb-4 rounded">
        <img src="{{ asset('storage/user-icon.png') }}" class="me-4" style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;" alt="Usuario">

        <div>
            <h4>{{ auth()->user()->name }}</h4>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Teléfono:</strong> {{ auth()->user()->phone }}</p>
            <p><strong>Género:</strong> <?php if(auth()->user()->gender === 'male') {
                echo 'Masculino';
            } else {
                echo 'Femenino';
            } ?></p>
            <p><strong>Fecha de nacimiento:</strong> {{ auth()->user()->birthdate }}</p>

            <a href="{{ route('admin.editar.usuario', Auth::user()->id) }}" class="btn btn-primary btn-sm me-2">Editar Datos</a>
            @if(auth()->user()->rol === 'admin')
                <a href="{{ route('admin') }}" class="btn btn-warning btn-sm">Panel de Administración</a>
            @endif

        </div>
    </div>

    <h3 class="text-white">Mis Reservas</h3>
    @if($reservas->isEmpty()) 
        <p class="text-white">No tienes reservas.</p>
    @else
        <div class="row">
            @foreach ($reservas as $reserva)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><strong>Tatuador:</strong> {{ $reserva->tatuador->name ?? 'Sin asignar' }}</p>
                            <p><strong>Fecha:</strong> {{ $reserva->date }}</p>
                            <p><strong>Hora:</strong> {{ $reserva->hour }}</p>
                            <button wire:click="cancelarReserva({{ $reserva->id }})" class="btn btn-danger btn-sm">Cancelar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>
