<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EnderecoSelecionado extends Component
{
    public $enderecos;
    public $enderecoSelecionado;
    public $retirar = false;

    public function mount($enderecos)
    {
        $this->enderecos = $enderecos;
        $this->enderecoSelecionado = session('endereco_id', null);
        $this->retirar = session('retirar', false); // Recupera a opção de "retirar" da sessão
    }

    public function atualizarEndereco($enderecoId)
    {
        $this->enderecoSelecionado = $enderecoId;
        session()->put('endereco_id', $enderecoId);

        // Se o endereço for nulo ou vazio, define "retirar" como true
        if (is_null($enderecoId) || $enderecoId === '') {
            $this->retirar = true;
            session()->put('retirar', true); // Salva "retirar" na sessão
        } else {
            $this->retirar = false;
            session()->forget('retirar'); // Remove "retirar" se o endereço for selecionado
        }

        // Emite para a view principal que o "retirar" foi atualizado
        $this->emit('retirarAtualizado', $this->retirar);
    }



    public function excluirEndereco($enderecoId)
{
    $endereco = \App\Models\Endereco::find($enderecoId);

    if ($endereco) {
        $endereco->delete();
        // Atualiza a lista de endereços após a exclusão
        $this->enderecos = $this->enderecos->filter(function ($endereco) use ($enderecoId) {
            return $endereco->id !== $enderecoId;
        });

        // Emite um evento para notificar sobre a exclusão
        $this->emit('enderecoExcluido');
    }
}


    public function render()
    {
        return view('livewire.endereco-selecionado');
    }
}
