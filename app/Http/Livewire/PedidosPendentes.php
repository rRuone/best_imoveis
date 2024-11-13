<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;

class PedidosPendentes extends Component
{
    public $pendentes;

    protected $listeners = [
        'pedidoAtualizado' => 'atualizaPendente', // Escutando o evento 'pedidoAtualizado'
    ];

    public function mount()
    {
        $this->atualizaPendente();
    }

    public function atualizaPendente()
    {
        $this->pendentes = Pedido::where('status', 'pendente')->get();

       
    }

    public function render()
    {
        $numeroPedidosPendentes = Pedido::where('status', 'pendente')->count();

        $produtosPendentes = Pedido::where('status', 'pendente')->with('cliente', 'endereco')->get();

        return view('livewire.pedidos-pendentes', compact(
            'numeroPedidosPendentes',
            'produtosPendentes',
        ));
    }
}
