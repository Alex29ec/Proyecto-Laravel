<div class="container mt-5 text-white">
    <h2 class="mb-4">Panel de Administración</h2>

   <div class="mb-4 d-flex gap-2">
    <button wire:click="cambiarSeccion('usuarios')"
        class="boton-seccion {{ $seccion === 'usuarios' ? 'boton-activo' : '' }}">USUARIOS</button>

    <button wire:click="cambiarSeccion('reservas')"
        class="boton-seccion {{ $seccion === 'reservas' ? 'boton-activo' : '' }}">RESERVAS</button>

    <button wire:click="cambiarSeccion('tatuadores')"
        class="boton-seccion {{ $seccion === 'tatuadores' ? 'boton-activo' : '' }}">ARTISTAS</button>

    <button wire:click="cambiarSeccion('photos')"
        class="boton-seccion {{ $seccion === 'photos' ? 'boton-activo' : '' }}">FOTOS</button>
</div>


    @if ($seccion === 'tatuadores')
        <button onclick="location.href='{{ route('tatuador.create') }}'" class="btn btn-success mb-3">
            Crear Tatuador
        </button>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered text-white">
        <thead>
            <tr>
                @if ($seccion === 'usuarios')
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Género</th>
                    <th>Fecha Nacimiento</th>
                    <th>Rol</th>
                    <th>Verificado</th>
                    <th>Acciones</th>
                @elseif ($seccion === 'tatuadores')
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Especialidades</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                @elseif ($seccion === 'reservas')
                    <th>Cliente</th>
                    <th>Tatuador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                @elseif ($seccion === 'photos')
                    <th>Tatuador</th>
                    <th>Estilo</th>
                    <th>Zona</th>
                    <th>Tamaño</th>
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
                <tr wire:key="{{ $seccion }}-{{ $item->id }}">
                    @if ($editandoId === $item->id)
                        @if ($seccion === 'usuarios')
                            <td><input type="text" wire:model="nombre" class="form-control"></td>
                            <td><input type="text" wire:model="username" class="form-control"></td>
                            <td><input type="email" wire:model="email" class="form-control"></td>
                            <td><input type="text" wire:model="telefono" class="form-control"></td>
                            <td><input type="text" wire:model="genero" class="form-control"></td>
                            <td><input type="date" wire:model="nacimiento" class="form-control"></td>
                            <td><input type="text" wire:model="rol" class="form-control"></td>
                            <td>—</td>
                        @elseif ($seccion === 'tatuadores')
                            <td><input type="text" wire:model="nombre" class="form-control"></td>
                            <td><input type="email" wire:model="email" class="form-control"></td>
                            <td><input type="text" wire:model="especialidades" class="form-control"></td>
                            <td><input type="text" wire:model="foto" class="form-control"></td>
                        @elseif ($seccion === 'reservas')
                            <td><input type="number" wire:model="cliente_id" class="form-control"></td>
                            <td><input type="number" wire:model="tatuador_id" class="form-control"></td>
                            <td><input type="date" wire:model="fecha" class="form-control"></td>
                            <td><input type="text" wire:model="hora" class="form-control"></td>
                        @elseif ($seccion === 'photos')
                            <td><input type="number" wire:model="tatuador_id" class="form-control"></td>
                            <td><input type="text" wire:model="estilo" class="form-control"></td>
                            <td><input type="text" wire:model="zona" class="form-control"></td>
                            <td><input type="text" wire:model="tamano" class="form-control"></td>
                        @endif
                        <td>
                            <button wire:click.prevent="guardar" class="btn btn-success btn-sm">Guardar</button>
                            <button wire:click.prevent="cancelar" class="btn btn-secondary btn-sm">Cancelar</button>
                        </td>
                    @else
                        @if ($seccion === 'usuarios')
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->birthdate }}</td>
                            <td>{{ $item->rol }}</td>
                            <td>{{ $item->email_verified_at ? 'Sí' : 'No' }}</td>
                        @elseif ($seccion === 'tatuadores')
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->specialties }}</td>
                            <td>{{ $item->photo }}</td>
                        @elseif ($seccion === 'reservas')
                            <td>{{ $item->cliente->name ?? 'Sin cliente' }}</td>
                            <td>{{ $item->tatuador->name ?? 'Sin tatuador' }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->hour }}</td>
                        @elseif ($seccion === 'photos')
                            <td>{{ $item->tatuador->name ?? 'Sin tatuador' }}</td>
                            <td>{{ $item->estilo }}</td>
                            <td>{{ $item->zona }}</td>
                            <td>{{ $item->tamano }}</td>
                        @endif
                        <td>
                            <button wire:click="editar({{ $item->id }})"
                                class="btn btn-warning btn-sm">Editar</button>
                            <button wire:click="eliminar({{ $item->id }})"
                                class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
