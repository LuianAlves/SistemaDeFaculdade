<?php

namespace App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Campus;

use App\Models\Cursos;
use App\Models\GradeCurricular;
use App\Models\CalendarioAcademico\PeriodoEscolar;
use App\Models\CalendarioAcademico\PeriodoAvaliacoes;

use Carbon\Carbon;

class PeriodoAvaliacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cursos = Cursos::get();
        // $anoLetivo = json_decode(PeriodoEscolar::groupBy('ano_periodo_escolar')->select('ano_periodo_escolar')->orderBy('ano_periodo_escolar', 'DESC')->get(), true);
        $avaliacoes = PeriodoAvaliacoes::get();
        $campus = Campus::get();

        return view('app.instituicao.calendario_academico.periodo_avaliacoes.index', compact('avaliacoes', 'campus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avaliacao = PeriodoAvaliacoes::insert([
            'campus_id' => $request->campus_id, 
            'inicio_periodo_avaliacoes' => $request->inicio_periodo_avaliacoes,
            'termino_periodo_avaliacoes' => $request->termino_periodo_avaliacoes,
            'tipo_prova' => $request->tipo_prova,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
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

    public function getSemestre($curso_id) {
        $curso = Cursos::where('id', $curso_id)->get(); 

        return json_encode($curso);
    }
}
