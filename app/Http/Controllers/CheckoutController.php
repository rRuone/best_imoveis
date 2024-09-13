<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Exibe o checkout
    public function index(Request $request){
        
        // Recupera o pedido salvo na sessão
        $pedido = session()->get('pedido', []);
        $clienteId = session()->get('cliente_id');


        if ($clienteId) {
            // Busca os endereços do cliente
            $enderecos = Endereco::where('cliente_id', $clienteId)->get();
        } else {
            $enderecos = collect(); // Retorna uma coleção vazia se o cliente não estiver logado
        }


        // dd([
        //     'pedido' => $pedido,
        //     'cliente_id' => $clienteId,
        //     'cliente' => $clienteId ? \App\Models\Cliente::find($clienteId) : null
        // ]);

        return view('checkout.index', compact('pedido','enderecos'));
    }

     // Selecionar o endereço no checkout
     public function selecionarEndereco(Request $request)
     {
         // Valida se o endereço foi selecionado
         $request->validate([
             'endereco_id' => 'required|exists:enderecos,id',
         ]);
 
         // Recupera o ID do endereço selecionado
         $enderecoId = $request->input('endereco_id');
 
         // Salva o endereço na sessão
         session()->put('endereco_id', $enderecoId);
         
         
         // Redireciona de volta ao checkout (ou para a próxima etapa do processo)
         return redirect()->route('checkout.index')->with('success', 'Endereço selecionado com sucesso!');
     }

     // Selecionar o método de pagamento no checkout
    public function selecionarPagamento(Request $request)
    {
        // Valida se o método de pagamento foi selecionado
        $request->validate([
            'metodo_pagamento' => 'required|in:dinheiro,cartao,pix',
        ]);

        // Recupera o método de pagamento selecionado
        $metodoPagamento = $request->input('metodo_pagamento');

        // Salva o método de pagamento na sessão
        session()->put('metodo_pagamento', $metodoPagamento);
        
        // Redireciona de volta ao checkout (ou para a próxima etapa do processo)
        return redirect()->route('checkout.index')->with('success', 'Método de pagamento selecionado com sucesso!');
    }
}
