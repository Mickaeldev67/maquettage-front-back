<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($titrePage) ? $titrePage : "Centre medico-sociale"; ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400&display=swap">
  <link rel="stylesheet" href="./css/style.css">
  
  <script src="./js/a11y.js"></script>
  <script src="./js/tuto.js" defer></script>
</head>
<body>

  <a class="skip-link" href="#contenu">Aller au contenu</a>

  <div class="a11y-bar">
    <div class="container container--text">
      <div class="a11y-group" role="group" aria-labelledby="label-taille">
        <span class="a11y-group__label" id="label-taille">Taille du texte :</span>
        <button type="button" class="btn btn-size" data-size="0" aria-pressed="true">A<span class="sr-only"> normale</span></button>
        <button type="button" class="btn btn-size" data-size="1" aria-pressed="false">A+<span class="sr-only"> grande</span></button>
        <button type="button" class="btn btn-size" data-size="2" aria-pressed="false">A++<span class="sr-only"> très grande</span></button>
      </div>
      <button type="button" class="btn" id="btn-theme" aria-pressed="false">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor"/></svg>
        <span class="btn-theme__label">Affichage sombre</span>
      </button>
    </div>
  </div>

  <header class="site-header">
    <div class="container container--text">
      <a class="logo" href="index.php?page=accueil">
        <span class="logo__icon" aria-hidden="true">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" focusable="false"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M12 11v6"/><path d="M9 14h6"/></svg>
        </span>
        <span class="logo__text"><span class="logo__name">Centre Médico-Social</span></span>
      </a>
      <a class="btn" href="index.php?page=accueil">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="15 18 9 12 15 6"/></svg>
        Retour à l'accueil
      </a>
      <a class="btn" href="index.php?page=tuto">
        Tuto
      </a>
    </div>
  </header>