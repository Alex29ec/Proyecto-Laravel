<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Mesa;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SeleccionMesas extends Component
{
    public $fecha;
    public $hora;
    public $personas;
    public $mesasDisponibles = [];

    public function actualizarMesas()
    {
        if ($this->fecha && $this->hora && $this->personas) {
            $fecha_hora = Carbon::parse("{$this->fecha} {$this->hora}");
            $this->mesasDisponibles = Mesa::where('capacidad', '>=', $this->personas)
                ->whereDoesntHave('reservas', function ($query) use ($fecha_hora) {
                    $query->where('fecha_hora', $fecha_hora);
                })->orderBy('capacidad', 'asc')
                ->get();
        }
    }

    public function reservarMesa($mesaId)
{
    if (!Auth::check()) {
        session()->flash('error', 'Debes iniciar sesión para reservar una mesa.');
        return redirect()->route('login');
    }

    if ($this->fecha && $this->hora && $this->personas) {
        $fecha_hora = Carbon::parse("{$this->fecha} {$this->hora}");

        Reserva::create([
            'user_id' => Auth::id(),
            'mesa_id' => $mesaId,
            'num_personas' => $this->personas,
            'fecha_hora' => $fecha_hora,
            'confirmada' => false,
        ]);

        session()->flash('success', 'Reserva realizada con éxito. ¡Gracias por reservar con nosotros!');

        return redirect()->route('welcome');
    }

    session()->flash('error', 'No se pudo realizar la reserva. Verifica los datos.');
}


    public function render()
    {
        return view('livewire.seleccion-mesas');
    }
}
