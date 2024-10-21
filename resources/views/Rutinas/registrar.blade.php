@extends('layouts.app')

@section('content')
<div class="container text-center" style="background-color: black; padding: 20px; border-radius: 10px;">
    <h2 class="mt-5 mb-4" style="font-family: 'Arial', sans-serif; font-size: 28px; color: #fff;"></h2>

    <!-- Formulario para seleccionar género -->
    <form action="{{ route('seleccionar.areas') }}" method="POST">
        @csrf

        @if(!isset($genero))
        <div class="row justify-content-center mt-4">
    <div class="col-6">
        <label for="hombre" class="gender-option" onclick="selectGender('hombre')">
            <input type="radio" name="genero" value="hombre" id="hombre" style="display:none;">
            <img src="images/hombre.png" alt="Hombre" width="150" height="150" style="border-radius: 50%;">
            <p class="gender-label" style="font-family: 'Arial', sans-serif; font-size: 20px; color: #007bff;">Hombre</p>
        </label>
    </div>
    <div class="col-6">
        <label for="mujer" class="gender-option" onclick="selectGender('mujer')">
            <input type="radio" name="genero" value="mujer" id="mujer" style="display:none;">
            <img src="images/mujer.png" alt="Mujer" width="150" height="150" style="border-radius: 50%;">
            <p class="gender-label" style="font-family: 'Arial', sans-serif; font-size: 20px; color: #dc3545;">Mujer</p>
        </label>
    </div>
</div>

            <button type="submit" id="confirm-button" class="btn btn-success mt-4 w-100" disabled>
                Confirmar
            </button>
    
        @else
            <div class="mt-5">
                <h4 style="font-family: 'Arial', sans-serif; font-size: 24px; color: #fff;">
                    Selecciona las áreas que deseas trabajar (Género: {{ ucfirst($genero) }})
                </h4>
                <div class="row mt-4 text-center">
                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-primary w-100" id="selectAll">TODO EL CUERPO</button>
                    </div>
                    @foreach(['espalda', 'hombro', 'brazo', 'pecho', 'abdominales', 'gluteos', 'piernas'] as $part)
                        <div class="col-6 mb-2">
                            <button type="button" class="btn btn-outline-secondary body-part w-100" data-part="{{ $part }}">{{ ucfirst($part) }}</button>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-4 justify-content-center">
                    <div class="col-auto">
                        <svg width="200" height="400" viewBox="0 0 200 400" id="bodySiluetaFront">
                            <path id="silueta-front" d="M100 20 C120 20 130 40 130 60 C130 80 120 100 120 120 
                                    C120 140 130 160 130 180 C130 200 120 220 110 240 L110 300 
                                    C110 320 105 340 100 360 C95 340 90 320 90 300 L90 240 
                                    C80 220 70 200 70 180 C70 160 80 140 80 120 C80 100 70 80 70 60 
                                    C70 40 80 20 100 20" fill="#e2e8f0"></path>
                            <path id="pecho-front" d="M80 80 Q100 90 120 80" stroke="#e2e8f0" stroke-width="15" fill="none"></path>
                            <path id="abdominales-front" d="M90 120 Q100 125 110 120 L110 180 Q100 185 90 180 Z" fill="#e2e8f0"></path>
                            <path id="brazo-front" d="M50 90 Q45 140 50 190 M150 90 Q155 140 150 190" stroke="#e2e8f0" stroke-width="20" fill="none"></path>
                            <path id="piernas-front" d="M90 260 L90 380 M110 260 L110 380" stroke="#e2e8f0" stroke-width="20" fill="none"></path>
                        </svg>
                    </div>
                    <div class="col-auto">
                        <svg width="200" height="400" viewBox="0 0 200 400" id="bodySiluetaBack">
                            <path id="silueta-back" d="M100 20 C120 20 130 40 130 60 C130 80 120 100 120 120 
                                    C120 140 130 160 130 180 C130 200 120 220 110 240 L110 300 
                                    C110 320 105 340 100 360 C95 340 90 320 90 300 L90 240 
                                    C80 220 70 200 70 180 C70 160 80 140 80 120 C80 100 70 80 70 60 
                                    C70 40 80 20 100 20" fill="#e2e8f0"></path>
                            <path id="espalda-back" d="M75 100 L75 160 M125 100 L125 160" stroke="#e2e8f0" stroke-width="5"></path>
                            <path id="hombro-back" d="M70 60 Q60 70 50 90 M130 60 Q140 70 150 90" stroke="#e2e8f0" stroke-width="10" fill="none"></path>
                            <path id="gluteos-back" d="M90 240 Q100 250 110 240" stroke="#e2e8f0" stroke-width="20" fill="none"></path>
                            <path id="brazo-back" d="M50 90 Q45 140 50 190 M150 90 Q155 140 150 190" stroke="#e2e8f0" stroke-width="20" fill="none"></path>
                            <path id="piernas-back" d="M90 260 L90 380 M110 260 L110 380" stroke="#e2e8f0" stroke-width="20" fill="none"></path>
                        </svg>
                    </div>
                </div>

                <input type="hidden" name="selected_areas" id="selected-areas">
                <button type="button" class="btn btn-success mt-4 w-100" onclick="mostrarFormularioFitness()">Siguiente</button>

                
            </div>
        @endif
    </form>
    <!-- Formulario de Fitness (Oculto inicialmente) -->
    <div id="fitness-form" class="mt-5" style="display: none;">
        <h2 class="mt-5 mb-4 text-white" style="font-family: 'Arial', sans-serif; font-size: 28px;">Cuéntanos más sobre ti</h2>
        <p class="text-white">Déjenos conocerle mejor para potenciar los resultados de su entrenamiento</p>

        <form action="{{ route('submit.fitness.form') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <label for="peso" class="text-white">Peso (kg)</label>
                <div class="value-display" id="peso-display">75.0</div>
                <div class="slider-container">
                    <input type="range" id="peso" name="peso" min="30" max="200" value="75" step="0.1" class="slider" oninput="updateDisplay('peso')">
                </div>
                <div class="slider-marks">
                    <span class="text-white">30</span>
                    <span class="text-white">100</span>
                    <span class="text-white">200</span>
                </div>
            </div>

            <div class="input-group mb-3">
                <label for="altura" class="text-white">Altura (cm)</label>
                <div class="value-display" id="altura-display">175.0</div>
                <div class="slider-container">
                    <input type="range" id="altura" name="altura" min="100" max="220" value="175" step="0.1" class="slider" oninput="updateDisplay('altura')">
                </div>
                <div class="slider-marks">
                    <span class="text-white">100</span>
                    <span class="text-white">160</span>
                    <span class="text-white">220</span>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-4 w-100">siguiente</button>
        </form>
    </div>

