<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class EditarUsuario extends \Livewire\Component
{
    public $usuarioId;
    public $usuario;

    public function mount($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        $this->usuario = User::find($this->usuarioId);
        
        if (!$this->usuario) {
            abort(404, 'Usuario no encontrado');
        }
    }
    public function guardarUsuario()
    {
        $this->validate([
            'usuario.name' => 'required|string|max:255',
            'usuario.email' => 'required|email|unique:users,email,' . $this->usuarioId,
        ]);
    
        $this->usuario->save();
    
        session()->flash('message', 'Usuario actualizado correctamente.');
    }
    public function index(){
        return view('livewire.admin.editar-usuario');
    }
    public function render()
    {
        return view('livewire.admin.editar-usuario');
    }
}
