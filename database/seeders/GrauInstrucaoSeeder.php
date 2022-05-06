<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\GrauInstrucao;

use Carbon\Carbon;

class GrauInstrucaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GrauInstrucao::create([
            'grau_instrucao' => 'Graduação',
            'created_at' => Carbon::now()
        ]);

        GrauInstrucao::create([
            'grau_instrucao' => 'Pós-graduação',
            'created_at' => Carbon::now()
        ]);
        
        GrauInstrucao::create([
            'grau_instrucao' => 'Mestrado',
            'created_at' => Carbon::now()
        ]);
        
        GrauInstrucao::create([
            'grau_instrucao' => 'Doutorado',
            'created_at' => Carbon::now()
        ]);

        GrauInstrucao::create([
            'grau_instrucao' => 'Pós-doutorado',
            'created_at' => Carbon::now()
        ]);

    }
}
