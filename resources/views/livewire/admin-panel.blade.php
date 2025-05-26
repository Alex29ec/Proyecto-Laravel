<div class="container mt-5 text-white">
    <h2 class="mb-4">Panel de Administración</h2>

    <div class="btn-group mb-3">
        <button wire:click="cambiarSeccion('usuarios')" class="btn btn-primary">Usuarios</button>
        <button wire:click="cambiarSeccion('tatuadores')" class="btn btn-primary">Tatuadores</button>
        <button wire:click="cambiarSeccion('reservas')" class="btn btn-primary">Reservas</button>
        <button wire:click="cambiarSeccion('photos')" class="btn btn-primary">Fotos</button>
    </div>

    <table class="table table-striped text-white">
        <thead>
            <tr>
                @if ($seccion === 'usuarios')
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acción</th>
                @elseif ($seccion === 'tatuadores')
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Especialidades</th>
                    <th>Acción</th>
                @elseif ($seccion === 'reservas')
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tatuador</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acción</th>
                @elseif ($seccion === 'photos')
                    <th>ID</th>
                    <th>Tatuador</th>
                    <th>Estilo</th>
                    <th>Zona</th>
                    <th>Tamaño</th>
                    <th>Imagen</th>
                    <th>Acción</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @if ($seccion === 'usuarios')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->rol }}</td>
                    @elseif ($seccion === 'tatuadores')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->specialties }}</td>
                    @elseif ($seccion === 'reservas')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->cliente->name ?? 'Sin cliente' }}</td>
                        <td>{{ $item->tatuador->name ?? 'Sin tatuador' }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->hour }}</td>
                    @elseif ($seccion === 'photos')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->tatuador->name ?? 'Sin tatuador' }}</td>
                        <td>{{ $item->estilo }}</td>
                        <td>{{ $item->zona }}</td>
                        <td>{{ $item->tamano }}</td>
                        <td><img src="{{ asset('storage/' . $item->ruta) }}" style="height: 50px;"></td>
                    @endif
                    <td>
                        <button wire:click="eliminar({{ $item->id }})"
                            class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
