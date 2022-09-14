<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemestreAtual extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Curso() {
        return $this->belongsTo(Cursos::class, 'curso_id', 'id');
    }

    public function Professor() {
        return $this->belongsTo(Professores::class, 'professor_id', 'id');
    }

    public function Usuario() {
        return $this->belongsTo(Usuarios::class, 'usuario_id', 'id');
    }

    public function Disciplina() {
        return $this->belongsTo(Disciplinas::class, 'disciplina_id', 'id');
    }

    public function Turma() {
        return $this->belongsTo(Turmas::class, 'turma_id', 'id');
    }
}
