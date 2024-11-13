<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class ExibirDetalhes extends Component
{
    public $pedido;
    public $mostrarDetalhes = true;

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
