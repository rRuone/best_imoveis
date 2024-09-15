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
    public  function store(ClienteRequest $request){
       

        $cliente = Cliente::where('telefone', $request->input('telefone'))
                            ->orWhere('nome', $request->input('nome'))
                            ->first();

        if($cliente){
            // se o cliente ja existir, salva o ID na sessão
            $request->session()->put('cliente_id', $cliente->id);
        } else {
            $cliente = Cliente::create($request->all());
            $request->session()->put('cliente_id', $cliente->id);
        }

        return redirect()->route('checkout.index');

    }

}
