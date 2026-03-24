<?php
declare(strict_types=1);

/**
 * Endpoint JSON para carga progresiva de la galería "hogar".
 *
 * Query params:
 * - offset (int >= 0): índice inicial del bloque a devolver.
 * - limit  (int >= 1): tamaño de bloque solicitado.
 *
 * Notas de negocio:
 * - Se aplica un tope de 35 imágenes para mantener la página ligera.
 * - Este endpoint reutiliza la misma lógica de generación de galería
 *   que la versión renderizada en PHP (gallery-service.php).
 */

// Configura la cabecera para indicar que se devuelve JSON.
header('Content-Type: application/json; charset=UTF-8');

// Sanitización básica de paginación para evitar offsets/limits inválidos.
$offset = filter_input(INPUT_GET, 'offset', FILTER_VALIDATE_INT);
$limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
// Se aplican valores por defecto y límites razonables.
$offset = is_int($offset) ? max(0, $offset) : 0;
$limit = is_int($limit) ? max(1, min($limit, 50)) : 10;

$basePath = __DIR__ . '/../assets/img/galeria/hogar/';
$dirSmall = $basePath . 'small';
$dirLarge = $basePath . 'large';
$publicBasePath = '/assets/img/galeria/hogar';
$publicSmallPath = $publicBasePath . '/small';
$publicLargePath = $publicBasePath . '/large';
$descriptionsPath = $basePath . 'descripciones.json';
$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

require_once __DIR__ . '/../app/includes/gallery-service.php';

// Se construye la colección completa y se recorta al máximo permitido.
$galleryData = buildGalleryItems($dirSmall, $dirLarge, $allowedExt, $descriptionsPath);
$maxVisibleItems = 35;
$allItems = array_slice($galleryData['items'], 0, $maxVisibleItems);
$total = count($allItems);
$chunk = array_slice($allItems, $offset, $limit);

/**
 * Normaliza el formato de salida consumido por main.js.
 *
 * @param array{small: string, large: string, description: string} $item
 * @return array{smallUrl: string, largeUrl: string, description: string}
 */
$items = array_map(static function (array $item) use ($publicSmallPath, $publicLargePath): array {
    return [
        'smallUrl' => $publicSmallPath . '/' . $item['small'],
        'largeUrl' => $publicLargePath . '/' . $item['large'],
        'description' => (string) $item['description'],
    ];
}, $chunk);

/**
 * Respuesta:
 * - items: bloque de resultados.
 * - offset: desplazamiento recibido.
 * - limit: límite aplicado.
 * - nextOffset: punto de inicio para la siguiente petición.
 * - total: total de imágenes disponibles (ya limitado a 35).
 */
echo json_encode([
    'items' => $items,
    'offset' => $offset,
    'limit' => $limit,
    'nextOffset' => $offset + count($items),
    'total' => $total,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 

/*
JSON_UNESCAPED_UNICODE
No escapa caracteres Unicode.
Ejemplo: "tapicería" se queda "tapicería" (en vez de "tapicer\u00eda").

JSON_UNESCAPED_SLASHES
No escapa barras /.
Ejemplo: "/assets/img/a.webp" se queda así (en vez de "\/assets\/img\/a.webp").
*/
