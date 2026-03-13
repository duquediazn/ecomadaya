<?php
$pageTitle = "Contacto | Tapizados Madaya - Taller en La Laguna, Tenerife";
$pageDescription = "Contacta con Tapizados Madaya en La Laguna, Tenerife. Taller de tapiceria y restauración de muebles con mas de 40 años de experiencia. 
Presupuesto sin compromiso por WhatsApp, teléfono o email.";

// Esta pagina usa constantes de contacto antes de incluir el header.
require_once __DIR__ . '/../app/includes/bootstrap.php';
$canonicalUrl = MADAYA_SITE_URL . '/contacto/';

// Generar URLs de WhatsApp con mensajes predefinidos para presupuesto y cita previa.
$whatsAppBaseUrl = "https://wa.me/" . preg_replace('/\D+/', '', MADAYA_PHONE_E164);
$whatsAppBudgetMessage = rawurlencode("Hola, me gustaría pedir presupuesto para tapicería/restauración.");
$whatsAppAppointmentMessage = rawurlencode("Hola, me gustaría concertar una cita.");

$whatsAppBudgetUrl = $whatsAppBaseUrl . "?text=" . $whatsAppBudgetMessage;
$whatsAppAppointmentUrl = $whatsAppBaseUrl . "?text=" . $whatsAppAppointmentMessage;

include __DIR__ . '/../app/includes/header.php';
?>

<section id="contacto-intro" class="section--narrow">
	<h1>Contacta con Tapizados Madaya</h1>
	<p>Estamos en <strong>La Laguna, Tenerife</strong>, y llevamos mas de 40 años dando una segunda vida a sofas, sillas, butacas y muebles especiales. 
    Cuéntanos lo que necesitas y te orientamos con un <strong>presupuesto sin compromiso</strong> por WhatsApp, teléfono o email.</p>
	<p class="contact-intro__status"><span class="<?php echo $openBadgeClass; ?>"><?php echo $openBadgeText; ?></span></p>
</section>

<section id="canales-de-contacto">
	<div class="contact-cards" aria-label="Canales de contacto">
		<article class="contact-card">
			<svg class="contact-card__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
				<path d="M13.601 2.326A7.854 7.854 0 0 0 8.003 0C3.58 0 0 3.58 0 8c0 1.414.37 2.793 1.073 4.01L0 16l4.107-1.058A7.96 7.96 0 0 0 8.003 16C12.42 16 16 12.42 16 8a7.94 7.94 0 0 0-2.399-5.674M8.003 14.5a6.45 6.45 0 0 1-3.29-.903l-.235-.138-2.437.628.65-2.376-.153-.243A6.44 6.44 0 0 1 1.5 8c0-3.588 2.916-6.5 6.503-6.5 1.737 0 3.368.676 4.597 1.905A6.46 6.46 0 0 1 14.5 8c0 3.588-2.916 6.5-6.497 6.5m3.563-4.866c-.195-.098-1.152-.569-1.33-.634-.177-.066-.306-.098-.434.098-.128.195-.5.634-.612.764-.112.13-.225.147-.42.049-.194-.098-.823-.303-1.569-.965-.58-.518-.972-1.158-1.086-1.353-.112-.196-.012-.302.085-.4.088-.087.195-.227.293-.34.098-.114.13-.195.195-.325.066-.13.033-.244-.016-.342-.049-.098-.434-1.046-.595-1.434-.157-.376-.316-.325-.434-.331l-.37-.006c-.13 0-.341.048-.52.244-.177.195-.677.662-.677 1.612s.693 1.868.79 1.998c.098.13 1.365 2.084 3.307 2.924.462.2.823.32 1.105.41.464.147.886.126 1.22.077.373-.056 1.152-.47 1.315-.924.163-.454.163-.843.114-.924-.048-.081-.177-.13-.372-.228" />
			</svg>
			<h2 class="contact-card__title">WhatsApp</h2>
			<p class="contact-card__subtitle">Respuesta habitual en menos de 24 horas</p>
			<a class="contact-card__data" href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer"><?php echo MADAYA_PHONE_DISPLAY; ?></a>
			<a href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn btn--secondary link-dark">Pedir presupuesto por WhatsApp</a>
		</article>

		<article class="contact-card">
			<svg class="contact-card__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
				<path d="M3.654 1.328a.678.678 0 0 1 .738-.138l2.522 1.01c.26.104.433.356.43.636l-.01 2.109a.678.678 0 0 1-.182.447L5.58 6.905a11.74 11.74 0 0 0 3.514 3.514l1.513-1.573a.678.678 0 0 1 .447-.182l2.11-.01a.678.678 0 0 1 .636.43l1.01 2.523a.678.678 0 0 1-.137.738l-1.28 1.28c-.567.567-1.413.81-2.193.648A17.57 17.57 0 0 1 1.08 4.153c-.163-.78.08-1.626.648-2.193z" />
			</svg>
			<h2 class="contact-card__title">Teléfono</h2>
			<p class="contact-card__subtitle">Atención directa en horario de taller</p>
			<a class="contact-card__data" href="tel:<?php echo MADAYA_PHONE_E164; ?>"><?php echo MADAYA_PHONE_DISPLAY; ?></a>
			<a href="tel:<?php echo MADAYA_PHONE_E164; ?>" class="btn btn--primary link-light">Llamar ahora</a>
		</article>

		<article class="contact-card">
			<svg class="contact-card__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
				<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.417.001 4.217z" />
				<path d="M.034 4.697 8 8.882l7.966-4.185A2 2 0 0 1 16 5v7a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5c0-.104.008-.206.034-.303" />
			</svg>
			<h2 class="contact-card__title">Email</h2>
			<p class="contact-card__subtitle">Para solicitudes detalladas o adjuntos</p>
			<a class="contact-card__data" href="mailto:<?php echo MADAYA_EMAIL; ?>"><?php echo MADAYA_EMAIL; ?></a>
			<a href="mailto:<?php echo MADAYA_EMAIL; ?>" class="btn btn--primary link-light">Enviar email</a>
		</article>

		<article class="contact-card">
			<svg class="contact-card__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
				<path d="M8 0a5 5 0 0 0-5 5c0 2.713 2.14 5.908 4.272 8.355a.96.96 0 0 0 1.456 0C10.86 10.908 13 7.713 13 5a5 5 0 0 0-5-5m0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4" />
			</svg>
			<h2 class="contact-card__title">Taller</h2>
			<p class="contact-card__subtitle">Visitanos en La Laguna</p>
			<address class="contact-card__address">
				<a class="contact-card__data" href="<?php echo MADAYA_MAPS_URL; ?>" target="_blank" rel="noopener noreferrer">
					C/ Obispo Pérez Céceres, 97<br>
					38205 La Laguna, Tenerife
				</a>
			</address>
			<a href="<?php echo MADAYA_MAPS_URL; ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary link-light">Abrir en Google Maps</a>
		</article>
	</div>
