@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wizard-container">
        <div id="step1" class="wizard-step active">
            <h2>Selecciona tu Género</h2>
            <div class="gender-options">
                <div class="gender-card" onclick="seleccionarGenero(this, 'male')">
                    <img src="{{ asset('images/hombre.png') }}" alt="Masculino" class="gender-image" onerror="this.style.display='none'">
                    <span class="gender-label">Masculino</span>
                    <p class="gender-description">¡Comienza tu viaje hacia una versión más fuerte de ti mismo!</p>
                </div>
                <div class="gender-card" onclick="seleccionarGenero(this, 'female')">
                    <img src="{{ asset('images/mujer.png') }}" alt="Femenino" class="gender-image" onerror="this.style.display='none'">
                    <span class="gender-label">Femenino</span>
                    <p class="gender-description">¡Descubre tu potencial y alcanza tus metas fitness!</p>
                </div>
            </div>
            <div class="wizard-buttons">
                <button id="next-button" class="btn-wizard" onclick="mostrarStep2()" style="display: none;">Siguiente</button>
            </div>
        </div>

        <div id="step2" class="wizard-step">
            <h2>Nivel de Experiencia</h2>
            <div class="level-options">
                <div class="level-card" data-level="principiante" onclick="seleccionarNivel(this)">
                    <span class="icon">🌱</span>
                    <span class="level-title">Principiante</span>
                    <p class="level-desc">Nunca has entrenado o llevas menos de 6 meses entrenando. Aprenderás lo básico y crearás el hábito.</p>
                </div>
                <div class="level-card" data-level="intermedio" onclick="seleccionarNivel(this)">
                    <span class="icon">🌿</span>
                    <span class="level-title">Intermedio</span>
                    <p class="level-desc">Ya tienes experiencia (6 meses a 2 años), conoces los ejercicios y buscas mejorar fuerza y técnica.</p>
                </div>
                <div class="level-card" data-level="avanzado" onclick="seleccionarNivel(this)">
                    <span class="icon">🌳</span>
                    <span class="level-title">Avanzado</span>
                    <p class="level-desc">Entrenas de forma constante por más de 2 años, dominas la técnica y buscas retos mayores.</p>
                </div>
            </div>
            <div class="wizard-buttons">
                <button class="btn-wizard btn-back" onclick="volverAtras(2)">Atrás</button>
                <button class="btn-wizard" id="step2-btn" onclick="mostrarStep3()" disabled>Siguiente</button>
            </div>
        </div>

        <div id="step3" class="wizard-step">
            <h2>Tu Objetivo Principal</h2>
            <div class="objective-options">
                <div class="objective-card" data-objective="perder-peso" onclick="seleccionarObjetivo(this)">
                    <span class="icon">⚖️</span>
                    <span class="objective-title">Perder Peso</span>
                    <p class="objective-desc">Quieres reducir grasa corporal y definir tu figura con ejercicios específicos y dieta controlada.</p>
                </div>
                <div class="objective-card" data-objective="ganar-musculo" onclick="seleccionarObjetivo(this)">
                    <span class="icon">💪</span>
                    <span class="objective-title">Ganar Músculo</span>
                    <p class="objective-desc">Buscas aumentar tu masa muscular y fuerza con rutinas de hipertrofia y nutrición adecuada.</p>
                </div>
                <div class="objective-card" data-objective="mantener" onclick="seleccionarObjetivo(this)">
                    <span class="icon">🎯</span>
                    <span class="objective-title">Mantener Forma</span>
                    <p class="objective-desc">Quieres mantener tu condición física actual y mejorar tu salud general.</p>
                </div>
            </div>
            <div class="wizard-buttons">
                <button class="btn-wizard btn-back" onclick="volverAtras(3)">Atrás</button>
                <button class="btn-wizard" id="step3-btn" onclick="mostrarStep4()" disabled>Siguiente</button>
            </div>
        </div>

        <div id="step4" class="wizard-step">
            <h2>Frecuencia de Entrenamiento</h2>
            <div class="frequency-options">
                <div class="frequency-card" data-frequency="2" onclick="seleccionarFrecuencia(this)">
                    <span class="icon">🌙</span>
                    <span class="frequency-title">2 días por semana</span>
                    <p class="frequency-desc">Ideal para principiantes o personas con poco tiempo. Perfecto para crear el hábito.</p>
                </div>
                <div class="frequency-card" data-frequency="3" onclick="seleccionarFrecuencia(this)">
                    <span class="icon">⭐</span>
                    <span class="frequency-title">3 días por semana</span>
                    <p class="frequency-desc">Balance perfecto entre progreso y recuperación. Recomendado para la mayoría.</p>
                </div>
                <div class="frequency-card" data-frequency="4" onclick="seleccionarFrecuencia(this)">
                    <span class="icon">🔥</span>
                    <span class="frequency-title">4 días por semana</span>
                    <p class="frequency-desc">Para quienes buscan resultados más rápidos y tienen tiempo para dedicar.</p>
                </div>
                <div class="frequency-card" data-frequency="5" onclick="seleccionarFrecuencia(this)">
                    <span class="icon">⚡</span>
                    <span class="frequency-title">5 días por semana</span>
                    <p class="frequency-desc">Para atletas avanzados que buscan maximizar su potencial y rendimiento.</p>
                </div>
            </div>
            <div class="wizard-buttons">
                <button class="btn-wizard btn-back" onclick="volverAtras(4)">Atrás</button>
                <button class="btn-wizard" id="step4-btn" onclick="mostrarStep5()" disabled>Siguiente</button>
            </div>
        </div>

        <div id="step5" class="wizard-step">
            <h2>Tu Peso y Altura</h2>
            <div class="measurements-container">
                <div class="measurement-group">
                    <label for="peso">Peso: <span id="peso-valor">70</span> kg</label>
                    <input type="range" id="peso" class="measurement-slider" min="30" max="200" value="70" step="0.1">
                    <div class="slider-marks">
                        <span>30</span>
                        <span>70</span>
                        <span>110</span>
                        <span>150</span>
                        <span>200</span>
                    </div>
                    <p class="measurement-desc">Desliza para seleccionar tu peso actual en kilogramos</p>
                </div>
                
                <div class="measurement-group">
                    <label for="altura">Altura: <span id="altura-valor">170</span> cm</label>
                    <input type="range" id="altura" class="measurement-slider" min="100" max="250" value="170" step="0.1">
                    <div class="slider-marks">
                        <span>100</span>
                        <span>150</span>
                        <span>170</span>
                        <span>200</span>
                        <span>250</span>
                    </div>
                    <p class="measurement-desc">Desliza para seleccionar tu altura en centímetros</p>
                </div>
            </div>
            <div class="wizard-buttons">
                <button class="btn-wizard btn-back" onclick="volverAtras(5)">Atrás</button>
                <button class="btn-wizard" id="step5-btn" onclick="mostrarStep6()">Finalizar</button>
            </div>
        </div>

        <div id="step6" class="wizard-step">
            <h2>Selecciona las áreas que deseas trabajar</h2>
            <div class="areas-container">
                <button type="button" class="area-btn" data-area="todo" onclick="seleccionarArea(this, true)">
                    <span class="area-icon">💪</span>
                    <span class="area-title">TODO EL CUERPO</span>
                    <span class="area-desc">Entrenamiento global para fuerza, resistencia y salud integral.</span>
                </button>
                <div class="areas-grid">
                    <button type="button" class="area-btn" data-area="espalda" onclick="seleccionarArea(this)">
                        <span class="area-icon">🦾</span>
                        <span class="area-title">Espalda</span>
                        <span class="area-desc">Mejora tu postura y fortalece la zona dorsal.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="hombro" onclick="seleccionarArea(this)">
                        <span class="area-icon">🏋️‍♂️</span>
                        <span class="area-title">Hombro</span>
                        <span class="area-desc">Aumenta la fuerza y estabilidad de tus hombros.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="brazo" onclick="seleccionarArea(this)">
                        <span class="area-icon">💪</span>
                        <span class="area-title">Brazo</span>
                        <span class="area-desc">Tonifica bíceps y tríceps para brazos definidos.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="pecho" onclick="seleccionarArea(this)">
                        <span class="area-icon">🏆</span>
                        <span class="area-title">Pecho</span>
                        <span class="area-desc">Desarrolla fuerza y volumen en el torso superior.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="abdominales" onclick="seleccionarArea(this)">
                        <span class="area-icon">🧘‍♂️</span>
                        <span class="area-title">Abdominales</span>
                        <span class="area-desc">Trabaja el core para estabilidad y definición.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="gluteos" onclick="seleccionarArea(this)">
                        <span class="area-icon">🦶</span>
                        <span class="area-title">Glúteos</span>
                        <span class="area-desc">Potencia y tonifica la zona baja de la espalda.</span>
                    </button>
                    <button type="button" class="area-btn" data-area="piernas" onclick="seleccionarArea(this)">
                        <span class="area-icon">🦵</span>
                        <span class="area-title">Piernas</span>
                        <span class="area-desc">Fuerza y resistencia para todo el tren inferior.</span>
                    </button>
                </div>
            </div>
            <div class="wizard-buttons">
                <button class="btn-wizard btn-back" onclick="volverAtras(6)">Atrás</button>
                <button class="btn-wizard" id="step6-btn" onclick="finalizarWizard()" disabled>Finalizar</button>
            </div>
        </div>

        {{-- <div id="step7" class="wizard-step">
            <h2>Resumen Personalizado</h2>
            <div class="summary-boxes">
                <div class="summary-box">
                    <div class="summary-title">Información Personal</div>
                    <ul class="summary-list" id="personal-info"></ul>
                </div>
                <div class="summary-box">
                    <div class="summary-title">IMC y Estado</div>
                    <ul class="summary-list" id="bmi-info"></ul>
                </div>
            </div>
            <div class="summary-box">
                <div class="summary-title">Recomendaciones</div>
                <ul class="summary-list" id="recommendations"></ul>
            </div>
            <button class="btn-wizard" onclick="nextStep(6)">Comenzar Entrenamiento</button>
        </div> --}}

        <div id="step8" class="wizard-step">
            <div class="loading-step">
                <div class="loading-spinner"></div>
                {{-- <div class="loading-text">Preparando tu entrenamiento personalizado...</div> --}}
            </div>
        </div>

        {{-- <div id="step9" class="wizard-step">
            <div class="training-step">
                <h2 class="training-title">Tu Rutina Personalizada</h2>
                <div id="exercise-list"></div>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress" id="workout-progress" style="width: 0%"></div>
                    </div>
                    <div class="progress-text">
                        <span id="completed-exercises">0</span> de <span id="total-exercises">0</span> ejercicios completados
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Paso 10: Loading Spinner -->
        <div id="step10" class="wizard-step">
            <div class="loading-step">
                <div class="spinner"></div>
                <div class="loading-text">Generando tu rutina personalizada...</div>
            </div>
        </div>

        <!-- Paso 11: Preview Resumen -->
        <div id="step11" class="wizard-step">
            <div class="preview-header">
                <h2>¡Hola, <span id="prev-nombre">Cristian</span>! Este es tu plan personalizado</h2>
            </div>
            <div class="preview-plan-activo">
                <span class="plan-icon">⚡</span>
                <div>
                    <div class="plan-label">Plan Activo:</div>
                    <div class="plan-title" id="plan-titulo">Plan de [objetivo] de <span id="plan-nombre">Cristian</span></div>
                </div>
                <button class="plan-btn">Planes</button>
            </div>
            <div class="preview-next-block">
                <div class="next-label">Tu próximo entrenamiento:</div>
                <div class="next-title" id="next-titulo">Fuerza de Pecho y Tríceps</div>
                <div class="ejercicios-lista" id="ejercicios-lista">
                    <!-- Ejercicios se llenan por JS -->
                </div>
            </div>
            <button class="btn-wizard btn-preview" id="btn-comenzar-entreno"><span class="btn-icon">⚡</span>Comenzar</button>
        </div>

        <!-- Paso 12: Preview Clásico -->
        <div id="step12" class="wizard-step">
            <h2>Tu Plan Personalizado</h2>
            <div class="preview-flex">
                <div class="preview-card">
                    <h3>Información Personal</h3>
                    <ul class="preview-list">
                        <li><b>Género:</b> <span id="clasico-genero"></span></li>
                        <li><b>Peso:</b> <span id="clasico-peso"></span> kg</li>
                        <li><b>Altura:</b> <span id="clasico-altura"></span> cm</li>
                        <li><b>IMC:</b> <span id="clasico-imc"></span></li>
                        <li><b>Estado:</b> <span id="clasico-estado"></span></li>
                    </ul>
                </div>
                <div class="preview-card">
                    <h3>Objetivos y Nivel</h3>
                    <ul class="preview-list">
                        <li><b>Nivel de Experiencia:</b> <span id="clasico-nivel"></span></li>
                        <li><b>Objetivo Principal:</b> <span id="clasico-objetivo"></span></li>
                        <li><b>Calorías Diarias:</b> <span id="clasico-calorias"></span> kcal</li>
                    </ul>
                </div>
            </div>
            <div class="preview-areas">
                <h3>Áreas a Trabajar</h3>
                <div id="clasico-areas" class="preview-tags"></div>
            </div>
            <div class="preview-recomendaciones">
                <h3>Recomendaciones Personalizadas</h3>
                <ul id="clasico-recomendaciones" class="preview-reco-list"></ul>
            </div>
            <button class="btn-wizard btn-preview" id="btn-clasico-comenzar">Comenzar Entrenamiento</button>
        </div>

        <!-- Paso 13: Countdown Overlay -->
        <div id="step13" class="wizard-step">
            <div class="countdown-overlay" style="display:flex;">
                <div class="countdown-number" id="countdown-number">3</div>
            </div>
        </div>
    </div>
</div>

<div id="preview-clasico" class="preview-clasico" style="display:none;">
    <h2>Tu Plan Personalizado</h2>
    <div class="preview-flex">
        <div class="preview-card">
            <h3>Información Personal</h3>
            <ul class="preview-list">
                <li><b>Género:</b> <span id="clasico-genero"></span></li>
                <li><b>Peso:</b> <span id="clasico-peso"></span> kg</li>
                <li><b>Altura:</b> <span id="clasico-altura"></span> cm</li>
                <li><b>IMC:</b> <span id="clasico-imc"></span></li>
                <li><b>Estado:</b> <span id="clasico-estado"></span></li>
            </ul>
        </div>
        <div class="preview-card">
            <h3>Objetivos y Nivel</h3>
            <ul class="preview-list">
                <li><b>Nivel de Experiencia:</b> <span id="clasico-nivel"></span></li>
                <li><b>Objetivo Principal:</b> <span id="clasico-objetivo"></span></li>
                <li><b>Calorías Diarias:</b> <span id="clasico-calorias"></span> kcal</li>
            </ul>
        </div>
    </div>
    <div class="preview-areas">
        <h3>Áreas a Trabajar</h3>
        <div id="clasico-areas" class="preview-tags"></div>
    </div>
    <div class="preview-recomendaciones">
        <h3>Recomendaciones Personalizadas</h3>
        <ul id="clasico-recomendaciones" class="preview-reco-list"></ul>
    </div>
    <button class="btn-wizard btn-preview" id="btn-clasico-comenzar">Comenzar Entrenamiento</button>
</div>

<div id="countdown-overlay" class="countdown-overlay" style="display:none;">
    <div class="countdown-number" id="countdown-number">3</div>
</div>

<div id="ejercicio-activo" class="ejercicio-activo" style="display:none;">
    <div class="ej-activo-header">
        <button class="ej-cerrar" onclick="cerrarEjercicio()">&times;</button>
        <span class="ej-timer" id="ej-timer">Tiempo: 00:00</span>
        <button class="ej-finalizar" onclick="finalizarEntrenamiento()">Finalizar</button>
    </div>
    <div class="ej-activo-main">
        <div class="ej-activo-lista" id="ej-activo-lista">
            <!-- Miniaturas de ejercicios -->
        </div>
        <div class="ej-activo-num" id="ej-activo-num">1</div>
        <img id="ej-activo-img" class="ej-activo-img" src="" alt="Ejercicio">
        <div class="ej-activo-nombre" id="ej-activo-nombre"></div>
        <div class="ej-activo-repes" id="ej-activo-repes"></div>
        <div class="ej-activo-grupo" id="ej-activo-grupo"></div>
        <button class="btn-wizard btn-ej-siguiente" id="btn-ej-siguiente" onclick="siguienteEjercicio()">Siguiente</button>
    </div>
</div>

<style>
/* Forzar que todos los pasos estén ocultos por defecto */
.wizard-step {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    position: absolute !important;
    pointer-events: none !important;
    height: 0 !important;
    overflow: hidden !important;
}

/* Solo mostrar el paso que tenga la clase active */
.wizard-step.active {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    pointer-events: auto !important;
    height: auto !important;
    overflow: visible !important;
}

/* Ocultar cualquier otro contenido que no sea un paso */
.wizard-container > *:not(.wizard-step) {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    position: absolute !important;
    pointer-events: none !important;
    height: 0 !important;
    overflow: hidden !important;
}

/* Ocultar los bloques que están fuera del wizard */
#loading-spinner,
#preview-resumen,
.loading-overlay,
.preview-resumen {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    position: absolute !important;
    pointer-events: none !important;
}

/* OCULTAR cualquier bloque duplicado fuera del wizard */
#preview-resumen:not(.wizard-step.active),
#preview-clasico:not(.wizard-step.active),
#loading-spinner:not(.wizard-step.active),
#countdown-overlay:not(.wizard-step.active) {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    position: absolute !important;
    pointer-events: none !important;
    height: 0 !important;
    overflow: hidden !important;
}
</style>

<script>
// --- NUEVA LÓGICA DE NAVEGACIÓN ENTRE PASOS ---
function mostrarPaso(paso) {
    document.querySelectorAll('.wizard-step').forEach((step, idx) => {
        step.classList.remove('active');
    });
    var step = document.getElementById('step' + paso);
    if (step) step.classList.add('active');
}

// Ejemplo de navegación:
function mostrarStep2() { mostrarPaso(2); }
function mostrarStep3() { mostrarPaso(3); }
function mostrarStep4() { mostrarPaso(4); }
function mostrarStep5() { mostrarPaso(5); }
function mostrarStep6() { mostrarPaso(6); }
function mostrarStep7() { mostrarPaso(7); }
function mostrarStep8() { mostrarPaso(8); }
function mostrarStep9() { mostrarPaso(9); }
function mostrarStep10() { mostrarPaso(10); }
function mostrarStep11() { mostrarPaso(11); }
function mostrarStep12() { mostrarPaso(12); }
function mostrarStep13() { mostrarPaso(13); }

function volverAtras(pasoActual) {
    mostrarPaso(pasoActual - 1);
}

// Al cargar la página, solo mostrar el primer paso
window.addEventListener('DOMContentLoaded', function() {
    mostrarPaso(1);
});

// --- REEMPLAZO mostrar/ocultar previews, loading, overlays ---
// Cuando quieras mostrar un preview, loading, etc., usa mostrarPaso(n) con el número de paso correspondiente
// Por ejemplo, para mostrar el preview resumen: mostrarPaso(11);
// Para mostrar el loading: mostrarPaso(10);
// Para mostrar el preview clásico: mostrarPaso(12);
// Para mostrar el countdown: mostrarPaso(13);

// Elimina cualquier uso de style.display = 'block' o 'none' para previews, loading, overlays, etc.

// Paso 1: Selección de género
function seleccionarGenero(elemento, genero) {
    var cards = document.getElementsByClassName('gender-card');
    for(var i = 0; i < cards.length; i++) {
        cards[i].classList.remove('selected');
    }
    elemento.classList.add('selected');
    document.getElementById('next-button').style.display = 'block';
}

// Paso 2: Selección de nivel
function seleccionarNivel(elemento) {
    var levels = document.getElementsByClassName('level-card');
    for(var i = 0; i < levels.length; i++) {
        levels[i].classList.remove('selected');
    }
    elemento.classList.add('selected');
    document.getElementById('step2-btn').disabled = false;
}

// Paso 3: Selección de objetivo
function seleccionarObjetivo(elemento) {
    var objetivos = document.getElementsByClassName('objective-card');
    for(var i = 0; i < objetivos.length; i++) {
        objetivos[i].classList.remove('selected');
    }
    elemento.classList.add('selected');
    document.getElementById('step3-btn').disabled = false;
}

// Paso 4: Selección de frecuencia
function seleccionarFrecuencia(elemento) {
    var frecuencias = document.getElementsByClassName('frequency-card');
    for(var i = 0; i < frecuencias.length; i++) {
        frecuencias[i].classList.remove('selected');
    }
    elemento.classList.add('selected');
    document.getElementById('step4-btn').disabled = false;
}

// Actualizar valores de los sliders
document.getElementById('peso').addEventListener('input', function() {
    document.getElementById('peso-valor').textContent = this.value;
});

document.getElementById('altura').addEventListener('input', function() {
    document.getElementById('altura-valor').textContent = this.value;
});

function mostrarStep6() {
    document.getElementById('step5').style.display = 'none';
    document.getElementById('step6').style.display = 'block';
}

let areasSeleccionadas = [];

function seleccionarArea(btn, todo = false) {
    if (todo) {
        document.querySelectorAll('.area-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        areasSeleccionadas = ['todo'];
    } else {
        document.querySelector('.area-btn[data-area="todo"]').classList.remove('selected');
        const area = btn.getAttribute('data-area');
        if (btn.classList.contains('selected')) {
            btn.classList.remove('selected');
            areasSeleccionadas = areasSeleccionadas.filter(a => a !== area);
        } else {
            btn.classList.add('selected');
            areasSeleccionadas.push(area);
        }
    }
    // Habilitar botón solo si hay al menos una selección
    const btnFinalizar = document.getElementById('step6-btn');
    btnFinalizar.disabled = areasSeleccionadas.length === 0;
    // Cambiar texto del botón según selección
    if (areasSeleccionadas.length === 1 && areasSeleccionadas[0] === 'todo') {
        btnFinalizar.textContent = 'Generar rutina completa';
    } else {
        btnFinalizar.textContent = 'Generar rutina personalizada';
    }
}

function finalizarWizard() {
    var genero = document.querySelector('.gender-card.selected').getAttribute('data-gender');
    var nivel = document.querySelector('.level-card.selected').getAttribute('data-level');
    var objetivo = document.querySelector('.objective-card.selected').getAttribute('data-objective');
    var frecuencia = document.querySelector('.frequency-card.selected').getAttribute('data-frequency');
    var peso = document.getElementById('peso').value;
    var altura = document.getElementById('altura').value;
    var areas = (typeof areasSeleccionadas !== 'undefined') ? areasSeleccionadas : [];

    // Ocultar wizard y mostrar animación de carga
    document.querySelector('.wizard-container').style.display = 'none';
    document.getElementById('loading-spinner').style.display = 'flex';

    // Simular carga (2.5 segundos)
    setTimeout(function() {
        document.getElementById('loading-spinner').style.display = 'none';
        mostrarPreview({genero, nivel, objetivo, frecuencia, peso, altura, areas});
    }, 2500);
}

function mostrarPreview(datos) {
    // Calcular IMC y estado
    let imc = (datos.peso / Math.pow(datos.altura/100,2)).toFixed(1);
    let estado = '';
    if(imc < 18.5) estado = 'Bajo peso';
    else if(imc < 25) estado = 'Peso normal';
    else if(imc < 30) estado = 'Sobrepeso';
    else estado = 'Obesidad';

    // Calorías estimadas (fórmula simple)
    let calorias = Math.round((datos.genero === 'male' ? 88.36 : 447.6) + (13.4 * datos.peso) + (4.8 * datos.altura) - (5.7 * 25));

    // Objetivo texto
    let objetivoTxt = '';
    if(datos.objetivo === 'perder-peso') objetivoTxt = 'Pérdida de Peso';
    else if(datos.objetivo === 'ganar-musculo') objetivoTxt = 'Ganancia de Músculo';
    else objetivoTxt = 'Mantener Forma';

    // Nivel texto
    let nivelTxt = '';
    if(datos.nivel === 'principiante') nivelTxt = 'Principiante';
    else if(datos.nivel === 'intermedio') nivelTxt = 'Intermedio';
    else nivelTxt = 'Avanzado';

    // Llenar datos para previsualización clásica
    document.getElementById('clasico-genero').textContent = datos.genero === 'male' ? 'Masculino' : 'Femenino';
    document.getElementById('clasico-peso').textContent = datos.peso;
    document.getElementById('clasico-altura').textContent = datos.altura;
    document.getElementById('clasico-imc').textContent = imc;
    document.getElementById('clasico-estado').textContent = estado;
    document.getElementById('clasico-nivel').textContent = nivelTxt;
    document.getElementById('clasico-objetivo').textContent = objetivoTxt;
    document.getElementById('clasico-calorias').textContent = calorias;

    // Áreas
    let areasHtml = '';
    if(datos.areas.includes('todo')) {
        areasHtml = '<span class="preview-tag">Todo el cuerpo</span>';
    } else {
        const nombres = {
            espalda: 'Espalda', hombro: 'Hombro', brazo: 'Brazo', pecho: 'Pecho', abdominales: 'Abdominales', gluteos: 'Glúteos', piernas: 'Piernas'
        };
        areasHtml = datos.areas.map(a => `<span class="preview-tag">${nombres[a]}</span>`).join(' ');
    }
    document.getElementById('clasico-areas').innerHTML = areasHtml;

    // Recomendaciones
    let recomendaciones = [
        'Enfócate en ejercicios compuestos con pesos pesados',
        'Mantén un superávit calórico de 300-500 calorías',
        'Consume 1.8-2.2g de proteína por kg de peso corporal',
        'Descansa adecuadamente entre series y entrenamientos',
        'Comienza con ejercicios básicos',
        'Enfócate en la técnica correcta',
        'Aumenta gradualmente la intensidad'
    ];
    document.getElementById('clasico-recomendaciones').innerHTML = recomendaciones.map(r => `<li>${r}</li>`).join('');

    // Mostrar previsualización clásica
    document.getElementById('preview-clasico').style.display = 'block';

    // Al hacer clic en Comenzar Entrenamiento, mostrar la previsualización tipo app
    document.getElementById('btn-clasico-comenzar').onclick = function() {
        document.getElementById('preview-clasico').style.display = 'none';
        mostrarPreviewApp(datos, objetivoTxt);
    };
}

function mostrarPreviewApp(datos, objetivoTxt) {
    // ... código de la previsualización tipo app (igual que antes, usando los datos recibidos) ...
    // Nombre de usuario (ejemplo, puedes usar Auth::user()->name si tienes sesión)
    let nombre = (typeof datos.nombre !== 'undefined' && datos.nombre) ? datos.nombre : 'Cristian';
    document.getElementById('prev-nombre').textContent = nombre;
    document.getElementById('plan-nombre').textContent = nombre;
    document.getElementById('plan-titulo').textContent = `Plan de ${objetivoTxt} de ${nombre}`;

    // Próximo entrenamiento (ejemplo)
    document.getElementById('next-titulo').textContent = 'Fuerza de Pecho y Tríceps';
    // Lista de ejercicios ejemplo
    const ejercicios = [
        {
            img: 'https://wger.de/media/exercise-images/14/Chest-press-1.png',
            nombre: 'Press de pecho en máquina',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho',
            musculo: 'https://i.imgur.com/1Q9Z1Zm.png',
            porcentaje: '28%'
        },
        {
            img: 'https://wger.de/media/exercise-images/15/Dips-1.png',
            nombre: 'Fondos Asistidos para Pecho',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho',
            musculo: 'https://i.imgur.com/1Q9Z1Zm.png',
            porcentaje: '20%'
        },
        {
            img: 'https://wger.de/media/exercise-images/17/Dumbbell-bench-press-1.png',
            nombre: 'Press Martillo con Mancuerna',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho',
            musculo: 'https://i.imgur.com/1Q9Z1Zm.png',
            porcentaje: '24%'
        },
        {
            img: 'https://wger.de/media/exercise-images/20/Triceps-pushdown-1.png',
            nombre: 'Pushdown con Cable',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps',
            musculo: 'https://i.imgur.com/2Q9Z1Zm.png',
            porcentaje: '40%'
        },
        {
            img: 'https://wger.de/media/exercise-images/21/Skull-crusher-1.png',
            nombre: 'Triturador de Cráneo',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps',
            musculo: 'https://i.imgur.com/2Q9Z1Zm.png',
            porcentaje: '40%'
        },
        {
            img: 'https://wger.de/media/exercise-images/22/Triceps-extension-1.png',
            nombre: 'Extensión de tríceps en máquina',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps',
            musculo: 'https://i.imgur.com/2Q9Z1Zm.png',
            porcentaje: '40%'
        }
    ];
    let ejerciciosHtml = ejercicios.map(e => `