<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CalendarioAcademico\PeriodoEscolar;

class Turmas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function curso() {
        return $this->belongsTo(Cursos::class, 'curso_id', 'id');
    }

    public function gradeCurricular() {
        return $this->belongsTo(gradeCurricular::class, 'grade_curricular_id', 'id');
    }

    public function periodoEscolar() {
        return $this->belongsTo(PeriodoEscolar::class, 'periodo_escolar_id', 'id'); 
    }
}
