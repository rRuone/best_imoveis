<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExibirDetalhes extends Component
{
    public $pedido;
    public $mostrarDetalhes = false;

    public function mount($pedido)
    {
        $this->pedido = $pedido;
    }

    public function toggleDetalhes()
    {
        $this->mostrarDetalhes = !$this->mostrarDetalhes;
    }

    public function render()
    {
        return view('livewire.exibir-detalhes');
    }
}
