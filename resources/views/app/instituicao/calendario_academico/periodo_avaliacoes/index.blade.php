@extends('layouts.layout01')

@section('content')

<div class="row">
    <div class="card">
        <!-- Header Lista -->
        <div class="card-header">
            <h5>Período de Avaliações</h5>
        </div>

        <div class="card-body">
            <form class="mb-2" action="{{route('periodo-escolar.store')}}" method="post">
                @csrf

                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-estate">Ano Escolar</label>
                        <select class="form-select" name="ano_periodo_escolar">

                            @foreach ($periodoEscolar as $ano)
                                <option id="{{$ano['ano_periodo_escolar']}}" value="{{$ano['ano_periodo_escolar']}}">{{$ano['ano_periodo_escolar']}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            <strong id="ano_periodo_escolar-error"></strong>
                        </span>
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-estate">Curso</label>
                        <select class="form-select" name="curso_id">

                            @foreach ($cursos as $curso)
                                <option id="{{$curso->id}}" value="{{$curso->id}}">{{$curso->curso}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            <strong id="curso_id-error"></strong>
                        </span>
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-estate">Disciplina</label>
                        <select class="form-select" name="disciplina_id">
                            <option selected disabled>Selecionar Disciplina</option>
                        </select>
                        <span class="text-danger">
                            <strong id="disciplina_id-error"></strong>
                        </span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-fullname">Ínicio Período Escolar</label>
                        <div class="input-group input-group-merge">
                            <input type="date" class="form-control" name="inicio_periodo_escolar"
                                id="inicio_periodo_escolar">
                        </div>
                        <span class="text-danger">
                            <strong id="inicio_periodo_escolar-error"></strong>
                        </span>
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-fullname">Término Período Escolar</label>
                        <div class="input-group input-group-merge">
                            <input type="date" class="form-control" name="termino_periodo_escolar"
                                id="termino_periodo_escolar">
                        </div>
                        <span class="text-danger">
                            <strong id="termino_periodo_escolar-error"></strong>
                        </span>
                    </div>
                    <div class="col-1">
                        <label class="form-label" for="basic-icon-default-estate"></label>
                        <button type="submit" class="btn btn-primary" style="margin-top: 7px;">
                            +
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

{{-- <div class="row mt-2">
    <div class="card">
        <div class="card-body">

            <div class="card-body">
                <p class="demo-inline-spacing">
                    <div class="row">
                        <div class="col-6 offset-2">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#calouros" aria-expanded="false" aria-controls="calouros">
                                Calouros
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#veteranos" aria-expanded="false" aria-controls="veteranos">
                                Veteranos
                            </button>
                        </div>
                    </div>
                </p>

                <div class="row">
                    <div class="col-6">
                        <div class="collapse" id="calouros">
                            <div class="d-grid d-sm-flex">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Ínicio</th>
                                            <th class="text-center">Término</th>
                                            <th class="text-center">Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calouros as $calouros)
                                            <tr class="text-center">
                                                <td>{{Carbon\Carbon::parse($calouros->inicio_periodo_escolar)->format('d m Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($calouros->termino_periodo_escolar)->format('d m Y')}}</td>
                                                <td>{{$calouros->ano_periodo_escolar}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="collapse" id="veteranos">
                            <div class="d-grid d-sm-flex">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Ínicio</th>
                                            <th class="text-center">Término</th>
                                            <th class="text-center">Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($veteranos as $veteranos)
                                            <tr class="text-center">
                                                <td>{{Carbon\Carbon::parse($veteranos->inicio_periodo_escolar)->format('d m Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($veteranos->termino_periodo_escolar)->format('d m Y')}}</td>
                                                <td>{{$veteranos->ano_periodo_escolar}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!-- Include Modal Adicionar Campus -->
{{-- @include('app.instituicao.campus.create') --}}

<!-- Include Modal Editar Campus -->
{{-- @include('app.instituicao.campus.edit') --}}

<!-- Include Scripts -->
{{-- @include('app.instituicao.campus.campus_scripts') --}}

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>


{{-- Select Disciplinas --}}
<script>
    $(document).ready(function() {
        $('select[name="curso_id"]').on('change', function() {
            var curso_id = $(this).val()

            if (curso_id) {
                $.ajax({
                    url: "{{ url('/calendario-academico/periodo-avaliacoes/ajax') }}/" + curso_id,
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