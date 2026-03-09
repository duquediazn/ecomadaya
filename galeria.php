<?php
$pageTitle = "Galería de trabajos realizados";
$pageDescription = "Galería de imágenes de los trabajos realizados por Tapizados Madaya en Tenerife. Descubre la calidad y el detalle de nuestros servicios de tapicería y restauración de muebles a través de esta selección de proyectos finalizados.";
include 'includes/header.php';

$basePath = __DIR__ . '/assets/img/galeria/hogar/';
$dirSmall = $basePath . 'small';
$dirLarge = $basePath . 'large';
$publicBasePath = '/assets/img/galeria/hogar';
$publicSmallPath = $publicBasePath . '/small';
$publicLargePath = $publicBasePath . '/large';
$descriptionsPath = $basePath . 'descripciones.json';

$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

require_once __DIR__ . '/includes/gallery-service.php';

$galleryData = buildGalleryItems($dirSmall, $dirLarge, $allowedExt, $descriptionsPath);
$validGalleryItems = $galleryData['items'];
?>

<section id="galeria-hogar" class="section--narrow">
    <h1>Galería de Trabajos Realizados</h1>
    <p>Descubre la calidad y el detalle de nuestros servicios de tapicería y restauración de muebles a través de esta selección de proyectos finalizados.</p>
    
    <h2>Tapicería general</h2>
    <p>En esta galería encontrarás una amplia selección de algunos de nuestros más recientes trabajos de tapicería para el hogar.</p>
    <p>Haz click sobre las imágenes para verlas en más detalle.</p>
    <div class="gallery" aria-label="Galería de imágenes de trabajos realizados para particulares">
    <?php
        foreach ($validGalleryItems as $item) {
            $smallUrl = htmlspecialchars($publicSmallPath . '/' . $item['small'], ENT_QUOTES, 'UTF-8');
            $largeUrl = htmlspecialchars($publicLargePath . '/' . $item['large'], ENT_QUOTES, 'UTF-8');
            $description = (string) $item['description'];
            $altText = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');

            echo '<figure>
                    <a href="' . $largeUrl . '"><img src="' . $smallUrl . '" alt="' . $altText . '" loading="lazy" decoding="async"></a>
                    <figcaption>' . $altText . '</figcaption>
                </figure>';
        }

        if (count($validGalleryItems) === 0) {
            echo '<p>No hay imágenes disponibles en este momento. Si quieres ver más trabajos, puedes escribirnos desde <a href="/contacto.php">contacto</a>.</p>';
        }
    ?>
    </div>
</section>

