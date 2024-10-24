<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'nullable|string|max:255', // Nome pode ser nulo, se você quiser buscar só pelo telefone
            'telefone' => 'required|numeric', // Telefone é obrigatório
        ];
    }

    public function messages()
    {
        return [
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.numeric' => 'O telefone deve ser um número válido.',
        ];
    }
}
