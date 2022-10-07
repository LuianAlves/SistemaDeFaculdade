@extends('layouts.layout')

@section('content')
{{-- Breadcrumb --}}
@include('layouts.breadcrumb')

<div class="card">
    <div class="row p-2">
        <div class="col-12">
            <!-- Header Título -->
            <h3 class="title-padrao p-0 my-4 mx-4">Turmas
            </h3>

            <!-- Tabela de Usuarios -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th><b>Turma</b></th>
                            <th>Curso</th>
                            <th>Ano Escolar</th>
                            <th>Disponibilidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turmas as $tr)
                        @php
                        $turma = App\Models\Turmas::where('curso_id', $tr->curso_id)->where('periodo_escolar_id',
                        $tr->periodo_escolar_id)->orderBy('id', 'DESC')->first();
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
                                        <a href="{{route('semestre-atual.grade-curricular', $tr->id)}}"
                                            class="dropdown-item">
                                            <i class="bx bx-show-alt me-1"></i>
                                            Administrar grade curricular
                                        </a>

                                        <!-- Visualizar -->
                                        <a href="{{route('relatorio-turmas.gerar-relatorio-turma', $tr->id)}}"
                                            class="dropdown-item">
                                            <i class="bx bx-show-alt me-1"></i>
                                            Gerar Relatório da Turma
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{route('semestre-atual.alunos-matriculados', $tr->id)}}"
                                            class="dropdown-item">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Alunos Matriculados
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="d-flex justify-content-center align-items-center">
                        {{$turmas->links('vendor.pagination.default')}}
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            Turmas cadastradas: {{$turmas->total()}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection