<?php

/**
 * Página de galería con carga progresiva para la sección "hogar".
 *
 * Estrategia híbrida:
 * - Sin JS: el parámetro `hogar_limit` aumenta el número de imágenes visibles.
 * - Con JS: el enlace "Cargar más" se mejora con peticiones asíncronas al endpoint galeria-hogar.php.
 */
$pageTitle = "Galería de trabajos realizados";
$pageDescription = "Galería de imágenes de los trabajos realizados por Tapizados Madaya en Tenerife. Descubre la calidad y el detalle de nuestros servicios de tapicería y restauración de muebles a través de esta selección de proyectos finalizados.";
require_once __DIR__ . '/app/config/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/galeria/';
include __DIR__ . '/app/views/layout/header.php';

// Rutas físicas (servidor) y públicas (URL) de la galería de hogar.
$basePath = __DIR__ . '/assets/img/galeria/hogar/';
$dirSmall = $basePath . 'small';
$dirLarge = $basePath . 'large';
$publicBasePath = '/assets/img/galeria/hogar';
$publicSmallPath = $publicBasePath . '/small';
$publicLargePath = $publicBasePath . '/large';
$descriptionsPath = $basePath . 'descripciones.json';

// Extensiones de imagen permitidas para la galería.
$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

// Se incluyen funciones auxiliares para la galería, como la carga de descripciones y la construcción de items.
require_once __DIR__ . '/app/services/gallery-service.php';

// Se construyen y validan items a partir de archivos y descripciones.
$galleryData = buildGalleryItems($dirSmall, $dirLarge, $allowedExt, $descriptionsPath);
$validGalleryItems = $galleryData['items'];
$totalGalleryItems = count($validGalleryItems);

// Reglas de paginación para mostrar lotes de 10 con tope absoluto en 35.
$defaultBatchSize = 10;
$maxVisibleItems = 35;
$requestedLimit = filter_input(INPUT_GET, 'hogar_limit', FILTER_VALIDATE_INT);

// Si el parámetro no es válido o es menor que el tamaño de lote, se muestra el lote inicial.
if (!is_int($requestedLimit) || $requestedLimit < $defaultBatchSize) {
    $requestedLimit = $defaultBatchSize;
}

// Números finales usados por la vista y por el enlace fallback de "Cargar más".
$requestedLimit = min($requestedLimit, $maxVisibleItems);
$effectiveTotalGalleryItems = min($totalGalleryItems, $maxVisibleItems);
$currentVisibleCount = min($requestedLimit, $effectiveTotalGalleryItems);
$visibleGalleryItems = array_slice($validGalleryItems, 0, $currentVisibleCount);
$hasMoreGalleryItems = $currentVisibleCount < $effectiveTotalGalleryItems;
$canRenderLoadMoreControl = $effectiveTotalGalleryItems > $defaultBatchSize;
$nextVisibleCount = min($currentVisibleCount + $defaultBatchSize, $effectiveTotalGalleryItems);
$loadMoreHref = '/galeria.php?hogar_limit=' . rawurlencode((string) $nextVisibleCount) . '#galeria-hogar';
?>

