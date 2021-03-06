@extends('layout.principal')
@section('title', 'Instituição')
@section('content')

<h1>FPA</h1>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpa_inicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpa_fim, ['class' => 'form-control', 'required' , 'disabled']) !!}
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

@if(isset($disciplinasSelecionados) || isset($disponibilidadeChecada))
	{!! Form::open(['method' => 'post', 'route' => 'fpa.atualizar', 'class' => 'form']) !!}
@else
	{!! Form::open(['method' => 'post', 'route' => 'fpa.salvar', 'class' => 'form']) !!}
@endif

<div class="col-lg-4 form-group padding-left-0" id="regimeTrabalho">
    {!! Form::label('', 'Regime de Trabalho', ['class' => 'control-label']) !!} <br />
    <label class="control-label">
		{!! Form::radio('regimeTrabalho', '20', $fpa->carga_horaria == 20 ? true : false) !!} 20 Horas
    </label>
	<label class="control-label">
    	{!! Form::radio('regimeTrabalho', '40', $fpa->carga_horaria == 40 ? true : false) !!} 40 Horas
	</label>
</div>

<div class="col-lg-12 form-group padding-left-0" id="div-prioridade">
    <label class="control-label none-margin">
		{!! Form::checkbox('prioridade', 'true', false, ['class' => '']) !!}
		Sim, desejo me dedicar prioritariamente a atividades de ensino.
    </label>
</div>

<div class="col-lg-12 form-group padding-left-0">
	<div class="col-lg-12 margin-bottom">
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
						@foreach($dias_semana as $semana)
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
							@if(isset($disponibilidadeChecada))							
								@php
								$flag = false;
								@endphp
								@foreach($disponibilidadeChecada as $horario_checado)								
									@if($horario_checado->id == $horario->id and $horario_checado->pivot->dia_semana == strtoupper($semana))
									<td class='td-disciplina none-padding'>										
										{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
										['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}", 'checked'=>'true']) !!}
										<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
									</td>
										@php
										$flag = true;
										@endphp
										@break
									@endif
								@endforeach
								@if(!$flag)
								<td class='td-disciplina none-padding'>
									{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
									['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
									<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
								</td>
								@endif
							@else
							<td class='td-disciplina none-padding'>
								{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
								['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
								<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
							</td>
							@endif						
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
							@if(isset($disponibilidadeChecada))							
								@php
								$flag = false;
								@endphp
								@foreach($disponibilidadeChecada as $horario_checado)
									@if($horario_checado->id == $horario->id and $horario_checado->pivot->dia_semana == strtoupper($semana))
									<td class='td-disciplina none-padding'>
										{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
										['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}", 'checked'=>'true']) !!}
										<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
									</td>
										@php
										$flag = true;
										@endphp
										@break
									@endif
								@endforeach
								@if(!$flag)
								<td class='td-disciplina none-padding'>
									{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
									['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
									<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
								</td>
								@endif
							@else
							<td class='td-disciplina none-padding'>
								{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
								['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
								<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
							</td>
							@endif						
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
								@if(isset($disponibilidadeChecada))							
								@php
								$flag = false;
								@endphp
								@foreach($disponibilidadeChecada as $horario_checado)
									@if($horario_checado->id == $horario->id and $horario_checado->pivot->dia_semana == strtoupper($semana))
									<td class='td-disciplina none-padding'>
										{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
										['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}", 'checked'=>'true']) !!}
										<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
									</td>
										@php
										$flag = true;
										@endphp
										@break
									@endif
								@endforeach
								@if(!$flag)
								<td class='td-disciplina none-padding'>
									{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
									['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
									<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
								</td>
								@endif
							@else
							<td class='td-disciplina none-padding'>
								{!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
								['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
								<label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
							</td>
							@endif
							@endforeach							
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>

		<div id="menu2" class="tab-pane fade col-lg-12">
			<div class="col-lg-12 form-group padding-left-0">
				{!! Form::label('', 'SELECIONE AS DISCIPLINAS QUE TEM INTERESSE EM LECIONAR', 
				['class' => 'control-label']) !!}
				
				<a href="#" data-toggle="tooltip" data-placement='right' 
					title="Clique no botão abaixo para habilitar novos campos de seleção.">
					<span class="glyphicon glyphicon-info-sign"></span>
				</a>
			</div>

			<div class="control-group">
				<button type="button" class="btn btn-success add-field none-margin">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					Adicionar Disciplina
				</button>
			</div>

			<div class="escolha-disciplinas col-lg-12">									
						@if(isset($disciplinasSelecionadas))
							@foreach($disciplinasSelecionadas as $disciplina)
							<div class="row">
								<div class="col-lg-2">
									<label class="index">Disciplina {{$loop->iteration}}</label>
								</div>					
								<div class="form-group col-lg-9">
									<select name="componentes[]" class="chosen-select" data-placeholder=" ">
										<option value="{{$disciplina->id}}" selected>{{$disciplina->nome}}</option>	
									</select>	
								</div>
								<div class="col-lg-1 padding-right-0 remove-field">
									<button type="button" class="btn btn-danger btn-sm">
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</div>
							</div>
							@endforeach
						@else
						<div class="row">
						<div class="col-lg-2">
							<label class="index">Disciplina 1</label>
						</div>					
						<div class="form-group col-lg-9">
							<select name="componentes[]" class="chosen-select" data-placeholder=" ">
								<option value=''></option>
								@foreach($disciplinas_curso as $curso)
									@foreach($curso as $disciplina)
										<option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
									@endforeach
								@endforeach						
							</select>
						</div>
					</div>
						@endif						
					</div>
		</div>

		<button type="submit" class="btn btn-success right">
			<span class="glyphicon glyphicon-floppy-disk"></span>
			Salvar
		</button>
	
	
	</div>


</div>

{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/fpa.js')}}"></script>
    <script>
		$(document).ready(function(){
			'use strict'
			var wrapper = $(".escolha-disciplinas");
			var button = $(".add-field");
			var x = $('.index').length + 1;

			$(button).click(function(e){
				e.preventDefault();
				$(wrapper).append(`
					<div class="row">
						<div class="col-lg-2">
							<label class="index">Disciplina ` + x + `</label>
						</div>
						<div class="form-group col-lg-9">
							<select name="componentes[]" class="chosen-select" data-placeholder=" ">
								<option value=''></option>
								@foreach($disciplinas_curso as $curso)
									@foreach($curso as $disciplina)
										<option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
									@endforeach
								@endforeach
								<!--optgroup label="ADS">
								</optgroup -->
							</select>
						</div>
						<div class="col-lg-1 padding-right-0 remove-field">
							<button type="button" class="btn btn-danger btn-sm">
								<span class="glyphicon glyphicon-remove"></span>
							</button>
						</div>
					</div>
				`);

				$(".chosen-select").chosen({
					no_results_text: "Nenhuma disciplina encontrada!",
					width: '100%',
					allow_single_deselect: true 
				});
				x++;
			});

			$(wrapper).on("click", ".remove-field", function(e){
				e.preventDefault();
				$(this).parent().remove();

				var labels = $('.index');
				for (var i = 0; i <= x; i++) {
					$(labels[i]).html("Disciplina " + (i + 1));
				};
				x--;
			});
		});
	
	</script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('css/fpa.css')}}">
@endsection

@endsection