@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

<div class="contenedor">
    <h1 style="font-weight: 400; font-size: 28px">Agregando "{{$tipo_estudio->nombre}}" para: </h1>
    <h1 style="color: white;margin-top: -1.5rem" >{{ $paciente->apellido }} {{ $paciente->nombre }}</h1>

    @if (session('success'))
        <div class="session-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="form-nuevo-estudio" id="pacienteForm" action="{{ route('pacienteNuevoEstudio3') }}" method="POST"
        enctype="multipart/form-data" onsubmit="return abrirModal(event)">

        @csrf

        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

        <input type="hidden" name="estudio_id" value="{{ $tipo_estudio->id }}">
         
        <label for="fecha">Fecha de estudio</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="solicitante">Médico solicitante</label>
        <input type="text" id="solicitante" name="solicitante" required>

        <label for="informe">Informe ({{$tipo_estudio->nombre}})</label>
        <textarea id="informe" name="informe" rows="10" required>{{ $tipo_estudio->protocolo }}</textarea>

        <!-- Campo para seleccionar múltiples archivos -->
        <label for="archivos">Archivos (Puedes seleccionar varios)</label>
        <input type="file" id="archivos" name="archivos[]" multiple required>

        <button type="submit" id="submitButton">GUARDAR</button>
    </form>
</div>

<div class="modal">
    <div class="modal-content">
        <p>¿Deseas guardar <b>{{$tipo_estudio->nombre}}</b> para <b>{{ $paciente->apellido }} {{ $paciente->nombre }}</b>?</p>
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
