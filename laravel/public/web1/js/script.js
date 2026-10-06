(() => {
  const toggle = document.querySelector(".nav-toggle");
  const mobileNav = document.getElementById("mobile-nav");
  if (toggle && mobileNav) {
    const closeMenu = () => {
      toggle.setAttribute("aria-expanded", "false");
      mobileNav.classList.remove("is-open");
    };
    toggle.addEventListener("click", () => {
      const open = toggle.getAttribute("aria-expanded") === "true";
      toggle.setAttribute("aria-expanded", String(!open));
      mobileNav.classList.toggle("is-open", !open);
    });
    mobileNav.querySelectorAll("a").forEach((a) => a.addEventListener("click", closeMenu));
    window.addEventListener("resize", () => {
      if (window.innerWidth >= 768) closeMenu();
    });
  }
})();

// Kartu dirender server oleh Blade (resources/views/sites/web1.blade.php).
const initBundlingCarousel = () => {
  const track = document.getElementById("bundlingTrack");
  const dotsWrap = document.getElementById("bundlingDots");
  const prevBtn = document.querySelector(".carousel-arrow.prev");
  const nextBtn = document.querySelector(".carousel-arrow.next");
  if (!track || !dotsWrap) return;

  const realCards = Array.from(track.children);
  const realCount = realCards.length;
  // Tanpa kartu atau hanya satu kartu, carousel tak perlu panah/titik/loop.
  [prevBtn, nextBtn].forEach((b) => b && (b.hidden = realCount < 2));
  dotsWrap.hidden = realCount < 2;
  if (realCount < 2) return;

  dotsWrap.innerHTML = realCards
    .map((_, i) => `<button class="dot" type="button" role="tab" aria-selected="false" aria-label="Paket ${i + 1}" data-index="${i}"></button>`)
    .join("");
  const dots = Array.from(dotsWrap.children);

  // Clone the full set before and after the real cards so scrolling past
  // either end lands on a visually identical card, then jump instantly
  // to the matching real card underneath — this makes the carousel loop
  // forever like a merry-go-round instead of stopping at the edges.
  const cloneSet = () =>
    realCards.map((card) => {
      const clone = card.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      clone.querySelectorAll("a, button").forEach((el) => (el.tabIndex = -1));
      return clone;
    });

  const beforeFrag = document.createDocumentFragment();
  cloneSet().forEach((clone) => beforeFrag.appendChild(clone));
  track.insertBefore(beforeFrag, track.firstChild);

  const afterFrag = document.createDocumentFragment();
  cloneSet().forEach((clone) => afterFrag.appendChild(clone));
  track.appendChild(afterFrag);

  const allCards = Array.from(track.children);
  let currentIndex = realCount; // start on real card 0

  const toRealIndex = (index) => ((index - realCount) % realCount + realCount) % realCount;
  const inlineAlign = () => (window.innerWidth >= 960 ? "start" : "center");

  const setActiveDot = (realIdx) => {
    dots.forEach((dot, i) => {
      const isActive = i === realIdx;
      dot.classList.toggle("is-active", isActive);
      dot.setAttribute("aria-selected", String(isActive));
    });
  };

  const scrollToIndex = (index, instant = false) => {
    const card = allCards[index];
    if (!card) return;
    const trackRect = track.getBoundingClientRect();
    const cardRect = card.getBoundingClientRect();
    const delta =
      inlineAlign() === "start"
        ? cardRect.left - trackRect.left
        : cardRect.left - trackRect.left - (trackRect.width - cardRect.width) / 2;
    track.scrollTo({ left: track.scrollLeft + delta, behavior: instant ? "auto" : "smooth" });
  };

  let isCorrecting = false;

  const findClosestIndex = () => {
    const trackRect = track.getBoundingClientRect();
    const anchor = inlineAlign() === "start" ? trackRect.left : trackRect.left + trackRect.width / 2;
    let closest = 0;
    let closestDist = Infinity;
    allCards.forEach((card, i) => {
      const rect = card.getBoundingClientRect();
      const point = inlineAlign() === "start" ? rect.left : rect.left + rect.width / 2;
      const dist = Math.abs(point - anchor);
      if (dist < closestDist) {
        closestDist = dist;
        closest = i;
      }
    });
    return closest;
  };

  const handleSettle = () => {
    if (isCorrecting) return;
    currentIndex = findClosestIndex();
    const realIdx = toRealIndex(currentIndex);
    setActiveDot(realIdx);

    if (currentIndex < realCount || currentIndex >= realCount * 2) {
      isCorrecting = true;
      currentIndex = realCount + realIdx;
      scrollToIndex(currentIndex, true);
      requestAnimationFrame(() => {
        isCorrecting = false;
      });
    }
  };

  if ("onscrollend" in window) {
    track.addEventListener("scrollend", handleSettle);
  } else {
    let settleTimer = null;
    track.addEventListener(
      "scroll",
      () => {
        clearTimeout(settleTimer);
        settleTimer = setTimeout(handleSettle, 120);
      },
      { passive: true }
    );
  }

  const goTo = (index) => {
    currentIndex = index;
    scrollToIndex(index);
  };

  prevBtn?.addEventListener("click", () => goTo(currentIndex - 1));
  nextBtn?.addEventListener("click", () => goTo(currentIndex + 1));
  dots.forEach((dot, i) => dot.addEventListener("click", () => goTo(realCount + i)));

  let resizeTimer = null;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => scrollToIndex(currentIndex, true), 150);
  });

  scrollToIndex(currentIndex, true);
  setActiveDot(0);
};

initBundlingCarousel();

// Navbar scroll-spy: the navy "pill" follows the section being read.
(() => {
  const links = Array.from(document.querySelectorAll(".main-nav a, .mobile-nav a"));
  const sections = ["top", "paket", "bundling", "kontak"]
    .map((id) => document.getElementById(id))
    .filter(Boolean);
  if (!links.length || !sections.length || !("IntersectionObserver" in window)) return;

  const setActive = (id) => {
    links.forEach((a) => {
      const on = a.getAttribute("href") === `#${id}`;
      a.classList.toggle("is-active", on);
      if (on) a.setAttribute("aria-current", "page");
      else a.removeAttribute("aria-current");
    });
  };

  // rootMargin shrinks the viewport to a thin band ~45% from the top, so a
  // section only "intersects" while it crosses that reading line.
  const observer = new IntersectionObserver(
    (entries) => {
      // TODO (dari versi statis, belum dikerjakan): decide which section becomes active from `entries`
      // and call setActive(section.id).
    },
    { rootMargin: "-45% 0px -50% 0px" }
  );

  sections.forEach((section) => observer.observe(section));
})();
