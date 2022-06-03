<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaEvaluacionIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_evaluacion_idea', function (Blueprint $table) {
            $table->id();
            $table->integer('puntaje');
            $table->string('validacion', 50);
            $table->text('observacion_validacion');
            $table->unsignedBigInteger('pregunta_evaluacion_id');
            $table->unsignedBigInteger('evaluacion_idea_id');

            $table->foreign('pregunta_evaluacion_id')->references('id')->on('preguntas_evaluacion')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluacion_idea_id')->references('id')->on('evaluaciones_idea')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pregunta_evaluacion_idea');
    }
}
