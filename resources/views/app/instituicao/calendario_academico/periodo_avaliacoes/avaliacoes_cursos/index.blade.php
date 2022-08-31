@extends('layouts.layout01')

@section('content')
    <div class="row">
        <div class="card">
            <!-- Header Lista -->
            <div class="card-header">
                <h5>
                    @switch($avaliacao->tipo_prova)
                        @case(1)
                            NP1
                        @break

                        @case(2)
                            NP2
                        @break

                        @case(3)
                            Substutiva
                        @break

                        @case(2)
                            Exame
                        @break

                        @default
                    @endswitch
                </h5>
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
                            <th class="text-center" colspan="2">Período Avaliações</th>
                            <th class="text-center">Campus</th>
                            <th class="text-center">Prova</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($avaliacoes as $avaliacao)
                        <tr class="fw-bold">
                            <td class="text-center">{{$prova->}}</td>
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->inicio_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->termino_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">
                                @if ($avaliacao->tipo_prova == 1)
                                    <span class="badge bg-label-primary">NP1</span>
                                @elseif($avaliacao->tipo_prova == 2)
                                    <span class="badge bg-label-info">NP2</span>
                                @elseif($avaliacao->tipo_prova == 3)
                                    <span class="badge bg-label-danger">Substutiva</span>
                                @elseif($avaliacao->tipo_prova == 4)
                                    <span class="badge bg-label-warning">Exame</span>
                                @endif
                            </td>

                            <td class="text-center col-2">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Adicionar Curso -->
                                        <a href="{{route('avaliacoes-cursos.index', $avaliacao->id)}}" class="dropdown-item text-muted">
                                            <i class="bx bx-border-right me-1"></i>
                                            Curso/Semestre
                                        </a>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.avaliacoes_cursos_scripts')
