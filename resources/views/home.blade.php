@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #232046 0%, #2d225a 100%); min-height: 100vh; padding: 2rem; margin: 0; border: none;">
    <!-- Título del Panel -->
    <div style="text-align: center; margin-bottom: 3rem;">
        <h2 style="font-size: 2.5rem; font-weight: bold; color: #F3F4F6; margin-bottom: 1rem; letter-spacing: 1px;">PANEL DE CONTROL</h2>
        <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #FFD700 0%, #F3F4F6 100%); margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <!-- Estadísticas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Membresías -->
            <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 1.5rem; border: 1px solid #FFD70033; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 32px rgba(255, 215, 0, 0.10)';" 
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 24px 0 rgba(0,0,0,0.10)';">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem; letter-spacing: 1px;">{{ $totalMembresia }}</div>
                    <div style="font-size: 0.875rem; color: #F3F4F6; text-transform: uppercase; letter-spacing: 0.05em;">MEMBRESIAS</div>
                </div>
            </div>
            <!-- Clientes Registrados -->
            <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 1.5rem; border: 1px solid #FFD70033; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 32px rgba(255, 215, 0, 0.10)';" 
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 24px 0 rgba(0,0,0,0.10)';">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem; letter-spacing: 1px;">{{ $totalCliente }}</div>
                    <div style="font-size: 0.875rem; color: #F3F4F6; text-transform: uppercase; letter-spacing: 0.05em;">CLIENTES REGISTRADOS</div>
                </div>
            </div>
            <!-- Usuarios del Sistema -->
            <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 1.5rem; border: 1px solid #FFD70033; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 32px rgba(255, 215, 0, 0.10)';" 
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 24px 0 rgba(0,0,0,0.10)';">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem; letter-spacing: 1px;">{{ $totalUsuario }}</div>
                    <div style="font-size: 0.875rem; color: #F3F4F6; text-transform: uppercase; letter-spacing: 0.05em;">USUARIOS DEL SISTEMA</div>
                </div>
            </div>
            <!-- Asistencias de Hoy -->
            <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 1.5rem; border: 1px solid #FFD70033; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 32px rgba(255, 215, 0, 0.10)';" 
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 24px 0 rgba(0,0,0,0.10)';">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem; letter-spacing: 1px;">{{ $totalAsistencia }}</div>
                    <div style="font-size: 0.875rem; color: #F3F4F6; text-transform: uppercase; letter-spacing: 0.05em;">ASISTENCIAS DE HOY</div>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Columna Principal -->
            <div style="flex: 1;">
                <!-- Formulario de Asistencia -->
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid rgba(255, 215, 0, 0.3);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #FFD700; margin-bottom: 1.5rem; text-align: center;">Registra tu Asistencia</h2>
                    
                    <form action="{{ route('asistencia.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                        @csrf
                        
                        <!-- Mensajes de Error -->
                        @error('txtdni')
                            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444; color: #FEE2E2; padding: 1rem; border-radius: 8px;">{{ $errors->first('txtdni') }}</div>
                        @enderror

                        @if (session('CORRECTO'))
                            <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid #22C55E; color: #DCFCE7; padding: 1rem; border-radius: 8px;">{{ session('CORRECTO') }}</div>
                        @endif

                        @if (session('INCORRECTO'))
                            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444; color: #FEE2E2; padding: 1rem; border-radius: 8px;">{{ session('INCORRECTO') }}</div>
                        @endif

                        @if (session('AVISO'))
                            <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid #F59E0B; color: #FEF3C7; padding: 1rem; border-radius: 8px;">{{ session('AVISO') }}</div>
                        @endif

                        <!-- Formulario -->
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="flex: 1;">
                                <input type="number" 
                                       style="width: 100%; padding: 12px 16px; background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(255, 215, 0, 0.3); border-radius: 8px; color: #1F2937; font-size: 1rem; outline: none; transition: all 0.3s ease;"
                                       placeholder="Ingrese el CI del cliente" 
                                       name="txtdni" 
                                       required
                                       onfocus="this.style.borderColor='#FFD700'; this.style.boxShadow='0 0 0 3px rgba(255, 215, 0, 0.1)';"
                                       onblur="this.style.borderColor='rgba(255, 215, 0, 0.3)'; this.style.boxShadow='none';">
                            </div>
                            <div style="width: 100%;">
                                <button type="submit" 
                                        style="width: 100%; padding: 12px 16px; background: linear-gradient(135deg, #FFD700, #FFA500); color: white; font-weight: 600; border-radius: 8px; border: none; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3);"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px rgba(255, 215, 0, 0.4)';" 
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(255, 215, 0, 0.3)';">
                                    Marcar Asistencia
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Columna Lateral -->
            <div style="flex: 1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    
                    <!-- Miembros por Renovar -->
                    <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255, 215, 0, 0.3);">
                        <div style="background: linear-gradient(135deg, #FFD700, #FFA500); color: white; padding: 1rem; text-align: center; font-weight: 600;">
                            Miembros por renovar
                        </div>
                        <div style="max-height: 256px; overflow-y: auto;">
                            @foreach ($miembrosPorRenovar as $item)
                                @if ($item->diferencia_fechas <= 7 && $item->diferencia_fechas > 0)
                                    <div style="border-bottom: 1px solid rgba(255, 215, 0, 0.2); padding: 1rem; transition: all 0.3s ease;"
                                         onmouseover="this.style.background='rgba(255, 215, 0, 0.1)';" 
                                         onmouseout="this.style.background='transparent';">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="flex-shrink: 0;">
                                                @if ($item->foto != '')
                                                    <img src="data:image/jpg;base64,{{ base64_encode($item->foto) }}"
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img-inicio/user.jpg') }}" 
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @endif
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <p style="font-size: 0.875rem; font-weight: 600; color: #E9D5FF;">
                                                    <a href="{{ route('cliente.show', $item->id_cliente) }}" 
                                                       style="color: inherit; text-decoration: none; transition: color 0.3s ease;"
                                                       onmouseover="this.style.color='#FFD700';" 
                                                       onmouseout="this.style.color='#E9D5FF';">
                                                        {{ $item->nombre }}
                                                    </a>
                                                </p>
                                                <p style="font-size: 0.75rem; color: #C4B5FD;">{{ $item->modo }}</p>
                                            </div>
                                            <div style="text-align: right;">
                                                <p style="font-size: 0.75rem; color: #FFD700; font-weight: 600;">
                                                    Quedan {{ $item->diferencia_fechas }} días
                                                </p>
                                                <p style="font-size: 0.875rem; color: #EF4444; font-weight: bold;">S/. {{ $item->precio }}.00</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @if ($item->diferencia_fechas <= 0 && $item->diferencia_fechas >= -10)
                                    <div style="border-bottom: 1px solid rgba(255, 215, 0, 0.2); padding: 1rem; background: rgba(239, 68, 68, 0.1); transition: all 0.3s ease;"
                                         onmouseover="this.style.background='rgba(239, 68, 68, 0.2)';" 
                                         onmouseout="this.style.background='rgba(239, 68, 68, 0.1)';">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="flex-shrink: 0;">
                                                @if ($item->foto != '')
                                                    <img src="data:image/jpg;base64,{{ base64_encode($item->foto) }}"
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img-inicio/user.jpg') }}" 
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @endif
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <p style="font-size: 0.875rem; font-weight: 600; color: #E9D5FF;">
                                                    <a href="{{ route('cliente.show', $item->id_cliente) }}" 
                                                       style="color: inherit; text-decoration: none; transition: color 0.3s ease;"
                                                       onmouseover="this.style.color='#FFD700';" 
                                                       onmouseout="this.style.color='#E9D5FF';">
                                                        {{ $item->nombre }}
                                                    </a>
                                                </p>
                                                <p style="font-size: 0.75rem; color: #C4B5FD;">{{ $item->modo }}</p>
                                            </div>
                                            <div style="text-align: right;">
                                                <p style="font-size: 0.75rem; color: #EF4444; font-weight: 600;">
                                                    Vencido hace {{ abs($item->diferencia_fechas) }} días
                                                </p>
                                                <p style="font-size: 0.875rem; color: #EF4444; font-weight: bold;">S/. {{ $item->precio }}.00</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Clientes con Deuda -->
                    <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255, 215, 0, 0.3);">
                        <div style="background: linear-gradient(135deg, #EF4444, #DC2626); color: white; padding: 1rem; text-align: center; font-weight: 600;">
                            Clientes con deuda
                        </div>
                        <div style="max-height: 256px; overflow-y: auto;">
                            @foreach ($cuentasPorCobrar as $item2)
                                @if ($item2->debe > 0)
                                    <div style="border-bottom: 1px solid rgba(255, 215, 0, 0.2); padding: 1rem; transition: all 0.3s ease;"
                                         onmouseover="this.style.background='rgba(239, 68, 68, 0.1)';" 
                                         onmouseout="this.style.background='transparent';">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="flex-shrink: 0;">
                                                @if ($item2->foto != '')
                                                    <img src="data:image/jpg;base64,{{ base64_encode($item2->foto) }}"
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img-inicio/user.jpg') }}" 
                                                         alt="" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                                @endif
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <p style="font-size: 0.875rem; font-weight: 600; color: #E9D5FF;">
                                                    <a href="{{ route('cliente.pagoCliente', $item2->id_cliente) }}" 
                                                       style="color: inherit; text-decoration: none; transition: color 0.3s ease;"
                                                       onmouseover="this.style.color='#FFD700';" 
                                                       onmouseout="this.style.color='#E9D5FF';">
                                                        {{ $item2->nombre }}
                                                    </a>
                                                </p>
                                                <p style="font-size: 0.75rem; color: #C4B5FD;">{{ $item2->modo }}</p>
                                            </div>
                                            <div style="text-align: right;">
                                                <p style="font-size: 0.75rem; color: #FFD700; font-weight: 600;">{{ $item2->diferencia_fechas }} días</p>
                                                <p style="font-size: 0.875rem; color: #EF4444; font-weight: bold;">S/. {{ $item2->debe }}.00</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    // Verificar si el elemento scanButton existe antes de agregar el event listener
    const scanButton = document.getElementById('scanButton');
    if (scanButton) {
        scanButton.addEventListener('click', () => {
            // Abre el escáner
            const scanner = new window.Scanner();
            scanner.scan((result) => {
                // Maneja el resultado del escaneo
                console.log(result);
            });
        });
    }
</script>
@endsection

@section('content-vendedor')
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
    
    <button id="scanButton" 
            style="background: linear-gradient(135deg, #FFD700, #FFA500); color: white; font-weight: 600; padding: 8px 16px; border-radius: 8px; border: none; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3);"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px rgba(255, 215, 0, 0.4)';" 
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(255, 215, 0, 0.3)';">
        Escanear
    </button>
@endsection
