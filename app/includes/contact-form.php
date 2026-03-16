<?php
declare(strict_types=1);

/**
 * Utilidades del formulario de contacto.
 *
 * Este archivo centraliza:
 * - gestión de sesión/flash,
 * - token CSRF,
 * - validación y sanitización,
 * - rate limit básico por sesión.
 */

const MADAYA_CONTACT_FLASH_KEY = 'madaya_contact_flash';
const MADAYA_CONTACT_CSRF_KEY = 'madaya_contact_csrf';
const MADAYA_CONTACT_RATE_LIMIT_KEY = 'madaya_contact_rate_limit_attempts';

/**
 * Inicia la sesión solo cuando aún no está activa.
 *
 * @return void
 */
function madayaContactEnsureSession(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

/**
 * Devuelve longitud de cadena usando mbstring si está disponible.
 *
 * @param string $value
 * @return int
 */
function madayaContactStrLen(string $value): int
{
    if (function_exists('mb_strlen')) {
        return (int) mb_strlen($value, 'UTF-8');
    }

    return strlen($value);
}

/**
 * Normaliza espacios de texto de una línea.
 *
 * @param mixed $value
 * @return string
 */
function madayaContactNormalizeSingleLine(mixed $value): string
{
    $stringValue = trim((string) $value);
    $stringValue = preg_replace('/\s+/u', ' ', $stringValue) ?? $stringValue;

    return trim($stringValue);
}

/**
 * Normaliza texto multilinea para conservar saltos razonables.
 *
 * @param mixed $value
 * @return string
 */
function madayaContactNormalizeMultiline(mixed $value): string
{
    $stringValue = trim((string) $value);
    $stringValue = str_replace(["\r\n", "\r"], "\n", $stringValue);
    $stringValue = preg_replace('/\n{3,}/', "\n\n", $stringValue) ?? $stringValue;

    return trim($stringValue);
}

/**
 * Genera o recupera el token CSRF de la sesión.
 *
 * @return string
 */
function madayaContactGetOrCreateCsrfToken(): string
{
    madayaContactEnsureSession();

    $token = $_SESSION[MADAYA_CONTACT_CSRF_KEY] ?? '';
    if (!is_string($token) || $token === '') {
        $token = bin2hex(random_bytes(32));
        $_SESSION[MADAYA_CONTACT_CSRF_KEY] = $token;
    }

    return $token;
}

/**
 * Regenera el token CSRF tras cada POST procesado.
 *
 * @return string
 */
function madayaContactRotateCsrfToken(): string
{
    madayaContactEnsureSession();
    $token = bin2hex(random_bytes(32));
    $_SESSION[MADAYA_CONTACT_CSRF_KEY] = $token;

    return $token;
}

/**
 * Verifica token CSRF enviado en formulario.
 *
 * @param string $providedToken
 * @return bool
 */
function madayaContactIsValidCsrf(string $providedToken): bool
{
    madayaContactEnsureSession();

    $sessionToken = $_SESSION[MADAYA_CONTACT_CSRF_KEY] ?? '';
    if (!is_string($sessionToken) || $sessionToken === '' || $providedToken === '') {
        return false;
    }

    return hash_equals($sessionToken, $providedToken);
}

/**
 * Guarda un mensaje flash para mostrar en contacto.php.
 *
 * @param array<string, mixed> $flash
 * @return void
 */
function madayaContactSetFlash(array $flash): void
{
    madayaContactEnsureSession();
    $_SESSION[MADAYA_CONTACT_FLASH_KEY] = $flash;
}

/**
 * Recupera y elimina el mensaje flash actual.
 *
 * @return array<string, mixed>
 */
function madayaContactPullFlash(): array
{
    madayaContactEnsureSession();

    $flash = $_SESSION[MADAYA_CONTACT_FLASH_KEY] ?? [];
    unset($_SESSION[MADAYA_CONTACT_FLASH_KEY]);

    return is_array($flash) ? $flash : [];
}

/**
 * Aplica un rate limit sencillo por sesión.
 *
 * @param int $maxAttempts
 * @param int $windowSeconds
 * @return bool true si se permite continuar
 */
function madayaContactCanSubmitByRateLimit(int $maxAttempts = 4, int $windowSeconds = 900): bool
{
    madayaContactEnsureSession();

    $attempts = $_SESSION[MADAYA_CONTACT_RATE_LIMIT_KEY] ?? [];
    if (!is_array($attempts)) {
        $attempts = [];
    }

    $now = time();
    $windowStart = $now - $windowSeconds;

    $attempts = array_values(array_filter($attempts, static function (mixed $timestamp) use ($windowStart): bool {
        return is_int($timestamp) && $timestamp >= $windowStart;
    }));

    if (count($attempts) >= $maxAttempts) {
        $_SESSION[MADAYA_CONTACT_RATE_LIMIT_KEY] = $attempts;
        return false;
    }

    $attempts[] = $now;
    $_SESSION[MADAYA_CONTACT_RATE_LIMIT_KEY] = $attempts;

    return true;
}

/**
 * Valida y sanitiza payload del formulario.
 *
 * @param array<string, mixed> $rawData
 * @return array{data: array<string, string>, old: array<string, string>, errors: array<string, string>}
 */
function madayaContactValidate(array $rawData): array
{
    $nombre = madayaContactNormalizeSingleLine($rawData['nombre'] ?? '');
    $email = madayaContactNormalizeSingleLine($rawData['email'] ?? '');
    $telefono = madayaContactNormalizeSingleLine($rawData['telefono'] ?? '');
    $preferencia = madayaContactNormalizeSingleLine($rawData['preferencia_contacto'] ?? '');
    $mensaje = madayaContactNormalizeMultiline($rawData['mensaje'] ?? '');
    $consentimiento = isset($rawData['consentimiento_privacidad']) ? '1' : '';

    $errors = [];

    $nameLen = madayaContactStrLen($nombre);
    if ($nameLen < 2 || $nameLen > 80) {
        $errors['nombre'] = 'El nombre debe tener entre 2 y 80 caracteres.';
    }

    if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false || madayaContactStrLen($email) > 254) {
        $errors['email'] = 'Introduce un correo electronico valido.';
    }

    if ($telefono !== '' && !preg_match('/^[0-9+() .-]{6,25}$/', $telefono)) {
        $errors['telefono'] = 'El telefono solo puede contener numeros, espacios y +().-';
    }

    $allowedPreferences = ['email', 'llamada', 'whatsapp'];
    if (!in_array($preferencia, $allowedPreferences, true)) {
        $errors['preferencia_contacto'] = 'Selecciona una preferencia de contacto valida.';
    }

    $messageLen = madayaContactStrLen($mensaje);
    if ($messageLen < 20 || $messageLen > 2000) {
        $errors['mensaje'] = 'El mensaje debe tener entre 20 y 2000 caracteres.';
    }

    if ($consentimiento !== '1') {
        $errors['consentimiento_privacidad'] = 'Debes aceptar la Politica de privacidad para enviar el formulario.';
    }

    return [
        'data' => [
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'preferencia_contacto' => $preferencia,
            'mensaje' => $mensaje,
            'consentimiento_privacidad' => $consentimiento,
        ],
        'old' => [
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'preferencia_contacto' => $preferencia,
            'mensaje' => $mensaje,
            'consentimiento_privacidad' => $consentimiento,
        ],
        'errors' => $errors,
    ];
}

/**
 * Construye metadatos de trazabilidad del envío.
 *
 * @return array{iso: string, human: string}
 */
function madayaContactBuildSubmittedAt(): array
{
    $dateUtc = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    $dateLocal = $dateUtc->setTimezone(new DateTimeZone('Atlantic/Canary'));

    return [
        'iso' => $dateUtc->format(DateTimeInterface::ATOM),
        'human' => $dateLocal->format('d/m/Y H:i:s') . ' (Atlantic/Canary)',
    ];
}

/**
 * Redirige a la página de contacto preservando ancla del formulario.
 *
 * @return never
 */
function madayaContactRedirectToPage(): never
{
    header('Location: /contacto.php#formulario-contacto', true, 303);
    exit;
}