</section>

<section id="como-llegar">
	<div class="contact-location">
		<section class="contact-location__schedule" aria-labelledby="horario-titulo">
			<h2 id="horario-titulo">Horario del taller</h2>
			<dl class="schedule-list">
				<dt>Lunes a viernes</dt>
				<dd><time datetime="08:00">8:00</time> - <time datetime="15:00">15:00</time></dd>
				<dt>Sabados</dt>
				<dd><time datetime="09:00">9:00</time> - <time datetime="12:00">12:00</time></dd>
				<dt>Tardes</dt>
				<dd>Bajo cita previa. <a class="link-primary" href="<?php echo $whatsAppAppointmentUrl; ?>" target="_blank" rel="noopener noreferrer">Solicita cita por WhatsApp</a></dd>
			</dl>
			<address class="contact-location__address">
				<strong>Dirección:</strong><br>
				C/ Obispo Pérez Céceres, 97<br>
				38205 La Laguna, Santa Cruz de Tenerife
			</address>
		</section>

		<div class="contact-location__map">
			<h2>Cómo llegar</h2>
			<iframe
				title="Ubicación de Tapizados Madaya en Google Maps"
				src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56111.95146538817!2d-16.308823!3d28.479638000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc41ccf7465c1a57%3A0x4059bd340db92d8f!2sTapizados%20Madaya!5e0!3m2!1ses!2sus!4v1765401424268!5m2!1ses!2sus"
				width="100%"
				height="350"
				style="border:0;"
				allowfullscreen
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</section>

<section id="pide-presupuesto" class="bg-primary">
	<div class="narrow-container contact-cta">
		<h2>Listo para darle una nueva vida a tu mueble</h2>
		<p>Escríbenos por WhatsApp y te orientamos en menos de 24 horas. Presupuesto sin compromiso.</p>
		<a href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn btn--secondary link-dark">Pedir presupuesto por WhatsApp</a>
		<p class="contact-cta__social-proof">
			Valoración en Google: <strong><?php echo MADAYA_REVIEW_RATING; ?>/5</strong> (<?php echo MADAYA_REVIEW_COUNT; ?> reseñas)
			- <a href="<?php echo MADAYA_GOOGLE_REVIEWS_URL; ?>" target="_blank" rel="noopener noreferrer" class="link-light">Ver opiniones</a>
		</p>
	</div>
</section>

<section id="resuelve-dudas" class="section--narrow">
	<h2>¿Tienes dudas antes de escribirnos?</h2>
	<p>Estamos preparando la sección de preguntas frecuentes para resolver dudas habituales sobre tiempos, tejidos, recogida y entrega.</p>
	<a href="/preguntas-frecuentes.php" class="btn btn--small btn--primary link-light">Ver preguntas frecuentes</a>
</section>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>
