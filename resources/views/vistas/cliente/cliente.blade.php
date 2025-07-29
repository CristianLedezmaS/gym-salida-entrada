@extends('layouts/app')
@section('titulo', 'Clientes')

<style>
    /* Estilos específicos para FullCalendar en el modal */
    #detalleCalendar .fc {
        font-family: inherit !important;
        background: white !important;
    }
    
    #detalleCalendar .fc-header-toolbar {
        background: white !important;
        padding: 10px !important;
    }
    
    #detalleCalendar .fc-daygrid-day {
        background: white !important;
    }
    
    #detalleCalendar .fc-daygrid-day-number {
        color: #333 !important;
    }
    
    #detalleCalendar .fc-col-header-cell {
        background: #f8f9fa !important;
        color: #333 !important;
    }
    
    #detalleCalendar .fc-button {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
        color: white !important;
    }
    
    #detalleCalendar .fc-button:hover {
        background: #2563eb !important;
    }
    
    #detalleCalendar .fc-toolbar-title {
        color: #333 !important;
        font-weight: bold !important;
    }
</style>

@section('content')
<div class="text-light-text">

    <div class="w-full px-2">
        <h2 class="text-center text-accent-blue text-3xl font-bold mb-6">GESTIONAR CLIENTES REGISTRADOS</h2>
    </div>



    <div class="w-full px-2">
        <h2 class="text-center text-accent-blue text-3xl font-bold mb-6">GESTIONAR CLIENTES REGISTRADOS</h2>
        

        
        <div class="mb-6">
            <button onclick="openRegistrarClienteModal()" 
               class="inline-flex items-center px-6 py-3 bg-accent-blue hover:bg-accent-blue-hover text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                </svg>
                Registrar Cliente
            </button>
    </div>

        <!-- Botones para los reportes -->
        <div class="mb-6 flex flex-wrap gap-3">
            <a href="{{ route('reporte.membresiaActiva.pdf') }}" 
               class="inline-flex items-center px-4 py-2 bg-accent-green hover:bg-accent-green-hover text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                </svg>
                Reporte Membresía Activa (PDF)
            </a>
            <a href="{{ route('reporte.morosos.pdf') }}" 
               class="inline-flex items-center px-4 py-2 bg-accent-yellow hover:bg-accent-yellow-hover text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0021.75 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 006.75 21h15z"></path>
                </svg>
                Reporte Morosos (PDF)
            </a>
            <a href="{{ route('reporte.ingresos.pdf') }}" 
               class="inline-flex items-center px-4 py-2 bg-accent-purple hover:bg-accent-purple-hover text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-1.5c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v1.5m-18 0H3m16.5 0h.008v.008h-.008V18.75zm-3.75-4.5v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75"></path>
                </svg>
                Reporte Ingresos (PDF)
            </a>
        </div>

        <div class="bg-light-card rounded-lg shadow-sm border border-light-border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                <thead class="bg-accent-blue text-white">
                    <tr>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">ID</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Registrado por</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">CI</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Nombres</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Usuario</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Correo</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Teléfono</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Membresía</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Desde</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Hasta</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Días Rest.</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Pago</th>
                        <th class="px-2 py-3 text-left text-sm font-semibold border-b-2 border-white">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sql as $key => $item)
                        <tr class="hover:bg-light-hover transition-colors border-b border-light-border">
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->id_cliente }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->creado_por }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->dni }}</td>
                            <td class="px-2 py-3 text-sm font-medium text-light-text border-r border-light-border">{{ $item->nombre }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->usuario }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->correo }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->telefono }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->nomMem }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->desde }}</td>
                            <td class="px-2 py-3 text-sm text-light-text border-r border-light-border">{{ $item->hasta }}</td>
                            <td class="px-2 py-3 text-sm border-r border-light-border">
                                 @if ($item->DR <= 7 and $item->DR >= 5)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-yellow text-white">{{ $item->DR }}</span>
                                @else
                                    @if ($item->DR < 5)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-red text-white">{{ $item->DR }}</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-green text-white">{{ $item->DR }}</span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-2 py-3 text-sm border-r border-light-border">
                                @if ($item->debe == null or $item->debe == 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-green text-white">Pagado</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-red text-white">Deuda</span>
                                @endif
                                @if ($item->pago > 0)
                                    <div class="text-xs text-gray-500 mt-1">
                                        Pagado: ${{ number_format($item->pago, 2) }}
                                    </div>
                                @endif
                            </td>
                                                          <td class="px-2 py-3 text-sm">
                                  <div class="flex items-center space-x-1">
                                @if ($item->debe == null or $item->debe == 0)
                                @else
                                        <!-- Botón de pago eliminado - ahora usa modal -->
                                @endif
                                    <button onclick="openRenovarModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                            class="p-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors duration-200 hover:scale-110" title="Renovar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-1.5c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v1.5m-18 0H3m16.5 0h.008v.008h-.008V18.75zm-3.75-4.5v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75"></path>
                                        </svg>
                                    </button>
                                    <button onclick="openDetallesModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                            class="p-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg transition-colors duration-200 hover:scale-110" title="Ver detalles">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.639 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.639 0-8.573-3.007-9.963-7.178z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    @if($item->debe > 0)
                                        <button onclick="openPagarModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                                class="p-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-200 hover:scale-110" title="Pagar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </button>
                                    @endif
                                    <a href="{{ route('cliente.edit', $item->id_cliente) }}"
                                       class="p-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors duration-200 hover:scale-110" title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 hover:scale-110 eliminar"
                                       data-id="{{ $item->id_cliente }}" title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Renovación -->
<div id="renovarModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Renovar Membresía</h3>
                <button onclick="closeRenovarModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form id="renovarForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_cliente" id="modalIdCliente">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de membresía</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" name="membresia" id="modalMembresia">
                                <option value="">Seleccionar Membresía</option>
                                @foreach ($membresia ?? [] as $item2)
                                    <option value="{{ $item2->id_membresia }}">{{ $item2->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                            <input type="text" name="precio" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" id="modalPrecio" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                            <input type="date" name="desde" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" id="modalDesde">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hasta</label>
                            <div class="flex space-x-2">
                                <input type="date" name="hasta" id="modalHasta" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required readonly>
                                <button type="button" onclick="calcularFechaHastaModal()" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors" title="Calcular automáticamente">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente basado en la membresía y fecha desde</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">N° de entradas que le quedaban al cliente anteriormente</label>
                            <input type="number" name="dias" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" id="modalDias" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Monto que debía el cliente anteriormente S/.</label>
                            <input type="text" name="debe" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-red-600 font-bold" id="modalDebe" readonly>
                        </div>

                        <div class="mb-4 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total a pagar (precio+debe)</label>
                            <input type="text" name="total" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-red-600 font-bold" id="modalTotal" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">A cuenta (Ingrese el monto del adelanto)</label>
                            <input type="number" step="0.5" name="acuenta" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" id="modalAcuenta" value="0">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pago restante (total a pagar - a cuenta)</label>
                            <input type="text" name="pagoRestante" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-red-600 font-bold" id="modalPagoRestante" readonly>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeRenovarModal()" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors">
                            Renovar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
</div>

<!-- Modal de Detalles del Cliente -->
<div id="detallesModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-6xl w-full max-h-screen overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Detalles del Cliente</h3>
                    <button onclick="closeDetallesModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Pestañas de Navegación -->
                <div class="flex space-x-1">
                    <button onclick="mostrarPestana('informacion')" id="btn-informacion" class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 rounded-t-lg transition-colors">
                        Información
                    </button>
                    <button onclick="mostrarPestana('transacciones')" id="btn-transacciones" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-t-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        Transacciones
                    </button>
                    <button onclick="mostrarPestana('rutinas')" id="btn-rutinas" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-t-lg hover:bg-purple-100 hover:text-purple-700 transition-colors">
                        Rutinas
                    </button>
                </div>
            </div>
            <div class="p-6">
                <!-- Contenido de Pestañas -->
                <div id="contenido-informacion" class="contenido-pestana">
                    <!-- Información del Cliente -->
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Información Personal</h4>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">DNI:</span>
                                <span id="detalleDni" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">Usuario:</span>
                                <span id="detalleUsuario" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">Nombre:</span>
                                <span id="detalleNombre" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">Correo:</span>
                                <span id="detalleCorreo" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">Teléfono:</span>
                                <span id="detalleTelefono" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-gray-700 min-w-[80px]">Dirección:</span>
                                <span id="detalleDireccion" class="text-gray-900 font-medium"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de Membresía -->
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Información de Membresía</h4>
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-blue-700 min-w-[80px]">Membresía:</span>
                                <span id="detalleMembresia" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-blue-700 min-w-[80px]">Desde:</span>
                                <span id="detalleDesde" class="text-gray-900 font-medium"></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-blue-700 min-w-[80px]">Hasta:</span>
                                <span id="detalleHasta" class="text-gray-900 font-medium"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estado de Pago -->
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Estado de Pago</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="text-center mb-3">
                                <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Clases Restantes</span>
                            </div>
                            <div class="text-center">
                                <span id="detalleClasesRestantes" class="text-2xl font-bold text-blue-600"></span>
                            </div>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                            <div class="text-center mb-3">
                                <span class="text-xs font-semibold text-red-600 uppercase tracking-wide">Deuda</span>
                            </div>
                            <div class="text-center">
                                <span id="detalleDeuda" class="text-xl font-bold text-red-600"></span>
                            </div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <div class="text-center mb-3">
                                <span class="text-xs font-semibold text-yellow-600 uppercase tracking-wide">Estado</span>
                            </div>
                            <div class="text-center">
                                <span id="detalleEstado" class="px-3 py-1 rounded-full text-sm font-medium"></span>
                            </div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <div class="text-center mb-3">
                                <span class="text-xs font-semibold text-green-600 uppercase tracking-wide">Acciones</span>
                            </div>
                            <div class="text-center">
                                <button id="btnPagar" onclick="pagarCliente()" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium hidden">
                                    Pagar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Calendario de Asistencias -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Calendario de Asistencias</h4>
                    <div class="mb-2">
                        <button onclick="inicializarCalendarioDetalles()" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                            Cargar Calendario
                        </button>
                    </div>
                    <div id="detalleCalendar" class="h-64 border border-gray-300 rounded-lg bg-white" style="min-height: 400px; position: relative; z-index: 1;">
                        <div class="text-center text-gray-500 p-4">
                            <p>Cargando calendario...</p>
                        </div>
                    </div>
                </div>

                </div>

                <!-- Contenido de Transacciones -->
                <div id="contenido-transacciones" class="contenido-pestana hidden">
                    <div class="text-center py-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Transacciones del Cliente</h4>
                        <div id="loading-transacciones" class="text-gray-600">
                            <p>Cargando transacciones...</p>
                        </div>
                        <div id="contenido-transacciones-real" class="hidden">
                            <!-- Aquí se cargarán las transacciones dinámicamente -->
                        </div>
                    </div>
                </div>

                <!-- Contenido de Rutinas -->
                <div id="contenido-rutinas" class="contenido-pestana hidden">
                    <div class="text-center py-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Rutinas del Cliente</h4>
                        <p class="text-gray-600">Aquí se mostrarán las rutinas del cliente</p>
                    </div>
                </div>

                <!-- Botón Cerrar -->
                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button onclick="closeDetallesModal()" class="px-6 py-3 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors font-medium">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Variables globales para todos los modales
        let clienteIdRenovar = null;
        let clienteDataRenovar = null;
        let clienteIdPagar = null;
        let flatpickrInstancePago = null;
        let clienteIdDetalles = null;
        let clienteDataDetalles = null;
        let calendarDetalles = null;

        // Funciones existentes
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

        // Funciones del modal de renovación
        function openRenovarModal(id, nombre) {
            // Limpiar formulario anterior
            document.getElementById('renovarForm').reset();
            
            clienteIdRenovar = id;
            
            // Obtener datos del cliente mediante AJAX
            fetch(`/cliente/${id}`)
                .then(response => response.text())
                .then(html => {
                    // Crear un elemento temporal para parsear el HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extraer datos del cliente
                    const clienteData = {
                        id_cliente: id,
                        nombre: nombre,
                        debe: doc.querySelector('[name="debe"]')?.value || '0',
                        dias: doc.querySelector('[name="dias"]')?.value || '0',
                        desde: doc.querySelector('[name="desde"]')?.value || new Date().toISOString().slice(0, 10)
                    };
                    
                    clienteDataRenovar = clienteData;
                    
                    // Llenar el formulario
                    document.getElementById('modalIdCliente').value = clienteData.id_cliente;
                    document.getElementById('modalDebe').value = clienteData.debe;
                    document.getElementById('modalDias').value = clienteData.dias;
                    document.getElementById('modalDesde').value = clienteData.desde;
                    document.getElementById('modalTotal').value = clienteData.debe;
                    document.getElementById('modalPagoRestante').value = clienteData.debe;
                    
                    // Configurar el formulario
                    document.getElementById('renovarForm').action = `/renovar/cliente/${id}`;
                    
                    // Mostrar el modal
                    document.getElementById('renovarModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error al obtener datos del cliente:', error);
                    alert('Error al cargar los datos del cliente');
                });
        }

        function closeRenovarModal() {
            document.getElementById('renovarModal').classList.add('hidden');
            clienteIdRenovar = null;
            clienteDataRenovar = null;
            
            // Limpiar formulario
            document.getElementById('renovarForm').reset();
        }

        // Función para consultar datos de membresía
        function consultarMembresia() {
            const membresia = document.getElementById('modalMembresia').value;
            const desde = document.getElementById('modalDesde').value;
            
            if (!membresia || !desde) return;
            
            fetch(`/consultar/registro/cliente/${membresia}/${desde}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalHasta').value = data.respuesta;
                    document.getElementById('modalDias').value = data.dias;
                    document.getElementById('modalPrecio').value = data.precio;
                    
                    const debe = parseInt(document.getElementById('modalDebe').value) || 0;
                    const precio = parseInt(data.precio) || 0;
                    const total = debe + precio;
                    
                    document.getElementById('modalTotal').value = total;
                    document.getElementById('modalPagoRestante').value = total;
                })
                .catch(error => {
                    console.error('Error al consultar membresía:', error);
                });
        }

        // Función para calcular pago a cuenta
        function calcularPagoACuenta() {
            const total = parseInt(document.getElementById('modalTotal').value) || 0;
            const acuenta = parseInt(document.getElementById('modalAcuenta').value) || 0;
            
            if (acuenta > total) {
                document.getElementById('modalAcuenta').value = total;
            }
            
            const pagoRestante = total - (parseInt(document.getElementById('modalAcuenta').value) || 0);
            document.getElementById('modalPagoRestante').value = pagoRestante;
        }



        // Funciones del modal de detalles
        function openDetallesModal(id, nombre) {
            console.log('Abriendo modal de detalles para cliente:', id);
            
            // Limpiar datos anteriores
            limpiarDatosModal();
            
            clienteIdDetalles = id;
            
            // Mostrar loading
            document.getElementById('detallesModal').classList.remove('hidden');
            
            // Obtener datos del cliente mediante AJAX
            fetch(`/clienteDatos-${id}`)
                .then(response => response.text())
                .then(html => {
                    // Crear un elemento temporal para parsear el HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extraer datos del cliente
                    const clienteData = {
                        id_cliente: id,
                        nombre: nombre,
                        dni: doc.querySelector('[name="dni"]')?.value || '',
                        usuario: doc.querySelector('[name="usuario"]')?.value || '',
                        correo: doc.querySelector('[name="correo"]')?.value || '',
                        telefono: doc.querySelector('[name="telefono"]')?.value || '',
                        direccion: doc.querySelector('[name="direccion"]')?.value || '',
                        debe: doc.querySelector('.bg-danger')?.textContent?.replace('Debe:', '').trim() || '0',
                        clasesRestantes: doc.querySelector('.dia')?.textContent || '0',
                        desde: '',
                        hasta: '',
                        membresia: 'No especificada'
                    };
                    
                    clienteDataDetalles = clienteData;
                    
                    // Llenar el formulario
                    document.getElementById('detalleDni').textContent = clienteData.dni;
                    document.getElementById('detalleUsuario').textContent = clienteData.usuario;
                    document.getElementById('detalleNombre').textContent = clienteData.nombre;
                    document.getElementById('detalleCorreo').textContent = clienteData.correo;
                    document.getElementById('detalleTelefono').textContent = clienteData.telefono;
                    document.getElementById('detalleDireccion').textContent = clienteData.direccion;
                    document.getElementById('detalleClasesRestantes').textContent = clienteData.clasesRestantes;
                    document.getElementById('detalleDeuda').textContent = clienteData.debe > 0 ? `S/. ${clienteData.debe}` : 'S/. 0';
                    
                    // Obtener todos los datos de la tabla
                    obtenerDatosTabla(id);
                    
                    // Configurar estado
                    const estadoElement = document.getElementById('detalleEstado');
                    if (clienteData.debe > 0) {
                        estadoElement.textContent = 'MOROSO';
                        estadoElement.className = 'px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
                        document.getElementById('btnPagar').classList.remove('hidden');
                    } else {
                        estadoElement.textContent = 'AL DÍA';
                        estadoElement.className = 'px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                        document.getElementById('btnPagar').classList.add('hidden');
                    }
                    
                    // Inicializar calendario después de un pequeño delay
                    setTimeout(() => {
                        inicializarCalendarioDetalles();
                    }, 100);
                })
                .catch(error => {
                    console.error('Error al obtener datos del cliente:', error);
                    alert('Error al cargar los datos del cliente');
                });
        }

        // Función para limpiar datos del modal
        function limpiarDatosModal() {
            // Limpiar campos de información personal
            document.getElementById('detalleDni').textContent = '';
            document.getElementById('detalleUsuario').textContent = '';
            document.getElementById('detalleNombre').textContent = '';
            document.getElementById('detalleCorreo').textContent = '';
            document.getElementById('detalleTelefono').textContent = '';
            document.getElementById('detalleDireccion').textContent = '';
            
            // Limpiar campos de membresía
            document.getElementById('detalleMembresia').textContent = '';
            document.getElementById('detalleDesde').textContent = '';
            document.getElementById('detalleHasta').textContent = '';
            
            // Limpiar campos de estado
            document.getElementById('detalleClasesRestantes').textContent = '';
            document.getElementById('detalleDeuda').textContent = '';
            document.getElementById('detalleEstado').textContent = '';
            
            // Ocultar botón de pagar
            document.getElementById('btnPagar').classList.add('hidden');
            
            // Limpiar calendario
            const calendarEl = document.getElementById('detalleCalendar');
            if (calendarEl) {
                calendarEl.innerHTML = '<div class="text-center text-gray-500 p-4"><p>Cargando calendario...</p></div>';
            }
            
            // Destruir calendario anterior si existe
            if (calendarDetalles) {
                calendarDetalles.destroy();
                calendarDetalles = null;
            }
            
            // Resetear pestañas
            mostrarPestana('informacion');
        }

        function closeDetallesModal() {
            document.getElementById('detallesModal').classList.add('hidden');
            clienteIdDetalles = null;
            clienteDataDetalles = null;
            
            // Destruir calendario si existe
            if (calendarDetalles) {
                calendarDetalles.destroy();
                calendarDetalles = null;
            }
        }

        function inicializarCalendarioDetalles() {
            console.log('=== INICIO INICIALIZACIÓN CALENDARIO ===');
            console.log('FullCalendar disponible:', typeof FullCalendar !== 'undefined');
            
            const calendarEl = document.getElementById('detalleCalendar');
            console.log('Elemento del calendario:', calendarEl);
            
            if (!calendarEl) {
                console.error('Elemento del calendario no encontrado');
                return;
            }
            
            // Limpiar el contenedor
            calendarEl.innerHTML = '';
            
            try {
                // Crear calendario básico
                calendarDetalles = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: "es",
                    events: [],
                    height: '100%',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth'
                    },
                    dayMaxEvents: true,
                    moreLinkClick: 'popover'
                });
                
                console.log('Calendario creado, renderizando...');
                calendarDetalles.render();
                console.log('Calendario renderizado exitosamente');
                
                // Forzar actualización visual
                setTimeout(() => {
                    calendarDetalles.updateSize();
                    console.log('Tamaño del calendario actualizado');
                }, 100);
                
            } catch (error) {
                console.error('Error al crear calendario:', error);
                calendarEl.innerHTML = '<div class="text-center text-red-500 p-4">Error al cargar el calendario</div>';
            }
        }

        function pagarCliente() {
            if (clienteIdDetalles) {
                window.open(`/clientePago-${clienteIdDetalles}`, '_blank');
            }
        }

        function verTransacciones() {
            if (clienteIdDetalles) {
                window.open(`/clienteTransaccion-${clienteIdDetalles}`, '_blank');
            }
        }

        function verRutinas() {
            if (clienteIdDetalles) {
                window.open(`/rutinas/ListaClienteRutina/${clienteIdDetalles}`, '_blank');
            }
        }
        
        // Función para cargar transacciones
        function cargarTransacciones() {
            if (!clienteIdDetalles) return;
            
            const loadingDiv = document.getElementById('loading-transacciones');
            const contenidoDiv = document.getElementById('contenido-transacciones-real');
            
            // Limpiar contenido anterior
            contenidoDiv.innerHTML = '';
            
            // Mostrar loading
            loadingDiv.classList.remove('hidden');
            contenidoDiv.classList.add('hidden');
            
            // Cargar transacciones
            fetch(`/clienteTransaccion-${clienteIdDetalles}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extraer la tabla de transacciones
                    const tablaTransacciones = doc.querySelector('table');
                    if (tablaTransacciones) {
                        contenidoDiv.innerHTML = tablaTransacciones.outerHTML;
                    } else {
                        contenidoDiv.innerHTML = '<div class="text-center text-gray-600 py-8">No hay transacciones disponibles</div>';
                    }
                    
                    // Ocultar loading y mostrar contenido
                    loadingDiv.classList.add('hidden');
                    contenidoDiv.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error al cargar transacciones:', error);
                    contenidoDiv.innerHTML = '<div class="text-center text-red-600 py-8">Error al cargar las transacciones</div>';
                    loadingDiv.classList.add('hidden');
                    contenidoDiv.classList.remove('hidden');
                });
        }
        
        // Función para cargar rutinas
        function cargarRutinas() {
            if (!clienteIdDetalles) return;
            
            // Por ahora, abrir en nueva ventana
            window.open(`/rutinas/ListaClienteRutina/${clienteIdDetalles}`, '_blank');
        }
        
        // Función para mostrar pestañas
        function mostrarPestana(pestana) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.contenido-pestana').forEach(contenido => {
                contenido.classList.add('hidden');
            });
            
            // Resetear todos los botones
            document.querySelectorAll('[id^="btn-"]').forEach(btn => {
                btn.classList.remove('text-blue-700', 'bg-blue-100');
                btn.classList.add('text-gray-600', 'bg-gray-100');
            });
            
            // Mostrar contenido seleccionado
            document.getElementById(`contenido-${pestana}`).classList.remove('hidden');
            
            // Activar botón seleccionado
            document.getElementById(`btn-${pestana}`).classList.remove('text-gray-600', 'bg-gray-100');
            document.getElementById(`btn-${pestana}`).classList.add('text-blue-700', 'bg-blue-100');
            
            // Cargar contenido específico según la pestaña
            if (pestana === 'transacciones') {
                // Limpiar contenido anterior de transacciones
                const contenidoTransacciones = document.getElementById('contenido-transacciones-real');
                if (contenidoTransacciones) {
                    contenidoTransacciones.innerHTML = '';
                }
                cargarTransacciones();
            } else if (pestana === 'rutinas') {
                cargarRutinas();
            }
        }
        
        // Función para obtener todos los datos de la tabla
        function obtenerDatosTabla(clienteId) {
            // Buscar la fila del cliente en la tabla actual
            const filas = document.querySelectorAll('tbody tr');
            
            filas.forEach(fila => {
                const celdas = fila.querySelectorAll('td');
                if (celdas.length > 0) {
                    const idCliente = celdas[0]?.textContent?.trim();
                    if (idCliente == clienteId) {
                        // Obtener datos de la tabla
                        const membresia = celdas[7]?.textContent?.trim() || 'No especificada';
                        const desde = celdas[8]?.textContent?.trim() || '';
                        const hasta = celdas[9]?.textContent?.trim() || '';
                        
                        // Llenar los campos del modal
                        document.getElementById('detalleMembresia').textContent = membresia;
                        document.getElementById('detalleDesde').textContent = desde;
                        document.getElementById('detalleHasta').textContent = hasta;
                    }
                }
            });
        }

        // Cerrar modal al hacer clic fuera de él
        const renovarModal = document.getElementById('renovarModal');
        if (renovarModal) {
            renovarModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRenovarModal();
                }
            });
        }

        const detallesModal = document.getElementById('detallesModal');
        if (detallesModal) {
            detallesModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDetallesModal();
                }
            });
        }

        const pagarModal = document.getElementById('pagarModal');
        if (pagarModal) {
            pagarModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closePagarModal();
                }
            });
        }

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRenovarModal();
                closeDetallesModal();
                closePagarModal();
            }
        });

        // Event listeners para el formulario de renovación
        document.addEventListener('DOMContentLoaded', function() {
            // Event listeners para campos del modal
            const modalMembresia = document.getElementById('modalMembresia');
            const modalDesde = document.getElementById('modalDesde');
            const modalAcuenta = document.getElementById('modalAcuenta');
            
            if (modalMembresia) {
                modalMembresia.addEventListener('change', consultarMembresia);
            }
            
            if (modalDesde) {
                modalDesde.addEventListener('change', consultarMembresia);
            }
            
            if (modalAcuenta) {
                modalAcuenta.addEventListener('blur', calcularPagoACuenta);
                modalAcuenta.addEventListener('keyup', calcularPagoACuenta);
            }

            // Event listeners para el modal de pago
            const pagarPagacon = document.getElementById('pagarPagacon');
            if (pagarPagacon) {
                pagarPagacon.addEventListener('input', function() {
                    calcularSaldoRestante();
                    // Regenerar QR si está activo
                    const pagoQR = document.getElementById('pagoQR');
                    if (pagoQR && pagoQR.checked) {
                        setTimeout(() => {
                            generarQR();
                        }, 100);
                    }
                });
            }


        });



        // Funciones del modal de pago
        function openPagarModal(id, nombre) {
            console.log('=== DEBUG: Abriendo modal de pago ===');
            console.log('ID del cliente:', id);
            console.log('Nombre del cliente:', nombre);
            
            // Limpiar formulario anterior
            document.getElementById('pagarForm').reset();
            
            // Asignar el ID del cliente
            clienteIdPagar = id;
            
            // Obtener datos del cliente mediante AJAX
            console.log('Haciendo fetch a:', `/clientePago-${id}`);
            fetch(`/clientePago-${id}`)
                .then(response => {
                    console.log('Respuesta recibida:', response.status);
                    return response.text();
                })
                .then(html => {
                    console.log('HTML recibido:', html.substring(0, 200) + '...');
                    
                    // Crear un elemento temporal para parsear el HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extraer datos del cliente
                    const clienteData = {
                        id_cliente: id,
                        nombre: nombre,
                        dni: doc.querySelector('[name="dni"]')?.value || '',
                        usuario: doc.querySelector('[name="usuario"]')?.value || '',
                        membresia: doc.querySelector('#nombreMembresia')?.value || '',
                        precio: doc.querySelector('#precio')?.value || '0',
                        debe: doc.querySelector('[name="debe"]')?.value || '0'
                    };
                    
                    console.log('Datos extraídos:', clienteData);
                    
                    // Llenar el formulario
                    console.log('Llenando formulario...');
                    document.getElementById('pagarIdCliente').value = clienteData.id_cliente;
                    document.getElementById('pagarDni').value = clienteData.dni;
                    document.getElementById('pagarUsuario').value = clienteData.usuario;
                    document.getElementById('pagarNombre').value = clienteData.nombre;
                    document.getElementById('pagarMembresia').value = clienteData.membresia;
                    document.getElementById('pagarPrecio').value = clienteData.precio;
                    document.getElementById('pagarDeuda').value = clienteData.debe;
                    document.getElementById('pagarSaldoRestante').value = clienteData.debe;
                    
                    // Mostrar el modal
                    console.log('Mostrando modal...');
                    document.getElementById('pagarModal').classList.remove('hidden');
                    console.log('Modal mostrado exitosamente');
                    
                    // Inicializar métodos de pago después de mostrar el modal
                    setTimeout(() => {
                        inicializarMetodosPago();
                    }, 100);
                })
                .catch(error => {
                    console.error('Error al obtener datos del cliente:', error);
                    alert('Error al cargar los datos del cliente');
                });
        }

        function closePagarModal() {
            document.getElementById('pagarModal').classList.add('hidden');
            clienteIdPagar = null;
            
            // Limpiar formulario
            document.getElementById('pagarForm').reset();
            
            // Limpiar QR
            const qrContainer = document.getElementById('qrContainer');
            if (qrContainer) {
                qrContainer.classList.add('hidden');
            }
            
            // Resetear método de pago a efectivo
            const pagoEfectivo = document.getElementById('pagoEfectivo');
            if (pagoEfectivo) {
                pagoEfectivo.checked = true;
            }
        }

        function calcularSaldoRestante() {
            const deuda = parseFloat(document.getElementById('pagarDeuda').value) || 0;
            const pagacon = parseFloat(document.getElementById('pagarPagacon').value) || 0;
            
            const saldoRestante = Math.max(0, deuda - pagacon);
            document.getElementById('pagarSaldoRestante').value = saldoRestante.toFixed(2);
        }

        function inicializarMetodosPago() {
            const pagoEfectivo = document.getElementById('pagoEfectivo');
            const pagoQR = document.getElementById('pagoQR');
            const qrContainer = document.getElementById('qrContainer');
            const qrCode = document.getElementById('qrCode');

            // Solo inicializar si los elementos existen (modal abierto)
            if (pagoQR && pagoEfectivo && qrContainer && qrCode) {
                pagoQR.addEventListener('change', function() {
                    if (this.checked) {
                        qrContainer.classList.remove('hidden');
                        generarQR();
                    } else {
                        qrContainer.classList.add('hidden');
                    }
                });

                pagoEfectivo.addEventListener('change', function() {
                    if (this.checked) {
                        qrContainer.classList.add('hidden');
                    }
                });
            }
        }

        function seleccionarMetodoPago(metodo) {
            const pagoEfectivo = document.getElementById('pagoEfectivo');
            const pagoQR = document.getElementById('pagoQR');
            const qrContainer = document.getElementById('qrContainer');
            
            if (metodo === 'efectivo') {
                pagoEfectivo.checked = true;
                pagoQR.checked = false;
                qrContainer.classList.add('hidden');
                
                // Actualizar estilos visuales
                document.querySelectorAll('[onclick*="seleccionarMetodoPago"]').forEach(div => {
                    div.classList.remove('border-green-300', 'border-blue-300');
                    div.classList.add('border-gray-200');
                });
                pagoEfectivo.closest('[onclick*="seleccionarMetodoPago"]').classList.add('border-green-300');
                
            } else if (metodo === 'qr') {
                pagoQR.checked = true;
                pagoEfectivo.checked = false;
                qrContainer.classList.remove('hidden');
                generarQR();
                
                // Actualizar estilos visuales
                document.querySelectorAll('[onclick*="seleccionarMetodoPago"]').forEach(div => {
                    div.classList.remove('border-green-300', 'border-blue-300');
                    div.classList.add('border-gray-200');
                });
                pagoQR.closest('[onclick*="seleccionarMetodoPago"]').classList.add('border-blue-300');
            }
        }

        function generarQR() {
            const monto = document.getElementById('pagarPagacon')?.value || '0';
            const clienteId = document.getElementById('pagarIdCliente')?.value || '';
            const clienteNombre = document.getElementById('pagarNombre')?.value || '';
            const clienteDni = document.getElementById('pagarDni')?.value || '';
            const membresia = document.getElementById('pagarMembresia')?.value || '';
            const qrCode = document.getElementById('qrCode');
            
            if (!qrCode) {
                console.error('Elemento QR no encontrado');
                return;
            }
            
            if (parseFloat(monto) <= 0) {
                qrCode.innerHTML = '<p class="text-yellow-500 text-sm">Ingrese un monto válido</p>';
                return;
            }
            
            // Crear datos para el QR con información más completa
            const datosQR = {
                gym: 'ATLAS GYM',
                monto: parseFloat(monto).toFixed(2),
                clienteId: clienteId,
                clienteNombre: clienteNombre,
                clienteDni: clienteDni,
                membresia: membresia,
                fecha: new Date().toISOString(),
                tipo: 'pago_gym',
                timestamp: Date.now()
            };

            const datosString = JSON.stringify(datosQR);
            
            // Limpiar contenedor anterior
            qrCode.innerHTML = '';
            
            // Verificar si QRCode está disponible
            if (typeof QRCode === 'undefined') {
                console.error('Librería QR no cargada');
                qrCode.innerHTML = '<p class="text-red-500 text-sm">Error: Librería QR no disponible</p>';
                return;
            }
            
            // Generar QR con mejor diseño
            QRCode.toCanvas(qrCode, datosString, {
                width: 220,
                margin: 3,
                color: {
                    dark: '#1f2937',
                    light: '#ffffff'
                },
                errorCorrectionLevel: 'M'
            }, function (error) {
                if (error) {
                    console.error('Error generando QR:', error);
                    qrCode.innerHTML = '<p class="text-red-500 text-sm">Error generando QR</p>';
                } else {
                    // Agregar información adicional debajo del QR
                    const infoDiv = document.createElement('div');
                    infoDiv.className = 'mt-3 text-center';
                    infoDiv.innerHTML = `
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-600 mb-1">Monto: S/. ${parseFloat(monto).toFixed(2)}</p>
                            <p class="text-xs text-gray-600 mb-1">Cliente: ${clienteNombre}</p>
                            <p class="text-xs text-gray-600">Fecha: ${new Date().toLocaleDateString('es-ES')}</p>
                        </div>
                    `;
                    qrCode.appendChild(infoDiv);
                }
            });
        }

        function validarFormularioPago() {
            console.log('=== DEBUG: Validando formulario de pago ===');
            
            const idcliente = document.getElementById('pagarIdCliente').value;
            const precio = document.getElementById('pagarPrecio').value;
            const pagacon = document.getElementById('pagarPagacon').value;
            const debe = document.getElementById('pagarSaldoRestante').value;
            const metodoPago = document.querySelector('input[name="metodoPago"]:checked')?.value || 'efectivo';
            
            console.log('Datos del formulario:');
            console.log('- idcliente:', idcliente);
            console.log('- precio:', precio);
            console.log('- pagacon:', pagacon);
            console.log('- debe:', debe);
            console.log('- método de pago:', metodoPago);
            
            if (!idcliente || !precio || !pagacon || !debe) {
                mostrarNotificacion('Por favor, complete todos los campos requeridos', 'error');
                return false;
            }
            
            if (parseFloat(pagacon) <= 0) {
                mostrarNotificacion('El monto a pagar debe ser mayor a 0', 'error');
                return false;
            }
            
            // Mostrar confirmación con SweetAlert2
            const clienteNombre = document.getElementById('pagarNombre').value;
            const monto = parseFloat(pagacon).toFixed(2);
            const metodoPagoTexto = metodoPago === 'qr' ? 'Pago por QR' : 'Efectivo';
            
            Swal.fire({
                title: '¿Confirmar Pago?',
                html: `
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <p class="text-lg font-semibold text-gray-800">S/. ${monto}</p>
                            <p class="text-sm text-gray-600">${metodoPagoTexto}</p>
                            <p class="text-sm text-gray-500">Cliente: ${clienteNombre}</p>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, Confirmar Pago',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'rounded-lg px-6 py-2',
                    cancelButton: 'rounded-lg px-6 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loading
                    Swal.fire({
                        title: 'Procesando Pago...',
                        html: `
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-3">
                                    <svg class="w-6 h-6 text-blue-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600">Registrando pago en el sistema...</p>
                            </div>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-lg'
                        }
                    });
                    
                    // Enviar formulario después de un pequeño delay para mostrar el loading
                    setTimeout(() => {
                        document.getElementById('pagarForm').submit();
                    }, 1000);
                }
            });
            
            return false; // Siempre retornar false para manejar el envío manualmente
        }

        function mostrarNotificacion(mensaje, tipo = 'info') {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out`;
            
            // Configurar colores según tipo
            switch (tipo) {
                case 'success':
                    notificacion.classList.add('bg-green-500', 'text-white');
                    break;
                case 'error':
                    notificacion.classList.add('bg-red-500', 'text-white');
                    break;
                case 'warning':
                    notificacion.classList.add('bg-yellow-500', 'text-white');
                    break;
                default:
                    notificacion.classList.add('bg-blue-500', 'text-white');
            }
            
            notificacion.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">${tipo === 'success' ? '¡Éxito!' : tipo === 'error' ? 'Error' : tipo === 'warning' ? 'Advertencia' : 'Información'}</p>
                        <p class="text-sm opacity-90">${mensaje}</p>
                    </div>
                </div>
            `;
            
            // Agregar al DOM
            document.body.appendChild(notificacion);
            
            // Animar entrada
            setTimeout(() => {
                notificacion.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notificacion.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notificacion.parentNode) {
                        notificacion.parentNode.removeChild(notificacion);
                    }
                }, 300);
            }, 3000);
        }

        // Manejo de eliminación de clientes
        document.querySelectorAll('.eliminar').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                
                Swal.fire({
                    title: '¿Eliminar cliente?',
                    text: `¿Estás seguro de que quieres eliminar el cliente con ID ${id}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-lg',
                        cancelButton: 'rounded-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Crear form dinámicamente
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/cliente/${id}`;
                        
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                        form.appendChild(methodInput);
                        form.appendChild(csrfInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // Función para calcular fecha hasta y días
        function calcularFechaHasta() {
            const membresiaSelect = document.getElementById('membresia');
            const desdeInput = document.getElementById('desde');
            const hastaInput = document.getElementById('hasta');
            const diasInput = document.getElementById('dias');
            
            const membresia = membresiaSelect?.value;
            const desde = desdeInput?.value;
            
            if (!membresia || !desde) return;
            
            // Mostrar loading en los campos (usar valor vacío en lugar de "Calculando...")
            if (hastaInput) {
                hastaInput.value = '';
                hastaInput.classList.add('bg-yellow-50', 'text-gray-500');
                hastaInput.placeholder = 'Calculando...';
            }
            if (diasInput) {
                diasInput.value = '';
                diasInput.classList.add('bg-yellow-50', 'text-gray-500');
                diasInput.placeholder = 'Calculando...';
            }
            
            fetch(`/consultar/registro/cliente/${membresia}/${desde}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (hastaInput) {
                        hastaInput.value = data.respuesta;
                        hastaInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        hastaInput.placeholder = '';
                    }
                    if (diasInput) {
                        diasInput.value = data.dias;
                        diasInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        diasInput.placeholder = '';
                    }
                    
                    // Mostrar notificación de éxito
                    Swal.fire({
                        title: 'Cálculo completado',
                        text: `Fecha hasta: ${data.respuesta} | Días: ${data.dias}`,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-lg'
                        }
                    });
                    
                    // Actualizar resumen si estamos en el paso 3
                    if (currentStep === 3) {
                        updateResumen();
                    }
                })
                .catch(error => {
                    console.error('Error al calcular fecha:', error);
                    if (hastaInput) {
                        hastaInput.value = '';
                        hastaInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        hastaInput.placeholder = '';
                    }
                    if (diasInput) {
                        diasInput.value = '';
                        diasInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        diasInput.placeholder = '';
                    }
                    
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo calcular la fecha automáticamente',
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    });
                });
        }

        // Función para el modal de renovación
        function calcularFechaHastaModal() {
            const modalMembresia = document.getElementById('modalMembresia');
            const modalDesde = document.getElementById('modalDesde');
            const modalHasta = document.getElementById('modalHasta');
            const modalDias = document.getElementById('modalDias');
            
            const membresia = modalMembresia.value;
            const desde = modalDesde.value;
            
            if (!membresia || !desde) return;
            
            // Mostrar loading
            modalHasta.value = '';
            modalDias.value = '';
            modalHasta.classList.add('bg-yellow-50', 'text-gray-500');
            modalDias.classList.add('bg-yellow-50', 'text-gray-500');
            modalHasta.placeholder = 'Calculando...';
            modalDias.placeholder = 'Calculando...';
            
            fetch(`/consultar/registro/cliente/${membresia}/${desde}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    modalHasta.value = data.respuesta;
                    modalDias.value = data.dias;
                    modalHasta.classList.remove('bg-yellow-50', 'text-gray-500');
                    modalDias.classList.remove('bg-yellow-50', 'text-gray-500');
                    modalHasta.placeholder = '';
                    modalDias.placeholder = '';
                    
                    // Actualizar otros campos del modal si es necesario
                    if (document.getElementById('modalPrecio')) {
                        document.getElementById('modalPrecio').value = data.precio;
                    }
                })
                .catch(error => {
                    console.error('Error al calcular fecha:', error);
                    modalHasta.value = '';
                    modalDias.value = '';
                    modalHasta.classList.remove('bg-yellow-50', 'text-gray-500');
                    modalDias.classList.remove('bg-yellow-50', 'text-gray-500');
                    modalHasta.placeholder = '';
                    modalDias.placeholder = '';
                });
        }

        // Funciones para métodos de pago en el wizard
        function seleccionarMetodoPagoWizard(metodo) {
            // Desmarcar todos los radio buttons
            document.querySelectorAll('input[name="metodoPago"]').forEach(radio => {
                radio.checked = false;
            });
            
            // Marcar el seleccionado
            if (metodo === 'efectivo') {
                document.getElementById('pagoEfectivoWizard').checked = true;
                document.getElementById('qrContainerWizard').classList.add('hidden');
            } else if (metodo === 'qr') {
                document.getElementById('pagoQRWizard').checked = true;
                document.getElementById('qrContainerWizard').classList.remove('hidden');
                // No generar QR automáticamente
            }
        }

        function generarQRWizard() {
            const qrContainer = document.getElementById('qrContainerWizard');
            const qrCodeDiv = document.getElementById('qrCodeWizard');
            
            if (!qrContainer || !qrCodeDiv) return;
            
            // Limpiar QR anterior
            qrCodeDiv.innerHTML = '';
            
            // Obtener datos del formulario
            const nombre = document.getElementById('nombre').value || 'Cliente';
            const precio = document.getElementById('precio').value || '0';
            const membresia = document.getElementById('membresia');
            const membresiaText = membresia.options[membresia.selectedIndex]?.text || 'Membresía';
            
            // Crear datos para el QR
            const datosQR = {
                nombre: nombre,
                membresia: membresiaText,
                precio: precio,
                fecha: new Date().toISOString().split('T')[0],
                metodo: 'QR'
            };
            
            const datosString = JSON.stringify(datosQR);
            
            // Generar QR usando la librería QR
            if (typeof QRCode !== 'undefined') {
                new QRCode(qrCodeDiv, {
                    text: datosString,
                    width: 128,
                    height: 128,
                    colorDark: '#000000',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H
                });
            } else {
                // Fallback si no está disponible la librería QR
                qrCodeDiv.innerHTML = `
                    <div class="bg-gray-200 w-32 h-32 mx-auto flex items-center justify-center rounded">
                        <div class="text-center">
                            <i class="fas fa-qrcode text-4xl text-gray-400 mb-2"></i>
                            <p class="text-xs text-gray-600">QR no disponible</p>
                        </div>
                    </div>
                `;
            }
        }

        // Función para actualizar el precio cuando cambie la membresía
        function actualizarPrecioMembresia() {
            const membresiaSelect = document.getElementById('membresia');
            const precioInput = document.getElementById('precio');
            
            if (!membresiaSelect || !precioInput) return;
            
            const membresiaId = membresiaSelect.value;
            if (!membresiaId) {
                precioInput.value = '';
                return;
            }
            
            // Obtener el precio de la membresía seleccionada
            fetch(`/consultar/precio/membresia/${membresiaId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener precio');
                    }
                    return response.json();
                })
                .then(data => {
                    precioInput.value = data.precio;
                })
                .catch(error => {
                    console.error('Error al obtener precio:', error);
                    precioInput.value = '';
                });
        }
    </script>
</div>

<!-- Modal de Pago -->
<div id="pagarModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Registrar Pago</h3>
                <button onclick="closePagarModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form id="pagarForm" action="{{ route('pagos.store') }}" method="POST" onsubmit="return validarFormularioPago()">
                    @csrf
                    <input type="hidden" name="idcliente" id="pagarIdCliente">
                    
                    <!-- Información del Cliente -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Datos del Cliente</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">DNI</label>
                                <input type="text" id="pagarDni" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                                <input type="text" id="pagarUsuario" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <input type="text" id="pagarNombre" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Datos del Pago -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Datos del Pago</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Membresía</label>
                                <input type="text" id="pagarMembresia" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Precio de la Membresía</label>
                                <input type="text" name="precio" id="pagarPrecio" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-red-100 text-red-600 font-bold" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deuda Actual</label>
                                <input type="text" id="pagarDeuda" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-red-100 text-red-600 font-bold" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Paga con</label>
                                <input type="number" step="0.01" name="pagacon" id="pagarPagacon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="0.00" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Saldo Restante</label>
                                <input type="text" name="debe" id="pagarSaldoRestante" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-red-600 font-bold" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Métodos de Pago -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Métodos de Pago</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors cursor-pointer" onclick="seleccionarMetodoPago('efectivo')">
                                <div class="flex items-center mb-3">
                                    <input type="radio" id="pagoEfectivo" name="metodoPago" value="efectivo" class="mr-2" checked>
                                    <label for="pagoEfectivo" class="text-sm font-medium text-gray-700 flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>
                                        Efectivo
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">Pago en efectivo al momento</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Disponible
                                    </span>
                                </div>
                            </div>
                            
                            <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors cursor-pointer" onclick="seleccionarMetodoPago('qr')">
                                <div class="flex items-center mb-3">
                                    <input type="radio" id="pagoQR" name="metodoPago" value="qr" class="mr-2">
                                    <label for="pagoQR" class="text-sm font-medium text-gray-700 flex items-center">
                                        <i class="fas fa-qrcode mr-2 text-blue-500"></i>
                                        Pago por QR
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">Escanea el código QR para pagar</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-mobile-alt mr-1"></i>
                                        Digital
                                    </span>
                                </div>
                                <div id="qrContainer" class="hidden mt-3">
                                    <div class="text-center">
                                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                                            <div id="qrCode" class="mx-auto mb-2"></div>
                                            <p class="text-xs text-gray-600 mb-2">Escanea este código con tu app de pagos</p>
                                            <div class="flex justify-center space-x-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fab fa-whatsapp mr-1"></i>
                                                    WhatsApp
                                                </span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-mobile-alt mr-1"></i>
                                                    Apps
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closePagarModal()" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                            Registrar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro de Cliente -->
<div id="registrarClienteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
            <!-- Header del Modal -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Registrar Nuevo Cliente</h3>
                <button onclick="closeRegistrarClienteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Indicador de Progreso -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div id="step1-indicator" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-semibold">1</div>
                        <span id="step1-text" class="text-sm font-medium text-blue-600">Datos de Membresía</span>
                    </div>
                    <div class="flex-1 mx-4">
                        <div class="h-1 bg-gray-200 rounded-full">
                            <div id="progress-bar" class="h-1 bg-blue-500 rounded-full transition-all duration-300" style="width: 33%"></div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div id="step2-indicator" class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-semibold">2</div>
                        <span id="step2-text" class="text-sm font-medium text-gray-500">Datos Personales</span>
                    </div>
                    <div class="flex-1 mx-4">
                        <div class="h-1 bg-gray-200 rounded-full">
                            <div class="h-1 bg-gray-200 rounded-full"></div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div id="step3-indicator" class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-semibold">3</div>
                        <span id="step3-text" class="text-sm font-medium text-gray-500">Datos de Pago</span>
                    </div>
                </div>
            </div>

            <!-- Contenido del Modal -->
            <div class="p-6">
                <form id="registrarClienteForm" action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Paso 1: Datos de Membresía -->
                    <div id="step1" class="step-content">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Paso 1: Datos de Membresía</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="membresia" class="block text-sm font-medium text-gray-700 mb-2">Membresía *</label>
                                <select name="membresia" id="membresia" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Seleccione una membresía</option>
                                    @foreach($membresia as $mem)
                                        <option value="{{ $mem->id_membresia }}">{{ $mem->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="desde" class="block text-sm font-medium text-gray-700 mb-2">Desde *</label>
                                <input type="date" name="desde" id="desde" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="hasta" class="block text-sm font-medium text-gray-700 mb-2">Hasta *</label>
                                <div class="flex space-x-2">
                                    <input type="date" name="hasta" id="hasta" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required readonly>
                                    <button type="button" onclick="calcularFechaHasta()" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors" title="Calcular automáticamente">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente basado en la membresía y fecha desde</p>
                            </div>
                            <div>
                                <label for="dias" class="block text-sm font-medium text-gray-700 mb-2">Días *</label>
                                <input type="number" name="dias" id="dias" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" required readonly>
                                <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente (excluyendo domingos)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 2: Datos Personales -->
                    <div id="step2" class="step-content hidden">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Paso 2: Datos Personales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label for="dni" class="block text-sm font-medium text-gray-700 mb-2">DNI *</label>
                                <input type="text" name="dni" id="dni" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="usuario" class="block text-sm font-medium text-gray-700 mb-2">Usuario *</label>
                                <input type="text" name="usuario" id="usuario" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña *</label>
                                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo *</label>
                                <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico *</label>
                                <input type="email" name="correo" id="correo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                                <input type="file" name="foto" id="foto" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
                                <p class="text-xs text-gray-500 mt-1">Formatos permitidos: JPG, JPEG, PNG</p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 3: Datos de Pago -->
                    <div id="step3" class="step-content hidden">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Paso 3: Datos de Pago</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio *</label>
                                <input type="number" step="0.01" name="precio" id="precio" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="acuenta" class="block text-sm font-medium text-gray-700 mb-2">A Cuenta</label>
                                <input type="number" step="0.01" name="acuenta" id="acuenta" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="0">
                            </div>
                            
                            <!-- Métodos de Pago -->
                            <div class="md:col-span-2">
                                <h5 class="text-sm font-semibold text-gray-700 mb-3">Métodos de Pago</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors cursor-pointer" onclick="seleccionarMetodoPagoWizard('efectivo')">
                                        <div class="flex items-center mb-3">
                                            <input type="radio" id="pagoEfectivoWizard" name="metodoPago" value="efectivo" class="mr-2" checked>
                                            <label for="pagoEfectivoWizard" class="text-sm font-medium text-gray-700 flex items-center">
                                                <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>
                                                Efectivo
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">Pago en efectivo al momento</p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i>
                                                Disponible
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors cursor-pointer" onclick="seleccionarMetodoPagoWizard('qr')">
                                        <div class="flex items-center mb-3">
                                            <input type="radio" id="pagoQRWizard" name="metodoPago" value="qr" class="mr-2">
                                            <label for="pagoQRWizard" class="text-sm font-medium text-gray-700 flex items-center">
                                                <i class="fas fa-qrcode mr-2 text-blue-500"></i>
                                                Pago por QR
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">Escanea el código QR para pagar</p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-mobile-alt mr-1"></i>
                                                Digital
                                            </span>
                                        </div>
                                        <div id="qrContainerWizard" class="hidden mt-3">
                                            <div class="text-center">
                                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                                    <div id="qrCodeWizard" class="mx-auto mb-2"></div>
                                                    <p class="text-xs text-gray-600 mb-2">Escanea este código con tu app de pagos</p>
                                                    <div class="flex justify-center space-x-2">
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            <i class="fab fa-whatsapp mr-1"></i>
                                                            WhatsApp
                                                        </span>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-mobile-alt mr-1"></i>
                                                            Apps
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h5 class="text-sm font-semibold text-gray-700 mb-2">Resumen del Cliente</h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                        <div><span class="font-medium">Nombre:</span> <span id="resumen-nombre">-</span></div>
                                        <div><span class="font-medium">DNI:</span> <span id="resumen-dni">-</span></div>
                                        <div><span class="font-medium">Usuario:</span> <span id="resumen-usuario">-</span></div>
                                        <div><span class="font-medium">Correo:</span> <span id="resumen-correo">-</span></div>
                                        <div><span class="font-medium">Membresía:</span> <span id="resumen-membresia">-</span></div>
                                        <div><span class="font-medium">Período:</span> <span id="resumen-periodo">-</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Navegación -->
                    <div class="flex justify-between pt-6 border-t border-gray-200 mt-6">
                        <button type="button" id="prev-btn" onclick="prevStep()" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors hidden">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Anterior
                        </button>
                        <div class="flex space-x-3">
                            <button type="button" onclick="closeRegistrarClienteModal()" class="px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                                Cancelar
                            </button>
                            <button type="button" id="next-btn" onclick="nextStep()" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                                Siguiente
                                <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            <button type="submit" id="submit-btn" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors hidden">
                                Registrar Cliente
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Variables para el wizard
    let currentStep = 1;
    const totalSteps = 3;

    // Funciones para el modal de registro de cliente
    function openRegistrarClienteModal() {
        // Limpiar formulario
        document.getElementById('registrarClienteForm').reset();
        
        // Establecer fecha actual como valor por defecto DESPUÉS del reset
        const today = new Date().toISOString().slice(0, 10);
        const desdeInput = document.getElementById('desde');
        if (desdeInput) {
            desdeInput.value = today;
        }
        
        // Establecer valor por defecto para acuenta
        const acuentaInput = document.getElementById('acuenta');
        if (acuentaInput) {
            acuentaInput.value = '0';
        }
        
        // Establecer método de pago por defecto
        const efectivoRadio = document.getElementById('pagoEfectivoWizard');
        if (efectivoRadio) {
            efectivoRadio.checked = true;
        }
        
        // Establecer primera membresía por defecto si no hay ninguna seleccionada
        const membresiaSelect = document.getElementById('membresia');
        if (membresiaSelect && membresiaSelect.options.length > 1 && !membresiaSelect.value) {
            membresiaSelect.selectedIndex = 1; // Seleccionar la primera opción (índice 1, saltando la opción vacía)
        }
        
        // Resetear wizard
        currentStep = 1;
        updateStepDisplay();
        
        // Mostrar modal
        document.getElementById('registrarClienteModal').classList.remove('hidden');
    }

    function closeRegistrarClienteModal() {
        document.getElementById('registrarClienteModal').classList.add('hidden');
        
        // Limpiar formulario
        document.getElementById('registrarClienteForm').reset();
        
        // Resetear wizard
        currentStep = 1;
        updateStepDisplay();
    }

    // Funciones de navegación del wizard
    async function nextStep() {
        if (validateCurrentStep()) {
            // Validación adicional para el paso 2 (datos personales)
            if (currentStep === 1) {
                // Verificar duplicados antes de pasar al paso 2
                const isValid = await validateDuplicates();
                if (!isValid) {
                    return;
                }
            }
            
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepDisplay();
                updateResumen();
            }
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    }

    function updateStepDisplay() {
        // Ocultar todos los pasos
        for (let i = 1; i <= totalSteps; i++) {
            document.getElementById(`step${i}`).classList.add('hidden');
        }
        
        // Mostrar paso actual
        document.getElementById(`step${currentStep}`).classList.remove('hidden');
        
        // Actualizar indicadores de progreso
        updateProgressIndicators();
        
        // Actualizar botones
        updateNavigationButtons();
    }

    function updateProgressIndicators() {
        const progressBar = document.getElementById('progress-bar');
        const progress = (currentStep / totalSteps) * 100;
        progressBar.style.width = `${progress}%`;
        
        // Actualizar indicadores de pasos
        for (let i = 1; i <= totalSteps; i++) {
            const indicator = document.getElementById(`step${i}-indicator`);
            const text = document.getElementById(`step${i}-text`);
            
            if (i < currentStep) {
                // Pasos completados
                indicator.className = 'w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-semibold';
                text.className = 'text-sm font-medium text-green-600';
            } else if (i === currentStep) {
                // Paso actual
                indicator.className = 'w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-semibold';
                text.className = 'text-sm font-medium text-blue-600';
            } else {
                // Pasos pendientes
                indicator.className = 'w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-semibold';
                text.className = 'text-sm font-medium text-gray-500';
            }
        }
    }

    function updateNavigationButtons() {
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        
        // Botón Anterior
        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }
        
        // Botón Siguiente/Registrar
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }

    function validateCurrentStep() {
        let isValid = true;
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        
        // Limpiar errores anteriores
        currentStepElement.querySelectorAll('.border-red-500').forEach(field => {
            field.classList.remove('border-red-500');
        });
        
        // Validar campos requeridos del paso actual
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            }
        });
        
        // Validación especial para el paso 1 (membresía)
        if (currentStep === 1) {
            const membresia = document.getElementById('membresia').value;
            const desde = document.getElementById('desde').value;
            const hasta = document.getElementById('hasta').value;
            const dias = document.getElementById('dias').value;
            
            if (!membresia || !desde) {
                isValid = false;
            } else if (!hasta || !dias) {
                // Si no se ha calculado la fecha, mostrar mensaje específico
                Swal.fire({
                    title: 'Cálculo pendiente',
                    text: 'Por favor espera a que se calcule la fecha hasta y los días automáticamente, o haz clic en el botón de calcular.',
                    icon: 'info',
                    confirmButtonColor: '#3b82f6',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-lg'
                    }
                });
                isValid = false;
            }
        }
        
        if (!isValid) {
            if (currentStep !== 1 || (document.getElementById('hasta')?.value && document.getElementById('dias')?.value)) {
                Swal.fire({
                    title: 'Campos requeridos',
                    text: 'Por favor completa todos los campos obligatorios del paso actual',
                    icon: 'warning',
                    confirmButtonColor: '#3b82f6',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-lg'
                    }
                });
            }
        }
        
        return isValid;
    }

    function updateResumen() {
        // Actualizar resumen en el paso 3
        document.getElementById('resumen-nombre').textContent = document.getElementById('nombre').value || '-';
        document.getElementById('resumen-dni').textContent = document.getElementById('dni').value || '-';
        document.getElementById('resumen-usuario').textContent = document.getElementById('usuario').value || '-';
        document.getElementById('resumen-correo').textContent = document.getElementById('correo').value || '-';
        
        // Membresía
        const membresiaSelect = document.getElementById('membresia');
        const membresiaText = membresiaSelect.options[membresiaSelect.selectedIndex]?.text || '-';
        document.getElementById('resumen-membresia').textContent = membresiaText;
        
        // Período
        const desde = document.getElementById('desde').value || '-';
        const hasta = document.getElementById('hasta').value || '-';
        document.getElementById('resumen-periodo').textContent = `${desde} a ${hasta}`;
    }

    // Manejar envío del formulario de registro
    document.getElementById('registrarClienteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar todos los campos requeridos
        const requiredFields = ['membresia', 'desde', 'hasta', 'dias', 'dni', 'usuario', 'password', 'nombre', 'correo', 'precio', 'metodoPago'];
        let isValid = true;
        
        requiredFields.forEach(field => {
            let element;
            if (field === 'metodoPago') {
                // Para radio buttons, verificar si alguno está seleccionado
                element = document.querySelector(`input[name="${field}"]:checked`);
                if (!element) {
                    // Marcar visualmente los contenedores de radio buttons
                    document.querySelectorAll(`input[name="${field}"]`).forEach(radio => {
                        radio.closest('.border-2').classList.add('border-red-500');
                    });
                    isValid = false;
                } else {
                    // Remover marcas de error
                    document.querySelectorAll(`input[name="${field}"]`).forEach(radio => {
                        radio.closest('.border-2').classList.remove('border-red-500');
                    });
                }
            } else {
                element = document.getElementById(field);
                if (!element.value.trim()) {
                    element.classList.add('border-red-500');
                    isValid = false;
                } else {
                    element.classList.remove('border-red-500');
                }
            }
        });
        
        if (!isValid) {
            Swal.fire({
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos obligatorios',
                icon: 'warning',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'rounded-lg'
                }
            });
            return;
        }
        
        // Mostrar loading
        Swal.fire({
            title: 'Registrando cliente...',
            text: 'Por favor espera',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Enviar formulario
        const formData = new FormData(this);
        
        // Validación adicional antes de enviar
        const membresia = document.getElementById('membresia').value;
        const desde = document.getElementById('desde').value;
        const hasta = document.getElementById('hasta').value;
        const dias = document.getElementById('dias').value;
        
        if (!membresia || !desde || !hasta || !dias) {
            Swal.fire({
                title: 'Datos incompletos',
                text: 'Por favor completa los datos de membresía antes de continuar',
                icon: 'warning',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'rounded-lg'
                }
            });
            return;
        }
        
        // Debug: mostrar datos que se envían
        console.log('Datos del formulario:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            }
            return response.text();
        })
        .then(data => {
            // Cerrar loading
            Swal.close();
            
            if (typeof data === 'object') {
                // Respuesta JSON
                if (data.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#10b981',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    }).then(() => {
                        // Cerrar modal
                        closeRegistrarClienteModal();
                        
                        // Refrescar la página para mostrar el nuevo cliente
                        window.location.reload();
                    });
                } else {
                    // Mostrar errores específicos si están disponibles
                    let errorMessage = data.message || 'Error al registrar cliente';
                    
                    if (data.errors) {
                        const errorDetails = Object.values(data.errors).flat().join('\n');
                        errorMessage = `Errores de validación:\n${errorDetails}`;
                        console.log('Errores de validación:', data.errors);
                        
                        // Mostrar errores específicos más claros
                        let specificMessage = 'Error de validación';
                        if (data.errors.dni) {
                            specificMessage = 'El DNI ya está registrado en el sistema';
                        } else if (data.errors.usuario) {
                            specificMessage = 'El nombre de usuario ya está en uso';
                        } else if (data.errors.correo) {
                            specificMessage = 'El correo electrónico ya está registrado';
                        } else if (data.errors.membresia || data.errors.desde || data.errors.hasta || data.errors.dias) {
                            specificMessage = 'Por favor completa los datos de membresía';
                        } else if (data.errors.precio) {
                            specificMessage = 'El precio es obligatorio';
                        } else if (data.errors.metodoPago) {
                            specificMessage = 'Debe seleccionar un método de pago';
                        }
                        
                        errorMessage = specificMessage;
                    }
                    
                    // Limpiar campos que causan errores de duplicación
                    if (data.errors) {
                        if (data.errors.dni) {
                            document.getElementById('dni').value = '';
                            document.getElementById('dni').classList.add('border-red-500');
                            // Generar DNI único
                            const nuevoDNI = Math.floor(Math.random() * 90000000) + 10000000;
                            document.getElementById('dni').placeholder = `Ejemplo: ${nuevoDNI}`;
                        }
                        if (data.errors.usuario) {
                            document.getElementById('usuario').value = '';
                            document.getElementById('usuario').classList.add('border-red-500');
                            // Generar usuario único
                            const nombres = ['usuario', 'cliente', 'gym', 'fitness', 'deportista'];
                            const randomNombre = nombres[Math.floor(Math.random() * nombres.length)];
                            const randomNum = Math.floor(Math.random() * 1000);
                            document.getElementById('usuario').placeholder = `Ejemplo: ${randomNombre}${randomNum}`;
                        }
                        if (data.errors.correo) {
                            document.getElementById('correo').value = '';
                            document.getElementById('correo').classList.add('border-red-500');
                            // Generar correo único
                            const randomNum = Math.floor(Math.random() * 10000);
                            document.getElementById('correo').placeholder = `Ejemplo: usuario${randomNum}@gmail.com`;
                        }
                    }
                    
                    Swal.fire({
                        title: 'Error',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    });
                }
            } else {
                // Respuesta HTML (fallback)
                if (data.includes('AVISO') || data.includes('INCORRECTO')) {
                    // Extraer mensaje de error
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const errorMessage = doc.querySelector('.alert-danger')?.textContent || 'Error al registrar cliente';
                    
                    Swal.fire({
                        title: 'Error',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    });
                } else {
                    // Mostrar respuesta completa para debug
                    console.log('Respuesta del servidor:', data);
                    Swal.fire({
                        title: 'Error',
                        text: 'Error inesperado. Revisa la consola para más detalles.',
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error en la petición:', error);
            Swal.close();
            Swal.fire({
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'rounded-lg'
                }
            });
        });
    });

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('registrarClienteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRegistrarClienteModal();
        }
    });

    // Cerrar modal con Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRegistrarClienteModal();
        }
    });

    // Actualizar resumen cuando cambien los campos
    document.addEventListener('DOMContentLoaded', function() {
        const resumenFields = ['nombre', 'dni', 'usuario', 'correo', 'membresia', 'desde', 'hasta'];
        resumenFields.forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.addEventListener('change', updateResumen);
                element.addEventListener('input', updateResumen);
            }
        });

        // Event listeners para cálculo automático
        const membresiaSelect = document.getElementById('membresia');
        const desdeInput = document.getElementById('desde');
        const hastaInput = document.getElementById('hasta');
        const diasInput = document.getElementById('dias');

        // Calcular automáticamente cuando cambie la membresía o la fecha desde
        if (membresiaSelect) {
            membresiaSelect.addEventListener('change', calcularFechaHasta);
            membresiaSelect.addEventListener('change', actualizarPrecioMembresia);
        }
        if (desdeInput) {
            desdeInput.addEventListener('change', calcularFechaHasta);
        }

        // Función para calcular fecha hasta y días
        function calcularFechaHasta() {
            const membresiaSelect = document.getElementById('membresia');
            const desdeInput = document.getElementById('desde');
            const hastaInput = document.getElementById('hasta');
            const diasInput = document.getElementById('dias');
            
            const membresia = membresiaSelect?.value;
            const desde = desdeInput?.value;
            
            if (!membresia || !desde) return;
            
            // Mostrar loading en los campos (usar valor vacío en lugar de "Calculando...")
            if (hastaInput) {
                hastaInput.value = '';
                hastaInput.classList.add('bg-yellow-50', 'text-gray-500');
                hastaInput.placeholder = 'Calculando...';
            }
            if (diasInput) {
                diasInput.value = '';
                diasInput.classList.add('bg-yellow-50', 'text-gray-500');
                diasInput.placeholder = 'Calculando...';
            }
            
            fetch(`/consultar/registro/cliente/${membresia}/${desde}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (hastaInput) {
                        hastaInput.value = data.respuesta;
                        hastaInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        hastaInput.placeholder = '';
                    }
                    if (diasInput) {
                        diasInput.value = data.dias;
                        diasInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        diasInput.placeholder = '';
                    }
                    
                    // Mostrar notificación de éxito
                    Swal.fire({
                        title: 'Cálculo completado',
                        text: `Fecha hasta: ${data.respuesta} | Días: ${data.dias}`,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-lg'
                        }
                    });
                    
                    // Actualizar resumen si estamos en el paso 3
                    if (currentStep === 3) {
                        updateResumen();
                    }
                })
                .catch(error => {
                    console.error('Error al calcular fecha:', error);
                    if (hastaInput) {
                        hastaInput.value = '';
                        hastaInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        hastaInput.placeholder = '';
                    }
                    if (diasInput) {
                        diasInput.value = '';
                        diasInput.classList.remove('bg-yellow-50', 'text-gray-500');
                        diasInput.placeholder = '';
                    }
                    
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo calcular la fecha automáticamente',
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        customClass: {
                            popup: 'rounded-lg',
                            confirmButton: 'rounded-lg'
                        }
                    });
                });
        }

        // Actualizar precio cuando cambie la membresía
        membresiaSelect.addEventListener('change', actualizarPrecioMembresia);
    });

    // Función para validar duplicados en tiempo real
    async function validateDuplicates() {
        const dni = document.getElementById('dni').value;
        const usuario = document.getElementById('usuario').value;
        const correo = document.getElementById('correo').value;
        
        if (!dni || !usuario || !correo) {
            return true; // Si no están llenos, no validar aún
        }
        
        // Mostrar loading
        Swal.fire({
            title: 'Verificando datos...',
            text: 'Comprobando que los datos sean únicos',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        try {
            // Verificar duplicados via AJAX
            const formData = new FormData();
            formData.append('dni', dni);
            formData.append('usuario', usuario);
            formData.append('correo', correo);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            const response = await fetch('/verificar/duplicados', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            Swal.close();
            
            if (data.success) {
                return true; // No hay duplicados, continuar
            } else {
                // Mostrar errores específicos
                let errorMessage = 'Los siguientes datos ya están registrados:\n';
                if (data.errors && data.errors.dni) {
                    errorMessage += '• DNI\n';
                    document.getElementById('dni').classList.add('border-red-500');
                }
                if (data.errors && data.errors.usuario) {
                    errorMessage += '• Usuario\n';
                    document.getElementById('usuario').classList.add('border-red-500');
                }
                if (data.errors && data.errors.correo) {
                    errorMessage += '• Correo electrónico\n';
                    document.getElementById('correo').classList.add('border-red-500');
                }
                
                Swal.fire({
                    title: 'Datos duplicados',
                    text: errorMessage,
                    icon: 'warning',
                    confirmButtonColor: '#3b82f6',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-lg'
                    }
                });
                return false;
            }
        } catch (error) {
            Swal.close();
            console.error('Error al verificar duplicados:', error);
            
            Swal.fire({
                title: 'Error de conexión',
                text: 'No se pudo verificar los datos. Intenta nuevamente.',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'rounded-lg'
                }
            });
            return true; // En caso de error, permitir continuar
        }
    }
</script>

@endsection
