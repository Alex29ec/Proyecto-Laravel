<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class GaleriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Photo::query();

        if ($request->filled('estilo')) {
            $query->where('estilo', $request->estilo);
        }

        if ($request->filled('zona')) {
            $query->where('zona', $request->zona);
        }

        if ($request->filled('tamano')) {
            $query->where('tamano', $request->tamano);
        }

        $fotos = $query->get();

        // Listas únicas para los selects
        $estilos = Photo::select('estilo')->distinct()->pluck('estilo');
        $zonas = Photo::select('zona')->distinct()->pluck('zona');

        return view('galeria.index', compact('fotos', 'estilos', 'zonas'));
    }
}
