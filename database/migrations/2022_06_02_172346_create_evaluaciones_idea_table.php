<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones_idea', function (Blueprint $table) {
            $table->id();
            $table->integer('puntaje_total');
            $table->string('conclusion', 50);
            $table->unsignedBigInteger('idea_id');
            $table->unsignedBigInteger('evaluador_id');
            $table->unsignedBigInteger('responsable_revision_id');

            $table->foreign('idea_id')->references('id')->on('ideas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluador_id')->references('id')->on('user_interno')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('responsable_revision_id')->references('id')->on('user_interno')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('evaluaciones_idea');
    }
}
