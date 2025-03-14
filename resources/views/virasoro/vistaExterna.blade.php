@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/estudio.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style type="text/css">
    .navbar-btn {
        pointer-events: none;
        opacity: 0; /* Para que se vea visualmente deshabilitado */
    }
    .navbar {
        background-color: #080808;
        border: none;
    }
    .version {
        color: white;
    }
    body {
        background-color: #3b3b3b;
    }
    .legajo {
        background-color: #bebebe;
    }
    .legajo h1 {
        color: black;
    }
    .legajo p {
        color: black;
    }
    .item {
        color: black;
    }
    .item strong {
        color: black;
    }
    .boton {
        background-color: black;
    }
    .boton:hover {
        color: black;
    }
</style>

<div class="contenedor">

    <div class="legajo">
        <h1>{{ $estudio->tipo_estudio_nombre }} <br> {{ $estudio->paciente_nombre }} {{ $estudio->paciente_apellido }}</h1>

        <div style="height: 0.5rem;" ></div>

        <p class="item"><strong>Médico:</strong> Dr. {{ $estudio->solicitante }}</p>
        <p class="item"><strong>Fecha:</strong> {{ $estudio->fecha }}</p>
        <div style="height: 1rem;" ></div>
        <p>{!! nl2br(e($estudio->informe)) !!}</p>
        <div style="height: 2rem;" ></div>

        @if($imagenes->isNotEmpty())
            <div class="contenedor-imagenes">
                @foreach($imagenes as $url)
                    @php
                        // Obtener la extensión del archivo
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) 
                        <!-- Si es una imagen -->
                        <a href="{{ asset($url) }}" class="glightbox" data-gallery="galeria">
                            <img src="{{ asset($url) }}" alt="Imagen">
                        </a>
                    @elseif (in_array($extension, ['mp4', 'mov', 'avi'])) 
                        <!-- Si es un video -->
                        <a href="{{ asset($url) }}" class="glightbox" data-gallery="galeria">
                            <video width="320" height="240" controls>
                                <source src="{{ asset($url) }}" type="video/{{ $extension }}">
                                Tu navegador no soporta el elemento de video.
                            </video>
                        </a>
                    @else
                        <!-- Si es otro tipo de archivo, lo puedes omitir o mostrar un mensaje -->
                        <p>Archivo no compatible</p>
                    @endif
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
            <p>No hay imágenes o videos disponibles.</p>
        @endif

    </div>    

    <!-- Botones de acción (uno debajo del otro) -->
    <div class="botones">
        <a href="{{ route('estudioDescargar', ['id' => $estudio->id]) }}" class="boton"><i class="fa-solid fa-download"></i> Descargar</a>
        <a href="{{ route('estudioImprimir', ['id' => $estudio->id]) }}" class="boton"><i class="fa-solid fa-print"></i> Imprimir</a>
    </div>
</div>

@include('layouts.includes.footer')

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Inicializar DataTables en la tabla -->
<script>
$(document).ready(function() {
    if (!$.fn.dataTable.isDataTable('#table')) {
        $('#table').DataTable({
            responsive: true,
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                infoFiltered: "(filtrado de _MAX_ entradas)",
                zeroRecords: "No se encontraron registros coincidentes",
                paginate: {
                    first: "Primera",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Última"
                }
            }
        });
    }
});
</script>

@include('layouts.includes.footer')