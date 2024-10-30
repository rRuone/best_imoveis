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
            'nome' => 'required|string',
            'preco' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
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
