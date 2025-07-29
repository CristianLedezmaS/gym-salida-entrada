<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <title>Sistema GYM</title>

    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    
    {{-- TailwindCSS --}}
    <link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">

    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('app/publico/css/lib/datatables-net/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/publico/css/separate/vendor/datatables-net.min.css') }}">

    {{-- PNotify --}}
    <link href="{{ asset('pnotify/css/pnotify.css') }}" rel="stylesheet" />
    <link href="{{ asset('pnotify/css/pnotify.buttons.css') }}" rel="stylesheet" />
    <link href="{{ asset('pnotify/css/custom.min.css') }}" rel="stylesheet" />

    {{-- Google Fonts --}}
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    {{-- jQuery (solo una versión) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- PNotify Scripts --}}
    <script src="{{ asset('pnotify/js/pnotify.js') }}"></script>
    <script src="{{ asset('pnotify/js/pnotify.buttons.js') }}"></script>

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    {{-- Chart.js --}}
    <script src="{{ asset('chart/chart.js') }}"></script>

    {{-- FullCalendar --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

    {{-- QR Code Generator --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="{{ asset('sweet/js/sweetalert2.js') }}"></script>

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="{{ asset('bootstrap4/css/bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="{{ asset('bootstrap4/js/bootstrap.min.js') }}"></script>

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    {{-- Custom CSS --}}
    <link href="{{ asset('app/publico/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('app/publico/css/mis_estilos/estilos.css') }}" rel="stylesheet">

    {{-- Custom JS --}}
    <script src="{{ asset('app/publico/js/app.js') }}"></script>
    <script src="{{ asset('app/publico/js/plugins.js') }}"></script>

    {{-- CSRF Token Configuration --}}
    <script>
        // Configurar token CSRF para todas las peticiones AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // También configurar para fetch requests
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    {{-- PWA --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Gym App">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/logo-144.png') }}">

    {{-- Service Worker --}}
    {{-- <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
                    })
                    .catch(function(err) {
                        console.log('Laravel PWA: ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script> --}}
</head>

<body style="background: linear-gradient(135deg, #4B0082 0%, #800080 50%, #00008B 100%); margin: 0; padding: 0; min-height: 100vh; border: none;">
    <div id="app" style="display: flex; height: 100vh; margin: 0; padding: 0; border: none;">
        
        <!-- Sidebar -->
        <nav style="background: linear-gradient(135deg, #4B0082 0%, #800080 50%, #00008B 100%); width: 256px; min-height: 100vh; flex-shrink: 0; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border-right: 2px solid #FFD700;">
            <div style="padding: 1rem;">
                <!-- Logo -->
                <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 2rem;">
                    <div style="background: linear-gradient(135deg, #FFD700, #FFA500); border-radius: 12px; padding: 12px; margin-right: 12px; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);">
                        <i class="fas fa-dumbbell" style="color: white; font-size: 1.25rem;"></i>
                    </div>
                    <h1 style="font-size: 1.5rem; font-weight: bold; background: linear-gradient(135deg, #FFD700, #FFA500); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">SATURN GYM</h1>
                </div>

                <!-- Navigation Menu -->
                <ul style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @if (Auth::check() && Auth::user()->tipo_usuario == 'cliente')
                        <!-- Cliente Menu -->
                        <li>
                            <a href="{{ route('homeCliente') }}" 
                               style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; {{ Request::is('homeCliente*') ? 'background: linear-gradient(135deg, #FFD700, #FFA500); color: white; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);' : '' }}"
                               onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                               onmouseout="this.style.background='{{ Request::is('homeCliente*') ? 'linear-gradient(135deg, #FFD700, #FFA500)' : 'transparent' }}'; this.style.color='{{ Request::is('homeCliente*') ? 'white' : '#E9D5FF' }}';">
                                <img src="{{ asset('img-inicio/house.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                <span style="font-weight: 500;">INICIO</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ver.asistencia') }}" 
                               style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; {{ Request::is('verAsistencia*') ? 'background: linear-gradient(135deg, #FFD700, #FFA500); color: white; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);' : '' }}"
                               onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                               onmouseout="this.style.background='{{ Request::is('verAsistencia*') ? 'linear-gradient(135deg, #FFD700, #FFA500)' : 'transparent' }}'; this.style.color='{{ Request::is('verAsistencia*') ? 'white' : '#E9D5FF' }}';">
                                <img src="{{ asset('img-inicio/programar.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                <span style="font-weight: 500;">MI ASISTENCIA</span>
                            </a>
                        </li>
                    @else
                        <!-- Admin/Vendedor Menu -->
                        <li>
                            <a href="{{ route('home') }}" 
                               style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; {{ Request::is('home*') ? 'background: linear-gradient(135deg, #FFD700, #FFA500); color: white; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);' : '' }}"
                               onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                               onmouseout="this.style.background='{{ Request::is('home*') ? 'linear-gradient(135deg, #FFD700, #FFA500)' : 'transparent' }}'; this.style.color='{{ Request::is('home*') ? 'white' : '#E9D5FF' }}';">
                                <img src="{{ asset('img-inicio/house.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                <span style="font-weight: 500;">INICIO</span>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->tipo_usuario != 'cliente')
                            <!-- Membresías -->
                            <li x-data="{ open: {{ Request::is('membresia*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" 
                                        style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 12px 16px; color: #E9D5FF; background: transparent; border: none; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                        onmouseout="this.style.background='transparent'; this.style.color='#E9D5FF';">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ asset('img-inicio/mem.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                        <span style="font-weight: 500;">MEMBRESIAS</span>
                                    </div>
                                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }" style="transition: transform 0.3s ease;"></i>
                                </button>
                                <ul x-show="open" x-transition style="margin-left: 1rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.25rem;">
                                    <li>
                                        <a href="{{ route('membresia.index') }}" 
                                           style="display: flex; align-items: center; padding: 8px 16px; font-size: 0.875rem; color: #C4B5FD; text-decoration: none; transition: color 0.3s ease; {{ Request::is('membresia') ? 'color: #FCD34D;' : '' }}"
                                           onmouseover="this.style.color='#FCD34D';" 
                                           onmouseout="this.style.color='{{ Request::is('membresia') ? '#FCD34D' : '#C4B5FD' }}';">
                                            <i class="fas fa-th-list" style="margin-right: 12px;"></i>
                                            <span>Lista de membresias</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Clientes -->
                            <li x-data="{ open: {{ Request::is('cliente*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" 
                                        style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 12px 16px; color: #E9D5FF; background: transparent; border: none; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                        onmouseout="this.style.background='transparent'; this.style.color='#E9D5FF';">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ asset('img-inicio/team.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                        <span style="font-weight: 500;">CLIENTE</span>
                                    </div>
                                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }" style="transition: transform 0.3s ease;"></i>
                                </button>
                                <ul x-show="open" x-transition style="margin-left: 1rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.25rem;">
                                    <li>
                                        <a href="{{ route('cliente.index') }}" 
                                           style="display: flex; align-items: center; padding: 8px 16px; font-size: 0.875rem; color: #C4B5FD; text-decoration: none; transition: color 0.3s ease; {{ Request::is('cliente') ? 'color: #FCD34D;' : '' }}"
                                           onmouseover="this.style.color='#FCD34D';" 
                                           onmouseout="this.style.color='{{ Request::is('cliente') ? '#FCD34D' : '#C4B5FD' }}';">
                                            <i class="fas fa-th-list" style="margin-right: 12px;"></i>
                                            <span>Lista de clientes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Asistencia -->
                            <li x-data="{ open: {{ Request::is('asistencia*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" 
                                        style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 12px 16px; color: #E9D5FF; background: transparent; border: none; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                        onmouseout="this.style.background='transparent'; this.style.color='#E9D5FF';">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ asset('img-inicio/programar.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                        <span style="font-weight: 500;">ASISTENCIA</span>
                                    </div>
                                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }" style="transition: transform 0.3s ease;"></i>
                                </button>
                                <ul x-show="open" x-transition style="margin-left: 1rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.25rem;">
                                    <li>
                                        <a href="{{ route('asistencia.index') }}" 
                                           style="display: flex; align-items: center; padding: 8px 16px; font-size: 0.875rem; color: #C4B5FD; text-decoration: none; transition: color 0.3s ease; {{ Request::is('asistencia') ? 'color: #FCD34D;' : '' }}"
                                           onmouseover="this.style.color='#FCD34D';" 
                                           onmouseout="this.style.color='{{ Request::is('asistencia') ? '#FCD34D' : '#C4B5FD' }}';">
                                            <i class="fas fa-th-list" style="margin-right: 12px;"></i>
                                            <span>Lista de asistencias</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Rutinas -->
                            <li>
                                <a href="{{ route('rutinas.rutinas') }}" 
                                   style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; {{ Request::is('rutinas.rutinas*') ? 'background: linear-gradient(135deg, #FFD700, #FFA500); color: white; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);' : '' }}"
                                   onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                   onmouseout="this.style.background='{{ Request::is('rutinas.rutinas*') ? 'linear-gradient(135deg, #FFD700, #FFA500)' : 'transparent' }}'; this.style.color='{{ Request::is('rutinas.rutinas*') ? 'white' : '#E9D5FF' }}';">
                                    <img src="{{ asset('img-inicio/programar.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                    <span style="font-weight: 500;">RUTINAS</span>
                                </a>
                            </li>

                            @if (Auth::user()->tipo_usuario == 'administrador')
                                <!-- Usuarios -->
                                <li x-data="{ open: {{ Request::is('usuario*') ? 'true' : 'false' }} }">
                                    <button @click="open = !open" 
                                            style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 12px 16px; color: #E9D5FF; background: transparent; border: none; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;"
                                            onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                            onmouseout="this.style.background='transparent'; this.style.color='#E9D5FF';">
                                        <div style="display: flex; align-items: center;">
                                            <img src="{{ asset('img-inicio/admin.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                            <span style="font-weight: 500;">USUARIOS</span>
                                        </div>
                                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open }" style="transition: transform 0.3s ease;"></i>
                                    </button>
                                    <ul x-show="open" x-transition style="margin-left: 1rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.25rem;">
                                        <li>
                                            <a href="{{ route('usuario.create') }}" 
                                               style="display: flex; align-items: center; padding: 8px 16px; font-size: 0.875rem; color: #C4B5FD; text-decoration: none; transition: color 0.3s ease; {{ Request::is('usuario/create*') ? 'color: #FCD34D;' : '' }}"
                                               onmouseover="this.style.color='#FCD34D';" 
                                               onmouseout="this.style.color='{{ Request::is('usuario/create*') ? '#FCD34D' : '#C4B5FD' }}';">
                                                <i class="fas fa-plus-square" style="margin-right: 12px;"></i>
                                                <span>Registrar usuarios</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('usuario.index') }}" 
                                               style="display: flex; align-items: center; padding: 8px 16px; font-size: 0.875rem; color: #C4B5FD; text-decoration: none; transition: color 0.3s ease; {{ Request::is('usuario') ? 'color: #FCD34D;' : '' }}"
                                               onmouseover="this.style.color='#FCD34D';" 
                                               onmouseout="this.style.color='{{ Request::is('usuario') ? '#FCD34D' : '#C4B5FD' }}';">
                                                <i class="fas fa-th-list" style="margin-right: 12px;"></i>
                                                <span>Lista de usuarios</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Acerca de -->
                                <li>
                                    <a href="{{ route('empresa.datos') }}" 
                                       style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; {{ Request::is('empresa*') ? 'background: linear-gradient(135deg, #FFD700, #FFA500); color: white; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);' : '' }}"
                                       onmouseover="this.style.background='#7C3AED'; this.style.color='#FCD34D';" 
                                       onmouseout="this.style.background='{{ Request::is('empresa*') ? 'linear-gradient(135deg, #FFD700, #FFA500)' : 'transparent' }}'; this.style.color='{{ Request::is('empresa*') ? 'white' : '#E9D5FF' }}';">
                                        <img src="{{ asset('img-inicio/info.png') }}" style="width: 20px; height: 20px; margin-right: 12px;" alt="">
                                        <span style="font-weight: 500;">ACERCA DE</span>
                                    </a>
                                </li>
                            @endif

                            <!-- QR Section -->
                            <div style="margin-top: 2rem; padding: 1rem; background: #4C1D95; border-radius: 8px; border: 1px solid #7C3AED;">
                                <img src="{{ asset('qr/qrcode.png') }}" alt="" style="width: 80px; height: 80px; margin: 0 auto 12px; display: block;">
                                <a href="{{ asset('qr/qrcode.png') }}" download="" 
                                   style="display: block; width: 100%; text-align: center; padding: 8px 16px; background: linear-gradient(135deg, #FFD700, #FFA500); color: white; font-weight: 600; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);"
                                   onmouseover="this.style.background='linear-gradient(135deg, #FFA500, #FF8C00)'; this.style.transform='translateY(-2px)';" 
                                   onmouseout="this.style.background='linear-gradient(135deg, #FFD700, #FFA500)'; this.style.transform='translateY(0)';">
                                    Descargar QR
                                </a>
                            </div>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-gradient-to-r from-purple-800 to-indigo-800 shadow-lg border-b border-purple-600">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Left side -->
                    <div class="flex items-center">
                        <button id="show-hide-sidebar-toggle" class="lg:hidden mr-4 text-purple-200 hover:text-yellow-300">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center space-x-4">
                        <!-- User Type Display -->
                        <div class="text-sm text-purple-200">
                            @if (Auth::check())
                                @if (Auth::user()->tipo_usuario === 'administrador')
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-crown mr-1"></i>ADMINISTRADOR
                                    </span>
                                @elseif (Auth::user()->tipo_usuario === 'vendedor')
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-user-tie mr-1"></i>VENDEDOR
                                    </span>
                                @else
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-user mr-1"></i>CLIENTE
                                    </span>
                                @endif
                            @endif
                        </div>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    style="display: flex; align-items: center; color: #E9D5FF; transition: all 0.3s ease; padding: 8px 12px; border-radius: 8px; background: transparent; border: none; cursor: pointer;"
                                    onmouseover="this.style.color='#FFD700'; this.style.background='rgba(255, 215, 0, 0.1)';"
                                    onmouseout="this.style.color='#E9D5FF'; this.style.background='transparent';">
                                <img src="{{ asset('app/publico/img/user.svg') }}" 
                                     style="width: 32px; height: 32px; border-radius: 50%; margin-right: 8px; border: 2px solid #FFD700;" 
                                     alt="User">
                                <span style="font-weight: 500; margin-right: 8px;">{{ Auth::user()->nombre ?? 'Usuario' }}</span>
                                <i class="fas fa-chevron-down" style="font-size: 12px; transition: transform 0.3s ease;" 
                                   :style="open ? 'transform: rotate(180deg)' : ''"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 style="position: absolute; right: 0; margin-top: 8px; width: 220px; background: linear-gradient(135deg, #4B0082 0%, #800080 50%, #00008B 100%); border-radius: 12px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 2px solid #FFD700; z-index: 50; overflow: hidden;">
                                <div style="padding: 8px;">
                                    <a href="{{ route('cambiarClave.index') }}" 
                                       style="display: flex; align-items: center; padding: 12px 16px; color: #E9D5FF; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; margin-bottom: 4px;"
                                       onmouseover="this.style.background='linear-gradient(135deg, #FFD700, #FFA500)'; this.style.color='white'; this.style.transform='translateX(4px)';"
                                       onmouseout="this.style.background='transparent'; this.style.color='#E9D5FF'; this.style.transform='translateX(0)';">
                                        <i class="fas fa-key" style="margin-right: 12px; font-size: 14px; color: #FFD700;"></i>
                                        <span style="font-weight: 500;">Cambiar Contraseña</span>
                                    </a>
                                    <div style="height: 1px; background: linear-gradient(90deg, transparent, #FFD700, transparent); margin: 8px 0;"></div>
                                    <form method="POST" action="{{ route('logout') }}" style="display: block;">
                                        @csrf
                                        <button type="submit" 
                                                style="display: flex; align-items: center; width: 100%; text-align: left; padding: 12px 16px; color: #EF4444; background: transparent; border: none; border-radius: 8px; transition: all 0.3s ease; cursor: pointer; font-size: 14px;"
                                                onmouseover="this.style.background='linear-gradient(135deg, #EF4444, #DC2626)'; this.style.color='white'; this.style.transform='translateX(4px)';"
                                                onmouseout="this.style.background='transparent'; this.style.color='#EF4444'; this.style.transform='translateX(0)';">
                                            <i class="fas fa-sign-out-alt" style="margin-right: 12px; font-size: 14px;"></i>
                                            <span style="font-weight: 500;">Cerrar Sesión</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main style="flex: 1; overflow: auto; margin: 0; padding: 0; border: none;">
                <div style="padding: 0; margin: 0; border: none;">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- PWA Installation Script -->
    <script>
        window.onload = (e) => {
            const buttonAdd = document.querySelector('#buttonAdd');

            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
            });

            if (buttonAdd) {
                buttonAdd.addEventListener('click', (e) => {
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice
                        .then((choiceResult) => {
                            if (choiceResult.outcome === 'accepted') {
                                console.log('Aceptó su instalación');
                            } else {
                                console.log('Rechazó su instalación');
                            }
                            deferredPrompt = null;
                        });
                });
            }
        }
    </script>

    <!-- jQuery and other scripts -->
    <script src="{{ asset('app/publico/js/lib/tether/tether.min.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    
    <!-- DataTables -->
    <script src="{{ asset('app/publico/js/lib/datatables-net/datatables.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('sweet/js/sweet.js') }}"></script>

    <!-- DataTables Configuration -->
    <script>
        $(function() {
            $('#example').DataTable({
                "order": [[0, "desc"]],
                select: {},
                responsive: true,
                "pageLength": 10,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Registros del _START_ al _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Registros del 0 al 0 de 0 registros",
                    "sInfoFiltered": "-",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        });

        $(function() {
            $('#example2').DataTable({
                "order": [[0, "desc"]],
                select: {},
                "paging": false,
                "dom": "",
                responsive: true,
                "pageLength": 10,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Registros del _START_ al _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Registros del 0 al 0 de 0 registros",
                    "sInfoFiltered": "-",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        });
    </script>

    <!-- Additional Scripts -->
    <script type="text/javascript" src="{{ asset('app/publico/js/lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/publico/js/lib/lobipanel/lobipanel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/publico/js/lib/match-height/jquery.matchHeight.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('loader/loader.js') }}"></script>

    <!-- Chart Configuration -->
    <script>
        $(document).ready(function() {
            $('.panel').lobiPanel({
                sortable: true
            });
            $('.panel').on('dragged.lobiPanel', function(ev, lobiPanel) {
                $('.dahsboard-column').matchHeight();
            });

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Day');
                dataTable.addColumn('number', 'Values');
                dataTable.addColumn({
                    type: 'string',
                    role: 'tooltip',
                    'p': {
                        'html': true
                    }
                });
                dataTable.addRows([
                    ['MON', 130, ' '],
                    ['TUE', 130, '130'],
                    ['WED', 180, '180'],
                    ['THU', 175, '175'],
                    ['FRI', 200, '200'],
                    ['SAT', 170, '170'],
                    ['SUN', 250, '250'],
                    ['MON', 220, '220'],
                    ['TUE', 220, ' ']
                ]);

                var options = {
                    height: 314,
                    legend: 'none',
                    areaOpacity: 0.18,
                    axisTitlesPosition: 'out',
                    hAxis: {
                        title: '',
                        textStyle: {
                            color: '#1e293b',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        textPosition: 'out'
                    },
                    vAxis: {
                        minValue: 0,
                        textPosition: 'out',
                        textStyle: {
                            color: '#1e293b',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        baselineColor: '#3b82f6',
                        ticks: [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350],
                        gridlines: {
                            color: '#e2e8f0',
                            count: 15
                        }
                    },
                    lineWidth: 2,
                    colors: ['#3b82f6'],
                    curveType: 'function',
                    pointSize: 5,
                    pointShapeType: 'circle',
                    pointFillColor: '#ef4444',
                    backgroundColor: {
                        fill: '#ffffff',
                        strokeWidth: 0,
                    },
                    chartArea: {
                        left: 0,
                        top: 0,
                        width: '100%',
                        height: '100%'
                    },
                    fontSize: 11,
                    fontName: 'Proxima Nova',
                    tooltip: {
                        trigger: 'selection',
                        isHtml: true
                    }
                };

                var chartElement = document.getElementById('chart_div');
                if (chartElement) {
                    var chart = new google.visualization.AreaChart(chartElement);
                    chart.draw(dataTable, options);
                }
            }
            $(window).resize(function() {
                drawChart();
                setTimeout(function() {}, 1000);
            });
        });
    </script>

    <!-- App Scripts -->
    <script src="{{ asset('app/publico/js/app.js') }}"></script>

    <!-- Form Scripts -->
    <script src="{{ asset('app/publico/js/lib/jquery-flex-label/jquery.flex.label.js') }}"></script>
    <script type="application/javascript">
        (function ($) {
            $(document).ready(function () {
                $('.fl-flex-label').flexLabel();
            });
        })(jQuery);
    </script>

    <!-- Mobile Sidebar Toggle -->
    <script>
        document.getElementById('show-hide-sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('nav');
            sidebar.classList.toggle('hidden');
        });
    </script>

    <!-- Sistema de Notificaciones Moderno -->
    <script>
        // Función para mostrar notificaciones modernas
        function showNotification(message, type = 'success') {
            // Crear el contenedor de notificaciones si no existe
            let notificationContainer = document.getElementById('notification-container');
            if (!notificationContainer) {
                notificationContainer = document.createElement('div');
                notificationContainer.id = 'notification-container';
                notificationContainer.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                `;
                document.body.appendChild(notificationContainer);
            }

            // Configurar colores según el tipo
            let colors, icon, title;
            switch(type) {
                case 'success':
                    colors = {
                        bg: 'linear-gradient(135deg, #10B981 0%, #059669 100%)',
                        border: '#10B981',
                        icon: '#FFFFFF'
                    };
                    icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>`;
                    title = '¡Éxito!';
                    break;
                case 'error':
                    colors = {
                        bg: 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)',
                        border: '#EF4444',
                        icon: '#FFFFFF'
                    };
                    icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>`;
                    title = 'Error';
                    break;
                case 'warning':
                    colors = {
                        bg: 'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)',
                        border: '#F59E0B',
                        icon: '#FFFFFF'
                    };
                    icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>`;
                    title = 'Advertencia';
                    break;
                case 'info':
                    colors = {
                        bg: 'linear-gradient(135deg, #3B82F6 0%, #2563EB 100%)',
                        border: '#3B82F6',
                        icon: '#FFFFFF'
                    };
                    icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>`;
                    title = 'Información';
                    break;
            }

            // Crear la notificación
            const notification = document.createElement('div');
            notification.style.cssText = `
                background: ${colors.bg};
                border: 2px solid ${colors.border};
                border-radius: 16px;
                padding: 16px 20px;
                color: white;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(10px);
                transform: translateX(100%);
                transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                min-width: 320px;
                max-width: 400px;
                position: relative;
                overflow: hidden;
            `;

            // Agregar efecto de brillo
            notification.innerHTML = `
                <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.5s;"></div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="flex-shrink: 0; color: ${colors.icon};">
                        ${icon}
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">${title}</div>
                        <div style="font-size: 13px; opacity: 0.9; line-height: 1.4;">${message}</div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" 
                            style="flex-shrink: 0; background: rgba(255,255,255,0.2); border: none; border-radius: 50%; width: 24px; height: 24px; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 12px; transition: all 0.3s ease;"
                            onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        ×
                    </button>
                </div>
            `;

            // Agregar al contenedor
            notificationContainer.appendChild(notification);

            // Animación de entrada
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Efecto de brillo
            setTimeout(() => {
                const shine = notification.querySelector('div');
                if (shine) shine.style.left = '100%';
            }, 200);

            // Auto-remover después de 5 segundos
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 500);
            }, 5000);

            return notification;
        }

        // Función para mostrar notificaciones de sesión
        function showSessionNotifications() {
            @if (session('CORRECTO'))
                showNotification('{{ session('CORRECTO') }}', 'success');
            @endif
            
            @if (session('INCORRECTO'))
                showNotification('{{ session('INCORRECTO') }}', 'error');
            @endif
            
            @if (session('AVISO'))
                showNotification('{{ session('AVISO') }}', 'warning');
            @endif
        }

        // Ejecutar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            showSessionNotifications();
        });
    </script>

</body>

</html>
