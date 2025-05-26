<?php

use App\Livewire\AdminPanel;
use App\Livewire\PerfilUsuario;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TatuadorController;
use App\Http\Controllers\Auth\LoginUnificadoController;
use App\Livewire\CrearReserva;
use App\Http\Controllers\HomeController;

// Welcome
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/google-auth/callback', [GoogleController::class, 'handleGoogleCallback']);

// LOGIN
Route::get('/login', [LoginUnificadoController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginUnificadoController::class, 'showLoginForm'])->name('loginunificado');
Route::post('/login', [LoginUnificadoController::class, 'login'])->name('login');

// Rutas públicas
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria');
Route::get('/contacto', fn () => view('contacto.index'))->name('contacto');
Route::get('/terminos', fn () => view('terminos.index'))->name('terminos');
Route::get('/artistas', [TatuadorController::class, 'index']);
Route::get('/artistas/{id}', [TatuadorController::class, 'show'])->name('artistas.show');
Route::get('/perfiltatuador', [TatuadorController::class, 'index'])->name('perfiltatuador');

// Rutas protegidas para USUARIOS (guard: web)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/perfil', PerfilUsuario::class)->name('perfil');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/edit/{usuarioId}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{usuarioId}', [ProfileController::class, 'update'])->name('profile.update');
       Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/editar-usuario/{usuarioId}', [ProfileController::class, 'edit'])->where('usuarioId', '[0-9]+')->name('admin.editar.usuario');
    Route::post('/admin/editar-usuario/{usuarioId}', [ProfileController::class, 'update'])->where('usuarioId', '[0-9]+')->name('admin.actualizar.usuario');
});

// Rutas protegidas para TATUADORES Y CLIENTES (guard: tatuador)
Route::middleware(['auth:web,tatuador'])->group(function () {
    Route::get('/reservas/create', [CrearReserva::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [CrearReserva::class, ''])->name('reservas.store');
});

// Rutas protegidas para ADMINISTRADORES
Route::get('/admin', AdminPanel::class)-> name('admin');

// Rutas protegidas para TATUADORES
Route::middleware(['auth:tatuador'])->group(function () {
    Route::get('/panel', [TatuadorController::class, 'verReserva'])->name('tatuador.panel');
    Route::put('/actualizar', [TatuadorController::class, 'actualizar'])->name('tatuador.actualizar');
    Route::post('/galeria', [TatuadorController::class, 'guardarFoto'])->name('tatuador.foto.guardar');
    Route::get('/galeria/{id}/editar', [TatuadorController::class, 'editarFoto'])->name('tatuador.foto.editar');
    Route::put('/galeria/{id}', [TatuadorController::class, 'actualizarFoto'])->name('tatuador.foto.actualizar');
    Route::delete('/galeria/{id}', [TatuadorController::class, 'eliminarFoto'])->name('tatuador.foto.eliminar');
});

// Página de error 404 si no encuentra ruta
Route::fallback(function () {
    return view('errors.404');
});

require __DIR__ . '/auth.php';
