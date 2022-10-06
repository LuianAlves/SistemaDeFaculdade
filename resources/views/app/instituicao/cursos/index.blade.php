@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <!-- Header Título -->
                <h3 class="card-header p-0 my-4 mx-4" style="color: #14a881; border-bottom: 3px solid #14a881;">Cursos
                </h3>

                <!-- Tabela de cursos -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left">Curso</th>
                                <th class="text-left">Quantidade Semestres</th>
                                {{-- <th class="text-center">Total de Horas</th> --}}
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                                <tr class="fw-bold">
                                    <td>{{ $curso->curso }}</td>
                                    <td>{{ $curso->quantidade_semestres }} Semestres</td>

                                    {{-- <td class="text-center">ID: {{$curso->id}}  |  {{$duracaoHoras}} Horas</td> --}}


                                    <td class="text-center col-2">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Adicionar Grade Curricular -->
                                                @if (App\Models\Disciplinas::count() != 0)
                                                    <a href="{{ route('grade-curricular.index', $curso->id) }}"
                                                        class="dropdown-item text-muted">
                                                        <i class="bx bx-border-right me-1"></i>
                                                        Grade Curricular
                                                    </a>
                                                @endif

                                                <!-- Cadastrar nova Turma -->
                                                @if (App\Models\Alunos::count() != 0 &&
                                                    App\Models\GradeCurricular::where('curso_id', $curso->id)->count() != 0 &&
                                                    App\Models\CalendarioAcademico\PeriodoEscolar::where('Estudantes', 1)->count() != 0)
                                                    <a href="{{ route('turmas.store', $curso->id) }}"
                                                        class="dropdown-item text-muted">
                                                        <i class="bx bx-border-right me-1"></i>
                                                        Gerar Nova Turma
                                                    </a>
                                                @endif

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <!-- Visualizar -->
                                                <a type="button" class="dropdown-item text-muted" data-bs-toggle="modal"
                                                    data-bs-target="#visualizarDadosCurso" id="{{ $curso->id }}"
                                                    onclick="visualizarCurso(this.id)">
                                                    <i class="bx bx-show-alt me-1"></i>
                                                    Visualizar Curso
                                                </a>

                                                <!-- Editar -->
                                                <button type="button" class="dropdown-item text-muted editbtn"
                                                    value="{{ $curso->id }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Editar Curso
                                                </button>

                                                <!-- Excluir -->
                                                <form id="{{ 'remove_' . $curso->id }}"
                                                    action="{{ route('cursos.destroy', $curso->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a type="button" id="{{ 'remove_' . $curso->id }}"
                                                        class="dropdown-item text-danger"
                                                        onclick="document.getElementById('remove_{{ $curso->id }}').submit()">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Apagar Curso
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
                        <button type="button" class="btn btn-sm btn-primary fw-bold"
                            data-bs-toggle="modal"data-bs-target="#adicionarNovoCurso"
                            style="background: #14a881; border-color: #14a881;">
                            <b>Cursos +</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modal Adicionar Curso -->
    @include('app.instituicao.cursos.create')

    <!-- Include Modal Editar cursos -->
    @include('app.instituicao.cursos.edit')

    <!-- Include Modal Visualizar cursos -->
    @include('app.instituicao.cursos.show')

    <!-- Include Scripts -->
    @include('app.instituicao.cursos.cursos_scripts')
@endsection
