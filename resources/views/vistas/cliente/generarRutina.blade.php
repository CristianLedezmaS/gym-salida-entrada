@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wizard-container">
        <!-- Copiado y adaptado de registrar.blade.php del admin -->
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
        <!-- ... resto de los pasos y scripts igual que en registrar.blade.php ... -->
    </div>
    <!-- ... resto de la estructura, loading, preview, estilos y scripts ... -->
</div>
@endsection 