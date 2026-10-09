/* =========================================================
   Réglages d'affichage communs à toutes les pages :
   - taille du texte (A / A+ / A++)
   - affichage clair / sombre
   Les choix sont gardés dans localStorage pour la visite suivante.
   ========================================================= */
(function () {
  'use strict';

  const SIZES = ['112.5%', '137.5%', '162.5%']; // 18 px, 22 px, 26 px
  const root = document.documentElement;

  // localStorage peut être bloqué (navigation privée) : on protège chaque accès
  function load(key) {
    try { return localStorage.getItem(key); } catch (e) { return null; }
  }
  function save(key, value) {
    try { localStorage.setItem(key, value); } catch (e) { /* tant pis */ }
  }

  /* ---------- Taille du texte ---------- */
  function applySize(index) {
    root.style.fontSize = SIZES[index];
    document.querySelectorAll('.btn-size').forEach(function (btn) {
      btn.setAttribute('aria-pressed', String(Number(btn.dataset.size) === index));
    });
    save('tuto-size', String(index));
  }

  /* ---------- Thème ---------- */
  function isDark() {
    const forced = root.getAttribute('data-theme');
    if (forced) return forced === 'dark';
    return window.matchMedia('(prefers-color-scheme: dark)').matches;
  }

  function applyTheme(theme) {
    if (theme) root.setAttribute('data-theme', theme);
    const btn = document.getElementById('btn-theme');
    if (!btn) return;
    const dark = isDark();
    btn.setAttribute('aria-pressed', String(dark));
    btn.querySelector('.btn-theme__label').textContent = dark ? 'Affichage clair' : 'Affichage sombre';
  }

  /* ---------- Initialisation ---------- */
  // Appliqué tout de suite (script chargé dans le <head>) pour éviter un "flash"
  const savedSize = Number(load('tuto-size')) || 0;
  const savedTheme = load('tuto-theme');
  root.style.fontSize = SIZES[savedSize] || SIZES[0];
  if (savedTheme) root.setAttribute('data-theme', savedTheme);

  // Les boutons n'existent qu'une fois la page lue
  document.addEventListener('DOMContentLoaded', function () {
    applySize(savedSize);
    applyTheme(savedTheme);

    document.querySelectorAll('.btn-size').forEach(function (btn) {
      btn.addEventListener('click', function () { applySize(Number(btn.dataset.size)); });
    });

    const themeBtn = document.getElementById('btn-theme');
    if (themeBtn) {
      themeBtn.addEventListener('click', function () {
        const next = isDark() ? 'light' : 'dark';
        save('tuto-theme', next);
        applyTheme(next);
      });
    }
  });
})();