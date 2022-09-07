<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Estudante() {
        return $this->belongsTo(Usuarios::class, 'usuario_id', 'id');
    }

    public function Turma() {
        return $this->belongsTo(Turmas::class, 'serie_turma', 'id');
    }
    
    public function Curso() {
        return $this->belongsTo(Cursos::class, 'curso_id', 'id');
    }
    
}