<section id="galeria-restauracion" class="bg-primary">
    <div class="narrow-container">
        <h2>Trabajos de restauración</h2>
    <h3>Restauración y tapizado en cuero de tresillo de madera clásico.</h3>
    <div class="gallery" aria-label="Galería de imágenes de restauración de tresillo de madera clásico">
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_madera_y_tapizado_cuero_antes_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_madera_y_tapizado_cuero_antes_small.webp" 
                alt="Tresillo de madera clásico antes de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Tresillo de madera clásico antes de la restauración</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_madera_y_tapizado_cuero_despues_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_madera_y_tapizado_cuero_despues_small.webp" 
                alt="Tresillo de madera clásico después de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Tresillo de madera clásico después de la restauración</figcaption>
        </figure>
    </div>
    <h3>Restauración y tintado de sillas de cuero.</h3>
    <div class="gallery" aria-label="Galería de imágenes de restauración de sillas de cuero.">
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_piel_antes_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_piel_antes_small.webp" 
                alt="Sillas de cuero antes de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Sillas de cuero antes de la restauración</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_piel_despues_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_piel_despues_small.webp" 
                alt="Sillas de cuero después de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Sillas de cuero después de la restauración</figcaption>
        </figure>
    </div>
    <h3>Restauración, reparación y tapizado de sillas de madera</h3>
        <div class="gallery" aria-label="Galería de imágenes de restauración de sillas de madera.">
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_y_tapizado_de_sillas_antes_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_y_tapizado_de_sillas_antes_small.webp" 
                alt="Sillas de madera antes de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Sillas de madera antes de la restauración</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_y_tapizado_de_sillas_despues_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_y_tapizado_de_sillas_despues_small.webp" 
                alt="Sillas de madera después de la restauración" loading="lazy" decoding="async"></a>
            <figcaption>Sillas de madera después de la restauración</figcaption>
        </figure>
    </div>
    <h3>Otros muebles clásicos restaurados</h3>
    <div class="gallery" aria-label="Galería de otros muebles clásicos restaurados.">
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Restauracion_muebles_de_mas_de_120_anos_large.webp">
                <img src="/assets/img/galeria/restauracion/small/Restauracion_muebles_de_mas_de_120_anos_small.webp"
                alt="Muebles de más de 120 años completamente restaurados." loading="lazy" decoding="async"></a>
            <figcaption>Muebles de más de 120 años completamente restaurados</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/restauracion/large/Tocador_y_mesa_de_noche_large.webp">
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
            <a href="/assets/img/galeria/profesionales/large/Clinica_2_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Clinica_2_small.webp" 
                alt="Sillas en sala de espera para clínica en Santa Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Sillas en sala de espera para clínica en Santa Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Campo_fulbol_2_OADLL_2_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Campo_fulbol_2_OADLL_2_small.webp" 
                alt="Protectores para campo de fútbol." loading="lazy" decoding="async"></a>
            <figcaption>Protectores para campo de fútbol</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Cancha_baloncesto_Bajamar_2_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Cancha_baloncesto_Bajamar_2_small.webp" 
                alt="Protectores para cancha de baloncesto." loading="lazy" decoding="async"></a>
            <figcaption>Protectores para cancha de baloncesto</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Edificio_multiples_2_Gobierno_de_Canarias_1_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Edificio_multiples_2_Gobierno_de_Canarias_1_small.webp" 
                alt="Tapizado de sillas para Edificio Usos Múltiples 2, Gobierno de Canarias." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado de sillas para Edificio Usos Múltiples 2, Gobierno de Canarias.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Clinica_3_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Clinica_3_small.webp" 
                alt="Asientos en sala de espera para clínica en Santa Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Asientos en sala de espera para clínica en Santa Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Exconvento_Santo_Domingo_Ayuntamiento_de_La_Laguna_2_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Exconvento_Santo_Domingo_Ayuntamiento_de_La_Laguna_2_small.webp" 
                alt="Sillas tapizadas para sala del Exconvento de Santo Domingo" loading="lazy" decoding="async"></a>
            <figcaption>Sillas tapizadas para sala del Exconvento de Santo Domingo</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/La_taperia_3_large.webp">
                <img src="/assets/img/galeria/profesionales/small/La_taperia_3_small.webp" 
                alt="Tapizado para mesas en La Tapería, Puerto de la Cruz." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado para mesas en La Tapería, Puerto de la Cruz.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Museo_de_la_Ciencia_y_el_Cosmos_OA_Museos_y_Centros_large.webp">
                <img src="/assets/img/galeria/profesionales/small/Museo_de_la_Ciencia_y_el_Cosmos_OA_Museos_y_Centros_small.webp" 
                alt="Tapizado de módulos para el Museo de la Ciencia y el Cosmos, La Laguna." loading="lazy" decoding="async"></a>
            <figcaption>Tapizado de módulos para el Museo de la Ciencia y el Cosmos, La Laguna.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/profesionales/large/Palmetlita_1_large.webp">
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
            <a href="/assets/img/galeria/fabricacion/large/Club_social_1_large.webp"><img src="/assets/img/galeria/fabricacion/small/Club_social_1_small.webp" 
            alt="Proceso de fabricación de asientos para club social - Estructura de madera" loading="lazy" decoding="async"></a>
            <figcaption>Proceso de fabricación de asientos para club social - Estructura de madera</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Club_social_2_large.webp"><img src="/assets/img/galeria/fabricacion/small/Club_social_2_small.webp" 
            alt="Proceso de fabricación de asientos para club social - Gomas" loading="lazy" decoding="async"></a>
            <figcaption>Proceso de fabricación de asientos para club social - Gomas</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Club_social_3_large.webp"><img src="/assets/img/galeria/fabricacion/small/Club_social_3_small.webp" 
            alt="Proceso de fabricación de asientos para club social - Tapizado frontal" loading="lazy" decoding="async"></a>
            <figcaption>Proceso de fabricación de asientos para club social - Tapizado frontal</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Club_social_4_large.webp"><img src="/assets/img/galeria/fabricacion/small/Club_social_4_small.webp" 
            alt="Proceso de fabricación de asientos para club social - Tapizado trasero" loading="lazy" decoding="async"></a>
            <figcaption>Proceso de fabricación de asientos para club social - Tapizado trasero</figcaption>
        </figure>
    </div>
    <h3>Colchón plegable para furgo camperizada</h3>
    <div class="gallery" aria-label="Galería de imágenes de trabajos de fabricación a medida para particulares y profesionales">
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_1_large.webp"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_1_small.webp" 
            alt="Colchón plegable para furgo camperizada - Colchón plegado" loading="lazy" decoding="async"></a>
            <figcaption>Colchón plegable para furgo camperizada - Detalle mecanismo</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_2_large.webp"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_2_small.webp" 
            alt="Colchón plegable para furgo camperizada - Colchón desplegado" loading="lazy" decoding="async"></a>
            <figcaption>Colchón plegable para furgo camperizada - Colchón desplegado</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Colchon_camper_3_large.webp"><img src="/assets/img/galeria/fabricacion/small/Colchon_camper_3_small.webp" 
            alt="Colchón plegable para furgo camperizada - Detalle mecanismo" loading="lazy" decoding="async"></a>
            <figcaption>Colchón plegable para furgo camperizada - Colchón plegado</figcaption>
        </figure>
    </div>
    <h3>Modificación de tresillo a sofá de dos plazas</h3>
    <div class="gallery" aria-label="Galería de imágenes de trabajos de fabricación a medida para particulares y profesionales">
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Modificacion_tres_plazas_a_dos_plazas_1_large.webp"><img src="/assets/img/galeria/fabricacion/small/Modificacion_tres_plazas_a_dos_plazas_1_small.webp" 
            alt="Modificación de tresillo - antes sofá de tres plazas" loading="lazy" decoding="async"></a>
            <figcaption>Antes era un sofá de tres plazas</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/galeria/fabricacion/large/Modificacion_tres_plazas_a_dos_plazas_2_large.webp"><img src="/assets/img/galeria/fabricacion/small/Modificacion_tres_plazas_a_dos_plazas_2_small.webp" 
            alt="Modificación de tresillo - después sofá de dos plazas" loading="lazy" decoding="async"></a>
            <figcaption>Después pasó a ser un sofá de dos plazas</figcaption>
        </figure>
    </div>
    </div>
    
</section>

<section id="contacto-faq" class="section--narrow">
    <h2>¿Quieres asesoramiento o un presupuesto?</h2>
    <p>Si deseas tapizar un mueble, restaurarlo o fabricar uno a medida, <strong>contáctanos.</strong></p>
    <p>Estaremos encantadas de ayudarte.</p>
    <div class="cta-buttons">
        <a href="/contacto.php" class="btn btn--primary light-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
            </svg>
            Pedir presupuesto</a>
        <a href="/contacto.php" class="btn btn--secondary light-dark" aria-label="Ver contacto">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
        </svg>
        Ver contacto
    </a>
    </div>
    
    <h3>¿Aún tienes dudas?</h3>
    <p>Consulta nuestras nuestra sección de Preguntas Frecuentes.</p>
    <a href="/preguntas-frecuentes.php" class="btn btn--primary light-link" aria-label="Ir a preguntas frecuentes">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
        </svg>
        Ver preguntas frecuentes (FAQ)
    </a>
</section>

<?php include 'includes/footer.php'; ?>