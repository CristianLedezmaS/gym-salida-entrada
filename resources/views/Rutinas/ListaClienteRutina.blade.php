@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center display-4 text-uppercase mb-4" style="color: #e94560; font-weight: 800;">Generar Rutina</h1>
    
    <div class="card shadow-lg p-4" style="background-color: #1e1e2d; border: none; border-radius: 15px;">
        <form id="generate-routine-form" class="form-group">
            <div class="mb-3">
                <label for="goal" class="form-label" style="color: #f7f7f7; font-size: 1.2rem;">Objetivo:</label>
                <select id="goal" name="goal" class="form-select form-select-lg" style="background-color: #2c2c3b; color: #f7f7f7; border: none;">
                    <option value="fuerza">Fuerza</option>
                    <option value="resistencia">Resistencia</option>
                    <option value="pérdida de peso">Pérdida de peso</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="difficulty" class="form-label" style="color: #f7f7f7; font-size: 1.2rem;">Dificultad:</label>
                <select id="difficulty" name="difficulty" class="form-select form-select-lg" style="background-color: #2c2c3b; color: #f7f7f7; border: none;">
                    <option value="easy">Fácil</option>
                    <option value="medium">Medio</option>
                    <option value="hard">Difícil</option>
                </select>
            </div>
            <button type="submit" class="btn btn-lg btn-block" style="background-color: #e94560; color: #fff; font-weight: 700; letter-spacing: 1px; border-radius: 50px;">Generar Rutina</button>
        </form>
    </div>

    <div id="routine-display" class="mt-5 p-4 text-light" style="background-color: #28293e; border-radius: 15px; display: none;">
        <!-- Aquí se mostrará la rutina generada con imágenes -->
    </div>
</div>

<script>
    document.getElementById('generate-routine-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Previene el envío normal del formulario
        const goal = document.getElementById('goal').value;
        const difficulty = document.getElementById('difficulty').value;

        fetch("{{ route('rutinas.generate') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ goal, difficulty })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('routine-display').style.display = 'block';
            document.getElementById('routine-display').innerHTML = `
                <h3 class="text-uppercase" style="color: #f7f7f7;">${data.name}</h3>
                <p class="text-muted">${data.description}</p>
                <p class="text-warning">Dificultad: ${data.difficulty}</p>
                <ul class="list-unstyled">
                    ${data.exercises.map(exercise => `
                        <li class="mb-4" style="color: #f7f7f7;">
                            <img src="/images/exercises/${exercise.name.toLowerCase().replace(' ', '_')}.gif" 
                                alt="${exercise.name}" 
                                style="width: 100px; height: 100px; margin-right: 10px; float: left;">
                            <span>${exercise.name} - ${exercise.sets} series x ${exercise.reps} repeticiones</span>
                        </li>
                    `).join('')}
                </ul>
                <div style="clear: both;"></div>
            `;
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection