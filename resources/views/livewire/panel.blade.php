<div class="container mt-5">
    <h2 class="mb-4">Panel de Administración</h2>

    <!-- Barra de navegación -->
    <div class="btn-group mb-3">
        <button wire:click="cambiarSeccion('usuarios')" class="btn btn-primary">Usuarios</button>
        <button wire:click="cambiarSeccion('menus')" class="btn btn-primary">Menús</button>
    </div>
    
    @if ($seccion === 'menus')
        <a href="{{ route('admin.create.menu') }}" class="btn btn-success mb-3">Añadir Nuevo Menú</a>
    @endif

    <!-- Tabla de datos -->
    <table class="table table-striped">
        <thead>
            <tr>
                @if ($seccion === 'usuarios')
                    <th>ID</th><th>Nombre</th><th>Email</th><th>Acción</th>
                @elseif ($seccion === 'menus')
                    <th>ID</th><th>Nombre</th><th>Precio</th><th>Descripcion</th><th>Acción</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($$seccion as $item)
                <tr>
                    @if ($seccion === 'usuarios')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                    @elseif ($seccion === 'menus')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->precio }}</td>
                    @endif
                    <td>
                        <button wire:click="eliminar({{ $item->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                        @if ($seccion === 'usuarios')
                            <a href="{{ route('admin.editar.usuario', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @elseif ($seccion === 'menus')
                            <a href="{{ route('admin.editar.menu', $item->id) }}" class="btn btn-warning">Editar</a>
                        @endif
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
