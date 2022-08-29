<?php

namespace App\Http\Controllers\Instituicao\Cursos\Turmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cursos;
use App\Models\GradeCurricular;
use App\Models\Turmas;

use App\Models\Alunos;

use App\Models\CalendarioAcademico\PeriodoEscolar;

use Carbon\Carbon;
use DB;

class TurmasController extends Controller
{
    // Gerando turmas através na view cursos
    public function store($curso_id) {
        
        // ------ **** ----- data
        $data = Carbon::now();
        $anoAtual = $data->year;

        // ------ **** ----- Select Cursos
        $curso = Cursos::where('id', $curso_id)->first();

        // ------ **** ----- Gerando código da turma
        $codigoTurma = 'TR' . mt_rand(1000, 9999);

        // ------ **** ----- Select periodo escolar id
        $periodoEscolar = PeriodoEscolar::where('ano_periodo_escolar', $anoAtual)->where('estudantes', 1)->first();

        // ------ **** ----- Select grade curricular id
        $gradeCurricular = GradeCurricular::where('curso_id', $curso->id)->first(); 

        
        // ------ **** ----- Select turma
        $turma = Turmas::where('curso_id', $curso->id)->where('periodo_escolar_id', $periodoEscolar->id)->orderBy('id', 'DESC')->first();

        if($turma == null || $turma == '') {
            $novaTurma = Turmas::insert([
                'curso_id' => $curso->id,
                'grade_curricular_id' => $gradeCurricular->id,
                'periodo_escolar_id' => $periodoEscolar->id,
                'codigo_turma' => $codigoTurma,
                'created_at' => Carbon::now()
            ]);

            $noti = [
                'message' => 'Nova turma gerada com sucesso!',
                'alert-type' => 'success'
            ];
    
            return redirect()->back()->with($noti);
        } else {
            $countAlunos = Alunos::where('serie_turma', $turma->codigo_turma)->count();

            if($countAlunos <= 5) {
                $noti = [
                    'message' => 'Error! Limite atual de alunos não atingido.',
                    'alert-type' => 'error'
                ];
        
                return redirect()->back()->with($noti);
            } else {
                // ------ **** ----- inserindo nova turma
                $novaTurma = Turmas::insert([
                    'curso_id' => $curso->id,
                    'grade_curricular_id' => $gradeCurricular->id,
                    'periodo_escolar_id' => $periodoEscolar->id,
                    'codigo_turma' => $codigoTurma,
                    'created_at' => Carbon::now()
                ]);

                $noti = [
                    'message' => 'Nova turma gerada com sucesso!',
                    'alert-type' => 'success'
                ];
        
                return redirect()->back()->with($noti);
            }
        }
    }

    public function index() {
        $turmas = Turmas::orderBy('periodo_escolar_id', 'DESC')->get();

        return view('app.instituicao.cursos.turmas.index', compact('turmas'));
    }
}

