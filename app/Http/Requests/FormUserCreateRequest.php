<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email',
            'status' => 'required',
            'password' => 'required|min:6|max:32',
        ];
    }

    public function messages()
    {
        return [
            'name.*'        => 'O campo :attribute é obrigatório e deve ter entre 5 e 50 caracteres.',
            'email.*'       => 'O campo :attribute é obrigatório, utilize um e-mail válido.',
            'status.*'      => 'O campo :attribute é obrigatório.',
            'password.*'    => 'O campo senha é obrigatório. Utilize entre 6 e 32 caracteres.',
        ];
    }

    
}
