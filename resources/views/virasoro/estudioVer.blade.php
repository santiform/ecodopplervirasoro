@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/estudio.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<style type="text/css">
    .session-success {
        background-color: #009136;
        color: white;
        margin-bottom: -0.01rem!important;
        border: 1px solid white;
    }
</style>

<div class="contenedor">

    <div class="legajo">
        <h1>{{ $estudio->tipo_estudio_nombre }} - {{ $estudio->paciente_nombre }} {{ $estudio->paciente_apellido }}</h1>

        @if (session('wpp-success'))
            <div class="session-success">
                {{ session('wpp-success') }}
            </div>
        @endif

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
        <a href="{{ route('wpp', ['id' => $estudio->id]) }}" class="boton"><i class="fa-brands fa-whatsapp"></i> Enviar por WhatsApp</a>
        <a href="{{ route('estudioEliminarB', ['id' => $estudio->id]) }}"  class="boton" 
                           class="btn-eliminar" 
                           onclick="event.preventDefault(); mostrarModal(this)">
                            <i class="fa-solid fa-trash"></i> Eliminar estudio
                        </a>
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

<!-- Modal de Confirmación -->
<div class="modal">
    <div class="modal-content">
        <p>¿Estás seguro de que deseas eliminar este estudio?</p>
        <button class="confirmar" onclick="confirmarAccion()">Sí, Confirmar</button>
        <button class="cancelar" onclick="cerrarModal()">No, Cancelar</button>
    </div>
</div>

@include('layouts.includes.footer')

<script>
function mostrarModal(link) {
    // Mostrar el modal
    document.querySelector('.modal').style.display = 'flex';
    // Establecer la URL del enlace en el botón de confirmación
    document.querySelector('.confirmar').setAttribute('data-href', link.getAttribute('href'));
}

function cerrarModal() {
    document.querySelector('.modal').style.display = 'none';
}

function confirmarAccion() {
    // Obtener la URL del enlace (la URL de eliminación)
    let link = document.querySelector('.confirmar').getAttribute('data-href');
    
    // Crear un formulario para enviar la solicitud DELETE
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = link;  // Asignamos la URL de la eliminación al formulario

    // Crear el campo CSRF
    let csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = '{{ csrf_token() }}';  // Se inserta el token CSRF de Laravel

    // Crear el campo _method para que Laravel reconozca que es una solicitud DELETE
    let methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'DELETE';

    // Agregar los campos al formulario
    form.appendChild(csrfField);
    form.appendChild(methodField);

    // Agregar el formulario al body y enviarlo
    document.body.appendChild(form);
    form.submit();

    // Cerrar el modal
    cerrarModal();
}
</script>