<section id="galeria-hogar" class="section--narrow" aria-labelledby="galeria-hogar-heading">
    <h1 id="galeria-hogar-heading">Galería de Trabajos Realizados</h1>
    <p>Descubre la calidad y el detalle de nuestros servicios de tapicería y restauración de muebles a través de esta selección de proyectos finalizados.</p>

    <h2>Tapicería general</h2>
    <p>En esta galería encontrarás una amplia selección de algunos de nuestros más recientes trabajos de tapicería para el hogar.</p>
    <p>Haz click sobre las imágenes para verlas en más detalle.</p>
    <div id="galeria-hogar-grid" class="gallery" aria-label="Galería de imágenes de trabajos realizados para particulares">
        <?php
        // Render inicial: solo las imágenes permitidas por el límite actual.
        foreach ($visibleGalleryItems as $item) {
            $smallUrl = htmlspecialchars($publicSmallPath . '/' . $item['small'], ENT_QUOTES, 'UTF-8');
            $largeUrl = htmlspecialchars($publicLargePath . '/' . $item['large'], ENT_QUOTES, 'UTF-8');
            $description = (string) $item['description'];
            $altText = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');

            echo '<figure>
                    <a href="' . $largeUrl . '" target="_blank" rel="noopener noreferrer"><img src="' . $smallUrl . '" alt="' . $altText . '" loading="lazy" decoding="async"></a>
                    <figcaption>' . $altText . '</figcaption>
                </figure>';
        }

        // Mensaje de fallback cuando no hay contenido disponible.
        if ($totalGalleryItems === 0) {
            echo '<p>No hay imágenes disponibles en este momento. Si quieres ver más trabajos, puedes escribirnos desde <a href="/contacto.php">contacto</a>.</p>';
        }
        ?>
    </div>
    <?php if ($canRenderLoadMoreControl): ?>
        <div class="gallery-load-more">
            <a
                href="<?= htmlspecialchars($loadMoreHref, ENT_QUOTES, 'UTF-8') ?>"
                class="btn btn--secondary"
                data-gallery-load-more
                data-batch-size="<?= htmlspecialchars((string) $defaultBatchSize, ENT_QUOTES, 'UTF-8') ?>"
                data-offset="<?= htmlspecialchars((string) $currentVisibleCount, ENT_QUOTES, 'UTF-8') ?>"
                data-total="<?= htmlspecialchars((string) $effectiveTotalGalleryItems, ENT_QUOTES, 'UTF-8') ?>"
                data-endpoint="/api/galeria-hogar.php"
                aria-controls="galeria-hogar-grid"
                aria-label="Cargar más imágenes de la galería"
                aria-disabled="<?= $hasMoreGalleryItems ? 'false' : 'true' ?>">
                Cargar más
            </a>
            <p id="galeria-hogar-status" class="gallery-load-more__status" aria-live="polite">
                Mostrando <?= htmlspecialchars((string) $currentVisibleCount, ENT_QUOTES, 'UTF-8') ?> de <?= htmlspecialchars((string) $effectiveTotalGalleryItems, ENT_QUOTES, 'UTF-8') ?> imágenes.
            </p>
        </div>
    <?php endif; ?>
</section>

<section id="galeria-restauracion" class="bg-primary" aria-labelledby="galeria-restauracion-heading">
    <div class="narrow-container">
        <h2 id="galeria-restauracion-heading">Trabajos de restauración</h2>
        <h3>Restauración y tapizado en cuero de tresillo de madera clásico.</h3>
        <div class="gallery" aria-label="Galería de imágenes de restauración de tresillo de madera clásico">
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_madera_y_tapizado_cuero_antes_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_madera_y_tapizado_cuero_antes_small.webp"
                        alt="Tresillo de madera clásico antes de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Tresillo de madera clásico antes de la restauración</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_madera_y_tapizado_cuero_despues_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_madera_y_tapizado_cuero_despues_small.webp"
                        alt="Tresillo de madera clásico después de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Tresillo de madera clásico después de la restauración</figcaption>
            </figure>
        </div>
        <h3>Restauración y tintado de sillas de cuero.</h3>
        <div class="gallery" aria-label="Galería de imágenes de restauración de sillas de cuero.">
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_piel_antes_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_piel_antes_small.webp"
                        alt="Sillas de cuero antes de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Sillas de cuero antes de la restauración</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_piel_despues_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_piel_despues_small.webp"
                        alt="Sillas de cuero después de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Sillas de cuero después de la restauración</figcaption>
            </figure>
        </div>
        <h3>Restauración, reparación y tapizado de sillas de madera</h3>
        <div class="gallery" aria-label="Galería de imágenes de restauración de sillas de madera.">
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_y_tapizado_de_sillas_antes_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_y_tapizado_de_sillas_antes_small.webp"
                        alt="Sillas de madera antes de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Sillas de madera antes de la restauración</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_y_tapizado_de_sillas_despues_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_y_tapizado_de_sillas_despues_small.webp"
                        alt="Sillas de madera después de la restauración" loading="lazy" decoding="async"></a>
                <figcaption>Sillas de madera después de la restauración</figcaption>
            </figure>
        </div>
        <h3>Otros muebles clásicos restaurados</h3>
        <div class="gallery" aria-label="Galería de otros muebles clásicos restaurados.">
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Restauracion_muebles_de_mas_de_120_anos_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Restauracion_muebles_de_mas_de_120_anos_small.webp"
                        alt="Muebles de más de 120 años completamente restaurados." loading="lazy" decoding="async"></a>
                <figcaption>Muebles de más de 120 años completamente restaurados</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/restauracion/large/Tocador_y_mesa_de_noche_large.webp" target="_blank" rel="noopener noreferrer">
                    <img src="/assets/img/galeria/restauracion/small/Tocador_y_mesa_de_noche_small.webp"
                        alt="Tocador y mesa de noche restauradas." loading="lazy" decoding="async"></a>
                <figcaption>Tocador y mesa de noche restauradas</figcaption>
            </figure>
        </div>
    </div>
</section>

<section id="galeria-profesionales" class="section--narrow">
    <h2>Trabajos para comercios y organismos públicos</h2>
    <p>Pequeña muestra de algunos trabajados realizados para hostelería, así como para organismos públicos.</p>
    <div class="gallery" aria-label="Galería de imágenes de trabajos realizados para comercios y organismos públicos">
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Clinica_2_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Clinica_2_small.webp"
                    alt="Sillas en sala de espera para clínica en Santa Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Sillas en sala de espera para clínica en Santa Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Campo_fulbol_2_OADLL_2_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Campo_fulbol_2_OADLL_2_small.webp"
                    alt="Protectores para campo de fútbol." loading="lazy" decoding="async"></a>
            <figcaption>Protectores para campo de fútbol</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Cancha_baloncesto_Bajamar_2_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Cancha_baloncesto_Bajamar_2_small.webp"
                    alt="Protectores para cancha de baloncesto." loading="lazy" decoding="async"></a>
            <figcaption>Protectores para cancha de baloncesto</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Edificio_multiples_2_Gobierno_de_Canarias_1_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Edificio_multiples_2_Gobierno_de_Canarias_1_small.webp"
                    alt="Tapizado de sillas para Edificio Usos Múltiples 2, Gobierno de Canarias." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado de sillas para Edificio Usos Múltiples 2, Gobierno de Canarias.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Clinica_3_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Clinica_3_small.webp"
                    alt="Asientos en sala de espera para clínica en Santa Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Asientos en sala de espera para clínica en Santa Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Exconvento_Santo_Domingo_Ayuntamiento_de_La_Laguna_2_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Exconvento_Santo_Domingo_Ayuntamiento_de_La_Laguna_2_small.webp"
                    alt="Sillas tapizadas para sala del Exconvento de Santo Domingo" loading="lazy" decoding="async"></a>
            <figcaption>Sillas tapizadas para sala del Exconvento de Santo Domingo</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/La_taperia_3_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/La_taperia_3_small.webp"
                    alt="Tapizado para mesas en La Tapería, Puerto de la Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado para mesas en La Tapería, Puerto de la Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Museo_de_la_Ciencia_y_el_Cosmos_OA_Museos_y_Centros_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Museo_de_la_Ciencia_y_el_Cosmos_OA_Museos_y_Centros_small.webp"
                    alt="Tapizado de módulos para el Museo de la Ciencia y el Cosmos, La Laguna." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado de módulos para el Museo de la Ciencia y el Cosmos, La Laguna.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Palmetlita_1_large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/galeria/profesionales/small/Palmetlita_1_small.webp"
                    alt="Tapizado de módulos de asientos para cafetería Palmelita, La Laguna." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado de módulos de asientos para cafetería Palmelita, La Laguna.</figcaption>
        </figure>
    </div>
