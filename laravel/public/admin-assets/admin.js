/* =========================================================
   PANEL ADMIN (Laravel) — perilaku kecil di sisi browser.
   Semua penyimpanan dilakukan lewat form biasa ke controller Laravel.
   ========================================================= */
(() => {
  'use strict';
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

  /* ---------- Menu samping (mobile) ---------- */
  const sidebar = $('#sidebar');
  const scrim = $('#scrim');
  $('#menuBtn')?.addEventListener('click', () => { sidebar.classList.add('open'); scrim.classList.add('show'); });
  scrim?.addEventListener('click', () => { sidebar.classList.remove('open'); scrim.classList.remove('show'); });

  /* ---------- Konfirmasi untuk form[data-confirm] ---------- */
  const confirmBox = (title, text) => new Promise((resolve) => {
    const dlg = $('#confirmModal');
    if (!dlg) return resolve(window.confirm(text));
    $('#confirmTitle').textContent = title;
    $('#confirmText').textContent = text;
    const done = (val) => { dlg.close(); resolve(val); };
    $$('[data-answer]', dlg).forEach((b) => { b.onclick = () => done(b.dataset.answer === 'yes'); });
    dlg.oncancel = (e) => { e.preventDefault(); done(false); };
    dlg.showModal();
  });

  document.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!form.dataset.confirm || form.dataset.confirmed) return;
    e.preventDefault();
    if (await confirmBox(form.dataset.confirmTitle || 'Yakin?', form.dataset.confirm)) {
      form.dataset.confirmed = '1';
      form.requestSubmit();
    }
  });

  /* ---------- Editor teks: tanda perubahan, cari, Ctrl+S ---------- */
  const textsForm = $('#textsForm');
  if (textsForm) {
    const inputs = $$('[data-original]', textsForm);
    let dirty = 0;
    const update = () => {
      dirty = 0;
      inputs.forEach((el) => {
        const changed = el.value !== el.dataset.original;
        el.closest('.field').classList.toggle('is-dirty', changed);
        if (changed) dirty++;
      });
      $('#dirtyCount').textContent = dirty;
      $('#savebar').classList.toggle('show', dirty > 0);
    };
    textsForm.addEventListener('input', update);
    textsForm.addEventListener('reset', () => setTimeout(update));
    update();

    let submitting = false;
    textsForm.addEventListener('submit', () => { submitting = true; });
    window.addEventListener('beforeunload', (e) => { if (dirty && !submitting) e.preventDefault(); });
    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') { e.preventDefault(); textsForm.requestSubmit(); }
    });

    $('#textSearch')?.addEventListener('input', (e) => {
      const q = e.target.value.trim().toLowerCase();
      let any = false;
      $$('[data-group]', textsForm).forEach((group) => {
        let hit = false;
        $$('.field', group).forEach((field) => {
          const show = !q || field.textContent.toLowerCase().includes(q) || field.querySelector('[data-original]').value.toLowerCase().includes(q);
          field.hidden = !show;
          hit ||= show;
        });
        group.hidden = !hit;
        any ||= hit;
      });
      $('#textEmpty').hidden = any;
    });
  }

  /* ---------- Form kartu: pratinjau langsung ---------- */
  const cardForm = $('#cardForm');
  const preview = $('#cardPreview');
  if (cardForm && preview) {
    const val = (name) => {
      const el = $$(`[data-preview="${name}"]`, cardForm).pop();
      if (!el) return '';
      return el.type === 'checkbox' ? el.checked : el.value.trim();
    };
    const render = () => {
      const popular = val('is_popular');
      const features = String(val('features')).split('\n').map((s) => s.trim()).filter(Boolean);
      const shown = features.slice(0, 4);
      preview.innerHTML = `
        <div class="pv${popular ? ' popular' : ''}">
          <div class="pv-head">
            <span class="pv-eyebrow">${esc(val('title') || 'Tanpa nama')}</span>
            ${popular ? `<span class="tag tag-popular">${esc(val('badge') || 'Populer')}</span>` : ''}
          </div>
          <div class="pv-speed">${esc(val('speed') || '0')}<small>${esc(val('unit'))}</small></div>
          ${val('pill') ? `<span class="pv-pill">${esc(val('pill'))}</span>` : ''}
          <div class="pv-price">${esc(val('price') || 'Rp—')}<span>${esc(val('price_suffix'))}</span></div>
          ${val('promo') ? `<div class="pv-promo">${esc(val('promo'))}</div>` : ''}
          <ul>${shown.map((f) => `<li><svg aria-hidden="true"><use href="#i-check"/></svg><span>${esc(f)}</span></li>`).join('')}</ul>
          ${features.length > 4 ? `<span class="pv-more">+${features.length - 4} poin lainnya</span>` : ''}
          ${val('cta_label') ? `<div class="pv-cta">${esc(val('cta_label'))}</div>` : ''}
        </div>`;
    };
    cardForm.addEventListener('input', render);
    cardForm.addEventListener('change', render);
  }
})();
