<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
 /**
     * Display the registration view.
     */   
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username'=> ['required', 'string', 'max:255'],
            'birthdate'=> ['required', 'date'],
            'phone'=>['required', 'string', 'max:9'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender'=> ['required', 'in:male,female,other'],
            'aceptterms'=> ['accepted'],
            'email_verified_at' => now(),
            
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'gender' => $request->gender,
            'rol' => 'user',
            'birthdate' => $request->birthdate,
            'aceptterms' => true,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('welcome', absolute: false));
    }
}