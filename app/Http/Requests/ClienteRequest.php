<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome' =>  'required',
            'telefone' => 'required'

        ];
    }

    public function messages(): array
    {
        return[
            'nome.required' => 'Campo nome é obrigatório',
            'telefone.required' => 'Campo telefone é obrigatório'
        ];
    }
}

