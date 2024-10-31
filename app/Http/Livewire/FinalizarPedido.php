<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoItemAdicional;

class FinalizarPedido extends Component
{
    protected $listeners = ['enderecoAtualizado' => 'atualizarEndereco'];

    public $enderecoId; // Adicione uma propriedade para armazenar o ID do endereço

    public function mount()
    {
        $this->enderecoId = session('endereco_id', null); // Inicializa com o ID do endereço da sessão
    }

    public function atualizarEndereco($enderecoId)
    {
        $this->enderecoId = $enderecoId; // Atualiza a propriedade
    }

    public function finalizarPedido()
    {
        // Obtém os dados da sessão
        $pedido = session()->get('pedido', []);
        $clienteId = session()->get('cliente_id');
        $enderecoId = session()->get('endereco_id'); // Use o ID da sessão
        $metodoPagamento = session()->get('metodo_pagamento');
        $retirar = session()->get('retirar');

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
            'endereco_id' => $enderecoId, // Use o ID do endereço
            'data_pedido' => now(),
            'metdPag' => $metodoPagamento,
            'status' => 'pendente',
            'total' => $subtotal,
            'retirar' => $retirar,
        ]);

        // Criação de itens do pedido
        foreach ($pedido as $item) {
            $pedidoItem = PedidoItem::create([
                'pedido_id' => $novoPedido->id,
                'item_cardapio_id' => $item['item_cardapio']->id,
                'quantidade' => $item['quantidade'] ?? 1,
            ]);

            // Adicionais de itens do pedido
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

        // Mensagem de sucesso e redirecionamento
        session()->flash('success', 'Pedido finalizado com sucesso!');
        return redirect()->route('pedido.detalhes', ['id' => $novoPedido->id]);
    }

    public function render()
    {
        return view('livewire.finalizar-pedido');
    }
}
