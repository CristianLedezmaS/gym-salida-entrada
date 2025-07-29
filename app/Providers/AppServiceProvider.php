<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // Verificar si las tablas existen antes de hacer consultas
            if (DB::getSchemaBuilder()->hasTable('membresia')) {
                $totalMembresia = DB::select(" select count(*) as 'total_membresia' from membresia ");
                View::share('totalMembresia', $totalMembresia[0]->total_membresia);
            } else {
                View::share('totalMembresia', 0);
            }

            if (DB::getSchemaBuilder()->hasTable('cliente')) {
                $totalCliente = DB::select(" select count(*) as 'total_cliente' from cliente where tipo_usuario='cliente' ");
                View::share('totalCliente', $totalCliente[0]->total_cliente);

                $totalUsuario = DB::select(" select count(*) as 'total_usuario' from cliente where tipo_usuario!='cliente' ");
                View::share('totalUsuario', $totalUsuario[0]->total_usuario);
            } else {
                View::share('totalCliente', 0);
                View::share('totalUsuario', 0);
            }

            if (DB::getSchemaBuilder()->hasTable('asistencia')) {
                $fechaActual = Carbon::now()->toDateString();
                $totalAsistencia = DB::select("SELECT COUNT(*) AS total_asistencia FROM asistencia WHERE DATE(fecha_hora) = '{$fechaActual}'");
                View::share('totalAsistencia', $totalAsistencia[0]->total_asistencia);
            } else {
                View::share('totalAsistencia', 0);
            }

            //consultas para mostrar tabla de renovacion y cuentas por cobrar
            if (DB::getSchemaBuilder()->hasTable('cliente') && DB::getSchemaBuilder()->hasTable('membresia')) {
                $miembrosPorRenovar = DB::select(' SELECT cliente.id_cliente,cliente.nombre,cliente.foto,DATEDIFF(hasta, now()) AS diferencia_fechas,membresia.precio,membresia.modo
                FROM cliente INNER JOIN membresia ON cliente.id_membresia = membresia.id_membresia
                where tipo_usuario="cliente" and (select DATEDIFF(hasta, now()) AS diferencia_fechas)<=10 order by diferencia_fechas desc ');
                View::share('miembrosPorRenovar', $miembrosPorRenovar);

                $cuentasPorCobrar = DB::select(" SELECT cliente.id_cliente,cliente.nombre,debe,cliente.foto,DATEDIFF(now(),desde) AS diferencia_fechas,membresia.nombre as 'nomMem',membresia.precio,membresia.modo
                FROM cliente INNER JOIN membresia ON cliente.id_membresia = membresia.id_membresia
                where debe>0 order by diferencia_fechas desc
                 ");
                View::share('cuentasPorCobrar', $cuentasPorCobrar);
            } else {
                View::share('miembrosPorRenovar', []);
                View::share('cuentasPorCobrar', []);
            }
        } catch (\Exception $e) {
            // Si hay algún error, establecer valores por defecto
            View::share('totalMembresia', 0);
            View::share('totalCliente', 0);
            View::share('totalUsuario', 0);
            View::share('totalAsistencia', 0);
            View::share('miembrosPorRenovar', []);
            View::share('cuentasPorCobrar', []);
        }
    }
}
