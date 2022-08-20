@extends('layouts.layout01')

@section('content')
<div class="card">
    <!-- Header Lista -->
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <div class="span"><h5>Turmas</h5></div>
        </div>
    </div>
    <!-- Tabela de Usuarios -->
    <div class="card-body">
        <div class="text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th><b>Código Turma</b></th>
                        <th>Curso</th>
                        <th>Ano Escolar</th>
                        <th>Disponibilidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmas as $turma)
                        @php
                            $qntdAlunos = App\Models\Alunos::where('serie_turma', $turma->id)->count();
                            if($qntdAlunos > 2) {
                                $status = 1;
                            } else {
                                $status = 2;
                            }
                        @endphp
                    <tr class="text-center">
                        <td>{{$turma->codigo_turma}}</td>
                        <td>{{$turma->curso->curso}}</td>
                        {{-- <td>{{$turma->gradeCurricular->}}</td> --}}
                        <td>{{$turma->periodoEscolar->ano_periodo_escolar}}</td>

                        <td>
                            @if($status == 1)
                                <span class="badge bg-label-danger">CHEIA</span>
                            @else
                                <span class="badge bg-label-success">DISPONÍVEL</span>
                            @endif
                        </td>
                        
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Visualizar -->
                                    <a type="button" class="dropdown-item">
                                        <i class="bx bx-show-alt me-1"></i>
                                        Administrar Grade Curricular
                                    </a>

                                    <!-- Visualizar -->
                                    <a type="button" class="dropdown-item">
                                        <i class="bx bx-show-alt me-1"></i>
                                        Gerar Relatório da Turma
                                    </a>

                                    <!-- Editar -->
                                    <button type="button" class="dropdown-item">
                                        <i class="bx bx-edit-alt me-1"></i>
                                        Alunos Matriculados
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

