<?php

namespace App\Livewire;

use App\Models\Reserva;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PerfilUsuario extends Component
{
    public $reservas;
    public $telefonos;

    public function mount()
    {
        $this->reservas = Reserva::where('id_cliente', auth()->id())
                                 ->with('tatuador')
                                 ->get();
    }

    public function cancelarReserva($id)
    {
        $reserva = Reserva::where('id', $id)
                          ->where('id_cliente', Auth::id())
                          ->first();

        if ($reserva) {
            $reserva->delete();
            session()->flash('success', 'Reserva cancelada con éxito.');
            $this->reservas = Reserva::where('id_cliente', Auth::id())
                                     ->with('tatuador')
                                     ->get();
        } else {
            session()->flash('error', 'No se pudo cancelar la reserva.');
        }
          $this->mount();
    }

public function render()
{
    return view('livewire.perfil-usuario')->layout('layouts.app'); 
}

}
