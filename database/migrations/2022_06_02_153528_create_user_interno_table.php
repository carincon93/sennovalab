<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_interno', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_usuario', 50);
            $table->string('tipo_afiliacion', 50);
            $table->string('numero_contrato', 100)->nullable();
            $table->date('fecha_inicio_contrato')->nullable();
            $table->date('fecha_finalizacion_contrato')->nullable();
            $table->text('firma_digital');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_interno');
    }
}
