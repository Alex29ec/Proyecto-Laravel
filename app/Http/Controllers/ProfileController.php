<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Telefono;

class ProfileController extends Controller
{
    
    public $telefonos;
    public function edit($id = null)
    {
        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = auth()->user()->load('telefonos');
        }
    
        return view('editar.usuarios', compact('user'))->with('telefonos', $user->telefonos);
    }
    
    
    public function update(Request $request, $id = null)
    {

        $user = $id ? User::findOrFail($id) : auth()->user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        return redirect()->route('admin.index')->with('status', 'Perfil actualizado correctamente.');
    }
    


   public function eliminarTelefono($usuarioId, $telefonoId)
   {
       $user = User::findOrFail($usuarioId); 
       $telefono = Telefono::where('id', $telefonoId)->where('user_id', $user->id)->first();

       if ($telefono) {
           $telefono->delete();
           return redirect()->route('profile.edit', ['usuarioId' => $user->id])->with('status', 'Teléfono eliminado con éxito');
       }

       return redirect()->route('profile.edit', ['usuarioId' => $user->id])->with('error', 'No se pudo eliminar el teléfono');
   }

   public function agregarTelefono(Request $request, $id)
   {
       $request->validate([
           'telefono' => 'required|string|max:15|unique:telefonos,numero',
       ], [
           'telefono.unique' => 'Este número de teléfono ya está en uso.',
       ]);
   
       $user = User::findOrFail($id);
       $user->telefonos()->create([
           'numero' => $request->telefono,
       ]);
   
       return redirect()->back()->with('success', 'Teléfono agregado con éxito.');
   }
   
     public function index()
    {
        return view('admin.perfil')->with('telefonos', Auth::user()->telefonos);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
