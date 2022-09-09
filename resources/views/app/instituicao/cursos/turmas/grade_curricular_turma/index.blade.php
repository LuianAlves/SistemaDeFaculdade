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

            <br>
            <br>
            <br>
            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Disciplina</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disciplinas as $dp)
                        @php
                            switch ($dp->semestre) {
                                case 'semestre_1':
                                    $semestreAtual = $semestres['semestre_1'];
                                    break;

                                case 'semestre_2':
                                    $semestreAtual = $semestres['semestre_2'];
                                    break;

                                case 'semestre_3':
                                    $semestreAtual = $semestres['semestre_3'];
                                    break;

                                case 'semestre_4':
                                    $semestreAtual = $semestres['semestre_4'];
                                    break;

                                case 'semestre_5':
                                    $semestreAtual = $semestres['semestre_5'];
                                    break;

                                case 'semestre_6':
                                    $semestreAtual = $semestres['semestre_6'];
                                    break;

                                case 'semestre_7':
                                    $semestreAtual = $semestres['semestre_7'];
                                    break;

                                case 'semestre_8':
                                    $semestreAtual = $semestres['semestre_8'];
                                    break;

                                case 'semestre_9':
                                    $semestreAtual = $semestres['semestre_9'];
                                    break;

                                case 'semestre_10':
                                    $semestreAtual = $semestres['semestre_10'];
                                    break;
                            } 
                            
                            $data1 = substr($dataAtual, 0, 7);
                            $data2 = substr($semestreAtual, 0, 7);
                        @endphp
                    
                        <tr>
                            <td>{{$dp->Disciplina->disciplina}}</td>
                            <td>{{$semestreAtual}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection