<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
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
            'cliente_id' => 'required|exists:clientes,id',
            'cidades_id' => 'required|exists:cidades,id',
            'logradouro' => 'required|string|max:80',
            'numero' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:80',
            'complemento' => 'nullable|string|max:20',
        ];
    }
}
