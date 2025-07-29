<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gym App - Login</title>
    <link rel="shortcut icon" href="https://tresplazas.com/web/img/big_punto_de_venta.png">
    
    <!-- TailwindCSS -->
    <link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #4B0082 0%, #800080 50%, #00008B 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
        }
        
        .logo-circle i {
            color: white;
            font-size: 32px;
        }
        
        .title {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: #666;
            font-size: 14px;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            color: #333;
            background: white;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }
        
        .form-input::placeholder {
            color: #999;
        }
        
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #FFD700;
            font-size: 18px;
        }
        
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #FFD700;
        }
        
        .forgot-link {
            text-align: center;
            margin: 20px 0;
        }
        
        .forgot-link a {
            color: #FFD700;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-link a:hover {
            color: #FFA500;
        }
        
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            border-radius: 12px;
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .warning-message {
            background: #fffbeb;
            border: 1px solid #fed7aa;
            color: #d97706;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .warning-message i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container animate-fade-in">
        <!-- Logo y Título -->
        <div class="logo-section">
            <div class="logo-circle">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h1 class="title">SATURN GYM</h1>
            <p class="subtitle">Fitness & Wellness</p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Mensajes de Error/Success -->
            @if (session('mensaje'))
                <div class="warning-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('mensaje') }}</span>
                </div>
            @endif

            @error('usuario')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first('usuario') }}</span>
                </div>
            @enderror

            @error('password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first('password') }}</span>
                </div>
            @enderror

            @error('tipo')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first('tipo') }}</span>
                </div>
            @enderror

            <!-- Campo Usuario -->
            <div class="form-group">
                <label for="usuario" class="form-label">Usuario</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        id="usuario" 
                        type="text" 
                        name="usuario" 
                        value="{{ old('usuario') }}"
                        class="form-input"
                        placeholder="Ingresa tu usuario"
                        autocomplete="username"
                        required
                    >
                </div>
            </div>

            <!-- Campo Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        id="password" 
                        type="password" 
                        name="password"
                        class="form-input"
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                        required
                    >
                    <button 
                        type="button" 
                        id="togglePassword"
                        class="password-toggle"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Enlace Olvidé Contraseña -->
            <div class="forgot-link">
                <a href="{{ route('recuperar.index') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <!-- Botón de Login -->
            <button 
                type="submit" 
                name="btningresar"
                class="login-btn"
            >
                <i class="fas fa-sign-in-alt mr-2"></i>
                INICIAR SESIÓN
            </button>
        </form>

        <!-- Footer -->
        <div class="footer">
            <p>© 2025 Gym App. Todos los derechos reservados.</p>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Auto-focus en el primer campo
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('usuario').focus();
        });
    </script>
</body>
</html>
