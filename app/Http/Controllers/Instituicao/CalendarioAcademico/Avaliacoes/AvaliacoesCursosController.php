<?php

namespace App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CalendarioAcademico\PeriodoAvaliacoes;
use App\Models\CalendarioAcademico\AvaliacoesCursos;
use App\Models\GradeCurricular;
use App\Models\Turmas;
use App\Models\Disciplinas;
use App\Models\Cursos;

use Carbon\Carbon;

class AvaliacoesCursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($avaliacao_id)
    {
        $avaliacao = PeriodoAvaliacoes::findOrFail($avaliacao_id);
        $avaliacoesCursos = AvaliacoesCursos::where('periodo_avaliacoes_id', $avaliacao->id)->get();
        $cursos = Cursos::get();
        $turmas = Turmas::get();
        $disciplinas = Disciplinas::get();

        return view('app.instituicao.calendario_academico.periodo_avaliacoes.avaliacoes_cursos.index', compact('avaliacoesCursos', 'avaliacao', 'cursos', 'disciplinas', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // die;
        // $request->validate([

        // ]);

        $id = $request->periodo_avaliacoes_id;
        
        AvaliacoesCursos::insert([
            'periodo_avaliacoes_id' => $id,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
            'disciplina_id' => $request->disciplina_id,
            'data_da_prova' => $request->data_da_prova,
            'created_at' => Carbon::now()
        ]);

        $noti = [
            'message' => 'Data da prova criada com sucesso!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($noti);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function getGradeCurricular($curso_id) {
        $gradeCurricular = GradeCurricular::with('disciplina')->where('curso_id', $curso_id)->orderBy('semestre', 'ASC')->get();

        return json_encode($gradeCurricular);
    }

    public function getTurma($curso_id) {
        $turma = Turmas::where('curso_id', $curso_id)->orderBy('created_at', 'ASC')->get();

        return json_encode($turma);
    }
}
