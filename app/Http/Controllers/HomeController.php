<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tatuador;

class HomeController extends Controller
{
    /**
     * Muestra la pantalla principal con los tatuadores.
     */
    public function index()
    {
        $tatuadores = Tatuador::all();
        return view('welcome', compact('tatuadores'));
    }
}
