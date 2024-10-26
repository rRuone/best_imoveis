<?php
namespace App\Http\Livewire;

use Livewire\Component;

class EnderecoSelecionado extends Component
{
    public $enderecos;
    public $enderecoSelecionado;

    public function mount($enderecos)
    {
        $this->enderecos = $enderecos;
        $this->enderecoSelecionado = session('endereco_id', null);
    }

    public function atualizarEndereco($enderecoId)
    {
        $this->enderecoSelecionado = $enderecoId;
        session()->put('endereco_id', $enderecoId);
        $this->emit('enderecoAtualizado'); // Emite um evento que pode ser ouvido por outros componentes
    }

    public function render()
    {
        return view('livewire.endereco-selecionado');
    }
}
