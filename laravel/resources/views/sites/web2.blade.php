<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="{{ $t('meta.description') }}" />
  <meta name="theme-color" content="#1E88E5" />
  <title>{{ $t('meta.title') }}</title>
  <!-- Favicon: ikon WiFi oranye (SVG inline) -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%230D2B4E'/%3E%3Cg fill='none' stroke='%23FF6F3C' stroke-width='3' stroke-linecap='round'%3E%3Cpath d='M7 13a13 13 0 0 1 18 0'/%3E%3Cpath d='M11 17.5a7 7 0 0 1 10 0'/%3E%3C/g%3E%3Ccircle cx='16' cy='22.5' r='2.3' fill='%23FF6F3C'/%3E%3C/svg%3E" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('web2/css/style.css') }}" />
</head>
<body data-wa="{{ $t('contact.waNumber') }}">

  <!-- =========================================================
       SVG SYMBOLS (ikon yang dipakai berulang)
       ========================================================= -->
  <svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <defs>
      <symbol id="i-wifi" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
          <path d="M2.5 9a14 14 0 0 1 19 0" />
          <path d="M5.8 12.6a9 9 0 0 1 12.4 0" />
          <path d="M9.1 16.1a4.2 4.2 0 0 1 5.8 0" />
        </g>
        <circle cx="12" cy="19.6" r="1.7" fill="currentColor" />
      </symbol>
      <symbol id="i-check" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="11" fill="#E3F2FD" />
        <path d="M7 12.4l3.2 3.1L17 8.8" fill="none" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-check-o" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="11" fill="#FFE9E0" />
        <path d="M7 12.4l3.2 3.1L17 8.8" fill="none" stroke="#FF6F3C" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-arrow" viewBox="0 0 24 24">
        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-wa" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2c-1.6 0-3.1-.4-4.4-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1-.7-.3-1.4-.7-2-1.3-.6-.5-1-1.1-1.4-1.8-.1-.2 0-.4.1-.5l.4-.5.3-.5v-.5l-.8-1.9c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.6.6-.9 1.4-.9 2.2 0 .9.4 1.8 1 2.5 1.1 1.6 2.5 2.9 4.2 3.7.5.2.9.4 1.4.5.6.2 1.1.1 1.6.1.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.2-1.2-.1-.1-.3-.2-.5-.3z"/>
      </symbol>
      <symbol id="i-pin" viewBox="0 0 24 24">
        <path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z" fill="none" stroke="currentColor" stroke-width="2" />
        <circle cx="12" cy="10" r="2.6" fill="none" stroke="currentColor" stroke-width="2" />
      </symbol>
    </defs>
  </svg>

  <!-- =========================================================
       NAVBAR
       ========================================================= -->
  <header class="navbar" id="navbar">
    <div class="container nav-inner">
      <a href="#beranda" class="logo" aria-label="M3 Internet - Beranda">
        <span class="logo-icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <rect x="3" y="15" width="3.4" height="5" rx="1.2" fill="#4FC3F7" />
            <rect x="8.4" y="11" width="3.4" height="9" rx="1.2" fill="#4FC3F7" />
            <rect x="13.8" y="7" width="3.4" height="13" rx="1.2" fill="#FFFFFF" />
            <rect x="19.2" y="3" width="3.4" height="17" rx="1.2" fill="#FF6F3C" />
          </svg>
        </span>
        <span>
          <span class="m">M</span><span class="three">3</span>
          <span class="logo-tag">INTERNET</span>
        </span>
      </a>

      <nav class="nav-menu" id="navMenu" aria-label="Navigasi utama">
        <a href="#beranda" class="nav-link active">{{ $t('nav.beranda') }}</a>
        <a href="#paket" class="nav-link">{{ $t('nav.paket') }}</a>
        <a href="#jangkauan" class="nav-link">{{ $t('nav.jangkauan') }}</a>
        <a href="#bantuan" class="nav-link">{{ $t('nav.bantuan') }}</a>
        <a href="#kontak" class="nav-link">{{ $t('nav.kontak') }}</a>
        <a href="#paket" class="btn btn-orange nav-cta">{{ $t('nav.cta') }}</a>
      </nav>

      <button class="hamburger" id="hamburger" aria-label="Buka menu" aria-expanded="false" aria-controls="navMenu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <main>
    <!-- =========================================================
         1. HERO
         ========================================================= -->
    <section class="hero" id="beranda">
      <svg class="hero-blob b1" viewBox="0 0 200 200" aria-hidden="true"><path fill="#BBDEFB" d="M44.7-61.6C57.3-52.4 66.2-38.2 70.9-22.6 75.5-7 75.9 10 69.6 24.1 63.3 38.2 50.3 49.4 35.6 57.7 20.9 66 4.4 71.4-12.7 70.2-29.8 69-47.5 61.2-58.8 47.8-70.1 34.4-75 15.4-73.1-2.6-71.2-20.6-62.4-37.6-49.5-46.9-36.6-56.2-19.6-57.8-2.3-54.7 15-51.6 32.1-70.8 44.7-61.6Z" transform="translate(100 100)"/></svg>
      <svg class="hero-blob b2" viewBox="0 0 200 200" aria-hidden="true"><path fill="#4FC3F7" d="M39.9-54.3C51.4-46.2 60.2-34.4 65.4-20.6 70.6-6.8 72.2 9 66.6 21.6 61 34.2 48.2 43.6 34.6 51.9 21 60.2 6.6 67.4-8.6 68.5-23.8 69.6-39.8 64.6-51.4 54.2-63 43.8-70.2 28-71.6 11.9-73 -4.2-68.6-20.6-59.5-33.4-50.4-46.2-36.6-55.4-22.4-62.6-8.2-69.8 6.4-75 19.4-70.4 32.4-65.8 28.4-62.4 39.9-54.3Z" transform="translate(100 100)"/></svg>

      <div class="container hero-grid">
        <!-- Teks hero -->
        <div class="hero-copy">
          <div class="hero-pill reveal">
            <span class="dot"><svg viewBox="0 0 24 24" style="color:#fff"><use href="#i-wifi" /></svg></span>
            <span>{{ $t('hero.pill') }}</span>
          </div>
          <h1 class="reveal d1">
            <span class="l1">{{ $t('hero.line1') }}</span>
            <span class="l2">{{ $t('hero.line2') }}</span>
          </h1>
          <p class="hero-sub reveal d2"><span>{{ $t('hero.sub') }}</span> <strong>{{ $t('hero.subStrong') }}</strong>.</p>
          <div class="hero-actions reveal d2">
            <a href="#paket" class="btn btn-blue">
              <span>{{ $t('hero.ctaPaket') }}</span>
              <svg aria-hidden="true"><use href="#i-arrow" /></svg>
            </a>
            <a href="#jangkauan" class="btn btn-navy">
              <svg aria-hidden="true" style="color:#FF6F3C"><use href="#i-pin" /></svg>
              <span>{{ $t('hero.ctaJangkauan') }}</span>
            </a>
          </div>
          <div class="hero-badges reveal d3">
            <span class="badge">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17c4 0 4-10 9-10s5 10 9 10" fill="none" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /><circle cx="3" cy="17" r="2" fill="#FF6F3C" /><circle cx="21" cy="17" r="2" fill="#4FC3F7" /></svg>
              <span>{{ $t('hero.badge1') }}</span>
            </span>
            <span class="badge">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.5 8.5c-2 0-3.5 1.6-3.5 3.5s1.5 3.5 3.5 3.5c3 0 6-7 9-7 2 0 3.5 1.6 3.5 3.5s-1.5 3.5-3.5 3.5c-3 0-6-7-9-7z" fill="none" stroke="#FF6F3C" stroke-width="2.4" stroke-linecap="round" /></svg>
              <span>{{ $t('hero.badge2') }}</span>
            </span>
            <span class="badge">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 14v-2a8 8 0 0 1 16 0v2" fill="none" stroke="#0D2B4E" stroke-width="2.2" stroke-linecap="round" /><rect x="2.5" y="13" width="4.5" height="7" rx="2" fill="#1E88E5" /><rect x="17" y="13" width="4.5" height="7" rx="2" fill="#1E88E5" /></svg>
              <span>{{ $t('hero.badge3') }}</span>
            </span>
          </div>
        </div>

        <!-- Ilustrasi hero: router WiFi, keluarga streaming, gaming, kerja, awan, speedometer, kabel fiber -->
        <div class="hero-art reveal d2">
          <svg viewBox="0 0 560 500" role="img" aria-label="Ilustrasi keluarga menikmati internet M3: streaming, bekerja, dan bermain game dengan router WiFi">
            <!-- latar blob -->
            <path d="M292 40c118-6 226 64 238 178s-46 228-178 252S70 444 42 330 160 46 292 40z" fill="#FFFFFF" opacity=".75" />
            <circle cx="280" cy="270" r="190" fill="#E3F2FD" opacity=".7" />

            <!-- awan -->
            <g class="float-slow" fill="#FFFFFF">
              <ellipse cx="96" cy="74" rx="40" ry="17" />
              <ellipse cx="118" cy="62" rx="24" ry="20" />
              <ellipse cx="80" cy="64" rx="18" ry="14" />
            </g>
            <g class="float-slow" style="animation-delay:-6s" fill="#FFFFFF">
              <ellipse cx="300" cy="46" rx="34" ry="14" />
              <ellipse cx="318" cy="36" rx="20" ry="16" />
              <ellipse cx="288" cy="38" rx="14" ry="11" />
            </g>

            <!-- kabel fiber berwarna melengkung -->
            <g fill="none" stroke-width="5" stroke-linecap="round">
              <path d="M246 392 C238 452 130 440 34 478" stroke="#FF6F3C" />
              <path d="M266 392 C262 462 176 474 128 500" stroke="#4FC3F7" />
              <path d="M294 392 C296 456 340 470 372 500" stroke="#1E88E5" />
              <path d="M314 392 C326 440 380 430 404 470" stroke="#0D2B4E" />
            </g>
            <g fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" opacity=".85">
              <path class="fiber" d="M246 392 C238 452 130 440 34 478" />
              <path class="fiber" d="M266 392 C262 462 176 474 128 500" />
              <path class="fiber" d="M294 392 C296 456 340 470 372 500" />
            </g>

            <!-- TV streaming -->
            <g class="float" style="animation-duration:7s">
              <rect x="40" y="128" width="156" height="100" rx="12" fill="#0D2B4E" />
              <rect x="49" y="137" width="138" height="74" rx="7" fill="#4FC3F7" />
              <path d="M49 190 l40 -28 30 20 26 -16 42 28 v10 a7 7 0 0 1 -7 7 H56 a7 7 0 0 1 -7 -7z" fill="#1E88E5" />
              <circle cx="160" cy="154" r="8" fill="#FFE082" />
              <circle cx="118" cy="174" r="17" fill="#FFFFFF" opacity=".95" />
              <path d="M113 165 l14 9 -14 9z" fill="#FF6F3C" />
              <rect x="49" y="217" width="138" height="4" rx="2" fill="#24456E" />
              <rect x="49" y="217" width="84" height="4" rx="2" fill="#FF6F3C" />
              <rect x="108" y="228" width="20" height="10" fill="#0D2B4E" />
              <rect x="92" y="236" width="52" height="6" rx="3" fill="#0D2B4E" />
            </g>

            <!-- Keluarga di sofa (streaming) -->
            <g>
              <!-- sandaran sofa -->
              <rect x="30" y="296" width="184" height="54" rx="18" fill="#1E88E5" />
              <!-- ayah -->
              <path d="M62 340 v-38 a22 22 0 0 1 44 0 v38z" fill="#0D2B4E" />
              <circle cx="84" cy="266" r="18" fill="#F6C9A8" />
              <path d="M66 264 a18 18 0 0 1 36 -3 c-8 -2 -14 -8 -16 -12 c-4 8 -12 13 -20 15z" fill="#2D1E16" />
              <path d="M100 306 q20 -4 30 -22" fill="none" stroke="#0D2B4E" stroke-width="9" stroke-linecap="round" />
              <rect x="124" y="270" width="8" height="16" rx="3" fill="#263238" transform="rotate(25 128 278)" />
              <!-- anak -->
              <path d="M140 340 v-26 a17 17 0 0 1 34 0 v26z" fill="#FF6F3C" />
              <circle cx="157" cy="286" r="14" fill="#D9A07A" />
              <path d="M143 285 a14 14 0 0 1 28 -4 c-6 0 -14 -4 -16 -8 c-2 6 -6 10 -12 12z" fill="#1B1B2F" />
              <path d="M150 292 q7 5 14 0" fill="none" stroke="#7A4A2A" stroke-width="1.8" stroke-linecap="round" />
              <!-- popcorn -->
              <path d="M180 318 l18 0 -3 24 h-12z" fill="#FFFFFF" />
              <path d="M184 318 v24 M190 318 v24" stroke="#E53935" stroke-width="3" />
              <circle cx="183" cy="315" r="4.5" fill="#FFE082" /><circle cx="190" cy="312" r="5" fill="#FFF3C4" /><circle cx="196" cy="316" r="4" fill="#FFE082" />
              <!-- dudukan sofa -->
              <rect x="20" y="334" width="204" height="34" rx="14" fill="#1565C0" />
              <rect x="14" y="316" width="26" height="52" rx="12" fill="#1976D2" />
              <rect x="204" y="316" width="26" height="52" rx="12" fill="#1976D2" />
              <rect x="34" y="368" width="8" height="12" rx="2" fill="#0D2B4E" />
              <rect x="202" y="368" width="8" height="12" rx="2" fill="#0D2B4E" />
              <!-- hati / love melayang -->
              <path class="float" d="M112 240 c-4 -6 -14 -3 -12 4 c1 4 12 11 12 11 s11 -7 12 -11 c2 -7 -8 -10 -12 -4z" fill="#FF6F3C" opacity=".9" />
            </g>

            <!-- Router WiFi dengan sinyal oranye berdenyut -->
            <g>
              <circle class="wifi-ring" cx="280" cy="332" r="40" fill="none" stroke="#FF6F3C" stroke-width="3" />
              <circle class="wifi-ring r2" cx="280" cy="332" r="40" fill="none" stroke="#FF6F3C" stroke-width="3" />
              <g fill="none" stroke="#FF6F3C" stroke-width="8" stroke-linecap="round">
                <path class="wifi-arc a3" d="M222 300 a82 82 0 0 1 116 0" />
                <path class="wifi-arc a2" d="M239 316 a58 58 0 0 1 82 0" />
                <path class="wifi-arc" d="M256 332 a34 34 0 0 1 48 0" />
              </g>
              <!-- antena -->
              <rect x="218" y="306" width="8" height="48" rx="4" fill="#0D2B4E" transform="rotate(-12 222 354)" />
              <rect x="334" y="306" width="8" height="48" rx="4" fill="#0D2B4E" transform="rotate(12 338 354)" />
              <!-- badan router -->
              <rect x="200" y="346" width="160" height="50" rx="14" fill="#0D2B4E" />
              <rect x="200" y="346" width="160" height="16" rx="8" fill="#163B66" />
              <text x="218" y="382" font-family="Poppins, sans-serif" font-weight="800" font-size="16" fill="#FFFFFF">M<tspan fill="#FF6F3C">3</tspan></text>
              <circle class="led" cx="292" cy="376" r="4.5" fill="#4FC3F7" />
              <circle class="led l2" cx="308" cy="376" r="4.5" fill="#4FC3F7" />
              <circle class="led l3" cx="324" cy="376" r="4.5" fill="#25D366" />
              <circle cx="340" cy="376" r="4.5" fill="#FF6F3C" />
            </g>

            <!-- Pekerja dengan laptop -->
            <g>
              <!-- orang -->
              <path d="M432 300 v-36 a26 26 0 0 1 52 0 v36z" fill="#4FC3F7" />
              <circle cx="458" cy="222" r="19" fill="#F6C9A8" />
              <path d="M438 226 c-4 -20 10 -30 22 -28 c14 1 22 12 18 26 c-2 -8 -8 -12 -14 -12 c-10 0 -18 4 -26 14z" fill="#3E2723" />
              <path d="M440 232 c-2 14 2 24 6 26" fill="none" stroke="#3E2723" stroke-width="7" stroke-linecap="round" />
              <circle cx="451" cy="226" r="2" fill="#0D2B4E" />
              <path d="M447 216 h8 M461 216 h0" stroke="#0D2B4E" stroke-width="1.5" />
              <!-- headset -->
              <path d="M438 222 a20 20 0 0 1 40 0" fill="none" stroke="#0D2B4E" stroke-width="3.5" />
              <rect x="434" y="218" width="7" height="13" rx="3" fill="#FF6F3C" />
              <path d="M437 231 q2 10 12 10" fill="none" stroke="#0D2B4E" stroke-width="2" />
              <!-- tangan -->
              <path d="M436 272 q-14 14 -18 26" fill="none" stroke="#4FC3F7" stroke-width="10" stroke-linecap="round" />
              <!-- meja -->
              <rect x="372" y="298" width="168" height="10" rx="5" fill="#0D2B4E" />
              <rect x="388" y="308" width="7" height="58" fill="#0D2B4E" />
              <rect x="516" y="308" width="7" height="58" fill="#0D2B4E" />
              <!-- laptop -->
              <path d="M386 254 h62 a4 4 0 0 1 4 4 v40 h-70 v-40 a4 4 0 0 1 4 -4z" fill="#CFD8E3" />
              <circle cx="417" cy="276" r="7" fill="#FFFFFF" />
              <path d="M413 276 h8 M417 272 v8" stroke="#1E88E5" stroke-width="2" stroke-linecap="round" />
              <rect x="372" y="294" width="90" height="6" rx="3" fill="#90A4AE" />
              <!-- cangkir kopi -->
              <rect x="500" y="278" width="18" height="20" rx="4" fill="#FF6F3C" />
              <path d="M518 283 a5 5 0 0 1 0 10" fill="none" stroke="#FF6F3C" stroke-width="3" />
              <path d="M505 272 q3 -5 0 -10 M512 272 q3 -5 0 -10" fill="none" stroke="#8A94A6" stroke-width="2" stroke-linecap="round" opacity=".6" />
              <!-- bubble chat video call -->
              <g class="float" style="animation-delay:-3s">
                <rect x="372" y="186" width="54" height="36" rx="10" fill="#FFFFFF" />
                <path d="M392 222 l-6 10 14 -10z" fill="#FFFFFF" />
                <rect x="380" y="195" width="24" height="17" rx="4" fill="#1E88E5" />
                <path d="M404 200 l10 -5 v17 l-10 -5z" fill="#1E88E5" />
              </g>
            </g>

            <!-- Gamer -->
            <g>
              <ellipse cx="466" cy="468" rx="62" ry="10" fill="#0D2B4E" opacity=".08" />
              <!-- bean bag -->
              <path d="M410 470 c-10 -40 20 -62 56 -62 c40 0 66 22 56 62z" fill="#FF6F3C" />
              <path d="M424 470 c0 -24 14 -36 42 -36" fill="none" stroke="#F4511E" stroke-width="4" stroke-linecap="round" opacity=".6" />
              <!-- orang -->
              <path d="M446 452 v-28 a20 20 0 0 1 40 0 v28z" fill="#0D2B4E" />
              <circle cx="466" cy="386" r="16" fill="#D9A07A" />
              <path d="M450 384 c0 -14 10 -18 18 -18 c10 0 16 8 14 18 c-6 -6 -12 -8 -32 0z" fill="#1B1B2F" />
              <!-- topi -->
              <path d="M450 380 c2 -12 12 -16 20 -15 c8 1 14 6 14 14z" fill="#1E88E5" />
              <rect x="478" y="376" width="14" height="5" rx="2.5" fill="#1E88E5" />
              <!-- stik game -->
              <path d="M442 432 h48 a8 8 0 0 1 8 8 v2 a8 8 0 0 1 -8 8 h-48 a8 8 0 0 1 -8 -8 v-2 a8 8 0 0 1 8 -8z" fill="#FFFFFF" />
              <path d="M450 441 h8 M454 437 v8" stroke="#0D2B4E" stroke-width="2.4" stroke-linecap="round" />
              <circle cx="478" cy="438" r="2.6" fill="#FF6F3C" /><circle cx="484" cy="444" r="2.6" fill="#1E88E5" />
              <!-- GG bubble -->
              <g class="float" style="animation-delay:-1.5s">
                <rect x="498" y="350" width="44" height="28" rx="9" fill="#0D2B4E" />
                <text x="508" y="370" font-family="Poppins, sans-serif" font-weight="800" font-size="14" fill="#4FC3F7">GG</text>
              </g>
            </g>

            <!-- Speedometer -->
            <g transform="translate(436 70)" class="float" style="animation-delay:-4s">
              <circle cx="44" cy="50" r="48" fill="#FFFFFF" />
              <path d="M12 66 A34 34 0 1 1 76 66" fill="none" stroke="#E3F2FD" stroke-width="9" stroke-linecap="round" />
              <path d="M12 66 A34 34 0 1 1 76 66" fill="none" stroke="url(#gSpeed)" stroke-width="9" stroke-linecap="round" stroke-dasharray="150 200" />
              <g class="needle">
                <path d="M44 50 L44 22" stroke="#0D2B4E" stroke-width="4" stroke-linecap="round" />
              </g>
              <circle cx="44" cy="50" r="6" fill="#FF6F3C" />
              <text x="44" y="84" text-anchor="middle" font-family="Poppins, sans-serif" font-size="11" font-weight="700" fill="#0D2B4E">Mbps</text>
            </g>

            <!-- notifikasi kecil -->
            <g class="float" style="animation-delay:-2s">
              <circle cx="232" cy="200" r="16" fill="#FFFFFF" />
              <path d="M226 200 l4 4 8 -8" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </g>

            <defs>
              <linearGradient id="gSpeed" x1="0" x2="1">
                <stop offset="0" stop-color="#4FC3F7" />
                <stop offset="1" stop-color="#FF6F3C" />
              </linearGradient>
            </defs>
          </svg>

          <!-- chip statistik melayang -->
          <div class="chip c1">
            <span class="chip-ic" style="background:#E8F8EF">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v12m0 0l-5-5m5 5l5-5M5 20h14" fill="none" stroke="#25D366" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </span>
            <div><b>{{ $t('hero.chip1Title') }}</b><span>{{ $t('hero.chip1Sub') }}</span></div>
          </div>
          <div class="chip c2">
            <span class="chip-ic" style="background:#FFE9E0">
              <svg viewBox="0 0 24 24" style="color:#FF6F3C" aria-hidden="true"><use href="#i-wifi" /></svg>
            </span>
            <div><b>{{ $t('hero.chip2Title') }}</b><span>{{ $t('hero.chip2Sub') }}</span></div>
          </div>
        </div>
      </div>

      <svg class="hero-wave" viewBox="0 0 1440 90" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 50 C240 90 480 10 720 40 S1200 90 1440 30 V90 H0z" fill="#FFFFFF" />
      </svg>
    </section>

    <!-- =========================================================
         2. KEUNGGULAN
         ========================================================= -->
    <section class="section" id="keunggulan">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3 6.5 7 .8-5.2 4.8 1.5 7L12 17.6 5.7 21l1.5-7L2 9.3l7-.8z" fill="currentColor" /></svg><span>{{ $t('features.eyebrow') }}</span></span>
          <h2>{{ $t('features.title') }}</h2>
          <p>{{ $t('features.sub') }}</p>
        </div>

        <div class="features-grid">
          <!-- Kecepatan Simetris -->
          <article class="feature-card reveal">
            <svg class="feature-icon" viewBox="0 0 72 72" aria-hidden="true">
              <rect width="72" height="72" rx="20" fill="#E3F2FD" />
              <path d="M24 46V22m0 0l-8 8m8-8l8 8" fill="none" stroke="#1E88E5" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M48 26v24m0 0l-8-8m8 8l8-8" fill="none" stroke="#FF6F3C" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h3>{{ $t('features.f1Title') }}</h3>
            <p>{{ $t('features.f1Desc') }}</p>
          </article>
          <!-- Tanpa FUP -->
          <article class="feature-card reveal d1">
            <svg class="feature-icon" viewBox="0 0 72 72" aria-hidden="true">
              <rect width="72" height="72" rx="20" fill="#FFE9E0" />
              <path d="M26 28c-5 0-8.5 3.6-8.5 8s3.5 8 8.5 8c7.5 0 12.5-16 20-16 5 0 8.5 3.6 8.5 8s-3.5 8-8.5 8c-7.5 0-12.5-16-20-16z" fill="none" stroke="#FF6F3C" stroke-width="5" stroke-linecap="round" />
            </svg>
            <h3>{{ $t('features.f2Title') }}</h3>
            <p>{{ $t('features.f2Desc') }}</p>
          </article>
          <!-- Pemasangan Gratis -->
          <article class="feature-card reveal d2">
            <svg class="feature-icon" viewBox="0 0 72 72" aria-hidden="true">
              <rect width="72" height="72" rx="20" fill="#E3F2FD" />
              <path d="M18 36l18-15 18 15v15a3 3 0 0 1-3 3H21a3 3 0 0 1-3-3z" fill="#1E88E5" />
              <rect x="31" y="40" width="10" height="14" rx="2" fill="#FFFFFF" />
              <circle cx="51" cy="24" r="9" fill="#FF6F3C" />
              <path d="M47 24l3 3 5-5" fill="none" stroke="#FFFFFF" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h3>{{ $t('features.f3Title') }}</h3>
            <p>{{ $t('features.f3Desc') }}</p>
          </article>
          <!-- Layanan 24 Jam -->
          <article class="feature-card reveal d3">
            <svg class="feature-icon" viewBox="0 0 72 72" aria-hidden="true">
              <rect width="72" height="72" rx="20" fill="#FFE9E0" />
              <path d="M20 40v-4a16 16 0 0 1 32 0v4" fill="none" stroke="#0D2B4E" stroke-width="4" stroke-linecap="round" />
              <rect x="16" y="38" width="9" height="14" rx="4" fill="#FF6F3C" />
              <rect x="47" y="38" width="9" height="14" rx="4" fill="#FF6F3C" />
              <path d="M51 52c0 5-5 7-11 7" fill="none" stroke="#0D2B4E" stroke-width="3" stroke-linecap="round" />
              <circle cx="38" cy="59" r="3" fill="#0D2B4E" />
            </svg>
            <h3>{{ $t('features.f4Title') }}</h3>
            <p>{{ $t('features.f4Desc') }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- =========================================================
         3. PAKET INTERNET
         ========================================================= -->
    <section class="section packages" id="paket">
      <svg class="deco-blob" viewBox="0 0 200 200" aria-hidden="true"><path fill="#E3F2FD" d="M44.7-61.6C57.3-52.4 66.2-38.2 70.9-22.6 75.5-7 75.9 10 69.6 24.1 63.3 38.2 50.3 49.4 35.6 57.7 20.9 66 4.4 71.4-12.7 70.2-29.8 69-47.5 61.2-58.8 47.8-70.1 34.4-75 15.4-73.1-2.6-71.2-20.6-62.4-37.6-49.5-46.9-36.6-56.2-19.6-57.8-2.3-54.7 15-51.6 32.1-70.8 44.7-61.6Z" transform="translate(100 100)"/></svg>
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><svg aria-hidden="true"><use href="#i-wifi" /></svg><span>{{ $t('paket.eyebrow') }}</span></span>
          <h2>{{ $t('paket.title') }}</h2>
          <p>{{ $t('paket.sub') }}</p>
        </div>

        <div class="toggle-wrap reveal">
          <div class="toggle" id="planToggle" data-mode="rumah" role="tablist" aria-label="Jenis paket">
            <span class="toggle-slider"></span>
            <button class="active" data-mode="rumah" role="tab" aria-selected="true">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 11l9-7 9 7v9a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z" fill="currentColor" /></svg><span>{{ $t('paket.toggleRumah') }}</span>
            </button>
            <button data-mode="bisnis" role="tab" aria-selected="false">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 21V5a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v16M15 10h4a1 1 0 0 1 1 1v10M2 21h20M8 8h3M8 12h3M8 16h3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg><span>{{ $t('paket.toggleBisnis') }}</span>
            </button>
          </div>
        </div>

        <!-- Kedua set kartu dirender server; tombol Rumah/Bisnis hanya menukar mana yang tampil -->
        @foreach (['rumah' => $rumah, 'bisnis' => $bisnis] as $mode => $cards)
          <div class="pricing-grid" data-plans="{{ $mode }}" @if ($mode !== 'rumah') hidden @endif>
            @foreach ($cards as $card)
              @include('sites.partials.web2-card', ['card' => $card, 'index' => $loop->index])
            @endforeach
          </div>
        @endforeach
        <div class="swipe-hint" aria-hidden="true">
          <svg viewBox="0 0 24 24"><path d="M8 7l-5 5 5 5M16 7l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
          <span>{{ $t('paket.swipeHint') }}</span>
        </div>
      </div>
    </section>

    <!-- =========================================================
         4. CEK JANGKAUAN
         ========================================================= -->
    <section class="section coverage" id="jangkauan">
      <svg class="wave top" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 0 H1440 V30 C1200 80 960 0 720 30 S240 80 0 30z" fill="#F7FBFF" />
      </svg>
      <svg class="dots" viewBox="0 0 140 140" aria-hidden="true">
        <defs><pattern id="dotp" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="3" fill="#FFFFFF" /></pattern></defs>
        <rect width="140" height="140" fill="url(#dotp)" />
      </svg>

      <div class="container coverage-grid">
        <!-- Ilustrasi peta -->
        <div class="reveal">
          <svg class="map-svg" viewBox="0 0 480 400" role="img" aria-label="Ilustrasi peta area jangkauan M3 dengan pin lokasi">
            <rect x="10" y="20" width="460" height="360" rx="26" fill="#E3F2FD" />
            <!-- blok bangunan -->
            <g fill="#FFFFFF">
              <rect x="34" y="44" width="120" height="78" rx="10" />
              <rect x="186" y="44" width="96" height="78" rx="10" />
              <rect x="314" y="44" width="132" height="78" rx="10" />
              <rect x="34" y="154" width="84" height="94" rx="10" />
              <rect x="34" y="280" width="120" height="76" rx="10" />
              <rect x="186" y="280" width="96" height="76" rx="10" />
              <rect x="352" y="154" width="94" height="94" rx="10" />
              <rect x="314" y="280" width="132" height="76" rx="10" />
            </g>
            <!-- taman & danau -->
            <rect x="150" y="154" width="170" height="94" rx="14" fill="#C8E6C9" />
            <circle cx="180" cy="186" r="12" fill="#81C784" /><circle cx="200" cy="222" r="10" fill="#81C784" /><circle cx="292" cy="176" r="11" fill="#81C784" />
            <ellipse cx="400" cy="318" rx="34" ry="18" fill="#90CAF9" />
            <!-- jalan -->
            <g stroke="#FFFFFF" stroke-width="2" stroke-dasharray="8 8" fill="none" opacity=".9">
              <path d="M10 138 H470" /><path d="M10 264 H470" /><path d="M170 20 V380" /><path d="M298 20 V380" />
            </g>
            <!-- kabel fiber di peta -->
            <path d="M40 138 H170 V264 H298 V138 H460" fill="none" stroke="#FF6F3C" stroke-width="3" opacity=".55" />
            <!-- area jangkauan -->
            <circle cx="234" cy="200" r="118" fill="#1E88E5" opacity=".1" />
            <circle cx="234" cy="200" r="118" fill="none" stroke="#1E88E5" stroke-width="2" stroke-dasharray="6 6" opacity=".5" />
            <circle class="map-pulse" cx="234" cy="200" r="60" fill="none" stroke="#FF6F3C" stroke-width="3" />
            <circle class="map-pulse p2" cx="234" cy="200" r="60" fill="none" stroke="#FF6F3C" stroke-width="3" />
            <circle cx="234" cy="200" r="64" fill="#4FC3F7" opacity=".18" />
            <!-- pin kecil -->
            <g fill="#1E88E5"><circle cx="96" cy="84" r="6" /><circle cx="380" cy="86" r="6" /><circle cx="94" cy="320" r="6" /><circle cx="396" cy="200" r="6" /></g>
            <!-- pin utama oranye -->
            <ellipse cx="234" cy="206" rx="16" ry="5" fill="#0D2B4E" opacity=".2" />
            <g class="map-pin">
              <path d="M234 204 c-4 -10 -30 -30 -30 -52 a30 30 0 0 1 60 0 c0 22 -26 42 -30 52z" fill="#FF6F3C" />
              <circle cx="234" cy="151" r="16" fill="#FFFFFF" />
              <g transform="translate(222 139)" style="color:#FF6F3C"><use href="#i-wifi" width="24" height="24" /></g>
            </g>
            <!-- kartu info -->
            <g transform="translate(300 300)">
              <rect width="150" height="56" rx="12" fill="#FFFFFF" />
              <circle cx="26" cy="28" r="14" fill="#E8F8EF" />
              <path d="M20 28 l4 4 8 -8" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
              <text x="48" y="25" font-family="Poppins, sans-serif" font-weight="700" font-size="13" fill="#0D2B4E">Cek Lokasimu</text>
              <text x="48" y="41" font-family="Poppins, sans-serif" font-size="11" fill="#8A94A6">gratis &amp; cepat</text>
            </g>
          </svg>
        </div>

        <!-- Form cek jangkauan -->
        <div class="coverage-copy reveal d1">
          <span class="eyebrow"><svg aria-hidden="true"><use href="#i-pin" /></svg><span>{{ $t('coverage.eyebrow') }}</span></span>
          <h2>{{ $t('coverage.title') }}</h2>
          <p>{{ $t('coverage.sub') }}</p>

          <form class="coverage-form" id="coverageForm" novalidate>
            <h3>{{ $t('coverage.formTitle') }}</h3>
            <p>{{ $t('coverage.formSub') }}</p>
            <div class="field">
              <label for="kota">Kota / Kabupaten</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 21V9l5-3v15M9 21V4l7 4v13M16 21v-9l4 2v7M2 21h20" fill="none" stroke="#8A94A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                <select id="kota" name="kota" required>
                  <option value="">Pilih kota / kabupaten</option>
                  <option>Jakarta</option>
                  <option>Bandung</option>
                  <option>Surabaya</option>
                  <option>Yogyakarta</option>
                  <option>Semarang</option>
                  <option>Medan</option>
                  <option>Makassar</option>
                  <option>Denpasar</option>
                  <option>Lainnya</option>
                </select>
              </div>
            </div>
            <div class="field">
              <label for="kecamatan">Kecamatan</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" aria-hidden="true" style="color:#8A94A6"><use href="#i-pin" /></svg>
                <input id="kecamatan" name="kecamatan" type="text" placeholder="Contoh: Coblong" required />
              </div>
            </div>
            <div class="field">
              <label for="alamat">Alamat</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 11l9-7 9 7v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z" fill="none" stroke="#8A94A6" stroke-width="2" stroke-linejoin="round" /></svg>
                <input id="alamat" name="alamat" type="text" placeholder="Nama jalan, nomor rumah, RT/RW" required />
              </div>
            </div>
            <button type="submit" class="btn btn-orange btn-block" id="coverageBtn">
              <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2.4" /><path d="M20 20l-4-4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" /></svg>
              <span>{{ $t('coverage.btn') }}</span>
            </button>
            <div class="coverage-result" id="coverageResult" role="status" aria-live="polite"></div>
          </form>
        </div>
      </div>

      <svg class="wave bottom" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 50 C240 0 480 80 720 50 S1200 0 1440 50 V80 H0z" fill="#FFFFFF" />
      </svg>
    </section>

    <!-- =========================================================
         5. CARA BERLANGGANAN
         ========================================================= -->
    <section class="section" id="cara">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12h16M14 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" /></svg><span>{{ $t('steps.eyebrow') }}</span></span>
          <h2>{{ $t('steps.title') }}</h2>
          <p>{{ $t('steps.sub') }}</p>
        </div>

        <div class="steps-grid">
          <div class="steps-line" aria-hidden="true"></div>

          <div class="step reveal">
            <div class="step-circle">
              <span class="step-num">1</span>
              <svg viewBox="0 0 48 48" aria-hidden="true">
                <rect x="8" y="6" width="32" height="36" rx="6" fill="#E3F2FD" />
                <path d="M15 17h18M15 25h18M15 33h10" stroke="#1E88E5" stroke-width="3" stroke-linecap="round" />
                <circle cx="36" cy="36" r="8" fill="#FF6F3C" />
                <path d="M32.5 36l2.5 2.5 4.5-4.5" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <h3>{{ $t('steps.s1Title') }}</h3>
            <p>{{ $t('steps.s1Desc') }}</p>
          </div>

          <div class="step reveal d1">
            <div class="step-circle">
              <span class="step-num">2</span>
              <svg viewBox="0 0 48 48" aria-hidden="true">
                <circle cx="24" cy="17" r="8" fill="#1E88E5" />
                <path d="M9 41c1-9 7.5-14 15-14s14 5 15 14z" fill="#E3F2FD" stroke="#1E88E5" stroke-width="3" stroke-linejoin="round" />
                <path d="M33 30l7-7 3 3-7 7h-3z" fill="#FF6F3C" />
              </svg>
            </div>
            <h3>{{ $t('steps.s2Title') }}</h3>
            <p>{{ $t('steps.s2Desc') }}</p>
          </div>

          <div class="step reveal d2">
            <div class="step-circle">
              <span class="step-num">3</span>
              <svg viewBox="0 0 48 48" aria-hidden="true">
                <rect x="6" y="10" width="36" height="32" rx="6" fill="#E3F2FD" stroke="#1E88E5" stroke-width="3" />
                <path d="M6 19h36" stroke="#1E88E5" stroke-width="3" />
                <path d="M15 6v8M33 6v8" stroke="#0D2B4E" stroke-width="3" stroke-linecap="round" />
                <rect x="14" y="25" width="7" height="6" rx="1.5" fill="#FF6F3C" />
                <rect x="27" y="25" width="7" height="6" rx="1.5" fill="#4FC3F7" />
              </svg>
            </div>
            <h3>{{ $t('steps.s3Title') }}</h3>
            <p>{{ $t('steps.s3Desc') }}</p>
          </div>

          <div class="step reveal d3">
            <div class="step-circle">
              <span class="step-num">4</span>
              <svg viewBox="0 0 48 48" aria-hidden="true">
                <g fill="none" stroke="#FF6F3C" stroke-width="3.6" stroke-linecap="round">
                  <path d="M6 18a26 26 0 0 1 36 0" />
                  <path d="M12.5 25a17 17 0 0 1 23 0" />
                  <path d="M19 32a8 8 0 0 1 10 0" />
                </g>
                <circle cx="24" cy="38" r="3.4" fill="#1E88E5" />
              </svg>
            </div>
            <h3>{{ $t('steps.s4Title') }}</h3>
            <p>{{ $t('steps.s4Desc') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         6. FAQ
         ========================================================= -->
    <section class="section faq" id="bantuan">
      <div class="container faq-grid">
        <div class="faq-side reveal">
          <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2.2" /><path d="M9.5 9.5a2.5 2.5 0 1 1 3.5 2.3c-.6.3-1 .8-1 1.5v.7" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" /><circle cx="12" cy="17" r="1.2" fill="currentColor" /></svg><span>{{ $t('faq.eyebrow') }}</span></span>
          <h2>{{ $t('faq.title') }}</h2>
          <p>{{ $t('faq.sub') }}</p>

          <!-- ilustrasi customer service -->
          <svg class="faq-illus" viewBox="0 0 320 220" aria-hidden="true">
            <ellipse cx="160" cy="200" rx="130" ry="14" fill="#E3F2FD" />
            <!-- bubble tanya -->
            <g class="float">
              <rect x="20" y="22" width="92" height="56" rx="16" fill="#FFFFFF" />
              <path d="M54 78l-8 14 20-14z" fill="#FFFFFF" />
              <text x="66" y="62" text-anchor="middle" font-family="Poppins, sans-serif" font-size="34" font-weight="800" fill="#FF6F3C">?</text>
            </g>
            <g class="float" style="animation-delay:-3s">
              <rect x="222" y="40" width="80" height="44" rx="14" fill="#1E88E5" />
              <circle cx="246" cy="62" r="4" fill="#fff" /><circle cx="262" cy="62" r="4" fill="#fff" /><circle cx="278" cy="62" r="4" fill="#fff" />
            </g>
            <!-- CS person -->
            <path d="M118 196v-46a42 42 0 0 1 84 0v46z" fill="#0D2B4E" />
            <path d="M146 112h28v14a14 14 0 0 1-28 0z" fill="#F6C9A8" />
            <circle cx="160" cy="92" r="26" fill="#F6C9A8" />
            <path d="M132 94c-4-26 14-38 30-36 18 2 28 16 24 36-4-10-12-16-22-17-12 0-22 6-32 17z" fill="#3E2723" />
            <path d="M134 92a26 26 0 0 1 52 0" fill="none" stroke="#FF6F3C" stroke-width="5" />
            <rect x="128" y="86" width="10" height="18" rx="4" fill="#FF6F3C" />
            <rect x="182" y="86" width="10" height="18" rx="4" fill="#FF6F3C" />
            <path d="M133 104q2 14 18 14" fill="none" stroke="#0D2B4E" stroke-width="2.5" />
            <circle cx="152" cy="96" r="2.3" fill="#0D2B4E" /><circle cx="170" cy="96" r="2.3" fill="#0D2B4E" />
            <path d="M154 106q6 5 12 0" fill="none" stroke="#B5654A" stroke-width="2.4" stroke-linecap="round" />
            <path d="M150 130l10 14 10-14" fill="none" stroke="#4FC3F7" stroke-width="4" stroke-linejoin="round" />
            <!-- laptop -->
            <path d="M96 168h128l-10 28H106z" fill="#CFD8E3" />
            <rect x="86" y="194" width="148" height="8" rx="4" fill="#90A4AE" />
          </svg>

          <div class="faq-help">
            <span class="ic"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" fill="#FF6F3C" /></svg></span>
            <div>
              <b>{{ $t('faq.helpTitle') }}</b>
              <a href="{{ $wa() }}" target="_blank" rel="noopener">{{ $t('contact.waDisplay') }}</a>
            </div>
          </div>
        </div>

        <div class="accordion reveal d1" id="accordion">
          @foreach ($faqs as $faq)
            <div @class(['acc-item', 'open' => $loop->first])>
              <button class="acc-btn" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                {{ $faq->question }}
                <span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span>
              </button>
              <div class="acc-panel"><p>{{ $faq->answer }}</p></div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- =========================================================
         7. CTA PENUTUP
         ========================================================= -->
    <section class="cta">
      <div class="container">
        <div class="cta-banner reveal">
          <div>
            <h2>{{ $t('cta.title') }}</h2>
            <p>{{ $t('cta.sub') }}</p>
            <div class="cta-actions">
              <a href="#paket" class="btn btn-white">
                <span>{{ $t('cta.btnDaftar') }}</span>
                <svg aria-hidden="true"><use href="#i-arrow" /></svg>
              </a>
              <a href="{{ $wa('contact.waCtaMessage') }}" class="btn btn-wa" target="_blank" rel="noopener">
                <svg aria-hidden="true"><use href="#i-wa" /></svg>
                <span>{{ $t('cta.btnWa') }}</span>
              </a>
            </div>
          </div>
          <div class="cta-art">
            <!-- ilustrasi roket + sinyal -->
            <svg viewBox="0 0 300 240" aria-hidden="true">
              <circle cx="150" cy="120" r="100" fill="#FFFFFF" opacity=".14" />
              <circle cx="150" cy="120" r="70" fill="#FFFFFF" opacity=".14" />
              <g class="float">
                <path d="M150 30c26 18 38 50 34 92l-16 18h-36l-16-18c-4-42 8-74 34-92z" fill="#FFFFFF" />
                <circle cx="150" cy="84" r="16" fill="#1E88E5" />
                <circle cx="150" cy="84" r="9" fill="#4FC3F7" />
                <path d="M116 112l-22 26 6 14 26-12zM184 112l22 26-6 14-26-12z" fill="#0D2B4E" />
                <path d="M136 140h28l-4 18c-4 16-16 16-20 0z" fill="#FFC107" />
                <path d="M142 150h16l-3 14c-3 10-7 10-10 0z" fill="#FF6F3C" />
              </g>
              <g fill="none" stroke="#FFFFFF" stroke-width="6" stroke-linecap="round">
                <path class="wifi-arc" d="M52 70a60 60 0 0 1 0-60" transform="translate(0 60)" />
                <path class="wifi-arc a2" d="M34 80a86 86 0 0 1 0-80" transform="translate(0 50)" />
                <path class="wifi-arc" d="M248 70a60 60 0 0 0 0-60" transform="translate(0 60)" />
                <path class="wifi-arc a2" d="M266 80a86 86 0 0 0 0-80" transform="translate(0 50)" />
              </g>
              <g fill="#FFFFFF">
                <circle cx="70" cy="40" r="3" /><circle cx="236" cy="30" r="4" /><circle cx="252" cy="200" r="3" /><circle cx="56" cy="196" r="4" />
              </g>
            </svg>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- =========================================================
       FOOTER
       ========================================================= -->
  <footer class="footer" id="kontak">
    <div class="container footer-grid">
      <div>
        <a href="#beranda" class="logo">
          <span class="logo-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <rect x="3" y="15" width="3.4" height="5" rx="1.2" fill="#4FC3F7" />
              <rect x="8.4" y="11" width="3.4" height="9" rx="1.2" fill="#4FC3F7" />
              <rect x="13.8" y="7" width="3.4" height="13" rx="1.2" fill="#FFFFFF" />
              <rect x="19.2" y="3" width="3.4" height="17" rx="1.2" fill="#FF6F3C" />
            </svg>
          </span>
          <span><span class="m">M</span><span class="three">3</span></span>
        </a>
        <p>{{ $t('footer.about') }}</p>
        <div class="socials">
          <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="#fff" stroke-width="2" /><circle cx="12" cy="12" r="4" fill="none" stroke="#fff" stroke-width="2" /><circle cx="17.3" cy="6.7" r="1.2" fill="#fff" /></svg></a>
          <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v8h4v-8h3l1-4h-4V8.5a.5.5 0 0 1 .5-.5z" fill="#fff" /></svg></a>
          <a href="#" aria-label="X / Twitter"><svg viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20" stroke="#fff" stroke-width="2.4" stroke-linecap="round" /></svg></a>
          <a href="#" aria-label="TikTok"><svg viewBox="0 0 24 24"><path d="M14 3v11.5a3.5 3.5 0 1 1-3-3.46V7.5A7 7 0 1 0 18 14V8.5a6 6 0 0 0 3 1V6a4 4 0 0 1-4-3z" fill="#fff" /></svg></a>
          <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="4" fill="#fff" /><path d="M10 9l5 3-5 3z" fill="#0A2240" /></svg></a>
        </div>
      </div>

      <div>
        <h4>{{ $t('footer.col1Title') }}</h4>
        <ul>
          <li><a href="#paket">{{ $t('footer.col1L1') }}</a></li>
          <li><a href="#paket">{{ $t('footer.col1L2') }}</a></li>
          <li><a href="#paket">{{ $t('footer.col1L3') }}</a></li>
          <li><a href="#jangkauan">{{ $t('footer.col1L4') }}</a></li>
        </ul>
      </div>

      <div>
        <h4>{{ $t('footer.col2Title') }}</h4>
        <ul>
          <li><a href="#bantuan">{{ $t('footer.col2L1') }}</a></li>
          <li><a href="#cara">{{ $t('footer.col2L2') }}</a></li>
          <li><a href="#bantuan">{{ $t('footer.col2L3') }}</a></li>
          <li><a href="#">{{ $t('footer.col2L4') }}</a></li>
        </ul>
      </div>

      <div>
        <h4>{{ $t('footer.col3Title') }}</h4>
        <ul class="contact-list">
          <li><svg viewBox="0 0 24 24" style="color:#25D366" aria-hidden="true"><use href="#i-wa" /></svg><a href="{{ $wa() }}" target="_blank" rel="noopener"><span>{{ $t('contact.waDisplay') }}</span> (WhatsApp)</a></li>
        </ul>
      </div>
    </div>
    <div class="container footer-bottom">
      <span>{{ $t('footer.copy') }}</span>
      <span><span>{{ $t('footer.taglineBefore') }}</span> <span style="color:#FF6F3C">♥</span> <span>{{ $t('footer.taglineAfter') }}</span></span>
    </div>
  </footer>

  <!-- Tombol WhatsApp melayang -->
  <a class="fab-wa" href="{{ $wa('contact.waFabMessage') }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
    <svg style="color:#fff" aria-hidden="true"><use href="#i-wa" /></svg>
  </a>

  <script src="{{ asset('web2/js/script.js') }}"></script>
</body>
</html>
