<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;

class ProntoEntrega extends Component
{
    public $concluidos;

    public function mount()
    {
        $this->atualizaEntrega();
    }
    
    public function atualizaEntrega()
    {
        $this->concluidos = Pedido::where('status', 'concluido')->get();
    }

    public function render()
    {
        $numeroPedidosConcluidos = Pedido::where('status', 'concluido')->count();
        $pedidosConcluidos = Pedido::where('status', 'concluido')->with('cliente', 'endereco')->get();

        return view('livewire.pronto-entrega', compact(
            'numeroPedidosConcluidos',
            'pedidosConcluidos'
        ));
    }
}
