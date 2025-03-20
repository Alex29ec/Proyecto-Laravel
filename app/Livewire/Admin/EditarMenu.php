<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Menu;

class EditarMenu extends Component
{
    public $menuId;
    public $nombre;
    public $precio;

    // Inicializar el formulario con los datos del menú
    public function mount($menuId)
    {
        $menu = Menu::find($menuId);
        if ($menu) {
            $this->menuId = $menu->id;
            $this->nombre = $menu->nombre;
            $this->precio = $menu->precio;
        }
    }

    // Actualizar los datos del menú
    public function actualizarMenu()
    {
        $menu = Menu::find($this->menuId);
        $menu->nombre = $this->nombre;
        $menu->precio = $this->precio;
        $menu->save();

        session()->flash('message', 'Menú actualizado con éxito!');
        return redirect()->route('admin.panel');
    }

    public function render()
    {
        return view('livewire.admin.editar-menu');
    }
}
