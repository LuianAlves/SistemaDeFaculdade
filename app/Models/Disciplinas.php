<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplinas extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function classificacaoCurso() {
        return $this->belongsTo(ClassificacaoCursos::class, 'area_conhecimento_id', 'id');
    }
}
