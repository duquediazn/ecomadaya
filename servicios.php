<?php
$pageTitle = "Servicios de tapicería en Tenerife";
$pageDescription = "Descubre los servicios de tapicería y restauración de muebles que ofrecemos en Tapizados Madaya, Tenerife. Desde tapizado para el hogar hasta proyectos para profesionales y fabricación a medida.";
require_once __DIR__ . '/app/config/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/servicios/';

$servicesHasExternalMediaConsent = madayaHasExternalMediaConsent();
$servicesExternalMediaReturnTo = '/servicios.php#video-aquaclean';
$servicesEscape = static function (string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};

include __DIR__ . '/app/views/layout/header.php';
?>

<section id="hogar" class="section--narrow" aria-labelledby="servicios-heading">
    <h1 id="servicios-heading">Servicios de Tapicería y Restauración</h1>
    <h2 id="hogar-heading">Tapicería y restauración para el hogar</h2>
    <p>En <strong>Madaya</strong> recuperamos el estilo y la comodidad de tus muebles mediante técnicas artesanales y materiales de alta calidad.
        Tapizamos y restauramos <strong>sofás, sillas, butacas, cabeceros y cualquier mueble</strong> que necesite una nueva vida.</p>
    <h3>¿Qué podemos hacer por ti?</h3>
    <ul>
        <li><strong>Cambio de gomas y rellenos</strong> para mayor confort.</li>
        <li><strong>Reparación y tratamiento de madera</strong> para garantizar resistencia y durabilidad.</li>
    </ul>
    <p>Tras nuestro trabajo, tu mueble lucirá <strong>como nuevo</strong>, respetando su diseño original y mejorando su funcionalidad.</p>

    <h3>Tapicería general</h3>
    <div class="gallery" aria-label="Galería de tapicería para el hogar">
        <figure>
            <a href="/assets/img/servicios/sofa1-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/sofa1-small.webp" alt="Sofá tapizado en taller" loading="lazy" decoding="async">
            </a>
            <figcaption>Sofá tapizado en taller</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/butacas1-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/butacas1-small.webp" alt="Conjunto de butacas restauradas" loading="lazy" decoding="async">
            </a>
            <figcaption>Conjunto de butacas restauradas</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/sillas1-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/sillas1-small.webp" alt="Sillas tapizadas en tela ecológica" loading="lazy" decoding="async">
            </a>
            <figcaption>Sillas tapizadas en tela ecológica</figcaption>
        </figure>
    </div>
    <a href="/galeria.php#galeria-hogar" class="btn btn--small btn--primary" aria-label="Ver más fotos de tapicería para el hogar">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
        </svg>
        Ver más en galería
    </a>

    <h3>Restauración</h3>
    <p>Restauración y tapizado de pequeña butaca clásica, antes y después.</p>
    <div class="gallery" aria-label="Galería de restauración y tapizado para el hogar">
        <figure>
            <a href="/assets/img/servicios/butaca-antes-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/butaca-antes-small.webp" alt="Butaca clásica antes de la restauración" loading="lazy" decoding="async">
            </a>
            <figcaption>Butaca clásica antes de la restauración</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/butaca-despues-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/butaca-despues-small.webp" alt="Butaca restaurada tras tapizado" loading="lazy" decoding="async">
            </a>
            <figcaption>Butaca restaurada tras tapizado</figcaption>
        </figure>
    </div>
    <a href="/galeria.php#galeria-restauracion" class="btn btn--small btn--primary" aria-label="Ver más fotos de restauración para el hogar">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
        </svg>
        Ver más en galería
    </a>
</section>


<section id="profesionales" class="section--narrow" aria-labelledby="profesionales-heading">
    <h2 id="profesionales-heading">Comercios y Organismos Públicos</h2>
    <p><strong>Con más de 40 años de experiencia</strong>, colaboramos con todo tipo de negocios y entidades públicas:</p>
    <ul>
        <li>Hoteles, restaurantes y centros comerciales.</li>
        <li>Productoras audiovisuales.</li>
        <li>Asociaciones y organismos públicos.</li>
    </ul>
    <p> Entre nuestros clientes se encuentran el <strong>Ayuntamiento de La Laguna</strong> y el <strong>Gobierno de Canarias</strong>,
        que confían en nuestros acabados profesionales y en la personalización de cada proyecto.</p>

    <div class="gallery" aria-label="Galería de trabajos para profesionales y organismos públicos">
        <figure>
            <a href="/assets/img/servicios/Aiko1-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/Aiko1-small.webp" alt="Paneles de pared acolchados y asientos para restaurante Aiko" loading="lazy" decoding="async">
            </a>
            <figcaption>Paneles de pared acolchados y asientos para restaurante Aiko.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/Aiko2-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/Aiko2-small.webp" alt="Vista de los paneles acolchados instalados y asientos del restaurante Aiko" loading="lazy" decoding="async">
            </a>
            <figcaption>Paneles acolchados fijados y asientos colocados en restaurente Aiko</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/Campo_futbol_2 OADLL_1-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/Campo_futbol_2 OADLL_1-small.webp" alt="Protectores en postes de campo de fútbol de OADLL" loading="lazy" decoding="async">
            </a>
            <figcaption>Protectores en postes de campo de fútbol, OADLL.</figcaption>
        </figure>
    </div>
    <a href="/galeria.php#galeria-profesionales" class="btn btn--small btn--primary" aria-label="Ver más fotos de trabajos para profesionales y organismos públicos">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
        </svg>
        Ver más en galería
    </a>
