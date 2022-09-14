<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;

/* Cadastro da Instituição */
use App\Http\Controllers\Instituicao\InstituicaoController;
use App\Http\Controllers\Instituicao\CampusController;
use App\Http\Controllers\Instituicao\Cursos\DisciplinasController;
use App\Http\Controllers\Instituicao\Cursos\CursosController;
use App\Http\Controllers\Instituicao\Cursos\GradeCurricular\GradeCurricularController;
use App\Http\Controllers\Instituicao\Cursos\Turmas\TurmasController;
use App\Http\Controllers\Instituicao\Cursos\Turmas\SemestreAtualController;
use App\Http\Controllers\Instituicao\Relatorios\RelatorioTurmaController;
use App\Http\Controllers\Instituicao\Relatorios\RelatorioAlunoController;

// Calendario Academico
use App\Http\Controllers\Instituicao\CalendarioAcademico\PeriodoEscolarController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\PeriodoAvaliacoesController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\AvaliacoesCursosController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\Notas\LancamentoNotasController;

// Usuários  
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Instituicao\CorpoDiscente\AlunosController;
use App\Http\Controllers\Instituicao\CorpoDocente\ProfessorController;

// Area de permissões
use App\Http\Controllers\Instituicao\CorpoDiscente\Permissoes\AreaPermissaoAlunoController;
use App\Http\Controllers\Instituicao\CorpoDocente\Permissoes\AreaPermissaoProfessorController;


