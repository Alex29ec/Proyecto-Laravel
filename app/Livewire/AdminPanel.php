<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Menu;
use App\Models\Mesa;
use App\Models\Reserva;

class AdminPanel extends Component
{
    public $seccion = 'usuarios'; 

    public function cambiarSeccion($seccion)
    {
        $this->seccion = $seccion;
    }

    public function eliminar($id)
    {
        if ($this->seccion === 'usuarios') {
            User::destroy($id);
        } elseif ($this->seccion === 'menus') {
            Menu::destroy($id);
        }
    }
    
    public function render()
    {
        return view('livewire.panel', [
            'usuarios' => User::all(),
            'menus' => Menu::all(),
        ]);
    }
}
