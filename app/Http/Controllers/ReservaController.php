<?php
namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    // Mostrar el formulario para crear la reserva
    public function create()
    {
        $mesas = Mesa::all();
        return view('reservas.create')->with('mesas', $mesas);
    }

    // Almacenar la nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_hora' => 'required|date|after:now',
        ]);

        // Crear la reserva
        Reserva::create([
            'usuario_id' => $request->usuario_id,
            'mesa_id' => $request->mesa_id,
            'fecha_hora' => $request->fecha_hora,
        ]);

        return redirect()->route('reservas.create')->with('success', 'Reserva realizada con éxito.');
    }
}
