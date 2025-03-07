@include('layouts.includes.header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/tabla.css') }}">

<div class="contenedor">

    <div class="titulo">
        <h1>
            Pacientes
            <a href="{{ route('pacientesNuevo') }}"><i class="fa-solid fa-user-plus"></i></a>
        </h1>
    </div>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla que se llenará con los datos de pacientes -->
    <table id="table" class="display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Edad</th>
                <th>Obra Social</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->apellido }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->celular }}</td>
                <td>{{ $paciente->edad }} años</td>
                <td>{{ $paciente->obra_social }}</td>

                <td >
                    <div style="display: flex; justify-content: space-around; ">
                        <!-- Imagen para ver -->
                        <a href="{{ route('pacienteLegajo', ['id' => $paciente->id]) }}">
                            <img src="{{ asset('img/ver.png') }}" alt="Ver" width="30" height="30">
                        </a>

                        <!-- Imagen para editar -->
                        <a href="">
                            <img src="{{ asset('img/editar.png') }}" alt="Editar" width="30" height="30">
                        </a>

                        <!-- Imagen para eliminar -->
                        <a href="" onclick="return confirm('¿Estás seguro de que deseas eliminar este paciente?')">
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

@include('layouts.includes.footer')