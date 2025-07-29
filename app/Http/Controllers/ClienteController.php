<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {

        $sql = DB::select(" SELECT
        cliente.id_membresia,
        cliente.tipo_usuario,
        cliente.creado_por,
        cliente.usuario,
        cliente.pago,
        cliente.`password`,
        cliente.dni,
        cliente.debe,
        cliente.nombre,
        cliente.correo,
        cliente.telefono,
        cliente.direccion,
        date(cliente.desde)as 'desde',
        date(cliente.hasta)as 'hasta',
        cliente.DT,
        cliente.DA,
        cliente.DR,
        cliente.foto,
        membresia.nombre AS nomMem,
        membresia.precio,
        cliente.id_cliente
        FROM cliente INNER JOIN membresia ON cliente.id_membresia = membresia.id_membresia ");

        // Obtener membresías para el modal
        $membresia = DB::select("SELECT * FROM membresia");

        return view("vistas/cliente/cliente", compact("sql", "membresia"));
    }
    public function usuariosIndex() {
        $usuarios = DB::table('usuarios')->get();
        return view('vistas.cliente.usuarios', compact('usuarios'));
    }
    
    public function usuariosCreate() {
        return view('vistas.cliente.usuarios.create');
    }
    
    public function usuariosStore(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8',
        ]);
    
        DB::table('usuarios')->insert([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    
        return redirect()->route('usuarios')->with('success', 'Usuario creado exitosamente.');
    }
    

    // Métodos relacionados con pagos
    public function pagosIndex() {
        $pagos = DB::table('pago')->get();
        return view('vistas.cliente.pagos', compact('pagos'));
    }
    
    public function pagosCreate($clienteId) {
        // Busca el cliente por su ID
        $cliente = DB::table('cliente')->where('id_cliente', $clienteId)->first(); // Asegúrate de usar 'id_cliente'
        
        // Verifica si el cliente existe
        if (!$cliente) {
            return back()->with("INCORRECTO", "El cliente no existe");
        }
    
        // Carga la vista con los datos del cliente
        return view('vistas.cliente.pagos.create', compact('cliente'));
    }
    public function pagosStore(Request $request) {
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
            DB::insert('insert into pago (id_cliente, registrado_por, costo_total, paga_con, metodo_pago, fecha) values (?, ?, ?, ?, ?, ?)', [
                $request->idcliente, 
                $nombreUsuario, 
                $request->precio, 
                $request->pagacon,
                $request->metodoPago ?? 'efectivo',
                Carbon::now()
            ]);

            // Actualizar el saldo 'debe' del cliente
            DB::update("update cliente set debe = ? where id_cliente = ?", [
                $request->debe, 
                $request->idcliente
            ]);

            // Actualizar la columna 'pago' del cliente (monto total pagado)
            $clienteActual = DB::table('cliente')->where('id_cliente', $request->idcliente)->first();
            $pagoActual = $clienteActual->pago ?? 0;
            $nuevoPagoTotal = $pagoActual + $request->pagacon;
            
            DB::update("update cliente set pago = ? where id_cliente = ?", [
                $nuevoPagoTotal, 
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
    
    public function store(Request $request)
{
    try {
        $request->validate([
            "membresia" => "required",
            "desde" => "required",
            "hasta" => "required",
            "dias" => "required",
            "dni" => "required|unique:App\Models\Cliente,dni",
            "usuario" => "required|unique:App\Models\Cliente,usuario",
            "password" => "required",
            "nombre" => "required",
            "correo" => [
                "required",
                "email",
                "unique:App\Models\Cliente,correo",
            ],
            "telefono" => "nullable|string",
            "direccion" => "nullable|string",
            "precio" => "required",
            "metodoPago" => "required|in:efectivo,qr",
            "foto" => "mimes:jpg,jpeg,png",
            "acuenta" => "nullable|numeric|min:0"
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }
        return back()->withErrors($e->errors())->withInput();
    }

    $nombreUsuario = Auth::user()->nombre;
    $debe = $request->precio - $request->acuenta;

    // Verificar duplicidad
    $verifificarDuplicidad = DB::select("SELECT count(*) as 'total' FROM cliente WHERE (usuario='$request->usuario' OR dni='$request->dni')");
    
    if ($verifificarDuplicidad[0]->total >= 1) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario o CI ya está en uso'
            ], 422);
        }
        return back()->with("AVISO", "El usuario o CI ya está en uso");
    }

    // Registrar datos del cliente
    try {
        $cliente = new Cliente();
        $cliente->id_membresia = $request->membresia;
        $cliente->tipo_usuario = 'cliente';
        $cliente->creado_por = $nombreUsuario;
        $cliente->usuario = $request->usuario;
        $cliente->password = md5($request->password);
        $cliente->dni = $request->dni;
        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->desde = $request->desde;
        $cliente->hasta = $request->hasta;
        $cliente->DT = $request->dias;
        $cliente->DA = 0;
        $cliente->DR = $request->dias;
        $cliente->debe = $debe;
        $cliente->pago = $request->acuenta ?? 0;
        $cliente->save();
        
        $id_registro = $cliente->id_cliente;
        
        // Manejo de la imagen
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto/usuario'), $nombreFoto);
            
            // Actualizar el registro con el nombre de la foto
            $cliente->foto = $nombreFoto;
            $cliente->save();
        }

        // Registrar el pago
        // Siempre registrar el pago, incluso si acuenta es 0
        $pagoData = [
            'id_cliente' => $id_registro,
            'registrado_por' => $nombreUsuario,
            'costo_total' => $request->precio,
            'paga_con' => $request->acuenta ?? 0,
            'metodo_pago' => $request->metodoPago,
            'fecha' => Carbon::now()
        ];
        
        DB::table('pago')->insert($pagoData);
        
        // Log para debug
        \Log::info('Pago registrado:', $pagoData);
        
        // Registrar abono solo si el monto pagado es mayor a 0
        if (($request->acuenta ?? 0) > 0) {
            $abonoData = [
                'monto' => $request->acuenta,
                'id_cliente' => $id_registro,
                'fecha' => Carbon::now(),
                'recepcionista' => $nombreUsuario,
                'derecho_pago' => 'Matricula',
                'metodo_pago' => $request->metodoPago ?? 'efectivo'
            ];
            
            DB::table('abono')->insert($abonoData);
            
            // Log para debug
            \Log::info('Abono registrado:', $abonoData);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cliente registrado correctamente'
            ]);
        }
        
        return back()->with("CORRECTO", "Cliente registrado correctamente");
        
    } catch (\Throwable $th) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar cliente'
            ], 500);
        }
        return back()->with("INCORRECTO", "Error al registrar");
    }
}

    public function show($id_cliente) // Cambia $id por $id_cliente
    {
        $sql = DB::select("SELECT *, DATE(desde) AS 'Ndesde', DATE_ADD(DATE(hasta), INTERVAL 1 DAY) AS 'Nhasta' FROM cliente WHERE id_cliente = ?", [
            $id_cliente // Asegúrate de usar id_cliente aquí
        ]);

        if (count($sql) <= 0) {
            return back()->with("INCORRECTO", "El cliente no existe");
        }

        $currentDate = date('Y-m-d');
        $Nhasta = null; // Inicializa Nhasta

        foreach ($sql as $row) {
            $Nhasta = $row->Nhasta;

            if ($Nhasta < $currentDate) {
                $Nhasta = date('Y-m-d'); // Asignar el valor del día actual a Nhasta
            }

            // Resto de tu lógica aquí
        }

        // Obtener membresía
        $membresia = DB::select("SELECT * FROM membresia");

        return view('vistas/cliente/renovar', compact('sql'))->with("membresia", $membresia)->with("hasta", $Nhasta);
    }
    public function verificar(Request $request)
{
    $cliente = DB::table('cliente')
        ->where('correo', $request->correo) // Verifica por correo
        ->orWhere('dni', $request->dni)
        ->first();

    if ($cliente) {
        return response()->json(['existe' => true]);
    }

    return response()->json(['existe' => false]);
}
    public function edit($id)
    {
        try {
            // Verificar si el cliente existe
            $cliente = DB::select("select * from cliente where id_cliente=?", [$id]);
            
            if (empty($cliente)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no encontrado'
                ], 404);
            }

            $verificarAsistencia = DB::select("select count(*) as 'total' from asistencia where id_cliente=?", [$id]);

            if ($verificarAsistencia[0]->total >= 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'El cliente ya tiene registrada su asistencia, por lo que ya no puedes modificar datos de la membresía'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'cliente' => $cliente[0]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los datos del cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        \Log::info('Iniciando actualización de cliente', [
            'id' => $id,
            'request_data' => $request->all()
        ]);
        
        try {
            // Validación básica
            $request->validate([
                "dni" => "required",
                "usuario" => "required",
                "nombre" => "required",
                "correo" => "required|email",
            ]);

            // Actualización simple
            $result = DB::update("UPDATE cliente SET usuario = ?, dni = ?, nombre = ?, correo = ?, telefono = ?, direccion = ? WHERE id_cliente = ?", [
                $request->usuario,
                $request->dni,
                $request->nombre,
                $request->correo,
                $request->telefono ?: '',
                $request->direccion ?: '',
                $id
            ]);

            \Log::info('Resultado de actualización', [
                'result' => $result
            ]);

            if ($result >= 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cliente actualizado correctamente'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el cliente'
                ], 500);
            }

        } catch (\Exception $e) {
            \Log::error('Error al actualizar cliente', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editarDatosCliente(Request $request)
    {

        $request->validate([
            "dni" => "required",
            "usuario" => "required",
            "nombre" => "required",
            "correo" => "required",
            "idcliente" => "required",
        ]);
        $id = $request->idcliente;

        $verifificarDuplicidad = DB::select(" select count(*) as 'total' from cliente where (usuario='$request->usuario' or dni='$request->dni' or correo='$request->correo') and id_cliente!=$id");
        if ($verifificarDuplicidad[0]->total >= 1) {
            return back()->with("AVISO", "El usuario, DNI o Correo ya está en uso");
        }


        try {
            $sql = DB::update("update cliente set usuario=?, dni=?, nombre=?,correo=?,telefono=?, direccion=? where id_cliente=?", [
                $request->usuario, $request->dni, $request->nombre, $request->correo,
                $request->telefono, $request->direccion, $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Cliente actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {
        try {
            $sql = DB::delete("delete from cliente where id_cliente=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Cliente eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }


    public function consultar($id_membresia, $desde)
    {

        $consultarMes = DB::select(" select meses,modo,precio from membresia where id_membresia=$id_membresia ");
        $meses = $consultarMes[0]->meses;
        $modo = $consultarMes[0]->modo;
        $precio = $consultarMes[0]->precio;

        //calcular fecha final
        $fechaInicial = Carbon::createFromFormat('Y-m-d', $desde);
        $fechaFinal = $fechaInicial->copy()->addMonths($meses); // sumar los meses a la fecha inicial y crear una copia del objeto
        $fechaFinalISO = $fechaFinal->toDateString(); // obtener la fecha final en formato "yyyy-mm-dd"

        //calcular dias transcurridos
        $diasPasados = $fechaInicial->diffInDays($fechaFinalISO) + 1;

        //calcular cuantos domindos tiene las fechas de inicio y fin
        $domingos = 0;
        $fechaInicio = $fechaInicial;
        $fechaFin = $fechaFinalISO;
        while ($fechaInicio <= $fechaFin) {
            if ($fechaInicio->dayOfWeek == Carbon::SUNDAY) {
                $domingos++;
            }
            $fechaInicio->addDay();
        }

        $dias = $diasPasados - $domingos;

        $mesBase = $dias;
        if ($modo == "diario") {
            $diasTotales = ($dias+1);
        } else {
            if ($modo == "interdiario") {
                $diasTotales = ($mesBase / 2);
                //si $diasTotales es decimal, redondear hacia arriba
                if (fmod($diasTotales, 1) != 0) {
                    $diasTotales = ceil($diasTotales);
                }
                $diasTotales = $diasTotales * $meses + 1;
            }
        }



        return response()->json(['respuesta' => $fechaFinalISO, "dias" => $diasTotales, "precio" => $precio], 200);
    }

    public function consultarPrecio($id_membresia)
    {
        try {
            $membresia = DB::select("SELECT precio FROM membresia WHERE id_membresia = ?", [$id_membresia]);
            
            if (empty($membresia)) {
                return response()->json(['error' => 'Membresía no encontrada'], 404);
            }
            
            return response()->json(['precio' => $membresia[0]->precio], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al consultar precio'], 500);
        }
    }

    public function verificarDuplicados(Request $request)
    {
        try {
            $request->validate([
                'dni' => 'required',
                'usuario' => 'required',
                'correo' => 'required|email'
            ]);

            $errors = [];
            
            // Verificar DNI
            $dniExists = DB::table('cliente')->where('dni', $request->dni)->exists();
            if ($dniExists) {
                $errors['dni'] = 'El DNI ya está registrado';
            }
            
            // Verificar usuario
            $usuarioExists = DB::table('cliente')->where('usuario', $request->usuario)->exists();
            if ($usuarioExists) {
                $errors['usuario'] = 'El usuario ya está registrado';
            }
            
            // Verificar correo
            $correoExists = DB::table('cliente')->where('correo', $request->correo)->exists();
            if ($correoExists) {
                $errors['correo'] = 'El correo ya está registrado';
            }
            
            if (empty($errors)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Todos los datos son únicos'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => $errors
                ], 422);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación en los datos enviados',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function consultarPagos($id_cliente)
    {
        try {
            // Consultar pagos del cliente (excluir pagos incorrectos de S/. 50.00)
            $pagos = collect(); // Inicializar como colección vacía
            
            try {
                $pagos = DB::table('pago')
                    ->where('id_cliente', $id_cliente)
                    ->where('costo_total', '!=', 50) // Excluir pagos incorrectos
                    ->orderBy('fecha', 'desc')
                    ->get();
            } catch (\Exception $e) {
                // Si la tabla pago no existe, usar colección vacía
                \Log::info('Tabla pago no existe o error: ' . $e->getMessage());
            }
            
            // Consultar abonos del cliente
            $abonos = DB::table('abono')
                ->where('id_cliente', $id_cliente)
                ->orderBy('fecha', 'desc')
                ->get();
            
            return response()->json([
                'success' => true,
                'pagos' => $pagos,
                'abonos' => $abonos,
                'total_pagos' => $pagos->count(),
                'total_abonos' => $abonos->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al consultar pagos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verificarColumnaPago()
    {
        try {
            // Consultar todos los clientes con su información de pago
            $clientes = DB::table('cliente')
                ->select('id_cliente', 'nombre', 'pago', 'debe')
                ->where('tipo_usuario', 'cliente')
                ->get();
            
            $resumen = [
                'total_clientes' => $clientes->count(),
                'clientes_con_pago' => $clientes->where('pago', '>', 0)->count(),
                'clientes_sin_pago' => $clientes->where('pago', '=', 0)->count(),
                'clientes_con_deuda' => $clientes->where('debe', '>', 0)->count(),
                'clientes_sin_deuda' => $clientes->where('debe', '=', 0)->count(),
                'detalle_clientes' => $clientes
            ];
            
            return response()->json([
                'success' => true,
                'resumen' => $resumen
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar columna pago',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verificarTimestamps()
    {
        try {
            // Consultar clientes con timestamps
            $clientes = DB::table('cliente')
                ->select('id_cliente', 'nombre', 'created_at', 'updated_at')
                ->where('tipo_usuario', 'cliente')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
            
            $resumen = [
                'total_clientes' => $clientes->count(),
                'clientes_con_timestamps' => $clientes->where('created_at', '!=', null)->count(),
                'clientes_sin_timestamps' => $clientes->where('created_at', '=', null)->count(),
                'ultimos_clientes' => $clientes
            ];
            
            return response()->json([
                'success' => true,
                'resumen' => $resumen
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar timestamps',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function renovar(Request $request, $id_cliente)
    {
        $request->validate([
            "membresia" => "required",
            "id_cliente" => "required",
            "precio" => "required",
            "desde" => "required",
            "hasta" => "required",
            "dias" => "required",
            "debe" => "required",
            "total" => "required",
            "acuenta" => "numeric",
            "pagoRestante" => "numeric"
        ]);

        $nombreUsuario = Auth::user()->nombre;
        $debe = $request->total - $request->acuenta;

        //aqui por el momento no se modifica el campo "desde"
        try {
            $actualizar = DB::update("update cliente set id_membresia=?, hasta=?, DT=?,DA=?,DR=?, debe=? where id_cliente=?", [
                $request->membresia,
                $request->hasta, $request->dias,
                0, $request->dias, $debe,
                $request->id_cliente
            ]);
        } catch (\Throwable $th) {
            $actualizar = 0;
        }

        //ahora verificamos si el monto de acuenta es > 0, entoces registramos en la tabla abonos
        if ($request->acuenta > 0) {
            try {
                $id_registro_abono = DB::table('abono')->insertGetId([
                    'monto' => $request->acuenta,
                    'id_cliente' => $request->id_cliente,
                    'fecha' => Carbon::now(),
                    'recepcionista' => $nombreUsuario,
                    'derecho_pago' => "Renovación",
                    'metodo_pago' => $request->metodoPago ?? 'efectivo'
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }


        if ($actualizar == 1) {
            return redirect()->route("cliente.index")->with("CORRECTO", "La renovación se realizó con exito");
        } else {
            return redirect()->route("cliente.index")->with("INCORRECTO", "Error, intente nuevamente");
        }
    }

    public function datosCliente($id)
    {
        $datos = DB::select("select * from cliente where id_cliente=?", [$id]);

        //mas datos para mostrar el calendario
        $sql = DB::select("select date(desde) as 'desde', date(hasta) as 'hasta' from cliente where tipo_usuario='cliente' and id_cliente=?", [
            $id
        ]);

        $asistencias = DB::select("select *, DATE_FORMAT(fecha_hora, '%Y-%m-%d') as fecha,DATE_FORMAT(fecha_hora, '%h:%i:%s %p') as hora from asistencia where id_cliente=?", [
            $id
        ]);

        $entrada = null;
        $salida = null;
        foreach ($sql as $event) {
            $entrada = $event->desde;
            $salida = $event->hasta;
        }

        return view("vistas/cliente/show", compact("datos"))->with("desde", $entrada)->with("hasta", $salida)->with("asistencias", $asistencias);
    }

    public function transaccionCliente($id)
    {
        $datos = DB::select("select * from cliente where id_cliente=?", [$id]);

        //consulta de abonos
        $abonos = DB::select("SELECT
        abono.id_abono,
        abono.monto,
        abono.id_cliente,
        abono.fecha,
        abono.recepcionista,
        abono.derecho_pago,
        cliente.tipo_usuario,
        membresia.nombre,
        membresia.categoria,
        cliente.pago,
        cliente.debe,
        membresia.precio,
        cliente.id_cliente,
        date(cliente.desde) as 'desde',
        date(cliente.hasta) as 'hasta'
        FROM
        abono
        INNER JOIN cliente ON abono.id_cliente = cliente.id_cliente
        INNER JOIN membresia ON cliente.id_membresia = membresia.id_membresia
        where cliente.id_cliente=$id
        ");

        //consulta de pagos
        $pagos = DB::select("SELECT
        pago.id_pago,
        pago.id_cliente,
        pago.registrado_por,
        pago.costo_total,
        pago.paga_con,
        pago.metodo_pago,
        pago.fecha,
        cliente.nombre,
        cliente.dni
        FROM
        pago
        INNER JOIN cliente ON pago.id_cliente = cliente.id_cliente
        where cliente.id_cliente=$id
        ORDER BY pago.fecha DESC
        ");

        return view("vistas/cliente/transacciones", compact("datos", "abonos", "pagos"));
    }

    public function pagoCliente($id_cliente)
    {
        $datos = DB::select(" SELECT
        cliente.id_membresia,
        cliente.tipo_usuario,
        cliente.creado_por,
        cliente.usuario,
        cliente.pago,
        cliente.`password`,
        cliente.dni,
        cliente.debe,
        cliente.nombre,
        cliente.correo,
        cliente.telefono,
        cliente.direccion,
        date(cliente.desde)as 'desde',
        date(cliente.hasta)as 'hasta',
        cliente.DT,
        cliente.DA,
        cliente.DR,
        cliente.foto,
        membresia.nombre AS nomMem,
        membresia.precio,
        cliente.id_cliente
        FROM cliente INNER JOIN membresia ON cliente.id_membresia = membresia.id_membresia WHERE id_cliente=$id_cliente");
        return view("vistas/cliente/pago", compact("datos"));
    }
    
    public function asistenciasCliente($id)
    {
        // Obtener datos del cliente
        $datos = DB::select("select * from cliente where id_cliente=?", [$id]);
        
        // Obtener fechas de membresía
        $sql = DB::select("select date(desde) as 'desde', date(hasta) as 'hasta' from cliente where tipo_usuario='cliente' and id_cliente=?", [$id]);
        
        // Obtener asistencias
        $asistencias = DB::select("select *, DATE_FORMAT(fecha_hora, '%Y-%m-%d') as fecha,DATE_FORMAT(fecha_hora, '%h:%i:%s %p') as hora from asistencia where id_cliente=?", [$id]);
        
        $entrada = null;
        $salida = null;
        foreach ($sql as $event) {
            $entrada = $event->desde;
            $salida = $event->hasta;
        }
        
        // Preparar eventos para FullCalendar
        $eventos = [];
        foreach ($asistencias as $asistencia) {
            $eventos[] = [
                'title' => $asistencia->hora,
                'start' => $asistencia->fecha
            ];
        }
        
        return response()->json([
            'eventos' => $eventos,
            'desde' => $entrada,
            'hasta' => $salida
        ]);
    }
    
}