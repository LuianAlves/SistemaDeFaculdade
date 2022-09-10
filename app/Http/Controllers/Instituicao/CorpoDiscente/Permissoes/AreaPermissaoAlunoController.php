<?php

namespace App\Http\Controllers\Instituicao\CorpoDiscente\Permissoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Turmas;

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

        return view('app.usuario.area_permissao_aluno.dados_curso.index', compact('aluno', 'curso', 'turma'));
    }
}
