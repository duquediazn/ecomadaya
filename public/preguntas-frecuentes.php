<?php
$pageTitle = "Preguntas frecuentes de tapicería en Tenerife | Madaya";
$pageDescription = "Resuelve dudas sobre tapicería y restauración en Tenerife: precios orientativos, tejidos, plazos, recogida, entrega y mantenimiento en Tapizados Madaya.";
require_once __DIR__ . '/../app/includes/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/preguntas-frecuentes/';
include __DIR__ . '/../app/includes/header.php';
?>

<section class="section--faq" aria-labelledby="faq-heading">
    <h1 id="faq-heading">Preguntas frecuentes de tapicería en Tenerife</h1>
    <p>Aquí encontrarás respuestas rápidas sobre tapicería, restauración, tejidos, presupuestos y plazos de trabajo. Si no ves tu caso, puedes escribirnos por <a href="<?php echo $whatsAppBudgetUrl; ?>" class="link-primary">WhatsApp</a> o visitar nuestra página de <a href="/contacto.php" class="link-primary">contacto</a>.</p>

    <h2 id="faq-tapiceria">Tapicería y restauración</h2>
    <div class="section--faq__box">
        <details>
            <summary>1. ¿Qué muebles puedo tapizar o restaurar con Madaya?</summary>
            Trabajamos con sofás, sillones, sillas, butacas, chaise longues, cabezales, muebles de madera y piezas antiguas. 
            Si tienes dudas sobre un mueble concreto, puedes enviarnos una foto por <a href="<?php echo $whatsAppBudgetUrl; ?>" class="link-primary">WhatsApp</a>.
        </details>
        <details>
            <summary>2. ¿Puedo conservar la estructura original de mi mueble?</summary>
            Sí. Siempre priorizamos conservar la estructura original siempre que sea segura y viable, especialmente en muebles antiguos o con valor sentimental.
        </details>
        <details>
            <summary>3. ¿Solo cambian la tela o también la espuma y el interior?</summary>
            Revisamos cada pieza y, si es necesario, realizamos cambios de goma/espuma y refuerzo interno para mejorar la comodidad y durabilidad del mueble.
        </details>
        <details>
        <summary>4. ¿Trabajan muebles antiguos o delicados?</summary>
            Sí. Tenemos más de 40 años de experiencia restaurando piezas antiguas respetando su diseño original.
        </details>
    </div>
    <h2 id="faq-materiales">Materiales y tejidos</h2>
    <div class="section--faq__box">
        <details>
            <summary>5. ¿Qué tejidos recomiendan para un sofá de uso diario?</summary>
            Recomendamos tejidos anti-manchas <strong>aquaclean®</strong>, por su facilidad de limpieza y durabilidad en hogares con niños o mascotas.
        </details>
        <details>
            <summary>6. ¿Tienen tejidos ecológicos o reciclados?</summary>
            Sí. Disponemos de catálogos con certificación OEKO-TEX, GRS y materiales reciclados respetuosos con el medio ambiente.
        </details>
        <details>
            <summary>7. ¿Puedo ver los catálogos de telas antes de decidirme?</summary>
            Claro. Puedes visitarnos en el taller para verlos en persona o concertar una visita para llevártelas y comprobarlas en tu casa.
        </details>
        <details>
        <summary>8. ¿Cómo puedo mantener mi mueble en buen estado después del tapizado?</summary>
            Te indicaremos las recomendaciones según el tejido elegido, especialmente si incorpora tecnología <strong>aquaclean®</strong>.
        </details>
    </div>
    <h2 id="faq-presupuestos">Presupuestos y precios</h2>
    <div class="section--faq__box">
        <details>
            <summary>9. ¿Cuánto cuesta tapizar un sofá o una silla?</summary>
            El precio depende del tamaño del mueble, del tipo de tejido y del estado de la pieza.
            A <strong>modo orientativo</strong>:
            
            <ul>
                <li><strong>Sillón o butaca:</strong> desde 250–350 €</li>
                <li><strong>Silla tapizada:</strong> desde 60–90 €</li>
                <li><strong>Sofá 2 plazas:</strong> desde 550–800 €</li>
                <li><strong>Sofá 3 plazas:</strong> desde 750–1.200 €</li>
                <li><strong>Chaise longue:</strong> desde 1.100–1.600 €</li>
                <li><strong>Conjuntos 3+2:</strong> desde 1.300–1.900 €</li>
            </ul>
            Estos rangos están basados en <strong>trabajos recientes (2025)</strong> realizados en nuestro taller.
            Para darte un precio exacto, solo necesitamos que nos envíes unas fotos; puedes hacerlo por <a href="<?php echo $whatsAppBudgetUrl; ?>" class="link-primary">WhatsApp</a>.
        </details>
        <details>
            <summary>10. ¿Hacen presupuestos sin compromiso?</summary>
           Sí. Todos nuestros presupuestos son gratuitos y sin compromiso. 
           Puedes enviarnos fotos del mueble por <a href="<?php echo $whatsAppBudgetUrl; ?>" class="link-primary">WhatsApp</a> o <a href="mailto:madayaartesanal@gmail.com" class="link-primary">correo electrónico</a> y te responderemos lo antes posible.
        </details>
        <details>
        <summary>11. ¿El precio incluye la tela?</summary>
            Puedes elegir entre:
            <ul>
                <li><strong>Presupuesto con tela incluida:</strong> seleccionando entre nuestro catálogo (aquaclean®, tejidos ecológicos, convencionales, exterior…).</li>
                <li><strong>Presupuesto usando tu propia tela:</strong> si prefieres aportarla tú.</li>
            </ul>
            En ambos casos, te asesoramos sobre la cantidad necesaria y la mejor opción para cada mueble.
        </details>
        <details>
        <summary>12. ¿Qué información necesitan para dar un presupuesto?</summary>
           Con lo siguiente es suficiente:
            <ul>
                <li>Fotos del mueble desde varios ángulos</li>
                <li>Medidas aproximadas (ancho, fondo, alto o largo en el caso de cojines)</li>
                <li>Si quieres tela incluida o aportar la tuya</li>
                <li>Estilo de tejido que te gustaría (aquaclean®, piel, exterior, convencional…)</li>
            </ul>
            Si lo prefieres, también podemos atenderte directamente en el taller o visitarte en tu domicilio.
        </details>
    </div>
    <h2 id="faq-plazos">Plazos y procesos de trabajo</h2>
    <div class="section--faq__box">
        <details>
            <summary>13. ¿Cuánto tarda un trabajo de tapicería?</summary>
            Depende del tipo de pieza, pero generalmente entre 7 y 20 días. Te informaremos del plazo exacto en el presupuesto.
        </details>
        <details>
            <summary>14. ¿Tienen lista de espera?</summary>
            En temporada alta es posible, pero siempre intentamos adaptarnos a tus necesidades.
        </details>
        <details>
            <summary>15. ¿Debo llevar yo el mueble al taller?</summary>
            Puedes traerlo tú o, si lo prefieres, podemos ofrecer recogida y entrega (según zona y disponibilidad).
        </details>
    </div>
    <h2 id="faq-entrega">Entrega y recogida</h2>
    <div class="section--faq__box">
        <details>
            <summary>16. ¿Pueden recoger y entregar el mueble en mi casa?</summary>
            Sí, ofrecemos este servicio en todo Tenerife. Confirmamos disponibilidad al realizar el presupuesto.
        </details>
        <details>
            <summary>17. ¿Debo preparar el mueble antes de entregarlo?</summary>
            Solo asegurarte de que esté accesible; nosotras nos encargamos del resto.
        </details>
    </div>
    <h2 id="faq-garantia">Garantía y cuidados</h2>
    <div class="section--faq__box">
        <details>
            <summary>18. ¿Tiene garantía el tapizado?</summary>
            Nuestros trabajos no incluyen una garantía legal como tal, pero sí ofrecemos un <strong>compromiso de revisión y corrección</strong> ante cualquier disconformidad dentro de un plazo razonable tras la entrega.
            Ten en cuenta que, en algunos muebles, <strong>no es posible comprobar el estado interno</strong> hasta que se desmontan en el taller. 
            Si durante el proceso aparece un problema oculto que afecta al trabajo, <strong>podría ser necesario ajustar el presupuesto final</strong>. 
            Esto se explica mejor en nuestras <a href="/condiciones-servicio.php">condiciones del servicio</a>.
        </details>
        <details>
            <summary>19. ¿Qué pasa si la tela se daña con el uso?</summary>
            Depende de la causa del daño:
            <ul>
                <li><strong>Problemas del tejido:</strong> Si el tejido tiene algún defecto propio (por ejemplo, una partida defectuosa del fabricante), revisamos el caso y lo gestionamos con la marca cuando procede.</li>
                <li><strong>Daños por uso o desgaste:</strong> Manchas, rozaduras, roturas, deterioro por mascotas o exposición al sol no están cubiertos, pero podemos ofrecerte soluciones como reparación, recolocación, refuerzos o cambio de la pieza afectada.</li>
            </ul>
            Siempre intentamos dar opciones para que el mueble siga teniendo la mayor vida útil posible.
        </details>
        <details>
            <summary>20. ¿Ofrecen mantenimiento o reparaciones posteriores?</summary>
            Sí. Podemos realizar varias intervenciones posteriores para conservar o mejorar tu mueble, como:
            <ul>
                <li>Reparación de costuras</li>
                <li>Cambios de gomas o espumas</li>
                <li>Refuerzo de cinchas o estructuras</li>
                <li>Reparación localizada de piezas tapizadas</li>
                <li>Ajustes en muebles que ya tienen años de uso</li>
            </ul>
            Si tienes una incidencia una vez pasado el tiempo, puedes consultarnos y te indicaremos la mejor solución.
        </details>
    </div>

