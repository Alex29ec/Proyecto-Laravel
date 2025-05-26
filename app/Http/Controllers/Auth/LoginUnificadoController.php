<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUnificadoController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Intentar login como usuario normal
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        // Intentar login como tatuador
        if (Auth::guard('tatuador')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas o usuario no registrado.',
        ]);
    }
}
