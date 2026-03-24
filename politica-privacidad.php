<?php
$pageTitle = "Politica de privacidad | Madaya";
$pageDescription = "Politica de privacidad de Tapizados Madaya: responsable, finalidades, base juridica, conservacion, derechos y terceros.";

require_once __DIR__ . '/app/includes/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/politica-privacidad/';

include __DIR__ . '/app/includes/header.php';
?>

<section class="section--narrow" aria-labelledby="privacidad-heading">
	<h1 id="privacidad-heading">Política de privacidad</h1>
	<p>
		En esta Política de privacidad se explica cómo se tratan los datos personales de las personas que navegan por este sitio web
		o contactan con Tapizados Madaya por los canales habilitados.
	</p>
	<p>
		Última actualización: <strong>31/03/2026</strong>.
	</p>
</section>

<section class="section--narrow" aria-labelledby="responsable-heading">
	<h2 id="responsable-heading">1. Responsable del tratamiento</h2>
	<p><strong>Responsable:</strong> Nazaret Duque Díaz</p>
	<p><strong>NIF:</strong> 42220605B</p>
	<p><strong>Domicilio:</strong> c/ Obispo Pérez Cáceres, 97, 38205, La Laguna, Santa Cruz de Tenerife, España</p>
	<p><strong>Correo electrónico:</strong> <a class="link-primary" href="mailto:<?php echo MADAYA_EMAIL; ?>"><?php echo MADAYA_EMAIL; ?></a></p>
	<p><strong>Teléfono:</strong> <a class="link-primary" href="tel:<?php echo MADAYA_PHONE_E164; ?>"><?php echo MADAYA_PHONE_DISPLAY; ?></a></p>
	<p><strong>Sitio web:</strong> <a class="link-primary" href="<?php echo MADAYA_SITE_URL; ?>"><?php echo MADAYA_SITE_URL; ?></a></p>
</section>

<section class="section--narrow" aria-labelledby="normativa-heading">
	<h2 id="normativa-heading">2. Normativa aplicable</h2>
	<p>
		El tratamiento de datos se realiza conforme al Reglamento (UE) 2016/679 (RGPD), a la Ley Orgánica 3/2018 (LOPDGDD)
		y a la normativa aplicable en materia de servicios de la sociedad de la información.
	</p>
</section>

<section class="section--narrow" aria-labelledby="datos-heading">
	<h2 id="datos-heading">3. Qué datos se tratan</h2>
	<p>En función del uso del sitio y del canal de contacto, se pueden tratar las siguientes categorías de datos:</p>
	<ul>
		<li>Datos identificativos y de contacto: nombre, teléfono, correo electrónico y contenido del mensaje.</li>
		<li>Datos de navegación técnica: dirección IP, tipo de dispositivo/navegador y eventos técnicos del servidor.</li>
		<li>Datos derivados del uso de enlaces o contenido externo de terceros activado por la propia persona usuaria (por ejemplo, Google Maps o YouTube).</li>
	</ul>
	<p>
		Este sitio dispone de formulario de contacto activo como canal complementario a WhatsApp, teléfono y correo electrónico.
	</p>
</section>

<section class="section--narrow" aria-labelledby="finalidades-heading">
	<h2 id="finalidades-heading">4. Finalidades y bases jurídicas</h2>
	<p>Los datos personales se tratan para las siguientes finalidades:</p>
	<ul>
		<li>Atender consultas y solicitudes de presupuesto recibidas por canales de contacto.</li>
		<li>Realizar seguimiento de solicitudes y comunicaciones relacionadas con servicios de tapicería y restauración.</li>
		<li>Garantizar la seguridad técnica del sitio y prevenir usos indebidos.</li>
	</ul>
	<p>Las bases jurídicas aplicables son:</p>
	<ul>
		<li>Consentimiento de la persona interesada al contactar voluntariamente.</li>
		<li>Aplicación de medidas precontractuales solicitadas por la persona interesada.</li>
		<li>Interés legítimo en garantizar la seguridad técnica y operativa del sitio web.</li>
	</ul>
</section>

<section class="section--narrow" aria-labelledby="conservacion-heading">
	<h2 id="conservacion-heading">5. Conservación de datos</h2>
	<p>
		Los datos se conservan durante el tiempo necesario para atender la finalidad para la que se recaban y, posteriormente,
		durante los plazos exigidos o permitidos por la normativa aplicable para atender posibles responsabilidades legales.
	</p>
	<p>
		En el caso de consultas recibidas por formulario, correo electrónico o canales equivalentes, la información se recibe y gestiona
		en la cuenta de correo de Gmail actualmente utilizada por la empresa. Esos mensajes pueden conservarse de forma indefinida como
		histórico de atención y seguimiento comercial, hasta que se decida su supresión o hasta que la persona interesada solicite el
		borrado de sus datos, siempre que dicho borrado sea legalmente posible.
	</p>
