<?php

header('Content-Type: application/json; charset=utf-8');

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
