@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row px-4 p-4">
        <div class="col-12">
            <h3 class="card-header p-0 my-4 mx-2" style="color: #14a881; border-bottom: 3px solid #14a881;">Integração curricular
            </h3>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <thead class="table-border-bottom-0 text-center">
                        <tr>
                            <th>Disciplina</th>
                            <th>Carga horária</th>
                            <th>Semestre</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">
                        @foreach($gradeCurricular as $grade)
                            <tr>
                                <td>{{$grade->Disciplina->disciplina}}</td>
                                <td>{{$grade->Disciplina->duracao_horas}}</td>
                                <td>{{str_replace('_', ' ', ucfirst($grade->semestre))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    table, th, td {
        border: 1px solid #697a8d8c !important;
    }
</style>