<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class ProfileController extends Controller
{
  
    
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
