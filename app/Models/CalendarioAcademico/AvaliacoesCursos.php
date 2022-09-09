<?php

namespace App\Models\CalendarioAcademico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Turmas;
use App\Models\Cursos;
use App\Models\Disciplinas;

class AvaliacoesCursos extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Curso() {
        return $this->belongsTo(Cursos::class, 'curso_id', 'id');
    }

    public function Disciplina() {
        return $this->belongsTo(Disciplinas::class, 'disciplina_id', 'id');
    }

    public function Turma() {
        return $this->belongsTo(Turmas::class, 'turma_id', 'id');
    }
}
