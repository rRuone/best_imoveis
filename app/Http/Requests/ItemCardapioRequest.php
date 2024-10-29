<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardapioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255|regex:/^[^\d]+$/', // Validação para que o nome não seja um número
            'categoria_id' => 'required|exists:categorias,id',
            'preco' => ['required', 'regex:/^\d{1,3}(\.\d{3})*(,\d{2})?$/', 'min:0.01'], // Preço maior que 0
            'foto' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nome.regex' => 'O nome do item não pode ser um número.',
            'nome.required' => 'O nome do item é obrigatório.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.min' => 'O preço deve ser maior que zero.',
            // Outras mensagens personalizadas conforme necessário
        ];
    }
}
