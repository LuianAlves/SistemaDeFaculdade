@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <h4 class="card-header">Disciplinas lecionadas no semestre</h4>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th><b>Turma</b></th>
                                <th>Disciplina</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disciplinasLecionadas as $dp)
                                <tr class="text-center">
                                    <td>{{$dp->Turma->codigo_turma}}</td>
                                    <td>{{$dp->Disciplina->disciplina}}</td>
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