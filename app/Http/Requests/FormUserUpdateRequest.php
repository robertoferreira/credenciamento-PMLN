<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormUserUpdateRequest extends FormRequest
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
        //dd($this->uuid);

        return [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|max:255|unique:users,email,' . $this->uuid . ',uuid',
            //'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.*'        => 'O campo :attribute é obrigatório e deve ter entre 5 e 50 caracteres.',
            'email.required'       => 'O campo :attribute é obrigatório, utilize um e-mail válido.',
            'email.email'       => 'O campo :attribute precisa ser email, utilize um e-mail válido.',
            'email.unique'       => 'O campo :attribute tem que ser unico, utilize um e-mail válido.',
            'status.*'      => 'O campo :attribute é obrigatório.',
        ];
    }
}
