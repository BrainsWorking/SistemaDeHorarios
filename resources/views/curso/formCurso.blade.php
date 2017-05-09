	@extends('layout.principal')

	@section('title', 'Cursos')

	@section('content')
	@parent

	@if(isset($curso))
	{!! Form::model($curso, ['route' => ['curso.atualizar', $curso->id], 'method' => 'PUT']) !!}
	@else
	{!! Form::open(['route' => 'curso.salvar', 'method' => 'post']) !!}
	@endif

	<div class="col-lg-8 form-group padding-left-0">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
	</div>
	<div class="col-lg-4 form-group padding-right-0">
		{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
		{!! Form::text('sigla', null, ['class' => 'form-control', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('turno', 'Turno', ['class' => 'control-label']) !!}
		{!! Form::select('turno_id', $turnos, null, ['placeholder' => 'Escolha um turno', 'required', 'id' => 'turno_id', 'class' => 'form-control']) !!}
	</div>

	<div class="col-lg-8 form-group padding-left-0">
		{!! Form::label('funcionario', 'Coordenador', ['class' => 'control-label']) !!}
		<a href="#" data-toggle="tooltip" data-placement='right' title="Caso o funcionário desejado não apareça na lista verifique se o mesmo está cadastrado no menu 'Funcionários' ou se o referido funcionário já não está cadastrado como coordenador de outro curso."><span class="glyphicon glyphicon-info-sign"></span></a>
		{!! Form::select('funcionario_id', $funcionarios, null, ['placeholder' => 'Escolha um coordenador', 'id' => 'funcionario_id', 'class' => 'form-control']) !!}
	</div>

	<div class="col-lg-4 form-group padding-right-0">
		{!! Form::label('modulos', 'Quantidade de Semestres', ['class' => 'control-label']) !!}
		{!! Form::number('modulos', null, ['required', 'class' => 'form-control']) !!}
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body"></div>
	</div>


	<button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
	<a class="btn btn-danger right cancelar" href="{{ route('cursos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script>
	$('#disciplina_id').multiSelect();
	</script>
	<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
	@endsection