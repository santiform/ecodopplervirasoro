@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
<link rel="stylesheet" href="{{ asset('css/alertas.css') }}">

<div class="contenedor">
    <h1>Editar paciente</h1>

    @if (session('edited'))
        <div class="session-edited">
            {{ session('edited') }}
        </div>
    @endif

    <form class="form" id="pacienteForm" action="{{ route('pacienteEditarGuardar', $paciente->id) }}" method="POST" onsubmit="return abrirModal(event)">
        @csrf
        @method('PUT') {{-- Método PUT para actualización --}}
         
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" value="{{ $paciente->apellido }}" required>

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ $paciente->nombre }}" required>

        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni" value="{{ $paciente->dni }}" required>

        <label for="celular">Celular</label>
        <input type="tel" id="celular" name="celular" value="{{ $paciente->celular }}" required>

        <label for="nacimiento">Nacimiento</label>
        <input type="date" id="nacimiento" name="nacimiento" value="{{ $paciente->nacimiento }}" required>

        <label for="obra_social">Obra Social</label>
        <input type="text" id="obra_social" name="obra_social" value="{{ $paciente->obra_social }}" required>

        <button type="submit" id="submitButton">GUARDAR CAMBIOS</button>
    </form>
</div>

<div class="modal">
    <div class="modal-content">
        <p>¿Estás seguro de que deseas guardar los cambios?</p>
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
