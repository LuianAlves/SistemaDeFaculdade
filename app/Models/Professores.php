<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professores extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function Professor() {
        return $this->belongsTo(Usuarios::class, 'usuario_id', 'id');
    }
}
