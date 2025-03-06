@include('layouts.includes.header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<style type="text/css">

body {
    background-color: #056074;
}


/* Color de fondo de la tabla */
table.dataTable {
    background-color: #056074; /* Color para los datos */
    border: none;

}

/* Borde de las celdas */
table.dataTable td, table.dataTable th {
    border: 1px solid white; /* Borde blanco */
}

/* Estilo para el buscador */
.dataTables_filter input {
    background-color: #056074; /* Color para el buscador */
    border: 1px solid white; /* Borde blanco */
    color: white; /* Letra blanca */
    padding: 6px 10px;
    font-size: 14px;
    border-radius: 4px;
}

/* Estilo del input del buscador al enfocarlo */
.dataTables_filter input:focus {
    outline: none;
    border-color: #00B8E1; /* Borde azul claro al enfocarse */
}

/* Estilo de las cabeceras */
table.dataTable thead {
    background-color: #00B8E1; /* Color para el encabezado */
    color: white; /* Letra blanca */
}

/* Color para las filas de la tabla (tr) */
table.dataTable tbody tr {
    background-color: #65D0E8; /* Color que quieres para las filas */
}

/* Estilo al pasar el mouse sobre las filas */
table.dataTable tbody tr:hover {
    background-color: #b2dfdb; /* Un celeste más suave para el hover */
}

.previous, .next {
    background-color: white !important;
}

.paginate_button {
    background-color: white !important;
    border: none !important;
}




/* Cambiar el fondo y el color del texto de la columna ordenada ascendentemente */
th.sorting_asc {
    background-color: #00B8E1 !important; /* Fondo celeste */
    color: white !important; /* Texto blanco */
}

/* Cambiar el fondo y el color del texto de la columna ordenada descendentemente */
th.sorting_desc {
    background-color: #00B8E1 !important; /* Fondo verde oscuro */
    color: white !important; /* Texto blanco */
}

/* Cambiar el ícono de orden ascendente */
th.sorting_asc::after {
    color: white !important; /* Flecha blanca */
}

/* Cambiar el ícono de orden descendente */
th.sorting_desc::after {
    color: white !important; /* Flecha blanca */
}

/* Cambiar el color de la columna no ordenada */
th.sorting {
    background-color: #00B8E1 !important; /* Fondo verde oscuro */
    color: white !important; /* Texto blanco */
}



.odd, .even {
    background-color: #65D0E8 !important;
}





.paginate_button:hover {
    background-color: white !important;
    border: none !important;
}

/* Selecciona el botón de paginación activo */
.dataTables_paginate .paginate_button.current {
    background-color: #056074 !important; /* Fondo oscuro */
    color: white !important; /* Texto blanco */
}


/* Cambiar los botones de paginación a un fondo celeste con texto blanco */
.dataTables_paginate a,
.dataTables_paginate span {
    color: white !important; /* Texto blanco */
    padding: 5px 10px; /* Espaciado */
    text-transform: uppercase; /* Hacer que el texto esté en mayúsculas */
}

/* Cambiar el fondo de la página activa */
.dataTables_paginate .current {
    background-color: #056074 !important; /* Fondo verde oscuro */
}

/* Cambiar color de hover para los botones de paginación */
.dataTables_paginate a:hover {
    background-color: #65D0E8 !important; /* Fondo al pasar el cursor */
}

/* Cambiar el color del texto de la información */
.dataTables_info {
    color: white !important; /* Cambiar el color de la información a blanco */
}

/* Cambiar los textos de los filtros */
.dataTables_filter label,
.dataTables_length label {
    color: white !important; /* Texto blanco */
}

/* Cambiar el color del texto en los inputs de búsqueda */
.dataTables_filter input {
    color: white !important; /* Texto blanco en el input */
    background-color: #056074 !important; /* Fondo oscuro para el input */
    border: 1px solid #00B8E1; /* Borde celeste para el input */
}

h1 {
    color: white;
    text-align: center;
    font-weight: 500;
}


/* Responsividad */
@media (max-width: 768px) {
    table.dataTable {
        font-size: 12px;
    }
}

</style>

<h1>Pacientes</h1>

<!-- Tabla que se llenará con los datos de pacientes -->
<table id="pacientesTable" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Celular</th>
            <th>Edad</th>
            <th>Obra Social</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ $paciente->apellido }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->dni }}</td>
            <td>{{ $paciente->celular }}</td>
            <td>{{ $paciente->edad }} años</td>
            <td>{{ $paciente->obra_social }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Incluye jQuery y DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Inicializar DataTables en la tabla -->
<script>
$(document).ready(function() {
    if (!$.fn.dataTable.isDataTable('#pacientesTable')) {
        $('#pacientesTable').DataTable({
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

<script type="text/javascript">
    
</script>

@include('layouts.includes.footer')