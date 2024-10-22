<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    
    public function index(){
      
        $categorias = Categoria::orderBy('nome')->get();
       
        return view('admin.categorias.index',['categorias' => $categorias]);
    }

    // Detalhes de Adicionais
    public function show(Categoria $categorias){
        return view('admin.categorias.show',['categorias' =>$categorias]);
    }

    public function create(){
        return view('admin.categorias.create');
    }

    
    public function store(CategoriaRequest $request){
        $request->validated();

         Categoria::create($request->all());
         return redirect()->route('admin.categorias.index')
         ->with('success', 'Categoria cadastrado com sucesso');

    }
}
