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

            // Buscamos por email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Si no existe, lo creamos con rol adecuado
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'username' => explode('@', $googleUser->getEmail())[0],
                    'rol' => $googleUser->getEmail() === 'aestcan29@iesmarquesdecomares.org' ? 'admin' : 'user',
                    'phone' => '000000000',
                    'gender' => 'otro',
                    'birthdate' => now(),
                    'aceptterms' => '1',
                    'password' => Hash::make(Str::random(16)),
                ]);
            } else {
                // Si ya existe, solo actualizamos algunos datos
                $user->update([
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'username' => $user->username ?? explode('@', $googleUser->getEmail())[0],
                    'email_verified_at' => now(),
                ]);
            }

            // Guardar tokens
            $user->google_token = $googleUser->token;
            $user->google_refresh_token = $googleUser->refreshToken;
            $user->save();

            Auth::login($user);
            return redirect()->route('welcome')->with('success', '¡Inicio de sesión con Google exitoso!');
        } catch (\Exception $e) {
            Log::error('Error en Google callback: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Error al iniciar sesión con Google.');
        }
    }
}
