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

    <h4 class="text-center text-secondary mb-4">Registro de Clientes</h4>
    
    <div class="container bg-white p-5 rounded shadow-sm custom-bg">
        <form action="{{ route('cliente.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            
            <div class="form-group mb-4">
                <input type="text" name="nombre" class="form-control input__text" placeholder="Nombres y Apellidos *" value="{{ old('nombre') }}">
                @error('nombre')
                    <small class="error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-4">
                <input type="email" name="correo" class="form-control input__text" placeholder="Correo Electrónico *" value="{{ old('correo') }}">
                @error('correo')
                    <small class="error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-4">
                <input type="text" name="telefono" class="form-control input__text" placeholder="Número de Teléfono *" value="{{ old('telefono') }}">
                @error('telefono')
                    <small class="error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-4">
                <input type="date" name="fecha_nacimiento" class="form-control input__text" placeholder="Fecha de Nacimiento *" value="{{ old('fecha_nacimiento') }}">
                @error('fecha_nacimiento')
                    <small class="error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('cliente.index') }}" class="btn btn-custom btn-secondary-custom m-2">Atrás</a>
                <button type="submit" class="btn btn-custom btn-primary-custom">Guardar</button>
            </div>
        </form>
    </div>
@endsection

<script>
    function consultar() {
        let membresia = document.getElementById("membresia").value
        let desde = document.getElementById("desde").value

        var ruta = "{{ url('consultar/registro/cliente') }}/" + membresia + "/" + desde + "";
        $.ajax({
            url: ruta,
            type: "get",
            success: function(data) {
                document.getElementById("hasta").value = data.respuesta
                document.getElementById("dias").value = data.dias
                document.getElementById("precio").value = data.precio
                document.getElementById("acuenta").value = "0"
            },
            error: function(data) {
                // Manejar errores aquí
            }
        })
    }

    let membresia = document.getElementById("membresia")
    let desde = document.getElementById("desde")
    valorDesde = desde.value = new Date().toISOString().slice(0, 10);
    membresia.addEventListener("change", consultar)
    desde.addEventListener("change", consultar)

    let acuenta = document.getElementById("acuenta")
    acuenta.addEventListener("change", function() {
        let precio = parseInt(document.getElementById("precio").value)
        if (acuenta.value > precio) {
            acuenta.value = precio
        }
    })
</script>
