<?php
namespace App\Livewire;
    use Livewire\Component;
    use App\Models\Reserva;
    use Illuminate\Support\Facades\Auth;

    class PerfilUsuario extends Component
    {
        public $reservas;
        public $telefonos;

        public function mount()
        {
            $this->reservas = Reserva::where('user_id', Auth::id())->with('mesa')->latest()->get();
            $this->telefonos = Auth::user()->telefonos;
        }

        public function cancelarReserva($id)
        {
            $reserva = Reserva::where('id', $id)->where('user_id', Auth::id())->first();

            if ($reserva) {
                $reserva->delete();
                session()->flash('success', 'Reserva cancelada con éxito.');
                $this->reservas = Reserva::where('user_id', Auth::id())->with('mesa')->latest()->get();
            } else {
                session()->flash('error', 'No se pudo cancelar la reserva.');
            }
        }

        public function render()
        {   
            return view('livewire.perfil-usuario');

        }
    }
