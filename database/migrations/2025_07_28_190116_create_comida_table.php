<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comida', function (Blueprint $table) {
            $table->id('id_comida');
            $table->unsignedBigInteger('id_plan')->nullable();
            $table->string('nombre');
            $table->integer('calorias')->nullable();
            $table->text('ingredientes')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('comida');
    }
}
