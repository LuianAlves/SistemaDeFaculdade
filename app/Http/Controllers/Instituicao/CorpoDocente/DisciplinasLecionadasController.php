<?php

namespace App\Http\Controllers\Instituicao\CorpoDocente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisciplinasLecionadasController extends Controller
{
    public function index() {
        return view('app.usuario.area_permissao_professor.disciplinas_lecionadas.index');
    }
}
