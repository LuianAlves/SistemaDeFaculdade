<?php

namespace App\Http\Controllers\Instituicao\CorpoDiscente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Turmas;
use App\Models\Departamentos;

use Carbon\Carbon;
use Validator;
use Response;

class AlunosController extends Controller
{
    public function index()
    {
        $alunos = Alunos::with('Estudante')->paginate(5);

        return view('app.instituicao.corpo_discente.index', compact('alunos'));
    }

    public function areaAluno($aluno_id){
        $aluno = Alunos::findOrFail($aluno_id);
        $cursos = Cursos::get();
        $turmas = Turmas::where('curso_id', $aluno->curso_id)->get();
        $departamentos = Departamentos::get();

        return view('app.instituicao.corpo_discente.area_aluno', compact('aluno', 'cursos', 'departamentos', 'turmas'));
    }

    public function getTurma($curso_id) {
        $turma = Turmas::where('curso_id', $curso_id)->orderBy('created_at', 'ASC')->get();

        return json_encode($turma);
    }

    public function store(Request $request) {
        Alunos::insert([
            'usuario_id' => $request->aluno_id,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'email_pessoal' => $request->email_pessoal,
            'telefone_recado' => $request->telefone_recado,
            'nome_mae' => $request->nome_mae,
            'nome_pai' => $request->nome_pai,
            'curso_id' => $request->curso_id,
            'serie_turma' => $request->serie_turma,
            'situacao' => $request->situacao,
            'created_at' => Carbon::now()      
        ]);
        
        return redirect()->back();
    }

    public function show($aluno_id) {
        $alunoInfAdicional = Alunos::findOrFail($aluno_id);
        $aluno = Usuarios::where('id', $alunoInfAdicional->usuario_id)->first();
        
        return response()->json([
            'aluno' => $aluno,
            'alunoInfAdicional' => $alunoInfAdicional
        ]); 
    }

    public function edit($aluno_id) {
        $aluno = Alunos::where('id', $aluno_id)->first();
        $usuario = Usuarios::where('id', $aluno->usuario_id)->first();
        $curso = Cursos::where('id', $aluno->curso_id)->first();
        $turma = Turmas::where('id', $aluno->serie_turma)->first();

        return response()->json([
            'status' => 200,
            'usuario' => $usuario,
            'aluno' => $aluno,
            'curso' => $curso,
            'turma' => $turma
        ]); 
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'departamento_id' => 'required',

            'nome' => 'required',
            'sobrenome' => 'required',
            'telefone' => 'required',

            'cep' => 'required',
            'nome_rua' => 'required',
            'numero_casa' => 'required',
        ], [
            'departamento_id.required' => 'Selecione o departamento desse usuário.',
            
            'nome.required' => 'Insira um nome para este usuário.',
            'sobrenome.required' => 'Insira o sobrenome para este usuário.',
            'telefone.required' => 'Insira um telefone para este usuário.',

            'cep.required' => 'Insira um CEP.',
            'nome_rua.required' => 'Insira o nome da rua.',
            'numero_casa.required' => 'Insira o número da casa.',
        ]);

        $aluno_id = $request->aluno_id;
        $usuario_id = $request->usuario_id;
        
        if ($validator->passes()) {
            Usuarios::where('id', $usuario_id)->update([
                'departamento_id' => $request->departamento_id,
    
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'telefone' => $request->telefone,

                'cep' => $request->cep,
                'nome_rua' => $request->nome_rua,
                'numero_casa' => $request->numero_casa,
        
                'updated_at' => Carbon::now()        
            ]); 
            
            Alunos::where('id', $aluno_id)->update([
                'usuario_id' => $request->aluno_id,
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'email_pessoal' => $request->email_pessoal,
                'telefone_recado' => $request->telefone_recado,
                'nome_mae' => $request->nome_mae,
                'nome_pai' => $request->nome_pai,
                'curso_id' => $request->curso_id,
                'serie_turma' => $request->serie_turma,
                'situacao' => $request->situacao,
                'updated_at' => Carbon::now()
            ]);

            return Response::json(['success' => '1', 'aluno_id' => $aluno_id]);
        }
            
        return Response::json(['errors' => $validator->errors()]);
    }

    public function destroy($aluno_id) {
        $aluno = Alunos::findOrFail($aluno_id);
        $usuario = Usuarios::where('id', $aluno->usuario_id);
        
        $usuario->delete();
        $aluno->delete();

        $noti = [
            'message' => 'Alunos desmatriculado com sucesso!',
            'alert-type' => 'success'
        ];

        return redirect()->route('alunos.index');
    }
}