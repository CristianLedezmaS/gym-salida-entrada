@extends('layouts/app')
@section('titulo', 'Asistencias')

@section('content')
<div class="text-light-text">

    <div class="w-full px-2">
        <h2 class="text-center text-accent-blue text-3xl font-bold mb-6">ASISTENCIAS DE CLIENTES</h2>

        <!-- Botones de Acción -->
        <div class="mb-6 flex flex-wrap gap-3">
            <button onclick="openReporteModal()" 
               class="inline-flex items-center px-4 py-2 bg-accent-blue hover:bg-accent-blue-hover text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Generar Reporte PDF
            </button>
            <a href="{{ route('reporte.asistencia') }}" 
               class="inline-flex items-center px-4 py-2 bg-accent-green hover:bg-accent-green-hover text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Descargar Excel
            </a>
        </div>

        <!-- Tabla de Asistencias -->
        <div class="bg-light-card rounded-lg shadow-sm border border-light-border overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-accent-blue text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-b-2 border-white">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-b-2 border-white">Cliente</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-b-2 border-white">Fecha y Hora</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold border-b-2 border-white">Marcado Por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sql as $item2)
                            <tr class="hover:bg-light-hover transition-colors border-b border-light-border">
                                <td class="px-4 py-3 text-sm text-light-text border-r border-light-border text-center">{{ $item2->id_asistencia }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-light-text border-r border-light-border">{{ $item2->nombre }}</td>
                                <td class="px-4 py-3 text-sm text-light-text border-r border-light-border">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-accent-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $item2->fecha_hora }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-light-text">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>{{ $item2->marcado_por }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        @if($sql->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-light-text-secondary">
                    Mostrando {{ $sql->firstItem() }} - {{ $sql->lastItem() }} de {{ $sql->total() }} resultados.
                </div>
                <div class="flex items-center space-x-2">
                    {{ $sql->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal de Reporte -->
<div id="reporteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Generar Reporte de Asistencias</h3>
                <button onclick="closeReporteModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('reporte.asistencia.pdf') }}" method="get" target="_blank">
                <div class="p-6">
                    <div class="mb-4">
                        <label for="clienteSelect" class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Cliente</label>
                        <select id="clienteSelect" name="cliente" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-blue focus:border-transparent" required>
                            <option value="">-- Seleccionar Cliente --</option>
                            @foreach ($cliente as $item)
                                <option value="{{ $item->id_cliente }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50 rounded-b-lg space-x-3">
                    <button type="button" onclick="closeReporteModal()" 
                            class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-accent-blue hover:bg-accent-blue-hover text-white rounded-lg transition-colors">
                        Generar Reporte
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openReporteModal() {
    document.getElementById('reporteModal').classList.remove('hidden');
}

function closeReporteModal() {
    document.getElementById('reporteModal').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.getElementById('reporteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReporteModal();
    }
});
</script>

@endsection
