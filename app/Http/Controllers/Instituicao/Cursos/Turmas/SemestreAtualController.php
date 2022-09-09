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
        
        $dataAtual = date('Y-m-d');

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
        // $convertendoData = json_decode(json_encode($r[4][1]), true);
        // $data = substr($convertendoData['date'], 0, 10);
        $semestres = [
            'semestre_1' => substr(json_decode(json_encode($r[0][0]), true)['date'], 0, 10),
            'semestre_2' => substr(json_decode(json_encode($r[0][1]), true)['date'], 0, 10),
            'semestre_3' => substr(json_decode(json_encode($r[1][0]), true)['date'], 0, 10),
            'semestre_4' => substr(json_decode(json_encode($r[1][1]), true)['date'], 0, 10),
            'semestre_5' => substr(json_decode(json_encode($r[2][0]), true)['date'], 0, 10),
            'semestre_6' => substr(json_decode(json_encode($r[2][1]), true)['date'], 0, 10),
            'semestre_7' => substr(json_decode(json_encode($r[3][0]), true)['date'], 0, 10),
            'semestre_8' => substr(json_decode(json_encode($r[3][1]), true)['date'], 0, 10),
            'semestre_9' => substr(json_decode(json_encode($r[4][0]), true)['date'], 0, 10),
            'semestre_10' => substr(json_decode(json_encode($r[4][1]), true)['date'], 0, 10),
        ];

        return view('app.instituicao.cursos.turmas.grade_curricular_turma.index', compact('turma', 'professores', 'disciplinas', 'dataAtual', 'semestres'));
    }
}
