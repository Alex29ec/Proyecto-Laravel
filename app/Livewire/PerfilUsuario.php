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
            $this->reservas = Reserva::where('id_cliente', auth()->id())->get();
            $this->telefonos = Auth::user()->telefonos;
        }

        public function cancelarReserva($id)
        {
            $reserva = Reserva::where('id', $id)->where('id_cliente', Auth::id())->get()->first();

            if ($reserva) {
                $reserva->delete();
                session()->flash('success', 'Reserva cancelada con éxito.');
                $this->reservas = Reserva::where('id_cliente', Auth::id())->get();
            } else {
                session()->flash('error', 'No se pudo cancelar la reserva.');
            }
        }

        public function render()
        {   
            return view('livewire.perfil-usuario');

        }
    }
