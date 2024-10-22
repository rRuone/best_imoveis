<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarrinhoItem extends Component
{
    protected $listeners = ['carrinhoAtualizado' => '$refresh']; // Atualiza a view
    public $index;
    public $quantidade;

    
    public function mount()
    {
        $pedido = session()->get('pedido', []);
        
        // Inicializa a quantidade com base no valor atual da sessão
        if (isset($pedido[$this->index]['quantidade'])) {
            $this->quantidade = $pedido[$this->index]['quantidade'];
        } else {
            $this->quantidade = 1; // Quantidade padrão se não estiver definida
        }
    }

    public function incrementar()
    {
        $pedido = session()->get('pedido', []);
        
        // Verifica se o item já está no carrinho
        if (isset($pedido[$this->index])) {
            $pedido[$this->index]['quantidade'] = $this->quantidade + 1;
            $this->quantidade = $pedido[$this->index]['quantidade']; // Atualiza a quantidade localmente
        }

        // Atualiza a sessão com o carrinho atualizado
        session()->put('pedido', $pedido);
        $this->emit('carrinhoAtualizado');
    }

    public function decrementar()
    {
        $pedido = session()->get('pedido', []);

        // Verifica se o item está no carrinho e se a quantidade é maior que 1
        if (isset($pedido[$this->index]) && $this->quantidade > 1) {
            $pedido[$this->index]['quantidade'] = $this->quantidade - 1;
            $this->quantidade = $pedido[$this->index]['quantidade']; // Atualiza a quantidade localmente
        } else {
            // Remove o item se a quantidade for 1 ou menor
            unset($pedido[$this->index]);
        }

        // Atualiza a sessão com o carrinho atualizado
        session()->put('pedido', $pedido);
        $this->emit('carrinhoAtualizado');
    }

    public function deletar()
    {
        $pedido = session()->get('pedido', []);
    
        // Remove o item do carrinho baseado no índice
        if (isset($pedido[$this->index])) {
            unset($pedido[$this->index]);
        }
    
        // Atualiza a sessão com o carrinho atualizado
        session()->put('pedido', $pedido);
    
        // Verifica se o carrinho está vazio
        if (empty($pedido)) {
            // Redireciona para a rota carrinho.index
            return redirect()->route('carrinho.index');
        }
    
        // Emite um evento para atualizar a interface em tempo real
        $this->emit('carrinhoAtualizado'); // Atualiza o total em CarrinhoTotal
    }
    
    public function render()
    {
        $pedido = session()->get('pedido', []);
        $itemCardapio = $pedido[$this->index]['item_cardapio'] ?? null; // Pega o item do cardápio
        $adicionais = $pedido[$this->index]['adicionais'] ?? []; // Pega os adicionais

         // Verifica se o item ainda existe no pedido
        if (is_null($itemCardapio)) {
            return view('carrinho.index');
        }

        return view('livewire.carrinho-item', compact('itemCardapio', 'adicionais'));
    }
}
