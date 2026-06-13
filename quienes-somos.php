<?php
$pageTitle = "Quiénes somos | Taller familiar de tapicería en Tenerife";
$pageDescription = "Conoce la historia de Madaya, un taller familiar de tapicería en Tenerife con tradición artesanal, relevo generacional y compromiso con la restauración de muebles.";
require_once __DIR__ . '/app/config/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/quienes-somos/';
include __DIR__ . '/app/views/layout/header.php';
?>

<section class="section--narrow" aria-labelledby="quienes-heading">
    <h1 id="quienes-heading">Quiénes somos</h1>
    <p>Madaya es un <strong>taller familiar de tapicería y restauración</strong> en el que conviven oficio, cercanía y respeto por las cosas bien hechas. Creemos en recuperar antes que sustituir: en devolver comodidad, utilidad y belleza a piezas que todavía tienen mucho que ofrecer.</p>
    <p>Detrás de cada trabajo hay una forma de entender la profesión que combina <strong>experiencia artesanal, atención personalizada y una mirada sostenible</strong>. Tapizamos, restauramos y fabricamos a medida con el objetivo de que cada mueble encaje en la vida real de quien lo va a usar.</p>
</section>

<section class="bg-primary" aria-labelledby="historia-heading">
    <h2 id="historia-heading">Nuestra historia</h2>
    <div class="history-grid">
        <div>
            <p>La historia de <strong>Tapizados Madaya</strong> empieza en Tenerife en los años setenta, cuando <strong>Jesús</strong> aprendió el oficio desde abajo, comenzando como pinche y formándose hasta convertirse en <strong>maestro tapicero</strong>. A partir de ahí llegaría su propio taller: un espacio levantado con constancia, oficio y muchas horas de trabajo manual.</p>
            <p>En ese proyecto también tuvo un papel fundamental <strong>Coromoto</strong>, costurera del taller y parte esencial del trabajo diario. Entre estructuras, rellenos, telas y acabados, la tapicería fue creciendo como un oficio compartido dentro de la familia y como una manera honesta de ganarse la vida con las manos.</p>
        </div>
        <figure>
            <img src="/assets/img/quienes-somos/maestro_tapicero_small.webp" alt="Jesús trabajando en el taller en sus inicios como tapicero" loading="lazy" decoding="async">
            <figcaption>Jesús en sus primeros años de oficio dentro del taller.</figcaption>
        </figure>
    </div>
    <div class="history-grid history-grid--reverse">
        <figure>
            <img src="/assets/img/quienes-somos/taller_2_small.webp" alt="Imagen del trabajo artesanal en el taller de tapicería Madaya" loading="lazy" decoding="async">
            <figcaption>El oficio continúa hoy en el taller con una nueva generación de tapiceras.</figcaption>
        </figure>
        <div>
            <p>Con el tiempo, el taller vivió un <strong>relevo generacional natural</strong>. Primero se incorporó <strong>Vanesa</strong>, que terminó formándose también como tapicera, y más adelante se sumó <strong>Nazaret</strong>, consolidando así la continuidad familiar del oficio. Las dos hermanas crecieron entre telas, herramientas, máquinas de coser y materiales de tapicería, vinculadas al taller mucho antes de dedicarse profesionalmente a él.</p>
            <p>Tras la jubilación de sus padres, <strong>la tapicería quedó en manos de las dos hermanas</strong>, que hoy continúan el trabajo con el mismo respeto por la profesión, la misma cercanía con cada cliente y la misma convicción de que un buen mueble merece una segunda vida.</p>
        </div>
    </div>
</section>

<section class="section--narrow" aria-labelledby="valores-heading">
    <h2 id="valores-heading">Nuestros Valores</h2>
    <dl class="values-list">
        <div class="value-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                <path d="M1.4 1.7c.217.289.65.84 1.725 1.274 1.093.44 2.885.774 5.834.528 2.02-.168 3.431.51 4.326 1.556C14.161 6.082 14.5 7.41 14.5 8.5q0 .344-.027.734C13.387 8.252 11.877 7.76 10.39 7.5c-2.016-.288-4.188-.445-5.59-2.045-.142-.162-.402-.102-.379.112.108.985 1.104 1.82 1.844 2.308 2.37 1.566 5.772-.118 7.6 3.071.505.8 1.374 2.7 1.75 4.292.07.298-.066.611-.354.715a.7.7 0 0 1-.161.042 1 1 0 0 1-1.08-.794c-.13-.97-.396-1.913-.868-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.124-.887-1.889-2.095-2.39-3.383-1-2.562-1-5.536-.65-7.28L.73.806z" />
            </svg>
            <dt>Sostenibilidad</dt>
            <dd>Apostamos por el reciclaje y la reutilización de muebles, reduciendo el impacto ambiental.</dd>
        </div>
        <div class="value-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z" />
                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
            </svg>
            <dt>Calidad</dt>
            <dd>Utilizamos materiales de primera calidad y técnicas artesanales para garantizar resultados duraderos.</dd>
        </div>
        <div class="value-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                <path d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61zm2.5 10a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0m7 0a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
            </svg>
            <dt>Personalización</dt>
            <dd>Cada proyecto es único, adaptándonos a las necesidades y gustos de nuestros clientes.</dd>
        </div>
        <div class="value-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0" />
            </svg>
            <dt>Compromiso</dt>
            <dd>Nos comprometemos a ofrecer un servicio cercano, transparente y satisfactorio.</dd>
        </div>
    </dl>
</section>

<?php include __DIR__ . '/app/views/sections/pide-presupuesto.php'; ?>

<?php include __DIR__ . '/app/views/sections/resuelve-dudas.php'; ?>

<?php
include __DIR__ . '/app/views/layout/footer.php';
?>