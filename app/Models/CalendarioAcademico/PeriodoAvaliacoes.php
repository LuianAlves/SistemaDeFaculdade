<?php

namespace App\Models\CalendarioAcademico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Campus;

class PeriodoAvaliacoes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }
}
