<?php
namespace App\Livewire;

use App\Models\Tatuador;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use App\Services\GoogleCalendarService;
use Request;

class CrearReserva extends Component
{
    use WithFileUploads;

    public $id_tatuador;
    public $id_cliente;
    public $date;
    public $horasDisponibles = [];

    public $hour;
    public $tatuadores = [];
    public $clientes = [];
    public $image;


    public function mount()
    {
        if (Auth::guard('tatuador')->check()) {
            $this->id_tatuador = Auth::guard('tatuador')->id();
            $this->clientes = User::all();
            $this->tatuadores = [];
        }

        if (Auth::guard('web')->check()) {
            $this->tatuadores = Tatuador::all();
            $this->clientes = [];
        }
    }
    public function create()
    {
        if (Auth::guard('tatuador')->check()) {
            $clientes = User::all();
            return view('reservas.create', ['clientes' => $clientes]);
        } elseif (Auth::guard('web')->check()) {
            $tatuadores = Tatuador::all();
            return view('reservas.create', ['tatuadores' => $tatuadores]);
        }

        return redirect()->route('/');
    }
    public function updatedDate()
    {
        $this->cargarHorasDisponibles();
    }

    public function updatedIdTatuador()
    {
        $this->cargarHorasDisponibles();
    }

    public function cargarHorasDisponibles()
    {
        if (!$this->date || !$this->id_tatuador) {
            $this->horasDisponibles = [];
            return;
        }

        $horasOcupadas = Reserva::where('id_tatuador', $this->id_tatuador)
            ->where('date', $this->date)
            ->pluck('hour')
            ->toArray();

        $todasLasHoras = [];
        for ($i = 10; $i <= 20; $i++) {
            $hora = sprintf('%02d:00', $i);
            if (!in_array($hora, $horasOcupadas)) {
                $todasLasHoras[] = $hora;
            }
        }

        $this->horasDisponibles = $todasLasHoras;
        
    }

    public function reservar()
    {
        $this->validate([
            'date' => 'required|date|after_or_equal:today',
            'hour' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        if (Auth::guard('tatuador')->check()) {
            $this->validate(['id_cliente' => 'required|exists:users,id']);
            $id_tatuador = Auth::guard('tatuador')->id();
            $id_cliente = $this->id_cliente;
        } else {
            $this->validate(['id_tatuador' => 'required|exists:tatuadors,id']);
            $id_cliente = Auth::id();
            $id_tatuador = $this->id_tatuador;
        }

        // Guardar imagen
        $path = $this->image->store('public/fotos-reservas');
        $rutaFinal = str_replace('public/', 'storage/', $path);

        // Crear la reserva
        $reserva = Reserva::create([
            'id_cliente' => $id_cliente,
            'id_tatuador' => $id_tatuador,
            'date' => $this->date,
            'hour' => $this->hour,
            'image' => $rutaFinal,
        ]);

        // Google Calendar integration
        $cliente = User::find($id_cliente);
        if ($cliente && $cliente->google_token) {
            $calendarService = new GoogleCalendarService();
            $calendarService->crearEvento($cliente, $reserva);
        }
        // Verificar si ya hay una reserva existente para el mismo tatuador, fecha y hora
        $reservaExistente = Reserva::where('id_tatuador', $id_tatuador)
            ->where('date', $this->date)
            ->where('hour', $this->hour)
            ->exists();
        session()->flash('success', '¡Reserva realizada con éxito!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.crear-reserva')
            ->extends('layouts.app')
            ->section('content');
    }
}