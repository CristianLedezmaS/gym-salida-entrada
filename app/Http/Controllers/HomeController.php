<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        QrCode::size(500)->format("png")->generate(route("marcar.qr"), "../public/qr/qrcode.png");

        // Verificar si las tablas existen antes de hacer consultas
        try {
            // Estadísticas generales
            $totalMembresia = DB::table('membresia')->count();
            $totalCliente = DB::table('cliente')->where('tipo_usuario', 'cliente')->count();
            $totalUsuario = DB::table('cliente')->where('tipo_usuario', '!=', 'cliente')->count();
            $totalAsistencia = DB::table('asistencia')
                ->whereDate('fecha_hora', today())
                ->count();

            // Miembros por renovar
            $miembrosPorRenovar = DB::table('cliente')
                ->join('membresia', 'cliente.id_membresia', '=', 'membresia.id_membresia')
                ->select(
                    'cliente.id_cliente',
                    'cliente.nombre',
                    'cliente.foto',
                    'membresia.modo',
                    'membresia.precio',
                    DB::raw('DATEDIFF(cliente.hasta, CURDATE()) as diferencia_fechas')
                )
                ->where('cliente.tipo_usuario', 'cliente')
                ->whereNotNull('cliente.hasta')
                ->orderBy('diferencia_fechas', 'asc')
                ->get();

            // Cuentas por cobrar
            $cuentasPorCobrar = DB::table('cliente')
                ->join('membresia', 'cliente.id_membresia', '=', 'membresia.id_membresia')
                ->select(
                    'cliente.id_cliente',
                    'cliente.nombre',
                    'cliente.foto',
                    'cliente.debe',
                    'membresia.modo',
                    DB::raw('DATEDIFF(cliente.hasta, CURDATE()) as diferencia_fechas')
                )
                ->where('cliente.tipo_usuario', 'cliente')
                ->where('cliente.debe', '>', 0)
                ->whereNotNull('cliente.hasta')
                ->orderBy('cliente.debe', 'desc')
                ->get();

        } catch (\Exception $e) {
            // Si hay error, usar valores por defecto
            $totalMembresia = 0;
            $totalCliente = 0;
            $totalUsuario = 0;
            $totalAsistencia = 0;
            $miembrosPorRenovar = collect();
            $cuentasPorCobrar = collect();
        }

        return view('home', compact(
            'totalMembresia',
            'totalCliente', 
            'totalUsuario',
            'totalAsistencia',
            'miembrosPorRenovar',
            'cuentasPorCobrar'
        ));
    }
}
