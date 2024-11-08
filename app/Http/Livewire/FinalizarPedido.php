<?php

namespace App\Http\Livewire;

use App\Models\Endereco;
use Livewire\Component;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoItemAdicional;

class FinalizarPedido extends Component
{
    protected $listeners = ['enderecoAtualizado' => 'atualizarEndereco', 'retirarAtualizado' => 'atualizarRetirar'];

    public $enderecoId;
    public $retirar = false;
    public $subtotal = 0;
    public $taxaEntrega = 0;
    public $total = 0;

    public function mount()
    {
        $this->enderecoId = session('endereco_id', null);
        $this->retirar = session('retirar', false); // Recupera o estado de "retirar" da sessão
        $this->calcularSubtotal();
    }

    public function calcularSubtotal()
    {
        $pedido = session()->get('pedido', []);

        // Calcular o subtotal
        $this->subtotal = array_sum(array_map(function ($item) {
            $precoItem = $item['item_cardapio']->preco;
            $quantidade = $item['quantidade'] ?? 1;
            return $precoItem * $quantidade;
        }, $pedido));

        // Definir a taxa de entrega com base no endereço
        $enderecoId = $this->enderecoId;
        $endereco = Endereco::find($enderecoId);
        $this->retirar = session('retirar', false);

        if ($this->retirar) {
            $this->taxaEntrega = 0;
        } elseif ($endereco && in_array($endereco->bairro, ['Alvorada', 'Almirante'])) {
            $this->taxaEntrega = 10.00;
        } else {
            $this->taxaEntrega = 7.00;
        }

        $this->total = $this->subtotal + $this->taxaEntrega;
    }

    public function atualizarEndereco($enderecoId)
    {
        $this->enderecoId = $enderecoId;
        $this->calcularSubtotal(); // Recalcula ao atualizar o endereço
    }

    public function atualizarRetirar($retirar)
    {
        $this->retirar = $retirar;
        $this->calcularSubtotal(); // Recalcula ao atualizar a opção de retirada
    }

    public function finalizarPedido()
    {
        // Obtém os dados da sessão
        $pedido = session()->get('pedido', []);
        $clienteId = session()->get('cliente_id');
        $metodoPagamento = session()->get('metodo_pagamento');

        // Validação das informações necessárias
        if (!$clienteId || (!$this->retirar && !$this->enderecoId) || !$metodoPagamento) {
            session()->flash('error', 'Preencha todas as informações para finalizar o pedido.');
            return;
        }

        // Se "retirar" for selecionado, define o endereço como null
        if ($this->retirar) {
            $this->enderecoId = null; // Ignora o endereço se "retirar" for selecionado
        }

        // Já temos o subtotal, taxa de entrega e total calculados
        $this->calcularSubtotal();

        // Cria o pedido
        $novoPedido = Pedido::create([
            'cliente_id' => $clienteId,
            'endereco_id' => $this->enderecoId,
            'data_pedido' => now(),
            'metdPag' => $metodoPagamento,
            'status' => 'pendente',
            'total' => $this->total,
            'retirar' => $this->retirar ? 1 : 0,
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
