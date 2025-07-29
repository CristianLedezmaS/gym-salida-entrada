<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->string('registrado_por')->default('');
            $table->string('costo_total')->nullable();
            $table->string('paga_con')->nullable();
            $table->string('metodo_pago')->default('efectivo'); // Nuevo campo para método de pago
            $table->datetime('fecha')->nullable();
            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade')->onUpdate('cascade');
        });

        // Insertar datos de ejemplo para mostrar métodos de pago
        DB::table('pago')->insert([
            [
                'id_cliente' => 1,
                'registrado_por' => 'admin',
                'costo_total' => '50',
                'paga_con' => '30',
                'metodo_pago' => 'efectivo',
                'fecha' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_cliente' => 1,
                'registrado_por' => 'admin',
                'costo_total' => '50',
                'paga_con' => '20',
                'metodo_pago' => 'qr',
                'fecha' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago');
    }
}
