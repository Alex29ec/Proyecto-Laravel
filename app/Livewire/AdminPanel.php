<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Tatuador;
use App\Models\Reserva;
use App\Models\Photo;

class AdminPanel extends Component
{
    public string $seccion = 'usuarios';
    public $items = [];
    public $editandoId = null;

    // Usuarios
    public $nombre, $username, $email, $telefono, $genero, $nacimiento, $rol;

    // Tatuadores
    public $especialidades, $foto;

    // Reservas
    public $cliente_id, $tatuador_id, $fecha, $hora;

    // Fotos
    public $estilo, $zona, $tamano;

    public function mount()
    {
        $this->cargarItems();
    }

    public function cambiarSeccion(string $nuevaSeccion)
    {
        $this->seccion = $nuevaSeccion;
        $this->editandoId = null;

        $this->reset([
            'nombre', 'username', 'email', 'telefono', 'genero', 'nacimiento', 'rol',
            'especialidades', 'foto',
            'cliente_id', 'tatuador_id', 'fecha', 'hora',
            'estilo', 'zona', 'tamano',
        ]);

        $this->cargarItems();
    }

    public function cargarItems()
    {
        $this->items = match ($this->seccion) {
            'usuarios' => User::all(),
            'tatuadores' => Tatuador::all(),
            'reservas' => Reserva::with(['cliente', 'tatuador'])->get(),
            'photos' => Photo::with('tatuador')->get(),
            default => collect(),
        };
    }

    public function editar($id)
    {
        $this->editandoId = $id;

        match ($this->seccion) {
            'usuarios' => $this->cargarUsuario($id),
            'tatuadores' => $this->cargarTatuador($id),
            'reservas' => $this->cargarReserva($id),
            'photos' => $this->cargarPhoto($id),
        };
    }

    public function guardar()
    {

        match ($this->seccion) {
            'usuarios' => $this->guardarUsuario(),
            'tatuadores' => $this->guardarTatuador(),
            'reservas' => $this->guardarReserva(),
            'photos' => $this->guardarPhoto(),
        };

        $this->editandoId = null;
        $this->cargarItems();
    }

    public function cancelar()
    {
        $this->editandoId = null;

        $this->reset([
            'nombre', 'username', 'email', 'telefono', 'genero', 'nacimiento', 'rol',
            'especialidades', 'foto',
            'cliente_id', 'tatuador_id', 'fecha', 'hora',
            'estilo', 'zona', 'tamano',
        ]);
    }

    // -------- CARGA INDIVIDUAL --------

    private function cargarUsuario($id)
    {
        $u = User::findOrFail($id);
        $this->nombre = $u->name;
        $this->username = $u->username;
        $this->email = $u->email;
        $this->telefono = $u->phone;
        $this->genero = $u->gender;
        $this->nacimiento = $u->birthdate;
        $this->rol = $u->rol;
    }

    private function cargarTatuador($id)
    {
        $t = Tatuador::findOrFail($id);
        $this->nombre = $t->name;
        $this->email = $t->email;
        $this->especialidades = $t->specialties;
        $this->foto = $t->photo;
    }

    private function cargarReserva($id)
    {
        $r = Reserva::findOrFail($id);
        $this->cliente_id = $r->id_cliente;
        $this->tatuador_id = $r->id_tatuador;
        $this->fecha = $r->date;
        $this->hora = $r->hour;
    }

    private function cargarPhoto($id)
    {
        $p = Photo::findOrFail($id);
        $this->tatuador_id = $p->idtatuador;
        $this->estilo = $p->estilo;
        $this->zona = $p->zona;
        $this->tamano = $p->tamano;
    }

    // -------- GUARDADO INDIVIDUAL --------

    private function guardarUsuario()
    {
        try {

            $this->validate([
                'nombre' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'required|string|max:255',
                'genero' => 'required|string|max:255',
                'nacimiento' => 'required|date',
                'rol' => 'required|string|max:255',
            ]);

            $usuario = User::findOrFail($this->editandoId);

            $usuario->update([
                'name' => $this->nombre,
                'username' => $this->username,
                'email' => $this->email,
                'phone' => $this->telefono,
                'gender' => $this->genero,
                'birthdate' => $this->nacimiento,
                'rol' => $this->rol,
            ]);

            session()->flash('success', 'Usuario actualizado correctamente.');

        } catch (\Exception $e) {
            logger()->error('Error al guardar usuario: ' . $e->getMessage());
            session()->flash('error', 'No se pudo guardar el usuario. Verifica los campos.');
        }
    }

    private function guardarTatuador()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'especialidades' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
        ]);

        Tatuador::findOrFail($this->editandoId)->update([
            'name' => $this->nombre,
            'email' => $this->email,
            'specialties' => $this->especialidades,
            'photo' => $this->foto,
        ]);
    }

    private function guardarReserva()
    {
        $this->validate([
            'cliente_id' => 'required|integer',
            'tatuador_id' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|string|max:255',
        ]);

        Reserva::findOrFail($this->editandoId)->update([
            'id_cliente' => $this->cliente_id,
            'id_tatuador' => $this->tatuador_id,
            'date' => $this->fecha,
            'hour' => $this->hora,
        ]);
    }

    private function guardarPhoto()
    {
        $this->validate([
            'tatuador_id' => 'required|integer',
            'estilo' => 'nullable|string|max:255',
            'zona' => 'nullable|string|max:255',
            'tamano' => 'nullable|string|max:255',
        ]);

        Photo::findOrFail($this->editandoId)->update([
            'idtatuador' => $this->tatuador_id,
            'estilo' => $this->estilo,
            'zona' => $this->zona,
            'tamano' => $this->tamano,
        ]);
    }

    public function eliminar($id)
    {
        match ($this->seccion) {
            'usuarios' => User::destroy($id),
            'tatuadores' => Tatuador::destroy($id),
            'reservas' => Reserva::destroy($id),
            'photos' => Photo::destroy($id),
        };

        $this->cargarItems();
    }

    public function render()
    {
        return view('livewire.admin-panel', [
            'items' => $this->items,
            'seccion' => $this->seccion,
            'editandoId' => $this->editandoId,
        ])->layout('layouts.app');
    }
}
