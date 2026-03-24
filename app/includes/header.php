<?php
require_once __DIR__ . '/bootstrap.php'; 
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
    <?php if (!empty($canonicalUrl)): ?>
    <link rel="canonical" href="<?php echo $canonicalUrl; ?>">
    <?php endif; ?>
    <!-- LocalBusiness Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FurnitureRepair",
            "@id": "https://ecomadaya.es/#madaya",
            "name": "Tapizados Madaya",
            "image": "https://ecomadaya.es/assets/img/hero-1600.webp",
            "url": "https://ecomadaya.es/",
            "telephone": "+34922033303",
            "priceRange": "€€",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Calle Obispo Pérez Cáceres, 97",
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
    <meta property="og:image" content="<?php echo MADAYA_SITE_URL; ?>/assets/img/hero-1600.webp">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo MADAYA_SITE_URL; ?>">
    <!-- Favicon -->
    <link rel="icon" href="/assets/icons/favicon.ico" sizes="any">
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- JS global -->
    <script src="/assets/js/main.js" defer></script>
</head>

<body>

    <a class="skip-link" href="#main">Saltar al contenido principal</a>

    <header id="header" class="site-header">
        <!-- Logo -->
        <a href="/index.php" class="logo">
            <img src="/assets/img/brand/logo-300.png" alt="Madaya – Tapicería ecológica en Tenerife">
        </a>
        <!-- Icono hamburguesa -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle" aria-label="Abrir menu de navegacion" aria-controls="main-navigation" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" class="burger-icon" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
        <!-- Menú de navegación -->
        <nav id="main-navigation" class="main-nav" aria-label="Navegación principal">
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
                <li><a href="/contacto.php" class="primary-link <?php echo $current_page === 'contacto.php' ? 'active' : '' ?>">Contacto</a></li>
                <li><a href="/quienes-somos.php" class="primary-link <?php echo $current_page === 'quienes-somos.php' ? 'active' : '' ?>">Quiénes somos</a></li>
                <li><a href="/preguntas-frecuentes.php" class="primary-link <?php echo $current_page === 'preguntas-frecuentes.php' ? 'active' : '' ?>">FAQ</a></li>
            </ul>
        </nav>
    </header>

    <main id="main" class="site-main">
        <a href="#header" class="btn-fixed btn-fixed--back-to-top" title="Volver al inicio">
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="44"
                height="44" 
                fill="currentColor" 
                viewBox="0 0 16 16"
                aria-hidden="true" 
                focusable="false">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
            </svg>
        </a>
        <!-- Botón de WhatsApp para presupuesto -->
        <a id="whatsapp-btn" 
            title="Contactar por WhatsApp para solicitar presupuesto"
            class="btn-fixed btn-fixed--whatsapp"
            href="<?php echo $whatsAppBudgetUrl; ?>" 
            target="_blank" 
            rel="noopener noreferrer"
            aria-label="Contactar por WhatsApp para solicitar presupuesto (abre una ventana nueva)"> 
            <svg xmlns="http://www.w3.org/2000/svg" 
                    width="44" 
                    height="44" 
                    fill="currentColor" 
                    viewBox="0 0 16 16" 
                    aria-hidden="true" 
                    focusable="false">
                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
            </svg>
        </a>
        