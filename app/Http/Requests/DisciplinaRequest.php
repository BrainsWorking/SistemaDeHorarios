<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        // XXX: Não tenho certeza se funcionará com arrays
        return [
            'nome'          => 'string|required',
            'sigla'         => 'string|max:5|required',
            'aulasSemanais' => 'integer|required'
        ];
    }
}
