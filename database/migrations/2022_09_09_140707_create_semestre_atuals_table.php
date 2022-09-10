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
        Schema::create('semestre_atuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
            
            $table->unsignedBigInteger('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            
            $table->unsignedBigInteger('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');

            $table->string('semestre_lecionado');
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
        Schema::dropIfExists('semestre_atuals');
    }
};
