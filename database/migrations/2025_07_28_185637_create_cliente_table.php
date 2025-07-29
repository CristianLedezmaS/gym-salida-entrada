<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->unsignedBigInteger('id_membresia')->nullable();
            $table->string('tipo_usuario')->nullable();
            $table->string('creado_por')->default('');
            $table->string('usuario')->default('');
            $table->string('password')->default('');
            $table->string('dni')->nullable();
            $table->string('nombre')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->datetime('desde')->nullable();
            $table->datetime('hasta')->nullable();
            $table->integer('DT')->nullable();
            $table->integer('DA')->nullable();
            $table->integer('DR')->nullable();
            $table->string('foto')->default('');
            $table->string('pago')->nullable();
            $table->string('debe')->nullable();
            $table->string('codigo')->nullable();
            $table->string('nfc_id')->nullable();
            $table->timestamps();

            $table->foreign('id_membresia')->references('id_membresia')->on('membresia')->onDelete('cascade')->onUpdate('cascade');
        });

        // Insertar administrador por defecto
        DB::table('cliente')->insert([
            [
                'tipo_usuario' => 'administrador',
                'creado_por' => 'sistema',
                'usuario' => 'admin',
                'password' => '202cb962ac59075b964b07152d234b70', // admin en MD5
                'dni' => '00000000',
                'nombre' => 'Administrador',
                'correo' => 'admin@gym.com',
                'telefono' => '000000000',
                'direccion' => 'Sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insertar clientes de ejemplo
        DB::table('cliente')->insert([
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'admin',
                'usuario' => 'richart',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '7854245',
                'nombre' => 'Richart López',
                'correo' => 'richart@gmail.com',
                'telefono' => '7584245',
                'direccion' => 'Vinto, Cochabamba',
                'desde' => now(),
                'hasta' => now()->addMonth(),
                'DT' => 30,
                'DA' => 0,
                'DR' => 30,
                'debe' => '150',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'admin',
                'usuario' => 'maria',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '12345678',
                'nombre' => 'María González',
                'correo' => 'maria@gmail.com',
                'telefono' => '7123456',
                'direccion' => 'Quillacollo, Cochabamba',
                'desde' => now(),
                'hasta' => now()->addMonth(),
                'DT' => 30,
                'DA' => 0,
                'DR' => 30,
                'debe' => '75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'admin',
                'usuario' => 'carlos',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '87654321',
                'nombre' => 'Carlos Mendoza',
                'correo' => 'carlos@gmail.com',
                'telefono' => '7654321',
                'direccion' => 'Sacaba, Cochabamba',
                'desde' => now(),
                'hasta' => now()->addMonth(),
                'DT' => 30,
                'DA' => 0,
                'DR' => 30,
                'debe' => '200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'admin',
                'usuario' => 'ana',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '11223344',
                'nombre' => 'Ana Silva',
                'correo' => 'ana@gmail.com',
                'telefono' => '7112233',
                'direccion' => 'Tiquipaya, Cochabamba',
                'desde' => now(),
                'hasta' => now()->addMonth(),
                'DT' => 30,
                'DA' => 0,
                'DR' => 30,
                'debe' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'admin',
                'usuario' => 'juan',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '55667788',
                'nombre' => 'Juan Pérez',
                'correo' => 'juan@gmail.com',
                'telefono' => '7556677',
                'direccion' => 'Colcapirhua, Cochabamba',
                'desde' => now(),
                'hasta' => now()->addMonth(),
                'DT' => 30,
                'DA' => 0,
                'DR' => 30,
                'debe' => '0',
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
        Schema::dropIfExists('cliente');
    }
}
