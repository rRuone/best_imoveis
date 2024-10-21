<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarrinhoTotal extends Component
{
    public $total = 0;

    protected $listeners = ['carrinhoAtualizado' => 'atualizarTotal'];

    public function mount()
    {
        $this->atualizarTotal();
    }

    public function atualizarTotal()
    {
        $pedido = session()->get('pedido', []);
        $this->total = 0;

        foreach ($pedido as $item) {
            $quantidade = $item['quantidade'] ?? 1;
            $preco = $item['item_cardapio']->preco ?? 0;
            $this->total += $quantidade * $preco;
        }
    }

    public function render()
    {
        return view('livewire.carrinho-total', [ // Atualize o nome da view
            'pedido' => session()->get('pedido', []),
            'total' => $this->total
        ]);
    }
}
