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

// Calendario Academico
use App\Http\Controllers\Instituicao\CalendarioAcademico\PeriodoEscolarController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\PeriodoAvaliacoesController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\AvaliacoesCursosController;
use App\Http\Controllers\Instituicao\CalendarioAcademico\Avaliacoes\Notas\LancamentoNotasController;


// Usuários  
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Instituicao\CorpoDiscente\AlunosController;

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

    // Alunos
    Route::prefix('/alunos')->group(function(){
        Route::get('/', [AlunosController::class,'index'])->name('alunos.index');
        Route::get('/area_aluno/{aluno_id}', [AlunosController::class,'areaAluno'])->name('alunos.area-aluno');
        Route::get('/area_aluno/ajax/{aluno_id}', [AlunosController::class,'getTurma']);
        Route::post('/area_aluno/store', [AlunosController::class,'store'])->name('alunos.store');
        Route::get('/area_aluno/show/{aluno_id}', [AlunosController::class,'show'])->name('alunos.show');
        Route::get('/area_aluno/edit/{aluno_id}', [AlunosController::class,'edit'])->name('alunos.edit');
        Route::post('/area_aluno/update', [AlunosController::class,'update'])->name('alunos.update');
        Route::get('/destroy/{aluno_id}', [AlunosController::class,'destroy'])->name('alunos.destroy');
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

        // Turmas
        Route::get('/cursos/{curso_id}/turma', [TurmasController::class, 'store'])->name('turmas.store');
        Route::get('/turmas', [TurmasController::class, 'index'])->name('turmas.index');
    });   

    /* ========== Routes Administração ============= */
    Route::group(['middleware' => ['permission:administracao']], function () {
        // Calendario Academico
        Route::prefix('/calendario-academico')->group(function(){
            Route::resource('/periodo-escolar', PeriodoEscolarController::class);
            Route::resource('/periodo-avaliacoes', PeriodoAvaliacoesController::class)->except('create');
            
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/disciplinas/ajax/{curso_id}', [AvaliacoesCursosController::class, 'getGradeCurricular']);
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/ajax/{curso_id}', [AvaliacoesCursosController::class, 'getTurma']);
            Route::get('/periodo-avaliacoes/avaliacoes-cursos/{avaliacao_id}', [AvaliacoesCursosController::class, 'index'])->name('avaliacoes-cursos.index');
            Route::resource('/periodo-avaliacoes/avaliacoes-cursos', AvaliacoesCursosController::class)->except('index');
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
        //
    });
});




