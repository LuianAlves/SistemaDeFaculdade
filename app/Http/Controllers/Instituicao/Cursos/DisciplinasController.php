<?php

namespace App\Http\Controllers\Instituicao\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClassificacaoCursos;
use App\Models\Disciplinas;

use Carbon\Carbon;
use Validator;
use Response;

class DisciplinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classificacaoCursos = ClassificacaoCursos::get();
        $disciplinas = Disciplinas::orderBy('disciplina', 'ASC')->get();

        return view('app.instituicao.cursos.disciplinas.index', compact('classificacaoCursos', 'disciplinas'));
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
            'area_conhecimento_id' => 'required',
            'disciplina' => 'required',
            'modalidade' => 'required',
            'duracao_horas' => 'required',
        ], [
            'area_conhecimento_id.required' => 'Insira uma area de conhecimento para essa disciplina.',
            'disciplina.required' => 'Insira um nome para essa disciplina',
            'modalidade.required' => 'Selecione a modalidade dessa disciplina',
            'duracao_horas.required' => 'Insira uma quantidade de horas para essa disciplina'
        ]);

        $codigo_disciplina = rand(1000, 9999);

        switch ($request->area_conhecimento_id) {
            case 1:
                    $codigo = 'CB'.$codigo_disciplina;
                break;
            case 2:
                    $codigo = 'CE'.$codigo_disciplina;
                break;
            case 3:
                    $codigo = 'CH'.$codigo_disciplina;
                break;

            
            default:

                    $codigo = 'NOT CODE';
                break;
        }

        if ($validator->passes()) {
            Disciplinas::insert([
                'area_conhecimento_id' => $request->area_conhecimento_id,

                'codigo_disciplina' => $codigo,
                'disciplina' => $request->disciplina,
                'modalidade' => $request->modalidade,
                'duracao_horas' => $request->duracao_horas,

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
        $disciplina = Disciplinas::findOrFail($id);
        $classificacaoCursos = ClassificacaoCursos::where('id', $disciplina->area_conhecimento_id)->first();

        return response()->json([
            'disciplina' => $disciplina,
            'classificacaoCursos' => $classificacaoCursos
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
        $disciplina = Disciplinas::findOrFail($id);
        $classificacaoCursos = ClassificacaoCursos::where('id', $disciplina->area_conhecimento_id)->first();

        return response()->json([
            'disciplina' => $disciplina,
            'classificacaoCursos' => $classificacaoCursos
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
            'area_conhecimento_id' => 'required',
            'disciplina' => 'required',
            'modalidade' => 'required',
            'duracao_horas' => 'required',
        ], [
            'area_conhecimento_id.required' => 'Insira uma area de conhecimento para essa disciplina.',
            'disciplina.required' => 'Insira um nome para essa disciplina',
            'modalidade.required' => 'Selecione a modalidade dessa disciplina',
            'duracao_horas.required' => 'Insira uma quantidade de horas para essa disciplina'
        ]);

        $codigo_disciplina = rand(1000, 9999);

        switch ($request->area_conhecimento_id) {
            case 1:
                    $codigo = 'CB'.$codigo_disciplina;
                break;
            case 2:
                    $codigo = 'CE'.$codigo_disciplina;
                break;
            case 3:
                    $codigo = 'CH'.$codigo_disciplina;
                break;

            
            default:

                    $codigo = 'NOT CODE';
                break;
        }

        $id = $request->disciplina_id;

        $disciplina = Disciplinas::where('id', $id)->first();

        if ($validator->passes()) {
            if($request->area_conhecimento_id == $disciplina->area_conhecimento_id) {
                Disciplinas::findOrFail($id)->update([
                    'area_conhecimento_id' => $request->area_conhecimento_id,
    
                    'disciplina' => $request->disciplina,
                    'modalidade' => $request->modalidade,
                    'duracao_horas' => $request->duracao_horas,
    
                    'updated_at' => Carbon::now()    
                ]);
            } else {

                    Disciplinas::findOrFail($id)->update([
                        'area_conhecimento_id' => $request->area_conhecimento_id,
                        
                        'codigo_disciplina' => $codigo,
                        'disciplina' => $request->disciplina,
                        'modalidade' => $request->modalidade,
                        'duracao_horas' => $request->duracao_horas,
                        
                        'updated_at' => Carbon::now()  
                    ]);
                }
            
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
        Disciplinas::findOrFail($id)->delete();

        $noti = [
            'message' => 'Disciplina removida com sucesso!',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($noti);
    }
}
