<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Horario as Horario;
use App\Models\Curso as Curso;

class Turno extends Model
{
    
    protected $fillable = ['nome'];
    public $timestamps = false;
    
    public function horarios(){
        return $this->belongsToMany(Horario::class, 'turnos_horarios');
    }

    public function cursos(){
        return $this->hasMany(Curso::class);        
    }
}
