<?php

namespace App\Http\Controllers;

use App\Models\Adicionais;
use App\Models\Endereco;
use App\Models\ItemCardapio;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\PedidoItem;
use App\Models\PedidoItemAdicional;
use Illuminate\Support\Facades\DB;



class CheckoutController extends Controller
{
    // Exibe o checkout
    public function index(Request $request)
{
    // Recupera o pedido salvo na sessão
    $pedido = session()->get('pedido', []);

    // Recupera o ID do cliente da sessão
    $clienteId = session()->get('cliente_id');

   
    // Itera sobre os itens do pedido e carrega adicionais e item_cardapio
    foreach ($pedido as &$item) {
        // Carrega o item do cardápio com os relacionamentos necessários
        $item['item_cardapio'] = ItemCardapio::find($item['item_cardapio']['id']);
        
        // Verifica se existem adicionais salvos na sessão para este item
        $item['adicionais'] = isset($item['adicionais']) ? $item['adicionais'] : [];
    }

    // Calcula o subtotal
    $subtotal = array_sum(array_map(function ($item) {
        $precoItem = $item['item_cardapio']->preco;
        $quantidade = $item['quantidade'] ?? 1;
        return $precoItem * $quantidade;
    }, $pedido));

    // Recupera os endereços do cliente, se estiver logado
    if ($clienteId) {
        $enderecos = Endereco::where('cliente_id', $clienteId)->get();
    } else {
        $enderecos = collect(); // Retorna uma coleção vazia se o cliente não estiver logado
    }
    //dd($pedido);
    // Retorna a view do checkout com os dados do pedido, endereços e subtotal
    return view('checkout.index', compact('pedido', 'enderecos', 'subtotal'));
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

    




    // Exibe os detalhes do pedido
    public function detalhesPedido($id)
    {
        $pedido = Pedido::with(['itens'])->findOrFail($id);
        //dd($pedido);
        return view('pedido.detalhes', compact('pedido'));
    }




    public function selecionarMetodoPagamento(Request $request)
{
    $request->validate([
        'metodo_pagamento' => 'required|string|in:dinheiro,cartao,pix',
    ]);

    // Salva o método de pagamento na sessão
    session(['metodo_pagamento' => $request->input('metodo_pagamento')]);

    // Redireciona para a próxima etapa
    return redirect()->route('checkout.index');
}



// public function finalizarPedido(Request $request)
// {
//     if ($request->isMethod('post')) {
//         $pedido = session()->get('pedido', []);
//         $clienteId = session()->get('cliente_id');
//         $enderecoId = session()->get('endereco_id');
//         $metodoPagamento = $request->input('metodo_pagamento');
//         $retirar = $request->input('retirar'); // Nova variável para verificar se é retirada
        
//         // Se "retirar" for diferente de 1, o endereço é obrigatório
//         if (!$clienteId || (!$retirar == 1 && !$enderecoId) || !$metodoPagamento) {
//             return redirect()->route('checkout.index')->with('error', 'Preencha todas as informações para finalizar o pedido.');
//         }

//         // Calcula o subtotal
//         $subtotal = array_sum(array_map(function ($item) {
//             $precoItem = $item['item_cardapio']->preco;
//             $quantidade = $item['quantidade'] ?? 1;
//             return $precoItem * $quantidade;
//         }, $pedido));

//         // Cria o pedido
//         $novoPedido = Pedido::create([
//             'cliente_id' => $clienteId,
//             'data_Pedido' => now(),
//             'endereço_id' => $enderecoId,
//             'metdPag' => $metodoPagamento,
//             'status' => 'pendente',
//             'total' => $subtotal,
//             'retirar' => $retirar, // Salvar a informação de retirada
//         ]);

//         foreach ($pedido as $item) {
//             // Cria o registro na tabela pedido_item
//             $pedidoItemData = [
//                 'pedido_id' => $novoPedido->id,
//                 'item_cardapio_id' => $item['item_cardapio']->id,
//                 'quantidade' => $item['quantidade'] ?? 1,
//             ];

//             $pedidoItem = PedidoItem::create($pedidoItemData);
//         }

//         // Salva adicionais para o pedido_item
//         foreach ($item['adicionais'] as $adicional) {
//             $pedidoItemAdicionalData = [
//                 'pedido_item_id' => $pedidoItem->id,
//                 'adicional_id' => $adicional['id'],
//                 'quantidade' => $adicional['quantidade'] ?? 1,
//             ];

//             PedidoItemAdicional::create($pedidoItemAdicionalData);
//         }

//         // Limpar sessão
//         session()->forget('pedido');
//         session()->forget('endereco_id');
//         session()->forget('metodo_pagamento');
//         session()->forget('cliente_id');

//         return redirect()->route('pedido.detalhes', ['id' => $novoPedido->id])->with('success', 'Pedido finalizado com sucesso!');
//     }
// }


}












