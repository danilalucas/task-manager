<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');

        return [
            'name'             => 'required|max:255|unique:users,name,'.$userId,
            'email'            => 'required|max:255|email|unique:users,email,'.$userId,
            'password'         => 'nullable|min:8|confirmed',
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
            'name.required'      => 'O campo nome é obrigatório',
            'name.max'           => 'Excedeu o limite de 255 caracteres',
            'name.unique'        => 'Nome de usuario já existe',
            'email.required'     => 'O campo email é obrigatório',
            'email.max'          => 'Excedeu o limite de 255 caracteres',
            'email.email'        => 'O email informado não é válido',
            'password.required'  => 'O campo nova senha é obrigatório',
            'password.min'       => 'Quantidade mínina de 8 caracteres',
            'password.confirmed' => 'A confirmação da senha não corresponde',        
        ];
    }
}