</section>

<section class="section--narrow">
	<h2>6. Destinatarios, encargados y terceros</h2>
	<p>
		Con carácter general, no se ceden datos a terceros salvo obligación legal o cuando sea necesario para la prestación de
		servicios vinculados a la actividad del sitio.
	</p>
	<p>Se utilizan, entre otros, los siguientes proveedores o plataformas:</p>
	<ul>
		<li>Arsys: alojamiento e infraestructura técnica del sitio web.</li>
		<li>Google: servicios como Google Maps, YouTube, enlaces a Google Maps/Reviews y la cuenta de Gmail utilizada actualmente por la empresa para gestionar consultas.</li>
		<li>Arsys Correo: infraestructura SMTP utilizada en producción para el envío técnico del formulario web mediante el buzón contacto@ecomadaya.es.</li>
		<li>Meta/WhatsApp: contacto iniciado por la persona usuaria mediante enlace directo a WhatsApp.</li>
	</ul>
	<p>
		El uso de plataformas de terceros puede implicar tratamientos sujetos a sus propias políticas de privacidad.
	</p>
</section>

<section class="section--narrow">
	<h2>7. Transferencias internacionales</h2>
	<p>
		Algunos proveedores pueden tratar datos fuera del Espacio Económico Europeo. En esos casos, el proveedor debe aplicar
		las garantías exigidas por la normativa vigente (por ejemplo, decisiones de adecuación o cláusulas contractuales tipo,
		según proceda).
	</p>
</section>

<section class="section--narrow">
	<h2>8. Derechos de las personas interesadas</h2>
	<p>
		Puedes ejercer los derechos de acceso, rectificación, supresión, oposición, limitación del tratamiento y, cuando proceda,
		portabilidad, enviando una solicitud a <a class="link-primary" href="mailto:<?php echo MADAYA_EMAIL; ?>"><?php echo MADAYA_EMAIL; ?></a>.
	</p>
	<p>
		Para proteger tu privacidad, se podrá solicitar información adicional para verificar la identidad cuando sea razonablemente
		necesario.
	</p>
	<p>
		Si consideras que el tratamiento no se ajusta a la normativa, puedes presentar una reclamación ante la Agencia Española de
		Protección de Datos (AEPD): <a class="link-primary" href="https://www.aepd.es" target="_blank" rel="noopener noreferrer">www.aepd.es</a>.
	</p>
</section>

<section class="section--narrow">
	<h2>9. Menores de edad</h2>
	<p>
		Este sitio web no está dirigido específicamente a menores de 14 años. Si se detecta el envío de datos de menores sin la
		autorización válida de progenitores o tutores legales, se adoptarán medidas para su supresión.
	</p>
</section>

<section class="section--narrow">
	<h2>10. Cookies y tecnologías similares</h2>
	<p>
		En el estado actual del sitio no se han implementado cookies propias con fines de analítica o publicidad. Tampoco se cargan
		de forma automática mapas o vídeos embebidos de terceros en la primera visita.
	</p>
	<p>
		Cuando una persona usuaria decide cargar contenido externo como Google Maps o YouTube, el sitio guarda una cookie técnica de
		preferencia llamada <strong>madaya_external_media_consent</strong> para recordar esa decisión durante un plazo máximo de 180 días.
		A partir de esa aceptación, el navegador puede conectar con los servicios externos correspondientes y estos podrán tratar datos
		de conexión conforme a sus propias políticas.
	</p>
	<p>
		Puedes consultar el detalle y las referencias a proveedores en la <a class="link-primary" href="/politica-cookies.php">Política de cookies</a>. Si la
		configuración técnica del sitio cambia o se modifica el sistema de gestión del consentimiento, esta información se actualizará.
	</p>
</section>

<section class="section--narrow">
	<h2>11. Formulario de contacto</h2>
	<p>
		El formulario de contacto trata exclusivamente los datos necesarios para atender consultas y solicitudes de presupuesto.
		Incluye validaciones técnicas y medidas anti-spam básicas (token CSRF, campo honeypot y limitación básica de envíos).
	</p>
	<p>
		Los envíos registran metadatos técnicos mínimos de trazabilidad (fecha y hora de recepción, dirección IP y agente de usuario)
		con finalidad de seguridad operativa y control del servicio.
	</p>
</section>

<section class="section--narrow">
	<h2>12. Cambios en esta política</h2>
	<p>
		Esta política puede actualizarse por cambios legales, técnicos o funcionales del sitio web. La versión vigente será siempre
		la publicada en esta página.
	</p>
</section>

<?php include __DIR__ . '/app/includes/footer.php'; ?>
