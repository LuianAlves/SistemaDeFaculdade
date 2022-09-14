<?php

namespace App\Http\Controllers\Instituicao\Cursos\Turmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Turmas;
use App\Models\Professores;
use App\Models\Disciplinas;
use App\Models\GradeCurricular;
use App\Models\Cursos;
use App\Models\SemestreAtual;

use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class SemestreAtualController extends Controller
{
    public function gradeCurricular($turma_id) {
        $gradeSemestre = SemestreAtual::where('turma_id', $turma_id)->get();

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

        $semestre1 = substr(json_decode(json_encode($r[0][0]), true)['date'], 0, 10);
        $semestre2 = substr(json_decode(json_encode($r[0][1]), true)['date'], 0, 10);
        $semestre3 = substr(json_decode(json_encode($r[1][0]), true)['date'], 0, 10);
        $semestre4 = substr(json_decode(json_encode($r[1][1]), true)['date'], 0, 10);
        $semestre5 = substr(json_decode(json_encode($r[2][0]), true)['date'], 0, 10);
        $semestre6 = substr(json_decode(json_encode($r[2][1]), true)['date'], 0, 10);
        $semestre7 = substr(json_decode(json_encode($r[3][0]), true)['date'], 0, 10);
        $semestre8 = substr(json_decode(json_encode($r[3][1]), true)['date'], 0, 10);
        $semestre9 = substr(json_decode(json_encode($r[4][0]), true)['date'], 0, 10);
        $semestre10 = substr(json_decode(json_encode($r[4][1]), true)['date'], 0, 10);

        // Calculando qual semestre estou
        if($dataAtual >= $semestre1 && $dataAtual < $semestre2) {              // semestre 1
            $semestreAtual = $semestre1;
            $semestre = 'semestre_1';
        } elseif($dataAtual >= $semestre2 && $dataAtual < $semestre3) {        // semestre 2
            $semestreAtual = $semestre2;
            $semestre = 'semestre_2';
        } elseif($dataAtual >= $semestre3 && $dataAtual < $semestre4) {        // semestre 3
            $semestreAtual = $semestre3;
            $semestre = 'semestre_3';
        } elseif($dataAtual >= $semestre4 && $dataAtual < $semestre5) {        // semestre 4
            $semestreAtual = $semestre4;
            $semestre = 'semestre_4';
        } elseif($dataAtual >= $semestre5 && $dataAtual < $semestre6) {        // semestre 5
            $semestreAtual = $semestre5;
            $semestre = 'semestre_5';
        } elseif($dataAtual >= $semestre6 && $dataAtual < $semestre7) {        // semestre 6
            $semestreAtual = $semestre6;
            $semestre = 'semestre_6';
        } elseif($dataAtual >= $semestre7 && $dataAtual < $semestre8) {        // semestre 7
            $semestreAtual = $semestre7;
            $semestre = 'semestre_7';
        } elseif($dataAtual >= $semestre8 && $dataAtual < $semestre9) {        // semestre 8
            $semestreAtual = $semestre8;
            $semestre = 'semestre_8';
        } elseif($dataAtual >= $semestre9 && $dataAtual < $semestre10) {       // semestre 9
            $semestreAtual = $semestre9;
            $semestre = 'semestre_9';
        } elseif($dataAtual >= $semestre10) {                                  // semestre 10
            $semestreAtual = $semestre10;
            $semestre = 'semestre_10';
        }

        return view('app.instituicao.cursos.turmas.grade_curricular_turma.index', compact(
            'turma', 
            'professores', 
            'disciplinas', 
            'semestreAtual',
            'semestre',
            'gradeSemestre'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'professor_id' => 'required',
            'turma_id' => 'required',
            'disciplina_id' => 'required',
        ]);

        SemestreAtual::insert([
            'professor_id' => $request->professor_id,
            'turma_id' => $request->turma_id,
            'disciplina_id' => $request->disciplina_id,
            'semestre_lecionado' => $request->semestre_lecionado,
            'created_at' => Carbon::now()
        ]);

        $noti = [
            'message' => 'Adicionado professor à disciplina com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($noti);
    }
}
