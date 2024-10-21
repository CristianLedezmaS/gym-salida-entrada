<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use Illuminate\Http\Request;

class RutinaController extends Controller
{
    public function index()
    {
        $rutinas = Rutina::all();
        return view('rutinas.index', compact('rutinas'));
    }

    public function create()
    {
        return view('rutinas.create');
    }

    public function store(Request $request)
    {
        Rutina::create($request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]));

        return redirect()->route('rutinas.index')->with('success', 'Rutina creada exitosamente.');
    }

    public function edit($id)
    {
        $rutina = Rutina::findOrFail($id);
        return view('rutinas.edit', compact('rutina'));
    }

    public function update(Request $request, $id)
    {
        $rutina = Rutina::findOrFail($id);
        $rutina->update($request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]));

        return redirect()->route('rutinas.index')->with('success', 'Rutina actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $rutina = Rutina::findOrFail($id);
        $rutina->delete();

        return redirect()->route('rutinas.index')->with('success', 'Rutina eliminada exitosamente.');
    }

    // Método para mostrar la vista "registrar"
    public function seleccionarGenero()
    {
        return view('rutinas.registrar'); // Aquí se carga la vista llamada 'registrar'
    }

    // Método para manejar la selección de áreas del cuerpo dentro de la misma vista
    public function seleccionarAreas(Request $request)
    {
        $genero = $request->input('genero'); // Hombre o Mujer seleccionado
        $areas = $request->input('areas');   // Áreas seleccionadas (si se eligen más de una)

        // Aquí podrías procesar las áreas seleccionadas si fuera necesario

        return view('rutinas.registrar', compact('genero', 'areas'));  // Cargar de nuevo la misma vista con los datos
    }
}
 