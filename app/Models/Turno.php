<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Horario as Horario;
use App\Models\Curso as Curso;

class Turno extends Model
{
    public $timestamp = false;
    
    protected $fillable = ['nome'];
    
    public function horarios(){
        return $this->belongsToMany(Horario::class, 'turnos_horarios');
    }

    public function cursos(){
        return $this->hasMany(Curso::class);        
    }

    public function getQuantidadeAulasAttribute(){
        return $this->horarios->count();
    }
}
