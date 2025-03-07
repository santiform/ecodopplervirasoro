<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoDoppler Virasoro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<style>
    body {
        margin: 0; /* Elimina márgenes por defecto */
        height: 100vh; /* Asegura que el fondo cubra toda la altura de la pantalla */
        overflow: hidden; /* Evita el scroll generado por la imagen */
        position: relative; /* Necesario para el pseudo-elemento */
    }

    /* Imagen de fondo */
    body::before {
        content: ""; /* Necesario para generar el pseudo-elemento */
        position: absolute; /* Posiciona el pseudo-elemento */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset('img/back-login.webp') }}');
        background-size: cover; /* La imagen cubre toda la pantalla */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        z-index: -1; /* Asegura que la imagen esté detrás del contenido */
    }

    /* Color con transparencia */
    body::after {
        content: ""; /* Necesario para generar el pseudo-elemento */
        position: absolute; /* Posiciona el pseudo-elemento encima de la imagen */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(108, 208, 232, 0.5); /* Color con opacidad */
        z-index: -1; /* Asegura que el color se superponga a la imagen */
    }
</style>

<div class="login-container">
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="on">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" class="input-field" type="password" name="password" required autocomplete="on">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="forgot">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">Olvidé mi contraseña</a>
                @endif

                <button type="submit" class="submit-btn"><i class="fa-solid fa-arrow-right-to-bracket"></i> Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>