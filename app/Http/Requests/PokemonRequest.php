<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonRequest extends FormRequest
{
    public function attributes() {
        return [
            'nombre'    => '"Nombre pokemon"',
            'altura'    => '"Altura pokemon"',
            'peso'      => '"Peso pokemon"',
            'img'       => '"Imágen pokemon"',
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
        $numeric    = 'El valor campo :attribute debe de ser numérico.';
        $gte        = 'El valor campo :attribute debe de ser mayor o igual que cero.';
        $lte        = 'El valor campo :attribute debe de ser mayor que uno.';
        return [
            'nombre.required'   => $required,
            'nombre.min'        => $min,
            'nombre.max'        => $max,
            'altura.numeric'    => $numeric,
            'altura.gte'        => $gte,
            'altura.lte'        => $lte,
            'peso.numeric'      => $numeric,
            'peso.gte'          => $gte,
            'peso.lte'          => $lte,
            
        ];
    }
    
    public function rules() {
        return [
            'nombre'    => 'required|min:2|max:50',
            'altura'    => 'nullable|numeric|gte:0|lte:9999.99',
            'peso'      => 'nullable|numeric|gte:0|lte:9999.99',
            'img'       => 'nullable',
        ];
    }
}
