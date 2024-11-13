<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class DashboardPedidos extends Component
{   
    public $pendentes;
    public $emProcesso;
    public $concluidos;

    protected $listeners = ['pedidoCriado' => 'atualizarPedidos', 'atualizarLista' => 'atualizarPedidos'];


    public function mount()
    {
        $this->atualizarPedidos();
    }

    public function atualizarPedidos()
    {
        $this->pendentes = Pedido::where('status', 'pendente')->get();
        $this->emProcesso = Pedido::where('status', 'em_producao')->get();
        $this->concluidos = Pedido::where('status', 'concluido')->get();
    }


    public function render()
    {
        $numeroPedidosPendentes = Pedido::where('status', 'pendente')->count();
        $numeroPedidosEmProcesso = Pedido::where('status', 'em_processo')->count();
        $numeroPedidosConcluidos = Pedido::where('status', 'concluido')->count();

        $produtosPendentes = Pedido::where('status', 'pendente')->with('cliente', 'endereco')->get();
        $pedidosEmProcesso = Pedido::where('status', 'em_processo')->with('cliente', 'endereco')->get();
        $pedidosConcluidos = Pedido::where('status', 'concluido')->with('cliente', 'endereco')->get();

        return view('livewire.dashboard-pedidos', compact(
            'numeroPedidosPendentes',
            'numeroPedidosEmProcesso',
            'numeroPedidosConcluidos',
            'produtosPendentes',
            'pedidosEmProcesso',
            'pedidosConcluidos'
        ));
    }
}
