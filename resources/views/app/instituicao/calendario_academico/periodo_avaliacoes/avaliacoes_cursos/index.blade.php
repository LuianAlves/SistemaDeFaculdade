@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="card">
            <div class="row mt-3 mx-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        @switch($avaliacao->tipo_prova)
                            @case(1)
                                NP1
                            @break

                            @case(2)
                                Substutiva NP1
                            @break

                            @case(3)
                                NP2
                            @break

                            @case(4)
                                Substutiva NP2
                            @break

                            @case(5)
                                Exame
                            @break

                            @default
                        @endswitch
                    </h4>
                    <a type="button" class="btn btn-sm btn-primary fw-bold" href="{{ route('periodo-avaliacoes.index') }}">
                        <b>Agendamento de avaliações</b>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form class="mb-2" action="{{ route('avaliacoes-cursos.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="periodo_avaliacoes_id" id="periodo_avaliacoes_id" value="{{ $avaliacao->id }}">

                    <div class="row">
                        <div class="col-5">
                            <label class="form-label" for="curso_id">Curso</label>
                            <select class="form-select" name="curso_id" id="curso_id">
                                <option selected disabled>Selecionar Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}" data-value="{{ $curso->curso }}">{{ $curso->curso }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="turma_id">Turma</label>
                            <select class="form-select" id="turma_id" name="turma_id">
                                <option selected disabled>Selecione a Turma</option>
                                @foreach ($turmas as $turma)
                                    <option value="{{$turma->id}}" data-value="{{$turma->codigo_turma}}">{{$turma->codigo_turma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-5">
                            <label class="form-label" for="disciplina_id">Disciplina</label>
                            <select class="form-select" id="disciplina_id" name="disciplina_id">
                                <option selected disabled>Selecionar Disciplina</option>
                                @foreach ($disciplinas as $disciplina)
                                    <option value="{{$disciplina->id}}" data-value="{{$disciplina->disciplina}}">{{$disciplina->disciplina}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="disciplina_id-error"></strong>
                            </span>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="basic-icon-default-fullname">Data Prova</label>
                            <div class="input-group input-group-merge">
                                <input type="date" min="{{ $avaliacao->inicio_periodo_avaliacoes }}"
                                    max="{{ $avaliacao->termino_periodo_avaliacoes }}" class="form-control"
                                    name="data_da_prova" id="data_da_prova">
                            </div>
                            <span class="text-danger">
                                <strong id="data_da_prova-error"></strong>
                            </span>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-end">
                            <label class="form-label" for="basic-icon-default-estate"></label>
                            <button type="submit" class="btn btn-primary">
                                +
                            </button>
                        </div>


                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Turma</th>
                            <th class="text-center">Curso</th>
                            <th class="text-center">Disciplina</th>
                            <th class="text-center">Data da prova</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($avaliacoesCursos as $avaliacao)
                            <tr class="fw-bold">
                                <td class="text-center fw-bold">{{$avaliacao->Turma->codigo_turma}}</td>
                                <td class="text-center">{{$avaliacao->Curso->curso}}</td>
                                <td class="text-center">{{$avaliacao->Disciplina->disciplina}}</td>
                                <td class="text-center">{{Carbon\Carbon::parse($avaliacao->data_da_prova)->format('d/m/Y')}}</td>

                                <td class="text-center">
                                    @if(Carbon\Carbon::now() > $avaliacao->data_da_prova) 
                                        <span class="badge bg-label-primary">Realizada</span>
                                    @else
                                        <span class="badge bg-label-warning">Pendente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.avaliacoes_cursos_scripts')
