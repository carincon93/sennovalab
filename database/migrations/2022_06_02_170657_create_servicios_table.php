<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion_necesidad');
            $table->string('codigo_servicio', 50);
            $table->unsignedBigInteger('user_externo_id');
            $table->unsignedBigInteger('tipo_servicio_id');
            $table->unsignedBigInteger('linea_desarrollo_id');

            $table->foreign('user_externo_id')->references('id')->on('user_externo')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_servicio_id')->references('id')->on('tipos_servicio')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('linea_desarrollo_id')->references('id')->on('lineas_desarrollo')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('servicios');
    }
}
