@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row p-4">
        <div class="col-12">
            <h5 class="card-header p-0 my-4 mx-3">Notas e faltas</h5>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <thead class="table-border-bottom-0 text-center">
                        <tr>
                            <th>Disciplinas</th>
                            <th>Nota NP1</th>
                            <th>Nota NP1 Sub</th>
                            <th>Nota NP2</th>
                            <th>Nota NP2 Sub</th>
                            <th>Nota Exame</th>
                            <th>Faltas</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">
                        @foreach ($notasFaltas as $nf)
                            @foreach($semestreAtual as $dp)
                                @if($nf->disciplina_id === $dp->disciplina_id)
                                    <tr>
                                        <td>{{$dp->Disciplina->disciplina}}</td>
                                        <td>{{$nf->nota_np1 ? $nf->nota_np1 : 'NC'}}</td>
                                        <td>{{$nf->nota_np1_sub != '' ? $nf->nota_np1_sub : 'NC'}}</td>
                                        <td>{{$nf->nota_np2 ? $nf->nota_np2 : 'NC'}}</td>
                                        <td>{{$nf->nota_np2_sub ? $nf->nota_np2_sub : 'NC'}}</td>
                                        <td>{{$nf->nota_exame ? $nf->nota_exame : 'NC'}}</td>
                                        <td>{{$nf->qnt_faltas ? $nf->qnt_faltas : 'NC'}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    table, th, td {
        border: 1px solid #697a8d8c !important;
    }
</style>