<?php
$pageTitle = "Politica de cookies | Madaya";
$pageDescription = "Politica de cookies de Tapizados Madaya: que tecnologias se usan, base legal y como gestionar preferencias.";

require_once __DIR__ . '/../app/includes/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/politica-cookies/';

include __DIR__ . '/../app/includes/header.php';
?>

<section class="section--narrow">
	<h1>Política de cookies</h1>
	<p>
		Esta Política de cookies explica qué tecnologías similares pueden utilizarse al navegar por este sitio web,
		para qué finalidades y cómo puedes gestionarlas.
	</p>
	<p>
		Última actualización: <strong>16/03/2026</strong>.
	</p>
</section>

<section class="section--narrow">
	<h2>1. Qué son las cookies</h2>
	<p>
		Las cookies son pequeños archivos que se descargan en tu dispositivo al acceder a determinadas páginas web.
		Permiten, entre otras cosas, almacenar y recuperar información sobre la navegación.
	</p>
</section>

<section class="section--narrow">
	<h2>2. Cookies utilizadas actualmente en este sitio</h2>
	<p>
		En el estado actual del proyecto, <strong>no se han implementado cookies propias</strong> de analítica,
		publicidad o personalización por parte de Tapizados Madaya.
	</p>
	<p>
		Tampoco se ha activado, por el momento, una plataforma de analítica de tráfico como Google Analytics.
	</p>
</section>

<section class="section--narrow">
	<h2>3. Tecnologías de terceros que pueden intervenir</h2>
	<p>
		Este sitio incorpora o carga recursos de terceros que, según sus propias políticas y el contexto de uso,
		pueden tratar datos de conexión (por ejemplo, dirección IP) y, en su caso, establecer cookies propias:
	</p>
	<ul>
		<li>Google Maps embebido en la página de contacto y en el pie del sitio.</li>
		<li>YouTube en modo privacidad mejorada (dominio youtube-nocookie.com) en la página de servicios.</li>
		<li>Google Fonts para la carga de tipografías web.</li>
	</ul>
	<p>
		Tapizados Madaya no controla las cookies de terceros; su gestión depende de cada proveedor.
	</p>
</section>

<section class="section--narrow">
	<h2>4. Base jurídica</h2>
	<p>
		Cuando existan cookies no necesarias, su uso se apoyará en el consentimiento de la persona usuaria,
		de acuerdo con la normativa aplicable.
	</p>
	<p>
		En el estado actual, al no haberse implementado cookies propias no necesarias, no se solicita consentimiento
		específico mediante banner para herramientas propias de analítica o publicidad.
	</p>
</section>

<section class="section--narrow">
	<h2>5. Cómo gestionar o desactivar cookies</h2>
	<p>
		Puedes permitir, bloquear o eliminar cookies desde la configuración de tu navegador.
		Ten en cuenta que, si bloqueas determinadas cookies de terceros, algunas funcionalidades embebidas
		(como mapas o videos) pueden no mostrarse correctamente.
	</p>
	<p>Enlaces de ayuda de navegadores habituales:</p>
	<ul>
		<li><a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
		<li><a href="https://support.mozilla.org/es/kb/proteccion-de-rastreo-mejorada-en-firefox-escritorio" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
		<li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener noreferrer">Safari</a></li>
		<li><a href="https://support.microsoft.com/es-es/microsoft-edge/administrar-cookies-en-microsoft-edge-ver-permitir-bloquear-eliminar-y-usar-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
	</ul>
</section>

<section class="section--narrow">
	<h2>6. Políticas de terceros relacionadas</h2>
	<ul>
		<li><a href="https://policies.google.com/privacy?hl=es" target="_blank" rel="noopener noreferrer">Google - Política de privacidad</a></li>
		<li><a href="https://policies.google.com/technologies/cookies?hl=es" target="_blank" rel="noopener noreferrer">Google - Uso de cookies</a></li>
		<li><a href="https://www.youtube.com/howyoutubeworks/user-settings/privacy/" target="_blank" rel="noopener noreferrer">YouTube - Privacidad</a></li>
		<li><a href="https://www.whatsapp.com/legal/privacy-policy-eea?lang=es" target="_blank" rel="noopener noreferrer">WhatsApp - Política de privacidad</a></li>
	</ul>
</section>

<section class="section--narrow">
	<h2>7. Cambios en esta política</h2>
	<p>
		Esta Política de cookies puede actualizarse por cambios normativos, técnicos o funcionales del sitio.
		Si se incorporan herramientas de analítica, publicidad o personalización que utilicen cookies no necesarias,
		se revisará esta página y se implementarán los mecanismos de información y consentimiento que correspondan.
	</p>
</section>

<section class="section--narrow">
	<h2>8. Contacto</h2>
	<p>
		Si tienes dudas sobre esta Política de cookies, puedes escribir a
		<a href="mailto:<?php echo MADAYA_EMAIL; ?>"><?php echo MADAYA_EMAIL; ?></a>.
	</p>
</section>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>
