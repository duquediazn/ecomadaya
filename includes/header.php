<?php
// Detecta la página actual para marcar el menú activo
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título por defecto (luego si quieres se puede sobreescribir en cada página) -->
    <title>Artesanía y Tapizados Madaya</title>

    <!-- Favicon -->
    <link rel="icon" href="/assets/icons/favicon.ico" sizes="any">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">

    <!-- JS global -->
    <script src="/assets/js/main.js" defer></script>
</head>

<body>

    <a class="skip-link" href="#main">Saltar al contenido principal</a>

    <header class="site-header">
        <nav class="main-nav" aria-label="Navegación principal">
            <a href="/index.php" class="logo">
                <img src="/assets/img/logo-300.png" alt="Logo de la empresa Artesanía y Tapizados Madaya">
            </a>

            <ul class="menu">
                <li><a href="/index.php" class="<?= $current_page === 'index.php' ? 'active' : '' ?>">Inicio</a></li>
                <li><a href="/servicios.php" class="<?= $current_page === 'servicios.php' ? 'active' : '' ?>">Servicios</a></li>
                <li><a href="/galeria.php" class="<?= $current_page === 'galeria.php' ? 'active' : '' ?>">Galería</a></li>
                <li><a href="/quienes-somos.php" class="<?= $current_page === 'quienes-somos.php' ? 'active' : '' ?>">Quiénes somos</a></li>
                <li><a href="/faq.php" class="<?= $current_page === 'faq.php' ? 'active' : '' ?>">FAQ</a></li>
                <li><a href="/contacto.php" class="<?= $current_page === 'contacto.php' ? 'active' : '' ?>">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main id="main" class="site-main">