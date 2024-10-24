<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeRequest;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Listar clientes
    public function index(){
        $clientes = Cliente::orderBy('nome')->get();
        
        return view('clientes.index', ['clientes' => $clientes]);
    }

    // Detalhes de cliente
    public function show(Cliente $cliente){
        return view('clientes.show', ['clientes' => $cliente]);
    }

    // Cadastrar
    public function create(){
        
        return view('clientes.create');
    }

    // Cadastrar no banco de dados novo cliente 
    public function store(ClienteRequest $request)
    {
        
        // Verifica se o cliente já existe pelo telefone ou nome
        $cliente = Cliente::where('telefone', $request->input('telefone'))->first();
    
        if ($cliente) {
            // Se o cliente já existir, salva o ID na sessão
            $request->session()->put('cliente_id', $cliente->id);
        } else {
            // Se o cliente não existir, cria um novo registro
            $cliente = Cliente::create($request->all());
            // Salva o ID do novo cliente na sessão
            $request->session()->put('cliente_id', $cliente->id);
        }
    
        // Redireciona para a próxima etapa
        return redirect()->route('checkout.index');
    }

}
