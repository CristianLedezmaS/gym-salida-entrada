@extends('layouts/app')
@section('titulo', 'Registrar Usuario')

@section('content')
    <style>
        .block {
            background: rgb(236, 236, 236);
        }
        .cuota {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .error-alert {
            color: red;
            font-weight: bold;
        }
        #cuotasContainer {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>

    <h4 class="text-center text-secondary">BIENVENIDO, REGISTRA TU PAGO</h4>

    <div class="mb-0 col-12 bg-white p-5">
        @foreach ($datos as $key => $item2)
            <!-- Información del cliente -->
            <div class="row mb-4">
                <h5 class="alert alert-primary">Datos del cliente</h5>
                <input type="hidden" name="idcliente" value="{{ $item2->id_cliente }}">
                <div class="fl-flex-label mb-4 col-12 col-lg-4">
                    <input readonly type="number" name="dni" class="input input__text" id="dni" placeholder="CI *"
                        value="{{ old('dni', $item2->dni) }}">
                </div>
                <div class="fl-flex-label mb-4 col-12 col-lg-4">
                    <input readonly type="text" name="usuario" class="input input__text" placeholder="Usuario *"
                        value="{{ old('usuario', $item2->usuario) }}">
                </div>
                <div class="fl-flex-label mb-4 col-12 col-lg-4">
                    <input readonly type="text" name="nombre" class="input input__text" id="nombre"
                        placeholder="Nombres y Apellidos *" value="{{ old('nombre', $item2->nombre) }}">
                </div>
            </div>

            <!-- Formulario de pagos -->
            <form action="{{ route('pagos.store') }}" class="formulario" method="POST">
                @csrf
                <h5 class="alert alert-primary">Datos del pago</h5>
                <input type="hidden" name="idcliente" value="{{ $item2->id_cliente }}">
                <div class="row">
                    <div class="fl-flex-label mb-4 col-6">
                        <label class="text-left">Membresia</label>
                        <input type="text" name="nombre" class="input input__text block" value="{{ $item2->nomMem }}"
                            id="nombreMembresia" readonly>
                    </div>
                    <div class="fl-flex-label mb-4 col-6">
                        <label class="text-left">Precio de la membresia</label>
                        <input type="text" name="precio" id="precio" class="input input__text block danger"
                            value="{{ $item2->precio }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="fl-flex-label mb-4 col-6">
                        <label class="text-left">Deuda actual</label>
                        <input type="text" name="debe" id="debe" class="input input__text block danger"
                            value="{{ $item2->debe }}" readonly>
                    </div>
                </div>

                <!-- Plan de pagos por cuotas -->
                <div class="mt-4">
                    <h5 class="alert alert-primary">Plan de Pagos por Cuotas</h5>

                    <div class="row">
                        <div class="fl-flex-label mb-4 col-md-4">
                            <label for="tipoFecha">Tipo de fecha:</label>
                            <select id="tipoFecha" class="input input__text">
                                <option value="mes">Por Mes</option>
                                <option value="dia">Día Específico</option>
                                <option value="intercalado">Cada dos días (sin domingos)</option>
                            </select>
                        </div>
                        <div class="fl-flex-label mb-4 col-md-4">
                            <label for="fechaInicio">Fecha de inicio:</label>
                            <input type="text" id="fechaInicio" class="input input__text" placeholder="Seleccionar fecha de inicio">
                        </div>
                        <div class="fl-flex-label mb-4 col-md-4">
                            <label for="numeroCuotas">Número de cuotas:</label>
                            <input type="number" id="numeroCuotas" class="input input__text" min="1" value="1">
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="button" id="generarCuotas" class="btn btn-rounded btn-info">Generar Cuotas</button>
                        <button type="button" id="descargarPDF" class="btn btn-rounded btn-warning" disabled>Descargar PDF</button>
                    </div>

                    <div id="cuotasContainer" class="mt-3"></div>
                </div>

                <!-- Botones de acción del formulario -->
                <div class="text-right mt-4">
                    <a href="{{ route('cliente.index') }}" class="btn btn-rounded btn-secondary m-2">Atrás</a>
                    <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>

            <!-- Librerías necesarias -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tipoFecha = document.getElementById('tipoFecha');
                    const fechaInicio = document.getElementById('fechaInicio');
                    const numeroCuotas = document.getElementById('numeroCuotas');
                    const cuotasContainer = document.getElementById('cuotasContainer');
                    const btnGenerarCuotas = document.getElementById('generarCuotas');
                    const btnDescargarPDF = document.getElementById('descargarPDF');
                    const precioInput = document.getElementById('precio');
                    const nombreMembresia = document.getElementById('nombreMembresia');

                    let flatpickrInstance;

                    function inicializarFlatpickr() {
                        if (flatpickrInstance) {
                            flatpickrInstance.destroy();
                        }

                        let options = {
                            dateFormat: "Y-m-d",
                            locale: "es"
                        };

                        if (tipoFecha.value === 'mes') {
                            options.dateFormat = "Y-m";
                        }

                        flatpickrInstance = flatpickr(fechaInicio, options);
                    }

                    tipoFecha.addEventListener('change', inicializarFlatpickr);
                    inicializarFlatpickr();

                    btnGenerarCuotas.addEventListener('click', function () {
                        const fechaSeleccionada = fechaInicio.value;
                        const numCuotas = parseInt(numeroCuotas.value);
                        const precioTotal = parseFloat(precioInput.value);

                        if (!fechaSeleccionada || isNaN(numCuotas) || numCuotas < 1 || isNaN(precioTotal)) {
                            alert('Por favor, complete todos los campos correctamente.');
                            return;
                        }

                        // Validación para que el precio total no sea menor a 10 BS
                        if (precioTotal < 10) {
                            alert('El precio total no puede ser menor a 10 BS.');
                            return;
                        }

                        const precioPorCuota = Math.round(precioTotal / numCuotas); // Redondea a número entero
                        let fechas = [];
                        let fecha = new Date(fechaSeleccionada);

                        cuotasContainer.innerHTML = '';

                        for (let i = 0; i < numCuotas; i++) {
                            if (tipoFecha.value === 'mes') {
                                fecha.setMonth(fecha.getMonth() + 1);
                            } else if (tipoFecha.value === 'dia') {
                                fecha.setDate(fecha.getDate() + 1);
                            } else if (tipoFecha.value === 'intercalado') {
                                do {
                                    fecha.setDate(fecha.getDate() + 2);
                                } while (fecha.getDay() === 0);
                            }

                            const fechaFormateada = fecha.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
                            fechas.push(fechaFormateada);

                            const cuotaElement = document.createElement('div');
                            cuotaElement.className = 'cuota';
                            cuotaElement.innerHTML = `
                                <span>Cuota ${i + 1}: ${fechaFormateada}</span>
                                <span>Monto: ${precioPorCuota} BS</span>
                            `;
                            cuotasContainer.appendChild(cuotaElement);
                        }

                        // Habilitar el botón de descarga si se generaron cuotas
                        btnDescargarPDF.disabled = false;
                    });

                    btnDescargarPDF.addEventListener('click', function () {
                        // Verificar si hay cuotas generadas antes de descargar el PDF
                        if (cuotasContainer.innerHTML.trim() === '') {
                            alert('Primero debes generar las cuotas antes de descargar el PDF.');
                            return;
                        }

                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();
                        const fechaActual = new Date().toLocaleDateString();
                        const nombreCliente = document.getElementById('nombre').value;
                        const membresia = nombreMembresia.value;
                        const precioTotal = precioInput.value;

                        // Colores y estilos
                        const colorPrimario = [26, 188, 156]; // Verde azulado
                        const colorTexto = [44, 62, 80]; // Gris oscuro

                        // Encabezado
                        doc.setFontSize(18);
                        doc.setTextColor(...colorPrimario);
                        doc.text('Plan de Pagos - Membresía', 20, 20);

                        doc.setFontSize(12);
                        doc.setTextColor(...colorTexto);
                        doc.text(`Fecha de generación: ${fechaActual}`, 20, 30);
                        doc.text(`Cliente: ${nombreCliente}`, 20, 40);
                        doc.text(`Membresía: ${membresia}`, 20, 50);
                        doc.text(`Precio Total: ${precioTotal} BS`, 20, 60);

                        // Encabezado de Detalles
                        doc.setFontSize(14);
                        doc.setTextColor(...colorPrimario);
                        doc.text('Detalles de Cuotas:', 20, 80);

                        // Crear encabezados de la tabla
                        const startX = 20;
                        let y = 90;
                        doc.setFontSize(12);
                        doc.setTextColor(255, 255, 255); // Color blanco para texto en encabezado
                        doc.setFillColor(26, 188, 156); // Fondo verde azulado
                        doc.rect(startX, y, 160, 10, 'F'); // F para rectángulo lleno
                        doc.text('N° Cuota', startX + 10, y + 7);
                        doc.text('Fecha de Pago', startX + 70, y + 7);
                        doc.text('Monto (BS)', startX + 130, y + 7);
                        y += 10;

                        // Dibujar cada fila de cuota
                        cuotasContainer.querySelectorAll('.cuota').forEach((cuotaElement, index) => {
                            const cuotaTexto = cuotaElement.innerText.split(' ');
                            const fechaCuota = cuotaTexto.slice(2, cuotaTexto.length - 3).join(' '); // Extraer fecha
                            const montoCuota = cuotaTexto[cuotaTexto.length - 2]; // Extraer monto

                            doc.setTextColor(...colorTexto);
                            doc.rect(startX, y, 160, 10); // Cuadro alrededor de cada fila

                            // Información de cada cuota
                            doc.text(`${index + 1}`, startX + 10, y + 7); // Número de cuota
                            doc.text(fechaCuota, startX + 70, y + 7); // Fecha de pago
                            doc.text(`${montoCuota} BS`, startX + 130, y + 7); // Monto

                            y += 10; // Aumentar posición vertical para la siguiente fila
                        });

                      // Espacios para firmas
                        y += 20; // Espacio entre la tabla y la sección de firmas

                        // Líneas de firma
                        doc.line(20, y, 80, y); // Línea de firma del cliente
                        doc.line(120, y, 180, y); // Línea de firma del responsable

                        // Etiquetas de firma con un pequeño desplazamiento hacia abajo
                        doc.text('Firma del Cliente', 35, y + 10);
                        doc.text('Firma del Responsable', 130, y + 10);

                        // Ajusta la posición vertical para finalizar
                        y += 20; // Espacio adicional para cualquier contenido posterior

                        // Guarda el documento PDF
                        doc.save('plan_pagos.pdf');


                    });
                });
            </script>
        @endforeach
    </div>
@endsection
