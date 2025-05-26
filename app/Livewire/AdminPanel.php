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

    public function mount()
    {
        $this->cargarItems();
    }

    public function cambiarSeccion(string $nuevaSeccion)
    {
        $this->seccion = $nuevaSeccion;
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
        ])->layout('layouts.app');
    }
}
