
@extends('layouts.layout01')

@section('content')

<div class="row">
    <div class="card">
        <!-- Header Lista -->
        <div class="card-header">
            <h5>{{$avaliacao->tipo_prova == 2 ? 'NP2' : ''}}</h5>
        </div>

        <div class="card-body">
            <form class="mb-2" action="{{route('avaliacoes-cursos.store')}}" method="post">
                @csrf

                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="curso_id">Curso</label>
                        <select class="form-select" name="curso_id" id="curso_id">
                            <option selected disabled>Selecionar Curso</option>
                            @foreach ($cursos as $curso)
                                <option id="curso_{{$curso->id}}" value="{{$curso->id}}">{{$curso->curso}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            <strong id="curso_id-error"></strong>
                        </span>
                    </div>
                    <div class="col-3">
                        <label class="form-label" for="ano_letivo">Disciplina</label>
                        <label class="form-label" for="basic-icon-default-estate">Disciplina</label>
                        <select class="form-select" name="disciplina_id">
                            <option selected disabled>Selecionar Disciplina</option>
                        </select>
                        <span class="text-danger">
                            <strong id="disciplina_id-error"></strong>
                        </span>
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-fullname">Data Prova</label>
                        <div class="input-group input-group-merge">
                            <input type="date" class="form-control" name="inicio_periodo_avaliacoes" id="inicio_periodo_escolar">
                        </div>
                        <span class="text-danger">
                            <strong id="inicio_periodo_avaliacoes-error"></strong>
                        </span>
                    </div>
                    <div class="col-1">
                        <label class="form-label" for="basic-icon-default-estate"></label>
                        <button type="submit" class="btn btn-primary">
                            +
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
                    {{-- @foreach ($avaliacoes as $avaliacao)
                        <tr class="fw-bold">
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->inicio_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">{{Carbon\Carbon::parse($avaliacao->termino_periodo_avaliacoes)->format('d m Y')}}</td>
                            <td class="text-center">{{$avaliacao->campus->nome_campus}}</td>
                            <td class="text-center">
                                @if($avaliacao->tipo_prova == 1)
                                    <span class="badge bg-label-primary">NP1</span>
                                @elseif($avaliacao->tipo_prova == 2)
                                    <span class="badge bg-label-info">NP2</span>
                                @elseif($avaliacao->tipo_prova == 3)
                                    <span class="badge bg-label-danger">Substutiva</span>
                                @elseif($avaliacao->tipo_prova == 4)
                                    <span class="badge bg-label-warning">Exame</span>
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

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

{{-- Select Disciplinas --}}
<script>
    $(document).ready(function() {
        $('select[name="curso_id"]').on('change', function() {
            var curso_id = $(this).val()
            if (curso_id) {
                $.ajax({
                    url: "{{ url('/calendario-academico/periodo-avaliacoes/avaliacoes-cursos/ajax') }}/" + curso_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        
                        var d = $('select[name="disciplina_id"]').empty()
                        $.each(data, function(key, value) {
                            // console.log(value.disciplina.disciplina)
                            $('select[name="disciplina_id"]').append('<option value="' + value.id + '">' + value.disciplina.disciplina + '</option>')
                        })
                    },
                })
            } else {
                alert('Error!')
            }
        })
    })
</script>