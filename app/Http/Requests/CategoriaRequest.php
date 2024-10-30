<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255|regex:/^[^\d]+$/|unique:categorias,nome,' . ($this->categoria ? $this->categoria->id : ''),
        ];
    }

    public function messages()
    {
        return [
            'nome.regex' => 'O nome da categoria não pode ser um número.',
            'nome.unique' => 'Essa categoria já foi cadastrada. Por favor, insira um nome diferente.',
            'nome' => 'O nome é obrigatório',
        ];
    }
}
