@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row pb-4">
        <div class="col-5">
            <h5 class="card-header p-0 my-4 mx-3">Dados do curso</h5>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="d-flex justify-content-between">
                                <b class="justify-content-start">Curso matriculado:</b>
                                <span class="justify-content-end">{{$curso->curso}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Turma:</span>
                                <span class="text-muted">{{$turma->codigo_turma}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Semestre atual:</span>
                                <span class="text-muted">{{str_replace('_', ' ', ucfirst($semestreAtual->semestre_lecionado))}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Situação do aluno:</span>
                                @if($aluno->situacao == 1 && $aluno->serie_turma != '' && $aluno->curso_id != '')
                                    <span class="badge bg-label-info me-1">Matriculado</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Não matriculado</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Data de matrícula:</span>
                                <span class="text-muted">{{\Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y')}}</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection