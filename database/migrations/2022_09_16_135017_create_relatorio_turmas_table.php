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
        Schema::create('relatorio_turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');

            $table->string('media_notas');
            $table->string('media_faltas');
            $table->string('media_aulas');

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
        Schema::dropIfExists('relatorio_turmas');
    }
};
