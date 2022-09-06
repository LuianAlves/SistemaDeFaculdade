@php
    $curso = App\Models\Cursos::where('id', $curso->id)->first();
    $semestres = $curso->quantidade_semestres;
@endphp

@extends('layouts.layout')

@section('content')

<section class="section">
    <div class="row">
        <!-- BUTTONS -->
            <div class="col-12">
                <div class="card pb-3">
                    <!-- Header Lista -->
                    <div class="d-flex align-items-center p-2">
                        <div class="d-flex align-items-center mt-3 ml-2">
                            <div class="span">
                                <h4><b>Grade Curricular para {{ ucwords($curso->curso) }}</b></h4>
                            </div>
                        </div>
                        <div class="justify-content-end align-items-center ms-auto">
                            <a href="{{route('cursos.index', $curso->id)}}"
                                class="btn btn-sm btn-primary fw-bold text-white">Voltar</a>
                        </div>
                    </div>
    
                    <div class="row justify-content-around mt-4">
                        <div class="col-8">
                            @for ($i = 1; $i <= $semestres; $i++) <a
                                href="{{ route('grade-curricular.create', ['semestre' => 'semestre_'.$i, 'curso_id' => $curso->id]) }}"
                                class="btn btn-sm m-2" id="button-disciplina">
                                {{$i}}° Semestre
                                </a>
                                @endfor
                        </div>
    
                    </div>
                </div>
            </div>
        <!-- Lista de Disciplina para cada Semestre -->
        @for($i = 1; $i <= $semestres; $i++) 
            <div class="col-12" style="margin-top: 10px; max-height: 500px; overflow-y: auto;">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <h5>{{$i}}° SEMESTRE</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-muted" width="10%">Código</th>
                                    <th class="text-left" width="35%">Disciplina</th>
                                    <th class="text-center" width="15%">Carga Horária</th>
                                    <th class="text-center" width="15%">Modalidade</th>
                                    <th class="text-center" width="15%">Excluir</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 16px; font-family: 'Poppins', sans-serif;">
                                @foreach($gradeCurricular as $grade)
                                @if($grade->semestre == 'semestre_'.$i)
                                <tr>
                                    <td class="text-muted fw-bold">#{{$grade->disciplina->codigo_disciplina}}</td>
                                    <td class="text-left">{{$grade->disciplina->disciplina}}</td>
                                    <td class="text-center fw-bold">{{$grade->disciplina->duracao_horas}} Horas</td>
                                    <td class="text-center">
                                        @if($grade->disciplina->modalidade == 'AVA')
                                        <span class="badge bg-label-info">{{$grade->disciplina->modalidade}}</span>
                                        @else
                                        <span class="badge bg-label-primary">{{$grade->disciplina->modalidade}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('grade-curricular.destroy', ['id' => $grade->id, 'curso_id' => $grade->curso_id, 'disciplina_id' => $grade->disciplina_id])}}">
                                            <i class="bx bx-trash text-danger me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endfor

    </div>
</section>


@endsection