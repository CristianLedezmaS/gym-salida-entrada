@extends('layouts/app')
@section('titulo', 'Registrar Usuario')

@section('content')

    <style>
         .form-container {
            background-color: #000; /* Fondo negro */
            color: #000; /* Texto blanco */
            padding: 20px; /* Espaciado interno */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Sombra suave */
        }
        .custom-bg {
            background: rgb(236, 236, 236);
        }
        .form-label {
            font-weight: bold;
        }
        .input__text, .input__select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 1rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        .input__text:focus, .input__select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .error__text {
            color: #dc3545;
            font-size: 0.875rem;
        }
        .btn-custom {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1rem;
        }
        .btn-secondary-custom {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-primary-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            opacity: 0.9;
        }
    </style>

    {{-- Notificaciones --}}
    @if (session('CORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "{{ session('CORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    @if (session('INCORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "{{ session('INCORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    @if (session('AVISO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "AVISO",
                    type: "info",
                    text: "{{ session('AVISO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    <form action="{{ route('pagos.store') }}" method="POST">
    @csrf
    <input type="hidden" name="cliente_id" value="{{ $cliente->id ?? '' }}"> <!-- Usar la variable si está definida -->
    <div class="form-group">
        <label for="monto">Monto</label>
        <input type="text" name="monto" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrar Pago</button>
</form>


@endsection
