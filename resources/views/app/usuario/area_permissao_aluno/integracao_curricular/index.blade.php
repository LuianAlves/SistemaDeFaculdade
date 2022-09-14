@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row px-4 pb-4">
        <div class="col-12">
            <h4 class="card-header p-0 my-4 mx-3">Integração curricular</h4>
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