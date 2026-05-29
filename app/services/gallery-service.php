<?php

/**
 * Determina si la aplicación está ejecutándose en entorno de desarrollo. *
 * @return bool `true` si el entorno es de desarrollo; `false` en cualquier otro caso.
 */
function isDevelopmentEnvironment(): bool
{
    $appEnv = defined('APP_ENV') ? strtolower(trim((string) APP_ENV)) : 'production';
    return in_array($appEnv, ['dev', 'development', 'local', 'test', 'testing'], true);
}

/**
 * Registra un mensaje en el log de errores solo si estamos en entorno de desarrollo.
 * @param string $message
 * @return void
 */
function logIfDevelopment(string $message): void
{
    if (isDevelopmentEnvironment()) {
        error_log($message);
    }
}

/**
 * Obtiene una lista de nombres de archivos de imagen en un directorio dado, filtrando por extensiones permitidas y ordenando por fecha de modificación (más reciente primero).
 * @param string $dir Ruta al directorio de imágenes
 * @param array $allowedExtensions Lista de extensiones de archivo permitidas (ej. ['jpg', 'jpeg', 'png', 'webp'])
 * @return string[] Lista de nombres de imagen ya filtrada y ordenada (mas reciente primero)
 */
function galleryImagesList(string $dir, array $allowedExtensions): array
{
    if (!is_dir($dir) || !is_readable($dir)) {
        logIfDevelopment("Error: No se pudo acceder al directorio de imagenes en $dir");
        return [];
    }

    $scannedFiles = scandir($dir);
    if ($scannedFiles === false) {
        logIfDevelopment("Error: scandir() no pudo leer el directorio $dir");
        return [];
    }

    $fileNames = array_filter($scannedFiles, function ($file) use ($dir, $allowedExtensions) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        return in_array($ext, $allowedExtensions, true) && is_file($dir . '/' . $file);
    });

    // Ordenar por fecha de modificación (más reciente primero), luego por nombre para estabilidad.
    // usort($fileNames, function ($a, $b) use ($dir) {
    //     $mtimeA = filemtime($dir . '/' . $a);
    //     $mtimeB = filemtime($dir . '/' . $b);

    //     $mtimeA = ($mtimeA === false) ? 0 : $mtimeA;
    //     $mtimeB = ($mtimeB === false) ? 0 : $mtimeB;

    //     $dateComparison = $mtimeB <=> $mtimeA;
    //     if ($dateComparison !== 0) {
    //         return $dateComparison;
    //     }

    //     return strcmp($a, $b);
    // });

    // Orden pseudoaleatorio.
    shuffle($fileNames);

    return array_values($fileNames);
}

/**
 * Carga un mapa opcional de descripciones desde JSON.
 * Formato esperado: {"archivo_small.webp": "Descripcion breve"}
 * @param string $jsonPath Ruta al archivo JSON de descripciones
 * @return array<string, string>
 */
function loadImageDescriptions(string $jsonPath): array
{
    if (!is_file($jsonPath) || !is_readable($jsonPath)) {
        return [];
    }

    $jsonContent = file_get_contents($jsonPath);
    if ($jsonContent === false) {
        logIfDevelopment("Aviso gallery-service.php: no se pudo leer el archivo de descripciones en $jsonPath");
        return [];
    }

    $decoded = json_decode($jsonContent, true);
    if (!is_array($decoded)) {
        logIfDevelopment("Aviso gallery-service.php: JSON de descripciones inválido en $jsonPath");
        return [];
    }

    $descriptions = [];
    foreach ($decoded as $fileName => $description) {
        if (is_string($fileName) && is_string($description) && trim($description) !== '') {
            $descriptions[$fileName] = trim($description);
        }
    }

    return $descriptions;
}

/**
 * Obtiene la descripción de una imagen a partir del mapa de descripciones.
 * Si no se encuentra una descripción específica, se devuelve un valor por defecto.
 * @param string $fileName
 * @param array $descriptionsMap
 * @return string
 */
function getImageDescription(string $fileName, array $descriptionsMap): string
{
    if (isset($descriptionsMap[$fileName]) && $descriptionsMap[$fileName] !== '') {
        return $descriptionsMap[$fileName];
    }

    return 'Trabajo de tapicería';
}

/**
 * Construye la lista de items para la galería, validando que cada imagen pequeña tenga su correspondiente grande.
 * Cada item es un array con keys: 'small', 'large' y 'description'.
 * @return array{items: array<int, array{small: string, large: string, description: string}>, invalidMapCount: int, missingLargeCount: int}
 */
function buildGalleryItems(
    string $dirSmall,
    string $dirLarge,
    array $allowedExtensions,
    string $descriptionsPath
): array {
    $filesSmall = galleryImagesList($dirSmall, $allowedExtensions);
    $descriptionsMap = loadImageDescriptions($descriptionsPath);

    $items = [];
    $invalidMapCount = 0;
    $missingLargeCount = 0;

    foreach ($filesSmall as $fileName) {
        $largeName = preg_replace('/_small(\.[a-z0-9]+)$/i', '_large$1', $fileName);
        if ($largeName === null || $largeName === $fileName) {
            $invalidMapCount++;
            continue;
        }

        if (!is_file($dirLarge . '/' . $largeName)) {
            $missingLargeCount++;
            continue;
        }

        $items[] = [
            'small' => $fileName,
            'large' => $largeName,
            'description' => getImageDescription($fileName, $descriptionsMap),
        ];
    }

    if ($invalidMapCount > 0 || $missingLargeCount > 0) {
        logIfDevelopment(
            "Aviso gallery-service.php: items omitidos en galeria-hogar " .
                "(sin mapeo _small/_large: $invalidMapCount, sin archivo large: $missingLargeCount)"
        );
    }

    return [
        'items' => $items,
        'invalidMapCount' => $invalidMapCount,
        'missingLargeCount' => $missingLargeCount,
    ];
}