</section>



<section id="fabricacion" class="section--narrow">
    <h2>Fabricación a Medida</h2>
    <p>Creamos muebles personalizados adaptados a tus necesidades y a tu espacio.</p>
    <h3>Ventajas</h3>
    <ul>
        <li>Materiales premium, seleccionados para garantizar durabilidad.</li>
        <li>Asesoramiento profesional para elegir tejidos y acabados.</li>
    </ul>
    <p>Transformamos tus ideas en piezas únicas hechas a medida, combinando funcionalidad, sostenibilidad y diseño.</p>

    <div class="gallery" aria-label="Galería de muebles fabricados a medida">
        <figure>
            <a href="/assets/img/servicios/Cabecero_blanco-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/Cabecero_blanco-small.webp" alt="Cabecero tapizado en tela aquaclean blanco fabricado a medida" loading="lazy" decoding="async">
            </a>
            <figcaption>Cabecero tapizado en tela aquaclean, fabricado a medida.</figcaption>
        </figure>
        <figure>
            <a href="/assets/img/servicios/Colchon-camper3-large.webp" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/Colchon-camper3-small.webp" alt="Colchón plegable con forro para furgoneta camperizada fabricado a medida" loading="lazy" decoding="async">
            </a>
            <figcaption>Colchón plegable con forro para furgoneta camperizada.</figcaption>
        </figure>
    </div>
    <a href="/galeria.php#galeria-fabricacion" class="btn btn--small btn--primary" aria-label="Ver más fotos de muebles fabricados a medida">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
        </svg>
        Ver más en galería
    </a>
</section>

<section id="catalogos" class="bg-primary">
    <div class="narrow-container">
        <h2>Catálogos de Tejidos</h2>
        <p>Disponemos de una amplia variedad de tejidos para adaptarnos a todos los gustos, estilos y presupuestos.</p>

        <h3>Tejidos ecológicos y sostenibles</h3>
        <p>Trabajamos con proveedores que apuestan por la innovación verde con tecnologías de limpieza como <strong>stain free</strong> y
            <strong><a class="
        link-secondary" href="https://www.aquaclean.com/es/que-es-aquaclean/" target="_blank" rel="noopener noreferrer">aquaclean</a></strong>,
            o certificaciones internacioles como:
        </p>
        <ul>
            <li><strong><a class="link-secondary" href="https://www.aitex.es/certificado-oeko-tex-standard-100/" rel="noopener noreferrer" target="_blank">OEKO-TEX® Standard 100</a></strong> – Sin sustancias nocivas.</li>
            <li><strong><a class="link-secondary" href="https://www.aquaclean.com/es/safe-front/safe-front-en-todas-partes/" rel="noopener noreferrer" target="_blank">SAFE FRONT®</a></strong> – Protección contra virus, bacterias y alérgenos.</li>
            <li><strong><a class="link-secondary" href="https://www.v-label.com/es/" rel="noopener noreferrer" target="_blank">V-LABEL</a></strong> – Certificación de tejidos veganos.</li>
            <li><strong><a class="link-secondary" href="https://www.controlunion.com/certification-program/grs-global-recycled-standard/" rel="noopener noreferrer" target="_blank">GRS (Global Recycled Standard)</a></strong> – Materiales reciclados con garantía.</li>
            <li><strong><a class="link-secondary" href="https://www.imo.org/" rel="noopener noreferrer" target="_blank">IMO</a></strong> – Seguridad ignífuga certificada.</li>
        </ul>

        <div class="cert-grid">
            <a href="https://www.aitex.es/certificado-oeko-tex-standard-100/" title="Abrir sitio oficial Aitex - certificado Oeko Tex Standard 100" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/STANDARD_100C.webp" alt="Logo del certificado textil OEKO-TEX STANDARD 100" loading="lazy" height="100px" width="151px">
            </a>
            <a href="https://www.aquaclean.com/es/safe-front/safe-front-en-todas-partes/" title="Abrir sitio oficial aquaclean - Safe Front" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/safefront.webp" alt="Logo del certificado SAFE FRONT HYGIENE PROTECTOR" loading="lazy" height="100px" width="100px">
            </a>
            <a href="https://www.v-label.com/es/" title="Abrir sitio oficial V-Label" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/v-label.webp" alt="Logo de V-LABEL EUROPEAN VEGETARIAN UNION" loading="lazy" height="100px" width="100px">
            </a>
            <a href="https://www.controlunion.com/certification-program/grs-global-recycled-standard/" title="Abrir sitio oficial certificado GRS" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/GRS.webp" alt="Logo de GRS (Global Recycled Standard)" loading="lazy" height="100px" width="199px">
            </a>
            <a href="https://www.aquaclean.com/es/aquaclean-group/medioambiente/" title="Abrir sitio oficial aquaclean" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/pfcfree.webp" alt="Logo PFC FREE" loading="lazy" height="100px" width="100px">
            </a>
            <a href="https://www.imo.org/" title="Abrir sitio oficial IMO" target="_blank" rel="noopener noreferrer">
                <img src="/assets/img/servicios/imo.webp" alt="Logo de IMO, certificación de seguridad contra incendios." loading="lazy" height="100px" width="68px">
            </a>
        </div>

        <p>Puedes consultar los catálogos oficiales o visualizar cómo quedaría tu mueble tapizado con el <strong>simulador de sofás</strong>:</p>
        <div class="cta-buttons">
            <a href="https://www.aquaclean.com/es-es/elige-tu-tela" class="btn btn--secondary link-dark" aria-label="Abrir colección aquaclean en nueva pestaña" target="_blank" rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
                Colección aquaclean®
            </a>
            <a href="https://www.aquaclean.com/es/simulador-aquaclean/" class="btn btn--secondary link-dark" aria-label="Abrir simulador de sofás en nueva pestaña" target="_blank" rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3" />
                    <path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z" />
                    <path d="M4 18v2" />
                    <path d="M20 18v2" />
                    <path d="M12 4v9" />
                </svg>
                Simulador de sofás
            </a>
        </div>

        <h3>Tejidos convencionales</h3>
        <p>También ofrecemos tejidos clásicos, sin tantas certificaciones, ideales para estilos tradicionales o presupuestos ajustados.
            Puedes explorar nuestros catálogos en el <a class="link-secondary" href="https://maps.app.goo.gl/JrKcn4j2A7xQ6T3N9" target="_blank" rel="noopener noreferrer">taller</a>, o si lo prefieres, podemos <strong> visitarte a domicilio</strong> para ayudarte a elegir <strong>sin compromiso</strong>.</p>
    </div>

