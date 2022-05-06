<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_escolars', function (Blueprint $table) {
            $table->id();
            $table->string('inicio_periodo_escolar');
            $table->string('termino_periodo_escolar');
            $table->string('ano_periodo_escolar');
            $table->string('estudantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo_escolars');
    }
};
