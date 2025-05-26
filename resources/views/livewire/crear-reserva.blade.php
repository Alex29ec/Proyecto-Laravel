<form wire:submit.prevent="reservar" enctype="multipart/form-data">
    <div style="background-color: #9C9C9C; padding: 20px;">
        <h1 class="text-center text-white mb-4">RESERVAR</h1>

        @if (Auth::guard('web')->check())
            <!-- Cliente elige tatuador -->
            <select wire:model="id_tatuador">
                <option value="">Elige un tatuador</option>
                @foreach ($tatuadores as $tatuador)
                    <option value="{{ $tatuador->id }}">{{ $tatuador->name }}</option>
                @endforeach
            </select>
        @endif


        @if (Auth::guard('tatuador')->check())
            <!-- Tatuador elige cliente -->
            <select wire:model="id_cliente">
                <option value="">Elige un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                @endforeach
            </select>
        @endif


        <div class="mb-3">
            <label class="form-label text-white">Fecha:</label>
            <input type="date" wire:model="date" wire:change="cargarHorasDisponibles" class="form-control">
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Hora:</label>
            <select wire:model="hour" class="form-control">
                <option value="">Seleccione una hora</option>
                @foreach ($horasDisponibles as $hora)
                    <option value="{{ $hora }}">{{ $hora }}</option>
                @endforeach
            </select>
            @error('hour')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>




        <div class="mb-3">
            <label class="form-label text-white">Foto de referencia:</label>
            <input type="file" wire:model="image" class="form-control required">
            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-light">Reservar</button>
        </div>

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
</form>
