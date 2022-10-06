@php
$usuario = App\Models\Usuarios::where('user_id', Auth::id())->first();

if(empty($usuario->departamento_id)){

} elseif($usuario->departamento_id == 3) { // Aluno
    $aluno = App\Models\Alunos::where('usuario_id', $usuario->id)->first();
    $turma = App\Models\Turmas::where('id', $aluno->serie_turma)->first();
    $semestreAtual = App\Models\SemestreAtual::where('turma_id', $aluno->serie_turma)->first();
} elseif($usuario->departamento_id == 2) { // Professor
    $professor = App\Models\Professores::where('usuario_id', $usuario->id)->first();
} elseif($usuario->departamento_id == 1) { // Administração

}

@endphp


@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    @canany(['administracao', 'professor', 'aluno'])
                        <h5 class="card-title text-primary">{{'Bem vindo '. ucwords($usuario->nome) . ' ' . ucwords($usuario->sobrenome) }}! 🎉</h5>
                    @endcanany
                    
                    @can('professor')
                        <div class="card-title">
                            <span class="fw-semibold d-block mb-1">Admissão em: {{Carbon\Carbon::parse($professor->data_admissao)->format('d/m/Y')}}</span>
                        </div>
                    @endcan

                    @can('aluno')
                        <div class="card-title">
                            <span class="fw-semibold d-block mb-1">Matrícula em: {{Carbon\Carbon::parse($aluno->data_matricula)->format('d/m/Y')}}</span>
                        </div>
                        <h5 class="card-title mb-2">
                            {{"Turma $turma->codigo_turma"}}
                        </h5>
                        
                        @if(!empty($semestreAtual))
                            <h5 class="text-success fw-semibold">{{str_replace('_', ' ', ucfirst($semestreAtual->semestre_lecionado))}}</h5>
                        @else    
                            <div class="d-flex align-items-center">

                                <span class="text-muted fw-semibold">Semestre atual: </span>
                                <span class="text-light mx-3">Informação ainda indisponível.</span>
                            </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection