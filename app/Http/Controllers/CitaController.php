<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select('select * from cita where estado=1');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/paciente/paciente', compact("sql"));
    }

    public function create()
    {
        try {
            $sql = DB::select('select * from especialidad where estado=1');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/paciente/registrar', compact('sql'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido' => ['required'],
            'genero' => ['required'],
        ]);
        try {
            $sql = DB::insert('insert into paciente (nombre,apellido,telefono,direccion,genero,estado) values (?,?,?,?,?,1)', [
                $request->nombre,
                $request->apellido,
                $request->telefono,
                $request->direccion,
                $request->genero
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos registrados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al registrar');
        }
    }

    public function edit($id)
    {
        try {
            $sql = DB::select("select * from paciente where id_paciente=$id");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/paciente/actualizar', compact('sql'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido' => ['required'],
            'genero' => ['required'],
        ]);

        try {
            $sql = DB::update('update paciente set nombre=?, apellido=?, telefono=?, direccion=?, genero=? where id_paciente=?', [
                $request->nombre,
                $request->apellido,
                $request->telefono,
                $request->direccion,
                $request->genero,
                $request->id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos modificados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al modificar');
        }
    }
    public function destroy($id)
    {
        try {
            $sql = DB::update('update paciente set estado=0 where id_paciente=?', [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos eliminados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al eliminar');
        }
    }
}
