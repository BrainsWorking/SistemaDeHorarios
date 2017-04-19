	@extends('layout.principal')

	@section('title', 'Turnos')

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

	<div class="form-group">
		{!! Form::label('funcionario', 'Coordenador', ['class' => 'control-label']) !!}
		{!! Form::select('funcionario_id', $funcionarios, null, ['placeholder' => 'Escolha um coordenador', 'required', 'id' => 'funcionario_id', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('disciplinas', 'Disciplinas cadastradas', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-left-0']) !!}
		{!! Form::label('disciplinas', 'Disciplinas selecionadas', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-right-0', 'style' => 'padding-left: 5%;']) !!}
		{!! Form::select('disciplina_id[]', $disciplinas, @$disciplina_id, 
		['id' => 'disciplina_id', 'class' => 'form-control', 'multiple']) !!}
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