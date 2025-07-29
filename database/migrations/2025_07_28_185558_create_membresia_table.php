<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membresia', function (Blueprint $table) {
            $table->id('id_membresia');
            $table->string('categoria')->default('');
            $table->string('nombre')->nullable();
            $table->string('meses')->nullable();
            $table->string('modo')->nullable();
            $table->string('precio')->nullable();
            $table->timestamps();
        });

        // Insertar datos iniciales de membresías
        DB::table('membresia')->insert([
            [
                'categoria' => 'maquinas',
                'nombre' => '1 mes',
                'meses' => '1',
                'modo' => 'diario',
                'precio' => '50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria' => 'maquinas',
                'nombre' => '12 meses',
                'meses' => '12',
                'modo' => 'diario',
                'precio' => '250',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria' => 'maquinas',
                'nombre' => '2 mes',
                'meses' => '2',
                'modo' => 'diario',
                'precio' => '100',
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
        Schema::dropIfExists('membresia');
    }
}
