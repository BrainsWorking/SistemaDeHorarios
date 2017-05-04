@extends('layout.principal')
@section('title', 'Instituição')
@section('content')

<h1>FPA</h1>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpaInicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpaFim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Semestre de Referência', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->nome, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Inicio', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->inicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Fim', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

{!! Form::open(['method' => 'post', 'route' => 'fpa.salvar']) !!}


<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Regime de Trabalho', ['class' => 'control-label']) !!} <br />
    {!! Form::label('', '20 Horas', ['class' => 'control-label']) !!}
    {!! Form::radio('regimeTrabalho', '20 Horas', true) !!}
    {!! Form::label('', '40 Horas', ['class' => 'control-label',]) !!}
    {!! Form::radio('regimeTrabalho', '40') !!}
</div>

<div class="col-lg-12 form-group padding-left-0" id="div-prioridade">
    {!! Form::checkbox('prioridade', 'true', false, ['class' => '']) !!}
    {!! Form::label('', 'Sim, desejo me dedicar prioritariamente a atividades de ensino.', 
    ['class' => 'control-label']) !!}
</div>


<div class="col-lg-12 form-group padding-left-0">


	<div class="col-lg-6 margin-bottom">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#menu1">Disponibilidade</a></li>
			<li><a data-toggle="tab" href="#menu2">Componentes</a></li>
		</ul>
	</div>

	<div class="tab-content">

		<div id="menu1" class="tab-pane fade in active">
			<div class="col-lg-12 form-group padding-left-0">
				{!! Form::label('', 'SELECIONE OS HORÁRIOS EM QUE DESEJA LECIONAR', ['class' => 'control-label']) !!}
				
				<a href="#" data-toggle="tooltip" data-placement='right' 
					title="Para selecionar um horário basta clicar nos retangulos abaixo.">
					<span class="glyphicon glyphicon-info-sign"></span>
				</a>
			</div>

			<table class='table table-bordered'>
			
				<thead>
					<tr>
						<th class="text-center">Turno</th>
						<th class="text-center">Horário</th>
						@foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] as $semana)
							<th class="text-center">{{ $semana }}</th>
						@endforeach
					</tr>
				</thead>
				
				<tbody>
					@foreach($horarios_manha as $horario)
					<tr>

						@if($loop->first)
							<th rowspan="{{count($horarios_manha)}}" class="turno rotate-90"><span>Manhã</span></th>
						@endif

						<td>{{$horario->inicio}} às {{$horario->fim}}</td>

						@foreach($dias_semana as $semana)
						<td class='td-disciplina none-padding'>
							{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
							['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
							<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
						</td>
						@endforeach
						
					</tr>
					
					@endforeach

					@foreach($horarios_tarde as $horario)
						<tr>

							@if($loop->first)
								<th rowspan="{{count($horarios_tarde)}}" class="turno rotate-90"><span>Tarde</span></th>
							@endif

							<td>{{$horario->inicio}} às {{$horario->fim}}</td>

							@foreach($dias_semana as $semana)
							<td class='td-disciplina none-padding'>
								{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
								['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
								<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
							</td>
							@endforeach
							
						</tr>
					@endforeach


					@foreach($horarios_noite as $horario)
						<tr>

							@if($loop->first)
								<th rowspan="{{count($horarios_noite)}}" class="turno rotate-90"><span>Noite</span></th>
							@endif

							<td> {{$horario->inicio}} às {{$horario->fim}}</td>

							@foreach($dias_semana as $semana)
								<td class='td-disciplina none-padding'>
									{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
									['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
									<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
								</td>
							@endforeach
							
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>

		<div id="menu2" class="tab-pane fade col-lg-12">
			<div class="control-group">
				<button type="button" class="btn btn-success add-field none-margin">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					Adicionar Disciplina
				</button>
			</div>

			<div class="escolha-disciplinas col-lg-12">
				<div class="row">
				
					<div class="col-lg-2">
						<label class="index">Disciplina 1</label>
					</div>
					
					<div class="form-group col-lg-4">
						<select name="componentes[]" class="chosen-select" data-placeholder=" ">
							<option value=''></option>
							@foreach($disciplinas as $disciplina)
								<option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
							@endforeach
							<!--optgroup label="ADS">
							</optgroup -->
						</select>
					</div>
					
				</div>
			</div>
			
			<button type="submit" class="btn btn-success right">
				<span class="glyphicon glyphicon-floppy-disk"></span>
				Salvar
			</button>

		</div>
	
	
	</div>


</div>

{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fpa.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('css/fpa.css')}}">
@endsection
@endsection