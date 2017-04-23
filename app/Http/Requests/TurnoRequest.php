<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'             => 'string|required',
            'horario.*.inicio' => 'timeBefore:horario,fim',   // XXX: Não sei se array funciona aqui [testar]
        ];
    }
}
