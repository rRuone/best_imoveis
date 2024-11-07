<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoItemAdicional;

class FinalizarPedido extends Component
{
    protected $listeners = ['enderecoAtualizado' => 'atualizarEndereco', 'retirarAtualizado' => 'atualizarRetirar'];

    public $enderecoId;
    public $retirar = false;

    public function mount()
    {
        $this->enderecoId = session('endereco_id', null);
        $this->retirar = session('retirar', false); // Recupera o estado de "retirar" da sessão
    }

    public function atualizarEndereco($enderecoId)
    {
        $this->enderecoId = $enderecoId;
    }

    public function atualizarRetirar($retirar)
    {
        $this->retirar = $retirar; // Atualiza o estado de "retirar"
    }

    public function finalizarPedido()
{
    // Obtém os dados da sessão
    $pedido = session()->get('pedido', []);
    $clienteId = session()->get('cliente_id');
    $enderecoId = session()->get('endereco_id'); // Use o ID do endereço
    $metodoPagamento = session()->get('metodo_pagamento');
    $retirar = session()->get('retirar'); // Verifica se "retirar" foi selecionado
    
    // Validação das informações necessárias
    if (!$clienteId || (!$retirar && !$enderecoId) || !$metodoPagamento) {
        session()->flash('error', 'Preencha todas as informações para finalizar o pedido.');
        return;
    }
    
    // Se "retirar" for selecionado, define o endereço como null
    if ($retirar) {
        $enderecoId = null; // Ignora o endereço se "retirar" for selecionado
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
        'endereco_id' => $enderecoId, // Usa o ID do endereço ou null se "retirar"
        'data_pedido' => now(),
        'metdPag' => $metodoPagamento,
        'status' => 'pendente',
        'total' => $subtotal,
        'retirar' => $retirar ? 1 : 0, // Salva 1 se "retirar" for verdadeiro, caso contrário 0
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
