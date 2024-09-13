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

    // Detalhes de endereco
    public function show(Endereco $enderecos){
        return view('admin.enderecos.show', ['enderecos' => $enderecos]);
    }

       // Cadastrar
       public function create(){
        $cidades = Cidade::all(); // Obtém todas as cidades para o select
        return view('admin.enderecos.create', compact('cidades'));
    }

   // Armazena o novo endereço no banco de dados
   public function store(EnderecoRequest $request)
   {
       $validatedData = $request->validated();

       // Obtém o cliente da sessão
       $clienteId = $request->session()->get('cliente_id');

       if (!$clienteId) {
           return redirect()->route('clientes.create')->with('error', 'Por favor, cadastre-se para continuar.');
       }

       // Adiciona o cliente_id aos dados validados
       $validatedData['cliente_id'] = $clienteId;

       // Cria o novo endereço
       Endereco::create($validatedData);

       // Redireciona para a página de checkout após salvar o endereço
       return redirect()->route('checkout.index')->with('success', 'Endereço criado com sucesso!');
   }
    //   // Buscar endereços do cliente logado
    //   public function enderecosCliente(Request $request)
    //   {
    //       $clienteId = $request->session()->get('cliente_id'); // Obtém o cliente da sessão
  
    //       if (!$clienteId) {
    //           return redirect()->route('clientes.create')->with('error', 'Por favor, cadastre-se para continuar.');
    //       }
  
    //       // Busca os endereços do cliente
    //       $enderecos = Endereco::where('cliente_id', $clienteId)->get();
  
    //       return view('admin.checkout.index', compact('enderecos'));
    //   }
}



