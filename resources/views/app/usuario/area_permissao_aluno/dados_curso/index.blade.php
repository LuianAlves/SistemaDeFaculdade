@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row pb-4">
        <div class="col-5">
            <h5 class="card-header p-0 my-4 mx-3">Dados do curso</h5>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <tbody class="table-border-bottom-0">
                        {{-- <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular
                                    Project</strong></td>
                            <td>Albert Cook</td>

                            <td><span class="badge bg-label-primary me-1">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                        <tr>
                            <td class="d-flex justify-content-between">
                                <b class="justify-content-start">Curso matriculado:</b>
                                <span class="justify-content-end">{{!empty($curso->curso)}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Turma:</span>
                                <span class="text-muted">{{!empty($turma->codigo_turma)}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Semestre atual:</span>
                                <span class="text-muted">{{"$aluno->rg"}}</span>
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
                                <span class="text-muted">{{!empty(\Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y'))}}</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection