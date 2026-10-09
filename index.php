<?php
// 1. Déterminer quelle page est demandée (par défaut 'accueil')
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

$titrePage = "Centre de formation médico-sociale";
$data = [];

switch ($page) {
    case 'accueil':
        $titrePage = "Accueil - Centre de formation médico-sociale";
        $data['message'] = "Bienvenue sur le site de formation médico-sociale !";
        break;

    default:
        $titrePage = "Erreur 404";
        $page = '404';
        break;
}
include './front/header.php';

$viewFile = './front/' . $page . '.php';
if (file_exists($viewFile)) {
    include $viewFile;
} else {
    echo "<h2>Erreur 404</h2><p>La page demandée est introuvable.</p>";
}

include './front/footer.php';
?>