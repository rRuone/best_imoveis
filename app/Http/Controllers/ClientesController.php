<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeRequest;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Listar clientes
    // public function index(){
    //     $clientes = Cliente::orderBy('nome')->get();

    //     return view('clientes.index', ['clientes' => $clientes]);
    // }
    public function index(Request $request)
{
    // Define o campo de ordenação e a direção, com valores padrão
    $sort = $request->get('sort', 'nome'); // Por padrão, ordena por nome
    $direction = $request->get('direction', 'asc'); // Por padrão, direção ascendente

    // Busca os clientes ordenados conforme o sort e direction
    $clientes = Cliente::orderBy($sort, $direction)->get();

    return view('admin.clientes.index', compact('clientes', 'sort', 'direction'));
}

public function destroy($id)
{
    // Encontre o cliente pelo ID
    $cliente = Cliente::findOrFail($id);

    // Exclua o cliente
    $cliente->delete();

    // Retorne uma mensagem de sucesso e redirecione de volta para a lista de clientes
    return redirect()->route('admin.clientes.index')->with('success', 'Cliente excluído com sucesso!');
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
