<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutForm extends Component
{
    public $enderecos;
    public $metodoPagamento;
    public $selectedEndereco;

    public function mount($enderecos)
    {
        $this->enderecos = $enderecos;
        $this->metodoPagamento = session('metodo_pagamento', null);
        $this->selectedEndereco = session('endereco_id', null);
    }

    public function updatedSelectedEndereco($value)
    {
        session(['endereco_id' => $value]);
    }

    public function setMetodoPagamento($metodo)
    {
        $this->metodoPagamento = $metodo;
        session(['metodo_pagamento' => $metodo]);
    }

    public function finalizar()
    {
        if (is_null($this->selectedEndereco) || is_null($this->metodoPagamento)) {
            session()->flash('error', 'Por favor, selecione um endereço e um método de pagamento.');
            return;
        }

        // Aqui você pode adicionar a lógica para finalizar o pedido, como salvar no banco de dados.

        return redirect()->route('checkout.finalizar'); // Mude isso se você tiver outra rota para redirecionar após finalizar
    }

    public function render()
    {
        return view('livewire.checkout-form');
    }
}
