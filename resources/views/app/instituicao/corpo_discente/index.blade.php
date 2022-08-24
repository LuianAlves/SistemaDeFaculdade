@extends('layouts.layout01')

@section('content')
<div class="card">
    <!-- Header Lista -->
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <div class="span"><h5>Alunos Cadastrados</h5></div>
        </div>
    </div>

    <!-- Tabela de Alunos -->
    <div class="card-body">
        <div class="text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left"><b>#</b></th>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Telefone</th>
                        <th class="text-center">Área do Aluno</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>{{$aluno->Estudante->codigo_usuario}}</strong>
                        </td>
                        <td>{{$aluno->Estudante->nome.' '.$aluno->Estudante->sobrenome}}</td>
                        <td>{{$aluno->Estudante->telefone}}</td>

                        <td class="text-center">
                            <a href="{{route('alunos.area-aluno', $aluno->id)}}">
                                <i class="bx bx-right-arrow-alt fs-3"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

