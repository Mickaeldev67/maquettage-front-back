/* =========================================================
   Page tutoriel (contenu écrit en dur dans tuto.html)
   Ce script ne fait que :
   - passer d'un écran à l'autre (mode pas à pas)
   - basculer entre "Pas à pas" et "Toute la fiche"
   - ouvrir / fermer le glossaire
   - compter les cases cochées de "À prévoir"
   ========================================================= */
(function () {
  'use strict';

  const $ = (sel) => document.querySelector(sel);
  const $$ = (sel) => Array.from(document.querySelectorAll(sel));

  /* ---------- 1. Éléments de la page ---------- */
  const ecrans = $$('[data-screen]');          // les 7 écrans, dans l'ordre
  const parties = $$('.parts li');             // les 3 parties de l'avancement
  const dernier = ecrans.length - 1;
  let courant = 0;

  /* ---------- 2. Afficher un écran ---------- */
  function afficherEcran(index, deplacerFocus) {
    courant = index;

    // Un seul écran visible
    ecrans.forEach(function (ecran, i) { ecran.hidden = i !== index; });
    $('#bravo').hidden = true;

    // Avancement en 3 parties
    const partie = Number(ecrans[index].dataset.part);
    parties.forEach(function (li, i) {
      const enCours = i === partie;
      const fini = i < partie;
      if (enCours) li.setAttribute('aria-current', 'step'); else li.removeAttribute('aria-current');
      li.classList.toggle('is-done', fini);
      li.querySelector('.parts__mark').textContent = fini ? '✓' : String(i + 1);
      li.querySelector('.part-state').textContent = enCours ? ' (en cours)' : (fini ? ' (terminé)' : '');
    });

    // Boutons
    $('#btn-retour').hidden = index === 0;
    $('#label-suivant').textContent =
      index === 0 ? 'Commencer'
      : index === dernier ? "J'ai terminé"
      : index === dernier - 1 ? 'Continuer'
      : 'Étape suivante';

    // Annonce pour les lecteurs d'écran
    $('#annonce').textContent = ecrans[index].dataset.annonce;

    // Focus sur le titre du nouvel écran (WCAG 2.4.3 / RGAA 7.1)
    if (deplacerFocus) ecrans[index].querySelector('h2').focus();
  }

  function suivant() {
    if (courant === dernier) {
      $('#bravo').hidden = false;   // role="status" : annoncé automatiquement
      return;
    }
    afficherEcran(courant + 1, true);
  }

  function retour() {
    if (courant > 0) afficherEcran(courant - 1, true);
  }

  /* ---------- 3. Cases "À prévoir" ---------- */
  function majEtatPrevoir() {
    const cases = $$('.checklist input');
    const coches = cases.filter((c) => c.checked).length;
    $('#etat-prevoir').textContent = coches === cases.length
      ? 'Tout est prêt, vous pouvez commencer.'
      : coches + ' sur ' + cases.length + ' cochés';
  }

  /* ---------- 4. Mode de lecture ---------- */
  function changerMode(mode) {
    const pas = mode === 'pas';
    $('#vue-pas').hidden = !pas;
    $('#vue-fiche').hidden = pas;
    $('#btn-mode-pas').setAttribute('aria-pressed', String(pas));
    $('#btn-mode-fiche').setAttribute('aria-pressed', String(!pas));
  }

  /* ---------- 5. Glossaire ---------- */
  function basculerMots() {
    const bouton = $('#btn-mots');
    const ouvert = bouton.getAttribute('aria-expanded') === 'true';
    bouton.setAttribute('aria-expanded', String(!ouvert));
    $('#liste-mots').hidden = ouvert;
  }

  /* ---------- 6. Branchement des événements ---------- */
  $('#btn-suivant').addEventListener('click', suivant);
  $('#btn-retour').addEventListener('click', retour);
  $('#btn-mode-pas').addEventListener('click', () => changerMode('pas'));
  $('#btn-mode-fiche').addEventListener('click', () => changerMode('fiche'));
  $('#btn-mots').addEventListener('click', basculerMots);
  $('#btn-imprimer').addEventListener('click', () => window.print());
  $$('.checklist input').forEach((c) => c.addEventListener('change', majEtatPrevoir));

  afficherEcran(0, false); // pas de focus au chargement
})();