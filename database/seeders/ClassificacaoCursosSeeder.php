<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ClassificacaoCursos;

use Carbon\Carbon;

class ClassificacaoCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassificacaoCursos::create([
            'area_conhecimento' => 'Ciências Biológicas',
            'created_at' => Carbon::now()
        ]);
        
        ClassificacaoCursos::create([
            'area_conhecimento' => 'Ciências Exatas',
            'created_at' => Carbon::now()
        ]);

        ClassificacaoCursos::create([
            'area_conhecimento' => 'Ciências Humanas',
            'created_at' => Carbon::now()
        ]);

    }
}
