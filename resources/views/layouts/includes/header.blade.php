<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoDoppler Virasoro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Barra de navegación -->
<header class="navbar">
    <!-- Botón de "Atrás" -->
    <a href="javascript:history.back()" class="navbar-btn">
        <i class="fas fa-arrow-left"></i> Atras
    </a>
    
    <!-- Nombre de la aplicación -->
    <div class="navbar-title">
        <p class="app" >EcodopplerVirasoro</p>
        <p class="version">Versión de App: 1.0</p>
    </div>
    
    <!-- Botón de "Inicio" -->
    <a href="{{ route('index') }}" class="navbar-btn">
        <i class="fas fa-home"></i> Inicio
    </a>

</header>

