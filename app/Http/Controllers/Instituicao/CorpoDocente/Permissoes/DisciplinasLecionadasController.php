<?php

namespace App\Http\Controllers\Instituicao\CorpoDocente\Permissoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisciplinasLecionadasController extends Controller
{
    public function index() {
        $usuario = Usuarios::where('user_id', Auth::id())->first();
        $professor = Professores::where('usuario_id', $usuario->id)->first();

        $disciplinasLecionadas = SemestreAtual::where('professor_id', $professor->id)->get();

        return view('app.usuario.area_permissao_professor.disciplinas_lecionadas.index');
    }
}
