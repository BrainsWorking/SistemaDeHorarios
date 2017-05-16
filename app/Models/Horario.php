<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turno as Turno;

class Horario extends Model {

    protected $fillable = ['inicio', 'fim'];
    public $timestamps = false;
    
    public function fpas(){
        return $this->belongsToMany(Fpa::class, 'horarios_fpas')->withPivot('dia_semana');
    }

    public function turnos(){
        return $this->belongsToMany(Turno::class, 'turnos_horarios');
    }

    // Mutators & Accessors
    public function getInicioAttribute(){
        return substr($this->attributes['inicio'], 0, 5);
    }

    public function getFimAttribute(){
        return substr($this->attributes['fim'], 0, 5);
    }

}
