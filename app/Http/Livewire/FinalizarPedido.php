<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoItemAdicional;
use Illuminate\Support\Facades\Session;

class FinalizarPedido extends Component
{
    public function finalizarPedido()
    {
        // Obtém os dados da sessão
        $pedido = session()->get('pedido', []);
        $clienteId = session()->get('cliente_id');
        $enderecoId = session()->get('endereco_id');
        $metodoPagamento = session()->get('metodo_pagamento');
        $retirar = session()->get('retirar'); // Ajuste conforme necessário para obter o valor correto

        // Validação das informações necessárias
        if (!$clienteId || (!$retirar && !$enderecoId) || !$metodoPagamento) {
            session()->flash('error', 'Preencha todas as informações para finalizar o pedido.');
            return;
        }

        // Calcula o subtotal
        $subtotal = array_sum(array_map(function ($item) {
            $precoItem = $item['item_cardapio']->preco;
            $quantidade = $item['quantidade'] ?? 1;
            return $precoItem * $quantidade;
        }, $pedido));

        // Cria o pedido
        $novoPedido = Pedido::create([
            'cliente_id' => $clienteId,
            'data_Pedido' => now(),
            'metdPag' => $metodoPagamento,
            'status' => 'pendente',
            'total' => $subtotal,
            'retirar' => $retirar,
        ]);

        // Itera sobre os itens do pedido para criar registros em `pedido_item`
        foreach ($pedido as $item) {
            $pedidoItem = PedidoItem::create([
                'pedido_id' => $novoPedido->id,
                'item_cardapio_id' => $item['item_cardapio']->id,
                'quantidade' => $item['quantidade'] ?? 1,
            ]);

            // Adiciona os adicionais para cada item do pedido
            foreach ($item['adicionais'] as $adicional) {
                PedidoItemAdicional::create([
                    'pedido_item_id' => $pedidoItem->id,
                    'adicional_id' => $adicional['id'],
                    'quantidade' => $adicional['quantidade'] ?? 1,
                ]);
            }
        }

        // Limpa a sessão
        session()->forget(['pedido', 'cliente_id', 'endereco_id', 'metodo_pagamento', 'retirar']);

        // Exibe a mensagem de sucesso e redireciona
        session()->flash('success', 'Pedido finalizado com sucesso!');
        return redirect()->route('pedido.detalhes', ['id' => $novoPedido->id]);
    }

    public function render()
    {
        return view('livewire.finalizar-pedido');
    }
}
