<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormOutletPriceRequest extends FormRequest
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
            'number'     => 'required|min:5',
            'published'  => 'required|date',
            'closing'       => 'required|date',
            'object'    => 'required|min:5|max:1000',
            'docs'       => 'required|file|mimes:pdf,zip|max:10000',
            'status'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.*'     => 'O campo :attribute é obrigatório e requer no mínimo 5 caracteres.',
            'published.*'  => 'O campo "Publicado em" é obrigatório.',
            'closing.*'       => 'O campo "Aberto em" é obrigatório.',
            'object.*'    => 'O campo Objeto é obrigatório, requer no mínimo 5 caracteres e no máximo 1000 caracteres.',
            'docs.*'       => 'O campo Documento é obrigatório e requer um arquivo em .PDF ou .ZIP.',
            'status.*'     => 'O campo :attribute é obrigatório.',
        ];
    }
}
