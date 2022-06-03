<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_externo', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_cliente', 50);
            $table->string('tipo_usuario', 50);
            $table->string('empresa_centro_formacion', 100);
            $table->string('nit_rut', 50);
            $table->smallInteger('digito_verificacion');
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
        Schema::dropIfExists('user_externo');
    }
}
