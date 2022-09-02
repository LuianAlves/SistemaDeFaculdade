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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');

            $table->unsignedBigInteger('grade_curricular_id')->unsigned();
            $table->foreign('grade_curricular_id')->references('id')->on('grade_curriculars')->onDelete('cascade');

            $table->unsignedBigInteger('periodo_escolar_id')->unsigned();
            $table->foreign('periodo_escolar_id')->references('id')->on('periodo_escolars')->onDelete('cascade');

            $table->string('codigo_turma');
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
        Schema::dropIfExists('turmas');
    }
};
