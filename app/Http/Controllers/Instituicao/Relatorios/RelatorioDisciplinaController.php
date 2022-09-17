<?php

namespace App\Http\Controllers\Instituicao\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notas\LancamentoNotas;
use App\Models\RelatorioDisciplinas;

use Carbon\Carbon;

class RelatorioDisciplinaController extends Controller
{
    public function gerarRelatorioDisciplina($disciplina_id) {
        $id = $disciplina_id;

        $count = LancamentoNotas::where('disciplina_id', $id)->count();
        $disciplina = LancamentoNotas::where('disciplina_id', $id)->get();

        // ---------------------- Notas ----------------------
        $somaNotas = [];
        $mediaNota = '';

        foreach($disciplina as $nota){
            $mediaNota = ($nota->nota_np1+$nota->nota_np2)/2;
            $somaNotas[] = $mediaNota;
        }
        
        if(!empty($somaNotas)) {
           $mediaN = array_sum($somaNotas)/$count;
        }
        // ---------------------- Faltas ----------------------
        $somaFaltas = [];
        $mediaFalta = '';
        
        foreach($disciplina as $falta){
            $mediaFalta = $falta->qnt_faltas;
            $somaFaltas[] = $mediaFalta;
        }
        
        if(!empty($somaFaltas)){
            $mediaF = array_sum($somaFaltas)/$count;
        }

        // ---------------------- Aulas ----------------------
        $somaAulas = [];
        $mediaAula = '';

        foreach($disciplina as $aula){
            $mediaAula = $aula->qnt_aulas;
            $somaAulas[] = $mediaAula;
        }

        if(!empty($somaAulas)){
            $mediaA = array_sum($somaAulas)/$count;
        }

        if(!empty($somaNotas) && !empty($somaFaltas) && !empty($somaAulas)) {
            RelatorioDisciplinas::insert([
                'disciplina_id' => $id,
                'media_notas' => $mediaN,
                'media_faltas' => $mediaF,
                'media_aulas' => $mediaA,
                'created_at' => Carbon::now()
            ]);

            $noti = [
                'message' => 'Relatório da disciplina gerado com sucesso!',
                'alert-type' => 'success'
            ];
        } else {
            $noti = [
                'message' => 'Houve um erro ao gerar o relatório!',
                'alert-type' => 'error'
            ];
        }

        return redirect()->back()->with($noti);
    }
}
