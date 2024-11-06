<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Captura o ID da categoria atual a partir da rota
        $categoriaId = $this->route('categorias');

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\d]+$/',
                Rule::unique('categorias', 'nome')->ignore($categoriaId), // Permite que o nome atual seja mantido
            ],
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
