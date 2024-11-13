<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdicionalRequest extends FormRequest
{
    public function rules()
{
    // Usa o nome correto do parâmetro da rota 'adicionais'
    $adicionalId = $this->route('adicionais');

    return [
        'nome' => [
            'required',
            'string',
            'max:255',
            'regex:/^[^\d]+$/',
            Rule::unique('adicionais', 'nome')->ignore($adicionalId), // Ignora o ID do adicional atual na validação
        ],
        'preco' => 'nullable|numeric',
    ];
}



    public function messages()
    {


        return [
            'nome.regex' => 'O nome do adicional não pode ser um número.',
            'nome.unique' => 'Esse adicional já foi cadastrado. Por favor, insira um nome diferente.',
            'nome.required' => 'Campo nome é obrigatório.',
            'preco' => 'O preço deve ser um número.'
            // Outras mensagens personalizadas, se necessário
        ];
    }
}
