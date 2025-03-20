<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Alerta extends Component
{
    public $mensaje;
    public $tipo;

    protected $listeners = ['mostrarAlerta' => 'mostrarMensaje'];

    public function mostrarMensaje($mensaje, $tipo)
    {
        $this->mensaje = $mensaje;
        $this->tipo = $tipo;
    }
  
    public function render()
    {
        return view('livewire.components.alerta');
    }
}
