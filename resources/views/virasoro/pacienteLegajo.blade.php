@include('layouts.includes.header')

<link rel="stylesheet" href="{{ asset('css/legajo.css') }}">

    <style>
        .contenedor {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }

        /* Alineación en pantallas grandes */
        @media (min-width: 768px) {
            .contenedor {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }
        }

        /* Ajuste para pantallas grandes */
        @media (min-width: 1024px) {
            .legajo {
                max-width: 40%;  /* Reduce el tamaño */
                margin: auto;    /* Centra horizontalmente */
            }
        }

        /* Ajuste para pantallas grandes */
        @media (min-width: 1400px) {
            .legajo {
                max-width: 30%;  /* Reduce el tamaño */
                margin: auto;    /* Centra horizontalmente */
            }
        }

        /* Estilos del legajo */
        .legajo {
            padding: 25px;
            border-radius: 8px;
            background: #65d0e8; /* Azul claro */
            flex: 1;
        }

        .legajo h1 {
            margin-bottom: 10px;
            color: #056074;
            margin-top: 0;
        }

        .legajo p {
            margin: 5px 0;
            color: white;
            font-weight: 500;
            font-size: 20px;
        }

        .legajo strong {
            color: #056074;
        }

        /* Estilos de los botones */
        .botones {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .boton {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #00b8e1; /* Verde */
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 8px;
            transition: background 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .boton:hover {
            background: #0595b5;
        }

        .boton i {
            font-size: 24px;
        }

        .contenedor-icono {
            display: flex;
            align-items: center; /* Alinea verticalmente */
            gap: 10px; /* Espacio entre el icono y el texto */
            margin-bottom: 2rem;

        }

        .circulo {
            width: 100px;
            height: 100px;
            background-color: #00b8e1;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 60px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .circulo:hover {
            background-color: #0595b5;
        }

        .nombre {
            font-size: 24px;
            font-weight: bold;
            color: white;

        }

    </style>


<div class="contenedor">
    <!-- Información del paciente -->
    <div class="legajo">
        <div class="contenedor-icono">
            <div class="circulo">
                <i class="fas fa-user"></i> <!-- Ícono de usuario -->
            </div>
            <span class="nombre">{{ $paciente->apellido }} {{ $paciente->nombre }}</span> <!-- Nombre al lado -->
        </div>

        <p><strong>DNI:</strong> {{ $paciente->dni }}</p>
        <p><strong>Celular:</strong> {{ $paciente->celular }}</p>
        <p><strong>Edad:</strong> 45 años</p>
        <p><strong>Obra Social:</strong> {{ $paciente->obra_social }}</p>

    </div>

    <!-- Botones de acción (uno debajo del otro) -->
    <div class="botones">
        <a href="#" class="boton"><i class="fa-solid fa-user-pen"></i> Editar Legajo</a>
        <a href="#" class="boton"><i class="fas fa-folder-open"></i> Estudios Realizados</a>
        <a href="#" class="boton"><i class="fas fa-plus-circle"></i> Cargar Nuevo Estudio</a>
    </div>
</div>





@include('layouts.includes.footer')