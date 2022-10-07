@extends('layouts.layout')

@section('content')

{{-- Breadcrumb --}}
@include('layouts.breadcrumb')


<div class="card">
    <div class="row p-2">
        <div class="col-12">
            <!-- Header Título -->
            <h3 class="title-padrao p-0 my-4 mx-4">Alunos matriculados
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
                            @if(!empty($relatorios))<th class="text-center">Relatórios</th>@endif
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
                                    <strong>{{$aluno->Estudante->codigo_usuario}}</strong>
                                </td>
                                <td>{{$aluno->Estudante->nome.' '.$aluno->Estudante->sobrenome}}</td>
                                <td>{{$aluno->Estudante->telefone}}</td>
        
                                <td class="text-center">
                                    <a href="{{route('alunos.area-aluno', $aluno->id)}}">
                                        <i class="bx bx-right-arrow-alt fs-3"></i>
                                    </a>
                                </td>
                                @if(!empty($relatorios))
                                    <td class="text-center">
                                        <a href="{{route('relatorio-alunos.gerar-relatorio-aluno', $aluno->id)}}">
                                            <i class="bx bx-plus-circle text-info fs-3 mx-3"></i>
                                        </a>
                                        <a href="{{route('relatorio-alunos.view-relatorios', $aluno->id)}}">
                                            <i class="bx bx-file text-danger fs-3"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="d-flex justify-content-center align-items-center">
                        {{$alunos->links('vendor.pagination.default')}}
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            Alunos matriculados: {{$alunos->total()}}
                        </span>
                        <a href="{{route('turmas.index')}}" class="btn-padrao">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

