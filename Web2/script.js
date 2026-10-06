const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');

if (navToggle && navMenu) {
  navToggle.addEventListener('click', () => {
    const isOpen = navMenu.classList.toggle('open');
    navToggle.classList.toggle('active', isOpen);
    navToggle.setAttribute('aria-expanded', String(isOpen));
  });

  navMenu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      navMenu.classList.remove('open');
      navToggle.classList.remove('active');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  });
}

const priceCards = Array.from(document.querySelectorAll('.price-card'));

priceCards.forEach((card) => {
  const packageName = card.querySelector('.package-badge').textContent.trim();
  const button = card.querySelector('.btn-card-select');
  if (!button) return;

  const packageLabel = button.dataset.package || packageName;
  const encodedPackage = encodeURIComponent(packageLabel);
  button.href = `https://wa.me/6287844690552?text=Halo%20Permana%2C%20saya%20ingin%20pilih%20paket%20${encodedPackage}.`;
});
