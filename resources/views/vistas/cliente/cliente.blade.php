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
    
    /* Estilos para el contenedor del calendario */
    #detalleCalendar {
        background: white !important;
        border-radius: 8px !important;
        overflow: visible !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        min-height: 450px !important;
        height: auto !important;
    }
    
    /* Asegurar que el calendario tenga altura mínima y se muestre completo */
    #detalleCalendar .fc-view-harness {
        min-height: 400px !important;
        height: auto !important;
    }
    
    #detalleCalendar .fc-scroller {
        overflow: visible !important;
        height: auto !important;
    }
    
    #detalleCalendar .fc-scroller-liquid {
        height: auto !important;
    }
    
    /* Estilos para los días del calendario */
    #detalleCalendar .fc-daygrid-day-frame {
        min-height: 40px !important;
    }
    
    /* Estilos para el header del calendario */
    #detalleCalendar .fc-header-toolbar {
        margin-bottom: 0 !important;
        padding: 15px !important;
        border-bottom: 1px solid #e5e7eb !important;
    }
    
    /* Estilos para los botones del calendario */
    #detalleCalendar .fc-button-primary {
        background-color: #3b82f6 !important;
        border-color: #3b82f6 !important;
        color: white !important;
        font-weight: 500 !important;
        padding: 6px 12px !important;
        border-radius: 6px !important;
    }
    
    #detalleCalendar .fc-button-primary:hover {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
    }
    
    #detalleCalendar .fc-button-primary:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3) !important;
    }
    
    /* Estilos para el título del calendario */
    #detalleCalendar .fc-toolbar-title {
        font-size: 1.1rem !important;
        font-weight: 600 !important;
        color: #1f2937 !important;
    }
    
    /* Estilos para los días de la semana */
    #detalleCalendar .fc-col-header-cell {
        background-color: #f9fafb !important;
        border-color: #e5e7eb !important;
        font-weight: 600 !important;
        color: #374151 !important;
        padding: 8px 0 !important;
    }
    
    /* Estilos para las celdas de días */
    #detalleCalendar .fc-daygrid-day {
        border-color: #e5e7eb !important;
    }
    
    #detalleCalendar .fc-daygrid-day-frame {
        padding: 4px !important;
    }
    
    /* Estilos para el número del día */
    #detalleCalendar .fc-daygrid-day-number {
        font-weight: 500 !important;
        color: #374151 !important;
    }
    
    /* Estilos para días de otros meses */
    #detalleCalendar .fc-day-other {
        background-color: #f9fafb !important;
    }
    
    #detalleCalendar .fc-day-other .fc-daygrid-day-number {
        color: #9ca3af !important;
    }
    
    /* Estilos para el día actual */
    #detalleCalendar .fc-day-today {
        background-color: #eff6ff !important;
    }
    
    #detalleCalendar .fc-day-today .fc-daygrid-day-number {
        background-color: #3b82f6 !important;
        color: white !important;
        border-radius: 50% !important;
        width: 24px !important;
        height: 24px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    /* Asegurar que el modal tenga suficiente espacio para el calendario */
    #detallesModal > div {
        max-height: 95vh !important;
        overflow-y: auto !important;
    }
    
    /* Asegurar que el contenedor del calendario tenga espacio suficiente */
    #contenido-asistencia {
        min-height: 500px !important;
    }
    
    /* Estilos para SweetAlert2 - asegurar que aparezca sobre modales */
    .swal2-container {
        z-index: 999999 !important;
    }
    
    .swal2-popup {
        z-index: 999999 !important;
    }
    
    .swal2-container-high-z {
        z-index: 999999 !important;
    }
    
    /* Estilos para notificaciones - asegurar que aparezcan sobre todo */
    .notificacion-sistema {
        z-index: 999999 !important;
    }
</style>

