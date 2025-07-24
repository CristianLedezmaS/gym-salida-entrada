@extends('layouts/app')
@section('titulo', 'clientes')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
    body {
        font-family: 'Aptos Display', sans-serif;
        background-color: #d7dbdd; /* Fondo gris claro */
        color: #ffff; /* Texto blanco */
        margin: 0;
        padding: 20px;
    }

    h4 {
        text-align: center;
        color: #00bcd4; /* Título en color turquesa */
        font-size: 24px;
        margin-bottom: 20px;
    }

    .btn-rounded {
        border-radius: 25px; /* Bordes redondeados para botones */
    }

    .card {
        background-color: #1f1f1f; /* Fondo oscuro para la tarjeta */
        border: 1px solid #333; /* Borde oscuro para la tarjeta */
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Sombra más pronunciada */
        padding: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    th, td {
        text-align: left;
        padding: 12px;
        border: 1px solid #444; /* Borde oscuro */
    }

    th {
        background-color: #00bcd4; /* Fondo turquesa para el encabezado */
        color: #000; /* Texto negro en el encabezado */
        font-size: 16px;
        font-weight: 700;
    }

    tr:nth-child(even) {
        background-color: #2c2c2c; /* Color oscuro para filas pares */
    }

    tr:hover {
        background-color: #444; /* Color más oscuro al pasar el ratón */
    }

    p {
        margin-top: 30px;
        text-align: right;
        font-size: 14px;
        color: #bbb;
    }

    .modal-content {
        border: 1px solid #00bcd4; /* Borde turquesa para el modal */
        border-radius: 8px; /* Bordes redondeados del modal */
    }

    .modal-header {
        background-color: #00bcd4; /* Fondo turquesa para el encabezado del modal */
        color: #ffffff; /* Texto blanco en el encabezado del modal */
    }

    .modal-title {
        font-size: 18px;
        font-weight: 700;
    }

    .modal-close {
        color: #ffffff; /* Color blanco para el botón de cierre del modal */
    }

    .form-group input[type="file"] {
        border: 1px solid #444; /* Borde oscuro */
        border-radius: 4px;
        padding: 10px;
        font-size: 14px;
        background-color: #333; /* Fondo oscuro para el input de archivo */
        color: #fff; /* Texto blanco */
    }

    .alert-danger {
        background-color: #721c24; /* Fondo rojo oscuro para alertas de error */
        border-color: #f5c6cb;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107; /* Color de fondo para badges de advertencia */
        color: #212529;
    }

    .badge-danger {
        background-color: #dc3545; /* Color de fondo para badges de error */
        color: #fff;
    }

    .badge-success {
        background-color: #28a745; /* Color de fondo para badges de éxito */
        color: #fff;
    }

    .btn {
        border-radius: 25px; /* Bordes redondeados para botones */
        font-size: 14px;
        font-weight: 700;
    }

    .btn-primary {
        background-color: #00bcd4; /* Color de fondo para el botón primario */
        border-color: #00bcd4; /* Borde del botón primario */
    }

    .btn-primary:hover {
        background-color: #00a8c7; /* Color de fondo al pasar el ratón */
        border-color: #00a8c7; /* Borde del botón primario al pasar el ratón */
    }

    .btn-secondary {
        background-color: #6c757d; /* Color de fondo para el botón secundario */
        border-color: #6c757d; /* Borde del botón secundario */
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Color de fondo al pasar el ratón */
        border-color: #545b62; /* Borde del botón secundario al pasar el ratón */
    }

    .btn-info {
        background-color: #17a2b8; /* Color de fondo para el botón de info */
        border-color: #17a2b8; /* Borde del botón de info */
    }

    .btn-info:hover {
        background-color: #138496; /* Color de fondo al pasar el ratón */
        border-color: #117a8b; /* Borde del botón de info al pasar el ratón */
    }

    .btn-warning {
        background-color: #ffc107; /* Color de fondo para el botón de advertencia */
        border-color: #ffc107; /* Borde del botón de advertencia */
    }

    .btn-warning:hover {
        background-color: #e0a800; /* Color de fondo al pasar el ratón */
        border-color: #d39e00; /* Borde del botón de advertencia al pasar el ratón */
    }

    .btn-danger {
        background-color: #dc3545; /* Color de fondo para el botón de peligro */
        border-color: #dc3545; /* Borde del botón de peligro */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Color de fondo al pasar el ratón */
        border-color: #bd2130; /* Borde del botón de peligro al pasar el ratón */
    }
</style>


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
                    type: "error",
                    text: "{{ session('AVISO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif



    <h4 class="text-center text-secondary">GESTIONAR CLIENTES REGISTRADOS</h4>
    <div class="pb-1 pt-2">
        <a href="{{ route('cliente.create') }}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
            Registrar</a>
    </div>
      <!-- Botones para ver los reportes -->
        <div class="pb-1 pt-2">
            <!-- Botones para los reportes en PDF -->
            <a href="{{ route('reporte.membresiaActiva.pdf') }}" class="btn btn-rounded btn-info"><i class="fas fa-users"></i>&nbsp;
                Reporte Membresía Activa (PDF)</a>
            <a href="{{ route('reporte.morosos.pdf') }}" class="btn btn-rounded btn-warning"><i class="fas fa-credit-card"></i>&nbsp;
                Reporte Morosos (PDF)</a>
            <a href="{{ route('reporte.ingresos.pdf') }}" class="btn btn-rounded btn-success"><i class="fas fa-calendar-check"></i>&nbsp;
                Reporte Ingresos (PDF)</a>
                
            
        </div>

    <section class="card">
        <div class="card-block">
            <table id="example" class="display table table-striped" cellspacing="0" width="100%">
                <thead class="table-primary">
                    <tr>
                        <th>id</th>
                        <th>Registrado por</th>
                       <!--  <th>Membresia</th>-->
                        <th>CI</th>
                        <th>Nombres</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>DiasRest.</th>
                        <th>Pago</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sql as $key => $item)
                        <tr>
                            <td>{{ $item->id_cliente }}</td>
                           <td>{{ $item->creado_por }}</td>
                             <!--<td>{{ $item->nomMem }}</td>-->
                            <td>{{ $item->dni }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->usuario }}</td>
                            <td>{{ $item->correo }}</td>
                            <td>{{ $item->telefono }}</td>
                            <td>{{ $item->direccion }}</td>
                            <td>{{ $item->desde }}</td>
                            <td>{{ $item->hasta }}</td>
                            <td>

                                 @if ($item->DR <= 7 and $item->DR >= 5)
                                    <span class="badge bg-warning">{{ $item->DR }}</span>
                                @else
                                    @if ($item->DR < 5)
                                        <span class="badge bg-danger p-2">{{ $item->DR }}</span>
                                    @else
                                        <span class="badge bg-success p-2">{{ $item->DR }}</span>
                                    @endif
                                @endif
                            </td>
                           <td>

                                @if ($item->debe == null or $item->debe == 0)
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-danger">Deuda</span>
                                @endif
                            </td>

                           <td>
                                @if ($item->foto == null)
                                    <a class="text-danger" data-toggle="modal"
                                        data-target=".bd-example-modal-md-{{ $item->id_cliente }}"
                                        href="">Agregar</a>
                                @else
                                    <a data-toggle="modal" data-target=".bd-example-modal-md-{{ $item->id_cliente }}"
                                        href="">Ver
                                        foto</a>
                                @endif
                            </td>

                            <td>
                                @if ($item->debe == null or $item->debe == 0)
                                @else
                                    <a style="top: 0"
                                        href="{{ route('cliente.pagoCliente', $item->id_cliente) }}"
                                        class="btn btn-sm btn-secondary m-1"><i class="fas fa-dollar-sign"></i> pagar</a>
                                @endif
                                <a style="top: 0" href="{{ route('cliente.show', $item->id_cliente) }}"
                                    class="btn btn-sm btn-primary m-1"><i class="fas fa-calendar-plus"></i> Renovar</a>

                                <a style="top: 0" href="{{ route('cliente.datosCliente', $item->id_cliente) }}"
                                    class="btn btn-sm btn-info m-1"><i class="fas fa-eye"></i></a>

                                <a style="top: 0" href="{{ route('cliente.edit', $item->id_cliente) }}"
                                    class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('cliente.destroy', $item->id_cliente) }}" method="post"
                                    class="d-inline formulario-eliminar">
                                    @method('delete')
                                    @csrf
                                    <a href="#" class="btn btn-sm btn-danger eliminar"
                                        data-id="{{ $item->id_cliente }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </form>
                            </td>

                            <div class="modal fade bd-example-modal-md-{{ $item->id_cliente }}" tabindex="-1"
                                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="font-icon-close-2"></i>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Modificar perfil de usuario</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-1 col-12">
                                                <form action="{{ route('usuario.actualizarImagen') }}"
                                                    enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    <div class="alert alert-danger">Se le recomienda subir una imagen en un
                                                        formato válido y no muy pesado.</div>
                                                    <input hidden type="hidden" name="id"
                                                        value="{{ $item->id_cliente }}">
                                                    <div class="d-flex justify-content-center">
                                                        @if ($item->foto != null)
                                                            <img class="rounded-circle" style="width: 300px;height: 300px;"
                                                                src="{{ asset("foto/usuario/$item->foto") }}"
                                                                alt="">
                                                        @endif
                                                    </div>
                                                    <div class="fl-flex-label mb-4 col-12">
                                                        <input type="file" name="foto"
                                                            class="input form-control-file input__text"
                                                            value="{{ old('foto') }}">
                                                        @error('foto')
                                                            <small class="error error__text">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="pb-1 pt-2 text-right mt-2">
                                                        @if ($item->foto != null)
                                                            <a href="{{ route('usuario.eliminarImagen', $item->id_cliente) }}"
                                                                class="btn btn-rounded btn-danger">Eliminar</a>
                                                            <button type="submit"
                                                                class="btn btn-rounded btn-primary">Modificar</button>
                                                        @else
                                                            <button type="submit"
                                                                class="btn btn-rounded btn-primary">Agregar</button>
                                                        @endif

                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--.modal-->

                            

                            


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
        let pagacon = document.querySelectorAll(".pagacon");
        pagacon.forEach(function(e, index) {
            e.addEventListener("input", function(el) {
                let precio = document.querySelector(`.precio${index}`).value
                let pagacon = el.target.value
                let debe = precio - pagacon
                if (debe < 0) {
                    debe = 0;
                }
                document.querySelector(`.debe${index}`).value = debe
                console.log(debe)
            })
        });
    </script>

@endsection
