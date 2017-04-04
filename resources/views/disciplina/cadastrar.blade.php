@extends('layout.principal')

@section('title', 'Disciplina')

@section('content')
@parent

@include('layout.alerts')

@if(isset($disciplina))
{!! Form::model($disciplina, ['route'=>['disciplina.atualizar', $disciplina->id], 'method'=>'PUT']) !!}
@else
{!! Form::open(['route' => 'disciplina.salvar', 'method' => 'post']) !!}
@endif

<div class="control-group">
    <button type="button" class="btn btn-success add-field">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
    </button>
</div>

<div class="row">
    <div class="disciplinas">
        <div class="control-group form-group col-sm-8">
            {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
            {!! Form::text('nome', '', ['class' => 'form-control', 'required']) !!}
        </div>

        <div class="control-group form-group col-sm-3">
            {!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
            {!! Form::text('sigla', '', ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

{!! Form::close() !!}

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/cadastro_disciplina.js') }}"></script>
@endsection