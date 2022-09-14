<?php

namespace App\Http\Controllers\Instituicao\CorpoDocente\Permissoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Professores;
use App\Models\SemestreAtual;

class AreaPermissaoProfessorController extends Controller
{
    public function meuCadastro($usuario_id) {
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $professor = Professores::where('usuario_id', $usuario->id)->first();

        return view('app.usuario.area_permissao_professor.meu_cadastro.index', compact('usuario', 'professor'));
    }

    public function disciplinasLecionadas($usuario_id){
        $usuario = Usuarios::where('id', $usuario_id)->first();
        $professor = Professores::where('usuario_id', $usuario->id)->first();
        $semestreAtual = SemestreAtual::where('professor_id', $professor->id)->get();

        return view('app.usuario.area_permissao_professor.disciplinas_lecionadas.index', compact('usuario', 'professor', 'semestreAtual'));
    }
}