</div>

<style>
    .gender-option {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 10px;
        transition: transform 0.3s;
        display: inline-block;
        text-align: center;
        margin-bottom: 15px;
        cursor: pointer;
    }
    .gender-option.selected {
        border-color: #28a745;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
    }
    .gender-svg, .area-svg {
        width: 100%;
        max-width: 150px;
        height: auto;
        transition: transform 0.3s;
    }
    .gender-svg:hover, .area-svg:hover {
        transform: scale(1.1);
    }
    .gender-label {
        font-weight: bold;
        margin-top: 5px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        width: 100%;
        margin-bottom: 15px;
    }
    .body-part.selected {
        background-color: #007bff;
        color: white;
    }
</style>

<script>
    function selectGender(gender) {
        document.getElementById('confirm-button').disabled = false;
        document.querySelectorAll('.gender-option').forEach(option => option.classList.remove('selected'));
        document.querySelector(`label[for=${gender}]`).parentElement.classList.add('selected');
    }

    const bodyParts = ['espalda', 'hombro', 'brazo', 'pecho', 'abdominales', 'gluteos', 'piernas'];
    const selectedAreasInput = document.getElementById('selected-areas');

    document.querySelectorAll('.body-part').forEach(button => {
        button.addEventListener('click', function() {
            toggleSelectedArea(button.dataset.part);
            button.classList.toggle('selected');
        });
    });

    document.getElementById('selectAll').addEventListener('click', function() {
        const allSelected = bodyParts.every(part => document.querySelector(`.body-part[data-part="${part}"]`).classList.contains('selected'));
        bodyParts.forEach(part => {
            const button = document.querySelector(`.body-part[data-part="${part}"]`);
            if (allSelected) {
                button.classList.remove('selected');
            } else {
                button.classList.add('selected');
            }
            toggleSelectedArea(part, !allSelected);
        });
        this.classList.toggle('selected', !allSelected);
    });

    function toggleSelectedArea(area, forceState = null) {
        let selectedAreas = selectedAreasInput.value ? selectedAreasInput.value.split(',') : [];
        const isSelected = forceState !== null ? forceState : !selectedAreas.includes(area);

        if (isSelected) {
            if (!selectedAreas.includes(area)) {
                selectedAreas.push(area);
            }
        } else {
            const index = selectedAreas.indexOf(area);
            if (index > -1) {
                selectedAreas.splice(index, 1);
            }
        }

        changeAreaColor(area, isSelected);
        selectedAreasInput.value = selectedAreas.join(',');

        // Update the "TODO EL CUERPO" button
        const selectAllButton = document.getElementById('selectAll');
        selectAllButton.classList.toggle('selected', selectedAreas.length === bodyParts.length);
    }

    function changeAreaColor(area, isSelected) {
        const color = isSelected ? '#28a745' : '#e2e8f0';
        ['front', 'back'].forEach(view => {
            const element = document.getElementById(`${area}-${view}`);
            if (element) {
                if (element.hasAttribute('fill') && element.getAttribute('fill') !== 'none') {
                    element.style.fill = color;
                }
                if (element.hasAttribute('stroke')) {
                    element.style.stroke = color;
                }
            }
        });
    }
    // Mostrar el formulario de fitness
    function mostrarFormularioFitness() {
        document.getElementById('fitness-form').style.display = 'block';
        document.querySelector('form[action="{{ route('seleccionar.areas') }}"]').style.display = 'none';
    }
    function updateDisplay(id) {
        document.getElementById(`${id}-display`).textContent = document.getElementById(id).value;
    }
    // Habilitar el botón de confirmar solo si se ha seleccionado un género
    function selectGender(gender) {
        document.querySelector(`#${gender}`).checked = true;
        document.getElementById('confirm-button').disabled = false;
    }

</script>
@endsection

