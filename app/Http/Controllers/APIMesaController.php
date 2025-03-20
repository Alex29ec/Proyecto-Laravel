<?php
namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Http\Requests\APIMesaRequest;
use Illuminate\Http\Request;

class APIMesaController extends Controller
{
    // Método para obtener todas las mesas
    public function index()
    {
        $mesas = Mesa::all();
        return response()->json($mesas, 200); 
    }

    // Método para obtener una mesa específica por su ID
    public function show($id)
    {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404); 
        }

        return response()->json($mesa, 200); 
    }

    // Método para crear una nueva mesa
    public function store(StoreMesaRequest $request)
    {
        $validated = $request->validated();
        $mesa = Mesa::create([
            'nombre' => $validated['nombre'],
            'capacidad' => $validated['capacidad'],
            'ubicacion' => $validated['ubicacion'],
        ]);

        return response()->json($mesa, 201);
    }

    public function update(StoreMesaRequest $request, $id)
    {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404); // Si no se encuentra la mesa, devuelve 404
        }

        $validated = $request->validated();

        $mesa->update([
            'nombre' => $validated['nombre'],
            'capacidad' => $validated['capacidad'],
            'ubicacion' => $validated['ubicacion'],
        ]);

        return response()->json($mesa, 200);
    }

    public function destroy($id)
    {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404);
        }

        $mesa->delete();

        return response()->json(['message' => 'Mesa eliminada correctamente'], 200); 
    }
}
