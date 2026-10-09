<main id="contenu" class="container container--text tuto" tabindex="-1">

    <div class="tuto__head">
        <h1 data-fill="titre">Chargement du tuto…</h1>
        <p class="tuto__subtitle" data-fill="sous_titre"></p>
    </div>

    <noscript>
        <p>Cette page a besoin de JavaScript pour afficher le tuto. Demandez de l'aide à l'accueil du centre.</p>
    </noscript>

    <!-- Message d'erreur si la fiche ne se charge pas -->
    <p id="erreur" role="alert" hidden></p>

    <div class="mode-switch" role="group" aria-label="Façon de lire la fiche">
        <button type="button" class="btn" id="btn-mode-pas" aria-pressed="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                <path d="M4 20h4v-4h4v-4h4V8h4" />
            </svg>
            Pas à pas
        </button>
        <button type="button" class="btn" id="btn-mode-fiche" aria-pressed="false">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                <path d="M6 2h9l5 5v15H6z" />
                <path d="M14 2v6h6" />
                <path d="M9 13h6" />
                <path d="M9 17h6" />
            </svg>
            Toute la fiche
        </button>
    </div>

    <div id="vue-pas">

        <nav aria-label="Avancement">
            <ol class="parts">
                <li data-part="0"><span class="parts__mark" aria-hidden="true">1</span><span>Avant de commencer<span class="sr-only part-state"></span></span></li>
                <li data-part="1"><span class="parts__mark" aria-hidden="true">2</span><span>Les étapes<span class="sr-only part-state"></span></span></li>
                <li data-part="2"><span class="parts__mark" aria-hidden="true">3</span><span>Pour finir<span class="sr-only part-state"></span></span></li>
            </ol>
        </nav>

        <!-- Annonce lue par les lecteurs d'écran à chaque changement d'écran -->
        <p class="sr-only" id="annonce" aria-live="polite"></p>

        <div class="screen" style="margin-top: 1.4rem">

            <div id="ecran-prevoir" class="screen__body">
                <h2 id="titre-ecran" tabindex="-1">Avant de commencer</h2>
                <p class="screen__hint" id="aide-prevoir">Cochez quand c'est bon pour vous. Ce n'est pas obligatoire.</p>
                <fieldset class="checklist" aria-describedby="aide-prevoir">
                    <legend class="sr-only">À prévoir</legend>
                    <!-- les cases sont créées par tuto.js -->
                </fieldset>
                <p class="status-ok" id="etat-prevoir" aria-live="polite"></p>
            </div>

            <!-- Écrans 2 à N : une étape par écran -->
            <div id="ecran-etape" class="screen__body" hidden>
                <p class="screen__step-label" id="label-etape"></p>
                <div class="progress" aria-hidden="true">
                    <div class="progress__bar" id="barre"></div>
                </div>
                <h2 class="screen__instruction" id="texte-etape" tabindex="-1"></h2>
                <figure class="figure">
                    <div class="figure__placeholder" id="image-etape">[CAPTURE D'ÉCRAN DE L'ÉTAPE]</div>
                </figure>
            </div>

            <!-- Dernier écran : points de vigilance -->
            <div id="ecran-vigilance" class="screen__body" hidden>
                <h2 class="warn-title" id="titre-vigilance" tabindex="-1">
                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    Points de vigilance
                </h2>
                <ul class="warn-list" id="liste-vigilance"></ul>
                <p class="success" id="bravo" role="status" hidden>
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="8 12.5 11 15.5 16 9.5" />
                    </svg>
                    Bravo, vous avez terminé ce tuto !
                </p>
            </div>

            <div class="screen__nav">
                <button type="button" class="btn btn--lg" id="btn-retour" hidden>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Retour
                </button>
                <button type="button" class="btn btn--primary btn--lg" id="btn-suivant">
                    <span id="label-suivant">Commencer</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <div id="vue-fiche" class="full" hidden>
        <section aria-labelledby="f-prevoir">
            <h2 id="f-prevoir" tabindex="-1">À prévoir</h2>
            <ul data-list="prevoir"></ul>
        </section>
        <section class="full__essentiel" aria-labelledby="f-essentiel">
            <h2 id="f-essentiel">L'essentiel</h2>
            <ol data-list="essentiel"></ol>
        </section>
        <section class="full__vigil" aria-labelledby="f-vigil">
            <h2 id="f-vigil" class="warn-title">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                Points de vigilance
            </h2>
            <ul data-list="vigilance"></ul>
        </section>
    </div>

    <!-- ===== Glossaire repliable (toujours accessible) ===== -->
    <section class="glossary" aria-labelledby="titre-mots">
        <h2 id="titre-mots">
            <button type="button" class="glossary__toggle" id="btn-mots" aria-expanded="false" aria-controls="liste-mots">
                <span>À comprendre : les mots utiles (<span id="nb-mots">0</span>)</span>
                <svg class="chevron" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </button>
        </h2>
        <dl id="liste-mots" hidden></dl>
    </section>

    <p class="source">Source : <span data-fill="source"></span></p>

    <p>
        <button type="button" class="btn" id="btn-imprimer">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                <polyline points="6 9 6 2 18 2 18 9" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                <rect x="6" y="14" width="12" height="8" />
            </svg>
            Imprimer la fiche
        </button>
    </p>
</main>