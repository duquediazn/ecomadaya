<?php
$pageTitle = "Contacto | Tapizados Madaya - Taller en La Laguna, Tenerife";
$pageDescription = "Contacta con Tapizados Madaya en La Laguna, Tenerife. Taller de tapiceria y restauración de muebles con mas de 40 años de experiencia. 
Presupuesto sin compromiso por WhatsApp, teléfono o email.";

require_once __DIR__ . '/app/config/bootstrap.php';
require_once __DIR__ . '/app/services/contact-form.php';

// URL canónica para SEO
$canonicalUrl = MADAYA_SITE_URL . '/contacto/';

// Se preparan datos para mostrar el formulario de contacto, 
// incluyendo mensajes flash, errores de validación y valores antiguos.
madayaContactEnsureSession();
$contactFormFlash = madayaContactPullFlash();

$contactFormDefaultValues = [
	'nombre' => '',
	'email' => '',
	'telefono' => '',
	'preferencia_contacto' => '',
	'mensaje' => '',
	'consentimiento_privacidad' => '',
];

$contactFormOldValues = $contactFormDefaultValues;
if (isset($contactFormFlash['old']) && is_array($contactFormFlash['old'])) {
	$contactFormOldValues = array_merge($contactFormDefaultValues, $contactFormFlash['old']);
}

$contactFormErrors = [];
if (isset($contactFormFlash['errors']) && is_array($contactFormFlash['errors'])) {
	$contactFormErrors = $contactFormFlash['errors'];
}

$contactFormStatus = isset($contactFormFlash['status']) ? (string) $contactFormFlash['status'] : '';
$contactFormMessage = isset($contactFormFlash['message']) ? (string) $contactFormFlash['message'] : '';
$contactFormFirstErrorField = $contactFormErrors !== [] ? array_key_first($contactFormErrors) : null;
$contactFormCsrfToken = madayaContactGetOrCreateCsrfToken();

$contactFormStatusIsError = in_array($contactFormStatus, ['validation_error', 'security_error', 'rate_limit_error', 'send_error'], true);
$contactFormStatusClass = $contactFormStatusIsError ? 'contact-form__status contact-form__status--error' : 'contact-form__status contact-form__status--success';
$contactFormStatusRole = $contactFormStatusIsError ? 'alert' : 'status';

// Función de escape para evitar XSS en mensajes y valores del formulario.
$escape = static function (string $value): string {
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};

$hasExternalMediaConsent = madayaHasExternalMediaConsent();
$externalMediaReturnTo = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] . '#como-llegar' : '/contacto.php#como-llegar';

include __DIR__ . '/app/views/layout/header.php';
?>

<section id="contacto-intro" class="section--narrow">
	<h1>Contacta con Tapizados Madaya</h1>
	<p>Estamos en <strong>La Laguna, Tenerife</strong>, y llevamos mas de 40 años dando una segunda vida a sofas, sillas, butacas y muebles especiales.
		Cuéntanos lo que necesitas y te orientamos con un <strong>presupuesto sin compromiso</strong> por WhatsApp, teléfono o email.</p>
	<p class="contact-intro__status"><span class="<?php echo $openBadgeClass; ?>"><?php echo $openBadgeText; ?></span></p>
</section>

<section id="canales-de-contacto" aria-labelledby="canales-contacto-heading">
	<h2 id="canales-contacto-heading">Canales de contacto</h2>
	<div class="contact-cards">
		<article class="contact-card">
			<svg class="contact-card__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
				<path d="M13.601 2.326A7.854 7.854 0 0 0 8.003 0C3.58 0 0 3.58 0 8c0 1.414.37 2.793 1.073 4.01L0 16l4.107-1.058A7.96 7.96 0 0 0 8.003 16C12.42 16 16 12.42 16 8a7.94 7.94 0 0 0-2.399-5.674M8.003 14.5a6.45 6.45 0 0 1-3.29-.903l-.235-.138-2.437.628.65-2.376-.153-.243A6.44 6.44 0 0 1 1.5 8c0-3.588 2.916-6.5 6.503-6.5 1.737 0 3.368.676 4.597 1.905A6.46 6.46 0 0 1 14.5 8c0 3.588-2.916 6.5-6.497 6.5m3.563-4.866c-.195-.098-1.152-.569-1.33-.634-.177-.066-.306-.098-.434.098-.128.195-.5.634-.612.764-.112.13-.225.147-.42.049-.194-.098-.823-.303-1.569-.965-.58-.518-.972-1.158-1.086-1.353-.112-.196-.012-.302.085-.4.088-.087.195-.227.293-.34.098-.114.13-.195.195-.325.066-.13.033-.244-.016-.342-.049-.098-.434-1.046-.595-1.434-.157-.376-.316-.325-.434-.331l-.37-.006c-.13 0-.341.048-.52.244-.177.195-.677.662-.677 1.612s.693 1.868.79 1.998c.098.13 1.365 2.084 3.307 2.924.462.2.823.32 1.105.41.464.147.886.126 1.22.077.373-.056 1.152-.47 1.315-.924.163-.454.163-.843.114-.924-.048-.081-.177-.13-.372-.228" />
			</svg>
			<h2 class="contact-card__title">WhatsApp</h2>
			<p class="contact-card__subtitle">Respuesta habitual en menos de 24 horas</p>
			<a class="contact-card__data" href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer"><?php echo MADAYA_PHONE_DISPLAY; ?></a>
			<a href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary">Pedir presupuesto por WhatsApp</a>
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
			<p class="contact-card__subtitle">Visítanos en La Laguna</p>
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

