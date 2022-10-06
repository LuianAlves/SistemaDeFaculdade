@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <!-- Header Título -->
                <h3 class="card-header p-0 my-4 mx-4" style="color: #14a881; border-bottom: 3px solid #14a881;">Disciplinas
                </h3>

                <!-- Tabela de Usuarios -->
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="text-left">Disciplina</th>
                                <th class="text-center">Área de Conhecimento</th>
                                <th class="text-center">Duração de Horas</th>
                                <th class="text-center">Modalidade</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disciplinas as $disciplina)
                                <tr class="fw-bold">
                                    <td>{{ $disciplina->disciplina }}</td>
                                    <td class="text-center">
                                        @if ($disciplina->classificacaoCurso->id == 1)
                                            <span
                                                class="badge bg-label-primary">{{ $disciplina->classificacaoCurso->area_conhecimento }}</span>
                                        @elseif($disciplina->classificacaoCurso->id == 2)
                                            <span class="badge bg-label-warning">
                                                {{ $disciplina->classificacaoCurso->area_conhecimento }}
                                            </span>
                                        @else
                                            <span class="badge bg-label-info">
                                                {{ $disciplina->classificacaoCurso->area_conhecimento }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $disciplina->duracao_horas }} Horas</td>
                                    <td class="text-center">{{ strtoupper($disciplina->modalidade) }}</td>

                                    <td class="text-center col-2">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Visualizar -->
                                                <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#visualizarDadosDisciplinas" id="{{ $disciplina->id }}"
                                                    onclick="visualizarDisciplina(this.id)">
                                                    <i class="bx bx-show-alt me-1"></i>
                                                    Visualizar Disciplina
                                                </a>

                                                <!-- Editar -->
                                                <button type="button" class="dropdown-item editbtn"
                                                    value="{{ $disciplina->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Editar Disciplina
                                                </button>

                                                <!-- Excluir -->
                                                <form id="{{ 'remove_' . $disciplina->id }}"
                                                    action="{{ route('disciplinas.destroy', $disciplina->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a type="button" id="{{ 'remove_' . $disciplina->id }}"
                                                        class="dropdown-item"
                                                        onclick="document.getElementById('remove_{{ $disciplina->id }}').submit()">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Apagar Disciplina
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"
                            data-bs-target="#adicionarNovaDisciplina" style="background: #14a881; border-color: #14a881;">
                            <b>Disciplinas +</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modal Adicionar disciplina -->
    @include('app.instituicao.cursos.disciplinas.create')

    <!-- Include Modal Editar disciplinas -->
    @include('app.instituicao.cursos.disciplinas.edit')

    <!-- Include Modal Visualizar disciplinas -->
    @include('app.instituicao.cursos.disciplinas.show')

    <!-- Include Scripts -->
    @include('app.instituicao.cursos.disciplinas.disciplinas_scripts')
@endsection
