<?php

namespace App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\Notas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Turmas;



use App\Models\Disciplinas;
use App\Models\GradeCurricular;

use App\Models\Notas\LancamentoNotas;

use Carbon\Carbon;

class LancamentoNotasController extends Controller
{
    public function gerandoView($aluno_id) {
        $aluno = Alunos::findOrFail($aluno_id);
        $curso = Cursos::where('id', $aluno->curso_id)->first();
        $turma = Turmas::where('id', $aluno->serie_turma)->first();

        $gradeCurricular = GradeCurricular::where('curso_id', $curso->id)->get();

        $lancamentoNotas = LancamentoNotas::where('aluno_id', $aluno->id)->first();

        foreach($gradeCurricular as $grade) {
            $disciplina_id = $grade->disciplina_id;
            
            $d = LancamentoNotas::updateOrCreate([
                'aluno_id' => $aluno->id,
                'turma_id' => $turma->id,
                'disciplina_id' => $disciplina_id
            ]);
        }

        return redirect()->route('lancar-notas.index', $aluno->id);
    }

    public function index($aluno_id) {
        $aluno = Alunos::findOrFail($aluno_id);
        $turma = Turmas::where('id', $aluno->serie_turma)->first();
        $disciplinas = GradeCurricular::where('curso_id', $turma->curso_id)->get();
        $notas = LancamentoNotas::where('aluno_id', $aluno->id)->where('turma_id', $turma->id)->get();
        
        return view('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.notas.index', compact('aluno', 'turma','disciplinas','notas'));
    }

    public function update(Request $request) {
        $disciplina_id = $request->disciplina_id;
        $turma_id = $request->turma_id;
        $aluno_id = $request->aluno_id;
        
        $lancamentoNota = LancamentoNotas::where('turma_id', $turma_id)->where('aluno_id', $aluno_id)->where('disciplina_id', $disciplina_id)->first();

        LancamentoNotas::findOrFail($lancamentoNota->id)->update([
            'nota_np1' => $request->nota_np1,
            'nota_np1_sub' => $request->nota_np1_sub,
            'nota_np2' => $request->nota_np2,
            'nota_np2_sub' => $request->nota_np2_sub,
            'nota_exame' => $request->nota_exame,
            'nota_ava' => $request->nota_ava,
            'nota_aps' => $request->nota_aps,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back();
    }    
}
