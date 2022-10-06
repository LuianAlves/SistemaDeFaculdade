@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <h3 class="card-header p-0 my-4 mx-2" style="color: #14a881; border-bottom: 3px solid #14a881;">Disciplinas
                    lecionadas
                </h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th><b>Turma</b></th>
                                <th>Disciplina</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semestreAtual as $dp)
                                <tr class="text-center">
                                    <td>{{ $dp->Turma->codigo_turma }}</td>
                                    <td>{{ $dp->Disciplina->disciplina }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
