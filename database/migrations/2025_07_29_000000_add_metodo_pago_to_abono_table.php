<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetodoPagoToAbonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abono', function (Blueprint $table) {
            $table->string('metodo_pago')->default('efectivo')->after('derecho_pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abono', function (Blueprint $table) {
            $table->dropColumn('metodo_pago');
        });
    }
} 