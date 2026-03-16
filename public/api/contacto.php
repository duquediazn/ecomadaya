<?php
declare(strict_types=1);

require_once __DIR__ . '/../../app/includes/bootstrap.php';
require_once __DIR__ . '/../../app/includes/contact-form.php';

// Método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    madayaContactRedirectToPage();
}

// Rate limit
if (!madayaContactCanSubmitByRateLimit()) {
    madayaContactSetFlash([
        'status' => 'rate_limit_error',
        'message' => 'Has enviado demasiadas solicitudes en poco tiempo. Espera unos minutos y vuelve a intentarlo.',
        'old' => [
            'nombre' => madayaContactNormalizeSingleLine($_POST['nombre'] ?? ''),
            'email' => madayaContactNormalizeSingleLine($_POST['email'] ?? ''),
            'telefono' => madayaContactNormalizeSingleLine($_POST['telefono'] ?? ''),
            'preferencia_contacto' => madayaContactNormalizeSingleLine($_POST['preferencia_contacto'] ?? ''),
            'mensaje' => madayaContactNormalizeMultiline($_POST['mensaje'] ?? ''),
            'consentimiento_privacidad' => isset($_POST['consentimiento_privacidad']) ? '1' : '',
        ],
    ]);

    madayaContactRotateCsrfToken();
    madayaContactRedirectToPage();
}

// Validación CSRF
$csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
if (!madayaContactIsValidCsrf($csrfToken)) {
    madayaContactSetFlash([
        'status' => 'security_error',
        'message' => 'No hemos podido validar el envio por seguridad. Recarga la pagina y vuelve a intentarlo.',
        'old' => [
            'nombre' => madayaContactNormalizeSingleLine($_POST['nombre'] ?? ''),
            'email' => madayaContactNormalizeSingleLine($_POST['email'] ?? ''),
            'telefono' => madayaContactNormalizeSingleLine($_POST['telefono'] ?? ''),
            'preferencia_contacto' => madayaContactNormalizeSingleLine($_POST['preferencia_contacto'] ?? ''),
            'mensaje' => madayaContactNormalizeMultiline($_POST['mensaje'] ?? ''),
            'consentimiento_privacidad' => isset($_POST['consentimiento_privacidad']) ? '1' : '',
        ],
    ]);

    madayaContactRotateCsrfToken();
    madayaContactRedirectToPage();
}

// Validación de honeypot para bots (campo oculto que no debe ser rellenado).
$honeypot = madayaContactNormalizeSingleLine($_POST['website'] ?? '');
if ($honeypot !== '') {
    // Se responde como éxito para no dar pistas a bots.
    madayaContactSetFlash([
        'status' => 'success',
        'message' => 'Gracias por contactar. Hemos recibido tu solicitud y te responderemos en menos de 24 horas laborables.',
    ]);

    madayaContactRotateCsrfToken();
    madayaContactRedirectToPage();
}

// Validación funcional
$validationResult = madayaContactValidate($_POST);
$data = $validationResult['data'];
$errors = $validationResult['errors'];
$old = $validationResult['old'];

if ($errors !== []) {
    madayaContactSetFlash([
        'status' => 'validation_error',
        'message' => 'Revisa los campos marcados y vuelve a intentarlo.',
        'errors' => $errors,
        'old' => $old,
    ]);

    madayaContactRotateCsrfToken();
    madayaContactRedirectToPage();
}

// Construcción y envío del correo
$submittedAt = madayaContactBuildSubmittedAt();
$subject = '[Web Madaya] Nueva consulta de contacto - ' . $submittedAt['human'];

$siteHost = parse_url(MADAYA_SITE_URL, PHP_URL_HOST);
$fromHost = is_string($siteHost) && $siteHost !== '' ? $siteHost : 'localhost';
$clientIp = isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'desconocida';
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? (string) $_SERVER['HTTP_USER_AGENT'] : 'desconocido';

$mailBody = implode("\n", [
    'Nueva solicitud desde el formulario de contacto de ecomadaya.es',
    '',
    'Fecha/hora del envio: ' . $submittedAt['human'],
    'Timestamp ISO8601: ' . $submittedAt['iso'],
    'IP de origen: ' . $clientIp,
    'User-Agent: ' . $userAgent,
    '',
    'Finalidad declarada: atencion de consultas o solicitudes de presupuesto.',
    '',
    'Datos de la solicitud:',
    '- Nombre: ' . $data['nombre'],
    '- Email: ' . $data['email'],
    '- Telefono: ' . ($data['telefono'] !== '' ? $data['telefono'] : '(no facilitado)'),
    '- Preferencia de contacto: ' . $data['preferencia_contacto'],
    '- Consentimiento privacidad: SI',
    '',
    'Mensaje:',
    $data['mensaje'],
]);

$encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: Web Madaya <no-reply@' . $fromHost . '>',
    'Reply-To: ' . $data['email'],
    'X-Mailer: PHP/' . PHP_VERSION,
];

$sent = false;
if (APP_ENV === 'production') {
    $sent = mail(
        MADAYA_EMAIL,
        $encodedSubject,
        $mailBody,
        implode("\r\n", $headers)
    );
}

// Flash + redirect siempre (éxito o error)
if ($sent) {
    madayaContactSetFlash([
        'status' => 'success',
        'message' => 'Gracias por escribirnos. Hemos recibido tu consulta y responderemos en menos de 24 horas laborables.',
    ]);

    madayaContactRotateCsrfToken();
    madayaContactRedirectToPage();
}

madayaContactSetFlash([
    'status' => 'send_error',
    'message' => 'No hemos podido enviar tu solicitud en este momento.',
    'old' => $old,
]);

madayaContactRotateCsrfToken();
madayaContactRedirectToPage();
