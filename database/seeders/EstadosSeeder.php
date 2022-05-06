<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Estados;

use Carbon\Carbon;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estados::create([
            'estado' => 'São Paulo',
            'sigla' => 'SP',
            'created_at' => Carbon::now()
        ]);
        Estados::create([
            'estado' => 'Rio de Janeiro',
            'sigla' => 'RJ',
            'created_at' => Carbon::now()
        ]);
        Estados::create([
            'estado' => 'Distrito Federal',
            'sigla' => 'DF',
            'created_at' => Carbon::now()
        ]);
        Estados::create([
            'estado' => 'Minas Gerais',
            'sigla' => 'MG',
            'created_at' => Carbon::now()
        ]);
        Estados::create([
            'estado' => 'Mato Grosso',
            'sigla' => 'MT',
            'created_at' => Carbon::now()
        ]);
    }
}
