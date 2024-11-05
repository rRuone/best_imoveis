<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdicionalRequest extends FormRequest
{
    public function rules()
    {
        $adicionalId = $this->adicional->id ?? $this->route('adicional');
        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\d]+$/',
                Rule::unique('adicionais', 'nome')->ignore($adicionalId),
                        ],
            'preco' => 'required|numeric',
        ];
    }



    public function messages()
    {


        return [
            'nome.regex' => 'O nome do adicional não pode ser um número.',
            'nome.unique' => 'Esse adicional já foi cadastrado. Por favor, insira um nome diferente.',
            'nome.required' => 'Campo nome é obrigatório',
            'preco' => 'O preço é obrigatório'
            // Outras mensagens personalizadas, se necessário
        ];
    }
}
