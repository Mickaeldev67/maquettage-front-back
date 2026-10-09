<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

require __DIR__ . '/../src/service/parser.php';

try {
    $pdf = __DIR__ . '/../tuto-peda-caf.pdf';

    if (!is_file($pdf)) {
        http_response_code(404);
        echo json_encode(['error' => 'PDF introuvable']);
        exit;
    }

    echo pdfToStructuredJson($pdf);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la lecture du PDF']);
}
