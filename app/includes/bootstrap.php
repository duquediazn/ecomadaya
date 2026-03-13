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