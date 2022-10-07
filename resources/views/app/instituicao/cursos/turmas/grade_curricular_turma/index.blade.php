@extends('layouts.layout')

@section('content')

{{-- Breadcrumb --}}
@include('layouts.breadcrumb')


<div class="card">
    <div class="row p-2">
        <div class="col-12">
            <!-- Header Título -->
            <h3 class="title-padrao p-0 my-4 mx-4">{{ "# $turma->codigo_turma - " }}{{$turma->Curso->curso}}</h3>

            <div class="card-body">
                <form action="{{route('semestre-atual.store')}}" method="post">
                    @csrf

                    <input type="hidden" name="semestre_lecionado" value="{{$semestre}}">
                    <input type="hidden" name="turma_id" value="{{$turma->id}}">

                    <div class="row">
                        <div class="col-5">
                            <label class="form-label" for="serie_turma">Professores</label>
                            <select class="form-select form-select-sm" id="professor_id" name="professor_id">
                                <option selected disabled>Selecione o professor</option>
                                @foreach ($professores as $professor)
                                <option id="{{$professor->id}}" value="{{$professor->id}}">{{$professor->Professor->nome
                                    .' '. $professor->Professor->sobrenome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="disciplina_id">Disciplinas</label>
                            <select class="form-select form-select-sm" id="disciplina_id" name="disciplina_id">
                                <option selected disabled>Selecione a disciplina</option>
                                @foreach ($disciplinas as $disciplina)
                                @if($disciplina->semestre == $semestre)
                                <option id="{{$disciplina->Disciplina->id}}" value="{{$disciplina->Disciplina->id}}">
                                    {{$disciplina->Disciplina->disciplina}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-end">
                            <button type="submit" class="btn-padrao">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card my-3">
    <div class="row p-2">
        <div class="col-12">
            <!-- Header Título -->
            <h3 class="title-padrao p-0 my-4 mx-4">Professores matriculados</h3>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="text-left">
                            <th><b>Professor</b></th>
                            <th>Disciplina</th>
                            <th>Relatório da disciplina</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gradeSemestre as $grade)
                        @php
                        $professor = App\Models\Professores::where('id', $grade->professor_id)->first();
                        $usuario = App\Models\Usuarios::where('id', $professor->usuario_id)->first();
                        @endphp

                        <tr class="text-left">
                            <td>{{"$usuario->nome $usuario->sobrenome"}}</td>
                            <td>{{$grade->Disciplina->disciplina}}</td>
                            <td class="text-center">
                                <a
                                    href="{{route('relatorio-disciplinas.gerar-relatorio-disciplina', $grade->disciplina_id)}}">
                                    <i class="bx bx-plus-circle text-info fs-3 mx-3"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-5">
                    <div class="d-flex justify-content-center align-items-center">
                        {{$gradeSemestre->links('vendor.pagination.default')}}
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            Professores matriculados na turma: {{$gradeSemestre->total()}}
                        </span>
                        <a href="{{route('turmas.index')}}" class="btn-outline-padrao">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection