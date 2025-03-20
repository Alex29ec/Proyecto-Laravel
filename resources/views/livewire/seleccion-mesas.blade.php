<div>
    <!-- Selección de fecha y hora -->
    <div class="mb-4">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" id="fecha" wire:model="fecha" class="form-control">
    </div>
    
    <div class="mb-4">
        <label for="hora" class="form-label">Hora</label>
        <select id="hora" wire:model="hora" class="form-control">
            <option value="">Seleccione una hora</option>
            @for ($i = 12; $i <= 22; $i++) <!-- Horario de 12:00 a 22:00 -->
                <option value="{{ $i }}:00">{{ $i }}:00</option>
            @endfor
        </select>
    </div>

    <!-- Selección del número de personas -->
    <div class="mb-4">
        <label for="personas" class="form-label">Número de Personas</label>
        <select id="personas" wire:model="personas" class="form-control">
            <option value="">Seleccione</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <!-- Botón para actualizar mesas disponibles -->
    <button wire:click="actualizarMesas" class="btn btn-primary">Buscar Mesas</button>

    <!-- Mostrar mesas disponibles -->
    @if($mesasDisponibles)
        <h3 class="mt-4">Mesas Disponibles</h3>
        <div class="row">
            @foreach($mesasDisponibles as $mesa)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/imagenes/mesas/' . $mesa->imagen) }}" class="card-img-top" alt="Mesa {{ $mesa->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mesa->nombre }}</h5>
                            <p class="card-text">Capacidad: {{ $mesa->capacidad }} personas</p>
                            <button wire:click="reservarMesa({{ $mesa->id }})" class="btn btn-success">Reservar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Mensajes de error o éxito -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>
