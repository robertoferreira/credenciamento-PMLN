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
            'closing'    => 'required|date',
            'object'     => 'required|min:5|max:1000',
            'docs'       => 'required|file|mimes:pdf,zip|max:20480',
            'status'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'number.required'     => 'O campo :attribute é obrigatório.',
            'number.min'          => 'O campo :attribute requer no mínimo 5 caracteres.',
            'published.required'  => 'O campo "Publicado em" é obrigatório.',
            'closing.required'    => 'O campo "Aberto em" é obrigatório.',
            'object.required'     => 'O campo Objeto é obrigatório.',
            'object.min'          => 'O campo Objeto deve ter no mínimo 5 caracteres.',
            'object.max'          => 'O campo Objeto deve ter no máximo 1000 caracteres.',
            'docs.required'       => 'O campo Documento é obrigatório.',
            'docs.file'           => 'O campo Documento é do tipo documento.',
            'docs.mimes'          => 'Os arquivos devem ser do tipo PDF ou ZIP.',
            'docs.max'            => 'Os arquivos devem ter no máximo 20Mb.',
            'status.required'     => 'O campo :attribute é obrigatório.',
        ];
    }
}
