<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_participacion_convocatoria', 50);
            $table->string('tipo_finalidad', 50);
            $table->text('descripcion_finalidad');
            $table->text('titulo');
            $table->text('identificacion_problematica');
            $table->text('descripcion_idea');
            $table->text('justificacion');
            $table->text('resultados_proyectados');
            $table->text('viabilidad_tecnica');
            $table->text('viabilidad_mercado');
            $table->text('viabilidad_economica');
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
        Schema::dropIfExists('ideas');
    }
}
