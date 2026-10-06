<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ $t('meta.title') }}</title>
<meta name="description" content="{{ $t('meta.description') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" />
<link rel="stylesheet" href="{{ asset('web1/css/style.css') }}" />
</head>
<body>

<!-- Icon sprite -->
<svg style="display:none" aria-hidden="true">
  <symbol id="i-check" viewBox="0 0 24 24" fill="none"><path d="M4 12.5 9.5 18 20 6" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-whatsapp" viewBox="0 0 24 24" fill="none"><path d="M7 20.5 3.6 21.4a.6.6 0 0 1-.73-.73L3.8 17A8.5 8.5 0 1 1 7 20.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8.3 9.3c.2-.9 1.6-1 1.9-.4.4.7.6 1.5 1 2 .3.4-.1.8-.4 1.1-.3.3-.3.5-.1.9.5.9 1.5 1.8 2.4 2.2.4.2.6.2.9-.1.3-.3.6-.7 1.1-.5.5.2 1.3.6 1.9 1 .5.3.3 1.6-.5 2-1 .5-2 .5-3.4-.1-2-.9-3.9-2.9-4.6-4.9-.5-1.3-.4-2.4-.2-3.2Z" fill="currentColor"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24" fill="none"><path d="M6.6 3.5 9 4.3c.5.2.8.7.7 1.2l-.6 2.2c-.1.4 0 .8.3 1.1l4.8 4.8c.3.3.7.4 1.1.3l2.2-.6c.5-.1 1 .2 1.2.7l.8 2.4c.2.5 0 1.1-.5 1.4-1.1.7-2.7 1.2-4.4.5-3.6-1.4-7-4.8-8.4-8.4-.7-1.7-.2-3.3.5-4.4.3-.5.9-.7 1.4-.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></symbol>
  <symbol id="i-arrow" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-menu" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></symbol>
  <symbol id="i-close" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></symbol>
</svg>

<!-- ===== BACKGROUND: gradasi biru + gelombang besar di belakang kartu ===== -->
<div class="page-bg" aria-hidden="true">
  <svg class="page-wave" viewBox="0 0 1440 900" preserveAspectRatio="none">
    <path d="M0 520 C 260 420 420 640 720 560 S 1180 360 1440 440 L1440 900 L0 900 Z" fill="#ffffff" fill-opacity=".18"/>
    <path d="M0 660 C 300 560 520 780 820 700 S 1240 560 1440 620 L1440 900 L0 900 Z" fill="#ffffff" fill-opacity=".22"/>
  </svg>
</div>

<!-- ===== KARTU PUTIH (seluruh halaman) ===== -->
<div class="page-card">

<!-- ===== NAVBAR (rata kanan, tanpa logo) ===== -->
<header class="site-header">
  <div class="wrap">
    <nav class="main-nav" aria-label="Navigasi utama">
      <a href="#top" class="is-active" aria-current="page">{{ $t('nav.home') }}</a>
      <a href="#paket">{{ $t('nav.paket') }}</a>
      <a href="#bundling">{{ $t('nav.bundling') }}</a>
      <a href="#kontak">{{ $t('nav.kontak') }}</a>
    </nav>

    <button class="nav-toggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-nav">
      <svg class="icon-open" aria-hidden="true"><use href="#i-menu"/></svg>
      <svg class="icon-close" aria-hidden="true"><use href="#i-close"/></svg>
    </button>
  </div>

  <nav id="mobile-nav" class="mobile-nav" aria-label="Navigasi mobile">
    <a href="#top" class="is-active" aria-current="page">{{ $t('nav.home') }}</a>
    <a href="#paket">{{ $t('nav.paket') }}</a>
    <a href="#bundling">{{ $t('nav.bundling') }}</a>
    <a href="#kontak">{{ $t('nav.kontak') }}</a>
  </nav>
</header>

