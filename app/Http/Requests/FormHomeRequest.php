<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormHomeRequest extends FormRequest
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
            'provider'                => 'required',
            'document'                => 'required',
            'name_business'           => 'required',
            'zipcode'                 => 'required',
            'address'                 => 'required',
            'number_address'          => 'required',
            'neighborhood'            => 'required',
            'city'                    => 'required',
            'state'                   => 'required',
            'document_person_owner'   => 'required',
            'name'                    => 'required',
            'birthday'                => 'required',
            'email'                   => 'required',
            'password'                => 'required',
            'phone_business'          => 'required',
            'docs'                    => 'required|file|mimes:pdf,zip|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'provider.required'                => 'O campo FORNECEDOR é obrigatório',
            'document.required'                => 'O campo CNPJ é obrigatório',
            'name_business.required'           => 'O campo NOME DA EMPRESA é obrigatório',
            'zipcode.required'                 => 'O campo CEP é obrigatório',
            'address.required'                 => 'O campo ENDEREÇO é obrigatório',
            'number_address.required'          => 'O campo NÚMERO DO ENDEREÇO é obrigatório',
            'neighborhood.required'            => 'O campo BAIRRO é obrigatório',
            'city.required'                    => 'O campo CIDADE é obrigatório',
            'state.required'                   => 'O campo ESTADO é obrigatório',
            'document_person_owner.required'   => 'O campo CPF é obrigatório',
            'name.required'                    => 'O campo NOME é obrigatório',
            'birthday.required'                => 'O campo DATA DE ANIVERSÁRIO é obrigatório',
            'email.required'                   => 'O campo E-MAIL é obrigatório',
            'password.required'                => 'O campo SENHA é obrigatório',
            'phone_business.required'          => 'O campo TELEFONE DA EMPRESA é obrigatório',
            'docs.required'                    => 'O campo DOCUMENTO é obrigatório',
            'docs.mimes'                       => 'O campo DOCUMENTO tem que ser do tipo .PDF ou .ZIP',
            'docs.max'                         => 'O arquivo DOCUMENTO deve ter no máximo 10MB',
        ];
    }
}
