<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password_current' => 'required|current_password:web',
            'password'     => 'required|min:8|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password_current.required'             => 'O campo senha atual é obrigatório',
            'password_current.current_password'     => 'Senha inválida',
            'password.required'                     => 'O campo nova senha é obrigatório',
            'password.min'                          => 'Quantidade mínina de 8 caracteres',
            'password.confirmed'                    => 'A confirmação da senha não corresponde',        
        ];
    }
}
