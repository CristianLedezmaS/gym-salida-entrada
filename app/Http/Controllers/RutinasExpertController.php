<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutina; 
use App\Models\Cliente; // Asegúrate de importar el modelo Cliente

class RutinasExpertController extends Controller
{
      // Mostrar todas las rutinas
      public function index()
      {
          $rutinas = Rutina::all();
          return view('rutinas.rutinas', compact('rutinas'));
      }
      public function lista()
    {
        $rutinas = Rutina::all();
        return view('rutinas.ListaClienteRutina', compact('rutinas'));
    }
      // Mostrar formulario para crear una nueva rutina
      public function create()
      {
          $clientes = Cliente::all(); // Obtén todos los clientes de la base de datos
        return view('Rutinas.registrar', compact('clientes')); // Pasa la variable $clientes a la vista
      }
      
  
      // Almacenar una nueva rutina en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente', // Asegúrate que el cliente exista
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio', // La fecha de fin debe ser después de la de inicio
             // Crear la rutina
        ]);
        $rutina = Rutina::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
          // Asocia la rutina con el cliente
          $rutina->clientes()->attach($request->cliente_id); // Asegúrate de tener la relación configurad           
          return redirect()->route('rutinas.ListaClienteRutina')->with('success', 'Rutina creada con éxito');
        
    }
  
      // Mostrar el formulario para editar una rutina existente
      public function edit($id)
      {
          $rutina = Rutina::findOrFail($id);
          return view('rutinas.edit_rutina', compact('rutina'));
      }
  
      // Actualizar una rutina en la base de datos
      public function update(Request $request, $id)
        {
            $rutina = Rutina::findOrFail($id);
            $rutina->nombre = $request->input('nombre');
            $rutina->descripcion = $request->input('descripcion');
            // Cualquier otro campo que necesites actualizar
        
            $rutina->save();
        
            return redirect()->route('rutinas.lista')->with('success', 'Rutina actualizada correctamente 😎');
        }

      // Eliminar una rutina
      public function destroy($id)
      {
          $rutina = Rutina::findOrFail($id);
          $rutina->delete();
  
          return redirect()->route('rutinas.ListaClienteRutina')->with('success', 'Rutina eliminada con éxito');
      }
      public function tuMetodo(Request $request)
    {
        // Procesa los datos del formulario aquí
        $peso = $request->input('peso');
        $altura = $request->input('altura');

        // Haz lo que necesites con los datos (guardar en base de datos, etc.)

        return redirect()->back()->with('success', 'Formulario enviado exitosamente');
    }
    public function seleccionAreas(Request $request)
    {
        $objetivo = $request->input('objetivo');
        $descripciones = $this->getDescripciones();
        
        return view('rutinas.registrar', compact('objetivo', 'descripciones'));
    }
  }