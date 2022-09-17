@extends('layouts.layout')

@section('content')
<div class="card">

    <div class="row p-3">
        <div class="d-flex justify-content-between align-items-center">

                <h4 class="card-title">Relatórios do aluno</h4>
                <a type="button" class="btn btn-sm btn-primary fw-bold" href="{{ route('alunos.area-aluno', $aluno->id) }}">
                    <b>Área do aluno</b>
                </a>        
            
        </div>
    </div>

    <!-- Tabela de Alunos -->
    <div class="card-body">
        <div class="text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>Média de nota</th>
                        <th>Média de presença</th>
                        <th>Gerado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatorios as $relatorio)
                    @php
                        $mediaPresenca = '';
                        $faltas = $relatorio->media_faltas;
                        $aulas = $relatorio->media_aulas;

                        if(!empty($faltas) && !empty($aulas)){
                            $porFalta = ($faltas/$aulas) * 100;
                            $media = 100 - $porFalta;
                            $mediaPresenca = str_replace('.', ',', round($media, 2)).'%';
                        } else {
                            $mediaPresenca = 'NC';
                        }

                    @endphp
                    <tr class="text-center">
                        <td>{{str_replace('.', ',', round($relatorio->media_notas, 2))}}</td>
                        <td>{{$mediaPresenca}}</td>
                        <td>{{\Carbon\Carbon::parse($relatorio->created_at)->format('d/m/Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

