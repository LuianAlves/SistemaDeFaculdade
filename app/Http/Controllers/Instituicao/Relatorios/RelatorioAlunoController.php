<?php

namespace App\Http\Controllers\Instituicao\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Alunos;
use App\Models\Notas\LancamentoNotas;
use App\Models\RelatorioAlunos;

use Carbon\Carbon;

class RelatorioAlunoController extends Controller
{
    public function index() {
        $alunos = Alunos::get();

        return view('app.instituicao.relatorios.relatorio_alunos.index', compact('alunos'));
    } 

    public function gerarRelatorioAluno(Request $request, $aluno_id) {

        $id = $aluno_id;

        $count = LancamentoNotas::where('aluno_id', $id)->count();
        $aluno = LancamentoNotas::where('aluno_id', $id)->get();

        // ---------------------- Notas ----------------------
        $somaNotas = [];
        $mediaNota = '';

        foreach($aluno as $nota){
            $mediaNota = ($nota->nota_np1+$nota->nota_np2)/2;
            $somaNotas[] = $mediaNota;
        }

        if(!empty($somaNotas)) {
        $mediaN = array_sum($somaNotas)/$count;
        }

        // ---------------------- Faltas ----------------------
        $somaFaltas = [];
        $mediaFalta = '';

        foreach($aluno as $falta){
            $mediaFalta = $falta->qnt_faltas;
            $somaFaltas[] = $mediaFalta;
        }

        if(!empty($somaFaltas)){
            $mediaF = array_sum($somaFaltas)/$count;
        }

        // ---------------------- Aulas ----------------------
        $somaAulas = [];
        $mediaAula = '';

        foreach($aluno as $aula){
            $mediaAula = $aula->qnt_aulas;
            $somaAulas[] = $mediaAula;
        }

        if(!empty($somaAulas)){
            $mediaA = array_sum($somaAulas)/$count;
        }

        if(!empty($somaNotas) && !empty($somaFaltas) && !empty($somaAulas)) {
            RelatorioAlunos::insert([
                'aluno_id' => $id,
                'media_notas' => $mediaN,
                'media_faltas' => $mediaF,
                'media_aulas' => $mediaA,
                'created_at' => Carbon::now()
            ]);

            $noti = [
                'message' => 'Relatório do aluno gerado com sucesso!',
                'alert-type' => 'success'
            ];
        } else {
            $noti = [
                'message' => 'Houve um erro ao gerar o relatório!',
                'alert-type' => 'error'
            ];
        }

        return redirect()->route('relatorio-alunos.view-relatorios', $id)->with($noti);
    }

    public function viewRelatorio($aluno_id) {
        $aluno = Alunos::where('id', $aluno_id)->first();
        $relatorios = RelatorioAlunos::where('aluno_id', $aluno_id)->orderBy('id', 'DESC')->get();

        return view('app.instituicao.relatorios.relatorio_alunos.view_relatorios', compact('aluno', 'relatorios'));
    }
}
