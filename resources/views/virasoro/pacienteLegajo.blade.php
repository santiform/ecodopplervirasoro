@include('layouts.includes.header')

<style type="text/css">
    .titulo {
        width: 500px;
        padding: 10px!important;
    }
    .delete {
        background: transparent;
        border: none;
        margin-left: -20%;
    }
    .session-deleted {
        margin-top: 2.5rem!important;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/legajo.css') }}">
<link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

    @if (session('deleted'))
        <div class="session-deleted">
            {{ session('deleted') }}
        </div>
    @endif

<div class="contenedor">

    <!-- Información del paciente -->
    <div class="legajo">
        <div class="contenedor-icono">
            <div class="circulo">
                <i class="fas fa-user"></i> <!-- Ícono de usuario -->
            </div>
            <span class="nombre">{{ $paciente->apellido }} {{ $paciente->nombre }}</span> <!-- Nombre al lado -->
        </div>

        <p><strong>ID:</strong> {{ $paciente->id }}</p>
        <p><strong>DNI:</strong> {{ $paciente->dni }}</p>
        <p><strong>Celular:</strong> {{ $paciente->celular }}</p>
        <p><strong>Edad:</strong> 45 años</p>
        <p><strong>Obra Social:</strong> {{ $paciente->obra_social }}</p>

    </div>

    <!-- Botones de acción (uno debajo del otro) -->
    <div class="botones">
        <a href="{{ route('pacienteEditar', ['id' => $paciente->id]) }}" class="boton"><i class="fa-solid fa-user-pen"></i> Editar Legajo</a>
        <a href="{{ route('pacienteNuevoEstudio', ['id' => $paciente->id]) }}" class="boton"><i class="fas fa-plus-circle"></i> Cargar Nuevo Estudio</a>
    </div>
</div>

<div class="contenedor2">

    <div class="titulo-estudio">
        <h1>
            Estudios Realizados
            <a href="{{ route('pacienteNuevoEstudio', ['id' => $paciente->id]) }}"><i class="fa-solid fa-square-plus"></i></a>
        </h1>
    </div>

    <table id="table" class="display responsive nowrap" cellspacing="0" width="90%">
        <thead>
            <tr>
                <th>ID Estudio</th>
                <th>Tipo de Estudio</th>
                <th>Fecha</th>
                <th>Solicitante</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudios as $estudio)
            <tr>
                <td>{{ $estudio->id }}</td>
                <td>{{ $estudio->estudio_nombre }}</td>
                <td>{{ $estudio->fecha }}</td>
                <td>{{ $estudio->solicitante }}</td>

                <td >
                    <div style="display: flex; justify-content: space-around; ">

                        <a href="{{ route('estudioVer', ['id' => $estudio->id]) }}">
                            <img src="{{ asset('img/ver.png') }}" alt="Ver" width="30" height="30">
                        </a>

                        <a href="{{ route('pacienteEditarEstudio', ['id' => $estudio->id]) }}">
                            <img src="{{ asset('img/editar.png') }}" alt="Editar" width="30" height="30">
                        </a>

                        <a href="{{ route('estudioEliminar', ['id' => $estudio->id]) }}" 
                           class="btn-eliminar" 
                           onclick="event.preventDefault(); mostrarModal(this)">
                            <img src="{{ asset('img/borrar.png') }}" alt="Eliminar" width="30" height="30">
                        </a>
 



                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>    

<!-- Incluye jQuery y DataTables JS -->
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
