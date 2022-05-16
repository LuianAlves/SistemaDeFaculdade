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
            $table->string('inicio_periodo_escolar', 10);
            $table->string('termino_periodo_escolar', 10);
            $table->string('ano_periodo_escolar', 4);
            $table->string('estudantes', 25);
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
