<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function attributes() {
        return [
            'content'    => '"Contenido comentario"',
        ];
    }
    
    public function authorize()
    {
        return true;
    }

    public function messages() {
        $min        = 'La longitud mínima del campo :attribute es :min';
        $max        = 'La longitud máxima del campo :attribute es :max';
        return [
            'content.min'     => $min,
            'content.max'     => $max,
        ];
    }
    
    public function rules() {
        return [
            'content'     => 'nullable|min:1|max:250'
        ];
    }
}
