@extends('layouts/app')
@section('titulo', 'membresia')

@section('content')

    {{-- notificaciones --}}
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

    <h4 class="text-center text-secondary">ASISTENCIAS DE CLIENTES</h4>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #007bff;">
                <div class="modal-header" style="background-color: #007bff; color: #fff;">
                    <h5 class="modal-title" id="exampleModalLabel">Generar Reporte de Asistencias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('reporte.asistencia.pdf') }}" method="get" target="_blank">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="clienteSelect">Seleccionar Cliente</label>
                            <select id="clienteSelect" name="cliente" class="form-control" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach ($cliente as $item)
                                    <option value="{{ $item->id_cliente }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="card" style="background-color: #2e2e2e; padding: 20px; border-radius: 10px;">
        <div class="card-block table-responsive">
            <div style="margin-bottom: 20px;">
                <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"><i class="fas fa-file-excel"></i>
                    Reportes</a>
                <a href="{{ route('reporte.asistencia') }}" class="btn btn-success"><i class="fas fa-file-excel"></i>
                    Descargar Excel</a>
            </div>
            <table id="example2" class="display table table-striped" cellspacing="0" width="100%">
                <thead class="table-light" style="background-color: #f8f9fa; color: #000;">
                    <tr>
                        <th style="font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border: 1px solid #dee2e6; text-align: center; font-family: 'Aptos Display', serif;">ID</th>
                        <th style="font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border: 1px solid #dee2e6; text-align: center; font-family: 'Aptos Display', serif;">Cliente</th>
                        <th style="font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border: 1px solid #dee2e6; text-align: center; font-family: 'Aptos Display', serif;">Fecha y Hora</th>
                        <th style="font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border: 1px solid #dee2e6; text-align: center; font-family: 'Aptos Display', serif;">Marcado Por</th>
                    </tr>
                </thead>
                <tbody style="background-color: #ffffff; color: #000;">
                    @foreach ($sql as $item2)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center; font-size: 14px; font-family: 'Aptos Display', serif;">{{ $item2->id_asistencia }}</td>
                            <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center; font-size: 14px; font-family: 'Aptos Display', serif;">{{ $item2->nombre }}</td>
                            <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center; font-size: 14px; font-family: 'Aptos Display', serif;">{{ $item2->fecha_hora }}</td>
                            <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center; font-size: 14px; font-family: 'Aptos Display', serif;">{{ $item2->marcado_por }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                {{ $sql->links('pagination::bootstrap-4') }}
                Mostrando {{ $sql->firstItem() }} - {{ $sql->lastItem() }} de {{ $sql->total() }} resultados.
            </div>
        </div>
    </section>

@endsection
