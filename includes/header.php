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
    <!-- Título -->
    <title><?php echo $pageTitle ?? 'Madaya' ?></title>
    <!-- Meta description -->
    <meta name="description" content="<?php echo $pageDescription ?? '' ?>">
    <!-- LocalBusiness Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FurnitureRepair",
            "@id": "http://localhost:8000/#madaya",
            "name": "Tapizados Madaya",
            "image": "http://localhost:8000/assets/img/hero-1600.webp",
            "url": "http://localhost:8000/",
            "telephone": "+34922033303",
            "priceRange": "€€",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Calle Obispo Pérez Cácerez, 97",
                "addressLocality": "La Laguna",
                "addressRegion": "Santa Cruz de Tenerife",
                "postalCode": "38205",
                "addressCountry": "ES"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "28.4796382",
                "longitude": "-16.3088229"
            },
            "areaServed": {
                "@type": "AdministrativeArea",
                "name": "Tenerife"
            },
            "openingHoursSpecification": [{
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": [
                        "Monday",
                        "Tuesday",
                        "Wednesday",
                        "Thursday",
                        "Friday"
                    ],
                    "opens": "08:00",
                    "closes": "15:00"
                },
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": "Saturday",
                    "opens": "09:00",
                    "closes": "12:00"
                }
            ],
            "sameAs": [
                "https://www.instagram.com/madaya1",
                "https://maps.app.goo.gl/xzP563w1RDe3MWdK9"
            ],
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.1",
                "reviewCount": "34"
            }
        }
    </script>
    <!-- Open Graph -->
    <meta property="og:title" content="Tapicería ecológica en Tenerife">
    <meta property="og:description" content="Restauración y tapizado de muebles para particulares y empresas en Tenerife. Presupuesto sin compromiso.">
    <meta property="og:image" content="http://localhost:8000/assets/img/hero-1600.webp">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://localhost:8000">
    <!-- Favicon -->
    <link rel="icon" href="/assets/icons/favicon.ico" sizes="any">
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- JS global -->
    <script src="/assets/js/main.js" defer></script>
    <!-- Lexend font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <a class="skip-link" href="#main">Saltar al contenido principal</a>

    <header class="site-header">
        <!-- Logo -->
        <a href="/index.php" class="logo">
            <img src="/assets/img/logo-300.png" alt="Madaya – Tapicería ecológica en Tenerife">
        </a>
        <!-- Icono hamburguesa -->
        <input type="checkbox" class="menu-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="burger-icon" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
        <!-- Menú de navegación -->
        <nav class="main-nav" aria-label="Navegación principal">
            <ul>
                <li><a href="/index.php" class="primary-link <?php echo $current_page === 'index.php' ? 'active' : '' ?>">Inicio</a> </li>
                <li class="dropdown">
                    <a href="/servicios.php" class="primary-link <?php echo $current_page === 'servicios.php' ? 'active' : '' ?>">Servicios</a>
                    <ul class="dropdown-menu">
                        <li><a class="primary-link" href="/servicios.php#hogar">Tapicería para el hogar</a></li>
                        <li><a class="primary-link" href="/servicios.php#profesionales">Tapicería para profesionales</a></li>
                        <li><a class="primary-link" href="/servicios.php#fabricacion">Fabricación a medida</a></li>
                        <li><a class="primary-link" href="/servicios.php#catalogos">Catálogos de tejidos</a></li>
                        <li><a class="primary-link" href="/servicios.php#reviews">Reseñas de clientes</a></li>
                        <li><a class="primary-link" href="/servicios.php#contacto-faq">Contacto y FAQ</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/galeria.php" class="primary-link <?php echo $current_page === 'galeria.php' ? 'active' : '' ?>">Galería</a>
                    <ul class="dropdown-menu">
                        <li><a class="primary-link" href="/galeria.php#galeria-hogar">Fotos de tapicería para el hogar</a></li>
                        <li><a class="primary-link" href="/galeria.php#galeria-restauracion">Fotos de trabajos de restauración</a></li>
                        <li><a class="primary-link" href="/galeria.php#galeria-profesionales">Fotos de tapicería para profesionales</a></li>
                        <li><a class="primary-link" href="/galeria.php#galeria-fabricacion">Fotos de fabricación a medida</a></li>
                    </ul>
                </li>
                <li><a href="/quienes-somos.php" class="primary-link <?php echo $current_page === 'quienes-somos.php' ? 'active' : '' ?>">Quiénes somos</a></li>
                <li><a href="/faq.php" class="primary-link <?php echo $current_page === 'faq.php' ? 'active' : '' ?>">FAQ</a></li>
                <li><a href="/contacto.php" class="primary-link <?php echo $current_page === 'contacto.php' ? 'active' : '' ?>">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main id="main" class="site-main">