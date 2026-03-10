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
        $host = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? '');
        $host = strtolower(trim((string) $host));

        if ($host === '' || $host === 'localhost' || $host === '127.0.0.1' || $host === '::1' || str_ends_with($host, '.local') || str_ends_with($host, '.test')) {
            $appEnv = 'development';
        } else {
            $appEnv = 'production';
        }
    }

    define('APP_ENV', $appEnv);
}

// En desarrollo $env:APP_ENV="development"; php -S localhost:8000
// En producción, APP_ENV=production en el entorno de hosting. 
// Si es Apache, establecer en el .htaccess: SetEnv APP_ENV production