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
        Schema::create('lancamento_notas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

            $table->unsignedBigInteger('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            
            $table->unsignedBigInteger('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');

            $table->string('nota_np1')->nullable();
            $table->string('nota_np1_sub')->nullable();
            $table->string('nota_np2')->nullable();
            $table->string('nota_np2_sub')->nullable();
            $table->string('nota_exame')->nullable();
            $table->string('nota_ava')->nullable();
            $table->string('nota_aps')->nullable();
            
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
        Schema::dropIfExists('lancamento_notas');
    }
};
