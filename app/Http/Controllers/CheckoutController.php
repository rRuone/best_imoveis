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
}
