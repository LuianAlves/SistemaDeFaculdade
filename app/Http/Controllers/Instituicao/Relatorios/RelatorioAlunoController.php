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

        $id = $request->aluno_id;

        $mediaNota = '';
        $mediaPresenca = '';

        $np1 = LancamentoNotas::where('aluno_id', $id)->sum('nota_np1');
        $np2 = LancamentoNotas::where('aluno_id', $id)->sum('nota_np2');
        $exame = LancamentoNotas::where('aluno_id', $id)->sum('nota_exame');
        
        if(empty($exame)) {
            $mediaNota = ($np1+$np2)/2;
        } elseif($mediaNota <= 6.75 && $exame != '') {
            $mediaNota = ($np1+$np2+$exame)/3;
        }

        $faltas = LancamentoNotas::where('aluno_id', $id)->sum('qnt_faltas');
        $aulas = LancamentoNotas::where('aluno_id', $id)->sum('qnt_aulas');

        if(!empty($faltas) && !empty($aulas)) {
            $porFalta = ($faltas/$aulas) * 100;
            $mediaPresenca = 100 - $porFalta;
        }

        RelatorioAlunos::insert([
            'aluno_id' => $id,
            'media_nota' => $mediaNota,
            'media_presenca' => $mediaPresenca,
            'created_at' => Carbon::now()
        ]);

        $noti = [
            'message' => 'Relatório gerado com sucesso!',
            'alert-type' => 'success'
        ];

        return redirect()->route('relatorio-alunos.view-relatorios', $id)->with($noti);
    }

    public function viewRelatorio($aluno_id) {
        $aluno = Alunos::where('id', $aluno_id)->first();
        $relatorios = RelatorioAlunos::where('aluno_id', $aluno_id)->orderBy('id', 'DESC')->get();

        return view('app.instituicao.relatorios.relatorio_alunos.view_relatorios', compact('aluno', 'relatorios'));
    }
}
