<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function editMenu($menuId)
    {
        $menu = Menu::findOrFail($menuId); 
        return view('editar.menus', compact('menu'));
    }
    public function createmenu()
    {
        return view('editar.menus-crear');
    }

    public function storemenu(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Guardar la imagen
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
        $imagen->storeAs('public/imagenes', $nombreImagen);

        // Crear el menú
        $menu = new Menu();
        $menu->nombre = $request->input('nombre');
        $menu->descripcion = $request->input('descripcion');
        $menu->precio = $request->input('precio');
        $menu->imagen = $nombreImagen;
        $menu->save();

        return redirect()->route('admin.index')->with('success', 'Menú añadido exitosamente');
    }
public function updateMenu(Request $request, $id)
{
    $menu = Menu::find($id);

    // Validaciones
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = $menu->imagen;
        $imagen->storeAs('public/imagenes', $nombreImagen);
        $menu->imagen = $nombreImagen;
    }

    $menu->nombre = $request->input('nombre');
    $menu->descripcion = $request->input('descripcion');
    $menu->precio = $request->input('precio');
    $menu->save();

    return redirect()->route('admin.index')->with('success', 'Menú actualizado exitosamente');
}   
    public function index()
    {
        return view('admin.index'); 
    }
}
