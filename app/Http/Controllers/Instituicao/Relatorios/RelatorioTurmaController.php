<?php

namespace App\Http\Controllers\Instituicao\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notas\LancamentoNotas;
use App\Models\RelatorioTurmas;

use Carbon\Carbon;

class RelatorioTurmaController extends Controller
{
    public function gerarRelatorioTurma($turma_id) {
        $id = $turma_id;

        $count = LancamentoNotas::where('turma_id', $id)->count();
        $turma = LancamentoNotas::where('turma_id', $id)->get();

        // ---------------------- Notas ----------------------
        $somaNotas = [];
        $mediaNota = '';

        foreach($turma as $nota){
            $mediaNota = ($nota->nota_np1+$nota->nota_np2)/2;
            $somaNotas[] = $mediaNota;
        }
        
        $mediaN = array_sum($somaNotas)/$count;

        // ---------------------- Faltas ----------------------
        $somaFaltas = [];
        $mediaFalta = '';
        
        foreach($turma as $falta){
            $mediaFalta = $falta->qnt_faltas;
            $somaFaltas[] = $mediaFalta;
        }
        
        $mediaF = array_sum($somaFaltas)/$count;

        // ---------------------- Aulas ----------------------
        $somaAulas = [];
        $mediaAula = '';

        foreach($turma as $aula){
            $mediaAula = $aula->qnt_aulas;
            $somaAulas[] = $mediaAula;
        }

        $mediaA = array_sum($somaAulas)/$count;

        RelatorioTurmas::insert([
            'turma_id' => $id,
            'media_notas' => $mediaN,
            'media_faltas' => $mediaF,
            'media_aulas' => $mediaA,
            'created_at' => Carbon::now()
        ]);

        $noti = [
            'message' => 'Relatório gerado com sucesso!',
            'alert-type' => 'success'
        ];

        return redirect()->route('relatorio-alunos.view-relatorios', $id)->with($noti);
    }
}
