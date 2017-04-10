<?php

//Route::group(['middleware' => 'auth'], function () {
  # Entrada
  Route::name('home')->get('/home', function () { return view('welcome'); });

  # TURNOS
  Route::name('turnos')->get('turnos', 'TurnoController@index');
  Route::name('turno.formTurno')->get('turno/cadastrar', 'TurnoController@cadastrar');
  Route::name('turno.salvar')->post('turno/salvar', 'TurnoController@salvar');
  Route::name('turno.editar')->get('turno/editar/{id}', 'TurnoController@editar');
  Route::name('turno.atualizar')->patch('turno/atualizar', 'TurnoController@atualizar');
  Route::name('turno.deletar')->get('turno/deletar/{id}', 'TurnoController@deletar');

  # DISCIPLINAS
  Route::name('disciplinas')->get("disciplinas", 'DisciplinaController@index');
  Route::name('disciplina.cadastrar')->get('disciplina/cadastrar', 'DisciplinaController@cadastrar');
  Route::name('disciplina.salvar')->post('disciplina/salvar', 'DisciplinaController@salvar');
  Route::name('disciplina.editar')->get('disciplina/editar/{id}', 'DisciplinaController@editar');
  Route::name('disciplina.atualizar')->put('disciplina/atualizar/{id}', 'DisciplinaController@atualizar');
  Route::name('disciplina.deletar')->get('disciplina/deletar/{id}', 'DisciplinaController@deletar');

  # CURSOS
  Route::name('cursos')->get('cursos', 'CursoController@index');
  Route::name('curso.cadastrar')->get('curso/cadastrar', 'CursoController@cadastrar');
  Route::name('curso.editar')->get('curso/editar/{id}', 'CursoController@editar');
  Route::name('curso.salvar')->post('curso/salvar', 'CursoController@salvar');
  Route::name('curso.atualizar')->put('curso/atualizar/{id}', 'CursoController@atualizar');
  Route::name('curso.deletar')->get('curso/deletar/{id}', 'CursoController@deletar');

  # LOGIN
  Route::name('deslogar')->get('deslogar', 'Auth\LoginController@deslogar');

  #SEMESTRES
  Route::name('semestres')->get('semestres', 'SemestreController@index');
  Route::name('semestre.cadastrar')->get('semestre/cadastrar', 'SemestreController@cadastrar');
  Route::name('semestre.editar')->get('semestre/editar/{id}', 'SemestreController@editar');
  Route::name('semestre.salvar')->post('semestre/salvar', 'SemestreController@salvar');
  Route::name('semestre.atualizar')->put('semestre/atualizar/{id}', 'SemestreController@atualizar');
  Route::name('semestre.deletar')->get('semestre/deletar/{id}', 'SemestreController@deletar');

  #CARGOS
  Route::name('cargos')->get('cargos', 'CargoController@index');
  Route::name('cargo.cadastrar')->get('cargo/cadastrar', 'CargoController@cadastrar');
  Route::name('cargo.editar')->get('cargo/editar/{id}', 'CargoController@editar');
  Route::name('cargo.salvar')->post('cargo/salvar', 'CargoController@salvar');
  Route::name('cargo.atualizar')->put('cargo/atualizar/{id}', 'CargoController@atualizar');
  Route::name('cargo.deletar')->get('cargo/deletar/{id}', 'CargoController@deletar');

  #PESSOAS
  Route::name('pessoas')->get('pessoas', function (){ return view('pessoa.index'); });
  Route::name('pessoa.cadastrar')->get('pessoa/cadastrar', function (){ return view('pessoa.formPessoa'); });

  #COORDENADORES
  Route::name('coordenador')->get('coordenadores', function (){ return view('coordenador.index'); });
  Route::name('coordenador.cadastrar')->get('coordenador/cadastrar', function (){ return view('coordenador.formCoordenador'); });

  #INSTITUIÇÃO
  Route::name('instituicao')->get('instituicao', function (){ return view('instituicao.formInstituicao'); });
//});

# Entrada
Route::get('/', function() { return redirect()->route('login'); });

# Login
Route::name('login')->get('login', 'Auth\LoginController@index');
Route::name('logar')->post('logar', 'Auth\LoginController@logar');