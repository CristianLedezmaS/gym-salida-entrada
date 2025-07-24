<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('bootstrap4/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('inicio/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <title>login</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000; /* Fondo negro para la página */
        }

        .login-content {
            background: #333; /* Fondo oscuro para el formulario */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2); /* Sombra clara para el formulario */
            width: 100%;
            max-width: 400px;
            color: #fff; /* Texto blanco */
        }

        .login-content img {
            display: block;
            margin: 0 auto 1rem;
        }

        .login-content .title {
            text-align: center;
            margin-bottom: 1rem;
            color: #f0f0f0; /* Color de texto de título */
        }

        .login-content .input-div {
            margin-bottom: 1rem;
        }

        .login-content .input-div .div {
            margin-left: 1rem;
        }

        .login-content .input-div input {
            width: 100%;
            padding: 0.75rem;
            background-color: #222; /* Fondo oscuro para los campos de entrada */
            color: #fff; /* Color de texto blanco */
            border: 1px solid #444; /* Borde gris oscuro */
            border-radius: 4px;
            box-sizing: border-box; /* Asegura que el padding no afecte al ancho */
        }

        .login-content .input-div input:focus {
            outline: none;
            border-color: #2a5298; /* Color de borde en foco */
            background-color: #333; /* Fondo ligeramente más claro en foco */
        }

        .login-content .input-div input[type="password"] {
            font-family: 'Poppins', sans-serif; /* Fuente consistente para ambos campos */
            font-size: 1rem; /* Tamaño de fuente consistente para ambos campos */
        }

        .login-content .input-div input[type="password"]::-webkit-password-field {
            color: #1e3c72; /* Color de los puntos en el campo de contraseña (coincide con el botón) */
        }

        .login-content .text-center {
            margin-top: 1rem;
        }

        .login-content .btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(45deg, #1e3c72, #2a5298); /* Gradiente azul galáctico */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.3); /* Sombra luminosa para el botón */
            transition: background 0.3s, transform 0.3s;
        }

        .login-content .btn:hover {
            background: linear-gradient(45deg, #1e3c72, #1e4a8a); /* Cambia el gradiente en hover */
            transform: scale(1.05); /* Efecto de aumento en hover */
        }

        .login-content .btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3); /* Resalta el botón cuando está enfocado */
        }
    </style>
</head>
<body>
    <div class="login-content">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{ asset('inicio/img/avatar.svg') }}" alt="Avatar">
            <h2 class="title">BIENVENIDO</h2>
            @if (session('mensaje'))
                <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                    <small>{{ session('mensaje') }}</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="mb-3">
                @error('usuario')
                    <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
                        <small>{{ $errors->first('usuario') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                @error('password')
                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                        <small>{{ $errors->first('password') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                @error('tipo')
                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                        <small>{{ $errors->first('tipo') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
            </div>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Usuario</h5>
                    <input id="usuario" type="text"
                        class="input @error('usuario') is-invalid @enderror" name="usuario"
                        title="ingrese su nombre de usuario" autocomplete="usuario" value="{{ old('usuario') }}">
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input type="password" id="input" class="input @error('password') is-invalid @enderror"
                        name="password" title="ingrese su clave para ingresar" autocomplete="current-password">
                </div>
            </div>
            <div class="view">
                <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            {{-- <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Ingresar como</h5>
                    <select name="tipo" class="input @error('tipo') is-invalid @enderror">
                        <option value=""></option>
                        <option value="administrador">Administrador</option>
                        <option value="vendedor">Vendedor</option>
                        <option value="cliente">Cliente</option>
                    </select>
                </div>
            </div> --}}

            <div class="text-center">
                <a class="font-italic isai5" href="{{route("recuperar.index")}}">Olvidé mi contraseña</a>
            </div>
            <input name="btningresar" class="btn" title="click para ingresar" type="submit"
                value="INICIAR SESION">
            {{-- login --}}
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('inicio/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('inicio/js/main2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap4/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap4/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap4/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
