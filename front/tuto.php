<main id="contenu" class="container container--text tuto" tabindex="-1">

    <div class="tuto__head">
      <h1>Se connecter à son compte CAF</h1>
      <p class="tuto__subtitle">Fiche mémo — La Formation pour tous</p>
    </div>

    <!-- ===== Choix du mode de lecture ===== -->
    <div class="mode-switch" role="group" aria-label="Façon de lire la fiche">
      <button type="button" class="btn" id="btn-mode-pas" aria-pressed="true">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 20h4v-4h4v-4h4V8h4"/></svg>
        Pas à pas
      </button>
      <button type="button" class="btn" id="btn-mode-fiche" aria-pressed="false">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M6 2h9l5 5v15H6z"/><path d="M14 2v6h6"/><path d="M9 13h6"/><path d="M9 17h6"/></svg>
        Toute la fiche
      </button>
    </div>

    <!-- =====================================================
         MODE PAS À PAS : un seul écran visible à la fois.
         Chaque écran a data-screen="n" et data-part="0|1|2"
         (0 = Avant de commencer, 1 = Les étapes, 2 = Pour finir)
         ===================================================== -->
    <div id="vue-pas">

      <nav aria-label="Avancement">
        <ol class="parts">
          <li aria-current="step"><span class="parts__mark" aria-hidden="true">1</span><span>Avant de commencer<span class="sr-only part-state"> (en cours)</span></span></li>
          <li><span class="parts__mark" aria-hidden="true">2</span><span>Les étapes<span class="sr-only part-state"></span></span></li>
          <li><span class="parts__mark" aria-hidden="true">3</span><span>Pour finir<span class="sr-only part-state"></span></span></li>
        </ol>
      </nav>

      <!-- Annonce lue par les lecteurs d'écran à chaque changement d'écran -->
      <p class="sr-only" id="annonce" aria-live="polite"></p>

      <div class="screen" style="margin-top: 1.4rem">

        <!-- ---------- Écran 0 : À prévoir ---------- -->
        <div class="screen__body" data-screen="0" data-part="0" data-annonce="Avant de commencer">
          <h2 tabindex="-1">Avant de commencer</h2>
          <p class="screen__hint" id="aide-prevoir">Cochez quand c'est bon pour vous. Ce n'est pas obligatoire.</p>
          <fieldset class="checklist" aria-describedby="aide-prevoir">
            <legend class="sr-only">À prévoir</legend>
            <label class="check">
              <input type="checkbox">
              <span>Avoir son numéro de sécurité sociale à portée de main.</span>
            </label>
            <label class="check">
              <input type="checkbox">
              <span>Connaître son mot de passe CAF ou pouvoir le récupérer.</span>
            </label>
            <label class="check">
              <input type="checkbox">
              <span>Être dans un endroit calme pour saisir ses informations.</span>
            </label>
          </fieldset>
          <p class="status-ok" id="etat-prevoir" aria-live="polite">0 sur 3 cochés</p>
        </div>

        <!-- ---------- Écrans 1 à 5 : L'essentiel ---------- -->
        <div class="screen__body" data-screen="1" data-part="1" data-annonce="Étape 1 sur 5" hidden>
          <p class="screen__step-label">Étape 1 sur 5</p>
          <div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 20%"></div></div>
          <h2 class="screen__instruction" tabindex="-1">Aller sur le site de la CAF et cliquer sur Mon Compte.</h2>
          <figure class="figure">
            <div class="figure__placeholder">[CAPTURE D'ÉCRAN : page d'accueil caf.fr, bouton « Mon Compte » entouré]</div>
          </figure>
        </div>

        <div class="screen__body" data-screen="2" data-part="1" data-annonce="Étape 2 sur 5" hidden>
          <p class="screen__step-label">Étape 2 sur 5</p>
          <div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 40%"></div></div>
          <h2 class="screen__instruction" tabindex="-1">Saisir les 13 chiffres de son numéro de sécurité sociale.</h2>
          <figure class="figure">
            <div class="figure__placeholder">[CAPTURE D'ÉCRAN : champ « Numéro de sécurité sociale »]</div>
          </figure>
        </div>

        <div class="screen__body" data-screen="3" data-part="1" data-annonce="Étape 3 sur 5" hidden>
          <p class="screen__step-label">Étape 3 sur 5</p>
          <div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 60%"></div></div>
          <h2 class="screen__instruction" tabindex="-1">Entrer son mot de passe puis cliquer sur Se connecter.</h2>
          <figure class="figure">
            <div class="figure__placeholder">[CAPTURE D'ÉCRAN : champ « Mot de passe » et bouton « Se connecter »]</div>
          </figure>
        </div>

        <div class="screen__body" data-screen="4" data-part="1" data-annonce="Étape 4 sur 5" hidden>
          <p class="screen__step-label">Étape 4 sur 5</p>
          <div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 80%"></div></div>
          <h2 class="screen__instruction" tabindex="-1">Accéder à la page d’accueil du compte.</h2>
          <figure class="figure">
            <div class="figure__placeholder">[CAPTURE D'ÉCRAN : page d'accueil de Mon Compte]</div>
          </figure>
        </div>

        <div class="screen__body" data-screen="5" data-part="1" data-annonce="Étape 5 sur 5" hidden>
          <p class="screen__step-label">Étape 5 sur 5</p>
          <div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 100%"></div></div>
          <h2 class="screen__instruction" tabindex="-1">Ouvrir les rubriques pour voir ses paiements et ses démarches.</h2>
          <figure class="figure">
            <div class="figure__placeholder">[CAPTURE D'ÉCRAN : rubriques « Mes paiements » et « Mes démarches »]</div>
          </figure>
        </div>

        <!-- ---------- Écran 6 : Points de vigilance ---------- -->
        <div class="screen__body" data-screen="6" data-part="2" data-annonce="Pour finir : points de vigilance" hidden>
          <h2 class="warn-title" tabindex="-1">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Points de vigilance
          </h2>
          <ul class="warn-list">
            <li>Vérifier les chiffres du numéro de sécurité sociale avant de valider.</li>
            <li>Ne pas entrer son mot de passe sur un ordinateur partagé non sécurisé.</li>
            <li>Se déconnecter après consultation surtout sur un poste public.</li>
          </ul>
          <p class="success" id="bravo" role="status" hidden>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10"/><polyline points="8 12.5 11 15.5 16 9.5"/></svg>
            Bravo, vous avez terminé ce tuto !
          </p>
        </div>

        <!-- ---------- Boutons de navigation ---------- -->
        <div class="screen__nav">
          <button type="button" class="btn btn--lg" id="btn-retour" hidden>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="15 18 9 12 15 6"/></svg>
            Retour
          </button>
          <button type="button" class="btn btn--primary btn--lg" id="btn-suivant">
            <span id="label-suivant">Commencer</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- =====================================================
         MODE TOUTE LA FICHE
         ===================================================== -->
    <div id="vue-fiche" class="full" hidden>
      <section aria-labelledby="f-prevoir">
        <h2 id="f-prevoir">À prévoir</h2>
        <ul>
          <li>Avoir son numéro de sécurité sociale à portée de main.</li>
          <li>Connaître son mot de passe CAF ou pouvoir le récupérer.</li>
          <li>Être dans un endroit calme pour saisir ses informations.</li>
        </ul>
      </section>
      <section class="full__essentiel" aria-labelledby="f-essentiel">
        <h2 id="f-essentiel">L'essentiel</h2>
        <ol>
          <li>Aller sur le site de la CAF et cliquer sur Mon Compte.</li>
          <li>Saisir les 13 chiffres de son numéro de sécurité sociale.</li>
          <li>Entrer son mot de passe puis cliquer sur Se connecter.</li>
          <li>Accéder à la page d’accueil du compte.</li>
          <li>Ouvrir les rubriques pour voir ses paiements et ses démarches.</li>
        </ol>
      </section>
      <section class="full__vigil" aria-labelledby="f-vigil">
        <h2 id="f-vigil" class="warn-title">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Points de vigilance
        </h2>
        <ul>
          <li>Vérifier les chiffres du numéro de sécurité sociale avant de valider.</li>
          <li>Ne pas entrer son mot de passe sur un ordinateur partagé non sécurisé.</li>
          <li>Se déconnecter après consultation surtout sur un poste public.</li>
        </ul>
      </section>
    </div>

    <!-- ===== Glossaire repliable (toujours accessible) ===== -->
    <section class="glossary" aria-labelledby="titre-mots">
      <h2 id="titre-mots">
        <button type="button" class="glossary__toggle" id="btn-mots" aria-expanded="false" aria-controls="liste-mots">
          <span>À comprendre : les mots utiles (3)</span>
          <svg class="chevron" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
      </h2>
      <dl id="liste-mots" hidden>
        <div>
          <dt>Mon Compte</dt>
          <dd>Espace en ligne pour suivre son dossier CAF.</dd>
        </div>
        <div>
          <dt>Numéro de sécurité sociale</dt>
          <dd>Identifiant utilisé pour se connecter.</dd>
        </div>
        <div>
          <dt>Mot de passe</dt>
          <dd>Code secret pour protéger l’accès au compte.</dd>
        </div>
      </dl>
    </section>

    <p class="source">Source : Vidéo par La Caf - Officiel</p>

    <p>
      <button type="button" class="btn" id="btn-imprimer">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        Imprimer la fiche
      </button>
    </p>
  </main>