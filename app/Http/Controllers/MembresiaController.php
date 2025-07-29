<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembresiaController extends Controller
{
    public function index()
    {
        // Usar DB::table() para construir la consulta y paginar
        $datos = DB::table('membresia')->orderBy('id_membresia', 'desc')->paginate(10);

        return view('vistas/membresia/membresia', compact('datos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "categoria" => "required",
            "nombre" => "required",
            "mes" => "required",
            "modo" => "required",
            "precio" => "required",
        ]);

        $verifificarDuplicidad = DB::select("SELECT count(*) as 'total' FROM membresia WHERE categoria='$request->categoria' AND nombre='$request->nombre'");
        if ($verifificarDuplicidad[0]->total >= 1) {
            return back()->with("AVISO", "El nombre y categoría de la Membresía ya existe");
        }

        try {
            $sql = DB::insert("INSERT INTO membresia (categoria, nombre, meses, modo, precio) VALUES (?, ?, ?, ?, ?)", [
                $request->categoria,
                $request->nombre,
                $request->mes,
                $request->modo,
                $request->precio,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Membresía registrada correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "categoria" => "required",
            "nombre" => "required",
            "mes" => "required",
            "modo" => "required",
            "precio" => "required",
        ]);

        $verifificarDuplicidad = DB::select("SELECT count(*) as 'total' FROM membresia WHERE categoria='$request->categoria' AND nombre='$request->nombre' AND id_membresia!=$id");
        if ($verifificarDuplicidad[0]->total >= 1) {
            return back()->with("AVISO", "El nombre y categoría de la Membresía ya existe");
        }

        try {
            $sql = DB::update("UPDATE membresia SET categoria=?, nombre=?, meses=?, modo=?, precio=? WHERE id_membresia=?", [
                $request->categoria,
                $request->nombre,
                $request->mes,
                $request->modo,
                $request->precio,
                $id
            ]);

            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Membresía actualizada correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }

    public function destroy($id)
    {
        // Verificar si hay clientes usando esta membresía
        $clientesUsandoMembresia = DB::select("SELECT COUNT(*) as total FROM cliente WHERE id_membresia = ?", [$id]);
        
        if ($clientesUsandoMembresia[0]->total > 0) {
            return back()->with("AVISO", "No se puede eliminar esta membresía porque hay " . $clientesUsandoMembresia[0]->total . " cliente(s) registrado(s) con esta membresía. Primero debes cambiar la membresía de estos clientes.");
        }

        try {
            $sql = DB::delete("DELETE FROM membresia WHERE id_membresia=?", [$id]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Membresía eliminada correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}


