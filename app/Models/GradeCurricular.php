<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCurricular extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function disciplina() {
        return $this->belongsTo(Disciplinas::class, 'disciplina_id', 'id');
    }
}
