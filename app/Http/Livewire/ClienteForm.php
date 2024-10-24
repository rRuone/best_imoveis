<?php
namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class ClienteForm extends Component
{
    public $nome;
    public $telefone;

    public function updatedTelefone($value)
    {
        $cliente = Cliente::where('telefone', $value)->first();

        if ($cliente) {
            $this->nome = $cliente->nome;
        } else {
            $this->nome = ''; // Limpa o campo nome se não encontrar
        }
    }

    public function submit()
    {
        $this->validate([
            'telefone' => 'required|numeric',
            'nome' => 'required|string|max:255',
        ]);

        $cliente = Cliente::where('telefone', $this->telefone)->first();

        if (!$cliente) {
            $cliente = Cliente::create([
                'nome' => $this->nome,
                'telefone' => $this->telefone,
            ]);
        }

        session()->put('cliente_id', $cliente->id);

        return redirect()->route('checkout.index');
    }

    public function render()
    {
        return view('livewire.cliente-form');
    }
}
