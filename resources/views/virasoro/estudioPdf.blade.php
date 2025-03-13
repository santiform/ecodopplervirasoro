<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudio - {{ $estudio->tipo_estudio_nombre }}</title>
<style>
    /* Agrega aquí tus estilos personalizados para el PDF */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        margin: 20px;
    }

    .titulo {
        font-size: 28px;
        font-weight: bold;
    }

    .titulo2 {
        font-size: 27px;
        font-weight: 400;
        margin-top: -1.7rem;
        margin-bottom: 1.2rem;
    }

    .subtitulo {
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
    }

    .imagenes-container {
        margin-top: 20px;
        text-align: center; /* Centra las imágenes horizontalmente */
    }

    .imagen {
        width: 100%; /* La imagen ocupa el 100% del ancho disponible */
        height: auto; /* Mantiene la proporción original de la imagen */
        margin: 0 auto; /* Centra la imagen horizontalmente si la imagen es más pequeña que el contenedor */
        display: block; /* Hace que la imagen sea un bloque para centrarla */
        margin-top: 10px;
    }

    .container {
        margin-bottom: 20px;
    }
</style>


</head>
<body>

    <div class="container">
        <p class="titulo">{{ $estudio->tipo_estudio_nombre }} </p>
        <p class="titulo2">{{ $estudio->paciente_nombre }} {{ $estudio->paciente_apellido }}</p>
        <hr>
        <p><strong>Médico:</strong> Dr. {{ $estudio->solicitante }}</p>
        <p style="margin-top: -0.75rem;"><strong>Fecha:</strong> {{ $estudio->fecha }}</p>
        <div style="height: 0.1rem;" ></div>
       
        <p>{!! nl2br(e($estudio->informe)) !!}</p>

    </div>

    <div class="imagenes-container">
        @foreach ($imagenes as $imagen)
            @if ($imagen->tipo !== 'video')  <!-- Si no es un video, muestra la imagen -->
                <img src="{{ url($imagen->url) }}" class="imagen">
            @endif
        @endforeach

    </div>

</body>
</html>
