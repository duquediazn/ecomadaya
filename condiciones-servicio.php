<?php
$pageTitle = "Condiciones del servicio | Taller familiar de tapicería en Tenerife";
$pageDescription = "Consulta las condiciones del servicio de Madaya, un taller familiar de tapicería en Tenerife con tradición artesanal, relevo generacional y compromiso con la restauración de muebles.";
require_once __DIR__ . '/app/includes/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/condiciones-servicio/';
include __DIR__ . '/app/includes/header.php';
?>

<section class="section--narrow" aria-labelledby="condiciones-heading">
    <h1 id="condiciones-heading">Condiciones del servicio</h1>
    <p>En Madaya queremos ofrecer un servicio transparente, profesional y adaptado a las necesidades de cada cliente. A continuación detallamos nuestras condiciones de contratación para garantizar una comunicación clara y evitar malentendidos.</p>

    <h2 id="validez-heading">1. Validez del presupuesto</h2>
    <p>Los presupuestos emitidos tienen una validez de <strong>30 días naturales</strong>, salvo acuerdo previo entre las partes.</p>

    <h2 id="aceptacion-heading">2. Aceptación del presupuesto y señal inicial</h2>
    <p>Para iniciar los trabajos es necesario confirmar el presupuesto y abonar un <strong>50% del total</strong> en concepto de señal.
    El importe restante se abonará al finalizar el trabajo y antes de la entrega del mueble.</p>

    <h2 id="ajustes-heading">3. Ajustes del presupuesto por condiciones internas del mueble</h2>
    <p>En la revisión inicial del mueble <strong>no siempre es posible conocer el estado interno</strong> (espumas, cinchas, estructura, elementos ocultos…).</p>
    <p>Si durante el desmontaje o ejecución del trabajo se detectan problemas estructurales u otros daños no visibles en la inspección inicial:</p>
    <ul>
        <li>Se informará al cliente antes de continuar.</li>
        <li>Podrá ser necesario <strong>ajustar el presupuesto</strong> para cubrir materiales y mano de obra adicionales.</li>
        <li>El cliente podrá decidir si autoriza o no estos trabajos adicionales.</li>
    </ul>

    <h2 id="plazos-heading">4. Plazos de entrega</h2>
    <p>Los tiempos de entrega pueden variar según:</p>
    <ul>
        <li>Complejidad del trabajo</li>
        <li>Disponibilidad de materiales o tejidos</li>
        <li>Volumen de trabajo en el taller</li>
    </ul>

    <p>Antes de aceptar el presupuesto, informaremos de un plazo estimado. En caso de cambios justificados, se avisará al cliente.</p>

    <h2 id="limitaciones-heading">5. Limitaciones de responsabilidad sobre el uso del mueble</h2>
    <p>Con carácter general, no se consideran defectos del trabajo realizado:</p>
    <ul>
        <li>Daños derivados del uso normal o desgaste.</li>
        <li>Rozaduras, tirones, manchas o daños provocados por mascotas.</li>
        <li>Deterioro causado por exposición prolongada al sol o humedad.</li>
        <li>Roturas derivadas de un uso inadecuado o fuerza excesiva.</li>
    </ul>

    <p>En estos casos, podemos ofrecer soluciones de mantenimiento, reparación o sustitución de piezas.</p>

    <h2 id="tejidos-heading">6. Tejidos y materiales aportados por el cliente</h2>
    <p>Si el cliente aporta su propia tela:</p>
    <ul>
        <li>No podemos garantizar la durabilidad del tejido.</li>
        <li>No nos responsabilizamos de defectos de fábrica o desgaste prematuro.</li>
        <li>Si la cantidad aportada es insuficiente, se informará al cliente para aportar más material.</li>
    </ul>

    <h2 id="devoluciones-heading">7. Devoluciones, cancelaciones y modificaciones</h2>
    <ul>
        <li>Los trabajos ya iniciados no pueden cancelarse sin coste, dado que conllevan materiales y mano de obra.</li>
        <li>Si el cliente solicita modificaciones sobre lo ya realizado, se valorará el coste adicional.</li>
        <li>Dada la naturaleza personalizada de muchos trabajos (tapicería, fundas a medida o reparación artesanal), no existe un régimen general de devolución una vez iniciado o ejecutado el encargo, sin perjuicio de la revisión de posibles incidencias y de los derechos que puedan corresponder conforme a la normativa aplicable.</li>
    </ul>

    <h2 id="conflictos-heading">8. Conflictos y resolución</h2>
    <p>Ante cualquier desacuerdo, se intentará primero una solución amistosa entre las partes. En su caso, la persona consumidora podrá acudir a los sistemas de reclamación, mediación, arbitraje de consumo o a las vías legalmente previstas que resulten aplicables.</p>

    <h2 id="recogida-heading">9. Recogida y entrega a domicilio</h2>
    <p>Este servicio puede estar incluido o no en el presupuesto, según el caso. Se informará previamente al cliente.
    La recogida y entrega deben realizarse en condiciones adecuadas de accesibilidad.</p>

    <h2 id="custodia-heading">10. Custodia de muebles en el taller</h2>
    <p>Los muebles terminados deberán recogerse en un plazo razonable.
    En caso de retrasos prolongados no justificados, podrían aplicarse gastos razonables de almacenaje, previa información al cliente.</p>
</section>

<?php include __DIR__ . '/app/includes/footer.php'; ?>
