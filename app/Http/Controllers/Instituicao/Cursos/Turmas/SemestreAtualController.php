<?php

namespace App\Http\Controllers\Instituicao\Cursos\Turmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Turmas;
use App\Models\Professores;
use App\Models\Disciplinas;
use App\Models\GradeCurricular;
use App\Models\Cursos;

use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class SemestreAtualController extends Controller
{
    public function gradeCurricular($turma_id) {
        $turma = Turmas::findOrFail($turma_id);
        $professores = Professores::get();
        $disciplinas = GradeCurricular::where('curso_id', $turma->curso_id)->get();
        $curso = Cursos::findOrFail($turma->curso_id);
        
        $numSemestre = $curso->quantidade_semestres;
        $numAno = $numSemestre/2;

        $anoInicio = substr($turma->data_inicio_turma, -4); // 2022
        $dataMesDia = substr($turma->data_inicio_turma, 0, 6); // 09-09-

        $inicioTurma = $dataMesDia.$anoInicio;// 09-09- . 2022

        $anoFinal = $anoInicio+$numAno; // 2022 + anos

        $finalTurma = $dataMesDia.$anoFinal;

        $StartDate = DateTime::createFromFormat('d-m-Y', $inicioTurma);
        $EndDate   = DateTime::createFromFormat('d-m-Y', $finalTurma);
        $semestres  = new DatePeriod($StartDate, new DateInterval('P6M'), $EndDate);
        
        dd($semestres);
        $p = 0;
        $r = [];
            
        foreach($semestres as $semestre) {
            if (!$p) {
                $q = [$semestre];
                $p++;
                
            } else {
                $q[] = $semestre;
                $p = 0;
                $r[] = $q;
            }
        }

        $t = json_encode($r[4][1]);

        dd($r);

        return view('app.instituicao.cursos.turmas.grade_curricular_turma.index', compact('turma', 'professores', 'disciplinas'));
    }
}
