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
        Schema::create('periodo_avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campus_id')->usigned();
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');

            $table->string('inicio_periodo_avaliacoes', 10);
            $table->string('termino_periodo_avaliacoes', 10);
            $table->string('tipo_prova', 30);
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
        Schema::dropIfExists('periodo_avaliacoes');
    }
};
