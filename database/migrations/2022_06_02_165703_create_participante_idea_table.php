<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_idea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_interno_id');
            $table->unsignedBigInteger('idea_id');

            $table->foreign('idea_id')->references('id')->on('ideas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_interno_id')->references('id')->on('user_interno')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('participante_idea');
    }
}
