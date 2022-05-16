<?php

namespace App\Http\Controllers\Instituicao\CorpoDiscente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Turmas;

use Carbon\Carbon;

class AlunosController extends Controller
{
    public function index()
    {
        $alunos = Usuarios::where('departamento_id', 3)->paginate(5);

        return view('app.instituicao.corpo_discente.index', compact('alunos'));
    }

    public function areaAluno($aluno_id){
        $aluno = Usuarios::findOrFail($aluno_id);
        $cursos = Cursos::get();

        return view('app.instituicao.corpo_discente.area_aluno', compact('aluno', 'cursos'));
    }

    public function getTurma($curso_id) {
        $turma = Turmas::where('curso_id', $curso_id)->orderBy('created_at', 'ASC')->get();

        return json_encode($turma);
    }

    public function store(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'cpf' => 'required',
        //     'rg' => 'required',
        //     'nome_mae' => 'required',
        // ], [     
        //     'cpf.required' => 'Informe o CPF do aluno.',
        //     'rg.required' => 'Informe o RG do aluno.',
        //     'nome_mae.required' => 'Informe o nome da mãe do aluno.'  
        // ]);


        // if ($validator->passes()) {
            Alunos::insert([
                'usuario_id' => $request->aluno_id,
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'email_pessoal' => $request->email_pessoal,
                'telefone_recado' => $request->telefone_recado,
                'nome_mae' => $request->nome_mae,
                'nome_pai' => $request->nome_pai,
                'serie_turma' => $request->serie_turma,
                'situacao' => $request->situacao,
                'created_at' => Carbon::now()      
            ]);
            
            return redirect()->back();
        //     return Response::json(['success' => '1']);
        // }

        // return Response::json(['errors' => $validator->errors()]);
    }
}