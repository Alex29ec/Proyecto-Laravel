<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Reserva;
use App\Models\Tatuador;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;


class TatuadorController extends Controller
{
    public function index()
    {
        $tatuadores = Tatuador::all();
        return view('artistas.principal', compact('tatuadores'));
    }

    public function show($id)
    {
        $tatuador = Tatuador::findOrFail($id);
        return view('artistas.show', compact('tatuador'));
    }
    public function verReserva()
    {
        $tatuador = Auth::guard('tatuador')->user();
        $hoy = Carbon::today()->toDateString(); // '2025-05-12' por ejemplo

        // Obtener reservas del tatuador, ordenadas por fecha y hora
        // En TatuadorController.php
        $reservas = Reserva::where('id_tatuador', Auth::guard('tatuador')->id())
            ->where('date', '>=', $hoy) // ← esto filtra solo desde hoy en adelante
            ->with('cliente') // Asegúrate de tener esta relación definida
            ->orderBy('date') // Ordena por fecha primero
            ->orderBy('hour') // Luego por hora
            ->get()
            ->groupBy('date')
            ->sortKeys();

        return view('artistas.ver-reservas', compact('reservas'));
    }
    public function actualizar(Request $request)
    {

        $tatuador = Auth::guard('tatuador')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'specialties' => 'nullable|string',
        ]);

        $tatuador->name = $request->name;
        $tatuador->email = $request->email;
        $tatuador->specialties = $request->specialties;
        $tatuador->save();

        return redirect()->back()->with('success', 'Datos actualizados correctamente.');
    }
    public function guardarFoto(Request $request)
    {
        $request->validate([
            'ruta' => 'required|image|max:2048',
            'estilo' => 'nullable|string|max:255',
            'tamano' => 'nullable|string|in:pequeño,mediano,grande',
            'zona' => 'nullable|string|in:manos,brazos,antebrazos,pierna,pecho,cabeza,espalda,gemelos',
        ]);

        $tatuador = auth('tatuador')->user();

        $nombreArchivo = time() . '_' . $request->file('ruta')->getClientOriginalName();
        $rutaGuardada = $request->file('ruta')->storeAs('galeria', $nombreArchivo, 'public');

        $tatuador->fotos()->create([
            'ruta' => $nombreArchivo,
            'estilo' => $request->estilo,
            'tamano' => $request->tamano,
            'zona' => $request->zona,
        ]);

        return back()->with('success', 'Foto subida correctamente.');
    }
    public function editarFoto($id)
    {
        $foto = Photo::findOrFail($id);

        if ($foto->idtatuador !== auth('tatuador')->id()) {
            abort(403);
        }

        $tatuador = auth('tatuador')->user();
        return view('artistas.show', ['id' => auth('tatuador')->id()], compact('foto', 'tatuador'));
    }

    public function actualizarFoto(Request $request, $id)
    {
        $foto = Photo::findOrFail($id);

        if ($foto->idtatuador !== auth('tatuador')->id()) {
            abort(403);
        }

        $foto->estilo = $request->estilo;
        $foto->tamano = $request->tamano;
        $foto->zona = $request->zona;

        if ($request->hasFile('ruta')) {
            $nombreArchivo = time() . '_' . $request->file('ruta')->getClientOriginalName();
            $request->file('ruta')->storeAs('/public/storage/galeria/', $nombreArchivo, 'public');
            $foto->ruta = $nombreArchivo;
        }

        $foto->save();

        return redirect()->route('artistas.show', ['id' => auth('tatuador')->id()])
            ->with('success', 'Foto actualizada correctamente.');
    }

    public function eliminarFoto($id)
    {
        $foto = Photo::findOrFail($id);

        if ($foto->idtatuador !== auth('tatuador')->id()) {
            abort(403);
        }

        Storage::disk('public')->delete('galeria/' . $foto->ruta);
        $foto->delete();

        return back()->with('success', 'Foto eliminada correctamente.');
    }

}