<!-- El formulario de contacto con validación y mensajes de estado. -->
<section id="formulario-contacto" class="section--narrow">
	<h2>Formulario de contacto</h2>
	<p>Canal complementario para consultas y solicitudes de presupuesto. Si prefieres una respuesta más rápida, puedes escribirnos por WhatsApp.</p>

	<div class="contact-form__live-region" id="contacto-form-status" aria-live="polite" aria-atomic="true">
		<?php if ($contactFormStatus !== ''): ?>
			<div class="<?php echo $contactFormStatusClass; ?>" role="<?php echo $contactFormStatusRole; ?>">
				<p><?php echo $escape($contactFormMessage); ?></p>
				<?php if ($contactFormStatus === 'send_error'): ?>
					<p>Puedes contactarnos ahora por canales directos:</p>
					<ul>
						<li><a href="<?php echo $whatsAppBudgetUrl; ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a></li>
						<li><a href="tel:<?php echo MADAYA_PHONE_E164; ?>">Telefono: <?php echo MADAYA_PHONE_DISPLAY; ?></a></li>
						<li><a href="mailto:<?php echo MADAYA_EMAIL; ?>">Email: <?php echo MADAYA_EMAIL; ?></a></li>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>

	<form action="/api/contacto.php" method="post" class="contact-form" data-contact-form>
		<input type="hidden" name="csrf_token" value="<?php echo $escape($contactFormCsrfToken); ?>">

		<div class="contact-form__honeypot" aria-hidden="true">
			<label for="contacto-website">No rellenes este campo</label>
			<input type="text" id="contacto-website" name="website" tabindex="-1" autocomplete="off">
		</div>

		<?php if ($contactFormErrors !== []): ?>
			<div class="contact-form__error-summary" id="contacto-form-errors" role="alert" tabindex="-1" data-contact-errors>
				<h3>Hay errores en el formulario</h3>
				<p>Revisa los siguientes campos antes de enviar:</p>
				<ul>
					<?php foreach ($contactFormErrors as $field => $error): ?>
						<?php $fieldId = 'contacto-' . str_replace('_', '-', (string) $field); ?>
						<li><a href="#<?php echo $fieldId; ?>"><?php echo $escape((string) $error); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php else: ?>
			<div class="contact-form__error-summary" id="contacto-form-errors" hidden data-contact-errors></div>
		<?php endif; ?>

		<fieldset>
			<legend>Cuéntanos tu consulta</legend>

			<div class="contact-form__grid">
				<div class="contact-form__field">
					<label for="contacto-nombre">Nombre <span aria-hidden="true">*</span></label>
					<input
						type="text"
						id="contacto-nombre"
						name="nombre"
						minlength="2"
						maxlength="80"
						required
						value="<?php echo $escape((string) $contactFormOldValues['nombre']); ?>"
						aria-invalid="<?php echo isset($contactFormErrors['nombre']) ? 'true' : 'false'; ?>"
						aria-describedby="contacto-nombre-help<?php echo isset($contactFormErrors['nombre']) ? ' contacto-nombre-error' : ''; ?>"
						<?php echo $contactFormFirstErrorField === 'nombre' ? 'autofocus' : ''; ?>>
					<p id="contacto-nombre-help" class="contact-form__help">Entre 2 y 80 caracteres.</p>
					<?php if (isset($contactFormErrors['nombre'])): ?>
						<p id="contacto-nombre-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['nombre']); ?></p>
					<?php endif; ?>
				</div>

				<div class="contact-form__field">
					<label for="contacto-email">Email <span aria-hidden="true">*</span></label>
					<input
						type="email"
						id="contacto-email"
						name="email"
						maxlength="254"
						required
						value="<?php echo $escape((string) $contactFormOldValues['email']); ?>"
						aria-invalid="<?php echo isset($contactFormErrors['email']) ? 'true' : 'false'; ?>"
						aria-describedby="contacto-email-help<?php echo isset($contactFormErrors['email']) ? ' contacto-email-error' : ''; ?>"
						<?php echo $contactFormFirstErrorField === 'email' ? 'autofocus' : ''; ?>>
					<p id="contacto-email-help" class="contact-form__help">Usaremos este email para responderte.</p>
					<?php if (isset($contactFormErrors['email'])): ?>
						<p id="contacto-email-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['email']); ?></p>
					<?php endif; ?>
				</div>

				<div class="contact-form__field">
					<label for="contacto-telefono">Teléfono (opcional)</label>
					<input
						type="tel"
						id="contacto-telefono"
						name="telefono"
						maxlength="25"
						value="<?php echo $escape((string) $contactFormOldValues['telefono']); ?>"
						aria-invalid="<?php echo isset($contactFormErrors['telefono']) ? 'true' : 'false'; ?>"
						aria-describedby="contacto-telefono-help<?php echo isset($contactFormErrors['telefono']) ? ' contacto-telefono-error' : ''; ?>"
						<?php echo $contactFormFirstErrorField === 'telefono' ? 'autofocus' : ''; ?>>
					<p id="contacto-telefono-help" class="contact-form__help">Solo números, espacios y +().-</p>
					<?php if (isset($contactFormErrors['telefono'])): ?>
						<p id="contacto-telefono-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['telefono']); ?></p>
					<?php endif; ?>
				</div>

				<div class="contact-form__field">
					<label for="contacto-preferencia-contacto">Preferencia de contacto <span aria-hidden="true">*</span></label>
					<select
						id="contacto-preferencia-contacto"
						name="preferencia_contacto"
						required
						aria-invalid="<?php echo isset($contactFormErrors['preferencia_contacto']) ? 'true' : 'false'; ?>"
						aria-describedby="contacto-preferencia-help<?php echo isset($contactFormErrors['preferencia_contacto']) ? ' contacto-preferencia-contacto-error' : ''; ?>"
						<?php echo $contactFormFirstErrorField === 'preferencia_contacto' ? 'autofocus' : ''; ?>>
						<option value="">Selecciona una opción</option>
						<option value="email" <?php echo $contactFormOldValues['preferencia_contacto'] === 'email' ? 'selected' : ''; ?>>Email</option>
						<option value="llamada" <?php echo $contactFormOldValues['preferencia_contacto'] === 'llamada' ? 'selected' : ''; ?>>Llamada</option>
						<option value="whatsapp" <?php echo $contactFormOldValues['preferencia_contacto'] === 'whatsapp' ? 'selected' : ''; ?>>WhatsApp</option>
					</select>
					<p id="contacto-preferencia-help" class="contact-form__help">Elige tu canal preferido para la respuesta.</p>
					<?php if (isset($contactFormErrors['preferencia_contacto'])): ?>
						<p id="contacto-preferencia-contacto-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['preferencia_contacto']); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<div class="contact-form__field">
				<label for="contacto-mensaje">Mensaje <span aria-hidden="true">*</span></label>
				<textarea
					id="contacto-mensaje"
					name="mensaje"
					rows="8"
					minlength="20"
					maxlength="2000"
					required
					aria-invalid="<?php echo isset($contactFormErrors['mensaje']) ? 'true' : 'false'; ?>"
					aria-describedby="contacto-mensaje-help<?php echo isset($contactFormErrors['mensaje']) ? ' contacto-mensaje-error' : ''; ?>"
					<?php echo $contactFormFirstErrorField === 'mensaje' ? 'autofocus' : ''; ?>><?php echo $escape((string) $contactFormOldValues['mensaje']); ?></textarea>
				<p id="contacto-mensaje-help" class="contact-form__help">Entre 20 y 2000 caracteres.</p>
				<?php if (isset($contactFormErrors['mensaje'])): ?>
					<p id="contacto-mensaje-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['mensaje']); ?></p>
				<?php endif; ?>
			</div>

			<div class="contact-form__field contact-form__consent">
				<div class="contact-form__checkbox-row">
					<input
						type="checkbox"
						id="contacto-consentimiento-privacidad"
						name="consentimiento_privacidad"
						value="1"
						required
						<?php echo $contactFormOldValues['consentimiento_privacidad'] === '1' ? 'checked' : ''; ?>
						aria-invalid="<?php echo isset($contactFormErrors['consentimiento_privacidad']) ? 'true' : 'false'; ?>"
						aria-describedby="contacto-consentimiento-help<?php echo isset($contactFormErrors['consentimiento_privacidad']) ? ' contacto-consentimiento-privacidad-error' : ''; ?>"
						<?php echo $contactFormFirstErrorField === 'consentimiento_privacidad' ? 'autofocus' : ''; ?>>
					<label for="contacto-consentimiento-privacidad">
						He leído y acepto la <a href="/politica-privacidad.php">Política de privacidad</a> para el tratamiento de mis datos con la finalidad de atender mi consulta o solicitud de presupuesto.
					</label>
				</div>
				<p id="contacto-consentimiento-help" class="contact-form__help">Este consentimiento es obligatorio para poder enviar el formulario.</p>
				<?php if (isset($contactFormErrors['consentimiento_privacidad'])): ?>
					<p id="contacto-consentimiento-privacidad-error" class="contact-form__error"><?php echo $escape((string) $contactFormErrors['consentimiento_privacidad']); ?></p>
				<?php endif; ?>
			</div>

			<div class="contact-form__actions">
				<button type="submit" class="btn btn--primary link-light">Enviar consulta</button>
				<p class="contact-form__meta">Finalidad exclusiva: atencion de consultas y solicitudes de presupuesto. Respuesta manual en menos de 24 horas laborables.</p>
			</div>
		</fieldset>
	</form>
