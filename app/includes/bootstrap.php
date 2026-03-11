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