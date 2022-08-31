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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lancamento_notas_id')->unsigned();
            $table->foreign('lancamento_notas_id')->references('id')->on('lancamentos_notas')->onDelete('cascade');
            
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
        Schema::dropIfExists('notas');
    }
};
