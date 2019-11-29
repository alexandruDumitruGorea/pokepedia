<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function attributes() {
        return [
            'subject'    => '"Asunto post"',
            'content'    => '"Contenido post"',
            'idpokemon'    => '"Pokemon post"',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
    
    public function messages() {
        $required   = 'El campo :attribute es obligatorio';
        $min        = 'La longitud mínima del campo :attribute es :min';
        $max        = 'La longitud máxima del campo :attribute es :max';
        $gte        = 'El valor campo :attribute debe de ser mayor o igual que cero.';
        $lte        = 'El valor campo :attribute debe de ser mayor que uno.';
        return [
            'subject.required'   => $required,
            'subject.min'        => $min,
            'subject.max'        => $max,
            'content.min'     => $min,
            'content.max'     => $max,
            'idpokemon.required'  => $required,
        ];
    }

    public function rules() {
        return [
            'subject'        => 'required|min:2|max:50',
            'content'     => 'nullable|min:1|max:250',
            'idpokemon'       => 'required',
        ];
    }
}
