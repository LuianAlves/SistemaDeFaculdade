<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Instituicao;

use Carbon\Carbon;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instituicao::create([
            'nome_campus' => 'Instituição - SP',
            'estado_campus' => 'São Paulo/SP',
            'created_at' => Carbon::now()
        ]);

        Instituicao::create([
            'nome_campus' => 'Instituição - RJ',
            'estado_campus' => 'Rio de Janeiro/RJ',
            'created_at' => Carbon::now()
        ]);

        Instituicao::create([
            'nome_campus' => 'Instituição - DF',
            'estado_campus' => 'Distrito Federal/DF',
            'created_at' => Carbon::now()
        ]);

        Instituicao::create([
            'nome_campus' => 'Instituição - MT',
            'estado_campus' => 'Mato Grosso/MT',
            'created_at' => Carbon::now()
        ]);

        Instituicao::create([
            'nome_campus' => 'Instituição - MG',
            'estado_campus' => 'Minas Gerais/MG',
            'created_at' => Carbon::now()
        ]);
    }
}
