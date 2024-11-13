<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;

class PedidosEmProducao extends Component
{
    public $emProcesso;

    public function mount()
    {
        $this->atualizaProducao();
    }

    public function atualizaProducao()
    {
        $this->emProcesso = Pedido::where('status', 'em_producao')->get();
    }


    public function render()
    {
        $numeroPedidosEmProcesso = Pedido::where('status', 'em_processo')->count();
        $pedidosEmProcesso = Pedido::where('status', 'em_processo')->with('cliente', 'endereco')->get();

        return view('livewire.pedidos-em-producao', compact(
            'numeroPedidosEmProcesso',
            'pedidosEmProcesso',
        ));
    }
}
