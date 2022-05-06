<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Departamentos;

use Carbon\Carbon;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamentos::create([
            'nome_departamento' => 'Administrativo',
            'nivel_acesso' => 2,
            'created_at' => Carbon::now()
        ]);

        Departamentos::create([
            'nome_departamento' => 'Professor',
            'nivel_acesso' => 3,
            'created_at' => Carbon::now()
        ]);

        Departamentos::create([
            'nome_departamento' => 'Estudante',
            'nivel_acesso' => 4,
            'created_at' => Carbon::now()
        ]);
    }
}

