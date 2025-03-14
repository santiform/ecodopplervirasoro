@include('layouts.includes.header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

<div class="contenedor">

    <div class="titulo">
        <h1>
            Tipos de Estudios
            <a href="{{ route('tiposEstudioNuevo') }}"><i class="fa-solid fa-square-plus"></i></a>
        </h1>
    </div>

    @if (session('deleted'))
        <div class="session-deleted">
            {{ session('deleted') }}
        </div>
    @endif

    @if (session('edited'))
        <div class="session-edited">
            {{ session('edited') }}
        </div>
    @endif

    @if (session('estudioSuccess'))
        <div class="session-success">
            {{ session('estudioSuccess') }}
        </div>
    @endif

    <div style="max-width: 700px; margin: 0 auto">
        <!-- Tabla que se llenará con los datos de pacientes -->
        <table id="table" class="display responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos_estudios as $tipos_estudio)
                <tr>
                    <td>{{ $tipos_estudio->id }}</td>
                    <td>{{ $tipos_estudio->nombre }}</td>

                    <td >
                        <div style="display: flex; justify-content: space-around; ">

                            <a href="{{ route('tipoEstudioEditar', ['id' => $tipos_estudio->id]) }}">
                                <img src="{{ asset('img/editar.png') }}" alt="Editar" width="30" height="30">
                            </a>

                            <a href="{{ route('tipoEstudioEliminar', $tipos_estudio->id) }}" 
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
        <p>¿Estás seguro de que deseas eliminar este tipo de estudio?</p>
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
    document.querySelector('.confirmar').setAttribute('data-href', link.href);
}

function cerrarModal() {
    document.querySelector('.modal').style.display = 'none';
}

function confirmarAccion() {
    // Obtener la URL del enlace
    let link = document.querySelector('.confirmar').getAttribute('data-href');
    
    // Crear un formulario para enviar la solicitud DELETE
    let form = document.createElement('form');
    form.method = 'POST';
    form.action = link;  // Asignamos la URL del enlace (ruta para eliminar al paciente)

    // Crear el campo CSRF
    let csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = '{{ csrf_token() }}';

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
