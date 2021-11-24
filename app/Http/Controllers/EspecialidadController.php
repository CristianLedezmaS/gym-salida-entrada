<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecialidadController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select('select * from especialidad');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/especialidad/especialidad', compact("sql"));
    }

    public function create()
    {
        return view('vistas/especialidad/registrar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'unique:App\Models\especialidad,cargo']
        ]);
        try {
            $sql = DB::insert('insert into especialidad (cargo,estado) values (?,1)', [
                $request->nombre
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
            $sql = DB::select("select * from especialidad where id_especialidad=$id");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/especialidad/actualizar', compact('sql'));
    }
    public function update(Request $request)
    {

        $datos = DB::select("select count(*) as 'total' from especialidad where cargo='$request->nombre' and id_especialidad!=$request->id  ");
        if ($datos[0]->total > 0) {
            return back()->with('DUPLICADO', 'El nombre ya está en uso');
        }

        try {
            $sql = DB::update('update especialidad set cargo=? where id_especialidad=?', [
                $request->nombre,
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
            $sql = DB::update('update especialidad set estado=0 where id_especialidad=?', [
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
