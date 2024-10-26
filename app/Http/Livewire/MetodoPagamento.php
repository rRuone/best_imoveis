<?php
namespace App\Http\Livewire;

use Livewire\Component;

class MetodoPagamento extends Component
{
    public $metodoPagamento; // Armazena o método de pagamento selecionado

    public function mount()
    {
        // Pega o método de pagamento da sessão, se existir
        $this->metodoPagamento = session('metodo_pagamento', null);
    }

    public function selecionarMetodo($metodo)
    {
        // Atualiza o método de pagamento e armazena na sessão
        $this->metodoPagamento = $metodo;
        session(['metodo_pagamento' => $this->metodoPagamento]);
    }

    public function atualizarSessao()
    {
    session(['metodo_pagamento' => $this->metodo_pagamento]);
    }


    public function render()
    {
        return view('livewire.metodo-pagamento');
    }
}
