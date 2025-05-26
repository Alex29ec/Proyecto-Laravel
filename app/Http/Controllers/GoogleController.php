<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/calendar',
                'https://www.googleapis.com/auth/calendar.events',
                'openid',
                'profile',
                'email'
            ])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }
    

    public function handleGoogleCallback()
    {
        Log::debug('Entrando a handleGoogleCallback');

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Guardamos o actualizamos el usuario
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'username' => explode('@', $googleUser->getEmail())[0],
                    'rol' => 'user',
                    'phone' => '000000000',
                    'gender' => 'otro',
                    'birthdate' => now(),
                    'aceptterms' => '1',
                    'password' => Hash::make(Str::random(16)),
                ]
            );
            // Guardar los tokens de Google en el usuario
            $user->google_token = $googleUser->token; // Token de acceso
            $user->google_refresh_token = $googleUser->refreshToken; // Refresh token
            $user->save();
            Auth::login($user);
            return redirect()->route('welcome')->with('success', '¡Inicio de sesión con Google exitoso!');
        } catch (\Exception $e) {
            Log::error('Error en Google callback: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}
