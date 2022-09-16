@extends('layouts.layout')

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
                    @foreach ($turmas as $tr)
                        @php
                            $turma = App\Models\Turmas::where('curso_id', $tr->curso_id)->where('periodo_escolar_id', $tr->periodo_escolar_id)->orderBy('id', 'DESC')->first();
                            $countAlunos = App\Models\Alunos::where('serie_turma', $tr->id)->count();

                            $limiteAlunos = 5;
                            // dd($count);

                            $vagasTurma = $limiteAlunos - $countAlunos;
                        @endphp

                        <tr class="text-center">
                            <td>{{$tr->codigo_turma}}</td>
                            <td>{{$tr->curso->curso}}</td>
                            <td>{{$tr->periodoEscolar->ano_periodo_escolar}}</td>

                            <td>
                                @if($countAlunos >= $limiteAlunos)
                                    <span class="badge bg-label-danger fw-bold">CHEIA</span>
                                @else
                                    <span class="badge bg-label-success fw-bold">{{"[$vagasTurma]"}} vagas</span>
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
                                        <a href="{{route('semestre-atual.grade-curricular', $tr->id)}}" class="dropdown-item">
                                            <i class="bx bx-show-alt me-1"></i>
                                            Administrar grade curricular
                                        </a>

                                        <!-- Visualizar -->
                                        <a href="{{route('relatorio-turmas.gerar-relatorio-turma', $tr->id)}}" class="dropdown-item">
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

