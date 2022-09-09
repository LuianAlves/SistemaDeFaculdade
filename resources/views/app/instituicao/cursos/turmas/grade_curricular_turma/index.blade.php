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
                <form action="" method="post">
                    <div class="row py-3">
                        <div class="col-5">
                            <label class="form-label" for="serie_turma">Professores</label>
                            <select class="form-select" id="professor_id" name="professor_id">
                                <option selected disabled>Selecione o professor</option>
                                @foreach ($professores as $professor)
                                    <option value="{{$professor->id}}" data-value="{{$professor->codigo_turma}}">{{$professor->Professor->nome .' '. $professor->Professor->sobrenome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="disciplina_id">Disciplinas</label>
                            <select class="form-select" id="disciplina_id" name="disciplina_id">
                                <option selected disabled>Selecione a disciplina</option>
                                @foreach ($disciplinas as $disciplina)
                                    <option value="{{$disciplina->id}}" data-value="{{$disciplina->disciplina}}">{{$disciplina->Disciplina->disciplina}}</option>
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
@endsection