</section>

<section id="galeria-fabricacion" class="bg-primary">
    <div class="narrow-container">
        <h2>Fabricación a medida</h2>
        <p>En esta galería se pueden apreciar algunos de nuestros trabajos fabricados a medida para empresas y particulares.</p>
        <h3>Proceso de fabricación de asientos para club social</h3>
        <div class="gallery" aria-label="Galería de imágenes de trabajos de fabricación a medida para particulares y empresas">
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Club_social_1_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Club_social_1_small.webp"
                        alt="Proceso de fabricación de asientos para club social - Estructura de madera" loading="lazy" decoding="async"></a>
                <figcaption>Proceso de fabricación de asientos para club social - Estructura de madera</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Club_social_2_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Club_social_2_small.webp"
                        alt="Proceso de fabricación de asientos para club social - Gomas" loading="lazy" decoding="async"></a>
                <figcaption>Proceso de fabricación de asientos para club social - Gomas</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Club_social_3_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Club_social_3_small.webp"
                        alt="Proceso de fabricación de asientos para club social - Tapizado frontal" loading="lazy" decoding="async"></a>
                <figcaption>Proceso de fabricación de asientos para club social - Tapizado frontal</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Club_social_4_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Club_social_4_small.webp"
                        alt="Proceso de fabricación de asientos para club social - Tapizado trasero" loading="lazy" decoding="async"></a>
                <figcaption>Proceso de fabricación de asientos para club social - Tapizado trasero</figcaption>
            </figure>
        </div>
        <h3>Colchón plegable para furgo camperizada</h3>
        <div class="gallery" aria-label="Galería de imágenes de trabajos de fabricación a medida para particulares y profesionales">
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_1_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_1_small.webp"
                        alt="Colchón plegable para furgo camperizada - Colchón plegado" loading="lazy" decoding="async"></a>
                <figcaption>Colchón plegable para furgo camperizada - Detalle mecanismo</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_2_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_2_small.webp"
                        alt="Colchón plegable para furgo camperizada - Colchón desplegado" loading="lazy" decoding="async"></a>
                <figcaption>Colchón plegable para furgo camperizada - Colchón desplegado</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_3_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_3_small.webp"
                        alt="Colchón plegable para furgo camperizada - Detalle mecanismo" loading="lazy" decoding="async"></a>
                <figcaption>Colchón plegable para furgo camperizada - Colchón plegado</figcaption>
            </figure>
        </div>
        <h3>Modificación de tresillo a sofá de dos plazas</h3>
        <div class="gallery" aria-label="Galería de imágenes de trabajos de fabricación a medida para particulares y profesionales">
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Modificacion_tres_plazas_a_dos_plazas_1_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Modificacion_tres_plazas_a_dos_plazas_1_small.webp"
                        alt="Modificación de tresillo - antes sofá de tres plazas" loading="lazy" decoding="async"></a>
                <figcaption>Antes era un sofá de tres plazas</figcaption>
            </figure>
            <figure>
                <a href="/assets/img/galeria/fabricacion/large/Modificacion_tres_plazas_a_dos_plazas_2_large.webp" target="_blank" rel="noopener noreferrer"><img src="/assets/img/galeria/fabricacion/small/Modificacion_tres_plazas_a_dos_plazas_2_small.webp"
                        alt="Modificación de tresillo - después sofá de dos plazas" loading="lazy" decoding="async"></a>
                <figcaption>Después pasó a ser un sofá de dos plazas</figcaption>
            </figure>
        </div>
    </div>

</section>

<?php include __DIR__ . '/app/views/sections/contacto-faq.php'; ?>

<?php include __DIR__ . '/app/views/layout/footer.php'; ?>