@extends('layouts.app')
@section('titulo', 'Usuarios')

@section('content')
    <h4 class="text-center text-secondary">LISTA DE USUARIOS</h4>
    <div class="pb-1 pt-2">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Registrar Usuario</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <!-- Agregar botones para editar/eliminar -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
