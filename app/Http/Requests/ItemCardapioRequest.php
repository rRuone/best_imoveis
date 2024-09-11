<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardapioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'preco' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ];
    }

     /**
     * Obtenha as mensagens de erro personalizadas para as regras de validação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O nome do item é obrigatório.',
            
            'preco.numeric' => 'O preço deve ser um valor numérico.',
        ];
    }
}