</section>

<section id="video-aquaclean" class="section--narrow">
    <h2>¿Tecnologías para la limpieza?</h2>
    <p>Los tejidos de aquaclean® incorporan una doble protección higiénica:</p>
    <h3>Safe Front®</h3>
    <p>Reduce la actividad de virus y bacterias en más del 91%.</p>
    <h3>Tecnología aquaclean®</h3>
    <p>Evita que la suciedad penetre en el tejido, facilitando la limpieza incluso años después.</p>
    <h3>Vídeo: Aquaclean vs tejidos convencionales</h3>
    <div id="servicios-video-embed-slot">
        <?php if ($servicesHasExternalMediaConsent): ?>
            <iframe
                width="560"
                height="315"
                src="https://www.youtube-nocookie.com/embed/a5mvZu1pyKs?si=3hsem1-deYrXWdcb"
                title="Video comparativo de Aquaclean frente a tejidos convencionales"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen></iframe>
        <?php else: ?>
            <p>El vídeo está desactivado hasta que aceptes la carga de contenido externo.</p>
            <form class="consent-form"
                method="post"
                action="/api/consentimiento-embeds.php"
                data-external-media-consent-form
                data-embed-target="servicios-video-embed-slot"
                data-embed-width="560"
                data-embed-height="315"
                data-cookie-name="<?php echo $servicesEscape(MADAYA_EXTERNAL_MEDIA_CONSENT_COOKIE); ?>"
                data-cookie-max-age="<?php echo $servicesEscape((string) MADAYA_EXTERNAL_MEDIA_CONSENT_MAX_AGE); ?>">
                <input type="hidden" name="decision" value="accept">
                <input type="hidden" name="return_to" value="<?php echo $servicesEscape($servicesExternalMediaReturnTo); ?>">
                <input type="hidden" name="embed_src" value="https://www.youtube-nocookie.com/embed/a5mvZu1pyKs?si=3hsem1-deYrXWdcb">
                <input type="hidden" name="embed_title" value="Video comparativo de Aquaclean frente a tejidos convencionales">
                <button type="submit" class="btn btn--small btn--primary">Aceptar y cargar vídeo</button>
            </form>
            <p><a class="link-primary" href="/politica-cookies/">Ver política de cookies</a></p>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/app/views/sections/reviews.php'; ?>

<?php include __DIR__ . '/app/views/sections/contacto-faq.php'; ?>

<?php include __DIR__ . '/app/views/layout/footer.php'; ?>