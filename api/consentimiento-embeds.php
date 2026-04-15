<?php
require_once __DIR__ . '/../app/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit;
}

$decision = strtolower(trim((string) ($_POST['decision'] ?? '')));
$returnTo = trim((string) ($_POST['return_to'] ?? '/index.php'));

if (!in_array($decision, ['accept', 'reject'], true)) {
    $decision = 'reject';
}

// Redirige solo a rutas internas seguras del sitio.
if ($returnTo === '' || $returnTo[0] !== '/' || str_starts_with($returnTo, '//')) {
    $returnTo = '/index.php';
}

// Evita redirecciones abiertas a URLs externas.
if (preg_match('/^[a-z][a-z0-9+\-.]*:/i', $returnTo) === 1) { 
    $returnTo = '/index.php';
}

madayaSetExternalMediaConsent($decision === 'accept');

header('Location: ' . $returnTo, true, 303);
exit;
