<?php

namespace App\Http\Controllers\Instituicao\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cursos;
use App\Models\GrauInstrucao;

use App\Models\GradeCurricular;
use App\Models\Disciplinas;

use DB;
use Carbon\Carbon;
use Validator;
use Response;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grau_instrucao = GrauInstrucao::get();
        $cursos = Cursos::orderBy('curso', 'ASC')->get();
        $disciplinas = Disciplinas::get();

        foreach($disciplinas as $disciplina) {
            $gradeCurricular = GradeCurricular::where('disciplina_id', $disciplina->id)->get();

            foreach($gradeCurricular as $grade) {
                $duracaoHoras = DB::table('disciplinas')->whereExists(function($query){
                    $query->select(DB::raw('*'))
                        ->from('grade_curriculars')
                        ->whereRaw('grade_curriculars.disciplina_id = disciplinas.id');
                })->sum('duracao_horas');
            }
        }
        
        return view('app.instituicao.cursos.index', compact('grau_instrucao', 'cursos', 'duracaoHoras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grau_instrucao_id' => 'required',
            'curso' => 'required',
            'descricao' => 'required',
            'quantidade_semestres' => 'required',
        ], [     
            'grau_instrucao_id.required' => 'Selecione o grau de instrução deste Curso.',
            'curso.required' => 'Digite um nome para esse Curso.',
            'descricao.required' => 'Descreva um pouco sobre o Curso.',
            'quantidade_semestres.required' => 'Especifique a quantidade de semestres desse Curso.',
        ]);

        if ($validator->passes()) {
            Cursos::insert([
                'grau_instrucao_id' => $request->grau_instrucao_id,

                'curso' => $request->curso,
                'descricao' => $request->descricao,
                'quantidade_semestres' => $request->quantidade_semestres,

                'created_at' => Carbon::now()        
            ]);
            
            return Response::json(['success' => '1']);
        }
            
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Cursos::findOrFail($id);
        $grauInstrucao = GrauInstrucao::where('id', $curso->grau_instrucao_id)->first();

        return response()->json([
            'curso' => $curso,
            'grauInstrucao' => $grauInstrucao
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Cursos::findOrFail($id);
        $grauInstrucao = GrauInstrucao::where('id', $curso->grau_instrucao_id)->first();

        return response()->json([
            'curso' => $curso,
            'grauInstrucao' => $grauInstrucao
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grau_instrucao_id' => 'required',
            'curso' => 'required',
            'descricao' => 'required',
            'quantidade_semestres' => 'required',
        ], [     
            'grau_instrucao_id.required' => 'Selecione o grau de instrução deste Curso.',
            'curso.required' => 'Digite um nome para esse Curso.',
            'descricao.required' => 'Descreva um pouco sobre o Curso.',
            'quantidade_semestres.required' => 'Especifique a quantidade de semestres desse Curso.',
        ]);

        $id = $request->curso_id;

        if ($validator->passes()) {
            Cursos::findOrFail($id)->update([
                'grau_instrucao_id' => $request->grau_instrucao_id,

                'curso' => $request->curso,
                'descricao' => $request->descricao,
                'quantidade_semestres' => $request->quantidade_semestres,

                'updated_at' => Carbon::now()        
            ]);
            
            return Response::json(['success' => '1']);
        }
            
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Cursos::findOrFail($id);
        $gradeCurricular = GradeCurricular::where('curso_id', $curso->id)->get();

        foreach($gradeCurricular as $grade) {
            $grade->delete();
        }

        $curso->delete();

        $noti = [
            'message' => 'Curso removido com sucesso!',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($noti);
    }
}
