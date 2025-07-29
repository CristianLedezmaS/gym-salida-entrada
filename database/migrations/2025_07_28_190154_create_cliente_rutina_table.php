<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteRutinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_rutina', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_rutina');
            $table->timestamps();

            $table->primary(['id_cliente', 'id_rutina']);
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
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
        Schema::dropIfExists('cliente_rutina');
    }
}
