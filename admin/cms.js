/**
 * Klien CMS untuk halaman publik (Web1 & Web2).
 *
 * Pemakaian: <script src="../admin/cms.js" data-site="web1"></script>
 * diletakkan SEBELUM script halaman. Script halaman lalu menunggu
 * `window.cmsReady` (Promise berisi data situs, atau null bila gagal).
 *
 * Atribut yang dikenali di HTML:
 *   data-cms="kunci"         → textContent diganti dengan texts[kunci]
 *   data-cms-href="kunci"    → atribut href diganti dengan texts[kunci]
 *   data-wa="kunci"          → href jadi link WhatsApp, pesan = texts[kunci]
 *   data-cms-tel="kunci"     → href jadi tel:texts[kunci]
 *   data-cms-cards           → wadah kartu; disembunyikan sampai data siap
 *
 * Jika data/content.json tidak bisa dimuat (mis. halaman dibuka via file://),
 * teks bawaan HTML tetap tampil apa adanya.
 */
(() => {
  const script = document.currentScript;
  const site = script.dataset.site;
  const base = script.src.replace(/cms\.js(\?.*)?$/, '');
  const root = document.documentElement;

  // Sembunyikan sementara elemen yang akan diganti agar teks lama tidak "berkedip".
  const style = document.createElement('style');
  style.textContent = 'html.cms-pending [data-cms], html.cms-pending [data-cms-cards] { visibility: hidden; }';
  document.head.appendChild(style);
  root.classList.add('cms-pending');
  const reveal = () => root.classList.remove('cms-pending');
  setTimeout(reveal, 1500); // jaring pengaman bila jaringan lambat

  const waLink = (number, text) =>
    `https://wa.me/${String(number).replace(/\D/g, '')}${text ? `?text=${encodeURIComponent(text)}` : ''}`;

  const applyTexts = (texts) => {
    const get = (key) => (typeof texts[key] === 'string' ? texts[key] : null);

    if (get('meta.title') !== null) document.title = get('meta.title');
    const desc = document.querySelector('meta[name="description"]');
    if (desc && get('meta.description') !== null) desc.setAttribute('content', get('meta.description'));

    document.querySelectorAll('[data-cms]').forEach((el) => {
      const v = get(el.dataset.cms);
      if (v !== null) el.textContent = v;
    });
    document.querySelectorAll('[data-cms-href]').forEach((el) => {
      const v = get(el.dataset.cmsHref);
      if (v) el.setAttribute('href', v);
    });
    document.querySelectorAll('[data-cms-tel]').forEach((el) => {
      const v = get(el.dataset.cmsTel);
      if (v) el.setAttribute('href', `tel:${v.replace(/[^\d+]/g, '')}`);
    });
    const number = get('contact.waNumber');
    if (number) {
      document.querySelectorAll('[data-wa]').forEach((el) => {
        el.setAttribute('href', waLink(number, el.dataset.wa ? get(el.dataset.wa) : ''));
      });
    }
  };

  const ready = () =>
    document.readyState === 'loading'
      ? new Promise((r) => document.addEventListener('DOMContentLoaded', r, { once: true }))
      : Promise.resolve();

  window.CMS = {
    site,
    data: null,
    waLink,
    /** Escape teks sebelum disisipkan lewat innerHTML. */
    esc: (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c])),
    /** Hanya item yang ditandai tampil. */
    visible: (list) => (Array.isArray(list) ? list.filter((item) => item && item.visible !== false) : []),
  };

  window.cmsReady = fetch(`${base}data/content.json`, { cache: 'no-store' })
    .then((r) => (r.ok ? r.json() : Promise.reject(new Error(r.status))))
    .then(async (all) => {
      const data = all && all[site];
      if (!data) return null;
      await ready();
      window.CMS.data = data;
      applyTexts(data.texts || {});
      return data;
    })
    .catch((err) => {
      console.info('[CMS] memakai konten bawaan HTML:', err.message || err);
      return null;
    })
    .finally(() => requestAnimationFrame(reveal));
})();
