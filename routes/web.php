<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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


// Usuários  
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Instituicao\CorpoDiscente\AlunosController;

/* Principal Dashboard */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
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

    // Alunos
    Route::get('/alunos', [AlunosController::class,'index'])->name('alunos.index');
    Route::get('/alunos/area_aluno/{aluno_id}', [AlunosController::class,'areaAluno'])->name('alunos.area-aluno');
    Route::get('/alunos/area_aluno/ajax/{aluno_id}', [AlunosController::class,'getTurma']);
    Route::post('/alunos/area_aluno/store', [AlunosController::class,'store'])->name('alunos.store');
    Route::get('/alunos/area_aluno/show/{aluno_id}', [AlunosController::class,'show'])->name('alunos.show');
    Route::get('/alunos/area_aluno/edit/{aluno_id}', [AlunosController::class,'edit'])->name('alunos.edit');
    Route::post('/alunos/area_aluno/update', [AlunosController::class,'update'])->name('alunos.update');
    Route::get('/alunos/destroy/{aluno_id}', [AlunosController::class,'destroy'])->name('alunos.destroy');
});