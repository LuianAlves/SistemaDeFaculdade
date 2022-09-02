@extends('layouts.layout01')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-3" id="card-main">
                <div class="card-body">

                    <div class="row mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                {{ 'Área do aluno - ' . ucwords($aluno->Estudante->nome) . ' ' . ucwords($aluno->Estudante->sobrenome) }}
                            </h4>
                            <a type="button" class="btn btn-sm btn-primary fw-bold" href="{{ route('alunos.index') }}">
                                <b>Listagem de Alunos</b>
                            </a>
                        </div>
                    </div>

                    @can('administracao')
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

                        @canany(['professor', 'administracao'])
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
                            @endif
                        @endcanany

                        <!-- Gerar Relatório -->
                        <div class="row">
                            <div class="col-4">
                                <div class="card mini-card">
                                    <div class="card-body">
                                        <h6 class="text-center fw-bold m-3">Gerar relatório</h6>
                                        <div class="d-flex justify-content-center">
                                            <a href="#">
                                                <i class="bx bx-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
