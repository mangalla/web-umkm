/* =========================================================
   PANEL ADMIN — Web1 (CentrinOnline) & Web2 (M3 Internet)
   Semua data tersimpan di admin/data/content.json lewat api.php.
   ========================================================= */
(() => {
  'use strict';

  /* ---------------------------------------------------------
     SKEMA: daftar teks & jenis kartu yang bisa diatur
     --------------------------------------------------------- */
  const F = (key, label, opts = {}) => ({ key, label, ...opts });

  const ITEM_TYPES = {
    web1Card: {
      noun: 'kartu',
      fields: [
        F('eyebrow', 'Nama / label atas', { required: true, hint: 'Mis. "Paket Starter" atau "Koneksi+ 50 · Bundling"' }),
        F('badge', 'Badge sorotan', { hint: 'Isi (mis. "Paling Populer") agar kartu ditonjolkan; kosongkan untuk kartu biasa' }),
        F('speed', 'Kecepatan', { required: true }),
        F('unit', 'Satuan kecepatan'),
        F('price', 'Harga', { required: true, hint: 'Mis. Rp209.000' }),
        F('priceSuffix', 'Keterangan harga', { hint: 'Mis. /bulan' }),
        F('pill', 'Label promo (pill)', { hint: 'Mis. "Bayar 3 · Free 1" — kosongkan bila tidak perlu' }),
        F('promo', 'Catatan promo', { hint: 'Teks kecil di bawah harga' }),
        F('features', 'Daftar keunggulan', { type: 'list', wide: true, hint: 'Satu baris = satu poin' }),
        F('ctaLabel', 'Teks tombol'),
        F('waText', 'Pesan WhatsApp saat tombol diklik', { type: 'long', wide: true }),
        F('visible', 'Tampilkan kartu ini di halaman', { type: 'check', wide: true }),
      ],
      blank: () => ({
        visible: true, eyebrow: '', badge: '', speed: '', unit: 'Mbps', price: '', priceSuffix: '/bulan',
        pill: '', promo: '', features: ['Internet 100% Fiber', 'Gratis Biaya Pasang'], ctaLabel: 'Pesan Sekarang', waText: 'Halo Admin, saya ingin pesan ',
      }),
      title: (c) => [c.eyebrow, c.pill].filter(Boolean).join(' — ') || 'Kartu tanpa nama',
      preview: (c, full) => planPreview({
        eyebrow: c.eyebrow, tag: c.badge, popular: Boolean(c.badge), speed: c.speed, unit: c.unit,
        pill: c.pill, price: c.price, suffix: c.priceSuffix, promo: c.promo, features: c.features, cta: c.ctaLabel,
      }, full),
    },
    web2Card: {
      noun: 'kartu',
      fields: [
        F('name', 'Nama paket', { required: true }),
        F('speed', 'Kecepatan', { required: true }),
        F('unit', 'Satuan kecepatan'),
        F('price', 'Harga', { required: true, hint: 'Mis. Rp250.000' }),
        F('priceSuffix', 'Keterangan harga', { hint: 'Mis. /bln' }),
        F('popular', 'Tandai sebagai paket populer (disorot oranye)', { type: 'check', wide: true }),
        F('badge', 'Teks label populer', { hint: 'Tampil hanya bila paket ditandai populer' }),
        F('ctaLabel', 'Teks tombol'),
        F('features', 'Daftar keunggulan', { type: 'list', wide: true, hint: 'Satu baris = satu poin' }),
        F('visible', 'Tampilkan kartu ini di halaman', { type: 'check', wide: true }),
      ],
      blank: () => ({
        visible: true, name: '', speed: '', unit: 'Mbps', price: '', priceSuffix: '/bln',
        popular: false, badge: 'Paling Populer', features: ['Unlimited tanpa FUP'], ctaLabel: 'Pilih Paket',
      }),
      title: (c) => c.name || 'Paket tanpa nama',
      preview: (c, full) => planPreview({
        eyebrow: c.name, tag: c.popular ? c.badge || 'Populer' : '', popular: c.popular, speed: c.speed, unit: c.unit,
        price: c.price, suffix: c.priceSuffix, features: c.features, cta: c.ctaLabel,
      }, full),
    },
    faq: {
      noun: 'pertanyaan',
      fields: [
        F('q', 'Pertanyaan', { required: true, wide: true }),
        F('a', 'Jawaban', { type: 'long', required: true, wide: true }),
        F('visible', 'Tampilkan di halaman', { type: 'check', wide: true }),
      ],
      blank: () => ({ visible: true, q: '', a: '' }),
      title: (c) => c.q || 'Pertanyaan baru',
      preview: (c) => `<div class="pv-faq"><b>${esc(c.q || 'Pertanyaan…')}</b><p>${esc(c.a || 'Jawaban…')}</p></div>`,
    },
  };

  const SITES = {
    web1: {
      label: 'Web 1 · CentrinOnline',
      url: '../Web1/index.html',
      collections: [
        { key: 'plans', title: 'Paket Koneksi+', icon: 'i-card', type: 'web1Card', desc: 'Kartu harga di bagian "Paket Koneksi+".' },
        { key: 'bundles', title: 'Promo Bundling', icon: 'i-gift', type: 'web1Card', desc: 'Kartu di carousel "Promo Bundling".' },
      ],
      groups: [
        { title: 'Kontak & WhatsApp', desc: 'Dipakai oleh semua tombol WhatsApp & telepon di Web1.', fields: [
          F('contact.waNumber', 'Nomor WhatsApp', { hint: 'Format internasional tanpa + / spasi, mis. 6287778333933', pattern: 'phone' }),
          F('contact.phone', 'Nomor telepon', { hint: 'Mis. +6287778333933' }),
          F('contact.waMessage', 'Pesan WhatsApp umum', { type: 'long', wide: true }),
        ] },
        { title: 'Judul tab & SEO', fields: [
          F('meta.title', 'Judul tab browser', { wide: true }),
          F('meta.description', 'Deskripsi untuk mesin pencari', { type: 'long', wide: true }),
        ] },
        { title: 'Menu navigasi', fields: [
          F('nav.home', 'Menu 1'), F('nav.paket', 'Menu 2'), F('nav.bundling', 'Menu 3'), F('nav.kontak', 'Menu 4'),
        ] },
        { title: 'Hero (bagian atas)', fields: [
          F('hero.eyebrow', 'Label kecil', { wide: true }),
          F('hero.line1', 'Judul baris 1'), F('hero.line2', 'Judul baris 2'),
          F('hero.lede', 'Paragraf pembuka', { type: 'long', wide: true }),
          F('hero.ctaPrimary', 'Tombol WhatsApp'), F('hero.ctaSecondary', 'Tombol lihat paket'),
          F('hero.mapTag', 'Label peta'),
        ] },
        { title: 'Bagian Paket Koneksi+', fields: [
          F('plans.eyebrow', 'Label kecil'), F('plans.title', 'Judul'),
          F('plans.sub', 'Subjudul', { type: 'long', wide: true }),
        ] },
        { title: 'Strip syarat', fields: [
          F('terms.chip1', 'Chip 1'), F('terms.chip2', 'Chip 2'), F('terms.chip3', 'Chip 3'), F('terms.fineprint', 'Catatan kecil'),
        ] },
        { title: 'Bagian Promo Bundling', fields: [
          F('bundling.eyebrow', 'Label kecil'), F('bundling.title', 'Judul'),
          F('bundling.sub', 'Subjudul', { type: 'long', wide: true }),
          F('bundling.foot', 'Catatan di bawah carousel', { type: 'long', wide: true }),
        ] },
        { title: 'Bagian Kontak', fields: [
          F('contact.eyebrow', 'Label kecil'), F('contact.title', 'Judul'),
          F('contact.btnWa', 'Tombol WhatsApp'), F('contact.btnPhone', 'Tombol telepon'),
          F('contact.note', 'Catatan area', { wide: true }),
        ] },
        { title: 'Footer', fields: [
          F('footer.copy', 'Teks hak cipta', { wide: true }),
          F('footer.linkText', 'Teks tautan'), F('footer.linkUrl', 'Alamat tautan (URL)'),
        ] },
      ],
    },
    web2: {
      label: 'Web 2 · M3 Internet',
      url: '../Web2/index.html',
      collections: [
        { key: 'plansRumah', title: 'Paket Rumah', icon: 'i-home', type: 'web2Card', desc: 'Kartu paket pada tab "Rumah".' },
        { key: 'plansBisnis', title: 'Paket Bisnis', icon: 'i-building', type: 'web2Card', desc: 'Kartu paket pada tab "Bisnis".' },
        { key: 'faq', title: 'FAQ', icon: 'i-help', type: 'faq', desc: 'Pertanyaan di bagian Bantuan.', list: true },
      ],
      groups: [
        { title: 'Kontak & WhatsApp', desc: 'Dipakai oleh semua tombol WhatsApp di Web2.', fields: [
          F('contact.waNumber', 'Nomor WhatsApp', { hint: 'Format internasional tanpa + / spasi, mis. 6287844690552', pattern: 'phone' }),
          F('contact.waDisplay', 'Nomor yang ditampilkan', { hint: 'Mis. 0878-4469-0552' }),
          F('contact.waCtaMessage', 'Pesan tombol "Chat WhatsApp"', { type: 'long' }),
          F('contact.waFabMessage', 'Pesan tombol WhatsApp melayang', { type: 'long' }),
        ] },
        { title: 'Judul tab & SEO', fields: [
          F('meta.title', 'Judul tab browser', { wide: true }),
          F('meta.description', 'Deskripsi untuk mesin pencari', { type: 'long', wide: true }),
        ] },
        { title: 'Menu navigasi', fields: [
          F('nav.beranda', 'Menu 1'), F('nav.paket', 'Menu 2'), F('nav.jangkauan', 'Menu 3'),
          F('nav.bantuan', 'Menu 4'), F('nav.kontak', 'Menu 5'), F('nav.cta', 'Tombol oranye'),
        ] },
        { title: 'Hero (bagian atas)', fields: [
          F('hero.pill', 'Label promo', { wide: true }),
          F('hero.line1', 'Judul baris 1'), F('hero.line2', 'Judul baris 2'),
          F('hero.sub', 'Paragraf pembuka', { type: 'long' }), F('hero.subStrong', 'Teks tebal oranye di akhir paragraf'),
          F('hero.ctaPaket', 'Tombol lihat paket'), F('hero.ctaJangkauan', 'Tombol cek jangkauan'),
          F('hero.badge1', 'Badge 1'), F('hero.badge2', 'Badge 2'), F('hero.badge3', 'Badge 3'),
          F('hero.chip1Title', 'Chip 1 — judul'), F('hero.chip1Sub', 'Chip 1 — keterangan'),
          F('hero.chip2Title', 'Chip 2 — judul'), F('hero.chip2Sub', 'Chip 2 — keterangan'),
        ] },
        { title: 'Keunggulan', fields: [
          F('features.eyebrow', 'Label kecil'), F('features.title', 'Judul'),
          F('features.sub', 'Subjudul', { type: 'long', wide: true }),
          ...[1, 2, 3, 4].flatMap((n) => [
            F(`features.f${n}Title`, `Keunggulan ${n} — judul`), F(`features.f${n}Desc`, `Keunggulan ${n} — deskripsi`, { type: 'long' }),
          ]),
        ] },
        { title: 'Bagian Paket', fields: [
          F('paket.eyebrow', 'Label kecil'), F('paket.title', 'Judul'),
          F('paket.sub', 'Subjudul', { type: 'long', wide: true }),
          F('paket.toggleRumah', 'Tab 1'), F('paket.toggleBisnis', 'Tab 2'),
          F('paket.swipeHint', 'Petunjuk geser (mobile)', { wide: true }),
        ] },
        { title: 'Cek Jangkauan', fields: [
          F('coverage.eyebrow', 'Label kecil'), F('coverage.title', 'Judul'),
          F('coverage.sub', 'Subjudul', { type: 'long', wide: true }),
          F('coverage.formTitle', 'Judul form'), F('coverage.formSub', 'Subjudul form'),
          F('coverage.btn', 'Tombol cek'),
        ] },
        { title: 'Cara Berlangganan', fields: [
          F('steps.eyebrow', 'Label kecil'), F('steps.title', 'Judul'),
          F('steps.sub', 'Subjudul', { type: 'long', wide: true }),
          ...[1, 2, 3, 4].flatMap((n) => [
            F(`steps.s${n}Title`, `Langkah ${n} — judul`), F(`steps.s${n}Desc`, `Langkah ${n} — deskripsi`, { type: 'long' }),
          ]),
        ] },
        { title: 'Bagian FAQ', desc: 'Isi pertanyaan diatur di menu FAQ.', fields: [
          F('faq.eyebrow', 'Label kecil'), F('faq.title', 'Judul'),
          F('faq.sub', 'Subjudul', { type: 'long' }), F('faq.helpTitle', 'Judul kotak bantuan'),
        ] },
        { title: 'Ajakan penutup (CTA)', fields: [
          F('cta.title', 'Judul', { wide: true }),
          F('cta.sub', 'Subjudul', { type: 'long', wide: true }),
          F('cta.btnDaftar', 'Tombol daftar'), F('cta.btnWa', 'Tombol WhatsApp'),
        ] },
        { title: 'Footer', fields: [
          F('footer.about', 'Deskripsi singkat', { type: 'long', wide: true }),
          F('footer.col1Title', 'Kolom 1 — judul'), F('footer.col1L1', 'Kolom 1 — tautan 1'),
          F('footer.col1L2', 'Kolom 1 — tautan 2'), F('footer.col1L3', 'Kolom 1 — tautan 3'), F('footer.col1L4', 'Kolom 1 — tautan 4'),
          F('footer.col2Title', 'Kolom 2 — judul'), F('footer.col2L1', 'Kolom 2 — tautan 1'),
          F('footer.col2L2', 'Kolom 2 — tautan 2'), F('footer.col2L3', 'Kolom 2 — tautan 3'), F('footer.col2L4', 'Kolom 2 — tautan 4'),
          F('footer.col3Title', 'Kolom 3 — judul'),
          F('footer.copy', 'Teks hak cipta', { wide: true }),
          F('footer.taglineBefore', 'Tagline sebelum ♥'), F('footer.taglineAfter', 'Tagline sesudah ♥'),
        ] },
      ],
    },
  };

  /* ---------------------------------------------------------
     UTIL
     --------------------------------------------------------- */
  const $ = (sel, root = document) => root.querySelector(sel);
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
  const icon = (id) => `<svg aria-hidden="true"><use href="#${id}"/></svg>`;
  const newId = (prefix) => `${prefix}-${Date.now().toString(36)}${Math.random().toString(36).slice(2, 6)}`;
  const fmtDate = (iso) => {
    if (!iso) return '—';
    const d = new Date(iso);
    return isNaN(d) ? iso : d.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
  };

  function planPreview(p, full) {
    const feats = (p.features || []).filter(Boolean);
    const shown = full ? feats : feats.slice(0, 4);
    return `
      <div class="pv${p.popular ? ' popular' : ''}">
        <div class="pv-head">
          <span class="pv-eyebrow">${esc(p.eyebrow || 'Tanpa nama')}</span>
          ${p.tag ? `<span class="tag tag-popular">${esc(p.tag)}</span>` : ''}
        </div>
        <div class="pv-speed">${esc(p.speed || '0')}<small>${esc(p.unit)}</small></div>
        ${p.pill ? `<span class="pv-pill">${esc(p.pill)}</span>` : ''}
        <div class="pv-price">${esc(p.price || 'Rp—')}<span>${esc(p.suffix)}</span></div>
        ${p.promo ? `<div class="pv-promo">${esc(p.promo)}</div>` : ''}
        <ul>${shown.map((f) => `<li>${icon('i-check')}<span>${esc(f)}</span></li>`).join('')}</ul>
        ${feats.length > shown.length ? `<span class="pv-more">+${feats.length - shown.length} poin lainnya</span>` : ''}
        ${p.cta ? `<div class="pv-cta">${esc(p.cta)}</div>` : ''}
      </div>`;
  }

  const toast = (msg, type = 'ok') => {
    const el = document.createElement('div');
    el.className = `toast${type === 'error' ? ' error' : ''}`;
    el.innerHTML = `${icon(type === 'error' ? 'i-alert' : 'i-check')}<span>${esc(msg)}</span>`;
    $('#toasts').appendChild(el);
    setTimeout(() => el.remove(), type === 'error' ? 5000 : 2600);
  };

  const setSaveState = (state, text = '') => {
    const el = $('#saveState');
    el.dataset.state = state;
    el.textContent = text;
  };

  /** Modal konfirmasi berbasis <dialog>, mengembalikan Promise<boolean>. */
  const confirmBox = ({ title, text, yes = 'Hapus', danger = true }) => new Promise((resolve) => {
    const dlg = $('#confirmModal');
    $('#confirmTitle').textContent = title;
    $('#confirmText').textContent = text;
    const yesBtn = $('#confirmYes');
    yesBtn.textContent = yes;
    yesBtn.className = `btn ${danger ? 'btn-danger' : 'btn-primary'}`;
    const done = (val) => { dlg.close(); resolve(val); };
    dlg.querySelectorAll('[data-answer]').forEach((b) => { b.onclick = () => done(b.dataset.answer === 'yes'); });
    dlg.oncancel = (e) => { e.preventDefault(); done(false); };
    dlg.showModal();
  });

  /* ---------------------------------------------------------
     API
     --------------------------------------------------------- */
  class ApiError extends Error {
    constructor(message, status) { super(message); this.status = status; }
  }

  const api = async (action, payload) => {
    let res;
    try {
      res = await fetch(`api.php?action=${action}`, payload === undefined
        ? { credentials: 'same-origin' }
        : { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
    } catch {
      throw new ApiError('Tidak dapat terhubung ke server.', 0);
    }
    const isJson = (res.headers.get('content-type') || '').includes('application/json');
    if (!isJson) throw new ApiError('api.php tidak berjalan. Buka panel ini lewat server PHP (lihat admin/README.md).', res.status);
    const body = await res.json();
    if (!res.ok) throw new ApiError(body.error || `Kesalahan ${res.status}`, res.status);
    return body;
  };

  /* ---------------------------------------------------------
     STATE
     --------------------------------------------------------- */
  let content = null;
  let usingDefaultPassword = false;
  let textsDirty = false;
  let currentRoute = '';

  const loadContent = async () => {
    const res = await fetch(`data/content.json?t=${Date.now()}`, { cache: 'no-store' });
    if (!res.ok) throw new Error('Gagal memuat data/content.json');
    content = await res.json();
  };

  const persist = async () => {
    setSaveState('saving', 'Menyimpan…');
    try {
      const { updatedAt } = await api('save', { content });
      content.updatedAt = updatedAt;
      setSaveState('saved', 'Tersimpan');
      return true;
    } catch (err) {
      setSaveState('error', 'Gagal menyimpan');
      toast(err.message, 'error');
      if (err.status === 401) showLogin(err.message);
      return false;
    }
  };

  /** Ubah data, simpan ke server; bila gagal, kembalikan ke kondisi semula. */
  const mutate = async (fn, successMsg) => {
    const snapshot = structuredClone(content);
    fn(content);
    render();
    const ok = await persist();
    if (!ok) { content = snapshot; render(); return false; }
    if (successMsg) toast(successMsg);
    return true;
  };

  /* ---------------------------------------------------------
     ROUTING & NAVIGASI
     --------------------------------------------------------- */
  const routes = () => {
    const list = [{ path: 'dashboard', title: 'Ringkasan', icon: 'i-grid' }];
    Object.entries(SITES).forEach(([siteKey, site]) => {
      list.push({ group: site.label });
      list.push({ path: `${siteKey}/texts`, title: 'Teks Halaman', icon: 'i-text', site: siteKey });
      site.collections.forEach((col) => list.push({ path: `${siteKey}/${col.key}`, title: col.title, icon: col.icon, site: siteKey, col }));
    });
    list.push({ group: 'Akun' });
    list.push({ path: 'account', title: 'Keamanan', icon: 'i-lock' });
    return list;
  };

  const findRoute = (path) => routes().find((r) => r.path === path) || routes()[0];

  const renderNav = () => {
    $('#sideNav').innerHTML = routes().map((r) => {
      if (r.group) return `<p class="side-group">${esc(r.group)}</p>`;
      const count = r.col ? (content[r.site][r.col.key] || []).length : null;
      return `<a class="side-link${r.path === currentRoute ? ' is-active' : ''}" href="#/${r.path}">
        ${icon(r.icon)}<span>${esc(r.title)}</span>${count !== null ? `<span class="count">${count}</span>` : ''}</a>`;
    }).join('');
  };

  const closeMenu = () => { $('#sidebar').classList.remove('open'); $('#scrim').classList.remove('show'); };

  const onHashChange = async () => {
    const path = location.hash.replace(/^#\/?/, '') || 'dashboard';
    if (path === currentRoute) return;
    if (textsDirty) {
      const leave = await confirmBox({ title: 'Buang perubahan teks?', text: 'Ada perubahan yang belum disimpan. Jika pindah halaman, perubahan itu hilang.', yes: 'Buang & pindah' });
      if (!leave) { history.replaceState(null, '', `#/${currentRoute}`); return; }
      textsDirty = false;
    }
    currentRoute = findRoute(path).path;
    closeMenu();
    render();
    window.scrollTo(0, 0);
  };

  /* ---------------------------------------------------------
     RENDER
     --------------------------------------------------------- */
  function render() {
    const route = findRoute(currentRoute);
    renderNav();
    $('#pageTitle').textContent = route.title;
    $('#crumb').textContent = route.site ? SITES[route.site].label : 'Panel Admin';
    const viewBtn = $('#viewSiteBtn');
    viewBtn.hidden = !route.site;
    if (route.site) viewBtn.href = SITES[route.site].url;

    const view = $('#content');
    if (route.path === 'dashboard') view.innerHTML = dashboardHTML();
    else if (route.path === 'account') view.innerHTML = accountHTML();
    else if (route.col) view.innerHTML = collectionHTML(route.site, route.col);
    else view.innerHTML = textsHTML(route.site);
    view.dataset.route = route.path;
  }

  /* ----- Ringkasan ----- */
  const dashboardHTML = () => {
    const stats = Object.entries(SITES).flatMap(([siteKey, site]) => site.collections.map((col) => {
      const list = content[siteKey][col.key] || [];
      const shown = list.filter((i) => i.visible !== false).length;
      return `<a class="panel stat" href="#/${siteKey}/${col.key}">
        <div class="stat-top"><span class="stat-ic${siteKey === 'web2' ? ' orange' : ''}">${icon(col.icon)}</span><span class="stat-site">${siteKey.toUpperCase()}</span></div>
        <b>${list.length}</b><span>${esc(col.title)} · ${shown} tampil</span></a>`;
    })).join('');

    const sites = Object.entries(SITES).map(([siteKey, site]) => {
      const t = content[siteKey].texts || {};
      return `<section class="panel site-card">
        <header class="panel-head"><div><h2>${esc(site.label)}</h2><p>${esc(t['meta.title'] || '')}</p></div>
          <a class="btn btn-ghost" href="${site.url}" target="_blank" rel="noopener">${icon('i-external')}Buka</a></header>
        <div class="panel-body">
          <ul>
            <li><span>Jumlah teks yang bisa diatur</span><span>${Object.keys(t).length}</span></li>
            <li><span>Nomor WhatsApp</span><span>${esc(t['contact.waNumber'] || '—')}</span></li>
          </ul>
          <a class="btn btn-primary" href="#/${siteKey}/texts">${icon('i-text')}Edit teks halaman</a>
        </div></section>`;
    }).join('');

    return `
      ${usingDefaultPassword ? `<div class="alert alert-warn">${icon('i-alert')}<p>Anda masih memakai password bawaan. <a href="#/account">Ganti password sekarang</a> sebelum website dionlinekan.</p></div>` : ''}
      <p class="muted">Terakhir disimpan: <b>${esc(fmtDate(content.updatedAt))}</b></p>
      <div class="stats">${stats}</div>
      <div class="site-cards">${sites}</div>`;
  };

  /* ----- Editor teks ----- */
  const fieldHTML = (f, value, { dataAttr = 'data-key' } = {}) => {
    const id = `f-${f.key.replace(/\W/g, '-')}`;
    const wide = f.wide || f.type === 'long' || f.type === 'list' ? ' wide' : '';
    const label = `<span>${esc(f.label)}${dataAttr === 'data-key' ? `<span class="field-key">${esc(f.key)}</span>` : ''}${f.required ? ' *' : ''}</span>`;
    const hint = f.hint ? `<small>${esc(f.hint)}</small>` : '';
    if (f.type === 'check') {
      return `<label class="check${wide}"><input type="checkbox" id="${id}" ${dataAttr}="${esc(f.key)}" ${value ? 'checked' : ''}/>${esc(f.label)}</label>`;
    }
    if (f.type === 'long' || f.type === 'list') {
      const v = f.type === 'list' ? (value || []).join('\n') : value;
      return `<label class="field${wide}" for="${id}">${label}<textarea id="${id}" ${dataAttr}="${esc(f.key)}" rows="${f.type === 'list' ? 6 : 3}">${esc(v)}</textarea>${hint}</label>`;
    }
    return `<label class="field${wide}" for="${id}">${label}<input id="${id}" type="text" ${dataAttr}="${esc(f.key)}" value="${esc(value)}"/>${hint}</label>`;
  };

  const textsHTML = (siteKey) => {
    const texts = content[siteKey].texts || {};
    const groups = SITES[siteKey].groups.map((g) => `
      <section class="panel" data-group>
        <header class="panel-head"><div><h2>${esc(g.title)}</h2>${g.desc ? `<p>${esc(g.desc)}</p>` : ''}</div></header>
        <div class="panel-body text-grid">${g.fields.map((f) => fieldHTML(f, texts[f.key] ?? '')).join('')}</div>
      </section>`).join('');
    return `
      <div class="toolbar">
        <label class="search">${icon('i-search')}<input type="search" id="textSearch" placeholder="Cari teks… (mis. judul, WhatsApp)" aria-label="Cari teks"/></label>
        <span class="grow"></span>
        <span class="muted" style="font-size:.85rem">Kolom oranye = belum disimpan</span>
      </div>
      <div class="text-groups">${groups}</div>
      <p class="empty" id="textEmpty" hidden>Tidak ada teks yang cocok.</p>
      <div class="savebar" id="savebar">
        <p><b id="dirtyCount">0</b> teks diubah dan belum disimpan.</p>
        <button class="btn btn-ghost" type="button" data-act="text-reset">Batalkan</button>
        <button class="btn btn-accent" type="button" data-act="text-save">Simpan perubahan</button>
      </div>`;
  };

  const siteOfRoute = () => findRoute(currentRoute).site;

  const updateDirty = () => {
    const site = siteOfRoute();
    const texts = content[site].texts || {};
    let n = 0;
    document.querySelectorAll('#content [data-key]').forEach((el) => {
      const dirty = el.value !== (texts[el.dataset.key] ?? '');
      el.closest('.field').classList.toggle('is-dirty', dirty);
      if (dirty) n++;
    });
    textsDirty = n > 0;
    $('#dirtyCount').textContent = n;
    $('#savebar').classList.toggle('show', textsDirty);
  };

  const saveTexts = async () => {
    const site = siteOfRoute();
    const values = {};
    for (const el of document.querySelectorAll('#content [data-key]')) {
      const f = SITES[site].groups.flatMap((g) => g.fields).find((x) => x.key === el.dataset.key);
      const v = el.value.trim();
      if (f?.pattern === 'phone' && v && !/^\d{8,15}$/.test(v)) {
        toast(`${f.label}: hanya angka, 8–15 digit (mis. 62812xxxx).`, 'error');
        el.focus();
        return;
      }
      values[el.dataset.key] = v;
    }
    // Tidak memakai mutate(): bila gagal, isian di form harus tetap ada (tidak dirender ulang).
    const previous = content[site].texts;
    content[site].texts = { ...previous, ...values };
    if (await persist()) toast('Teks berhasil disimpan');
    else content[site].texts = previous;
    updateDirty();
  };

  const filterTexts = (q) => {
    q = q.trim().toLowerCase();
    let any = false;
    document.querySelectorAll('#content [data-group]').forEach((group) => {
      let groupHit = false;
      group.querySelectorAll('.field').forEach((field) => {
        const hit = !q || field.textContent.toLowerCase().includes(q) || field.querySelector('[data-key]').value.toLowerCase().includes(q);
        field.hidden = !hit;
        groupHit ||= hit;
      });
      group.hidden = !groupHit;
      any ||= groupHit;
    });
    $('#textEmpty').hidden = any;
  };

  /* ----- Daftar kartu (CRUD) ----- */
  const collectionHTML = (siteKey, col) => {
    const type = ITEM_TYPES[col.type];
    const list = content[siteKey][col.key] || [];
    const items = list.map((item, i) => {
      const hidden = item.visible === false;
      return `<article class="panel item${hidden ? ' is-hidden' : ''}">
        <div class="item-preview">${type.preview(item, false)}</div>
        <div class="item-bar">
          <span class="pos">#${i + 1} ${hidden ? '<span class="tag tag-hidden">Disembunyikan</span>' : ''}</span>
          <button class="icon-btn" type="button" data-act="up" data-id="${esc(item.id)}" title="Geser ke atas/kiri" aria-label="Geser ke atas" ${i === 0 ? 'disabled' : ''}>${icon('i-up')}</button>
          <button class="icon-btn" type="button" data-act="down" data-id="${esc(item.id)}" title="Geser ke bawah/kanan" aria-label="Geser ke bawah" ${i === list.length - 1 ? 'disabled' : ''}>${icon('i-down')}</button>
          <button class="icon-btn" type="button" data-act="toggle" data-id="${esc(item.id)}" title="${hidden ? 'Tampilkan' : 'Sembunyikan'}" aria-label="${hidden ? 'Tampilkan' : 'Sembunyikan'}">${icon(hidden ? 'i-eye-off' : 'i-eye')}</button>
          <button class="icon-btn" type="button" data-act="dup" data-id="${esc(item.id)}" title="Duplikat" aria-label="Duplikat">${icon('i-copy')}</button>
          <button class="icon-btn" type="button" data-act="edit" data-id="${esc(item.id)}" title="Edit" aria-label="Edit">${icon('i-edit')}</button>
          <button class="icon-btn danger" type="button" data-act="del" data-id="${esc(item.id)}" title="Hapus" aria-label="Hapus">${icon('i-trash')}</button>
        </div>
      </article>`;
    }).join('');

    return `
      <div class="toolbar">
        <p class="muted grow">${esc(col.desc)} Urutan di sini = urutan di halaman.</p>
        <button class="btn btn-accent" type="button" data-act="add">${icon('i-plus')}Tambah ${esc(type.noun)}</button>
      </div>
      ${list.length
        ? `<div class="items${col.list ? ' list' : ''}">${items}</div>`
        : `<div class="panel empty">Belum ada ${esc(type.noun)}. Klik “Tambah ${esc(type.noun)}” untuk membuat yang pertama.</div>`}`;
  };

  /* ----- Modal editor kartu ----- */
  let editing = null; // { site, col, id|null }

  const readEditor = () => {
    const { col } = editing;
    const type = ITEM_TYPES[col.type];
    const data = {};
    type.fields.forEach((f) => {
      const el = $(`#editorFields [data-field="${f.key}"]`);
      if (f.type === 'check') data[f.key] = el.checked;
      else if (f.type === 'list') data[f.key] = el.value.split('\n').map((s) => s.trim()).filter(Boolean);
      else data[f.key] = el.value.trim();
    });
    return data;
  };

  const openEditor = (siteKey, col, id = null, preset = null) => {
    const type = ITEM_TYPES[col.type];
    const existing = id ? content[siteKey][col.key].find((x) => x.id === id) : null;
    const item = preset || existing || type.blank();
    editing = { site: siteKey, col, id: existing ? id : null };

    $('#editorTitle').textContent = existing ? `Edit ${type.noun}: ${type.title(existing)}` : `Tambah ${type.noun} — ${col.title}`;
    $('#editorSubmit').textContent = existing ? 'Simpan perubahan' : `Tambah ${type.noun}`;
    $('#editorFields').innerHTML = type.fields.map((f) => fieldHTML(f, item[f.key], { dataAttr: 'data-field' })).join('');
    $('#editorError').textContent = '';
    const refresh = () => { $('#editorPreview').innerHTML = type.preview(readEditor(), true); };
    $('#editorFields').oninput = refresh;
    $('#editorFields').onchange = refresh;
    refresh();
    $('#editorModal').showModal();
    $('#editorFields input, #editorFields textarea')?.focus();
  };

  const submitEditor = async (e) => {
    e.preventDefault();
    const { site, col, id } = editing;
    const type = ITEM_TYPES[col.type];
    const data = readEditor();
    const missing = type.fields.filter((f) => f.required && !data[f.key]);
    if (missing.length) {
      $('#editorError').textContent = `Wajib diisi: ${missing.map((f) => f.label).join(', ')}`;
      $(`#editorFields [data-field="${missing[0].key}"]`).focus();
      return;
    }
    const btn = $('#editorSubmit');
    btn.disabled = true;
    const ok = await mutate((c) => {
      const list = c[site][col.key];
      if (id) {
        const idx = list.findIndex((x) => x.id === id);
        list[idx] = { ...list[idx], ...data };
      } else {
        list.push({ id: newId(col.key.slice(0, 2)), ...data });
      }
    }, id ? 'Perubahan disimpan' : `${type.noun[0].toUpperCase()}${type.noun.slice(1)} baru ditambahkan`);
    btn.disabled = false;
    if (ok) $('#editorModal').close();
  };

  const handleItemAction = async (act, id) => {
    const route = findRoute(currentRoute);
    const { site, col } = route;
    const type = ITEM_TYPES[col.type];
    const list = content[site][col.key];
    const idx = list.findIndex((x) => x.id === id);
    const item = list[idx];

    switch (act) {
      case 'add': return openEditor(site, col);
      case 'edit': return openEditor(site, col, id);
      case 'dup': {
        const copy = structuredClone(item);
        delete copy.id;
        if ('eyebrow' in copy) copy.eyebrow += ' (salinan)';
        if ('name' in copy) copy.name += ' (salinan)';
        if ('q' in copy) copy.q += ' (salinan)';
        return openEditor(site, col, null, copy);
      }
      case 'toggle': {
        const show = item.visible === false;
        return mutate((c) => { c[site][col.key][idx].visible = show; }, show ? 'Kartu ditampilkan' : 'Kartu disembunyikan dari halaman');
      }
      case 'up':
      case 'down': {
        const to = act === 'up' ? idx - 1 : idx + 1;
        if (to < 0 || to >= list.length) return;
        return mutate((c) => {
          const arr = c[site][col.key];
          [arr[idx], arr[to]] = [arr[to], arr[idx]];
        });
      }
      case 'del': {
        const yes = await confirmBox({
          title: `Hapus ${type.noun} ini?`,
          text: `“${type.title(item)}” akan dihapus permanen dari ${SITES[site].label}. Cadangan otomatis tetap tersimpan di admin/data/backups.`,
        });
        if (!yes) return;
        return mutate((c) => { c[site][col.key].splice(idx, 1); }, `${type.noun[0].toUpperCase()}${type.noun.slice(1)} dihapus`);
      }
    }
  };

  /* ----- Akun / keamanan ----- */
  const accountHTML = () => `
    ${usingDefaultPassword ? `<div class="alert alert-warn">${icon('i-alert')}<p>Password saat ini masih bawaan (<code>admin123</code>).</p></div>` : ''}
    <section class="panel" style="max-width:520px">
      <header class="panel-head"><div><h2>Ganti password</h2><p>Minimal 8 karakter.</p></div></header>
      <form class="panel-body" id="passwordForm" style="display:grid;gap:14px">
        <label class="field"><span>Password saat ini</span><input type="password" name="current" autocomplete="current-password" required/></label>
        <label class="field"><span>Password baru</span><input type="password" name="next" autocomplete="new-password" minlength="8" required/></label>
        <label class="field"><span>Ulangi password baru</span><input type="password" name="confirm" autocomplete="new-password" minlength="8" required/></label>
        <p class="form-error" id="passwordError" role="alert"></p>
        <button class="btn btn-primary" type="submit">Simpan password</button>
      </form>
    </section>
    <section class="panel" style="max-width:520px">
      <header class="panel-head"><div><h2>Cadangan data</h2></div></header>
      <div class="panel-body"><p class="muted" style="font-size:.9rem">Setiap kali menyimpan, versi sebelumnya disalin ke <code>admin/data/backups/</code> (15 terakhir). Untuk memulihkan, salin salah satu file itu menjadi <code>admin/data/content.json</code>.</p></div>
    </section>`;

  const submitPassword = async (form) => {
    const err = $('#passwordError');
    const { current, next, confirm } = Object.fromEntries(new FormData(form));
    if (next !== confirm) { err.textContent = 'Konfirmasi password tidak sama.'; return; }
    try {
      await api('password', { current, next });
      usingDefaultPassword = false;
      form.reset();
      err.textContent = '';
      toast('Password berhasil diganti');
      render();
    } catch (e) {
      err.textContent = e.message;
    }
  };

  /* ---------------------------------------------------------
     LOGIN / BOOT
     --------------------------------------------------------- */
  function showLogin(message = '') {
    $('#appView').hidden = true;
    $('#loginView').hidden = false;
    $('#loginError').textContent = message;
    $('#loginHint').hidden = !usingDefaultPassword;
    $('#loginForm [name="password"]').focus();
  }

  const showApp = async () => {
    await loadContent();
    $('#loginView').hidden = true;
    $('#appView').hidden = false;
    currentRoute = '';
    await onHashChange();
  };

  const boot = async () => {
    try {
      const me = await api('me');
      usingDefaultPassword = me.defaultPassword;
      if (me.loggedIn) await showApp();
      else showLogin();
    } catch (err) {
      showLogin(err.message);
    }
  };

  /* ---------------------------------------------------------
     EVENT
     --------------------------------------------------------- */
  $('#loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = e.submitter;
    btn.disabled = true;
    try {
      const res = await api('login', { password: e.target.password.value });
      usingDefaultPassword = res.defaultPassword;
      e.target.reset();
      await showApp();
    } catch (err) {
      $('#loginError').textContent = err.message;
    } finally {
      btn.disabled = false;
    }
  });

  $('#logoutBtn').addEventListener('click', async () => {
    if (textsDirty && !(await confirmBox({ title: 'Keluar tanpa menyimpan?', text: 'Perubahan teks yang belum disimpan akan hilang.', yes: 'Keluar' }))) return;
    textsDirty = false;
    await api('logout', {}).catch(() => {});
    showLogin('Anda sudah keluar.');
  });

  $('#content').addEventListener('click', (e) => {
    const btn = e.target.closest('[data-act]');
    if (!btn) return;
    const act = btn.dataset.act;
    if (act === 'text-save') return saveTexts();
    if (act === 'text-reset') { textsDirty = false; return render(); }
    handleItemAction(act, btn.dataset.id);
  });
  $('#content').addEventListener('input', (e) => {
    if (e.target.id === 'textSearch') filterTexts(e.target.value);
    else if (e.target.matches('[data-key]')) updateDirty();
  });
  $('#content').addEventListener('submit', (e) => {
    if (e.target.id === 'passwordForm') { e.preventDefault(); submitPassword(e.target); }
  });

  $('#editorForm').addEventListener('submit', submitEditor);
  $('#editorModal').querySelectorAll('[data-close]').forEach((b) => b.addEventListener('click', () => $('#editorModal').close()));

  $('#menuBtn').addEventListener('click', () => { $('#sidebar').classList.add('open'); $('#scrim').classList.add('show'); });
  $('#scrim').addEventListener('click', closeMenu);

  // Ctrl/Cmd + S menyimpan teks yang sedang diedit
  document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's' && textsDirty) { e.preventDefault(); saveTexts(); }
  });
  window.addEventListener('beforeunload', (e) => { if (textsDirty) e.preventDefault(); });
  window.addEventListener('hashchange', onHashChange);

  boot();
})();
