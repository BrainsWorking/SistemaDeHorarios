@extends('layout.principal')

@section('title', 'Turnos')

@section('content')
@parent

<div class="table-responsive">
    <table class="table table-condensed table-hover">
        <thead>

            @include('layout.components.barra_pesquisar_cadastrar', ["route" => "turno.formTurno"])

            <th class="text-center"></th>
            <th class="text-center">Turno</th>
            <th class="text-center">Quantidade de Aulas</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Remover</th>
        </thead>


        <tbody>

            @forelse ($turnos as $turno)
            <tr class="table-line">
                <td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
                <td class="text-center search"> {{$turno->nome}} </td>
                <td class="text-center search"> {{$turno->quantidade_aulas}} </td>
                <td class="text-center"><a href="{{ route('turno.editar', $turno->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td class="text-center"><a href="{{ route('turno.deletar', $turno->id) }}" class="table-delete confirmar"><span
                    class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                <tr class="hidden-info">
                    <td colspan="5">
                        <div class="hidden-info-content">
                            <div class="col-lg-3">
                                <p><b>Nome do Turno:</b> {{$turno->nome}}</p>
                                <p><b>Quantidade de Aulas:</b> {{$turno->quantidadeAulas}}</p>
                            </div>
                            <div class="col-lg-9">
                                @foreach($turno->horarios as $horario)
                                <div class="col-lg-2 btn hidden-info-content-data-turno text-center">
                                    <div class="col-lg-2 horario-indice">
                                        <p><b>A{{ $loop->iteration }}</b></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p><span class="glyphicon glyphicon-log-in"></span> {{$horario->inicio}}h</p>
                                        <p><span class="glyphicon glyphicon-log-out"></span> {{$horario->fim}}h</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </td>
                </tr>

                @empty
                <tr class="text-center">
                    <td colspan="5"><h4>Não há turnos cadastrados</h4></td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    @endsection

    @section('scripts')
    <script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
    @endsection