@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-3" id="card-main">
                <div class="card-body">

                    <div class="row mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            @canany(['dev', 'administracao', 'professor'])
                                <h4 class="card-title">
                                    {{ 'Área do aluno - ' . ucwords($aluno->Estudante->nome) . ' ' . ucwords($aluno->Estudante->sobrenome) }}
                                </h4>
                                <a type="button" class="btn btn-sm btn-primary fw-bold" href="{{ route('alunos.index') }}">
                                    <b>Listagem de alunos</b>
                                </a>
                            @endcanany
                            @can('aluno')
                                <h4 class="card-title">
                                    {{ 'Bem vindo ' . ucwords($aluno->Estudante->nome) . ' ' . ucwords($aluno->Estudante->sobrenome) }}
                                </h4>
                            @endcan
                            
                        </div>
                    </div>

                    @canany(['administracao', 'dev'])
                        <div class="row">
                            {{-- Informações Adicionais --}}
                            <div class="col-4">
                                <div class="card mini-card">
                                    <div class="card-body">
                                        <h6 class="text-center fw-bold m-2">Informação do aluno</h6>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="editbtn"
                                                style="background: transparent; border: none;" value="{{ $aluno->id }}">
                                                <i class="bx bx-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Visualizar Informações --}}
                            <div class="col-4">
                                <div class="card mini-card">
                                    <div class="card-body">
                                        <h6 class="text-center fw-bold m-2">Visualizar Informações</h6>
                                        <div class="d-flex justify-content-center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#visualizarDadosAluno"
                                                id="{{ $aluno->id }}" onclick="visualizarAluno(this.id)">
                                                <i class="bx bx-minus-front"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gerar Relatório -->
                        <div class="row">
                            @if(App\Models\Notas\LancamentoNotas::where('aluno_id', $aluno->id)->count() != 0)
                                <div class="col-4">
                                    <div class="card mini-card">
                                        <div class="card-body">
                                            <h6 class="text-center fw-bold m-3">Gerar relatório</h6>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('relatorio-alunos.gerar-relatorio-aluno',$aluno->id)}}">
                                                    <i class="bx bx-plus-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(App\Models\RelatorioAlunos::where('aluno_id', $aluno->id)->count() != 0)
                                <div class="col-4">
                                    <div class="card mini-card">
                                        <div class="card-body">
                                            <h6 class="text-center fw-bold m-3">Relatórios</h6>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('relatorio-alunos.view-relatorios', $aluno->id)}}">
                                                    <i class="bx bx-file"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Excluir Aluno --}}
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="card mini-card">
                                    <div class="card-body">
                                        <h6 class="text-center text-danger fw-bold m-2">Desmatricular Aluno</h6>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('alunos.destroy', $aluno->id) }}" id="delete">
                                                <i class="bx bx-block text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcanany

                    @can('professor')
                        <!-- Lançamento de Notas -->
                        @if ($aluno->serie_turma != '' && $aluno->curso_id != '')
                            <div class="row">
                                <div class="col-4">
                                    <div class="card mini-card">
                                        <div class="card-body">
                                            <h6 class="text-center fw-bold m-3">Lançamento de Notas</h6>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('lancar-notas.gerando-view', $aluno->id) }}">
                                                    <i class="bx bx-plus-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-danger fw-bold">Aluno não está matriculado em nenhum de nossos cursos.</span>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Include de modal adicionar/editar -->
@include('app.instituicao.corpo_discente.edit')

<!-- Include de modal visualizar -->
@include('app.instituicao.corpo_discente.show')

<!-- Include Scripts -->
@include('app.instituicao.corpo_discente.alunos_scripts')

<style>
    * {
        font-family: "Poppins", sans-serif;
    }

    h4 {
        font-size: 26px;
    }

    h6 {
        color: #45505b;
    }

    .card .mini-card {
        border-radius: 15px;
        margin-top: 10px;
        align-items: center;
        background: rgba(255, 255, 255, 0.411);
    }

    .card .mini-card i {
        font-size: 50px;
        margin-top: 10px;
        color: #45505b;
    }

    .card .mini-card:hover i {
        font-size: 56px;
        color: #34ebba;
    }
</style>
