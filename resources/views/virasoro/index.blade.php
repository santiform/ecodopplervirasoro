@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

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

    a {
        text-decoration: none;
    }
</style>

<div class="index-container">
    <div class="container">
        <div class="half">
            <h1>¡Bienvenido!</h1>
            <h2>Dr. {{ Auth::user()->name }}</h2>
        </div>
        <div class="half">
            <div class="bottom">
                <div class="button-container">
                    <div class="button-item">
                        <a href="{{ route('pacientes') }}">
                            <button class="round-button"><i class="fa-solid fa-user"></i></button>
                            <p>Pacientes</p>
                        </a>
                    </div>
                    <div class="button-item">
                        <button class="round-button"><i class="fa-solid fa-user-plus"></i></button>
                        <p>Nuevo Paciente</p>
                    </div>                    
                    <div class="button-item">
                        <button class="round-button"><i class="fa-solid fa-user-doctor"></i></button>
                        <p>Nuevo Estudio</p>
                    </div>
                    <div class="button-item">
                        <button class="round-button"><i class="fa-solid fa-file-invoice"></i></button>
                        <p>Estudios Realizados</p>
                    </div>
                    <div class="button-item">
                        <button class="round-button"><i class="fa-solid fa-notes-medical"></i></button>
                        <p>Nuevo Estudio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.includes.footer')