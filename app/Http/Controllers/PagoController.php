<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Membresia;

class PagoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            "idcliente" => "required|integer", 
            "precio" => "required|numeric", 
            "pagacon" => "required|numeric", 
            "debe" => "required|numeric"
        ]);

        $nombreUsuario = Auth::user()->nombre;

        // Iniciar transacción
        DB::beginTransaction();

        try {
            // Insertar en la tabla de pagos
            DB::insert('insert into pago (id_cliente, registrado_por, costo_total, paga_con) values (?, ?, ?, ?)', [
                $request->idcliente, 
                $nombreUsuario, 
                $request->precio, 
                $request->pagacon
            ]);

            // Actualizar el saldo 'debe' del cliente
            DB::update("update cliente set debe = ? where id_cliente = ?", [
                $request->debe, 
                $request->idcliente
            ]);

            // Registrar abono si el monto pagado es mayor a 0
            if ($request->pagacon > 0) {
                DB::table('abono')->insert([
                    'monto' => $request->pagacon,
                    'id_cliente' => $request->idcliente,
                    'fecha' => Carbon::now(),
                    'recepcionista' => $nombreUsuario,
                    'derecho_pago' => 'Matricula'
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Retornar éxito
            return back()->with("CORRECTO", "El pago se realizó con éxito");
        } catch (\Exception $e) {
            // Si ocurre un error, revertir la transacción
            DB::rollBack();
            return back()->with("INCORRECTO", "Error al realizar el pago: " . $e->getMessage());
        }
    }

    /**
     * Mostrar los pagos
     */
    public function mostrarPago()
    {
        // Recuperar los clientes activos junto con las membresías
        $clientesActivos = DB::table('clientes')
            ->join('membresias', 'clientes.membresia_id', '=', 'membresias.id')
            ->where('clientes.activo', 1)  // Filtrar solo clientes activos
            ->select('clientes.nombre', 'clientes.telefono', 'membresias.nombre as membresia_nombre')
            ->get();

        // Verificar que los datos están siendo recuperados correctamente
        dd($clientesActivos); // Esto mostrará los datos recuperados en pantalla

        // Si los datos son correctos, pasa los datos a la vista
        return view('vistas.cliente.pago', compact('clientesActivos'));
    }
}
