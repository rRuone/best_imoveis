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
        $this->emit('enderecoAtualizado', $enderecoId); // Emite o ID do endereço atualizado
    }

    public function render()
    {
        return view('livewire.endereco-selecionado');
    }
}
