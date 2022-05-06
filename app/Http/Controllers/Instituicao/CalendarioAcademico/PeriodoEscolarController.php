<?php

namespace App\Http\Controllers\Instituicao\CalendarioAcademico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CalendarioAcademico\PeriodoEscolar;
use App\Models\CalendarioAcademico\PeriodoEscolarVeteranos;
use App\Models\CalendarioAcademico\PeriodoEscolarCalouros;

use Carbon\Carbon;

class PeriodoEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodoEscolar = PeriodoEscolar::orderBy('ano_periodo_escolar', 'ASC')->get();
        $calouros = PeriodoEscolar::where('estudantes', 1)->orderBy('ano_periodo_escolar')->get();
        $veteranos = PeriodoEscolar::where('estudantes', 2)->orderBy('ano_periodo_escolar')->get();

        return view('app.instituicao.calendario_academico.periodo_escolar.index', compact('periodoEscolar', 'calouros', 'veteranos'));
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
        $ano = substr($request->inicio_periodo_escolar, 0, 4);

        PeriodoEscolar::insert([
            'inicio_periodo_escolar' => $request->inicio_periodo_escolar, 
            'termino_periodo_escolar' => $request->termino_periodo_escolar, 
            'ano_periodo_escolar' => $ano,
            'estudantes' => $request->estudantes,
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
}
