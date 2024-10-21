@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Editar Rutina</h1>
    <form action="{{ route('rutinas.update', $rutina->id_rutina) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre de la Rutina:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $rutina->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $rutina->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $rutina->fecha_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $rutina->fecha_fin }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rutina</button>
        <a href="{{ route('rutinas.lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
