<?php

declare(strict_types=1);

$repoRoot = dirname(__DIR__);
$publicCandidate = $repoRoot . DIRECTORY_SEPARATOR . 'public';
$webRoot = is_dir($publicCandidate) ? $publicCandidate : $repoRoot;
$outputFile = $webRoot . DIRECTORY_SEPARATOR . 'sitemap.xml';
$baseUrl = 'https://ecomadaya.es';

// Verificamos que el directorio web existe.
if (!is_dir($webRoot)) {
    fwrite(STDERR, "Error: no se encontro el directorio web para generar el sitemap.\n");
    exit(1);
}

$entries = [];

// Recorremos los archivos PHP del directorio web para extraer las URLs canonicas.
$iterator = new DirectoryIterator($webRoot);
foreach ($iterator as $fileInfo) {
    if (!$fileInfo->isFile()) {
        continue;
    }

    if (strtolower($fileInfo->getExtension()) !== 'php') {
        continue;
    }

    $filename = $fileInfo->getFilename();
    if ($filename === 'LICENSE' || $filename === 'NOTICE') {
        continue;
    }

    $path = $fileInfo->getPathname();
    $content = file_get_contents($path);
    if ($content === false) {
        fwrite(STDERR, "Aviso: no se pudo leer {$filename}.\n");
        continue;
    }

    // Ejemplo: $canonicalUrl = MADAYA_SITE_URL . '/contacto/';
    if (preg_match('/\$canonicalUrl\s*=\s*MADAYA_SITE_URL\s*\.\s*\'([^\']+)\'\s*;/', $content, $matches) !== 1) {
        continue;
    }
    
    $canonicalPath = $matches[1]; //$matches[1] guarda solo el primer grupo capturado por ([^\']+), por ejemplo: /contacto/ (sin comillas)
    $loc = rtrim($baseUrl, '/') . $canonicalPath;

    $lastmod = date('Y-m-d', (int) $fileInfo->getMTime());

    $entries[] = [
        'loc' => $loc,
        'lastmod' => $lastmod,
    ];
}

// Verificamos que se hayan encontrado URLs canonicas.
if ($entries === []) {
    fwrite(STDERR, "Error: no se detectaron URLs canonicas para generar el sitemap.\n");
    exit(1);
}

// Ordenamos las entradas para que la URL principal (home) aparezca primero, seguida de las demás en orden alfabético.
usort(
    $entries,
    static function (array $a, array $b): int {
        if ($a['loc'] === 'https://ecomadaya.es/') {
            return -1;
        }

        if ($b['loc'] === 'https://ecomadaya.es/') {
            return 1;
        }

        return strcmp($a['loc'], $b['loc']);
    }
);

// Generamos el contenido XML del sitemap.
$xml = [];
$xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
$xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($entries as $entry) {
    $xml[] = "\t<url>";
    $xml[] = "\t\t<loc>" . htmlspecialchars($entry['loc'], ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>";
    $xml[] = "\t\t<lastmod>{$entry['lastmod']}</lastmod>";
    $xml[] = "\t</url>";
}

$xml[] = '</urlset>';
$xml[] = '';

$result = file_put_contents($outputFile, implode("\n", $xml));
if ($result === false) {
    fwrite(STDERR, "Error: no se pudo escribir {$outputFile}.\n");
    exit(1);
}

$relativeOutput = str_replace($repoRoot . DIRECTORY_SEPARATOR, '', $outputFile);
fwrite(STDOUT, "Sitemap generado en {$relativeOutput} con " . count($entries) . " URLs.\n");