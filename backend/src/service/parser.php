<?php
require __DIR__ . '/../../vendor/autoload.php';

use Smalot\PdfParser\Parser;

function pdfToStructuredJson(string $path): string
{
    $parser = new Parser();
    $text = $parser->parseFile($path)->getText();

    $lines = preg_split('/\R/u', $text);
    $lines = array_values(array_filter(array_map('trim', $lines), fn($l) => $l !== ''));

    $result = [
        'titre'      => null,
        'sous_titre' => null,
        'sections'   => [],
        'source'     => null,
    ];
    $current = null;

    foreach ($lines as $line) {
        if (preg_match('/^[•\-–*]\s*(.+)$/u', $line, $m)) {
            if ($current !== null) {
                $result['sections'][$current][] = $m[1];
            }
            continue;
        }

        // Lignes sans puce : en-tête, pied de page ou titre de section
        if ($result['titre'] === null)      { $result['titre'] = $line; continue; }
        if ($result['sous_titre'] === null) { $result['sous_titre'] = $line; continue; }
        if (stripos($line, 'Vidéo par') === 0) { $result['source'] = $line; continue; }

        $current = $line;
        $result['sections'][$current] = [];
    }

    return json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}