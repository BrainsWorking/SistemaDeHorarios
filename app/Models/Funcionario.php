<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\UsuarioTrait as Permissivel;
use App\Models\Curso as Curso;

class Funcionario extends Authenticatable
{
    use Notifiable;
    use Permissivel;

    protected $fillable = ['nome', 'sexo', 'cpf', 'data_nascimento', 'endereco', 'foto', 'email', 'password', 'cargo_id'];
    protected $hidden = [ 'password', 'remember_token' ];
	public $timestamps = false;
	
    public function cargos(){
        return $this->belongsToMany(Cargo::class, 'cargos_funcionarios');
    }

    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_funcionarios');
    }

    public function setRememberToken($value){} // FIXIT: Só para não dar erro de falta de remember_token
}
