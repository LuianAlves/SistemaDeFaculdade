@extends('layouts.layout')

@section('content')
<div class="card">
    <!-- Header Lista -->
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <div class="span"><h5>Cursos Cadastrados</h5></div>
        </div>
        <div class="justify-content-end align-items-center ms-auto">
            <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"data-bs-target="#adicionarNovoCurso">
                <b>Curso +</b>
            </button>
        </div>
    </div>
    <!-- Tabela de Usuarios -->
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-left">Curso</th>
                    <th class="text-center">Quantidade Semestres</th>
                    {{-- <th class="text-center">Total de Horas</th> --}}
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cursos as $curso)
                    <tr class="fw-bold">
                        <td>{{$curso->curso}}</td>
                        <td class="text-center">{{$curso->quantidade_semestres}} Semestres</td>

                        {{-- <td class="text-center">ID: {{$curso->id}}  |  {{$duracaoHoras}} Horas</td> --}}
                       
                        
                        <td class="text-center col-2">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Adicionar Grade Curricular -->
                                    @if(App\Models\Disciplinas::count() != 0)
                                        <a href="{{route('grade-curricular.index', $curso->id)}}" class="dropdown-item text-muted">
                                            <i class="bx bx-border-right me-1"></i>
                                            Grade Curricular
                                        </a>
                                    @endif

                                    <!-- Cadastrar nova Turma -->
                                    @if(App\Models\Alunos::count() != 0 && App\Models\GradeCurricular::where('curso_id', $curso->id)->count() != 0 && App\Models\CalendarioAcademico\PeriodoEscolar::where('Estudantes', 1)->count() != 0)
                                        <a href="{{route('turmas.store', $curso->id)}}" class="dropdown-item text-muted">
                                            <i class="bx bx-border-right me-1"></i>
                                            Gerar Nova Turma
                                        </a>
                                    @endif

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <!-- Visualizar -->
                                    <a type="button" class="dropdown-item text-muted" data-bs-toggle="modal" data-bs-target="#visualizarDadosCurso"
                                        id="{{$curso->id}}" onclick="visualizarCurso(this.id)">
                                        <i class="bx bx-show-alt me-1"></i>
                                        Visualizar Curso
                                    </a>

                                    <!-- Editar -->
                                    <button type="button" class="dropdown-item text-muted editbtn" value="{{$curso->id}}">
                                        <i class="bx bx-edit-alt me-1"></i>
                                        Editar Curso
                                    </button>

                                    <!-- Excluir -->
                                    <form id="{{'remove_'.$curso->id}}"
                                        action="{{route('cursos.destroy', $curso->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a type="button" id="{{'remove_'.$curso->id}}" class="dropdown-item text-danger"
                                            onclick="document.getElementById('remove_{{$curso->id}}').submit()">
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

