@extends('layouts.layout')

@section('content')
<div class="card">
    <!-- Header Lista -->
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <div class="span"><h5>Professores cadastrados</h5></div>
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
                        <th class="text-center">Área do professor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professores as $professor)
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>{{$professor->Professor->codigo_usuario}}</strong>
                        </td>
                        <td>{{$professor->Professor->nome.' '.$professor->Professor->sobrenome}}</td>
                        <td>{{$professor->Professor->telefone}}</td>

                        <td class="text-center">
                            <a href="{{route('professores.area-professor', $professor->id)}}">
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

