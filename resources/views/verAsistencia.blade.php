@extends('layouts.app')

@section('content')
<style>
    body, .page-content, .container-asistencia-dark {
        background: #181828 !important;
        overflow-x: hidden !important;
    }
    .card-asistencia-dark {
        background: #23232e;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        padding: 2.5rem 2rem 2rem 2rem;
        color: #fff;
        max-width: 600px;
        margin: 2rem auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 0.7s;
        overflow: visible !important;
    }
    .asistencia-title-neon {
        color: #00ff88;
        font-size: 2.2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.2rem;
        text-shadow: 0 0 10px #00ff88;
    }
    .asistencia-info-box {
        background: #181828;
        border-radius: 12px;
        color: #fff;
        font-size: 1.1rem;
        padding: 0.7rem 1.2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        display: inline-block;
    }
    #calendar {
        background: #23232e;
        border-radius: 16px;
        box-shadow: 0 0 18px #00ff8833;
        padding: 0 !important;
        margin: 0 auto;
        width: 100%;
        max-width: 500px;
        color: #fff;
        overflow: visible !important;
    }
    .fc-toolbar-title, .fc-col-header-cell-cushion, .fc-daygrid-day-number {
        color: #00ff88 !important;
        font-weight: bold;
    }
    .fc-event-title {
        color: #fff !important;
    }
    /* Eliminar scroll de FullCalendar */
    .fc-scroller-harness, .fc-scroller {
        overflow: visible !important;
        max-height: none !important;
    }
</style>
<div class="container-asistencia-dark">
    <div class="card-asistencia-dark">
        <h1 class="asistencia-title-neon">MI ASISTENCIA</h1>
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
