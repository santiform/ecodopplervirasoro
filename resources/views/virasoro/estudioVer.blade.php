@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/estudio.css') }}">
<!-- Agregar en el <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">



<div class="contenedor">

    <div class="legajo">
        <h1>{{ $estudio->tipo_estudio_nombre }} - {{ $estudio->paciente_nombre }} {{ $estudio->paciente_apellido }}</h1>

        <div style="height: 0.5rem;" ></div>

        <p class="item"><strong>Médico:</strong> Dr. {{ $estudio->solicitante }}</p>
        <p class="item"><strong>Fecha:</strong> {{ $estudio->fecha }}</p>
        <div style="height: 1rem;" ></div>
        <p>{!! nl2br(e($estudio->informe)) !!}</p>
        <div style="height: 2rem;" ></div>

        @if($imagenes->isNotEmpty())
            <div class="contenedor-imagenes">
                @foreach($imagenes as $url)
                    <a href="{{ asset($url) }}" class="glightbox" data-gallery="galeria">
                        <img src="{{ asset($url) }}" alt="Imagen">
                    </a>
                @endforeach
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const lightbox = GLightbox({
                        selector: '.glightbox',
                        touchNavigation: true, // Permite deslizar en pantallas táctiles
                        loop: true, // Permite recorrer las imágenes en bucle
                        autoplayVideos: false // Evita que se reproduzcan videos automáticamente
                    });
                });
            </script>

        @else
            <p>No hay imágenes disponibles.</p>
        @endif

    </div>    

    <!-- Botones de acción (uno debajo del otro) -->
    <div class="botones">
        <a href="{{ route('estudioDescargar', ['id' => $estudio->id]) }}" class="boton"><i class="fa-solid fa-download"></i> Descargar</a>
        <a href="{{ route('estudioImprimir', ['id' => $estudio->id]) }}" class="boton"><i class="fa-solid fa-print"></i> Imprimir</a>
        <a href="{{ route('pacienteNuevoEstudio', ['id' => $estudio->id]) }}" class="boton"><i class="fa-brands fa-whatsapp"></i> Enviar por WhatsApp</a>
    </div>
</div>





@include('layouts.includes.footer')

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>