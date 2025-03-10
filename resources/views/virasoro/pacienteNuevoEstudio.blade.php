@include('layouts.includes.header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/tabla.css') }}">

<div class="contenedor">
    <h1 style="color: #00dcf1; font-weight: 400; font-size: 28px">Agregar nuevo estudio para: </h1>
    <h1 style="margin-top: -1.5rem" >{{ $paciente->apellido }} {{ $paciente->nombre }}</h1>

    <hr>

    <div class="nuevo-elemento">
        <p>
            Si el tipo de estudio no se encuentra en esta lista, tenés que 
            <a href=""> 
                agregar un nuevo Tipo de Estudio
            </a>
        </p>
    </div>

    <div style="max-width: 800px; margin: 0 auto">
        <table id="table" class="display responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Seleccioná un Tipo de estudio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos_estudios as $tipo_estudio)
                <tr>

                    <td >
                        <div style="display: flex; justify-content: space-around; ">
                            <a href="{{ route('pacienteNuevoEstudio2', ['id' => $paciente->id, 'estudio_id' => $tipo_estudio->id]) }}">
                               {{ $tipo_estudio->nombre }}
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

@include('layouts.includes.footer')