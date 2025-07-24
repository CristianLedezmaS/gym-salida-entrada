<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use Illuminate\Http\Request;

class RutinaController extends Controller
{
    public function index()
    {
        $rutinas = Rutina::all();
        return view('Rutinas.index', compact('rutinas'));
    }

    public function create()
    {
        return view('Rutinas.create');
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
        return view('Rutinas.edit', compact('rutina'));
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
        return view('Rutinas.registrar');
    }

    // Método para manejar la selección de áreas del cuerpo dentro de la misma vista
    public function seleccionarAreas(Request $request)
    {
        $genero = $request->input('genero');
        $areas = $request->input('selected_areas');
        return view('Rutinas.registrar', compact('genero', 'areas'));
    }

    // Método para ver una rutina específica
    public function show($id)
    {
        $rutina = Rutina::findOrFail($id);
        return view('Rutinas.show', compact('rutina'));
    }

    // Método para manejar el formulario de fitness
    public function tuMetodo(Request $request)
    {
        // Aquí procesas los datos del formulario de fitness
        return redirect()->route('rutinas.index')->with('success', 'Datos de fitness guardados exitosamente.');
    }
}
