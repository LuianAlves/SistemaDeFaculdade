@extends('layouts.layout01')

@section('content')
    @foreach ($disciplinas as $grade)
        @foreach ($notas as $nota)
            @if ($grade->disciplina->id == $nota->disciplina_id)
                @php
                    $np1 = $nota->nota_np1;
                    $np2 = $nota->nota_np2;
                    $media = ($np1 + $np2) / 2;
                @endphp

                <div class="card my-2">
                    <!-- Header Lista -->
                    <div class="card-header">
                        <h5 class="d-flex justify-content-start">{{ $grade->disciplina->disciplina }}</h5>
                        <h6 class="d-flex justify-content-end">
                            Média do aluno: {{$media}}
                            @if($media >= 6.75)
                                <span class="badge bg-label-success fw-bold">Aprovado</span>
                            @else
                                <span class="badge bg-label-danger fw-bold">Reprovado</span>
                            @endif
                        </h6>
                    </div>

                    <div class="card-body">
                        <form class="mb-2" action="{{ route('notas.update') }}" method="post">
                            @csrf

                            <input type="hidden" id="aluno_id" name="aluno_id" value="{{ $aluno->id }}">
                            <input type="hidden" id="turma_id" name="turma_id" value="{{ $turma->id }}">
                            <input type="hidden" id="disciplina_id" name="disciplina_id"
                                value="{{ $grade->disciplina->id }}">

                            <div class="row mt-3">
                                <div class="col-2">
                                    <label class="form-label" for="nota_np1">NP1</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_np1" id="nota_np1"
                                            value="{{ $nota->nota_np1 }}">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label class="form-label" for="nota_np2">NP2</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_np2" id="nota_np2"
                                            value="{{ $nota->nota_np2 }}">
                                    </div>
                                </div>

                                <div class="col-2 offset-1">
                                    <label class="form-label" for="nota_ava">AVA</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_ava" id="nota_ava"
                                            value="{{ $nota->nota_ava }}">
                                    </div>
                                </div>

                                @if ($media < 6.75)
                                    <div class="col-2 offset-1">
                                        <label class="form-label text-danger fw-bold" for="nota_exame">Exame</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control" name="nota_exame" id="nota_exame"
                                                value="{{ $nota->nota_exame }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-1 d-flex justify-content-center align-items-end">
                                    <label class="form-label" for="basic-icon-default-estate"></label>
                                    <button type="submit" class="btn btn-primary">
                                        +
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <label class="form-label" for="nota_np1_sub">NP1 SUB</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_np1_sub" id="nota_np1_sub"
                                            value={{ $nota->nota_np1_sub }}>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="form-label" for="nota_np2_sub">NP2 SUB</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_np2_sub" id="nota_np2_sub"
                                            value={{ $nota->nota_np2_sub }}>
                                    </div>
                                </div>
                                <div class="col-2 offset-1">
                                    <label class="form-label" for="nota_aps">APS</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" name="nota_aps" id="nota_aps"
                                            value={{ $nota->nota_aps }}>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
@endsection

@include('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.avaliacoes_cursos_scripts')
