<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('loginunificado') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            ¿No tienes una cuenta? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-900">
                Regístrate aquí
            </a>
        </p>
    
        <div class="mt-4">
            <a href="{{ route('auth.google') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 488 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123.1 24.5 166.3 64.9l-67.5 64.5C318.2 96.5 285.4 88 248 88c-89.3 0-161.5 72.2-161.5 160S158.7 408 248 408c76.8 0 130.5-44.2 136.4-106.2H248v-84h240c2.1 12.2 3.6 24.7 3.6 43z"/>
                </svg>
                Iniciar sesión con Google
            </a>
        </div>
    </div>
    
</x-guest-layout>
