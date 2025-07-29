<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePlanAlimentacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_plan_alimentacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_plan');
            $table->timestamps();

            $table->primary(['id_cliente', 'id_plan']);
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->foreign('id_plan')->references('id_plan')->on('plan_alimentacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_plan_alimentacion');
    }
}
