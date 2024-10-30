<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdicionalRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255|regex:/^[^\d]+$/|unique:adicionais,nome', // Impede que o nome seja um número
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
