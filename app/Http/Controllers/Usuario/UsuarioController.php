<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Alunos;
use App\Models\Professores;
use App\Models\Administracao;
use App\Models\Usuarios;
use App\Models\Departamentos;
use App\Models\Notas\LancamentoNotas;

use Carbon\Carbon;

use Validator;
use Response;
use Image;
use File;
use Hash;
use Auth;

use Illuminate\Support\Facades\Route;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamentos::get();
        
        $rotaAtual = Route::currentRouteName();

        // Rotas para Ordenação dos Dados
        switch ($rotaAtual) {
            case 'usuario.index':
                $usuarios = Usuarios::paginate(5);
                break;

            case 'alfabetic.order.asc':
                $usuarios = Usuarios::orderBy('nome', 'ASC')->paginate(5);
                break;

            case 'alfabetic.order.desc':
                $usuarios = Usuarios::orderBy('nome', 'DESC')->paginate(5);
                break;

            case 'alfabetic.date.asc':
                $usuarios = Usuarios::orderBy('created_at', 'ASC')->paginate(5);
                break;

            case 'alfabetic.date.desc':
                $usuarios = Usuarios::orderBy('created_at', 'DESC')->paginate(5);
                break;

            case 'alfabetic.departamento.asc':
                $usuarios = Usuarios::orderBy('departamento_id', 'ASC')->paginate(5);
                break;

            case 'alfabetic.departamento.desc':
                $usuarios = Usuarios::orderBy('departamento_id', 'DESC')->paginate(5);
                break;

            default:
                # code...
                break;
        }

        return view('app.usuario.index', compact('departamentos', 'usuarios'));
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

        // -- Gerando Código Usuário + Email
        $nome = strtok(strtolower($request->nome), " ");
        $sobrenome = strtok(strtolower($request->sobrenome), " ");

        $codigo_usuario = rand(1000, 9999);

        switch ($request->departamento_id) {
            case 1:
                    $codigo = 'AD_'.$codigo_usuario;
                    $email = $nome.'.'.$sobrenome.'@administrativo.unitech.br';
                    $permissao = 'administracao';
                    
                break;
            case 2:
                    $codigo = 'PR_'.$codigo_usuario;
                    $email = $nome.'.'.$sobrenome.'@docente.unitech.br';
                    $permissao = 'professor';
                break;
            case 3:
                    $codigo = 'ES_'.$codigo_usuario;
                    $email = $nome.'.'.$sobrenome.'@aluno.unitech.br';
                    $permissao = 'aluno';
                break;
            
            default:

                    $codigo = 'NOT CODE';
                break;
        }

        // Gerando Senha
        $senha_default = $request->senha;

        if($senha_default == '') {
            $telefone = substr($request->telefone, -4);

            $senha = ucfirst($request->nome).'_'.$telefone;

            $senha_default = $senha;
        }
        $hash_senha = Hash::make($senha_default);
             

        if ($validator->passes()) {

            // Cadastrando Login e Senha
            $user = User::create([
                'name' => $request->nome,
                'email' => $email,
                'password' => $hash_senha,
            ])->givePermissionTo($permissao);

            // Usuários
            $usuario = Usuarios::create([
                'user_id' => $user->id,
                'departamento_id' => $request->departamento_id,
                'codigo_usuario' => $codigo,
    
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'telefone' => $request->telefone,

                'cep' => $request->cep,
                'nome_rua' => $request->nome_rua,
                'numero_casa' => $request->numero_casa,
    
                'email' => $email,
                'senha' => $hash_senha,
    
                'created_at' => Carbon::now()        
            ]);

            // Divisões
            if($request->departamento_id == 3) {
                Alunos::insert([
                    'usuario_id' => $usuario->id,
                ]);
            } 
            
            if($request->departamento_id == 2) {
                Professores::insert([
                    'usuario_id' => $usuario->id,
                ]);
            }

            if($request->departamento_id == 1) {
                Administracao::insert([
                    'usuario_id' => $usuario->id,
                ]);
            }

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
    public function show(Usuarios $usuario)
    {
        // $usuario = Usuarios::findOrFail($id);

        $usuario->id;

        return response()->json([
            'usuario' => $usuario
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
        $usuario = Usuarios::findOrFail($id);

        return response()->json([
            'status' => 200,
            'usuario' => $usuario
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

        $id = $request->usuario_id;

        if ($validator->passes()) {

            Usuarios::findOrFail($id)->update([
                'departamento_id' => $request->departamento_id,
    
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'telefone' => $request->telefone,

                'cep' => $request->cep,
                'nome_rua' => $request->nome_rua,
                'numero_casa' => $request->numero_casa,
    
                'email' => $request->email,
    
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
        $usuario = Usuarios::findOrFail($id);
        
        $foto = $usuario->foto_usuario;
        
        if($foto) {
            unlink($foto);
        } 
        
        // Delete
        $userLogin = User::where('id', $usuario->user_id)->delete(); 
        $aluno = Alunos::where('usuario_id', $usuario->id)->delete();

        $usuario->delete();

        $noti = [
            'message' => 'Usuário removido com sucesso!',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($noti);
    }
}
