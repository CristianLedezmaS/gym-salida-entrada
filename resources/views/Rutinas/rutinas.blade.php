
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Rutinas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('rutinas.create') }}" class="btn btn-primary">Crear Nueva Rutina</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rutinas as $rutina)
                <tr>
                    <td>{{ $rutina->nombre }}</td>
                    <td>{{ $rutina->fecha_inicio }}</td>
                    <td>{{ $rutina->fecha_fin }}</td>
                    <td>{{ $rutina->descripcion }}</td>
                    <td>
                        <a href="{{ route('rutinas.edit', $rutina->id_rutina) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('rutinas.destroy', $rutina->id_rutina) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
