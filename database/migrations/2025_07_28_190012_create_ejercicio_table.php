<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio', function (Blueprint $table) {
            $table->id('id_ejercicio');
            $table->unsignedBigInteger('id_rutina')->nullable();
            $table->string('nombre');
            $table->integer('repeticiones');
            $table->integer('series');
            $table->string('peso')->nullable();
            $table->text('instrucciones')->nullable();
            $table->timestamps();

            $table->foreign('id_rutina')->references('id_rutina')->on('rutina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejercicio');
    }
}
