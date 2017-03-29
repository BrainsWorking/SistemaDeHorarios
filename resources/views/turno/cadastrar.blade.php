	@extends('layout.principal')

	@section('title', 'Turnos')

	@section('content')
	@parent


	@if(isset($turno))
	{!! Form::model($turno, ['route'=>['turno.atualizar', $turno->id], 'method'=>'PUT']) !!}
	@else
	{!! Form::open(['route' => 'turno.salvar', 'method' => 'post']) !!}
	@endif

	<h1 class="text-center page-header"></h1>

	<div class="control-group">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', '', ['class' => 'form-control', 'required']) !!}
	</div>

	<div class="control-group">
		<button type="button" class="btn btn-success add-field">Adicionar Horário de Aula</button>
	</div>

	<div class="horarios-turno col-lg-12">
		@if(isset($turno))
		@foreach($turno->$turno_horarios as $horarios)
		<div class="row">
			<div class="col-lg-1 padding-left-0"><label class="index">Aula 1</label></div>
			<div class="col-lg-10">
				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', $horarios->inicio, ['class'=>'form-control', 'placeholder'=>'Início', 'maxlength' => '5', 'required']) !!}
				</div>

				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', $horarios->fim, ['class'=>'form-control', 'placeholder'=>'Fim', 'maxlength' => '5', 'required']) !!}
				</div>
			</div>
			<div class="col-lg-1 padding-right-0">
			</div>
		</div>
		@endforeach
		@else
		<div class="row">
			<div class="col-lg-1 padding-left-0"><label class="index">Aula 1</label></div>
			<div class="col-lg-10">
				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control', 'placeholder'=>'Início', 'maxlength' => '5', 'required']) !!}
				</div>

				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control', 'placeholder'=>'Fim', 'maxlength' => '5', 'required']) !!}
				</div>
			</div>
			<div class="col-lg-1 padding-right-0">
			</div>
		</div>
		@endif
	</div>

	<button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

	{{-- {!! Form::submit("Salvar", ["class" => 'btn btn-lg btn-success right ']) !!} --}}

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/cadastro_turno.js') }}"></script>
	@endsection