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
        return view('clientes.index', ['clientes' => $cliente]);
    }

    // Cadastrar
    public function create(){
        return view('clientes.create');
    }

    // Cadastrar no banco de dados novo cliente 
    public  function store(ClienteRequest $request){
        // Validar o formulario 
        $request->validated();

        $cliente = Cliente::create($request->all());

        return redirect()->route('cliente.index');


    }

}
