/* =========================================================
   NAVBAR: sticky + bayangan saat scroll, hamburger
   ========================================================= */
const navbar = document.getElementById('navbar');
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

const onScroll = () => navbar.classList.toggle('scrolled', window.scrollY > 20);
window.addEventListener('scroll', onScroll, { passive: true });
onScroll();

const setMenu = (open) => {
  navMenu.classList.toggle('open', open);
  hamburger.classList.toggle('open', open);
  navbar.classList.toggle('menu-open', open);
  hamburger.setAttribute('aria-expanded', String(open));
};
hamburger.addEventListener('click', () => setMenu(!navMenu.classList.contains('open')));
navMenu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => setMenu(false)));

/* =========================================================
   SCROLLSPY: menu aktif (pil navy) mengikuti section
   ========================================================= */
const navLinks = [...document.querySelectorAll('.nav-link')];
const spyTargets = navLinks
  .map((link) => document.querySelector(link.getAttribute('href')))
  .filter(Boolean);

const spy = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) return;
    navLinks.forEach((l) => l.classList.toggle('active', l.getAttribute('href') === '#' + entry.target.id));
  });
}, { rootMargin: '-45% 0px -50% 0px' });
spyTargets.forEach((el) => spy.observe(el));

/* =========================================================
   REVEAL: fade-in saat elemen masuk layar
   ========================================================= */
const revealer = new IntersectionObserver((entries, obs) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });
document.querySelectorAll('.reveal').forEach((el) => revealer.observe(el));

/* =========================================================
   PAKET: data + toggle Rumah / Bisnis
   ========================================================= */
// Kartu Rumah & Bisnis sudah dirender server (Blade); tombol hanya menukar grid yang tampil.
const toggle = document.getElementById('planToggle');
const grids = [...document.querySelectorAll('[data-plans]')];

toggle.querySelectorAll('button').forEach((btn) => {
  btn.addEventListener('click', () => {
    const mode = btn.dataset.mode;
    if (toggle.dataset.mode === mode) return;
    toggle.dataset.mode = mode;
    toggle.querySelectorAll('button').forEach((b) => {
      b.classList.toggle('active', b === btn);
      b.setAttribute('aria-selected', String(b === btn));
    });
    const current = grids.find((g) => !g.hidden);
    current?.classList.add('switching');
    setTimeout(() => {
      grids.forEach((g) => { g.hidden = g.dataset.plans !== mode; g.classList.remove('switching'); });
    }, 220);
  });
});

/* =========================================================
   CEK JANGKAUAN: form + hasil pengecekan
   ========================================================= */
const form = document.getElementById('coverageForm');
const resultBox = document.getElementById('coverageResult');
const coverageBtn = document.getElementById('coverageBtn');

const RESULT_ICONS = {
  covered: '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#25D366"/><path d="M7 12.5l3 3 7-7" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  soon:    '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#FF9800"/><path d="M12 6v6l4 2" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/></svg>',
  none:    '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#E53935"/><path d="M8 8l8 8M16 8l-8 8" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/></svg>',
  info:    '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#1E88E5"/><path d="M12 11v6" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/><circle cx="12" cy="7.5" r="1.5" fill="#fff"/></svg>',
};

/**
 * Menentukan hasil cek jangkauan berdasarkan daftar kota (tanpa backend).
 * @param {string} kota       nilai dropdown, mis. "Bandung" atau "Lainnya"
 * @param {string} kecamatan  input bebas dari pengguna
 * @param {string} alamat     input bebas dari pengguna
 * @returns {{status: 'covered'|'soon'|'none', title: string, message: string} | null}
 */
// escape input pengguna karena hasil ditampilkan lewat innerHTML
const esc = (s) => s.replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

