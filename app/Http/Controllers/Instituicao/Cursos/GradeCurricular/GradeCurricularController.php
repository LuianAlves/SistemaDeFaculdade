<?php

namespace App\Http\Controllers\Instituicao\Cursos\GradeCurricular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cursos;
use App\Models\ClassificacaoCursos;
use App\Models\Disciplinas;
use App\Models\GradeCurricular;

use Carbon\Carbon;

class GradeCurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($curso_id)
    {
        $curso = Cursos::findOrFail($curso_id);
        $gradeCurricular = GradeCurricular::with('disciplina')->where('curso_id', $curso_id)->get();
        
        dd($gradeCurricular);
        die;
        return view('app.instituicao.cursos.grade_curricular.index', compact('curso', 'gradeCurricular'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curso_id, $semestre)
    {
        $curso = Cursos::findOrFail($curso_id);

        $areaConhecimento = ClassificacaoCursos::get();
        $disciplinas = Disciplinas::get();

        return view('app.instituicao.cursos.grade_curricular.create', compact('curso', 'semestre', 'areaConhecimento', 'disciplinas', 'semestre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $curso_id, $semestre)
    {
        $todos_os_dados = $request->all();

        $dados = array_unique($todos_os_dados);

    
        foreach($dados as $dd => $valor) {
            $disciplina_id = substr($dd, 0, 100);
            
            GradeCurricular::insert([
                'curso_id' => $curso_id,
                'disciplina_id' => $disciplina_id,
                'semestre' => $semestre,
                'created_at' => Carbon::now()
            ]);
        }

        $noti = [
            'message' => 'Disciplinas adicionadas ao semestre.',
            'alert-type' => 'success'
        ];

        return redirect()->route('grade-curricular.index', $curso_id)->with($noti);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $curso_id, $disciplina_id)
    {
        $gradeCurricular = GradeCurricular::findOrFail($id)->delete();

        $noti = [
            'message' => 'Disciplina removida da grade curricular',
            'alert-type' => 'error'
        ];  

        return redirect()->route('grade-curricular.index', $curso_id)->with($noti);
    }
}
