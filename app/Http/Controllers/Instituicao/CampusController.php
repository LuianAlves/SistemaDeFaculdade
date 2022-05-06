<?php

namespace App\Http\Controllers\Instituicao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Campus;
use App\Models\Estados;

use Carbon\Carbon;
use Validator;
use Response;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = Campus::get();
        $estados = Estados::get();

        return view('app.instituicao.campus.index', compact('campus', 'estados'));
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
            'estado_id' => 'required',
            'nome_campus' => 'required',
            
        ], [     
            'estado_id.required' => 'Insira o Estado para este Campus.',
            'nome_campus.required' => 'Insira um Nome para este Campus.',
        ]);

        if ($validator->passes()) {
            Campus::insert([
                'estado_id' => $request->estado_id,
                'nome_campus' => $request->nome_campus,

                'created_at' => Carbon::now()        
            ]);
            
            return Response::json(['success' => '1']);
        }
            
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campus = Campus::findOrFail($id);

        $estado = Estados::where('id', $campus->estado_id)->first();

        return response()->json([
            'campus' => $campus, 
            'estado' => $estado
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
            'estado_id' => 'required',
            'nome_campus' => 'required',
            
        ], [     
            'estado_id.required' => 'Insira o Estado para este Campus.',
            'nome_campus.required' => 'Insira um Nome para este Campus.',
        ]);

        $id = $request->campus_id;

        if ($validator->passes()) {

            Campus::findOrFail($id)->update([
                'estado_id' => $request->estado_id,
                'nome_campus' => $request->nome_campus,

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
        Campus::findOrFail($id)->delete();

        $noti = [
            'message' => 'Campus removido com sucesso!',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($noti);
    }
}