</section>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "inLanguage": "es-ES",
    "url": "<?php echo $canonicalUrl; ?>",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "¿Qué muebles puedo tapizar o restaurar con Madaya?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Trabajamos con sofás, sillones, sillas, butacas, chaise longues, cabezales, muebles de madera y piezas antiguas. Si tienes dudas sobre un mueble concreto, puedes enviarnos una foto por WhatsApp."
            }
        },
        {
            "@type": "Question",
            "name": "¿Puedo conservar la estructura original de mi mueble?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí. Siempre priorizamos conservar la estructura original siempre que sea segura y viable, especialmente en muebles antiguos o con valor sentimental."
            }
        },
        {
            "@type": "Question",
            "name": "¿Solo cambian la tela o también la espuma y el interior?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Revisamos cada pieza y, si es necesario, realizamos cambios de goma/espuma y refuerzo interno para mejorar la comodidad y durabilidad del mueble."
            }
        },
        {
            "@type": "Question",
            "name": "¿Trabajan muebles antiguos o delicados?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí. Tenemos más de 40 años de experiencia restaurando piezas antiguas respetando su diseño original."
            }
        },
        {
            "@type": "Question",
            "name": "¿Qué tejidos recomiendan para un sofá de uso diario?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Recomendamos tejidos anti-manchas aquaclean®, por su facilidad de limpieza y durabilidad en hogares con niños o mascotas."
            }
        },
        {
            "@type": "Question",
            "name": "¿Tienen tejidos ecológicos o reciclados?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí. Disponemos de catálogos con certificación OEKO-TEX, GRS y materiales reciclados respetuosos con el medio ambiente."
            }
        },
        {
            "@type": "Question",
            "name": "¿Puedo ver los catálogos de telas antes de decidirme?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Claro. Puedes visitarnos en el taller para verlos en persona o concertar una visita para llevártelas y comprobarlas en tu casa."
            }
        },
        {
            "@type": "Question",
            "name": "¿Cómo puedo mantener mi mueble en buen estado después del tapizado?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Te indicaremos las recomendaciones según el tejido elegido, especialmente si incorpora tecnología aquaclean®."
            }
        },
        {
            "@type": "Question",
            "name": "¿Cuánto cuesta tapizar un sofá o una silla?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "El precio depende del tamaño del mueble, del tipo de tejido y del estado de la pieza. Como referencia orientativa, un sillón o butaca parte de 250 a 350 euros, una silla de 60 a 90 euros, un sofá de 2 plazas de 550 a 800 euros, un sofá de 3 plazas de 750 a 1.200 euros, un chaise longue de 1.100 a 1.600 euros y conjuntos 3+2 de 1.300 a 1.900 euros."
            }
        },
        {
            "@type": "Question",
            "name": "¿Hacen presupuestos sin compromiso?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí. Todos nuestros presupuestos son gratuitos y sin compromiso. Puedes enviarnos fotos del mueble por WhatsApp o correo electrónico y te responderemos lo antes posible."
            }
        },
        {
            "@type": "Question",
            "name": "¿El precio incluye la tela?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Puedes elegir presupuesto con tela incluida, seleccionando entre nuestro catálogo, o presupuesto usando tu propia tela. En ambos casos te asesoramos sobre cantidad y opción más adecuada."
            }
        },
        {
            "@type": "Question",
            "name": "¿Qué información necesitan para dar un presupuesto?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Necesitamos fotos del mueble desde varios ángulos, medidas aproximadas, saber si quieres tela incluida o aportar la tuya y el estilo de tejido deseado. También podemos atenderte directamente en el taller o visitarte en domicilio."
            }
        },
        {
            "@type": "Question",
            "name": "¿Cuánto tarda un trabajo de tapicería?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Depende del tipo de pieza, pero generalmente entre 7 y 20 días. Te informaremos del plazo exacto en el presupuesto."
            }
        },
        {
            "@type": "Question",
            "name": "¿Tienen lista de espera?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "En temporada alta es posible, pero siempre intentamos adaptarnos a tus necesidades."
            }
        },
        {
            "@type": "Question",
            "name": "¿Debo llevar yo el mueble al taller?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Puedes traerlo tú o, si lo prefieres, podemos ofrecer recogida y entrega según zona y disponibilidad."
            }
        },
        {
            "@type": "Question",
            "name": "¿Pueden recoger y entregar el mueble en mi casa?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí, ofrecemos este servicio en todo Tenerife. Confirmamos disponibilidad al realizar el presupuesto."
            }
        },
        {
            "@type": "Question",
            "name": "¿Debo preparar el mueble antes de entregarlo?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Solo asegurarte de que esté accesible; nosotras nos encargamos del resto."
            }
        },
        {
            "@type": "Question",
            "name": "¿Tiene garantía el tapizado?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "No incluye una garantía legal como tal, pero sí ofrecemos compromiso de revisión y corrección ante disconformidades en un plazo razonable tras la entrega. Si aparece un problema oculto al desmontar, puede ser necesario ajustar el presupuesto final."
            }
        },
        {
            "@type": "Question",
            "name": "¿Qué pasa si la tela se daña con el uso?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Depende de la causa: si hay defecto del tejido, revisamos y gestionamos con la marca cuando procede; en daños por uso o desgaste ofrecemos soluciones como reparación, recolocación, refuerzo o cambio de la pieza afectada."
            }
        },
        {
            "@type": "Question",
            "name": "¿Ofrecen mantenimiento o reparaciones posteriores?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Sí. Realizamos intervenciones posteriores para conservar o mejorar el mueble, como reparación de costuras, cambios de gomas o espumas, refuerzo de cinchas o estructuras y ajustes en muebles con años de uso."
            }
        }
    ]
}
</script>


<?php
include __DIR__ . '/../app/includes/footer.php';
?>