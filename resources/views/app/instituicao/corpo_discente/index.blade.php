@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <h3 class="card-header p-0 my-4 mx-2" style="color: #14a881; border-bottom: 3px solid #14a881;">Alunos
                    matriculados
                </h3>

                <!-- Tabela de Alunos -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left"><b>#</b></th>
                                <th class="text-left">Nome</th>
                                <th class="text-left">Telefone</th>
                                <th class="text-center">Área do aluno</th>
                                @canany(['dev|adm'])
                                <th class="text-center">Relatórios</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunos as $aluno)
                                @php
                                    $relatorios = App\Models\RelatorioAlunos::where('aluno_id', $aluno->id)->first();
                                @endphp

                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger"></i>
                                        <strong>{{ $aluno->Estudante->codigo_usuario }}</strong>
                                    </td>
                                    <td>{{ $aluno->Estudante->nome . ' ' . $aluno->Estudante->sobrenome }}</td>
                                    <td>{{ $aluno->Estudante->telefone }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('alunos.area-aluno', $aluno->id) }}">
                                            <i class="bx bx-right-arrow-alt fs-3"></i>
                                        </a>
                                    </td>

                                    @canany(['dev|adm'])
                                        @if (!empty($relatorios))
                                            <td class="text-center">
                                                <a href="{{ route('relatorio-alunos.gerar-relatorio-aluno', $aluno->id) }}">
                                                    <i class="bx bx-plus-circle text-info fs-3 mx-3"></i>
                                                </a>
                                                <a href="{{ route('relatorio-alunos.view-relatorios', $aluno->id) }}">
                                                    <i class="bx bx-file text-danger fs-3"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