<main>

  <!-- ===== HERO ===== -->
  <section class="hero" id="top">
    <!-- Blob biru muda: melengkung dari kiri bawah ke kanan atas -->
    <svg class="hero-blob" viewBox="0 0 1200 640" preserveAspectRatio="none" aria-hidden="true">
      <path d="M0 640 L0 520 C 220 560 360 430 520 380 C 700 320 760 160 940 110 C 1050 80 1130 30 1200 0 L1200 640 Z" fill="#E1F5FE"/>
    </svg>

    <div class="wrap">
      <div class="hero-grid">

        <!-- Kiri: teks -->
        <div class="hero-copy">
          <p class="eyebrow">{{ $t('hero.eyebrow') }}</p>
          <h1>
            <span class="line1">{{ $t('hero.line1') }}</span>
            <span class="line2">{{ $t('hero.line2') }}</span>
          </h1>
          <p class="lede">{{ $t('hero.lede') }}</p>
          <div class="hero-cta">
            <a class="btn btn-primary" href="{{ $wa('contact.waMessage') }}" target="_blank" rel="noopener">
              <svg aria-hidden="true"><use href="#i-whatsapp"/></svg>
              <span>{{ $t('hero.ctaPrimary') }}</span>
            </a>
            <a class="btn btn-navy" href="#paket">
              <span>{{ $t('hero.ctaSecondary') }}</span>
              <svg aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </div>
        </div>

        <!-- Kanan: ilustrasi (SVG belakang → peta Surabaya → SVG depan) -->
        <div class="hero-visual">
          <!-- Lapisan belakang -->
          <svg class="illu illu-back" viewBox="0 0 600 520" aria-hidden="true">
            <circle cx="300" cy="230" r="215" fill="#E1F5FE"/>
            <circle cx="300" cy="230" r="160" fill="#B3E5FC" fill-opacity=".55"/>
            <ellipse cx="300" cy="500" rx="270" ry="16" fill="#81D4FA" fill-opacity=".45"/>
          </svg>

          <!-- Peta Surabaya (komponen lama dipertahankan) -->
          <figure class="hero-screen">
            <img class="hero-photo" src="{{ asset('web1/img/Surabaya.png') }}" alt="Peta cakupan layanan CentrinOnline di Surabaya" width="600" height="339" />
            <span class="hero-photo-tag">
              <span class="hero-photo-dot"></span>
              <span>{{ $t('hero.mapTag') }}</span>
            </span>
          </figure>

          <!-- Lapisan depan -->
          <svg class="illu illu-front" viewBox="0 0 600 520" aria-hidden="true">
            <!-- Awan + disket (cloud storage) -->
            <g class="cloud">
              <circle cx="252" cy="78" r="30" fill="#29B6F6"/>
              <circle cx="298" cy="54" r="42" fill="#29B6F6"/>
              <circle cx="348" cy="74" r="32" fill="#29B6F6"/>
              <rect x="222" y="72" width="156" height="40" rx="20" fill="#29B6F6"/>
              <rect x="280" y="60" width="38" height="38" rx="5" fill="#FF6F3C"/>
              <rect x="288" y="60" width="20" height="12" fill="#ffffff"/>
              <rect x="301" y="62" width="4" height="8" fill="#0D2B4E"/>
              <rect x="286" y="80" width="26" height="14" rx="2" fill="#ffffff"/>
            </g>

            <!-- Tumpukan 4 kartu notifikasi + checkbox -->
            <g class="notifs">
              <g transform="translate(0 70)">
                <rect x="444" y="10" width="16" height="16" rx="4" fill="#fff" stroke="#0D2B4E" stroke-width="2"/>
                <path d="M447 18l3.5 3.5 6-7" stroke="#FF6F3C" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="468" y="0" width="122" height="36" rx="9" fill="#81D4FA"/>
                <circle cx="486" cy="18" r="10" fill="#ffffff"/><circle cx="486" cy="15" r="4" fill="#0D2B4E"/><path d="M479 24a7 6 0 0 1 14 0" fill="#0D2B4E"/>
                <rect x="503" y="11" width="72" height="5" rx="2.5" fill="#fff"/><rect x="503" y="21" width="46" height="5" rx="2.5" fill="#fff" fill-opacity=".7"/>
              </g>
              <g transform="translate(0 114)">
                <rect x="444" y="10" width="16" height="16" rx="4" fill="#fff" stroke="#0D2B4E" stroke-width="2"/>
                <path d="M447 18l3.5 3.5 6-7" stroke="#FF6F3C" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="468" y="0" width="122" height="36" rx="9" fill="#81D4FA"/>
                <circle cx="486" cy="18" r="10" fill="#ffffff"/><circle cx="486" cy="15" r="4" fill="#FF6F3C"/><path d="M479 24a7 6 0 0 1 14 0" fill="#FF6F3C"/>
                <rect x="503" y="11" width="64" height="5" rx="2.5" fill="#fff"/><rect x="503" y="21" width="52" height="5" rx="2.5" fill="#fff" fill-opacity=".7"/>
              </g>
              <g transform="translate(0 158)">
                <rect x="444" y="10" width="16" height="16" rx="4" fill="#fff" stroke="#0D2B4E" stroke-width="2"/>
                <rect x="468" y="0" width="122" height="36" rx="9" fill="#81D4FA"/>
                <circle cx="486" cy="18" r="10" fill="#ffffff"/><circle cx="486" cy="15" r="4" fill="#0D2B4E"/><path d="M479 24a7 6 0 0 1 14 0" fill="#0D2B4E"/>
                <rect x="503" y="11" width="70" height="5" rx="2.5" fill="#fff"/><rect x="503" y="21" width="40" height="5" rx="2.5" fill="#fff" fill-opacity=".7"/>
              </g>
              <g transform="translate(0 202)">
                <rect x="444" y="10" width="16" height="16" rx="4" fill="#fff" stroke="#0D2B4E" stroke-width="2"/>
                <rect x="468" y="0" width="122" height="36" rx="9" fill="#81D4FA"/>
                <circle cx="486" cy="18" r="10" fill="#ffffff"/><circle cx="486" cy="15" r="4" fill="#FF6F3C"/><path d="M479 24a7 6 0 0 1 14 0" fill="#FF6F3C"/>
                <rect x="503" y="11" width="58" height="5" rx="2.5" fill="#fff"/><rect x="503" y="21" width="48" height="5" rx="2.5" fill="#fff" fill-opacity=".7"/>
              </g>
            </g>

            <!-- Simbol WiFi oranye (busur berdenyut bergantian) -->
            <g class="wifi" stroke="#FF6F3C" stroke-width="12" stroke-linecap="round" fill="none">
              <path class="arc arc-1" d="M68 423 A24 24 0 0 1 102 423"/>
              <path class="arc arc-2" d="M52.5 407.5 A46 46 0 0 1 117.5 407.5"/>
              <path class="arc arc-3" d="M37 392 A68 68 0 0 1 133 392"/>
              <path class="arc arc-4" d="M21.4 376.4 A90 90 0 0 1 148.6 376.4"/>
              <circle cx="85" cy="442" r="9" fill="#FF6F3C" stroke="none"/>
            </g>

            <!-- Daun dekoratif di dasar -->
            <g class="leaves">
              <path d="M0 0C16-20 16-44 0-64C-16-44-16-20 0 0Z" transform="translate(30 505) rotate(-28)" fill="#29B6F6"/>
              <path d="M0 0C14-18 14-38 0-54C-14-38-14-18 0 0Z" transform="translate(52 508) rotate(12)" fill="#81D4FA"/>
              <path d="M0 0C14-18 14-38 0-54C-14-38-14-18 0 0Z" transform="translate(150 506) rotate(-12)" fill="#81D4FA"/>
              <path d="M0 0C16-20 16-44 0-64C-16-44-16-20 0 0Z" transform="translate(556 506) rotate(24)" fill="#29B6F6"/>
              <path d="M0 0C14-18 14-38 0-54C-14-38-14-18 0 0Z" transform="translate(578 508) rotate(48)" fill="#81D4FA"/>
            </g>

            <!-- Bar kata sandi: gembok + bintang -->
            <g class="password-bar">
              <rect x="150" y="420" width="300" height="50" rx="25" fill="#81D4FA"/>
              <path d="M176 438v-6a8 8 0 0 1 16 0v6" stroke="#FF6F3C" stroke-width="4" fill="none"/>
              <rect x="171" y="437" width="26" height="20" rx="4" fill="#FF6F3C"/>
              <circle cx="184" cy="447" r="3" fill="#fff"/>
              <text x="212" y="458" fill="#0D2B4E" font-family="Poppins, sans-serif" font-weight="800" font-size="28" letter-spacing="4">******</text>
            </g>

            <!-- Gelembung bicara "WIFI" -->
            <g class="bubble">
              <rect x="328" y="300" width="80" height="34" rx="17" fill="#29B6F6"/>
              <path d="M352 333 l8 12 l6 -12 z" fill="#29B6F6"/>
              <text x="368" y="323" text-anchor="middle" fill="#fff" font-family="Poppins, sans-serif" font-weight="800" font-size="15" letter-spacing="1.5">WIFI</text>
            </g>

            <!-- Karakter perempuan: duduk di atas bar, memegang laptop -->
            <g class="person-woman" transform="translate(130 0)">
              <path d="M222 352q0-26 16-26t16 26l2 20q-9 5-17-1z" fill="#0D2B4E"/>
              <path d="M224 414h44v6l3 34h-10l-3-30h-34z" fill="#0D2B4E"/>
              <rect x="259" y="452" width="16" height="7" rx="3" fill="#0D2B4E"/>
              <path d="M222 416q-2-42 14-50q14 4 14 22l2 28z" fill="#FF6F3C"/>
              <circle cx="238" cy="350" r="11" fill="#F6C7A8"/>
              <path d="M227 348q4-12 18-8q-6 2-8 8z" fill="#0D2B4E"/>
              <polygon points="244,406 254,376 286,376 276,406" fill="#0D2B4E"/>
              <circle cx="270" cy="391" r="3.5" fill="#81D4FA"/>
              <rect x="236" y="404" width="42" height="5" rx="2" fill="#0D2B4E"/>
              <path d="M238 376l14 24" stroke="#FF6F3C" stroke-width="7" stroke-linecap="round"/>
              <circle cx="253" cy="401" r="3.5" fill="#F6C7A8"/>
            </g>

            <!-- Karakter laki-laki: berdiri memegang tablet -->
            <g class="person-man">
              <rect x="490" y="440" width="10" height="62" rx="4" fill="#0D2B4E"/>
              <rect x="503" y="440" width="10" height="62" rx="4" fill="#0D2B4E"/>
              <rect x="484" y="498" width="18" height="7" rx="3" fill="#FF6F3C"/>
              <rect x="503" y="498" width="18" height="7" rx="3" fill="#FF6F3C"/>
              <path d="M486 446q-4-38 16-46q20 8 16 46z" fill="#0D2B4E"/>
              <rect x="497" y="391" width="9" height="10" fill="#E8B08F"/>
              <circle cx="502" cy="380" r="13" fill="#E8B08F"/>
              <path d="M489 377q2-16 15-15q12 1 11 13q-8-6-26 2z" fill="#FF6F3C"/>
              <path d="M490 410l-10 22" stroke="#0D2B4E" stroke-width="8" stroke-linecap="round"/>
              <rect x="466" y="414" width="26" height="34" rx="4" fill="#29B6F6" stroke="#0D2B4E" stroke-width="3"/>
              <rect x="471" y="420" width="16" height="3" rx="1.5" fill="#fff"/>
              <rect x="471" y="427" width="11" height="3" rx="1.5" fill="#fff" fill-opacity=".7"/>
              <circle cx="482" cy="434" r="4" fill="#E8B08F"/>
            </g>
          </svg>
        </div>

      </div>
    </div>
  </section>


  <!-- ===== PRICING PLANS ===== -->
  <section class="plans" id="paket">
    <div class="wrap">
      <div class="section-head plans-head">
        <p class="eyebrow">{{ $t('plans.eyebrow') }}</p>
        <h2>{{ $t('plans.title') }}</h2>
        <p class="sub">{{ $t('plans.sub') }}</p>
      </div>

      <div class="plans-grid" id="plansGrid">
        @forelse ($plans as $card)
          @include('sites.partials.web1-card', ['card' => $card, 'bundle' => false])
        @empty
          <p class="sub">Paket akan segera tersedia.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ===== TERMS STRIP ===== -->
  <div class="terms-strip">
    <div class="wrap">
      <span class="chip"><svg><use href="#i-check"/></svg><span>{{ $t('terms.chip1') }}</span></span>
      <span class="chip"><svg><use href="#i-check"/></svg><span>{{ $t('terms.chip2') }}</span></span>
      <span class="chip"><svg><use href="#i-check"/></svg><span>{{ $t('terms.chip3') }}</span></span>
      <span class="fineprint">{{ $t('terms.fineprint') }}</span>
    </div>
  </div>

  <!-- ===== BUNDLING ===== -->
  <section class="bundling" id="bundling">
    <div class="wrap">
      <div class="section-head">
        <p class="eyebrow">{{ $t('bundling.eyebrow') }}</p>
        <h2>{{ $t('bundling.title') }}</h2>
        <p class="sub">{{ $t('bundling.sub') }}</p>
      </div>

      <div class="bundling-carousel">
        <button class="carousel-arrow prev" type="button" aria-label="Paket sebelumnya">
          <svg aria-hidden="true"><use href="#i-arrow"/></svg>
        </button>

        <div class="carousel-track" id="bundlingTrack" role="list" aria-label="Daftar paket bundling">
          @foreach ($bundles as $card)
            @include('sites.partials.web1-card', ['card' => $card, 'bundle' => true])
          @endforeach
        </div>

        <button class="carousel-arrow next" type="button" aria-label="Paket berikutnya">
          <svg aria-hidden="true"><use href="#i-arrow"/></svg>
        </button>
      </div>

      <!-- Titik navigasi dibuat otomatis oleh js/script.js sesuai jumlah kartu -->
      <div class="carousel-dots" id="bundlingDots" role="tablist" aria-label="Pilih paket"></div>

      <p class="bundling-foot">{{ $t('bundling.foot') }}</p>
    </div>
  </section>

  <!-- ===== CONTACT / FOOTER ===== -->
  <section class="contact-band" id="kontak">
    <div class="wrap contact-inner">
      <p class="eyebrow">{{ $t('contact.eyebrow') }}</p>
      <h2>{{ $t('contact.title') }}</h2>
      <div class="contact-actions">
        <a class="btn btn-accent" href="{{ $wa('contact.waMessage') }}" target="_blank" rel="noopener">
          <svg aria-hidden="true"><use href="#i-whatsapp"/></svg>
          <span>{{ $t('contact.btnWa') }}</span>
        </a>
        <a class="btn btn-ghost-light" href="{{ $tel('contact.phone') }}">
          <svg aria-hidden="true"><use href="#i-phone"/></svg>
          <span>{{ $t('contact.btnPhone') }}</span>
        </a>
      </div>
      <p class="coverage-note">{{ $t('contact.note') }}</p>
    </div>
  </section>

  <footer class="site-footer">
    <div class="wrap">
      <span>{{ $t('footer.copy') }}</span>
      <a href="{{ $t('footer.linkUrl') }}" target="_blank" rel="noopener">{{ $t('footer.linkText') }}</a>
    </div>
  </footer>

</main>

</div><!-- /.page-card -->

<script src="{{ asset('web1/js/script.js') }}"></script>
</body>
</html>
