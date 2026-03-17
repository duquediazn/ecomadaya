<?php
// Define APP_ENV globalmente una sola vez para todas las páginas.
if (!defined('APP_ENV')) {
    $appEnv = '';

    if (getenv('APP_ENV') !== false) {
        $appEnv = (string) getenv('APP_ENV');
    } elseif (isset($_ENV['APP_ENV'])) {
        $appEnv = (string) $_ENV['APP_ENV'];
    } elseif (isset($_SERVER['APP_ENV'])) {
        $appEnv = (string) $_SERVER['APP_ENV'];
    }

    $appEnv = strtolower(trim($appEnv));

    // Si no se ha definido, detecta automáticamente el entorno basándose en el host.
    if ($appEnv === '') {
        $rawHost = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'];
        $rawHost = trim((string) $rawHost);

        $parts = parse_url('http://' . $rawHost);
        $hostname = strtolower((string) ($parts['host'] ?? ''));
        
        $isLocal = $hostname === '' 
            || $hostname === 'localhost' 
            || $hostname === '127.0.0.1' 
            || $hostname === '::1'  
            || str_ends_with($hostname, '.local') 
            || str_ends_with($hostname, '.test');
        
        $appEnv = $isLocal ? 'development': 'production';
    }

    define('APP_ENV', $appEnv);
}

// En desarrollo $env:APP_ENV="development"; php -S localhost:8000
// En producción, APP_ENV=production en el entorno de hosting. 
// Si es Apache, establecer en el .htaccess: SetEnv APP_ENV production


// Define constantes de configuración reutilizables en las plantillas.
if (!defined('MADAYA_SITE_URL')) {
    define('MADAYA_SITE_URL', APP_ENV === 'production' ? 'https://ecomadaya.es' : 'http://localhost:8000');
}

if (!defined('MADAYA_PHONE_E164')) {
    define('MADAYA_PHONE_E164', '+34922033303');
}

if (!defined('MADAYA_PHONE_DISPLAY')) {
    define('MADAYA_PHONE_DISPLAY', '922 03 33 03');
}

if (!defined('MADAYA_EMAIL')) {
    define('MADAYA_EMAIL', 'madayaartesanal@gmail.com');
}

if (!defined('MADAYA_MAPS_URL')) {
    define('MADAYA_MAPS_URL', 'https://maps.app.goo.gl/xzP563w1RDe3MWdK9');
}

if (!defined('MADAYA_GOOGLE_REVIEWS_URL')) {
    define('MADAYA_GOOGLE_REVIEWS_URL', 'https://maps.app.goo.gl/XCqtZLrG558Dqzb76');
}

if (!defined('MADAYA_REVIEW_RATING')) {
    define('MADAYA_REVIEW_RATING', '4.1');
}

if (!defined('MADAYA_REVIEW_COUNT')) {
    define('MADAYA_REVIEW_COUNT', '34');
}

// Determinar si el taller está abierto ahora para mostrar un badge de estado.
$tz = new DateTimeZone('Atlantic/Canary');
$now = new DateTime('now', $tz);
$day = (int) $now->format('N');
$minutes = ((int) $now->format('G') * 60) + (int) $now->format('i');
$isOpenNow =
	(($day >= 1 && $day <= 5) && ($minutes >= 480 && $minutes < 900))
	|| ($day === 6 && ($minutes >= 540 && $minutes < 720));

$openBadgeClass = $isOpenNow ? 'contact-status contact-status--open' : 'contact-status contact-status--closed';
$openBadgeText = $isOpenNow ? 'Abierto ahora' : 'Ahora cerrado';

/**
 * Lee una variable de entorno de forma compatible (getenv, $_ENV, $_SERVER).
 *
 * @param string $name
 * @return string
 */
function madayaEnv(string $name): string
{
    $value = getenv($name);
    if ($value !== false) {
        return trim((string) $value);
    }

    if (isset($_ENV[$name])) {
        return trim((string) $_ENV[$name]);
    }

    if (isset($_SERVER[$name])) {
        return trim((string) $_SERVER[$name]);
    }

    return '';
}

if (!defined('MADAYA_SMTP_ENABLED')) {
    $smtpEnabledRaw = strtolower(madayaEnv('MADAYA_SMTP_ENABLED'));
    $smtpEnabled = in_array($smtpEnabledRaw, ['1', 'true', 'yes', 'on'], true);
    define('MADAYA_SMTP_ENABLED', $smtpEnabled);
}

if (!defined('MADAYA_SMTP_HOST')) {
    define('MADAYA_SMTP_HOST', madayaEnv('MADAYA_SMTP_HOST'));
}

if (!defined('MADAYA_SMTP_PORT')) {
    $smtpPortRaw = madayaEnv('MADAYA_SMTP_PORT');
    $smtpPort = (int) $smtpPortRaw;
    define('MADAYA_SMTP_PORT', $smtpPort > 0 ? $smtpPort : 587);
}

if (!defined('MADAYA_SMTP_ENCRYPTION')) {
    $smtpEncryption = strtolower(madayaEnv('MADAYA_SMTP_ENCRYPTION'));
    if (!in_array($smtpEncryption, ['tls', 'ssl', 'none'], true)) {
        $smtpEncryption = 'tls';
    }
    define('MADAYA_SMTP_ENCRYPTION', $smtpEncryption);
}

if (!defined('MADAYA_SMTP_USERNAME')) {
    define('MADAYA_SMTP_USERNAME', madayaEnv('MADAYA_SMTP_USERNAME'));
}

if (!defined('MADAYA_SMTP_PASSWORD')) {
    define('MADAYA_SMTP_PASSWORD', madayaEnv('MADAYA_SMTP_PASSWORD'));
}

if (!defined('MADAYA_SMTP_FROM_EMAIL')) {
    $smtpFromEmail = madayaEnv('MADAYA_SMTP_FROM_EMAIL');
    define('MADAYA_SMTP_FROM_EMAIL', $smtpFromEmail !== '' ? $smtpFromEmail : MADAYA_EMAIL);
}

if (!defined('MADAYA_SMTP_FROM_NAME')) {
    $smtpFromName = madayaEnv('MADAYA_SMTP_FROM_NAME');
    define('MADAYA_SMTP_FROM_NAME', $smtpFromName !== '' ? $smtpFromName : 'Web Madaya');
}

if (!defined('MADAYA_SMTP_TIMEOUT')) {
    $smtpTimeoutRaw = madayaEnv('MADAYA_SMTP_TIMEOUT');
    $smtpTimeout = (int) $smtpTimeoutRaw;
    define('MADAYA_SMTP_TIMEOUT', $smtpTimeout > 0 ? $smtpTimeout : 15);
}

if (!defined('MADAYA_SMTP_DEBUG')) {
    $smtpDebugRaw = madayaEnv('MADAYA_SMTP_DEBUG');
    $smtpDebug = (int) $smtpDebugRaw;
    if ($smtpDebug < 0 || $smtpDebug > 4) {
        $smtpDebug = 0;
    }
    define('MADAYA_SMTP_DEBUG', $smtpDebug);
}

if (!defined('MADAYA_SMTP_AUTH')) {
    $smtpAuthRaw = strtolower(madayaEnv('MADAYA_SMTP_AUTH'));
    // Por defecto true en producción. En local con Mailpit establecer MADAYA_SMTP_AUTH=0.
    $smtpAuth = !in_array($smtpAuthRaw, ['0', 'false', 'no', 'off'], true);
    define('MADAYA_SMTP_AUTH', $smtpAuth);
}