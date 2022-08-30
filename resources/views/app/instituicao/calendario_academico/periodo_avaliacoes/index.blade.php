
@extends('layouts.layout01')

@section('content')

<div class="row">
    <div class="card">
        <!-- Header Lista -->
        <div class="card-header">
            <h5>Período de Avaliações</h5>
        </div>

        <div class="card-body">
            <form class="mb-2" action="{{route('periodo-avaliacoes.store')}}" method="post">
                @csrf

                <div class="row mb-3">
                    <div class="col-5">
                        <label class="form-label" for="basic-icon-default-fullname">Ínicio Período Avaliações</label>
                        <div class="input-group input-group-merge">
                            <input type="date" class="form-control" name="inicio_periodo_avaliacoes" id="inicio_periodo_escolar">
                        </div>
                        <span class="text-danger">
                            <strong id="inicio_periodo_avaliacoes-error"></strong>
                        </span>
                    </div>
                    <div class="col-5">
                        <label class="form-label" for="basic-icon-default-fullname">Término Período Avaliações</label>
                        <div class="input-group input-group-merge">
                            <input type="date" class="form-control" name="termino_periodo_avaliacoes" id="termino_periodo_escolar">
                        </div>
                        <span class="text-danger">
                            <strong id="termino_periodo_avaliacoes-error"></strong>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <label class="form-label" for="curso_id">Campus</label>
                        <select class="form-select" name="campus_id" id="campus_id">
                            @foreach ($campus as $campus)
                                <option id="campus_{{$campus->id}}" value="{{$campus->id}}">{{$campus->nome_campus}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            <strong id="campus_id-error"></strong>
                        </span>
                    </div>
                    <div class="col-5">
                        <label class="form-label" for="ano_letivo">Tipo de Prova</label>
                        <select class="form-select" name="tipo_prova" id="tipo_prova">
                            <option id="np1" value="1">NP1</option>   
                            <option id="np1_sub" value="2">NP1 - Substutiva</option>   
                            <option id="np2" value="3">NP2</option>   
                            <option id="np2_sub" value="4">NP2 - Substutiva</option>      
                            <option id="exame" value="5">Exame</option>   
                        </select>
                        <span class="text-danger">
                            <strong id="tipo_prova-error"></strong>
                        </span>
                    </div>
                    <div class="col-2">
                        <label class="form-label" for="basic-icon-default-estate"></label>
                        <button type="submit" class="btn btn-primary">
                            Adicionar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th class="text-center" colspan="2">Período Avaliações</th>
                        <th class="text-center">Campus</th>
                        <th class="text-center">Prova</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($avaliacoes as $avaliacao)
                        <tr class="fw-bold">
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->inicio_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->termino_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">{{$avaliacao->campus->nome_campus}}</td>
                            <td class="text-center">
                                @if($avaliacao->tipo_prova == 1)
                                    <span class="badge bg-label-primary">NP1</span>
                                @elseif($avaliacao->tipo_prova == 2)
                                    <span class="badge bg-label-info">NP1 - Substutiva</span>
                                @elseif($avaliacao->tipo_prova == 3)
                                    <span class="badge bg-label-danger">NP2</span>
                                @elseif($avaliacao->tipo_prova == 4)
                                    <span class="badge bg-label-warning">NP2 - Substutiva</span>
                                @else
                                    <span class="badge bg-label-dark">Exame</span>
                                @endif
                            </td>

                            <td class="text-center col-2">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Adicionar Curso -->
                                        <a href="{{route('avaliacoes-cursos.index', $avaliacao->id)}}" class="dropdown-item text-muted">
                                            <i class="bx bx-border-right me-1"></i>
                                            Curso/Semestre
                                        </a>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        {{-- <!-- Visualizar -->
                                        <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visualizarDadosDisciplinas"
                                            id="{{$campus->id}}" onclick="visualizarDisciplina(this.id)">
                                            <i class="bx bx-show-alt me-1"></i>
                                            Visualizar Disciplina
                                        </a>

                                        <!-- Editar -->
                                        <button type="button" class="dropdown-item editbtn" value="{{$campus->id}}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Editar Disciplina
                                        </button>
--}}
                                        <!-- Excluir -->
                                        <form id="{{'remove_'.$avaliacao->id}}"
                                            action="{{route('periodo-avaliacoes.destroy', $avaliacao->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a type="button" id="{{'remove_'.$avaliacao->id}}" class="dropdown-item"
                                                onclick="document.getElementById('remove_{{$avaliacao->id}}').submit()">
                                                <i class="bx bx-trash me-1"></i>
                                                Apagar período
                                            </a>
                                        </form> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection