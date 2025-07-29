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

        <div id="step2" class="wizard-step" style="display:none;">
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

        <div id="step3" class="wizard-step" style="display:none;">
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

        <div id="step4" class="wizard-step" style="display:none;">
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

        <div id="step5" class="wizard-step" style="display:none;">
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

        <div id="step6" class="wizard-step" style="display:none;">
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
    </div>
</div>

<div id="loading-spinner" class="loading-overlay" style="display:none;">
    <div class="spinner"></div>
    <div class="loading-text">Generando tu rutina personalizada...</div>
</div>

<div id="preview-resumen" class="preview-resumen" style="display:none;">
    <div class="preview-header">
        <h2>¡Hola, <span id="prev-nombre">{{ Auth::user()->nombre }}</span>! Este es tu plan personalizado</h2>
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

<script>
// Paso 1: Selección de género
function seleccionarGenero(elemento, genero) {
    var cards = document.getElementsByClassName('gender-card');
    for(var i = 0; i < cards.length; i++) {
        cards[i].classList.remove('selected');
    }
    elemento.classList.add('selected');
    document.getElementById('next-button').style.display = 'block';
}

// Nombre del cliente desde PHP
var clienteNombre = @json(Auth::user()->nombre);

function mostrarStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
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

function mostrarStep3() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'block';
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

function mostrarStep4() {
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step4').style.display = 'block';
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

function mostrarStep5() {
    document.getElementById('step4').style.display = 'none';
    document.getElementById('step5').style.display = 'block';
}

// Actualizar valores de los sliders
document.getElementById('peso').addEventListener('input', function() {
    document.getElementById('peso-valor').textContent = this.value;
});

document.getElementById('altura').addEventListener('input', function() {
    document.getElementById('altura-valor').textContent = this.value;
});

function volverAtras(pasoActual) {
    // Ocultar el paso actual
    document.getElementById('step' + pasoActual).style.display = 'none';
    
    // Mostrar el paso anterior
    document.getElementById('step' + (pasoActual - 1)).style.display = 'block';
    
    // Limpiar la selección del paso actual
    switch(pasoActual) {
        case 2:
            document.querySelectorAll('.level-card').forEach(card => card.classList.remove('selected'));
            document.getElementById('step2-btn').disabled = true;
            break;
        case 3:
            document.querySelectorAll('.objective-card').forEach(card => card.classList.remove('selected'));
            document.getElementById('step3-btn').disabled = true;
            break;
        case 4:
            document.querySelectorAll('.frequency-card').forEach(card => card.classList.remove('selected'));
            document.getElementById('step4-btn').disabled = true;
            break;
        case 5:
            document.getElementById('peso').value = 70;
            document.getElementById('altura').value = 170;
            document.getElementById('peso-valor').textContent = '70';
            document.getElementById('altura-valor').textContent = '170';
            break;
    }
}

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
    let nombre = clienteNombre;
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
        <div class="ejercicio-card">
            <img src="${e.img}" class="ej-img" alt="${e.nombre}">
            <div class="ej-info">
                <div class="ej-nombre">${e.nombre}</div>
                <div class="ej-repes">${e.repes}</div>
            </div>
            <div class="ej-musculo">
                <img src="${e.musculo}" class="ej-mus-img" alt="${e.grupo}">
                <div class="ej-mus-grupo">${e.grupo}</div>
                <div class="ej-mus-pct">${e.porcentaje}</div>
            </div>
        </div>
    `).join('');
    document.getElementById('ejercicios-lista').innerHTML = ejerciciosHtml;

    document.getElementById('preview-resumen').style.display = 'block';
}

// Guardar ejercicios global para navegación
let ejerciciosGlobal = [];
let ejercicioActual = 0;
let timerInterval = null;

// Al hacer clic en Comenzar (tipo app)
document.getElementById('btn-comenzar-entreno').onclick = function() {
    document.getElementById('preview-resumen').style.display = 'none';
    mostrarCuentaRegresiva();
};

function mostrarCuentaRegresiva() {
    document.getElementById('countdown-overlay').style.display = 'flex';
    let count = 3;
    document.getElementById('countdown-number').textContent = count;
    let interval = setInterval(function() {
        count--;
        if(count > 0) {
            document.getElementById('countdown-number').textContent = count;
        } else {
            clearInterval(interval);
            document.getElementById('countdown-overlay').style.display = 'none';
            mostrarEjercicioActivo();
        }
    }, 1000);
}

function mostrarEjercicioActivo() {
    // Usar los mismos ejercicios de la previsualización app
    ejerciciosGlobal = [
        {
            img: 'https://wger.de/media/exercise-images/14/Chest-press-1.png',
            nombre: 'Press de pecho en máquina',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho'
        },
        {
            img: 'https://wger.de/media/exercise-images/15/Dips-1.png',
            nombre: 'Fondos Asistidos para Pecho',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho'
        },
        {
            img: 'https://wger.de/media/exercise-images/17/Dumbbell-bench-press-1.png',
            nombre: 'Press Martillo con Mancuerna',
            repes: '3 series x 10 repeticiones',
            grupo: 'Pecho'
        },
        {
            img: 'https://wger.de/media/exercise-images/20/Triceps-pushdown-1.png',
            nombre: 'Pushdown con Cable',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps'
        },
        {
            img: 'https://wger.de/media/exercise-images/21/Skull-crusher-1.png',
            nombre: 'Triturador de Cráneo',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps'
        },
        {
            img: 'https://wger.de/media/exercise-images/22/Triceps-extension-1.png',
            nombre: 'Extensión de tríceps en máquina',
            repes: '3 series x 10 repeticiones',
            grupo: 'Tríceps'
        }
    ];
    ejercicioActual = 0;
    renderEjercicioActivo();
    document.getElementById('ejercicio-activo').style.display = 'block';
    iniciarTimer();
}

function renderEjercicioActivo() {
    const ej = ejerciciosGlobal[ejercicioActual];
    document.getElementById('ej-activo-img').src = ej.img;
    document.getElementById('ej-activo-nombre').textContent = ej.nombre;
    document.getElementById('ej-activo-repes').textContent = ej.repes;
    document.getElementById('ej-activo-grupo').textContent = ej.grupo;
    document.getElementById('ej-activo-num').textContent = ejercicioActual + 1;
    // Miniaturas
    let miniaturas = ejerciciosGlobal.map((e, i) => `<img src="${e.img}" class="ej-miniatura${i === ejercicioActual ? ' selected' : ''}" onclick="irAEjercicio(${i})">`).join('');
    document.getElementById('ej-activo-lista').innerHTML = miniaturas;
    // Botón siguiente
    document.getElementById('btn-ej-siguiente').style.display = (ejercicioActual < ejerciciosGlobal.length - 1) ? 'block' : 'none';
}

function siguienteEjercicio() {
    if(ejercicioActual < ejerciciosGlobal.length - 1) {
        ejercicioActual++;
        renderEjercicioActivo();
        reiniciarTimer();
    }
}
function irAEjercicio(idx) {
    ejercicioActual = idx;
    renderEjercicioActivo();
    reiniciarTimer();
}
function cerrarEjercicio() {
    document.getElementById('ejercicio-activo').style.display = 'none';
    reiniciarTimer(true);
    // Volver a mostrar la previsualización tipo app
    document.getElementById('preview-resumen').style.display = 'block';
}
function finalizarEntrenamiento() {
    alert('¡Entrenamiento finalizado!');
    cerrarEjercicio();
}
// Timer simple
function iniciarTimer() {
    let seg = 0;
    timerInterval = setInterval(function() {
        seg++;
        let min = Math.floor(seg/60);
        let s = seg%60;
        document.getElementById('ej-timer').textContent = `Tiempo: ${min.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
    }, 1000);
}
function reiniciarTimer(stop) {
    clearInterval(timerInterval);
    if(!stop) iniciarTimer();
}
</script>

<style>
/* Estilos Base */
body.with-side-menu {
    background: #1a1a2e !important;
    font-family: 'Poppins', sans-serif !important;
    color: #fff !important;
}

.gender-options, .level-options, .objective-options, .frequency-options {
    display: flex !important;
    justify-content: center !important;
    gap: 2rem !important;
    margin: 2rem 0 !important;
    flex-wrap: wrap !important;
}

.gender-card, .level-card, .objective-card, .frequency-card {
    background: rgba(42, 42, 58, 0.7) !important;
    backdrop-filter: blur(10px) !important;
    border-radius: 15px !important;
    padding: 2rem !important;
    text-align: center !important;
    cursor: pointer !important;
    transition: all 0.3s !important;
    border: 2px solid transparent !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2) !important;
    width: 250px !important;
}

.gender-card:hover, .level-card:hover, .objective-card:hover, .frequency-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3) !important;
}

.gender-card.selected, .level-card.selected, .objective-card.selected, .frequency-card.selected {
    border-color: #00ff88 !important;
    box-shadow: 0 0 20px #00ff88 !important;
    transform: scale(1.05) !important;
}

.gender-image {
    width: 120px !important;
    height: 120px !important;
    border-radius: 50% !important;
    margin-bottom: 1rem !important;
    object-fit: cover !important;
    border: 3px solid #00ff88 !important;
    transition: all 0.3s !important;
}

.gender-card:hover .gender-image {
    transform: scale(1.1) !important;
    border-color: #fff !important;
}

.gender-card.selected .gender-image {
    border-color: #00ff88 !important;
    box-shadow: 0 0 20px #00ff88 !important;
}

.gender-label, .level-title, .objective-title, .frequency-title {
    color: #00ff88 !important;
    font-size: 1.2rem !important;
    font-weight: bold !important;
    display: block !important;
    margin-bottom: 0.5rem !important;
}

.gender-description, .level-desc, .objective-desc, .frequency-desc {
    color: #fff !important;
    font-size: 0.9rem !important;
    margin-top: 0.5rem !important;
    opacity: 0.8 !important;
}

.icon {
    font-size: 2.5rem !important;
    display: block !important;
    margin-bottom: 1rem !important;
}

.wizard-buttons {
    display: flex !important;
    justify-content: center !important;
    gap: 1rem !important;
    margin-top: 2rem !important;
}

.btn-wizard {
    background: #00ff88 !important;
    color: #1a1a2e !important;
    border: none !important;
    padding: 1rem 2rem !important;
    border-radius: 10px !important;
    font-size: 1.1rem !important;
    font-weight: bold !important;
    min-width: 150px !important;
    cursor: pointer !important;
    transition: all 0.3s !important;
    box-shadow: 0 4px 15px rgba(0, 255, 136, 0.3) !important;
}

.btn-wizard:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 5px 15px rgba(0, 255, 136, 0.5) !important;
}

.btn-wizard:disabled {
    background: #aaa !important;
    color: #fff !important;
    cursor: not-allowed !important;
}

.btn-back {
    background: #2a2a3a !important;
    color: #fff !important;
    border: 2px solid #00ff88 !important;
    margin-right: 1rem !important;
}

.btn-back:hover {
    background: #3a3a4a !important;
    transform: translateY(-3px) !important;
    box-shadow: 0 5px 15px rgba(0, 255, 136, 0.2) !important;
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.gender-card, .level-card, .objective-card, .frequency-card {
    animation: fadeIn 0.5s ease-out forwards;
}

#next-button, #step2-btn, #step3-btn, #step4-btn {
    animation: fadeIn 0.5s ease-out forwards;
}

.measurements-container {
    display: flex !important;
    flex-direction: column !important;
    gap: 3rem !important;
    max-width: 600px !important;
    margin: 2rem auto !important;
    padding: 2rem !important;
    background: rgba(42, 42, 58, 0.7) !important;
    backdrop-filter: blur(10px) !important;
    border-radius: 15px !important;
    border: 2px solid #00ff88 !important;
}

.measurement-group {
    display: flex !important;
    flex-direction: column !important;
    gap: 1rem !important;
}

.measurement-group label {
    color: #00ff88 !important;
    font-size: 1.2rem !important;
    font-weight: bold !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
}

.measurement-slider {
    -webkit-appearance: none !important;
    width: 100% !important;
    height: 8px !important;
    border-radius: 4px !important;
    background: rgba(255, 255, 255, 0.1) !important;
    outline: none !important;
    margin: 1rem 0 !important;
}

.measurement-slider::-webkit-slider-thumb {
    -webkit-appearance: none !important;
    appearance: none !important;
    width: 24px !important;
    height: 24px !important;
    border-radius: 50% !important;
    background: #00ff88 !important;
    cursor: pointer !important;
    box-shadow: 0 0 10px rgba(0, 255, 136, 0.5) !important;
    transition: all 0.3s !important;
}

.measurement-slider::-webkit-slider-thumb:hover {
    transform: scale(1.2) !important;
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.7) !important;
}

.slider-marks {
    display: flex !important;
    justify-content: space-between !important;
    padding: 0 12px !important;
    color: #fff !important;
    font-size: 0.9rem !important;
    opacity: 0.8 !important;
}

.measurement-desc {
    color: #fff !important;
    font-size: 0.9rem !important;
    opacity: 0.8 !important;
    margin-top: 0.5rem !important;
    text-align: center !important;
}

.areas-container {
    display: flex !important;
    flex-direction: column !important;
    gap: 2rem !important;
    align-items: center !important;
    margin: 2rem 0 !important;
}

.areas-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr;
    gap: 1rem !important;
    width: 100% !important;
    max-width: 600px !important;
}

.area-btn {
    background: #00aaff !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 1rem 0.5rem 0.5rem 0.5rem !important;
    font-size: 1.2rem !important;
    font-weight: bold !important;
    width: 100% !important;
    margin-bottom: 0.5rem !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    min-height: 90px !important;
}

.area-btn.selected {
    background: #00ff88 !important;
    color: #1a1a2e !important;
    box-shadow: 0 0 15px #00ff88 !important;
}

.area-btn:active {
    transform: scale(0.98) !important;
}

.area-icon {
    font-size: 2rem !important;
    margin-bottom: 0.2rem !important;
}

.area-title {
    font-size: 1.1rem !important;
    font-weight: bold !important;
    margin-bottom: 0.1rem !important;
}

.area-desc {
    font-size: 0.9rem !important;
    color: #fff !important;
    opacity: 0.8 !important;
    text-align: center !important;
    font-weight: normal !important;
}

.loading-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(30,30,40,0.85);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.spinner {
    border: 8px solid #222;
    border-top: 8px solid #00ff88;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    animation: spin 1s linear infinite;
    margin-bottom: 2rem;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.loading-text {
    color: #fff;
    font-size: 1.3rem;
    font-weight: bold;
    letter-spacing: 1px;
    text-align: center;
}

.preview-resumen {
    max-width: 900px;
    margin: 2rem auto;
    background: #232323;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    padding: 2.5rem 2rem;
    color: #fff;
    display: block;
    animation: fadeIn 0.7s;
}
.preview-header {
    text-align: center;
    margin-bottom: 1.5rem;
}
.preview-header h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #3b82f6;
    margin-bottom: 0.5rem;
}
.preview-plan-activo {
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 16px;
    padding: 1.2rem 1.5rem;
    margin-bottom: 1.5rem;
    gap: 1.2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
}
.plan-icon {
    font-size: 2.2rem;
    color: #3b82f6;
    margin-right: 0.7rem;
}
.plan-label {
    color: #64748b;
    font-size: 1rem;
    opacity: 0.8;
}
.plan-title {
    color: #1e293b;
    font-size: 1.2rem;
    font-weight: bold;
}
.plan-btn {
    margin-left: auto;
    background: #3b82f6;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1rem;
    padding: 0.5rem 1.2rem;
    cursor: pointer;
    transition: all 0.2s;
}
.plan-btn:hover {
    background: #2563eb;
}
.preview-next-block {
    background: #f8fafc;
    border-radius: 14px;
    padding: 1.2rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
}
.next-label {
    color: #64748b;
    font-size: 1rem;
    opacity: 0.8;
    margin-bottom: 0.3rem;
}
.next-title {
    color: #3b82f6;
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 1.2rem;
}
.ejercicios-lista {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}
.ejercicio-card {
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 10px;
    padding: 0.7rem 1rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    gap: 1.1rem;
    border: 1px solid #e2e8f0;
}
.ej-img {
    width: 54px;
    height: 54px;
    border-radius: 8px;
    object-fit: cover;
    background: #fff;
}
.ej-info {
    flex: 1;
}
.ej-nombre {
    color: #1e293b;
    font-size: 1.1rem;
    font-weight: bold;
}
.ej-repes {
    color: #64748b;
    font-size: 0.98rem;
}
.ej-musculo {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 60px;
}
.ej-mus-img {
    width: 32px;
    height: 32px;
    object-fit: contain;
    margin-bottom: 0.2rem;
}
.ej-mus-grupo {
    color: #fff;
    font-size: 0.95rem;
    font-weight: bold;
}
.ej-mus-pct {
    color: #b48cff;
    font-size: 0.95rem;
    font-weight: bold;
}
.btn-preview {
    background: #00c46a !important;
    color: #fff !important;
    font-size: 1.2rem !important;
    font-weight: bold !important;
    border-radius: 10px !important;
    padding: 1rem 2.5rem !important;
    margin: 2rem auto 0 auto;
    display: block;
    box-shadow: 0 4px 15px rgba(0, 255, 136, 0.2) !important;
    transition: all 0.3s !important;
    letter-spacing: 1px;
}
.btn-preview .btn-icon {
    font-size: 1.3rem;
    margin-right: 0.7rem;
    vertical-align: middle;
}
.btn-preview:hover {
    background: #00ff88 !important;
    color: #232323 !important;
    transform: translateY(-2px) scale(1.04) !important;
}

.preview-clasico {
    max-width: 900px;
    margin: 2rem auto;
    background: #232323;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    padding: 2.5rem 2rem;
    color: #fff;
    display: block;
    animation: fadeIn 0.7s;
}
.preview-flex {
    display: flex;
    justify-content: space-between;
    gap: 2rem;
}
.preview-card {
    flex: 1;
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
}
.preview-list {
    list-style: none;
    padding: 0;
}
.preview-list li {
    margin-bottom: 0.5rem;
}
.preview-areas {
    margin-top: 2rem;
    margin-bottom: 2rem;
}
.preview-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.preview-recomendaciones {
    margin-bottom: 2rem;
}
.preview-reco-list {
    list-style: none;
    padding: 0;
}
.preview-reco-list li {
    margin-bottom: 0.5rem;
}

.countdown-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(30,30,40,0.95);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.countdown-number {
    font-size: 8rem;
    color: #00ff88;
    font-weight: bold;
    animation: countdownPop 1s linear;
}
@keyframes countdownPop {
    0% { transform: scale(0.7); opacity: 0.5; }
    60% { transform: scale(1.2); opacity: 1; }
    100% { transform: scale(1); opacity: 1; }
}

.ejercicio-activo {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: #f8fafc;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding-top: 2rem;
    animation: fadeIn 0.5s;
}
.ej-activo-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem 1rem 2rem;
}
.ej-cerrar, .ej-finalizar {
    background: none;
    border: none;
    color: #fff;
    font-size: 2rem;
    cursor: pointer;
    font-weight: bold;
    transition: color 0.2s;
}
.ej-finalizar {
    font-size: 1.1rem;
    background: #3b82f6;
    color: #ffffff;
    border-radius: 8px;
    padding: 0.5rem 1.2rem;
    margin-left: 1rem;
}
.ej-finalizar:hover {
    background: #2563eb;
}
.ej-timer {
    color: #1e293b;
    font-size: 1.1rem;
    font-weight: bold;
}
.ej-activo-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
}
.ej-activo-lista {
    display: flex;
    flex-direction: column;
    position: absolute;
    right: 2rem;
    top: 6rem;
    gap: 0.7rem;
}
.ej-miniatura {
    width: 54px;
    height: 54px;
    border-radius: 8px;
    object-fit: cover;
    background: #fff;
    border: 2px solid transparent;
    cursor: pointer;
    margin-bottom: 0.2rem;
    transition: border 0.2s;
}
.ej-miniatura.selected {
    border: 2px solid #00ff88;
}
.ej-activo-num {
    font-size: 5rem;
    color: #1e293b;
    font-weight: bold;
    margin: 2rem 0 1rem 0;
}
.ej-activo-img {
    width: 160px;
    height: 160px;
    border-radius: 16px;
    object-fit: cover;
    background: #fff;
    margin-bottom: 1.2rem;
}
.ej-activo-nombre {
    color: #3b82f6;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-align: center;
}
.ej-activo-repes {
    color: #1e293b;
    font-size: 1.1rem;
    margin-bottom: 0.3rem;
    text-align: center;
}
.ej-activo-grupo {
    color: #8b5cf6;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    text-align: center;
}
.btn-ej-siguiente {
    background: #00c46a !important;
    color: #fff !important;
    font-size: 1.1rem !important;
    font-weight: bold !important;
    border-radius: 10px !important;
    padding: 0.8rem 2rem !important;
    margin: 1.5rem auto 0 auto;
    display: block;
    box-shadow: 0 4px 15px rgba(0, 255, 136, 0.2) !important;
    transition: all 0.3s !important;
    letter-spacing: 1px;
}
.btn-ej-siguiente:hover {
    background: #3b82f6 !important;
    color: #ffffff !important;
    transform: translateY(-2px) scale(1.04) !important;
}
</style>
@endsection