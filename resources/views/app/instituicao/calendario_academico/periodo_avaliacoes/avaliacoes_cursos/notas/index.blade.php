@extends('layouts.layout')

@section('content')
    @foreach ($disciplinas as $grade)
        @foreach ($notas as $nota)
            @if ($grade->disciplina->id == $nota->disciplina_id)
                @php
                    $dataAtual = Carbon\Carbon::now();

                    $dataAvaliacao = App\Models\CalendarioAcademico\AvaliacoesCursos::where('curso_id', $grade->curso_id)->where('disciplina_id', $grade->disciplina_id)->where('turma_id', $nota->turma_id)->where('data_da_prova', '<', $dataAtual)->first();

                    $np1 = $nota->nota_np1;
                    $np2 = $nota->nota_np2;
                    $exame = $nota->nota_exame;

                    $aulas = $nota->qnt_aulas;
                    $faltas = $nota->qnt_faltas;

                    $presenca = '';
                    $media = '';
                    $situacao = '';

                    if($exame == '') {
                        $media = ($np1+$np2)/2;
                    } elseif($media <= 6.75 && $exame != '') {
                        $media = ($np1+$np2+$exame)/3;
                    }

                    if($aulas != '') {
                        $porFalta = ($faltas/$aulas) * 100;
                        $presenca = 100 - $porFalta;
                    }

                    if($media >= 6.75 && $presenca >= 75) {
                        $situacao = 1; // Aprovado por nota e presença
                    } elseif($media <= 6.75 && $exame == '') {
                        $situacao = 2; // Reprovado por nota
                    } elseif($media >= 6.75 && $presenca <= 75) {
                        $situacao = 3; // Reprovado por presença
                    } elseif($media >= 5 && $exame != '') {
                        $situacao = 1; // Aprovado com nota do exame
                    }
                @endphp

                @if(!empty($dataAvaliacao))
                    <div class="card my-2">
                        <!-- Header Lista -->
                        <div class="card-header d-flex justify-content-between">
                            <h5>{{$grade->disciplina->disciplina}}</h5>
                            <h6>
                                <span class="badge bg-label-dark">
                                    MÉDIA: {{$media == '' ? 'NC' : str_replace('.',',', round($media, 2))}}
                                    <b class="mx-1">/</b>
                                    PRESENÇA: {{$presenca == '' ? 'NC' : round($presenca, 1) . '%'}}
                                    <b class="mx-1">/</b>
                                    SITUAÇÃO: {{$situacao == 1 ? 'APROVADO' : 'REPROVADO'}}
                                </span>
                            </h6>
                        </div>

                        <div class="card-body">
                            <form class="mb-2" action="{{ route('notas.update') }}" method="post">
                                @csrf

                                <input type="hidden" id="aluno_id" name="aluno_id" value="{{ $aluno->id }}">
                                <input type="hidden" id="turma_id" name="turma_id" value="{{ $turma->id }}">
                                <input type="hidden" id="disciplina_id" name="disciplina_id" value="{{ $grade->disciplina->id }}">

                                <div class="row">
                                    <!-- Notas -->
                                    <div class="col-7" style="border-top: 1px solid #f0f6fd;">
                                        <!-- NP1 -->
                                        <div class="row mt-3">
                                            <!-- NP1 -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_np1">Nota NP1</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_np1" id="nota_np1"
                                                        placeholder="NP1" value="{{ str_replace('.',',',$nota->nota_np1) }}">
                                                </div>
                                            </div>

                                            <!-- SUB NP1 -->
                                            <div class="col-4">
                                                @if($np1 == '')
                                                <label class="form-label" for="nota_np1_sub">Nota NP1 SUB</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_np1_sub"
                                                        id="nota_np1_sub" placeholder="NP1 Sub" value="{{
                                                str_replace('.',',',$nota->nota_np1_sub) }}">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- NP2 -->
                                        <div class="row mt-3">
                                            <!-- NP2 -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_np2">Nota NP2</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_np2" id="nota_np2"
                                                        placeholder="NP2" value="{{ str_replace('.',',',$nota->nota_np2) }}">
                                                </div>
                                            </div>

                                            <!-- SUB NP2 -->
                                            <div class="col-4">
                                                @if($np2 == '')
                                                <label class="form-label" for="nota_np2_sub">Nota NP2 SUB</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_np2_sub"
                                                        id="nota_np2_sub" placeholder="NP2 Sub" value="{{
                                                str_replace('.',',',$nota->nota_np2_sub) }}">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- AVA/APS/EXAME -->
                                        <div class="row mt-3">
                                            <!-- AVA -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_ava">Nota AVA</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_ava" id="nota_ava"
                                                        placeholder="AVA" value="{{ str_replace('.',',',$nota->nota_ava) }}">
                                                </div>
                                            </div>

                                            <!-- APS -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_aps">Nota APS</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" name="nota_aps" id="nota_aps"
                                                        placeholder="APS" value="{{
                                                str_replace('.',',',$nota->nota_aps) }}">
                                                </div>
                                            </div>

                                            <!-- EXAME -->
                                            <div class="col-4">
                                                @if ($np1 != '' && $np2 != '') <label
                                                    class="form-label text-danger fw-bold" for="nota_exame">Nota Exame</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="number" class="form-control" name="nota_exame" id="nota_exame" placeholder="Exame" step=".01" min="0" max="10" value="{{ $nota->nota_exame }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Faltas -->
                                    <div class="col-5" style="border-left: 1px solid #f0f6fd;; border-top: 1px solid #f0f6fd;">
                                        <!-- AULAS/FALTAS -->
                                        <div class="row mt-3">
                                            <!-- QUANTIDADE DE FALTAS -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_np1">Nº de Faltas</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="number" class="form-control" min="0" name="qnt_faltas" id="qnt_faltas" placeholder="Faltas" value="{{ $nota->qnt_faltas }}">
                                                </div>
                                            </div>

                                            <!-- QUANTIDADE DE AULAS -->
                                            <div class="col-4">
                                                <label class="form-label" for="nota_np1_sub">Nº de Aulas</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="number" class="form-control" min="0" name="qnt_aulas" id="qnt_aulas" placeholder="Aulas" value="{{ $nota->qnt_aulas }}">
                                                </div>
                                            </div>

                                            <!-- Botão Salvar -->
                                            <div class="col-4 d-flex justify-content-end align-items-end">
                                                <label class="form-label" for="basic-icon-default-estate"></label>
                                                <button type="submit" class="btn btn-primary">
                                                    +
                                                </button>
                                            </div>
                                        </div>
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