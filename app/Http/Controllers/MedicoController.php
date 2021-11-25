<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select('SELECT
            *,
            especialidad.cargo
            FROM
            doctor
            INNER JOIN especialidad ON doctor.area = especialidad.id_especialidad
             where doctor.estado=1');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/doctor/doctor', compact("sql"));
    }

    public function create()
    {
        try {
            $sql = DB::select('select * from especialidad where estado=1');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/doctor/registrar', compact('sql'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cargo' => ['required'],
            'nombre' => ['required']
        ]);
        try {
            $sql = DB::insert('insert into doctor (area,nombre,apellido,telefono,estado) values (?,?,?,?,1)', [
                $request->cargo,
                $request->nombre,
                $request->apellido,
                $request->telefono
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
            $sql = DB::select("select * from doctor where id_doctor=$id");
            $sql2 = DB::select("select * from especialidad where estado=1");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/doctor/actualizar', compact('sql'))->with("sql2", $sql2);
    }
    public function update(Request $request)
    {
        try {
            $sql = DB::update('update doctor set area=?, nombre=?, apellido=?, telefono=? where id_doctor=?', [
                $request->cargo,
                $request->nombre,
                $request->apellido,
                $request->telefono,
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
            $sql = DB::update('update doctor set estado=0 where id_doctor=?', [
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
