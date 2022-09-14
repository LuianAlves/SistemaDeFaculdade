<?php

namespace App\Http\Controllers\Instituicao\CorpoDiscente\Permissoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Turmas;
use App\Models\SemestreAtual;
use App\Models\Notas\LancamentoNotas;
use App\Models\GradeCurricular;

class AreaPermissaoAlunoController extends Controller
{
    public function meuCadastro($usuario_id) {
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $aluno = Alunos::where('usuario_id', $usuario->id)->first();

        return view('app.usuario.area_permissao_aluno.meu_cadastro.index', compact('usuario', 'aluno'));
    }

    public function dadosCurso($usuario_id) {
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $aluno = Alunos::where('usuario_id', $usuario->id)->first();
        $curso = Cursos::where('id', $aluno->curso_id)->first();
        $turma = Turmas::where('id', $aluno->serie_turma)->first();

        $semestreAtual = SemestreAtual::where('turma_id', $turma->id)->first();

        return view('app.usuario.area_permissao_aluno.dados_curso.index', compact('aluno', 'curso', 'turma', 'semestreAtual'));
    }

    public function notasFaltas($usuario_id) {
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $aluno = Alunos::where('usuario_id', $usuario->id)->first();
        $turma = Turmas::where('id', $aluno->serie_turma)->first();
        $semestreAtual = SemestreAtual::where('turma_id', $turma->id)->get();
        $notasFaltas = LancamentoNotas::where('aluno_id', $aluno->id)->get();

        return view('app.usuario.area_permissao_aluno.notas_faltas.index', compact('aluno', 'turma', 'semestreAtual', 'notasFaltas'));
    }

    public function integracaoCurricular($usuario_id) {
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $aluno = Alunos::where('usuario_id', $usuario->id)->first();

        $gradeCurricular = GradeCurricular::where('curso_id', $aluno->curso_id)->orderBy('semestre', 'ASC')->get();
        
        return view('app.usuario.area_permissao_aluno.integracao_curricular.index', compact('aluno', 'gradeCurricular'));
    }
}