</section>

<section id="como-llegar">
	<div class="contact-location">
		<section class="contact-location__schedule" aria-labelledby="horario-titulo">
			<h2 id="horario-titulo">Horario <?php if ($isSummer) { echo 'de verano'; } ?></h2>
			<dl class="schedule-list">
				<dt>Lunes a viernes</dt>
				<dd><time datetime="08:00">8:00</time> - <time datetime="<?php echo $isSummer ? '14:00' : '15:00'; ?>"><?php echo $isSummer ? '14:00' : '15:00'; ?></time></dd>
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
			<div id="contacto-map-embed-slot">
				<?php if ($hasExternalMediaConsent): ?>
					<iframe
						title="Ubicación de Tapizados Madaya en Google Maps"
						src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56111.95146538817!2d-16.308823!3d28.479638000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc41ccf7465c1a57%3A0x4059bd340db92d8f!2sTapizados%20Madaya!5e0!3m2!1ses!2sus!4v1765401424268!5m2!1ses!2sus"
						width="100%"
						height="350"
						style="border:0;"
						allowfullscreen
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"></iframe>
				<?php else: ?>
					<p>
						El mapa está desactivado hasta que aceptes la carga de contenido externo.
					</p>
					<form class="consent-form"
						method="post"
						action="/api/consentimiento-embeds.php"
						data-external-media-consent-form
						data-embed-target="contacto-map-embed-slot"
						data-cookie-name="<?php echo $escape(MADAYA_EXTERNAL_MEDIA_CONSENT_COOKIE); ?>"
						data-cookie-max-age="<?php echo $escape((string) MADAYA_EXTERNAL_MEDIA_CONSENT_MAX_AGE); ?>">
						<input type="hidden" name="decision" value="accept">
						<input type="hidden" name="return_to" value="<?php echo $escape($externalMediaReturnTo); ?>">
						<input type="hidden" name="embed_src" value="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56111.95146538817!2d-16.308823!3d28.479638000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc41ccf7465c1a57%3A0x4059bd340db92d8f!2sTapizados%20Madaya!5e0!3m2!1ses!2sus!4v1765401424268!5m2!1ses!2sus">
						<input type="hidden" name="embed_title" value="Ubicación de Tapizados Madaya en Google Maps">
						<button type="submit" class="btn btn--small btn--primary">Aceptar y cargar mapa</button>
					</form>
					<p><a class="link-primary" href="/politica-cookies/">Ver política de cookies</a></p>
					<p>
						También puedes abrirlo fuera del sitio en
						<a class="link-primary" href="<?php echo MADAYA_MAPS_URL; ?>" target="_blank" rel="noopener noreferrer">Google Maps</a>.
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


<?php include __DIR__ . '/app/views/sections/pide-presupuesto.php'; ?>

<?php include __DIR__ . '/app/views/sections/resuelve-dudas.php'; ?>

<?php include __DIR__ . '/app/views/layout/footer.php'; ?>