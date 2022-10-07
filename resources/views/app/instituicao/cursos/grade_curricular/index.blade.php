@php
    $curso = App\Models\Cursos::where('id', $curso->id)->first();
    $semestres = $curso->quantidade_semestres;
@endphp

@extends('layouts.layout')

@section('content')

{{-- Breadcrumb --}}
@include('layouts.breadcrumb')

<div class="card">
    <div class="row p-2">
        <div class="col-12">
            <!-- Header Título -->
            <h3 class="title-padrao p-0 my-4 mx-4">{{ $curso->curso }}</h3>

            <!-- BUTTONS -->
            <div class="row">
                <div class="col-10 offset-1">
                    @for ($i = 1; $i <= $semestres; $i++) 
                        <a href="{{ route('grade-curricular.create', ['semestre' => 'semestre_'.$i, 'curso_id' => $curso->id]) }}" class="btn btn-sm m-2" id="button-disciplina">
                            {{$i}}° Semestre
                        </a>
                    @endfor
                </div>
            </div>    
            <div class="row mx-2 pb-2">
                <div class="d-flex justify-content-end">
                    <a href="{{route('cursos.index')}}" class="btn-padrao">
                        Voltar
                    </a>
                </div>
            </div>   
        </div>
    </div>
</div>


@for($i = 1; $i <= $semestres; $i++) 
    <div class="card my-2">
        <div class="row">
            <div class="col-12" style="margin-top: 10px; max-height: 500px; overflow-y: auto;">
                <h3 class="title-padrao p-0 my-2 mx-4" style="font-size: 16px; font-weight: 600;">{{$i}}° SEMESTRE</h3>
                <div class="card-body">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th width="10%">Código</th>
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
                                <td class="fw-bold">#{{$grade->disciplina->codigo_disciplina}}</td>
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
                                    <a
                                        href="{{route('grade-curricular.destroy', ['id' => $grade->id, 'curso_id' => $grade->curso_id, 'disciplina_id' => $grade->disciplina_id])}}">
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
    </div>
@endfor

@endsection