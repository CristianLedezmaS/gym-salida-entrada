<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportePdfController extends Controller
{
    public function reporteAsistencia(Request $request)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $id = $request->cliente;

        // Validar que $id no sea un objeto stdClass
        if (is_object($id) && get_class($id) == 'stdClass') {
            throw new \Exception("El ID del cliente es un objeto stdClass");
        }

        $datos = DB::select(" SELECT
        asistencia.fecha_hora,
        asistencia.marcado_por,
        cliente.nombre,
        cliente.id_cliente
        FROM
        asistencia
        INNER JOIN cliente ON asistencia.id_cliente = cliente.id_cliente
        WHERE cliente.id_cliente = ?
        ORDER BY fecha_hora ASC", [$id]);
        
        $pdf =\App::make('dompdf.wrapper');
        //$pdf->setPaper('a4', 'landscape'); //FORMATO HORIZONTAL
        $pdf->loadView('vistas/reporte-pdf/asistencia', compact('datos'));
        
        return $pdf->stream("reporte de asistencias - $id");
    }
}
