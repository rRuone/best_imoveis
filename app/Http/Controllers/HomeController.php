<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Recupera todas as categorias e seus itens do cardápio
        $categorias = Categoria::with('itensCardapio')->get();

        // Retorna a view com as categorias e itens
        return view('home.index', compact('categorias'));
    }
}
