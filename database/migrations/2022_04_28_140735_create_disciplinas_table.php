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
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('area_conhecimento_id')->unsigned();
            $table->foreign('area_conhecimento_id')->references('id')->on('classificacao_cursos')->onDelete('cascade');

            $table->string('codigo_disciplina');
            $table->string('disciplina');
            $table->string('modalidade');
            $table->string('duracao_horas');

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
        Schema::dropIfExists('disciplinas');
    }
};
