@extends('layouts.app')

@section('content')
<style>
    body, .page-content, .container-asistencia-light {
        background: #f8fafc !important;
        overflow-x: hidden !important;
    }
    .card-asistencia-light {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        color: #1e293b;
        max-width: 600px;
        margin: 2rem auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 0.7s;
        overflow: visible !important;
        border: 1px solid #e2e8f0;
    }
    .asistencia-title-modern {
        color: #3b82f6;
        font-size: 2.2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.2rem;
        text-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);
    }
    .asistencia-info-box {
        background: #f1f5f9;
        border-radius: 12px;
        color: #1e293b;
        font-size: 1.1rem;
        padding: 0.7rem 1.2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        display: inline-block;
        border: 1px solid #e2e8f0;
    }
    #calendar {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.15);
        padding: 0 !important;
        margin: 0 auto;
        width: 100%;
        max-width: 500px;
        color: #1e293b;
        overflow: visible !important;
        border: 1px solid #e2e8f0;
    }
    .fc-toolbar-title, .fc-col-header-cell-cushion, .fc-daygrid-day-number {
        color: #3b82f6 !important;
        font-weight: bold;
    }
    .fc-event-title {
        color: #1e293b !important;
    }
    /* Eliminar scroll de FullCalendar */
    .fc-scroller-harness, .fc-scroller {
        overflow: visible !important;
        max-height: none !important;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<div class="container-asistencia-light">
    <div class="card-asistencia-light">
        <h1 class="asistencia-title-modern">MI ASISTENCIA</h1>
        <div class="asistencia-info-box mb-4">Clases restantes: <b>{{ Auth::user()->DR }}</b></div>
        <div id='calendar'></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            events: [
                @foreach ($asistencias as $asistencia)
                    {
                        title: '{{ $asistencia->hora }}',
                        start: '{{ $asistencia->fecha }}',
                    },
                @endforeach
            ],
            visibleRange: {
                start: '{{ $desde }}',
                end: '{{ $hasta }} 23:59:59'
            },
            scrollTime: '{{ $desde }}',
            validRange: {
                start: '{{ $desde }}',
                end: '{{ $hasta }} 23:59:59'
            },
            height: 'auto',
            contentHeight: 'auto',
        });
        calendar.render();
    });
</script>
@endsection
