<?php

namespace App\Http\Controllers\Instituicao\Faltas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LancamentoFaltasController extends Controller
{
    public function gerandoView($aluno_id) {
        $aluno = Alunos::findOrFail($aluno_id);

        return redirect()->route('lancar-faltas.index', $aluno->id);
    }
}
