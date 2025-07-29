<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insertar empresa
        DB::table('empresa')->insert([
            'nombre' => 'ATLAS GYM',
            'ubicacion' => 'vinto',
            'telefono' => '7656355',
            'correo' => 'gymatlas@gmail.com',
            'foto' => 'logo.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insertar membresías
        DB::table('membresia')->insert([
            [
                'categoria' => 'maquinas',
                'nombre' => '1 mes',
                'meses' => '1',
                'modo' => 'diario',
                'precio' => '50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'maquinas',
                'nombre' => '12 meses',
                'meses' => '12',
                'modo' => 'diario',
                'precio' => '250',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categoria' => 'maquinas',
                'nombre' => '2 mes',
                'meses' => '2',
                'modo' => 'diario',
                'precio' => '100',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar clientes de ejemplo
        DB::table('cliente')->insert([
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'atlas gym',
                'usuario' => 'richart',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '7854245',
                'nombre' => 'richart',
                'correo' => 'richart@gmail.com',
                'telefono' => '7584245',
                'direccion' => 'vinto',
                'desde' => Carbon::now(),
                'hasta' => Carbon::now()->addMonth(),
                'DT' => 0,
                'DA' => 0,
                'DR' => 0,
                'debe' => '200',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_membresia' => 1,
                'tipo_usuario' => 'cliente',
                'creado_por' => 'atlas gym',
                'usuario' => 'ronald',
                'password' => '202cb962ac59075b964b07152d234b70',
                'dni' => '898559',
                'nombre' => 'ronald',
                'correo' => 'ronald@gmail.com',
                'telefono' => '481448',
                'direccion' => 'v',
                'desde' => Carbon::now(),
                'hasta' => Carbon::now()->addYear(),
                'DT' => 314,
                'DA' => 1,
                'DR' => 313,
                'debe' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar pagos de ejemplo
        DB::table('pago')->insert([
            [
                'id_cliente' => 1,
                'registrado_por' => 'atlas gym',
                'costo_total' => '50',
                'paga_con' => '30',
                'metodo_pago' => 'efectivo',
                'fecha' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_cliente' => 1,
                'registrado_por' => 'atlas gym',
                'costo_total' => '50',
                'paga_con' => '20',
                'metodo_pago' => 'qr',
                'fecha' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar abonos de ejemplo
        DB::table('abono')->insert([
            [
                'monto' => 30.00,
                'id_cliente' => 1,
                'fecha' => Carbon::now()->subDays(5),
                'recepcionista' => 'atlas gym',
                'derecho_pago' => 'Matricula',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'monto' => 20.00,
                'id_cliente' => 1,
                'fecha' => Carbon::now()->subDays(2),
                'recepcionista' => 'atlas gym',
                'derecho_pago' => 'Matricula',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
