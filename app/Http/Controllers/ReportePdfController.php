<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->setPaper('a4', 'landscape'); //FORMATO HORIZONTAL
        $pdf->loadView('vistas/reporte-pdf/asistencia', compact('datos'));
        
        return $pdf->stream("reporte de asistencias - $id");
    }

    public function membresiaActiva()
    {
        // Realiza un JOIN entre cliente y membresia para obtener los clientes con membresía activa
        $clientesActivos = DB::table('cliente')
            ->join('membresia', 'cliente.id_membresia', '=', 'membresia.id_membresia')
            ->where('membresia.nombre', 'activo') // Asegúrate de que 'activo' sea el valor correcto en la columna membresia.nombre
            ->select('cliente.*', 'membresia.nombre as membresia_nombre')
            ->get();

        // Generar el PDF con los clientes activos
        $pdf = Pdf::loadView('vistas/reporte-pdf.membresiaActiva', compact('clientesActivos'));

        return $pdf->download('membresia_activas.pdf');
    }

    public function morosos()
    {
        $clientesMorosos = DB::table('cliente')
            ->select('id_cliente', 'nombre', 'correo', 'telefono', 'debe', 'foto')
            ->where('debe', '>', 0)
            ->get();

        $pdf = Pdf::loadView('vistas.reporte-pdf.reportesMorosos', compact('clientesMorosos'));
        return $pdf->download('reporte-morosos.pdf');
    }

    public function registrarIngreso($clienteId)
    {
        // Aquí se hace referencia a la tabla 'pago' en lugar de 'ingresos'
        DB::table('pago')->insert([  // Cambiar 'ingresos' por 'pago'
            'id_cliente' => $clienteId,
            'fecha' => now(),  // Cambiar 'fecha_ingreso' por 'fecha' (ajustar según tu esquema)
            'costo_total' => 0, // Asumiendo que puedes poner un costo total temporal
        ]);

        return back()->with('success', 'Ingreso registrado exitosamente.');
    }

    public function listarIngresos(Request $request)
    {
        // Rango de fechas
        $inicio = $request->input('inicio') ?? now()->startOfMonth()->toDateString();
        $fin = $request->input('fin') ?? now()->endOfMonth()->toDateString();
    
        // Consulta a la base de datos usando la tabla 'pago' en lugar de 'ingresos'
        $ingresos = DB::table('pago')  // Cambiar 'ingresos' por 'pago'
            ->join('cliente', 'pago.id_cliente', '=', 'cliente.id_cliente')
            ->select('cliente.nombre', 'cliente.correo', 'pago.fecha as fecha_ingreso', 'pago.costo_total')
            ->whereBetween('pago.fecha', [$inicio, $fin])
            ->orderBy('pago.fecha', 'asc')
            ->get();
    
        // Retorna la vista
        return view('vistas.reporte-pdf.listaIngresos', compact('ingresos', 'inicio', 'fin'));
    }

    public function exportarIngresosPdf(Request $request)
    {
        // Rango de fechas
        $inicio = $request->input('inicio') ?? now()->startOfMonth()->toDateString();
        $fin = $request->input('fin') ?? now()->endOfMonth()->toDateString();

        // Consulta a la base de datos usando la tabla 'pago' en lugar de 'ingresos'
        $ingresos = DB::table('pago')  // Cambiar 'ingresos' por 'pago'
            ->join('cliente', 'pago.id_cliente', '=', 'cliente.id_cliente')
            ->select('cliente.nombre', 'cliente.correo', 'pago.fecha as fecha_ingreso', 'pago.costo_total')
            ->whereBetween('pago.fecha', [$inicio, $fin])
            ->orderBy('pago.fecha', 'asc')
            ->get();

        // Generar PDF
        $pdf = Pdf::loadView('vistas.reporte-pdf.listaIngresos', compact('ingresos', 'inicio', 'fin'));

        return $pdf->download('ingresos.pdf');
    }

    public function ingresos()
    {
        // Define el mes y año que deseas filtrar
        $month = 11; // Noviembre
        $year = 2024;

        // Obtener los ingresos totales para el mes especificado
        $totalEarnings = DB::table('pago')  // Cambiar 'ingresos' por 'pago'
            ->whereMonth('fecha', $month)
            ->whereYear('fecha', $year)
            ->sum('costo_total');

        // Obtener los detalles de los pagos para el mes especificado
        $ingresos = DB::table('pago')  // Cambiar 'ingresos' por 'pago'
            ->join('cliente', 'pago.id_cliente', '=', 'cliente.id_cliente')
            ->select('cliente.nombre', 'cliente.correo', 'pago.fecha', 'pago.costo_total')
            ->whereMonth('pago.fecha', $month)
            ->whereYear('pago.fecha', $year)
            ->orderBy('pago.fecha', 'asc')
            ->get();

        // Pasar los ingresos totales al PDF
        $pdf = Pdf::loadView('reportes.ingresos', compact('ingresos', 'totalEarnings'));

        return $pdf->download('reporte_ingresos.pdf');
    }
}