// Ketersediaan jaringan dikonfirmasi langsung oleh tim lewat WhatsApp,
// jadi form tidak pernah menjanjikan "sudah terjangkau" secara otomatis.
function getCoverageResult(kota, kecamatan, alamat) {
  const pesan = `Halo M3, saya ingin cek jangkauan internet di alamat: ${alamat}, Kec. ${kecamatan}, ${kota}.`;
  const waNumber = document.body.dataset.wa || '6287844690552';
  const waUrl = `https://wa.me/${waNumber.replace(/\D/g, '')}?text=${encodeURIComponent(pesan)}`;
  return {
    status: 'info',
    title: 'Data lokasi siap dikirim',
    message: `Tim kami akan mengecek ketersediaan jaringan di ${esc(kecamatan)}, ${esc(kota)} dan membalas secepatnya.
      <a href="${waUrl}" target="_blank" rel="noopener" class="btn btn-wa" style="margin-top:12px;padding:10px 18px">
        <svg aria-hidden="true" style="color:#fff"><use href="#i-wa" /></svg>Kirim via WhatsApp</a>`,
  };
}

const showResult = ({ status, title, message }) => {
  resultBox.className = `coverage-result show ${status}`;
  resultBox.innerHTML = `${RESULT_ICONS[status] || RESULT_ICONS.info}<div><b>${title}</b><p>${message}</p></div>`;
};

form.addEventListener('submit', (e) => {
  e.preventDefault();
  let valid = true;
  form.querySelectorAll('[required]').forEach((el) => {
    const bad = !el.value.trim();
    el.closest('.field').classList.toggle('invalid', bad);
    if (bad) valid = false;
  });
  if (!valid) {
    showResult({ status: 'none', title: 'Data belum lengkap', message: 'Mohon isi kota, kecamatan, dan alamat terlebih dahulu.' });
    return;
  }

  const label = coverageBtn.querySelector('span');
  coverageBtn.classList.add('loading');
  label.textContent = 'Mengecek...';
  resultBox.classList.remove('show');

  // simulasi request ke server
  setTimeout(() => {
    coverageBtn.classList.remove('loading');
    label.textContent = 'Cek Sekarang';
    const kota = form.kota.value;
    const kecamatan = form.kecamatan.value.trim();
    const alamat = form.alamat.value.trim();
    const result = getCoverageResult(kota, kecamatan, alamat) || {
      status: 'info',
      title: 'Pengecekan diterima',
      message: `Tim kami akan mengonfirmasi ketersediaan jaringan di ${esc(kecamatan)}, ${esc(kota)}.`,
    };
    showResult(result);
  }, 900);
});

form.querySelectorAll('[required]').forEach((el) =>
  el.addEventListener('input', () => el.closest('.field').classList.remove('invalid'))
);

// Tombol "Pilih Paket" mengisi konteks lalu scroll ke cek jangkauan
document.getElementById('paket').addEventListener('click', (e) => {
  const btn = e.target.closest('[data-f="cta"]');
  if (!btn) return;
  showResult({ status: 'info', title: `Paket ${btn.dataset.plan} dipilih`, message: 'Cek dulu apakah alamatmu sudah terjangkau jaringan M3.' });
});

/* =========================================================
   FAQ: accordion
   ========================================================= */
// Klik ditangani lewat delegasi di #accordion (item FAQ dirender server dari database).
const accordion = document.getElementById('accordion');
const accItems = () => [...accordion.querySelectorAll('.acc-item')];
const setAcc = (item, open) => {
  const panel = item.querySelector('.acc-panel');
  item.classList.toggle('open', open);
  item.querySelector('.acc-btn').setAttribute('aria-expanded', String(open));
  panel.style.maxHeight = open ? panel.scrollHeight + 'px' : '0px';
};
accItems().forEach((item) => setAcc(item, item.classList.contains('open')));
accordion.addEventListener('click', (e) => {
  const item = e.target.closest('.acc-btn')?.closest('.acc-item');
  if (!item) return;
  const willOpen = !item.classList.contains('open');
  accItems().forEach((other) => setAcc(other, other === item && willOpen));
});
window.addEventListener('resize', () => accItems().filter((i) => i.classList.contains('open')).forEach((i) => setAcc(i, true)));
