@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mt-3" id="card-main">
            <div class="card-header">
                <div class="row mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ "TURMA | $turma->codigo_turma | GRADE CURRICULAR" }}
                        </h4>
                        <a type="button" class="btn btn-sm btn-primary fw-bold" href="{{ route('turmas.index') }}">
                            <b>Listagem de turmas</b>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <h5 class="card-title">{{$turma->Curso->curso}}</h5>
                <form action="{{route('semestre-atual.store')}}" method="post">
                    @csrf

                    <input type="hidden" name="semestre_lecionado" value="{{$semestre}}">
                    <input type="hidden" name="turma_id" value="{{$turma->id}}">

                    <div class="row py-3">
                        <div class="col-5">
                            <label class="form-label" for="serie_turma">Professores</label>
                            <select class="form-select" id="professor_id" name="professor_id">
                                <option selected disabled>Selecione o professor</option>
                                @foreach ($professores as $professor)
                                <option id="{{$professor->id}}" value="{{$professor->id}}">{{$professor->Professor->nome
                                    .' '. $professor->Professor->sobrenome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="disciplina_id">Disciplinas</label>
                            <select class="form-select" id="disciplina_id" name="disciplina_id">
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
                            <button type="submit" class="btn btn-primary">
                                +
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <h4 class="card-header">Professores da turma</h4>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th><b>Professor</b></th>
                                <th>Disciplina</th>
                                <th>Relatórios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gradeSemestre as $grade)
                            @php
                                $professor = App\Models\Professores::where('id', $grade->professor_id)->first();
                                $usuario = App\Models\Usuarios::where('id', $professor->usuario_id)->first();
                            @endphp

                                <tr class="text-center">
                                    <td>{{"$usuario->nome $usuario->sobrenome"}}</td>
                                    <td>{{$grade->Disciplina->disciplina}}</td>
                                    <td class="text-center">
                                        <a href="{{route('relatorio-disciplinas.gerar-relatorio-disciplina', $grade->disciplina_id)}}">
                                            <i class="bx bx-plus-circle text-info fs-3 mx-3"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection