<?php

namespace App\Http\Controllers\Instituicao\Cursos\Turmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cursos;
use App\Models\GradeCurricular;
use App\Models\CalendarioAcademico\PeriodoEscolar;
use App\Models\Turmas;

use Carbon\Carbon;

class TurmasController extends Controller
{
    public function store($curso_id) {
        
        $curso = Cursos::findOrFail($curso_id);
        $gradeCurricular = GradeCurricular::where('curso_id', $curso->id)->first();
        
        $data_atual = substr(Carbon::now(), 0, 4);
        $periodoEscolar = PeriodoEscolar::where('ano_periodo_escolar', $data_atual)->first();
        
        $turma = Turmas::where('curso_id', $curso->id)->first();

        if($turma == '' && $periodoEscolar) {   
            $codigo = 'TURMA_'.mt_rand(1000, 9999);

            Turmas::insert([
                'curso_id' => $curso->id,
                'grade_curricular_id' => $gradeCurricular->id,
                'periodo_escolar_id' => $periodoEscolar->id,
                'codigo_turma' => $codigo,
                'created_at' => Carbon::now()
            ]);

            $noti = [
                'message' => 'Nova turma criada com sucesso!',
                'alert-type' => 'success'
            ];

            return redirect()->route('cursos.index')->with($noti);
        } else {

            $noti = [
                'message' => 'A turma atual ainda não atigiu seu limite de alunos!',
                'alert-type' => 'error'
            ];

            return redirect()->route('cursos.index')->with($noti);
        }

        

        
    }
}
