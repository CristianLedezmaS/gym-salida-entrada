@extends('layouts/app')
@section('titulo', 'Registrar Usuario')

@section('content')

<style>
    .form-container {
        background-color: #000; /* Fondo negro */
        color: #fff; /* Texto blanco */
        padding: 20px; /* Espaciado interno */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Sombra suave */
    }
    .custom-bg {
        background: rgb(236, 236, 236);
    }
    .form-label {
        font-weight: bold;
    }
    .input__text, .input__select {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        font-size: 1rem;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }
    .input__text:focus, .input__select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }
    .error__text {
        color: #dc3545;
        font-size: 0.875rem;
    }
    .btn-custom {
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 1rem;
    }
    .btn-secondary-custom {
        background-color: #6c757d;
        color: #fff;
    }
    .btn-primary-custom {
        background-color: #007bff;
        color: #fff;
    }
    .btn-custom:hover {
        opacity: 0.9;
    }

    /* Estilos para el Step Progress */
    .step-progress {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .step-progress::before {
        content: '';
        background-color: #e0e0e0;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        z-index: 1;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 50px;
    }

    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        border: 3px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .step-text {
        font-size: 12px;
        color: #666;
        text-align: center;
    }

    .progress-step.active .step-circle {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .progress-step.active .step-text {
       color:#007bff; 
       font-weight:bold; 
   }

   .progress-step.completed .step-circle {
       background-color:#28a745; 
       border-color:#28a745; 
       color:white; 
   }

   .progress-step.completed .step-text { 
       color:#28a745; 
   }

   .progress-line { 
       flex :1; 
       height :4 px; 
       background-color :#e0e0e0; 
       margin :0 px 10 px; 
   }

   .progress-line.active { 
       background-color :#007bff; 
   }
</style>

{{-- Notificaciones --}}
@if (session('CORRECTO'))
<script>
$(function notificacion() {
    new PNotify({
         title:"CORRECTO",
         type:"success",
         text:"{{ session('CORRECTO') }}",
         styling:"bootstrap3"
     });
});
</script>
@endif

@if (session('INCORRECTO'))
<script>
$(function notificacion() {
     new PNotify({
         title:"INCORRECTO",
         type:"error",
         text:"{{ session('INCORRECTO') }}",
         styling:"bootstrap3"
     });
});
</script>
@endif

@if (session('AVISO'))
<script>
$(function notificacion() {
     new PNotify({
         title:"AVISO",
         type:"error",
         text:"{{ session('AVISO') }}",
         styling:"bootstrap3"
     });
});
</script>
@endif

<h4 class="text-center text-secondary">REGISTRO DE CLIENTES</h4>

<!-- Step Progress Bar -->
<div class="step-progress">
   <div class="progress-step active" id="step-indicator-1">
       <div class="step-circle">1</div>
       <div class="step-text">Datos del Cliente</div>
   </div>
   <div class="progress-step" id="step-indicator-2">
       <div class="step-circle">2</div>
       <div class="step-text">Datos del Usuario</div>
   </div>
   <div class="progress-step" id="step-indicator-3">
       <div class="step-circle">3</div>
       <div class="step-text">Datos de Pagos</div>
   </div>
</div>

<form action="{{ route('clientes.store') }}" method="POST">
@csrf
<!-- Paso 1 -->
<div id="step-1" class="step">
   <div class="mb-0 col-12 bg-white p-5">
       <h5>Datos del Cliente</h5>
       <div class="row">
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombres y Apellidos *" value="{{ old('nombre') }}">
               @error('nombre')
                   <small class="error error__text">{{ $message }}</small>
               @enderror
           </div>
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="number" name="dni" class="input input__text" id="dni" placeholder="Documento *" value="{{ old('dni') }}">
               @error('dni')
                   <small class="error error__text">{{ $message }}</small>
               @enderror
           </div>
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="email" name="correo" class="input input__text" placeholder="Correo *" value="{{ old('correo') }}">
               @error('correo')
                   <small class="error error__text">{{ $message }}</small>
               @enderror
           </div>
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="text" name="telefono" class="input input__text" placeholder="Teléfono" value="{{ old('telefono') }}">
           </div>
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="text" name="direccion" class="input input__text" placeholder="Dirección" value="{{ old('direccion') }}">
           </div>

           <div class="col-12 text-right">
               <button type="button" class="btn btn-primary-custom btn-custom" onclick="nextStep(2)">Siguiente</button>
           </div>
       </div>
   </div>
</div>

<!-- Paso 2 -->
<div id="step-2" class="step" style="display:none;">
   <div class="mb-0 col-12 bg-white p-5">
       <h5>Datos del Usuario</h5>
       <div class="row">
           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="text" name="usuario" class="input input__text" placeholder="Usuario *" value="{{ old('usuario') }}">
               @error('usuario')
                   <small class="error error__text">{{ $message }}</small>
               @enderror
           </div>

           <div class="fl-flex-label mb-4 col-12 col-lg-6">
               <input type="password" name="password" class="input input__text" placeholder="Contraseña *">
               @error('password')
                   <small class="error error__text">{{ $message }}</small>
               @enderror
           </div>

           <!-- Botones -->
           <div class="col-12 text-right">
               <button type="button" class="btn btn-secondary-custom btn-custom" onclick="prevStep(1)">Anterior</button>
               <button type="button" class="btn btn-primary-custom btn-custom" onclick="nextStep(3)">Siguiente</button>
           </div>
       </div>
   </div>
</div>

<!-- Paso 3 -->
<!-- Paso 3: Registro de Pagos -->
<div id="step-3" class="step" style="display:none;">
    <div class="mb-0 col-12 bg-white p-5">
        <h5>Datos de Pagos</h5>
        <div class="row">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Membresía</label>
                <select class="input input__select" name="membresia" id="membresia" onchange="consultar()">
                    <option value="">Seleccionar Membresía</option>
                    @foreach ($membresia as $item)
                        <option {{ old('membresia') == $item->id_membresia ? 'selected' : '' }} value="{{ $item->id_membresia }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
                @error('membresia')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Precio</label>
                <input type="text" name="precio" class="input input__text block" value="{{ old('precio', 0) }}" id="precio" readonly>
                @error('precio')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Desde</label>
                <input type="date" name="desde" class="input input__text" value="{{ old('desde') }}" id="desde">
                @error('desde')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Hasta</label>
                <input type="date" name="hasta" class="input input__text block" value="{{ old('hasta') }}" id="hasta" readonly>
                @error('hasta')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>A cuenta (Ingrese el monto del adelanto)</label>
                <input type="number" step="0.5" name="acuenta" class="input input__text" id="acuenta" value="{{ old('acuenta') }}">
                @error('acuenta')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>N° de entradas (Recuerda los días domingo no cuenta)</label>
                <input type="number" name="dias" class="input input__text block" value="{{ old('dias', 0) }}" id="dias" readonly>
                @error('dias')
                    <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Subir imagen</label>
                <input type="file" name="foto" class="input form-control-file input__text">
            </div>

            <!-- Botón para volver al paso anterior o finalizar -->
            <div class="col-12 text-right">
                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Anterior</button>
                <button type="submit" class="btn btn-success">Registrar Cliente</button>
            </div>
        </div>
    </div>
</div>


</form>

<script>
        function consultar() {
            let membresia = document.getElementById("membresia").value
            let desde = document.getElementById("desde").value
            console.log(desde)


            var ruta = "{{ url('consultar/registro/cliente') }}/" + membresia + "/" + desde + "";
            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    document.getElementById("hasta").value = data.respuesta
                    document.getElementById("dias").value = data.dias
                    document.getElementById("precio").value = data.precio
                    document.getElementById("acuenta").value = "0"
                },
                error: function(data) {

                }
            })
        }


        let membresia = document.getElementById("membresia")
        let desde = document.getElementById("desde")
        valorDesde = desde.value = new Date().toISOString().slice(0, 10);
        membresia.addEventListener("change", consultar)
        desde.addEventListener("change", consultar)


        //hacer una funcion que calcule que el valor del input a cuenta no sea mayor al precio
        let acuenta = document.getElementById("acuenta")
        acuenta.addEventListener("change", function() {
            let precio = parseInt(document.getElementById("precio").value)
            if (acuenta.value > precio) {
                acuenta.value = precio
            }
        })
// Manejo de pasos
function nextStep(step) {
    document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
    document.getElementById('step-' + step).style.display = 'block';
    
    updateStepIndicators(step);
}

function prevStep(step) {
    document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
    document.getElementById('step-' + step).style.display = 'block';
    
    updateStepIndicators(step);
}

function consultar() {
    let membresia = document.getElementById("membresia").value
    let desde = document.getElementById("desde").value

    var ruta = "{{ url('consultar/registro/cliente') }}/"+ membresia + "/" + desde +"";
    
    $.ajax({
         url:ruta,
         type:"get",
         success:function(data) {
             document.getElementById("hasta").value = data.respuesta
             document.getElementById("dias").value = data.dias
             document.getElementById("precio").value = data.precio
             document.getElementById("acuenta").value = "0"
         },
         error:function(data) {}
     })
}

function updateStepIndicators(currentStep) {
     document.querySelectorAll('.progress-step').forEach((indicator, index) => {
         const stepNumber = index + 1;

         if (stepNumber < currentStep) {
             indicator.classList.add('completed');
             indicator.classList.remove('active');
         } else if (stepNumber === currentStep) {
             indicator.classList.add('active');
             indicator.classList.remove('completed');
         } else {
             indicator.classList.remove('completed', 'active');
         }
     });
}

document.addEventListener('DOMContentLoaded', function() {
     const firstStep = document.getElementById('step-1');
     if (firstStep) firstStep.style.display = 'block';
     
     updateStepIndicators(1);
});

</script>

@endsection