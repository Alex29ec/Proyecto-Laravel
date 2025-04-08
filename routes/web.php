    <?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ReservaController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\EditarController;
    use App\Http\Middleware\AdminMiddleware;
    use App\Http\Controllers\APIMesaController;
    use App\Livewire\PerfilUsuario;
    use App\Livewire\Admin\EditarMenu;
    use App\Livewire\Admin\EditarUsuario;
    use App\Models\Menu;

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/editar-menu/{menuId}', [AdminController::class, 'editMenu'])->name('admin.editar.menu');
        Route::post('/admin/editar-menu/{menuId}', [AdminController::class, 'updateMenu'])->name('admin.actualizar.menu');
        Route::get('/admin/menus/create', [AdminController::class, 'createmenu'])->name('admin.create.menu');
        Route::post('/admin/menus/store', [AdminController::class, 'storemenu'])->name('admin.store.menu');
    });

    Route::middleware('auth','verified')->group(function () {
        Route::get('/admin/editar-usuario/{usuarioId}', [ProfileController::class, 'edit'])->where('usuarioId', '[0-9]+')->name('admin.editar.usuario');
        Route::post('/admin/editar-usuario/{usuarioId}', [ProfileController::class, 'update'])->where('usuarioId', '[0-9]+')->name('admin.actualizar.usuario');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
        Route::get('/perfil', [ProfileController::class,'index'])->name('perfil');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/edit/{usuarioId}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{usuarioId}', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/{usuarioId}/telefono', [ProfileController::class, 'agregarTelefono'])->name('profile.agregarTelefono');
        Route::delete('/profile/{usuarioId}/telefono/{telefonoId}', [ProfileController::class, 'eliminarTelefono'])->name('profile.eliminarTelefono');
        Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
    });

    Route::get('/mesas', [APIMesaController::class, 'index']); 
    Route::get('/mesas/{id}', [APIMesaController::class, 'show']);
    Route::post('/mesas', [APIMesaController::class, 'store']); 
    Route::put('/mesas/{id}', [APIMesaController::class, 'update']);
    Route::delete('/mesas/{id}', [APIMesaController::class, 'destroy']);

Route::fallback(function () {
    return view('errors.404');
});

    require __DIR__.'/auth.php';