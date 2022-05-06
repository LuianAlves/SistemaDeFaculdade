<?php

namespace App\Http\Controllers\Instituicao\CalendarioAcademico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CalendarioAcademico\PeriodoEscolar;
use App\Models\Cursos;
use App\Models\GradeCurricular;

class PeriodoAvaliacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodoEscolar = json_decode(PeriodoEscolar::groupBy('ano_periodo_escolar')->select('ano_periodo_escolar')->orderBy('ano_periodo_escolar', 'ASC')->get(), true);
        $cursos = Cursos::get();

        return view('app.instituicao.calendario_academico.periodo_avaliacoes.index', compact('periodoEscolar', 'cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    // AJAX PARA SELECTS
    public function getGradeCurricular($curso_id) {
        $gradeCurricular = GradeCurricular::with('disciplina')->where('curso_id', $curso_id)->orderBy('semestre', 'ASC')->get();

        return json_encode($gradeCurricular);
    }
}
