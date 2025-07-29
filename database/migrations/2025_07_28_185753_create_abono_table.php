<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abono', function (Blueprint $table) {
            $table->id('id_abono');
            $table->decimal('monto', 10, 2)->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->datetime('fecha')->nullable();
            $table->string('recepcionista')->nullable();
            $table->string('derecho_pago')->nullable();
            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abono');
    }
}
