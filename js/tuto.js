/* =========================================================
   Page tutoriel : charge une fiche JSON et l'affiche
   - mode "Pas à pas" : un écran à la fois
   - mode "Toute la fiche" : tout sur une page
   - glossaire repliable
   Règle de sécurité : on n'utilise QUE textContent (jamais innerHTML)
   pour insérer le texte de la fiche.
   ========================================================= */
(function () {
  'use strict';

  /* ---------- 1. Raccourcis ---------- */
  const $ = (sel) => document.querySelector(sel);
  const $$ = (sel) => Array.from(document.querySelectorAll(sel));

  /* ---------- 2. État de la page ---------- */
  const state = {
    fiche: null,   // données normalisées
    screen: 0,     // 0 = À prévoir, 1..N = étapes, N+1 = vigilance
    mode: 'pas'    // 'pas' ou 'fiche'
  };

  /* ---------- 3. Chargement de la fiche ---------- */
  // tuto.html?fiche=se-connecter-caf  → data/se-connecter-caf.json
  function ficheDemandee() {
    const nom = new URLSearchParams(location.search).get('fiche') || 'se-connecter-caf';
    // On n'accepte que lettres minuscules, chiffres et tirets (évite ../ etc.)
    return /^[a-z0-9-]+$/.test(nom) ? nom : 'se-connecter-caf';
  }

  async function chargerFiche() {
    const reponse = await fetch('data/' + ficheDemandee() + '.json');
    if (!reponse.ok) throw new Error('HTTP ' + reponse.status);
    return reponse.json();
  }

  // Transforme le JSON brut en objet simple à utiliser
  function normaliser(json) {
    const s = json.sections || {};
    return {
      titre: json.titre || '',
      sousTitre: json.sous_titre || '',
      source: json.source || '',
      essentiel: s["L'essentiel"] || [],
      prevoir: s['À prévoir'] || [],
      vigilance: s['Points de vigilance'] || [],
      mots: (s['À comprendre'] || []).map(function (ligne) {
        const morceaux = ligne.split(' = ');
        const terme = morceaux[0].trim();
        return {
          terme: terme.charAt(0).toUpperCase() + terme.slice(1),
          definition: morceaux.slice(1).join(' = ').trim()
        };
      })
    };
  }

  /* ---------- 4. Petites fonctions d'aide ---------- */
  function remplirListe(liste, items) {
    liste.replaceChildren();
    items.forEach(function (texte) {
      const li = document.createElement('li');
      li.textContent = texte;
      liste.appendChild(li);
    });
  }

  /* ---------- 5. Contenu fixe (titres, listes, glossaire) ---------- */
  function afficherContenu(f) {
    document.title = f.titre + ' – Mes tutos pas à pas';
    $$('[data-fill="titre"]').forEach((el) => { el.textContent = f.titre; });
    $$('[data-fill="sous_titre"]').forEach((el) => { el.textContent = f.sousTitre; });
    $$('[data-fill="source"]').forEach((el) => { el.textContent = f.source; });

    // Vue "Toute la fiche"
    remplirListe($('[data-list="prevoir"]'), f.prevoir);
    remplirListe($('[data-list="essentiel"]'), f.essentiel);
    remplirListe($('[data-list="vigilance"]'), f.vigilance);

    // Écran vigilance (mode pas à pas)
    remplirListe($('#liste-vigilance'), f.vigilance);

    // Cases à cocher "À prévoir"
    const fieldset = $('.checklist');
    f.prevoir.forEach(function (texte, i) {
      const label = document.createElement('label');
      label.className = 'check';
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.id = 'prevoir-' + i;
      input.addEventListener('change', majEtatPrevoir);
      const span = document.createElement('span');
      span.textContent = texte;
      label.append(input, span); // la case est DANS le label : clic sur le texte = coche
      fieldset.appendChild(label);
    });
    majEtatPrevoir();

    // Glossaire
    const dl = $('#liste-mots');
    f.mots.forEach(function (mot) {
      const groupe = document.createElement('div');
      const dt = document.createElement('dt');
      dt.textContent = mot.terme;
      const dd = document.createElement('dd');
      dd.textContent = mot.definition;
      groupe.append(dt, dd);
      dl.appendChild(groupe);
    });
    $('#nb-mots').textContent = f.mots.length;
  }

  function majEtatPrevoir() {
    const total = state.fiche.prevoir.length;
    const coches = $$('.checklist input:checked').length;
    $('#etat-prevoir').textContent = coches === total
      ? 'Tout est prêt, vous pouvez commencer.'
      : coches + ' sur ' + total + ' cochés';
  }

  /* ---------- 6. Mode pas à pas : affichage d'un écran ---------- */
  function afficherEcran(deplacerFocus) {
    const f = state.fiche;
    const nbEtapes = f.essentiel.length;
    const ecran = state.screen;
    const estPrevoir = ecran === 0;
    const estEtape = ecran >= 1 && ecran <= nbEtapes;
    const estVigilance = ecran === nbEtapes + 1;

    $('#ecran-prevoir').hidden = !estPrevoir;
    $('#ecran-etape').hidden = !estEtape;
    $('#ecran-vigilance').hidden = !estVigilance;
    $('#bravo').hidden = true;

    // Avancement en 3 parties
    const partie = estPrevoir ? 0 : (estEtape ? 1 : 2);
    $$('.parts li').forEach(function (li, i) {
      const enCours = i === partie;
      const fini = i < partie;
      if (enCours) li.setAttribute('aria-current', 'step'); else li.removeAttribute('aria-current');
      li.classList.toggle('is-done', fini);
      li.querySelector('.parts__mark').textContent = fini ? '✓' : String(i + 1);
      li.querySelector('.part-state').textContent = enCours ? ' (en cours)' : (fini ? ' (terminé)' : '');
    });

    let titreAFocus;
    let annonce;

    if (estPrevoir) {
      titreAFocus = $('#titre-ecran');
      annonce = 'Avant de commencer';
    } else if (estEtape) {
      const libelle = 'Étape ' + ecran + ' sur ' + nbEtapes;
      $('#label-etape').textContent = libelle;
      $('#texte-etape').textContent = f.essentiel[ecran - 1];
      $('#barre').style.width = Math.round((ecran / nbEtapes) * 100) + '%';
      $('#image-etape').textContent = "[CAPTURE D'ÉCRAN DE L'ÉTAPE " + ecran + ']';
      titreAFocus = $('#texte-etape');
      annonce = libelle;
    } else {
      titreAFocus = $('#titre-vigilance');
      annonce = 'Pour finir : points de vigilance';
    }

    // Boutons
    $('#btn-retour').hidden = estPrevoir;
    $('#label-suivant').textContent = estPrevoir ? 'Commencer'
      : estVigilance ? "J'ai terminé"
      : ecran === nbEtapes ? 'Continuer'
      : 'Étape suivante';

    // Annonce pour lecteurs d'écran + focus sur le nouveau titre (RGAA 7.1 / WCAG 2.4.3)
    $('#annonce').textContent = annonce;
    if (deplacerFocus) titreAFocus.focus();
  }

  function suivant() {
    const derniere = state.fiche.essentiel.length + 1;
    if (state.screen === derniere) {
      const bravo = $('#bravo');
      bravo.hidden = false;
      $('#btn-suivant').focus();
      return;
    }
    state.screen += 1;
    afficherEcran(true);
  }

  function retour() {
    if (state.screen === 0) return;
    state.screen -= 1;
    afficherEcran(true);
  }

  /* ---------- 7. Changement de mode ---------- */
  function changerMode(mode) {
    state.mode = mode;
    const pas = mode === 'pas';
    $('#vue-pas').hidden = !pas;
    $('#vue-fiche').hidden = pas;
    $('#btn-mode-pas').setAttribute('aria-pressed', String(pas));
    $('#btn-mode-fiche').setAttribute('aria-pressed', String(!pas));
    // On garde le focus sur le bouton cliqué : l'utilisateur sait où il est
  }

  /* ---------- 8. Glossaire ---------- */
  function basculerMots() {
    const bouton = $('#btn-mots');
    const ouvert = bouton.getAttribute('aria-expanded') === 'true';
    bouton.setAttribute('aria-expanded', String(!ouvert));
    $('#liste-mots').hidden = ouvert;
  }

  /* ---------- 9. Démarrage ---------- */
  async function demarrer() {
    try {
      state.fiche = normaliser(await chargerFiche());
    } catch (e) {
      const erreur = $('#erreur');
      erreur.textContent = "Désolé, ce tuto n'a pas pu s'afficher. Rechargez la page ou demandez de l'aide à l'accueil.";
      erreur.hidden = false;
      $('h1').textContent = 'Tuto indisponible';
      $('.mode-switch').hidden = true;
      $('#vue-pas').hidden = true;
      return;
    }

    afficherContenu(state.fiche);
    afficherEcran(false); // pas de focus au chargement : on laisse l'utilisateur lire le début

    $('#btn-suivant').addEventListener('click', suivant);
    $('#btn-retour').addEventListener('click', retour);
    $('#btn-mode-pas').addEventListener('click', () => changerMode('pas'));
    $('#btn-mode-fiche').addEventListener('click', () => changerMode('fiche'));
    $('#btn-mots').addEventListener('click', basculerMots);
    $('#btn-imprimer').addEventListener('click', () => window.print());
  }

  demarrer();
})();