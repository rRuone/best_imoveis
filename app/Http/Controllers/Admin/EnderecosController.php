<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnderecoRequest;
use App\Models\Cidade;
use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecosController extends Controller
{
    public function index(){
        $enderecos = Endereco::orderBy('id')->get();

        return view('admin.enderecos.index', ['enderecos' => $enderecos]);
    }

    // Detalhes de cliente
    public function show(Endereco $enderecos){
        return view('admin.enderecos.show', ['enderecos' => $enderecos]);
    }

       // Cadastrar
       public function create(){
        $cidades = Cidade::all(); // Obtém todas as cidades para o select
        return view('admin.enderecos.create', compact('cidades'));
    }

    public function store(EnderecoRequest $request)
    {
        $validatedData = $request->validated();

        // Cria o novo endereço
        Endereco::create($validatedData);

        // Redireciona o usuário com uma mensagem de sucesso
        return redirect()->route('admin.enderecos.index')->with('success', 'Endereço criado com sucesso!');
    }


}



