@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

<div class="contenedor">
    <h1 style="font-weight: 400; font-size: 28px">Editando "{{$tipo_estudio->nombre}}" para: </h1>
    <h1 style="color: white;margin-top: -1.5rem" >{{ $paciente->apellido }} {{ $paciente->nombre }}</h1>

    @if (session('edited'))
        <div class="session-edited">
            {{ session('edited') }}
        </div>
    @endif

    <!-- Cambia la URL de la acción y el método para editar -->
    <form class="form-nuevo-estudio" id="pacienteForm" action="{{ route('pacienteEditarEstudio2', $estudio->id) }}" method="POST"
        enctype="multipart/form-data" onsubmit="return abrirModal(event)">

        @csrf
        @method('PUT')  <!-- Asegúrate de usar PUT para una actualización -->

        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
        <input type="hidden" name="estudio_id" value="{{ $estudio->id }}">

        <!-- Pre-carga los datos actuales en los campos del formulario -->
        <label for="fecha">Fecha de estudio</label>
        <input type="date" id="fecha" name="fecha" value="{{ $estudio->fecha }}" required>

        <label for="solicitante">Médico solicitante</label>
        <input type="text" id="solicitante" name="solicitante" value="{{ $estudio->solicitante }}" required>

        <label for="informe">Informe ({{$tipo_estudio->nombre}})</label>
        <textarea id="informe" name="informe" rows="10" required>{{ $estudio->informe }}</textarea>

        <div class="modificar" >Si lo que deseas es modificar el tipo de estudio, o algún multimedia (video o imagen): tenés que eliminar este estudio y subirlo de nuevo al sistema.</div>

        <button type="submit" id="submitButton">ACTUALIZAR</button>
    </form>
</div>

<div class="modal">
    <div class="modal-content">
        <p>¿Deseas guardar los cambios en <b>{{$tipo_estudio->nombre}}</b> para <b>{{ $paciente->apellido }} {{ $paciente->nombre }}</b>?</p>
        <button class="confirmar" onclick="confirmarAccion()">Sí, Guardar</button>
        <button class="cancelar" onclick="cerrarModal()">No, Cancelar</button>
    </div>
</div>

@include('layouts.includes.footer')

<script>
// Muestra el modal
function mostrarModal() {
    document.querySelector('.modal').style.display = 'flex';
}

// Cierra el modal
function cerrarModal() {
    document.querySelector('.modal').style.display = 'none';
}

// Acción de confirmar (envía el formulario)
function confirmarAccion() {
    document.getElementById('pacienteForm').submit();  // Enviar el formulario
    cerrarModal();  // Cierra el modal después de confirmar
}

// Muestra el modal y evita que el formulario se envíe hasta que el usuario confirme
function abrirModal(event) {
    event.preventDefault();  // Evita que el formulario se envíe inmediatamente
    mostrarModal();  // Muestra el modal
}
</script>