/* ------------------------------------------------------------ */


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    /* ========== Routes para Todos ============= */

    // Auth
    Route::controller(AuthController::class)->group(function() {
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/minha-conta', [AuthController::class, 'profile'])->name('auth.profile-me');
        Route::post('/minha-conta/atualizar', [AuthController::class, 'updateProfile'])->name('auth.profile.update');
        Route::post('/minha-conta/senha/atualizar', [AuthController::class, 'updatePassword'])->name('auth.password.update');
    });

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Área do Aluno
    Route::get('/alunos/area_aluno/{aluno_id}', [AlunosController::class,'areaAluno'])->name('alunos.area-aluno');

    // Área do professor
    Route::get('/professores/area_professor/{professor_id}', [ProfessorController::class,'areaProfessor'])->name('professores.area-professor');

    // Alunos
    Route::middleware(['permission:dev|administracao|professor'])->group(function() {
        Route::get('/alunos', [AlunosController::class,'index'])->name('alunos.index');
        Route::get('/alunos/area_aluno/ajax/{aluno_id}', [AlunosController::class,'getTurma']);
        Route::post('/alunos/area_aluno/store', [AlunosController::class,'store'])->name('alunos.store');
        Route::get('/alunos/area_aluno/show/{aluno_id}', [AlunosController::class,'show'])->name('alunos.show');
        Route::get('/alunos/area_aluno/edit/{aluno_id}', [AlunosController::class,'edit'])->name('alunos.edit');
        Route::post('/alunos/area_aluno/update', [AlunosController::class,'update'])->name('alunos.update');
        Route::get('/alunos/destroy/{aluno_id}', [AlunosController::class,'destroy'])->name('alunos.destroy');
    });

    // Professores
    Route::middleware(['permission:dev|administracao|professor'])->group(function () {
        Route::get('/professores', [ProfessorController::class, 'index'])->name('professores.index');
        Route::get('/professores/area_professor/edit/{professor_id}', [ProfessorController::class, 'edit'])->name('professores.edit');
        Route::get('/professores/area_professor/update', [ProfessorController::class, 'update'])->name('professores.update');
    });

    /* ========== Routes Dev ============= */
    Route::group(['middleware' => ['permission:dev']], function () {
        // Campus
        Route::post('/campus/update', [CampusController::class, 'update'])->name('campus.update');
        Route::resource('/campus', CampusController::class)->except('create', 'show', 'update');

        // Cursos
        Route::post('/cursos/update', [CursosController::class, 'update'])->name('cursos.update');
        Route::resource('/cursos', CursosController::class)->except('create', 'update');
        
        // Disciplinas
        Route::post('/disciplinas/update', [DisciplinasController::class, 'update'])->name('disciplinas.update');
        Route::resource('/disciplinas', DisciplinasController::class)->except('create', 'update');
        
        // Grade Curricular
        Route::get('/grade-curricular/{curso_id}', [GradeCurricularController::class, 'index'])->name('grade-curricular.index');
        Route::get('/grade-curricular/create/{curso_id}/{semestre}', [GradeCurricularController::class, 'create'])->name('grade-curricular.create');
        Route::post('/grade-curricular/store/{curso_id}/{semestre}', [GradeCurricularController::class, 'store'])->name('grade-curricular.store');
        Route::get('/grade-curricular/destroy/{id}/{curso_id}/{disciplina_id}', [GradeCurricularController::class, 'destroy'])->name('grade-curricular.destroy');
    });   

    /* ========== Routes Administração ============= */
    Route::group(['middleware' => ['permission:administracao|dev']], function () {
        // Calendario Academico
        Route::prefix('/calendario-academico')->group(function(){
            Route::resource('/periodo-escolar', PeriodoEscolarController::class);
            Route::resource('/periodo-avaliacoes', PeriodoAvaliacoesController::class)->except('create');
            
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/disciplinas/ajax/{curso_id}', [AvaliacoesCursosController::class, 'getGradeCurricular']);
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/ajax/{curso_id}', [AvaliacoesCursosController::class, 'getTurma']);
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/{avaliacao_id}', [AvaliacoesCursosController::class, 'index'])->name('avaliacoes-cursos.index');
            Route::resource('/periodo-avaliacoes/avaliacoes-cursos', AvaliacoesCursosController::class)->except('index');
        });

        // Turmas
        Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas.index');
        Route::get('/cursos/{curso_id}/turma', [TurmasController::class, 'store'])->name('turmas.store');

        // Semestre Atual
        // Administrar grade curricular
        Route::get('/semestre-atual/grade-curricular/{turma_id}', [SemestreAtualController::class, 'gradeCurricular'])->name('semestre-atual.grade-curricular');
        Route::post('/semestre-atual/grade-curricular/store', [SemestreAtualController::class, 'store'])->name('semestre-atual.store');

        // Relatorios
        Route::prefix('/relatorios')->group(function() {
            Route::get('/alunos', [RelatorioAlunoController::class, 'index'])->name('relatorio-alunos.index');
            Route::get('/alunos/gerar/{aluno_id}', [RelatorioAlunoController::class, 'gerarRelatorioAluno'])->name('relatorio-alunos.gerar-relatorio-aluno');
            Route::get('/alunos/relatorios/{aluno_id}', [RelatorioAlunoController::class, 'viewRelatorio'])->name('relatorio-alunos.view-relatorios');
        });

        // Usuários
        Route::get('/usuario/alfabetica/desc', [UsuarioController::class, 'index'])->name('alfabetic.order.desc');
        Route::get('/usuario/alfabetica/asc', [UsuarioController::class, 'index'])->name('alfabetic.order.asc');
        Route::get('/usuario/cadastro/asc', [UsuarioController::class, 'index'])->name('alfabetic.date.asc');
        Route::get('/usuario/cadastro/desc', [UsuarioController::class, 'index'])->name('alfabetic.date.desc');
        Route::get('/usuario/departamento/asc', [UsuarioController::class, 'index'])->name('alfabetic.departamento.asc');
        Route::get('/usuario/departamento/desc', [UsuarioController::class, 'index'])->name('alfabetic.departamento.desc');

        Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update');
        Route::resource('/usuario', UsuarioController::class)->except('update');
    });

    /* ========== Routes Professores ============= */
    Route::group(['middleware' => ['permission:professor']], function () {
        // Permissão Professores
        Route::get('/area-permissao/professores/meu-cadastro/{usuario_id}', [AreaPermissaoProfessorController::class, 'meuCadastro'])->name('area-permissao-professor.meu-cadastro');
        Route::get('/area-permissao/professores/disciplinas-lecionadas/{usuario_id}', [AreaPermissaoProfessorController::class, 'disciplinasLecionadas'])->name('area-permissao-professor.disciplinas-lecionadas');

        // Notas
        Route::prefix('/notas')->group(function(){
            // Lançar Notas
            Route::get('/lancar-notas/gerando-view/{aluno_id}', [LancamentoNotasController::class, 'gerandoView'])->name('lancar-notas.gerando-view');
            Route::get('/lancar-notas/{aluno_id}', [LancamentoNotasController::class, 'index'])->name('lancar-notas.index');

            // notas
            Route::post('/notas/update', [LancamentoNotasController::class, 'update'])->name('notas.update');
        });
    });

    /* ========== Routes Alunos ============= */
    Route::group(['middleware' => ['permission:aluno']], function () {
        Route::get('/area-permissao/alunos/meu-cadastro/{usuario_id}', [AreaPermissaoAlunoController::class, 'meuCadastro'])->name('area-permissao-aluno.meu-cadastro');
        Route::get('/area-permissao/alunos/dados-do-curso/{usuario_id}', [AreaPermissaoAlunoController::class, 'dadosCurso'])->name('area-permissao-aluno.dados-curso');
        Route::get('/area-permissao/alunos/notas-faltas/{usuario_id}', [AreaPermissaoAlunoController::class, 'notasFaltas'])->name('area-permissao-aluno.notas-faltas');
        Route::get('/area-permissao/alunos/integracao-curricular/{usuario_id}', [AreaPermissaoAlunoController::class, 'integracaoCurricular'])->name('area-permissao-aluno.integracao-curricular');
    });
});




