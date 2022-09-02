@extends('layouts.layout01')

@section('content')
@foreach ($disciplinas as $grade)
@foreach ($notas as $nota)
@if ($grade->disciplina->id == $nota->disciplina_id)
@php
$dataAvaliacao = App\Models\CalendarioAcademico\AvaliacoesCursos::where('curso_id',
$grade->curso_id)->where('disciplina_id', $grade->disciplina_id)->first();

$np1 = $nota->nota_np1;
$np2 = $nota->nota_np2;
if($np1 != '' && $np2) {
$media = ($np1 + $np2) / 2;
}
@endphp

@if(!empty($dataAvaliacao))
<div class="card my-2">
    <!-- Header Lista -->
    <div class="card-header">
        <h5 class="d-flex justify-content-start">{{$grade->disciplina->disciplina}}</h5>
        @if($np1 != '' && $np2 != '')
        <h6 class="d-flex justify-content-end align-items-center">
            <span class="px-3">Média do aluno: {{str_replace('.',',', $media)}}</span>
            @if($media >= 6.75)
            <span class="badge bg-label-success fw-bold">Aprovado</span>
            @else
            <span class="badge bg-label-danger fw-bold">Reprovado</span>
            @endif
        </h6>
        @endif
    </div>

    <div class="card-body">
        <form class="mb-2" action="{{ route('notas.update') }}" method="post">
            @csrf

            <input type="hidden" id="aluno_id" name="aluno_id" value="{{ $aluno->id }}">
            <input type="hidden" id="turma_id" name="turma_id" value="{{ $turma->id }}">
            <input type="hidden" id="disciplina_id" name="disciplina_id" value="{{ $grade->disciplina->id }}">

            <div class="row mt-3">
                <div class="col-2">
                    <label class="form-label" for="nota_np1">Nota NP1</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_np1" id="nota_np1" placeholder="NP1"
                            value="{{ str_replace('.',',',$nota->nota_np1) }}">
                    </div>
                </div>

                <div class="col-2">
                    <label class="form-label" for="nota_np2">Nota NP2</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_np2" id="nota_np2" placeholder="NP2"
                            value="{{ str_replace('.',',',$nota->nota_np2) }}">
                    </div>
                </div>

                <div class="col-2">
                    <label class="form-label" for="nota_ava">Nota AVA</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_ava" id="nota_ava" placeholder="AVA"
                            value="{{ str_replace('.',',',$nota->nota_ava) }}">
                    </div>
                </div>
                <div class="col-2">
                    <label class="form-label" for="nota_aps">Nota APS</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_aps" id="nota_aps" placeholder="APS" value="{{
                            str_replace('.',',',$nota->nota_aps) }}">
                    </div>
                </div>
                <div class="col-2">
                    @if ($np1 != '' && $np2 != '' && $media < 6.75) <label class="form-label text-danger fw-bold"
                        for="nota_exame">Nota Exame</label>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="nota_exame" id="nota_exame" placeholder="Exame"
                                value="{{ str_replace('.',',',$nota->nota_exame) }}">
                        </div>
                        @endif
                </div>
                <div class="col-2 d-flex justify-content-end align-items-end">
                    <label class="form-label" for="basic-icon-default-estate"></label>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-2">
                    @if($np1 == '')
                    <label class="form-label" for="nota_np1_sub">Nota NP1 SUB</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_np1_sub" id="nota_np1_sub" placeholder="NP1 Sub" value="{{
                            str_replace('.',',',$nota->nota_np1_sub) }}">
                    </div>
                    @endif
                </div>
                <div class="col-2">
                    @if($np2 == '')
                    <label class="form-label" for="nota_np2_sub">Nota NP2 SUB</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" name="nota_np2_sub" id="nota_np2_sub" placeholder="NP2 Sub" value="{{
                            str_replace('.',',',$nota->nota_np2_sub) }}">
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endif
@endforeach
@endforeach
@endsection

@include('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.avaliacoes_cursos_scripts')