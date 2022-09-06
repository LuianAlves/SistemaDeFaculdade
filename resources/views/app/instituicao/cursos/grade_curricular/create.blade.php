@extends('layouts.layout')

@section('content')

    <!-- Exercicios -->
    <section class="section">
        <div class="row">
            <div class="card">
                <div class="d-flex align-items-center p-3">
                    <div class="d-flex align-items-center mt-3 ml-2">
                        <div class="span">
                            <h5>
                                |
                                {{$curso->curso}}
                                |
                                <b>{{ strtoupper(str_replace('_', ' ', $semestre)) }} </b>
                            </h5>
                        </div>
                    </div>
                    <div class="justify-content-end align-items-center ms-auto">
                        <a href="{{route('grade-curricular.index', $curso->id)}}" class="btn btn-sm btn-primary fw-bold">
                            <b>Voltar</b>
                        </a>
                    </div>
                </div>

                <form action="{{ route('grade-curricular.store', ['semestre' => $semestre, 'curso_id' => $curso->id]) }}" method="post">
                    {{-- @csrf DESATIVADO EM MIDDLEWARE->VERIFYCSRFTOKEN --}}

                    <!-- Tabs com Categorias de Disciplinas -->
                    <div class="card-body">
                        <!-- Botões com Categorias de Treino -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            <!-- Todas as Categorias -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold active" id="todas-categorias-tab" data-bs-toggle="pill" data-bs-target="#todas-as-categorias" type="button" role="tab" aria-controls="todas-as-categorias" aria-selected="true">TODAS</button>
                            </li>

                            <!-- Foreach com Cada Disciplina -->
                            @foreach ($areaConhecimento as $area)
                                @php
                                    $limpar = $area->area_conhecimento;
                                    $comAcentos = ['à', 'á', 'â', 'ã', 'ç', 'è', 'é', 'ê', 'ì', 'í', 'î', 'ò', 'ó', 'ô', 'õ', 'ù', 'ú', 'À', 'Á', 'Â', 'Ã', 'Ç', 'È', 'É', 'Ê', 'Ì', 'Í', 'Î', 'Ò', 'Ó', 'Ô', 'Õ', 'Ù', 'Ú'];
                                    $semAcentos = ['a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U'];
                                    $area_c = str_replace($comAcentos, $semAcentos, $limpar);
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="{{ strtolower(str_replace(' ', '_', $area_c)) }}-tab" data-bs-toggle="pill" data-bs-target="#{{ strtolower(str_replace(' ', '_', $area_c)) }}" type="button" role="tab" aria-controls="{{ strtolower(str_replace(' ', '_', $area_c)) }}" aria-selected="false">{{ strtoupper($area_c) }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                
                    <div class="row">
                        <!-- Conteudo do Tab -->
                        <div class="col-6" style="max-height: 500px; overflow-y: auto;">
                            <div class="card-body">
                                <div class="tab-content pt-2" id="myTabContent">

                                    <!-- Todas as Disciplinas -->
                                    <div class="tab-pane fade show active vflipper" id="todas-as-categorias" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <table class="table table-sm">
                                            <h5 class="card-title text-muted">Disciplinas</h5>
                                            <tbody>
                                                @foreach ($disciplinas as $disciplina)
                                                    <tr class="vback" id="val">
                                                        <td class="text-muted p-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $disciplina->id }}"
                                                                    value="{{ $disciplina->disciplina }}"
                                                                    id="todas_{{ $disciplina->id }}">
                                                                <label class="form-check-label" for="todas_{{ $disciplina->id }}">
                                                                    {{ $disciplina->disciplina }}
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                    <!-- Disciplina por Area de Conhecimento -->
                                    @foreach ($areaConhecimento as $area)
                                        @php
                                            $limpar = $area->area_conhecimento;
                                            $comAcentos = ['à', 'á', 'â', 'ã', 'ç', 'è', 'é', 'ê', 'ì', 'í', 'î', 'ò', 'ó', 'ô', 'õ', 'ù', 'ú', 'À', 'Á', 'Â', 'Ã', 'Ç', 'È', 'É', 'Ê', 'Ì', 'Í', 'Î', 'Ò', 'Ó', 'Ô', 'Õ', 'Ù', 'Ú'];
                                            $semAcentos = ['a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U'];
                                            $area_c = str_replace($comAcentos, $semAcentos, $limpar);
                                        @endphp

                                        <div class="tab-pane fade" id="{{ strtolower(str_replace(' ', '_', $area_c)) }}"
                                            role="tabpanel" aria-labelledby="profile-tab">
                                            <table class="table table-sm">
                                                <h5 class="card-title text-muted">Disciplinas</h5>
                                                <tbody>
                                                    @php
                                                        $disciplinas = App\Models\Disciplinas::where('area_conhecimento_id', $area->id)->orderBy('disciplina', 'ASC')->get();
                                                    @endphp

                                                    @foreach ($disciplinas as $disciplina)
                                                    <tr class="vback">
                                                        <td class="text-muted p-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $disciplina->id }}"
                                                                    value="{{ $disciplina->disciplina }}"
                                                                    id="cat_{{ $disciplina->id }}">
                                                                <label class="form-check-label" for="cat_{{ $disciplina->id }}">
                                                                    {{ $disciplina->disciplina }}
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    @endforeach 
                                
                                </div>
                            </div>
                        </div>

                        <!-- Conteudos Selecionados do Tab -->
                        <div class="col-6" style="max-height: 500px; overflow-y: auto;">
                            <div class="card-body">
                                @error('exercicio_id')
                                    <span class="text-danger text-sm">{{$message}}</span>   
                                @enderror
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title text-muted">Selecionados</h5>
                                    </div>
                                    <div>
                                        <table class="vclick vfront">
                                            <tbody>
                                                <tr id="lbl" style="font-weight: bold; color: rgb(140, 226, 212); white-space: pre-line;">
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer com Button Submit -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Adicionar" class="btn btn-sm btn-success vclick">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
    </section>

@endsection

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
    $('.vclick').click(function() {
        $(this).closest('.vflipper').toggleClass('vflip');
    });


    //
    // Listen for change event 
    //
    $('.vback :checkbox').on('change', function(e) {
        //
        // get the labels list of all  checked elements
        //
        var result = $('.vback :checkbox:checked').map(function(index, element) {
            if (element.checked) {
                return element.parentNode.textContent;
            }

        }).get();

        //
        // add this text to the label
        //

        $('#lbl').text(result.join(""))
    })
});
</script>