@section('content')
<div style="background: linear-gradient(135deg, #232046 0%, #2d225a 100%); min-height: 100vh; padding: 2rem; margin: 0; border: none;">

    <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 2rem 1.5rem; border: 1px solid #FFD70033; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10); color: #F3F4F6;">
        
        <h2 style="font-size: 2.5rem; font-weight: bold; background: linear-gradient(135deg, #FFD700, #FFA500); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1rem; text-align: center;">GESTIONAR CLIENTES REGISTRADOS</h2>
        
        <div style="height: 2px; background: linear-gradient(90deg, #FFD700, #FFA500); margin-bottom: 2rem;"></div>

        <div style="margin-bottom: 1.5rem;">
            <button onclick="openRegistrarClienteModal()" 
               style="background: linear-gradient(135deg, #FFD700, #FFA500); color: white; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; display: inline-flex; align-items: center; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                </svg>
                Registrar Cliente
            </button>
        </div>

        <!-- Botones para los reportes -->
        <div style="margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 12px;">
            <a href="{{ route('reporte.membresiaActiva.pdf') }}" 
               style="background: linear-gradient(135deg, #10B981, #059669); color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                </svg>
                Reporte Membresía Activa (PDF)
            </a>
            <a href="{{ route('reporte.morosos.pdf') }}" 
               style="background: linear-gradient(135deg, #F59E0B, #D97706); color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0021.75 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 006.75 21h15z"></path>
                </svg>
                Reporte Morosos (PDF)
            </a>
            <a href="{{ route('reporte.ingresos.pdf') }}" 
               style="background: linear-gradient(135deg, #8B5CF6, #7C3AED); color: white; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-1.5c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v1.5m-18 0H3m16.5 0h.008v.008h-.008V18.75zm-3.75-4.5v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75"></path>
                </svg>
                Reporte Ingresos (PDF)
            </a>
        </div>

        <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid #FFD70033; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 100%;">
                <thead style="background: linear-gradient(135deg, #4B0082, #800080); color: white;">
                    <tr>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">ID</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Registrado por</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">CI</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Nombres</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Usuario</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Correo</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Teléfono</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Membresía</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Desde</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Hasta</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Días Rest.</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Pago</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sql as $key => $item)
                        <tr style="border-bottom: 1px solid rgba(255,215,0,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,215,0,0.1)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->id_cliente }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->creado_por }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->dni }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; font-weight: 500; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->nombre }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->usuario }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->correo }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->telefono }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->nomMem }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->desde }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item->hasta }}</td>
                            <td style="padding: 12px 8px; font-size: 14px; border-right: 1px solid rgba(255,215,0,0.2);">
                                 @if ($item->DR <= 7 and $item->DR >= 5)
                                    <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; background: linear-gradient(135deg, #F59E0B, #D97706); color: white;">{{ $item->DR }}</span>
                                @else
                                    @if ($item->DR < 5)
                                        <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; background: linear-gradient(135deg, #EF4444, #DC2626); color: white;">{{ $item->DR }}</span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; background: linear-gradient(135deg, #10B981, #059669); color: white;">{{ $item->DR }}</span>
                                    @endif
                                @endif
                            </td>
                            <td style="padding: 12px 8px; font-size: 14px; border-right: 1px solid rgba(255,215,0,0.2);">
                                @if ($item->debe == null or $item->debe == 0)
                                    <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; background: linear-gradient(135deg, #10B981, #059669); color: white;">Pagado</span>
                                @else
                                    <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; background: linear-gradient(135deg, #EF4444, #DC2626); color: white;">Deuda</span>
                                @endif
                                @if ($item->pago > 0)
                                    <div style="font-size: 12px; color: #9CA3AF; margin-top: 4px;">
                                        Pagado: ${{ number_format($item->pago, 2) }}
                                    </div>
                                @endif
                            </td>
                                                          <td style="padding: 12px 8px; font-size: 14px;">
                                  <div style="display: flex; align-items: center; gap: 4px;">
                                @if ($item->debe == null or $item->debe == 0)
                                @else
                                        <!-- Botón de pago eliminado - ahora usa modal -->
                                @endif
                                    <button onclick="openRenovarModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                            style="padding: 8px; background: linear-gradient(135deg, #0EA5E9, #0284C7); color: white; border-radius: 8px; border: none; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Renovar">
                                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-1.5c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v1.5m-18 0H3m16.5 0h.008v.008h-.008V18.75zm-3.75-4.5v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75m-4.5 0v.75m0 0v.75m0-4.5v.75m0 0v.75"></path>
                                        </svg>
                                    </button>
                                    <button onclick="openDetallesModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                            style="padding: 8px; background: linear-gradient(135deg, #6366F1, #4F46E5); color: white; border-radius: 8px; border: none; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Ver detalles">
                                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.639 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.639 0-8.573-3.007-9.963-7.178z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                    @if($item->debe > 0)
                                        <button onclick="openPagarModal({{ $item->id_cliente }}, '{{ $item->nombre }}')"
                                                style="padding: 8px; background: linear-gradient(135deg, #10B981, #059669); color: white; border-radius: 8px; border: none; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Pagar">
                                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </button>
                                    @endif
                                    <button onclick="openEditarModal({{ $item->id_cliente }})"
                                       style="padding: 8px; background: linear-gradient(135deg, #F97316, #EA580C); color: white; border-radius: 8px; border: none; display: inline-block; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Editar">
                                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                        </svg>
                                    </button>
                                    <a href="#" style="padding: 8px; background: linear-gradient(135deg, #EF4444, #DC2626); color: white; border-radius: 8px; text-decoration: none; display: inline-block; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" class="eliminar"
                                       data-id="{{ $item->id_cliente }}" title="Eliminar">
                                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
</div>

<!-- Modal de Renovación -->
<div id="renovarModal" class="hidden" style="position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); display:flex; align-items:center; justify-content:center;">
    <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:800px; width:95%; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative;">
        <button onclick="closeRenovarModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
        <h3 style="font-size:1.5rem; font-weight:600; color:#FFD700; margin-bottom:1.5rem; text-align:center;">Renovar Membresía</h3>
        <form id="renovarForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_cliente" id="modalIdCliente">
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Tipo de membresía</label>
                    <select name="membresia" id="modalMembresia" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6;">
                        <option value="">Seleccionar Membresía</option>
                        @foreach ($membresia ?? [] as $item2)
                            <option value="{{ $item2->id_membresia }}">{{ $item2->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Precio</label>
                    <input type="text" name="precio" id="modalPrecio" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Desde</label>
                    <input type="date" name="desde" id="modalDesde" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6;">
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Hasta</label>
                    <div style="display:flex; gap:0.5rem;">
                        <input type="date" name="hasta" id="modalHasta" required readonly style="flex:1; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                        <button type="button" onclick="calcularFechaHastaModal()" style="padding:10px; background:linear-gradient(135deg,#0EA5E9,#0284C7); color:white; border-radius:8px; border:none; cursor:pointer;" title="Calcular automáticamente">
                            <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    <p style="font-size:12px; color:#9CA3AF; margin-top:4px;">Se calcula automáticamente basado en la membresía y fecha desde</p>
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">N° de entradas que le quedaban al cliente anteriormente</label>
                    <input type="number" name="dias" id="modalDias" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Monto que debía el cliente anteriormente S/.</label>
                    <input type="text" name="debe" id="modalDebe" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#EF4444; font-weight:600;">
                </div>

                <div style="grid-column:span 2;">
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Total a pagar (precio+debe)</label>
                    <input type="text" name="total" id="modalTotal" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#EF4444; font-weight:600;">
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">A cuenta (Ingrese el monto del adelanto)</label>
                    <input type="number" step="0.5" name="acuenta" id="modalAcuenta" value="0" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6;">
                </div>

                <div>
                    <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Pago restante (total a pagar - a cuenta)</label>
                    <input type="text" name="pagoRestante" id="modalPagoRestante" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#EF4444; font-weight:600;">
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:1.5rem;">
                <button type="button" onclick="closeRenovarModal()" style="padding:8px 18px; background:rgba(255,255,255,0.10); color:#F3F4F6; border:none; border-radius:8px; font-weight:500; cursor:pointer;">Cancelar</button>
                <button type="submit" style="padding:8px 18px; background:linear-gradient(135deg,#0EA5E9,#0284C7); color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Renovar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Editar Cliente -->
<div id="editarModal" class="hidden" style="position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); display:flex; align-items:center; justify-content:center;">
    <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:1000px; width:95%; max-height:90vh; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative; overflow-y:auto;">
        <button onclick="closeEditarModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
        
        <h2 style="color:#FFD700; text-align:center; margin-bottom:2rem; font-size:1.5rem; font-weight:bold;">Editar Cliente</h2>
        
        <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem;">
            <form id="editarClienteForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_cliente" id="editarIdCliente">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="editarDni" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">DNI *</label>
                        <input type="text" name="dni" id="editarDni" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                    </div>
                    <div>
                        <label for="editarUsuario" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Usuario *</label>
                        <input type="text" name="usuario" id="editarUsuario" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="editarNombre" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Nombre Completo *</label>
                        <input type="text" name="nombre" id="editarNombre" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                    </div>
                    <div>
                        <label for="editarTelefono" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Teléfono</label>
                        <input type="text" name="telefono" id="editarTelefono" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;">
                    </div>
                    <div>
                        <label for="editarDireccion" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Dirección</label>
                        <input type="text" name="direccion" id="editarDireccion" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;">
                    </div>
                    <div>
                        <label for="editarCorreo" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Correo Electrónico *</label>
                        <input type="email" name="correo" id="editarCorreo" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                    </div>
                    <div>
                        <label for="editarPassword" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Contraseña (dejar vacío para no cambiar)</label>
                        <input type="password" name="password" id="editarPassword" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;">
                    </div>
                </div>
                
                <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:1.5rem;">
                    <button type="button" onclick="closeEditarModal()" style="background:rgba(255,255,255,0.1); color:#F3F4F6; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">Cancelar</button>
                    <button type="submit" style="background:linear-gradient(135deg,#10B981,#059669); color:white; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">Actualizar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Detalles del Cliente -->
<div id="detallesModal" class="hidden" style="position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); display:flex; align-items:center; justify-content:center;">
    <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:1000px; width:95%; max-height:90vh; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative; overflow-y:auto;">
        <button onclick="closeDetallesModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
        
        <h2 style="color:#FFD700; text-align:center; margin-bottom:2rem; font-size:1.5rem; font-weight:bold;">Detalles del Cliente</h2>
        
        <!-- Pestañas -->
        <div style="display:flex; gap:0.5rem; margin-bottom:2rem; border-bottom:2px solid rgba(255,215,0,0.3); padding-bottom:1rem;">
            <button onclick="cambiarPestana('informacion')" class="pestana-btn" style="background:linear-gradient(135deg,#FFD700,#FFA500); color:#232046; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">Información</button>
            <button onclick="cambiarPestana('transacciones')" class="pestana-btn" style="background:rgba(255,255,255,0.1); color:#F3F4F6; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">Transacciones</button>
            <button onclick="cambiarPestana('asistencia')" class="pestana-btn" style="background:rgba(255,255,255,0.1); color:#F3F4F6; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">Asistencia</button>
        </div>
        
        <!-- Contenido de Información Personal -->
        <div id="contenido-informacion" class="contenido-pestana">
            <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem;">
                <h3 style="color:#FFD700; margin-bottom:1rem; font-size:1.2rem; font-weight:bold;">Información Personal</h3>
                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:1rem;">
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">DNI:</label>
                        <span id="detalleDni" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Usuario:</label>
                        <span id="detalleUsuario" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Nombre:</label>
                        <span id="detalleNombre" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Correo:</label>
                        <span id="detalleCorreo" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Teléfono:</label>
                        <span id="detalleTelefono" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Dirección:</label>
                        <span id="detalleDireccion" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                </div>
            </div>
            
            <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem;">
                <h3 style="color:#FFD700; margin-bottom:1rem; font-size:1.2rem; font-weight:bold;">Información de Membresía</h3>
                <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:1rem;">
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Membresía:</label>
                        <span id="detalleMembresia" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Desde:</label>
                        <span id="detalleDesde" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                    <div>
                        <label style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Hasta:</label>
                        <span id="detalleHasta" style="color:#F3F4F6; font-weight:500;"></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contenido de Transacciones -->
        <div id="contenido-transacciones" class="contenido-pestana hidden">
            <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem;">
                <h3 style="color:#FFD700; margin-bottom:1rem; font-size:1.2rem; font-weight:bold;">Historial de Transacciones</h3>
                <div id="transacciones-content" style="min-height:200px; color:#F3F4F6;">
                    <p style="text-align:center; color:#9CA3AF;">Cargando transacciones...</p>
                </div>
            </div>
        </div>
        
        <!-- Contenido de Asistencia -->
        <div id="contenido-asistencia" class="contenido-pestana hidden">
            <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem;">
                <h3 style="color:#FFD700; margin-bottom:1rem; font-size:1.2rem; font-weight:bold;">Calendario de Asistencias</h3>
                <div id="detalleCalendar" style="min-height:400px; background:white; border-radius:8px; overflow:hidden;"></div>
            </div>
        </div>
        
        <!-- Estado de Pago -->
        <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem; margin-top:1.5rem;">
            <h3 style="color:#FFD700; margin-bottom:1rem; font-size:1.2rem; font-weight:bold;">Estado de Pago</h3>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; margin-bottom:1rem;">
                <div style="background:linear-gradient(135deg,#3B82F6,#1D4ED8); padding:1rem; border-radius:12px; text-align:center;">
                    <h4 style="color:white; font-size:0.875rem; font-weight:600; margin-bottom:0.5rem;">CLASES RESTANTES</h4>
                    <p id="detalleClasesRestantes" style="color:white; font-size:1.5rem; font-weight:bold; margin:0;">0</p>
                </div>
                <div style="background:linear-gradient(135deg,#EF4444,#DC2626); padding:1rem; border-radius:12px; text-align:center;">
                    <h4 style="color:white; font-size:0.875rem; font-weight:600; margin-bottom:0.5rem;">DEUDA</h4>
                    <p id="detalleDeuda" style="color:white; font-size:1.5rem; font-weight:bold; margin:0;">S/. 0</p>
                </div>
                <div style="background:linear-gradient(135deg,#F59E0B,#D97706); padding:1rem; border-radius:12px; text-align:center;">
                    <h4 style="color:white; font-size:0.875rem; font-weight:600; margin-bottom:0.5rem;">ESTADO</h4>
                    <p id="detalleEstado" style="color:white; font-size:1.5rem; font-weight:bold; margin:0; text-shadow:1px 1px 2px rgba(0,0,0,0.5);">AL DÍA</p>
                </div>
                <div style="background:linear-gradient(135deg,#10B981,#059669); padding:1rem; border-radius:12px; text-align:center;">
                    <h4 style="color:white; font-size:0.875rem; font-weight:600; margin-bottom:0.5rem;">ACCIONES</h4>
                    <button id="btnPagar" onclick="pagarCliente()" style="background:white; color:#10B981; border:none; padding:0.5rem 1rem; border-radius:8px; font-weight:600; cursor:pointer; display:none;">Pagar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Pago -->
<div id="pagarModal" class="hidden" style="position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); display:flex; align-items:center; justify-content:center;">
    <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:800px; width:95%; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative;">
        <button onclick="closePagarModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
        <h3 style="font-size:1.5rem; font-weight:600; color:#FFD700; margin-bottom:1.5rem; text-align:center;">Registrar Pago</h3>
        <form id="pagarForm" action="{{ route('pagos.store') }}" method="POST" onsubmit="return validarFormularioPago()">
            @csrf
            <input type="hidden" name="idcliente" id="pagarIdCliente">
            
            <!-- Información del Cliente -->
            <div style="margin-bottom:1.5rem;">
                <h4 style="font-size:1.2rem; font-weight:600; color:#FFD700; margin-bottom:1rem;">Datos del Cliente</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">DNI</label>
                        <input type="text" id="pagarDni" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Usuario</label>
                        <input type="text" id="pagarUsuario" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Nombre</label>
                        <input type="text" id="pagarNombre" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                    </div>
                </div>
            </div>

            <!-- Datos del Pago -->
            <div style="margin-bottom:1.5rem;">
                <h4 style="font-size:1.2rem; font-weight:600; color:#FFD700; margin-bottom:1rem;">Datos del Pago</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Membresía</label>
                        <input type="text" id="pagarMembresia" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#F3F4F6;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Precio de la Membresía</label>
                        <input type="text" name="precio" id="pagarPrecio" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(239,68,68,0.2); color:#EF4444; font-weight:600;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Deuda Actual</label>
                        <input type="text" id="pagarDeuda" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(239,68,68,0.2); color:#EF4444; font-weight:600;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Paga con</label>
                        <input type="number" step="0.01" name="pagacon" id="pagarPagacon" placeholder="0.00" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500; display:block; margin-bottom:0.5rem;">Saldo Restante</label>
                        <input type="text" name="debe" id="pagarSaldoRestante" readonly style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.5); color:#EF4444; font-weight:600;">
                    </div>
                </div>
            </div>

            <!-- Métodos de Pago -->
            <div style="margin-bottom:1.5rem;">
                <h4 style="font-size:1.2rem; font-weight:600; color:#FFD700; margin-bottom:1rem;">Métodos de Pago</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div style="border:2px solid rgba(255,215,0,0.3); border-radius:12px; padding:1rem; cursor:pointer; transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(16,185,129,0.5)'" onmouseout="this.style.borderColor='rgba(255,215,0,0.3)'" onclick="seleccionarMetodoPago('efectivo')">
                        <div style="display:flex; align-items:center; margin-bottom:0.75rem;">
                            <input type="radio" id="pagoEfectivo" name="metodoPago" value="efectivo" style="margin-right:0.5rem;" checked>
                            <label for="pagoEfectivo" style="color:#F3F4F6; font-size:0.9rem; font-weight:500; display:flex; align-items:center; cursor:pointer;">
                                <i class="fas fa-money-bill-wave" style="margin-right:0.5rem; color:#10B981;"></i>
                                Efectivo
                            </label>
                        </div>
                        <p style="font-size:0.75rem; color:#9CA3AF;">Pago en efectivo al momento</p>
                        <div style="margin-top:0.5rem;">
                            <span style="display:inline-flex; align-items:center; padding:4px 8px; border-radius:9999px; font-size:0.75rem; font-weight:500; background:rgba(16,185,129,0.2); color:#10B981;">
                                <i class="fas fa-check" style="margin-right:0.25rem;"></i>
                                Disponible
                            </span>
                        </div>
                    </div>
                    
                    <div style="border:2px solid rgba(255,215,0,0.3); border-radius:12px; padding:1rem; cursor:pointer; transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(59,130,246,0.5)'" onmouseout="this.style.borderColor='rgba(255,215,0,0.3)'" onclick="seleccionarMetodoPago('qr')">
                        <div style="display:flex; align-items:center; margin-bottom:0.75rem;">
                            <input type="radio" id="pagoQR" name="metodoPago" value="qr" style="margin-right:0.5rem;">
                            <label for="pagoQR" style="color:#F3F4F6; font-size:0.9rem; font-weight:500; display:flex; align-items:center; cursor:pointer;">
                                <i class="fas fa-qrcode" style="margin-right:0.5rem; color:#3B82F6;"></i>
                                Pago por QR
                            </label>
                        </div>
                        <p style="font-size:0.75rem; color:#9CA3AF;">Escanea el código QR para pagar</p>
                        <div style="margin-top:0.5rem;">
                            <span style="display:inline-flex; align-items:center; padding:4px 8px; border-radius:9999px; font-size:0.75rem; font-weight:500; background:rgba(59,130,246,0.2); color:#3B82F6;">
                                <i class="fas fa-mobile-alt" style="margin-right:0.25rem;"></i>
                                Digital
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Contenedor QR -->
                <div id="qrContainer" style="display:none; margin-top:1rem; text-align:center;">
                    <div style="background:rgba(255,255,255,0.1); padding:1rem; border-radius:12px; border:1px solid rgba(255,255,255,0.3);">
                        <h5 style="color:#F3F4F6; font-size:1rem; font-weight:600; margin-bottom:0.5rem;">Código QR para Pago</h5>
                        <div id="qrCode" style="display:inline-block; padding:1rem; background:white; border-radius:8px;"></div>
                        <p style="color:#9CA3AF; font-size:0.875rem; margin-top:0.5rem;">Escanea este código con tu aplicación de pagos</p>
                    </div>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:1.5rem;">
                <button type="button" onclick="closePagarModal()" style="padding:8px 18px; background:rgba(255,255,255,0.10); color:#F3F4F6; border:none; border-radius:8px; font-weight:500; cursor:pointer;">Cancelar</button>
                <button type="submit" style="padding:8px 18px; background:linear-gradient(135deg,#10B981,#059669); color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Registrar Pago</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Registro de Cliente -->
<div id="registrarClienteModal" class="hidden" style="position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); display:flex; align-items:center; justify-content:center;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:1000px; width:95%; max-height:90vh; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative; overflow-y:auto;">
                    <button onclick="closeRegistrarClienteModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
        
        <h2 style="color:#FFD700; text-align:center; margin-bottom:2rem; font-size:1.5rem; font-weight:bold;">Registrar Nuevo Cliente</h2>

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
            <div style="background:rgba(255,255,255,0.05); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem;">
                <form id="registrarClienteForm" action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Paso 1: Datos de Membresía -->
                    <div id="step1" class="step-content">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Paso 1: Datos de Membresía</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="membresia" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Membresía *</label>
                                <select name="membresia" id="membresia" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                                    <option value="">Seleccione una membresía</option>
                                    @foreach($membresia as $mem)
                                        <option value="{{ $mem->id_membresia }}">{{ $mem->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="desde" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Desde *</label>
                                <input type="date" name="desde" id="desde" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="hasta" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Hasta *</label>
                                <div class="flex space-x-2">
                                    <input type="date" name="hasta" id="hasta" style="flex: 1; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required readonly>
                                                                          <button type="button" onclick="calcularFechaHasta()" style="background:linear-gradient(135deg,#0EA5E9,#0284C7); color:white; padding:0.5rem; border:none; border-radius:8px; cursor:pointer; transition:all 0.3s ease;" title="Calcular automáticamente">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente basado en la membresía y fecha desde</p>
                            </div>
                            <div>
                                <label for="dias" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Días *</label>
                                <input type="number" name="dias" id="dias" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required readonly>
                                <p style="font-size: 0.75rem; color: #9CA3AF; margin-top: 0.25rem;">Se calcula automáticamente (excluyendo domingos)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 2: Datos Personales -->
                    <div id="step2" class="step-content hidden">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Paso 2: Datos Personales</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label for="dni" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">DNI *</label>
                                <input type="text" name="dni" id="dni" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="usuario" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Usuario *</label>
                                <input type="text" name="usuario" id="usuario" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="password" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Contraseña *</label>
                                <input type="password" name="password" id="password" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="nombre" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Nombre Completo *</label>
                                <input type="text" name="nombre" id="nombre" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="correo" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Correo Electrónico *</label>
                                <input type="email" name="correo" id="correo" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="telefono" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;">
                            </div>
                            <div>
                                <label for="direccion" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Dirección</label>
                                <input type="text" name="direccion" id="direccion" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;">
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
                                <label for="precio" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">Precio *</label>
                                <input type="number" step="0.01" name="precio" id="precio" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" required>
                            </div>
                            <div>
                                <label for="acuenta" style="color:#E5E7EB; font-weight:600; display:block; margin-bottom:0.5rem;">A Cuenta</label>
                                <input type="number" step="0.01" name="acuenta" id="acuenta" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #FFD700; background: rgba(30,23,54,0.5); color: white; outline: none; transition: all 0.3s ease;" value="0">
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
                                          <div style="display:flex; justify-content:space-between; padding-top:1.5rem; border-top:2px solid rgba(255,215,0,0.3); margin-top:1.5rem;">
                        <button type="button" id="prev-btn" onclick="prevStep()" style="background:rgba(255,255,255,0.1); color:#F3F4F6; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;" class="hidden">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Anterior
                        </button>
                        <div class="flex space-x-3">
                            <button type="button" onclick="closeRegistrarClienteModal()" style="background:rgba(255,255,255,0.1); color:#F3F4F6; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">
                                Cancelar
                            </button>
                            <button type="button" id="next-btn" onclick="nextStep()" style="background:linear-gradient(135deg,#FFD700,#FFA500); color:#232046; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;">
                                Siguiente
                                <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            <button type="submit" id="submit-btn" style="background:linear-gradient(135deg,#10B981,#059669); color:white; padding:0.75rem 1.5rem; border:none; border-radius:12px; cursor:pointer; font-weight:600; transition:all 0.3s ease;" class="hidden">
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
        const modal = document.getElementById('registrarClienteModal');
        if (modal) modal.classList.remove('hidden');
    }

    function closeRegistrarClienteModal() {
        const modal = document.getElementById('registrarClienteModal');
        if (modal) modal.classList.add('hidden');
        
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
            const stepElement = document.getElementById(`step${i}`);
            if (stepElement) stepElement.classList.add('hidden');
        }
        
        // Mostrar paso actual
        const currentStepElement = document.getElementById(`step${currentStep}`);
        if (currentStepElement) currentStepElement.classList.remove('hidden');
        
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
            if (prevBtn) prevBtn.classList.add('hidden');
        } else {
            if (prevBtn) prevBtn.classList.remove('hidden');
        }
        
        // Botón Siguiente/Registrar
        if (currentStep === totalSteps) {
            if (nextBtn) nextBtn.classList.add('hidden');
            if (submitBtn) submitBtn.classList.remove('hidden');
        } else {
            if (nextBtn) nextBtn.classList.remove('hidden');
            if (submitBtn) submitBtn.classList.add('hidden');
        }
    }

    function validateCurrentStep() {
        let isValid = true;
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        
        // Limpiar errores anteriores
        currentStepElement.querySelectorAll('.border-red-500').forEach(field => {
            if (field) field.classList.remove('border-red-500');
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
                        const container = radio.closest('.border-2');
                        if (container) {
                            container.classList.add('border-red-500');
                        }
                    });
                    isValid = false;
                } else {
                    // Remover marcas de error
                    document.querySelectorAll(`input[name="${field}"]`).forEach(radio => {
                        const container = radio.closest('.border-2');
                        if (container) {
                            container.classList.remove('border-red-500');
                        }
                    });
                }
            } else {
                element = document.getElementById(field);
                if (element) {
                    if (!element.value.trim()) {
                        if (element) element.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        if (element) element.classList.remove('border-red-500');
                    }
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
                            const dniElement = document.getElementById('dni');
                            if (dniElement) {
                                dniElement.value = '';
                                dniElement.classList.add('border-red-500');
                                // Generar DNI único
                                const nuevoDNI = Math.floor(Math.random() * 90000000) + 10000000;
                                dniElement.placeholder = `Ejemplo: ${nuevoDNI}`;
                            }
                        }
                        if (data.errors.usuario) {
                            const usuarioElement = document.getElementById('usuario');
                            if (usuarioElement) {
                                usuarioElement.value = '';
                                usuarioElement.classList.add('border-red-500');
                                // Generar usuario único
                                const nombres = ['usuario', 'cliente', 'gym', 'fitness', 'deportista'];
                                const randomNombre = nombres[Math.floor(Math.random() * nombres.length)];
                                const randomNum = Math.floor(Math.random() * 1000);
                                usuarioElement.placeholder = `Ejemplo: ${randomNombre}${randomNum}`;
                            }
                        }
                        if (data.errors.correo) {
                            const correoElement = document.getElementById('correo');
                            if (correoElement) {
                                correoElement.value = '';
                                correoElement.classList.add('border-red-500');
                                // Generar correo único
                                const randomNum = Math.floor(Math.random() * 10000);
                                correoElement.placeholder = `Ejemplo: usuario${randomNum}@gmail.com`;
                            }
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
                    const dniElement = document.getElementById('dni');
                    if (dniElement) dniElement.classList.add('border-red-500');
                }
                if (data.errors && data.errors.usuario) {
                    errorMessage += '• Usuario\n';
                    const usuarioElement = document.getElementById('usuario');
                    if (usuarioElement) usuarioElement.classList.add('border-red-500');
                }
                if (data.errors && data.errors.correo) {
                    errorMessage += '• Correo electrónico\n';
                    const correoElement = document.getElementById('correo');
                    if (correoElement) correoElement.classList.add('border-red-500');
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

    // ===== FUNCIONES PARA MODALES =====

    // Variables globales para modales
    let clienteIdRenovar = null;
    let clienteDataRenovar = null;
    let clienteIdPagar = null;
    let clienteIdDetalles = null;
    let clienteDataDetalles = null;

    // ===== MODAL DE RENOVAR =====
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
                const renovarModal = document.getElementById('renovarModal');
                if (renovarModal) renovarModal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error al obtener datos del cliente:', error);
                alert('Error al cargar los datos del cliente');
            });
    }

    function closeRenovarModal() {
        const modal = document.getElementById('renovarModal');
        if (modal) modal.classList.add('hidden');
        clienteIdRenovar = null;
        clienteDataRenovar = null;
        
        // Limpiar formulario
        document.getElementById('renovarForm').reset();
    }

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
        modalHasta.style.background = 'rgba(245,158,11,0.2)';
        modalDias.style.background = 'rgba(245,158,11,0.2)';
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
                modalHasta.style.background = 'rgba(30,23,54,0.5)';
                modalDias.style.background = 'rgba(30,23,54,0.5)';
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
                modalHasta.style.background = 'rgba(30,23,54,0.5)';
                modalDias.style.background = 'rgba(30,23,54,0.5)';
                modalHasta.placeholder = '';
                modalDias.placeholder = '';
            });
    }

    // ===== MODAL DE DETALLES =====
    function openDetallesModal(id, nombre) {
        console.log('Abriendo modal de detalles para cliente:', id);
        
        // Limpiar datos anteriores
        limpiarDatosModal();
        
        clienteIdDetalles = id;
        
        // Mostrar loading
        const detallesModal = document.getElementById('detallesModal');
        if (detallesModal) detallesModal.classList.remove('hidden');
        
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
                    estadoElement.style.background = 'rgba(239,68,68,0.9)';
                    estadoElement.style.color = '#FFFFFF';
                    estadoElement.style.textShadow = '1px 1px 2px rgba(0,0,0,0.7)';
                    estadoElement.style.padding = '4px 12px';
                    estadoElement.style.borderRadius = '6px';
                    estadoElement.style.fontWeight = 'bold';
                    document.getElementById('btnPagar').style.display = 'inline-block';
                } else {
                    estadoElement.textContent = 'AL DÍA';
                    estadoElement.style.background = 'rgba(16,185,129,0.9)';
                    estadoElement.style.color = '#FFFFFF';
                    estadoElement.style.textShadow = '1px 1px 2px rgba(0,0,0,0.7)';
                    estadoElement.style.padding = '4px 12px';
                    estadoElement.style.borderRadius = '6px';
                    estadoElement.style.fontWeight = 'bold';
                    document.getElementById('btnPagar').style.display = 'none';
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

    function closeDetallesModal() {
        const modal = document.getElementById('detallesModal');
        if (modal) modal.classList.add('hidden');
        clienteIdDetalles = null;
        clienteDataDetalles = null;
        
        // Destruir calendario si existe
        if (window.calendarDetalles) {
            window.calendarDetalles.destroy();
            window.calendarDetalles = null;
        }
    }

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
        document.getElementById('btnPagar').style.display = 'none';
        
        // Limpiar calendario
        const calendarEl = document.getElementById('detalleCalendar');
        if (calendarEl) {
            calendarEl.innerHTML = '<div style="text-align:center; color:#9CA3AF; padding:2rem;"><p>Cargando calendario...</p></div>';
        }
        
        // Destruir calendario anterior si existe
        if (window.calendarDetalles) {
            window.calendarDetalles.destroy();
            window.calendarDetalles = null;
        }
    }

    function inicializarCalendarioDetalles() {
        console.log('=== INICIO INICIALIZACIÓN CALENDARIO ===');
        
        const calendarEl = document.getElementById('detalleCalendar');
        console.log('Elemento del calendario:', calendarEl);
        
        if (!calendarEl) {
            console.error('Elemento del calendario no encontrado');
            return;
        }
        
        // Limpiar el contenedor
        calendarEl.innerHTML = '';
        
        // Verificar si FullCalendar está disponible
        if (typeof FullCalendar === 'undefined') {
            console.error('FullCalendar no está disponible');
            calendarEl.innerHTML = '<div style="text-align:center; color:#EF4444; padding:2rem;"><p>Error: FullCalendar no está cargado</p></div>';
            return;
        }
        
        try {
            // Destruir calendario anterior si existe
            if (window.calendarDetalles) {
                window.calendarDetalles.destroy();
                window.calendarDetalles = null;
            }
            
            // Crear calendario básico con configuración simplificada
            window.calendarDetalles = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",
                events: [],
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                dayMaxEvents: true,
                moreLinkClick: 'popover',
                themeSystem: 'bootstrap',
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                firstDay: 1, // Lunes como primer día
                weekNumbers: false,
                selectable: false,
                editable: false,
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                }
            });
            
            console.log('Calendario creado, renderizando...');
            window.calendarDetalles.render();
            console.log('Calendario renderizado exitosamente');
            
            // Forzar actualización visual después de un delay
            setTimeout(() => {
                if (window.calendarDetalles) {
                    try {
                        window.calendarDetalles.updateSize();
                        console.log('Tamaño del calendario actualizado');
                    } catch (error) {
                        console.error('Error al actualizar tamaño del calendario:', error);
                    }
                }
            }, 200);
            
        } catch (error) {
            console.error('Error al crear calendario:', error);
            calendarEl.innerHTML = `
                <div style="text-align:center; color:#EF4444; padding:2rem;">
                    <p>Error al cargar el calendario</p>
                    <p style="font-size:0.875rem; color:#9CA3AF; margin-top:0.5rem;">${error.message}</p>
                </div>
            `;
        }
    }

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

    function cambiarPestana(pestana) {
        // Ocultar todos los contenidos
        document.querySelectorAll('.contenido-pestana').forEach(contenido => {
            if (contenido) contenido.classList.add('hidden');
        });
        
        // Resetear todos los botones
        document.querySelectorAll('.pestana-btn').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.1)';
            btn.style.color = '#F3F4F6';
        });
        
        // Mostrar contenido seleccionado
        const contenidoElement = document.getElementById(`contenido-${pestana}`);
        if (contenidoElement) contenidoElement.classList.remove('hidden');
        
        // Activar botón seleccionado
        const activeBtn = document.querySelector(`[onclick="cambiarPestana('${pestana}')"]`);
        if (activeBtn) {
            activeBtn.style.background = 'linear-gradient(135deg,#FFD700,#FFA500)';
            activeBtn.style.color = '#232046';
        }
        
        // Si se selecciona la pestaña de asistencia, inicializar el calendario
        if (pestana === 'asistencia' && clienteIdDetalles) {
            setTimeout(() => {
                inicializarCalendarioDetalles();
                cargarEventosAsistencia(clienteIdDetalles);
            }, 100);
        }
        
        // Si se selecciona la pestaña de transacciones, cargar las transacciones
        if (pestana === 'transacciones' && clienteIdDetalles) {
            setTimeout(() => {
                cargarTransacciones(clienteIdDetalles);
            }, 100);
        }
    }

    function cargarEventosAsistencia(clienteId) {
        console.log('Cargando eventos de asistencia para cliente:', clienteId);
        
        if (!window.calendarDetalles) {
            console.error('Calendario no está inicializado');
            return;
        }
        
        try {
            // Limpiar eventos existentes
            window.calendarDetalles.removeAllEvents();
            
            // Obtener fecha actual
            const hoy = new Date();
            const ayer = new Date(hoy.getTime() - 24 * 60 * 60 * 1000);
            const hace2Dias = new Date(hoy.getTime() - 2 * 24 * 60 * 60 * 1000);
            
            // Función para verificar si es domingo
            function esDomingo(fecha) {
                return fecha.getDay() === 0; // 0 = domingo
            }
            
            // Crear eventos solo para días que NO sean domingo
            const eventosEjemplo = [];
            
            // Verificar hoy
            if (!esDomingo(hoy)) {
                eventosEjemplo.push({
                    title: '✓ Asistencia',
                    start: hoy,
                    backgroundColor: '#10B981',
                    borderColor: '#10B981',
                    textColor: 'white',
                    allDay: true
                });
            }
            
            // Verificar ayer
            if (!esDomingo(ayer)) {
                eventosEjemplo.push({
                    title: '✓ Asistencia',
                    start: ayer,
                    backgroundColor: '#10B981',
                    borderColor: '#10B981',
                    textColor: 'white',
                    allDay: true
                });
            }
            
            // Verificar hace 2 días
            if (!esDomingo(hace2Dias)) {
                eventosEjemplo.push({
                    title: '✓ Asistencia',
                    start: hace2Dias,
                    backgroundColor: '#10B981',
                    borderColor: '#10B981',
                    textColor: 'white',
                    allDay: true
                });
            }
            
            // Agregar eventos uno por uno para mayor control
            eventosEjemplo.forEach(evento => {
                try {
                    window.calendarDetalles.addEvent(evento);
                } catch (eventError) {
                    console.error('Error al agregar evento:', evento, eventError);
                }
            });
            
            console.log('Eventos de asistencia cargados:', eventosEjemplo.length);
            
        } catch (error) {
            console.error('Error al cargar eventos de asistencia:', error);
        }
    }

    function pagarCliente() {
        if (clienteIdDetalles) {
            openPagarModal(clienteIdDetalles, clienteDataDetalles?.nombre || 'Cliente');
        }
    }

    // ===== MODAL DE PAGO =====
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
                const pagarModal = document.getElementById('pagarModal');
                if (pagarModal) pagarModal.classList.remove('hidden');
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
        const modal = document.getElementById('pagarModal');
        if (modal) modal.classList.add('hidden');
        clienteIdPagar = null;
        
        // Limpiar formulario
        document.getElementById('pagarForm').reset();
        
        // Limpiar QR
        const qrContainer = document.getElementById('qrContainer');
        if (qrContainer) {
            qrContainer.style.display = 'none';
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
                    qrContainer.style.display = 'block';
                    generarQR();
                } else {
                    qrContainer.style.display = 'none';
                }
            });

            pagoEfectivo.addEventListener('change', function() {
                if (this.checked) {
                    qrContainer.style.display = 'none';
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
            qrContainer.style.display = 'none';
            
        } else if (metodo === 'qr') {
            pagoQR.checked = true;
            pagoEfectivo.checked = false;
            qrContainer.style.display = 'none'; // Ocultar el contenedor del QR
            // Mostrar instrucciones directamente en el modal
            const qrCode = document.getElementById('qrCode');
            if (qrCode) {
                qrCode.innerHTML = `
                    <div style="text-align:center; padding:1rem; color:#6B7280; background:rgba(59,130,246,0.05); border-radius:8px; margin-top:1rem;">
                        <i class="fas fa-info-circle" style="font-size:1rem; margin-right:0.5rem; color:#3B82F6;"></i>
                        <span style="font-size:0.875rem;">Confirma el pago para generar el código QR</span>
                    </div>
                `;
            }
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
            qrCode.innerHTML = '<p style="color:#F59E0B; font-size:0.875rem;">Ingrese un monto válido</p>';
            return;
        }
        
        // Crear datos para el QR con información más completa
        const datosQR = {
            gym: 'SATURN GYM',
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
            qrCode.innerHTML = '<p style="color:#EF4444; font-size:0.875rem;">Error: Librería QR no disponible</p>';
            return;
        }
        
        // Generar QR usando la API correcta
        new QRCode(qrCode, {
            text: datosString,
            width: 220,
            height: 220,
            colorDark: '#1f2937',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.M
        });
        
        // Agregar información adicional debajo del QR
        setTimeout(() => {
            const infoDiv = document.createElement('div');
            infoDiv.style.marginTop = '12px';
            infoDiv.style.textAlign = 'center';
            infoDiv.innerHTML = `
                <div style="background:rgba(249,250,251,0.9); padding:12px; border-radius:8px;">
                    <p style="font-size:12px; color:#6B7280; margin-bottom:4px;">Monto: S/. ${parseFloat(monto).toFixed(2)}</p>
                    <p style="font-size:12px; color:#6B7280; margin-bottom:4px;">Cliente: ${clienteNombre}</p>
                    <p style="font-size:12px; color:#6B7280;">Fecha: ${new Date().toLocaleDateString('es-ES')}</p>
                </div>
            `;
            qrCode.appendChild(infoDiv);
        }, 100);
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
                <div style="text-align:center;">
                    <div style="margin-bottom:16px;">
                        <div style="display:inline-flex; align-items:center; justify-content:center; width:64px; height:64px; background:rgba(16,185,129,0.1); border-radius:50%; margin-bottom:12px;">
                            <svg style="width:32px; height:32px; color:#10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div style="margin-bottom:8px;">
                        <p style="font-size:18px; font-weight:600; color:#1F2937;">S/. ${monto}</p>
                        <p style="font-size:14px; color:#6B7280;">${metodoPagoTexto}</p>
                        <p style="font-size:14px; color:#9CA3AF;">Cliente: ${clienteNombre}</p>
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
                cancelButton: 'rounded-lg px-6 py-2',
                container: 'swal2-container-high-z'
            },
            backdrop: 'rgba(0,0,0,0.8)',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Si es pago por QR, generar el QR antes de procesar
                if (metodoPago === 'qr') {
                    generarQR();
                }
                
                // Mostrar loading
                Swal.fire({
                    title: 'Procesando Pago...',
                    html: `
                        <div style="text-align:center;">
                            <div style="display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; background:rgba(59,130,246,0.1); border-radius:50%; margin-bottom:12px;">
                                <svg style="width:24px; height:24px; color:#3B82F6; animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <p style="font-size:14px; color:#6B7280;">Registrando pago en el sistema...</p>
                        </div>
                    `,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-lg',
                        container: 'swal2-container-high-z'
                    },
                    backdrop: 'rgba(0,0,0,0.8)'
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
        notificacion.style.position = 'fixed';
        notificacion.style.top = '16px';
        notificacion.style.right = '16px';
        notificacion.style.zIndex = '99999'; // Aumentar z-index para que aparezca sobre modales
        notificacion.style.padding = '16px 24px';
        notificacion.style.borderRadius = '8px';
        notificacion.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        notificacion.style.transform = 'translateX(100%)';
        notificacion.style.transition = 'all 0.3s ease-in-out';
        
        // Configurar colores según tipo
        switch (tipo) {
            case 'success':
                notificacion.style.background = '#10B981';
                notificacion.style.color = 'white';
                break;
            case 'error':
                notificacion.style.background = '#EF4444';
                notificacion.style.color = 'white';
                break;
            case 'warning':
                notificacion.style.background = '#F59E0B';
                notificacion.style.color = 'white';
                break;
            default:
                notificacion.style.background = '#3B82F6';
                notificacion.style.color = 'white';
        }
        
        notificacion.innerHTML = `
            <div style="display:flex; align-items:center; gap:12px;">
                <div style="flex-shrink:0;">
                    <svg style="width:24px; height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p style="font-weight:600;">${tipo === 'success' ? '¡Éxito!' : tipo === 'error' ? 'Error' : tipo === 'warning' ? 'Advertencia' : 'Información'}</p>
                    <p style="font-size:14px; opacity:0.9;">${mensaje}</p>
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

    // ===== FUNCIONES PARA MÉTODOS DE PAGO EN WIZARD =====
    function seleccionarMetodoPagoWizard(metodo) {
        // Desmarcar todos los radio buttons
        document.querySelectorAll('input[name="metodoPago"]').forEach(radio => {
            radio.checked = false;
        });
        
        // Marcar el seleccionado
        if (metodo === 'efectivo') {
            document.getElementById('pagoEfectivoWizard').checked = true;
                            const qrContainer = document.getElementById('qrContainerWizard');
                if (qrContainer) qrContainer.classList.add('hidden');
        } else if (metodo === 'qr') {
            document.getElementById('pagoQRWizard').checked = true;
                            const qrContainer = document.getElementById('qrContainerWizard');
                if (qrContainer) qrContainer.classList.remove('hidden');
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
                <div style="background:#F3F4F6; width:128px; height:128px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:8px;">
                    <div style="text-align:center;">
                        <i class="fas fa-qrcode" style="font-size:48px; color:#9CA3AF; margin-bottom:8px;"></i>
                        <p style="font-size:12px; color:#6B7280;">QR no disponible</p>
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

    // ===== EVENT LISTENERS =====
    document.addEventListener('DOMContentLoaded', function() {
        // Event listeners para campos del modal de renovación
        const modalMembresia = document.getElementById('modalMembresia');
        const modalDesde = document.getElementById('modalDesde');
        const modalAcuenta = document.getElementById('modalAcuenta');
        
        if (modalMembresia) {
            modalMembresia.addEventListener('change', function() {
                // Consultar precio y calcular fecha
                consultarMembresia();
            });
        }
        
        if (modalDesde) {
            modalDesde.addEventListener('change', function() {
                consultarMembresia();
            });
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

        // Cerrar modales al hacer clic fuera de ellos
        const modales = ['renovarModal', 'detallesModal', 'pagarModal'];
        modales.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        if (modalId === 'renovarModal') closeRenovarModal();
                        else if (modalId === 'detallesModal') closeDetallesModal();
                        else if (modalId === 'pagarModal') closePagarModal();
                    }
                });
            }
        });

        // Cerrar modales con Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRenovarModal();
                closeDetallesModal();
                closePagarModal();
            }
        });

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
    });

    // Funciones auxiliares para el modal de renovación
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

    function calcularPagoACuenta() {
        const total = parseInt(document.getElementById('modalTotal').value) || 0;
        const acuenta = parseInt(document.getElementById('modalAcuenta').value) || 0;
        
        if (acuenta > total) {
            document.getElementById('modalAcuenta').value = total;
        }
        
        const pagoRestante = total - (parseInt(document.getElementById('modalAcuenta').value) || 0);
        document.getElementById('modalPagoRestante').value = pagoRestante;
    }

    function cargarTransacciones(clienteId) {
        console.log('Cargando transacciones para cliente:', clienteId);
        
        const transaccionesContent = document.getElementById('transacciones-content');
        if (!transaccionesContent) {
            console.error('Elemento transacciones-content no encontrado');
            return;
        }
        
        // Mostrar loading
        transaccionesContent.innerHTML = '<p style="text-align:center; color:#9CA3AF;">Cargando transacciones...</p>';
        
        // Hacer petición AJAX para obtener transacciones
        fetch(`/consultar/pagos/${clienteId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos de transacciones recibidos:', data);
                
                // Verificar si hay pagos o abonos
                const tienePagos = data.success && data.pagos && data.pagos.length > 0;
                const tieneAbonos = data.success && data.abonos && data.abonos.length > 0;
                
                if (tienePagos || tieneAbonos) {
                    // Crear tabla de transacciones
                    let html = `
                        <div style="overflow-x:auto;">
                            <table style="width:100%; border-collapse:collapse; color:#F3F4F6;">
                                <thead>
                                    <tr style="background:rgba(255,215,0,0.1); border-bottom:2px solid rgba(255,215,0,0.3);">
                                        <th style="padding:12px; text-align:left; font-weight:600; color:#FFD700;">Fecha</th>
                                        <th style="padding:12px; text-align:left; font-weight:600; color:#FFD700;">Tipo</th>
                                        <th style="padding:12px; text-align:left; font-weight:600; color:#FFD700;">Tipo de Pago</th>
                                        <th style="padding:12px; text-align:left; font-weight:600; color:#FFD700;">Monto</th>
                                        <th style="padding:12px; text-align:left; font-weight:600; color:#FFD700;">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;
                    
                    // Agregar pagos si existen
                    if (tienePagos) {
                        data.pagos.forEach(pago => {
                            const fecha = new Date(pago.fecha).toLocaleDateString('es-ES');
                            const monto = parseFloat(pago.costo_total || pago.paga_con || 0).toFixed(2);
                            const estado = 'Completado';
                            const tipo = 'Pago';
                            const metodoPago = pago.metodo_pago || 'Efectivo';
                            
                            // Determinar el color y texto del método de pago
                            let metodoColor = '#10B981';
                            let metodoTexto = metodoPago;
                            
                            if (metodoPago.toLowerCase() === 'qr') {
                                metodoColor = '#8B5CF6';
                                metodoTexto = 'QR';
                            } else if (metodoPago.toLowerCase() === 'efectivo') {
                                metodoColor = '#10B981';
                                metodoTexto = 'Efectivo';
                            } else {
                                metodoColor = '#3B82F6';
                                metodoTexto = metodoPago;
                            }
                            
                            html += `
                                <tr style="border-bottom:1px solid rgba(255,255,255,0.1);">
                                    <td style="padding:12px;">${fecha}</td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(16,185,129,0.2); color:#10B981; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${tipo}
                                        </span>
                                    </td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(${metodoColor === '#8B5CF6' ? '139,92,246' : metodoColor === '#10B981' ? '16,185,129' : '59,130,246'},0.2); color:${metodoColor}; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${metodoTexto}
                                        </span>
                                    </td>
                                    <td style="padding:12px; color:#10B981; font-weight:600;">S/. ${monto}</td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(16,185,129,0.2); color:#10B981; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${estado}
                                        </span>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    
                    // Agregar abonos si existen
                    if (tieneAbonos) {
                        data.abonos.forEach(abono => {
                            const fecha = new Date(abono.fecha).toLocaleDateString('es-ES');
                            const monto = parseFloat(abono.monto || 0).toFixed(2);
                            const estado = 'Abono';
                            const tipo = 'Abono';
                            const metodoPago = abono.metodo_pago || 'efectivo';
                            
                            // Determinar el color y texto del método de pago para abonos
                            let metodoColor = '#10B981';
                            let metodoTexto = metodoPago;
                            
                            if (metodoPago.toLowerCase() === 'qr') {
                                metodoColor = '#8B5CF6';
                                metodoTexto = 'QR';
                            } else if (metodoPago.toLowerCase() === 'efectivo') {
                                metodoColor = '#10B981';
                                metodoTexto = 'Efectivo';
                            } else {
                                metodoColor = '#3B82F6';
                                metodoTexto = metodoPago;
                            }
                            
                            html += `
                                <tr style="border-bottom:1px solid rgba(255,255,255,0.1);">
                                    <td style="padding:12px;">${fecha}</td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(59,130,246,0.2); color:#3B82F6; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${tipo}
                                        </span>
                                    </td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(${metodoColor === '#8B5CF6' ? '139,92,246' : metodoColor === '#10B981' ? '16,185,129' : '59,130,246'},0.2); color:${metodoColor}; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${metodoTexto}
                                        </span>
                                    </td>
                                    <td style="padding:12px; color:#3B82F6; font-weight:600;">S/. ${monto}</td>
                                    <td style="padding:12px;">
                                        <span style="background:rgba(59,130,246,0.2); color:#3B82F6; padding:4px 8px; border-radius:6px; font-size:0.875rem;">
                                            ${estado}
                                        </span>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    
                    html += `
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top:1rem; padding:1rem; background:rgba(255,215,0,0.1); border-radius:8px;">
                            <p style="color:#FFD700; font-weight:600; margin:0;">
                                Total de transacciones: ${(data.total_pagos || 0) + (data.total_abonos || 0)}
                            </p>
                        </div>
                    `;
                    
                    transaccionesContent.innerHTML = html;
                } else {
                    // Mostrar mensaje de no hay transacciones
                    transaccionesContent.innerHTML = `
                        <div style="text-align:center; padding:2rem; color:#9CA3AF;">
                            <i class="fas fa-receipt" style="font-size:3rem; margin-bottom:1rem; display:block; color:#6B7280;"></i>
                            <p style="font-size:1.1rem; margin-bottom:0.5rem;">No hay transacciones registradas</p>
                            <p style="font-size:0.875rem;">Este cliente aún no tiene historial de pagos.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error al cargar transacciones:', error);
                transaccionesContent.innerHTML = `
                    <div style="text-align:center; padding:2rem; color:#EF4444;">
                        <i class="fas fa-exclamation-triangle" style="font-size:3rem; margin-bottom:1rem; display:block;"></i>
                        <p style="font-size:1.1rem; margin-bottom:0.5rem;">Error al cargar transacciones</p>
                        <p style="font-size:0.875rem;">${error.message}</p>
                    </div>
                `;
            });
    }

    // Funciones para el modal de editar cliente
    function openEditarModal(id) {
        console.log('Abriendo modal de editar para cliente:', id);
        
        // Cargar datos del cliente
        fetch(`/cliente/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Llenar el formulario con los datos del cliente
                    document.getElementById('editarIdCliente').value = data.cliente.id_cliente;
                    document.getElementById('editarDni').value = data.cliente.dni;
                    document.getElementById('editarUsuario').value = data.cliente.usuario;
                    document.getElementById('editarNombre').value = data.cliente.nombre;
                    document.getElementById('editarTelefono').value = data.cliente.telefono || '';
                    document.getElementById('editarDireccion').value = data.cliente.direccion || '';
                    document.getElementById('editarCorreo').value = data.cliente.correo;
                    document.getElementById('editarPassword').value = ''; // Dejar vacío para no cambiar
                    
                    // Configurar la acción del formulario
                    document.getElementById('editarClienteForm').action = `/cliente/${id}`;
                    
                    // Mostrar el modal
                    const modal = document.getElementById('editarModal');
                    if (modal) modal.classList.remove('hidden');
                } else {
                    console.error('Error al cargar datos del cliente:', data.message);
                    alert('Error al cargar los datos del cliente');
                }
            })
            .catch(error => {
                console.error('Error al cargar cliente:', error);
                alert('Error al cargar los datos del cliente');
            });
    }

    function closeEditarModal() {
        const modal = document.getElementById('editarModal');
        if (modal) modal.classList.add('hidden');
        
        // Limpiar formulario
        document.getElementById('editarClienteForm').reset();
    }

    // Manejar envío del formulario de editar
    document.addEventListener('DOMContentLoaded', function() {
        const editarForm = document.getElementById('editarClienteForm');
        if (editarForm) {
            editarForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        // Cerrar modal
                        closeEditarModal();
                        
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Cliente actualizado!',
                            text: 'Los datos del cliente han sido actualizados correctamente.',
                            confirmButtonColor: '#10B981'
                        }).then(() => {
                            // Recargar la página para mostrar los cambios
                            location.reload();
                        });
                    } else {
                        // Mostrar errores de validación
                        let errorMessage = 'Error al actualizar el cliente';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join('\n');
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            confirmButtonColor: '#EF4444'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = 'Error al actualizar el cliente';
                    
                    if (error.response) {
                        // Error de respuesta del servidor
                        errorMessage = `Error ${error.response.status}: ${error.response.statusText}`;
                    } else if (error.message) {
                        errorMessage = error.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        confirmButtonColor: '#EF4444'
                    });
                });
            });
        }
    });
</script>

@endsection