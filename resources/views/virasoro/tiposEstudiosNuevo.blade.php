@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

<div class="contenedor">
    <h1>Agregar nuevo tipo de estudio</h1>

    @if (session('success'))
        <div class="session-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="form" id="pacienteForm" action="{{ route('tiposEstudioNuevoGuardar') }}" method="POST" onsubmit="return abrirModal(event)">
        @csrf
         
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="protocolo">Protocolo</label>
        <textarea id="protocolo" name="protocolo" rows="10" required></textarea>
        
        <!-- Botón de envío que abrirá el modal -->
        <button type="submit" id="submitButton">ACEPTAR</button>
    </form>
</div>

<div class="modal">
    <div class="modal-content">
        <p>¿Estás seguro de que deseas realizar esta acción?</p>
        <button class="confirmar" onclick="confirmarAccion()">Sí, Confirmar</button>
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
