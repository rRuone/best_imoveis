<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Http\Controllers\Controller;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'nome');
        $direction = $request->get('direction', 'asc');

        $categorias = Categoria::orderBy($sort, $direction)->get();

        return view('admin.categorias.index', compact('categorias', 'sort', 'direction'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(CategoriaRequest $request)
    {
        // Criação da nova categoria
        Categoria::create([
            'nome' => $request->input('nome'),
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        // Atualiza o nome da categoria
        $categoria->nome = $request->input('nome');
        $categoria->save();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria deletada com sucesso.');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.show', compact('categoria'));
    }
}
