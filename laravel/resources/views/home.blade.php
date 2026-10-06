<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="KoneksiKu - bandingkan paket, harga, dan jangkauan berbagai provider internet di satu tempat." />
  <meta name="theme-color" content="#1E88E5" />
  <title>KoneksiKu | Bandingkan Provider Internet Terbaik</title>
  <!-- Favicon: pin peta + sinyal -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%231E88E5'/%3E%3Cpath d='M16 27s8-7 8-13a8 8 0 0 0-16 0c0 6 8 13 8 13z' fill='%23fff'/%3E%3Ccircle cx='16' cy='14' r='3.2' fill='%23FF6F3C'/%3E%3C/svg%3E" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  @verbatim
  <style>
    /* =========================================================
       DESIGN TOKENS (sama dengan halaman M3)
       ========================================================= */
    :root {
      --blue: #1E88E5;
      --blue-dark: #1565C0;
      --blue-light: #4FC3F7;
      --blue-bg: #E3F2FD;
      --navy: #0D2B4E;
      --navy-2: #0A2240;
      --orange: #FF6F3C;
      --orange-dark: #F4511E;
      --gray: #8A94A6;
      --line: #E4ECF5;
      --white: #FFFFFF;
      --green: #25D366;

      --radius: 14px;
      --radius-lg: 18px;
      --shadow-sm: 0 4px 14px rgba(13, 43, 78, 0.06);
      --shadow: 0 12px 32px rgba(13, 43, 78, 0.10);
      --shadow-lg: 0 24px 56px rgba(13, 43, 78, 0.18);
      --container: min(1220px, calc(100% - 40px));
      --nav-h: 76px;
    }

    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; scroll-padding-top: calc(var(--nav-h) + 8px); }
    body {
      margin: 0;
      font-family: 'Poppins', system-ui, sans-serif;
      color: var(--navy);
      background: var(--white);
      line-height: 1.65;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }
    body.lock { overflow: hidden; }
    a { color: inherit; text-decoration: none; }
    img, svg { display: block; max-width: 100%; }
    button, input, select { font: inherit; color: inherit; }
    h1, h2, h3, h4 { margin: 0; line-height: 1.2; }
    p { margin: 0; color: var(--gray); }

    .container { width: var(--container); margin: 0 auto; }
    .section { padding: 96px 0; position: relative; }
    .section-head { text-align: center; max-width: 660px; margin: 0 auto 48px; }
    .section-head h2 { font-size: clamp(1.8rem, 3.4vw, 2.5rem); font-weight: 700; }
    .section-head p { margin-top: 12px; }
    .eyebrow {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 6px 14px; border-radius: 999px;
      background: var(--blue-bg); color: var(--blue);
      font-size: .8rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
      margin-bottom: 14px;
    }
    .eyebrow svg { width: 16px; height: 16px; }

    /* =========================================================
       BUTTONS
       ========================================================= */
    .btn {
      display: inline-flex; align-items: center; justify-content: center; gap: 8px;
      padding: 12px 24px;
      border: 2px solid transparent; border-radius: 12px;
      font-weight: 600; font-size: .93rem;
      cursor: pointer; white-space: nowrap;
      transition: transform .2s, box-shadow .2s, background .2s, color .2s, border-color .2s;
    }
    .btn svg { width: 18px; height: 18px; flex-shrink: 0; }
    .btn:hover { transform: translateY(-2px); }
    .btn:focus-visible, .icon-btn:focus-visible { outline: 3px solid var(--blue-light); outline-offset: 3px; }
    .btn-orange { background: var(--orange); color: #fff; box-shadow: 0 10px 22px rgba(255,111,60,.32); }
    .btn-orange:hover { background: var(--orange-dark); }
    .btn-blue { background: var(--blue); color: #fff; box-shadow: 0 10px 22px rgba(30,136,229,.3); }
    .btn-blue:hover { background: var(--blue-dark); }
    .btn-navy { background: var(--navy); color: #fff; }
    .btn-outline { border-color: var(--navy); color: var(--navy); background: transparent; }
    .btn-outline:hover { background: var(--navy); color: #fff; }
    .btn-ghost { border-color: var(--line); background: #fff; color: var(--navy); }
    .btn-ghost:hover { border-color: var(--blue); color: var(--blue); }
    .btn-white { background: #fff; color: var(--navy); }
    .btn-sm { padding: 9px 16px; font-size: .86rem; border-radius: 10px; }
    .btn-block { width: 100%; }
    .icon-btn {
      width: 42px; height: 42px; border-radius: 12px;
      border: 2px solid var(--line); background: #fff;
      display: grid; place-items: center; cursor: pointer;
      transition: border-color .2s, background .2s, color .2s;
      color: var(--gray);
    }
    .icon-btn svg { width: 20px; height: 20px; }
    .icon-btn:hover { border-color: var(--blue); color: var(--blue); }
    .icon-btn.active { background: var(--navy); border-color: var(--navy); color: #fff; }

    /* =========================================================
       NAVBAR
       ========================================================= */
    .navbar {
      position: fixed; inset: 0 0 auto 0; z-index: 100;
      height: var(--nav-h);
      display: flex; align-items: center;
      transition: background .3s, box-shadow .3s;
    }
    .navbar.scrolled, .navbar.menu-open {
      background: rgba(255,255,255,.97);
      backdrop-filter: blur(12px);
      box-shadow: 0 6px 24px rgba(13,43,78,.08);
    }
    .nav-inner { display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .logo { display: inline-flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.4rem; letter-spacing: -.02em; }
    .logo-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--blue); display: grid; place-items: center; box-shadow: 0 6px 14px rgba(30,136,229,.35); }
    .logo-icon svg { width: 26px; height: 26px; }
    .logo .ku { color: var(--orange); }
    .nav-menu { display: flex; align-items: center; gap: 4px; }
    .nav-link { padding: 8px 14px; border-radius: 999px; font-size: .9rem; font-weight: 500; transition: background .2s, color .2s; }
    .nav-link:hover { background: var(--blue-bg); }
    .nav-link.active { background: var(--navy); color: #fff; }
    .nav-actions { display: flex; gap: 10px; margin-left: 12px; }
    .nav-actions .btn { padding: 9px 20px; }
    .hamburger { display: none; width: 44px; height: 44px; border: 0; border-radius: 12px; background: var(--blue-bg); cursor: pointer; position: relative; }
    .hamburger span { position: absolute; left: 12px; right: 12px; height: 2.5px; background: var(--navy); border-radius: 2px; transition: transform .3s, opacity .3s, top .3s; }
    .hamburger span:nth-child(1) { top: 14px; }
    .hamburger span:nth-child(2) { top: 21px; }
    .hamburger span:nth-child(3) { top: 28px; }
    .hamburger.open span:nth-child(1) { top: 21px; transform: rotate(45deg); }
    .hamburger.open span:nth-child(2) { opacity: 0; }
    .hamburger.open span:nth-child(3) { top: 21px; transform: rotate(-45deg); }

    /* =========================================================
       1. HERO
       ========================================================= */
    .hero {
      position: relative;
      padding: calc(var(--nav-h) + 50px) 0 110px;
      background: linear-gradient(180deg, var(--blue-bg) 0%, #F4FAFF 75%, #fff 100%);
      overflow: hidden;
    }
    .blob { position: absolute; pointer-events: none; }
    .hero .blob.b1 { width: 520px; top: -170px; left: -190px; opacity: .55; }
    .hero .blob.b2 { width: 360px; bottom: -110px; right: -110px; opacity: .3; }
    .hero-wave { position: absolute; left: 0; bottom: -1px; width: 100%; height: 90px; }
    .hero-grid { position: relative; display: grid; grid-template-columns: 1.05fr 1fr; gap: 40px; align-items: center; }
    .hero h1 { font-size: clamp(2.1rem, 4.8vw, 3.5rem); font-weight: 800; line-height: 1.08; letter-spacing: -.02em; text-transform: uppercase; }
    .hero h1 .l1 { display: block; color: var(--blue-light); }
    .hero h1 .l2 { display: block; color: var(--navy); }
    .hero-sub { margin-top: 18px; font-size: 1.05rem; max-width: 520px; }

    .search-pill {
      margin-top: 32px;
      display: flex; align-items: center;
      background: #fff;
      border-radius: 999px;
      padding: 8px;
      box-shadow: var(--shadow-lg);
      max-width: 600px;
    }
    .search-field { display: flex; align-items: center; gap: 10px; padding: 6px 16px; flex: 1; min-width: 0; }
    .search-field + .search-field { border-left: 1px solid var(--line); flex: 0 0 170px; }
    .search-field svg { width: 20px; height: 20px; flex-shrink: 0; }
    .search-field input, .search-field select {
      border: 0; outline: none; background: transparent; width: 100%;
      font-size: .95rem; padding: 8px 0; appearance: none; cursor: pointer;
    }
    .search-field input { cursor: text; }
    .search-field input::placeholder { color: var(--gray); }
    .search-pill .btn { border-radius: 999px; padding: 14px 24px; }

    .hero-stats { display: flex; gap: 36px; margin-top: 36px; flex-wrap: wrap; }
    .stat b { display: block; font-size: 1.8rem; font-weight: 800; color: var(--navy); line-height: 1.1; }
    .stat b span { color: var(--orange); }
    .stat small { color: var(--gray); font-size: .88rem; }
    .hero-art { position: relative; }
    .hero-art svg { width: 100%; overflow: visible; }

    /* animasi ilustrasi */
    .sig { animation: sig 2s ease-in-out infinite; }
    .sig.s2 { animation-delay: .3s; }
    .sig.s3 { animation-delay: .6s; }
    .ring { transform-box: fill-box; transform-origin: center; animation: ring 2.4s ease-out infinite; }
    .ring.r2 { animation-delay: 1.2s; }
    .float { animation: floatY 5s ease-in-out infinite; }
    .float-x { animation: floatX 12s ease-in-out infinite; }
    @keyframes sig { 0%,100% { opacity: .25; } 50% { opacity: 1; } }
    @keyframes ring { 0% { transform: scale(.4); opacity: .6; } 100% { transform: scale(2.2); opacity: 0; } }
    @keyframes floatY { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
    @keyframes floatX { 0%,100% { transform: translateX(0); } 50% { transform: translateX(16px); } }

    /* =========================================================
       2. LOGO PROVIDER MITRA (marquee)
       ========================================================= */
    .partners { padding: 40px 0 20px; }
    .partners-title { text-align: center; color: var(--gray); font-size: .9rem; margin-bottom: 22px; }
    .marquee {
      overflow: hidden;
      mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
      -webkit-mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
    }
    .marquee-track { display: flex; gap: 18px; width: max-content; animation: marquee 32s linear infinite; padding: 8px 0; }
    .marquee:hover .marquee-track { animation-play-state: paused; }
    @keyframes marquee { to { transform: translateX(-50%); } }
    .partner {
      display: inline-flex; align-items: center; gap: 10px;
      padding: 12px 22px;
      background: #fff; border: 1px solid var(--line); border-radius: 14px;
      font-weight: 700; font-size: 1.05rem;
      box-shadow: var(--shadow-sm);
      transition: transform .2s, box-shadow .2s;
    }
    .partner:hover { transform: translateY(-3px); box-shadow: var(--shadow); }

    /* logo provider (dipakai di banyak tempat) */
    .p-logo {
      width: 40px; height: 40px; border-radius: 11px;
      display: grid; place-items: center;
      color: #fff; font-weight: 800; font-size: .9rem; letter-spacing: -.02em;
      flex-shrink: 0;
      position: relative; overflow: hidden;
    }
    .p-logo::after { content: ''; position: absolute; width: 26px; height: 26px; border-radius: 50%; background: rgba(255,255,255,.18); right: -8px; top: -8px; }
    .p-logo.sm { width: 30px; height: 30px; border-radius: 9px; font-size: .72rem; }
    .p-logo.lg { width: 52px; height: 52px; border-radius: 14px; font-size: 1.05rem; }

    /* =========================================================
       3. DAFTAR PROVIDER
       ========================================================= */
    .providers { background: #F7FBFF; }
    .providers-layout { display: grid; grid-template-columns: 280px 1fr; gap: 28px; align-items: start; }

    /* sidebar filter */
    .filter-panel {
      position: sticky; top: calc(var(--nav-h) + 16px);
      background: #fff; border-radius: var(--radius-lg);
      padding: 24px; box-shadow: var(--shadow-sm);
    }
    .filter-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
    .filter-head h3 { font-size: 1.1rem; display: flex; align-items: center; gap: 8px; }
    .filter-head h3 svg { width: 20px; height: 20px; }
    .link-btn { border: 0; background: none; color: var(--blue); font-weight: 600; font-size: .85rem; cursor: pointer; padding: 4px; }
    .filter-close { display: none; }
    .filter-group { padding: 18px 0; border-top: 1px dashed var(--line); }
    .filter-group h4 { font-size: .9rem; margin-bottom: 12px; }
    .range-value { display: flex; justify-content: space-between; font-size: .82rem; color: var(--gray); margin-top: 8px; }
    .range-value b { color: var(--navy); }
    input[type="range"] {
      -webkit-appearance: none; appearance: none;
      width: 100%; height: 6px; border-radius: 99px;
      background: linear-gradient(90deg, var(--blue) var(--fill, 100%), var(--line) var(--fill, 100%));
      outline: none; cursor: pointer;
    }
    input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; width: 22px; height: 22px; border-radius: 50%; background: #fff; border: 5px solid var(--blue); box-shadow: var(--shadow-sm); }
    input[type="range"]::-moz-range-thumb { width: 14px; height: 14px; border-radius: 50%; background: #fff; border: 5px solid var(--blue); }
    .chip-group { display: flex; flex-wrap: wrap; gap: 8px; }
    .chip-opt input { position: absolute; opacity: 0; pointer-events: none; }
    .chip-opt span {
      display: inline-block; padding: 7px 14px;
      border: 2px solid var(--line); border-radius: 999px;
      font-size: .84rem; font-weight: 500; cursor: pointer;
      transition: all .2s;
    }
    .chip-opt input:checked + span { background: var(--navy); border-color: var(--navy); color: #fff; }
    .chip-opt input:focus-visible + span { outline: 3px solid var(--blue-light); }
    .check { display: flex; align-items: center; gap: 10px; font-size: .9rem; cursor: pointer; padding: 5px 0; }
    .check input { position: absolute; opacity: 0; pointer-events: none; }
    .check .box {
      width: 20px; height: 20px; border-radius: 6px;
      border: 2px solid #C9D6E5; display: grid; place-items: center;
      transition: all .2s; flex-shrink: 0; background: #fff;
    }
    .check .box svg { width: 12px; height: 12px; opacity: 0; transition: opacity .15s; }
    .check input:checked + .box { background: var(--blue); border-color: var(--blue); }
    .check input:checked + .box svg { opacity: 1; }
    .check input:focus-visible + .box { outline: 3px solid var(--blue-light); outline-offset: 2px; }
    .check .count { margin-left: auto; font-size: .78rem; color: var(--gray); background: var(--blue-bg); padding: 1px 8px; border-radius: 99px; }

    /* toolbar */
    .toolbar {
      display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap;
      background: #fff; border-radius: var(--radius); padding: 12px 16px; margin-bottom: 18px;
      box-shadow: var(--shadow-sm);
    }
    .result-count { font-size: .92rem; }
    .result-count b { color: var(--blue); }
    .toolbar-right { display: flex; align-items: center; gap: 10px; }
    .select {
      appearance: none;
      border: 2px solid var(--line); border-radius: 12px;
      padding: 9px 38px 9px 14px; background: #fff;
      font-size: .88rem; font-weight: 500; cursor: pointer; outline: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238A94A6' stroke-width='2.5' stroke-linecap='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-position: right 12px center; background-size: 16px;
    }
    .select:focus { border-color: var(--blue); }
    .filter-toggle { display: none; }
    .active-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
    .active-tags:empty { display: none; }
    .tag {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 5px 8px 5px 12px; border-radius: 999px;
      background: var(--blue-bg); color: var(--blue-dark); font-size: .82rem; font-weight: 600;
    }
    .tag button { border: 0; background: #fff; width: 20px; height: 20px; border-radius: 50%; cursor: pointer; display: grid; place-items: center; color: var(--blue-dark); font-size: .8rem; line-height: 1; }

    /* kartu provider */
    .provider-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(270px, 1fr)); gap: 20px; }
    .p-card {
      position: relative;
      background: #fff; border-radius: var(--radius-lg);
      padding: 24px;
      border: 2px solid transparent;
      box-shadow: var(--shadow-sm);
      display: flex; flex-direction: column;
      transition: transform .3s, box-shadow .3s, border-color .3s;
      animation: cardIn .45s ease both;
    }
    .p-card:hover { transform: translateY(-6px); box-shadow: var(--shadow); }
    .p-card.recommended { border-color: var(--orange); }
    .p-card.selected { border-color: var(--blue); }
    @keyframes cardIn { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }

    .ribbon {
      position: absolute; top: 16px; right: -8px;
      background: var(--orange); color: #fff;
      font-size: .74rem; font-weight: 700;
      padding: 5px 12px 5px 10px;
      border-radius: 6px 0 0 6px;
      display: inline-flex; align-items: center; gap: 5px;
      box-shadow: 0 6px 14px rgba(255,111,60,.35);
    }
    .ribbon::after { content: ''; position: absolute; right: 0; bottom: -8px; border-left: 8px solid #C8461C; border-bottom: 8px solid transparent; }
    .ribbon svg { width: 12px; height: 12px; }

    .p-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; padding-right: 80px; }
    .p-head h3 { font-size: 1.1rem; }
    .type-badge { display: inline-flex; align-items: center; gap: 4px; font-size: .72rem; font-weight: 600; padding: 2px 9px; border-radius: 99px; margin-top: 3px; }
    .type-badge svg { width: 12px; height: 12px; }
    .type-Fiber { background: var(--blue-bg); color: var(--blue-dark); }
    .type-Wireless { background: #E0F7F4; color: #00796B; }
    .type-Satelit { background: #EDE7F6; color: #5E35B1; }
    .p-meta { display: flex; justify-content: space-between; align-items: flex-end; gap: 12px; padding: 14px 0; border-top: 1px dashed var(--line); border-bottom: 1px dashed var(--line); }
    .p-speed small, .p-price small { display: block; font-size: .74rem; color: var(--gray); }
    .p-speed b { font-size: 1.05rem; }
    .p-price { text-align: right; }
    .p-price b { font-size: 1.2rem; color: var(--orange); }
    .p-price b span { font-size: .8rem; color: var(--gray); font-weight: 500; }
    .p-features { list-style: none; padding: 0; margin: 14px 0 18px; display: grid; gap: 8px; flex: 1; }
    .p-features li { display: flex; gap: 8px; align-items: center; font-size: .87rem; color: #4A5568; }
    .p-features svg { width: 18px; height: 18px; flex-shrink: 0; }
    .p-foot { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
    .p-foot .check { font-size: .85rem; font-weight: 500; }

    /* tampilan list */
    .provider-grid.list { grid-template-columns: 1fr; }
    .provider-grid.list .p-card { display: grid; grid-template-columns: 1.1fr 1fr 1.3fr auto; align-items: center; gap: 22px; padding: 20px 24px; }
    .provider-grid.list .p-head { margin: 0; padding-right: 0; }
    .provider-grid.list .p-meta { border: 0; padding: 0; flex-direction: column; align-items: flex-start; gap: 6px; }
    .provider-grid.list .p-price { text-align: left; }
    .provider-grid.list .p-features { margin: 0; }
    .provider-grid.list .p-foot { flex-direction: column; align-items: stretch; }
    .provider-grid.list .ribbon { top: -10px; right: 18px; border-radius: 6px; }
    .provider-grid.list .ribbon::after { display: none; }

    .empty-state { grid-column: 1 / -1; text-align: center; padding: 50px 20px; background: #fff; border-radius: var(--radius-lg); }
    .empty-state svg { width: 140px; margin: 0 auto 16px; }
    .empty-state h3 { margin-bottom: 6px; }
    .empty-state .btn { margin-top: 18px; }

    .overlay { position: fixed; inset: 0; background: rgba(10,34,64,.5); z-index: 140; opacity: 0; visibility: hidden; transition: opacity .3s, visibility .3s; }
    .overlay.show { opacity: 1; visibility: visible; }

    /* =========================================================
       4. BANDINGKAN: bar melayang + modal
       ========================================================= */
    .compare-bar {
      position: fixed; left: 50%; bottom: 20px; z-index: 120;
      transform: translate(-50%, 150%);
      display: flex; align-items: center; gap: 18px;
      background: var(--navy); color: #fff;
      padding: 12px 12px 12px 18px; border-radius: 18px;
      box-shadow: var(--shadow-lg);
      transition: transform .4s cubic-bezier(.3,1.4,.6,1);
      max-width: calc(100% - 32px);
    }
    .compare-bar.show { transform: translate(-50%, 0); }
    .compare-logos { display: flex; }
    .compare-logos .p-logo { border: 2px solid var(--navy); margin-left: -8px; }
    .compare-logos .p-logo:first-child { margin-left: 0; }
    .compare-text { font-size: .92rem; white-space: nowrap; }
    .compare-text b { color: var(--blue-light); }
    .compare-bar .link-btn { color: #9FB0C6; }

    .modal {
      position: fixed; inset: 0; z-index: 150;
      display: grid; place-items: center; padding: 20px;
      visibility: hidden; pointer-events: none;
    }
    .modal.show { visibility: visible; pointer-events: auto; }
    .modal-box {
      position: relative; z-index: 1;
      background: #fff; border-radius: 22px;
      width: min(920px, 100%); max-height: calc(100vh - 40px);
      display: flex; flex-direction: column;
      box-shadow: var(--shadow-lg);
      transform: translateY(30px) scale(.97); opacity: 0;
      transition: transform .35s, opacity .35s;
    }
    .modal.show .modal-box { transform: none; opacity: 1; }
    .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 22px 26px; border-bottom: 1px solid var(--line); }
    .modal-head h3 { font-size: 1.25rem; }
    .modal-body { overflow: auto; padding: 8px 26px 26px; }
    .compare-table { width: 100%; border-collapse: collapse; min-width: 560px; }
    .compare-table th, .compare-table td { padding: 14px 12px; text-align: center; border-bottom: 1px solid var(--line); font-size: .9rem; }
    .compare-table th:first-child, .compare-table td:first-child { text-align: left; color: var(--gray); font-weight: 500; width: 170px; }
    .compare-table thead th { vertical-align: bottom; padding-top: 22px; }
    .compare-table thead .p-logo { margin: 0 auto 8px; }
    .compare-table .best { color: #138A4B; font-weight: 700; }
    .compare-table .best::after { content: ' ★'; color: var(--orange); }
    .compare-table tr:last-child td { border-bottom: 0; }

    /* =========================================================
       5. CEK JANGKAUAN
       ========================================================= */
    .coverage {
      background: linear-gradient(135deg, var(--blue) 0%, #1976D2 60%, var(--blue-dark) 100%);
      color: #fff; padding: 150px 0; overflow: hidden;
    }
    .coverage .wave { position: absolute; left: 0; width: 100%; height: 80px; }
    .coverage .wave.top { top: -1px; }
    .coverage .wave.bottom { bottom: -1px; }
    .coverage-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; position: relative; }
    .coverage .eyebrow { background: rgba(255,255,255,.16); color: #fff; }
    .coverage h2 { font-size: clamp(1.8rem, 3.4vw, 2.5rem); font-weight: 700; }
    .coverage-copy > p { color: rgba(255,255,255,.85); margin: 12px 0 26px; }
    .map-svg { width: 100%; filter: drop-shadow(0 30px 40px rgba(6,30,60,.3)); }
    .coverage-form { background: #fff; color: var(--navy); border-radius: var(--radius-lg); padding: 28px; box-shadow: var(--shadow-lg); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .field { margin-bottom: 16px; }
    .field label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: 6px; }
    .field input, .field select {
      width: 100%; padding: 12px 14px;
      border: 2px solid var(--line); border-radius: 12px;
      background: #F8FBFF; outline: none; appearance: none;
      transition: border-color .2s;
    }
    .field select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238A94A6' stroke-width='2.5' stroke-linecap='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; cursor: pointer; }
    .field input:focus, .field select:focus { border-color: var(--blue); background-color: #fff; }
    .field.invalid input, .field.invalid select { border-color: #E53935; }
    .cov-result { margin-top: 18px; display: none; }
    .cov-result.show { display: block; animation: cardIn .35s ease; }
    .cov-summary { display: flex; align-items: center; gap: 10px; font-size: .9rem; margin-bottom: 12px; }
    .cov-summary svg { width: 22px; height: 22px; flex-shrink: 0; }
    .cov-list { display: grid; gap: 10px; max-height: 300px; overflow: auto; padding-right: 4px; }
    .cov-item { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border: 1px solid var(--line); border-radius: 12px; }
    .cov-item.rec { border-color: var(--orange); background: #FFF7F3; }
    .cov-item .info { flex: 1; min-width: 0; }
    .cov-item b { display: block; font-size: .92rem; }
    .cov-item small { color: var(--gray); font-size: .78rem; }
    .spinner { width: 18px; height: 18px; border: 2.5px solid rgba(255,255,255,.4); border-top-color: #fff; border-radius: 50%; animation: spin .7s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* =========================================================
       6. PROMO (carousel)
       ========================================================= */
    .promo-head { display: flex; justify-content: space-between; align-items: flex-end; gap: 20px; margin-bottom: 32px; }
    .promo-head .section-head { text-align: left; margin: 0; }
    .carousel-nav { display: flex; gap: 10px; }
    .promo-track {
      display: grid; grid-auto-flow: column; grid-auto-columns: calc((100% - 40px) / 3);
      gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;
      padding: 6px 2px 22px; scrollbar-width: none;
    }
    .promo-track::-webkit-scrollbar { display: none; }
    .promo-card {
      scroll-snap-align: start;
      border-radius: var(--radius-lg); overflow: hidden;
      background: #fff; box-shadow: var(--shadow-sm);
      border: 1px solid var(--line);
      display: flex; flex-direction: column;
      transition: transform .3s, box-shadow .3s;
    }
    .promo-card:hover { transform: translateY(-6px); box-shadow: var(--shadow); }
    .promo-top { position: relative; padding: 22px; color: #fff; min-height: 150px; overflow: hidden; }
    .promo-top::before, .promo-top::after { content: ''; position: absolute; border-radius: 50%; background: rgba(255,255,255,.14); }
    .promo-top::before { width: 160px; height: 160px; right: -50px; top: -60px; }
    .promo-top::after { width: 90px; height: 90px; right: 50px; bottom: -50px; }
    .promo-top .p-logo { background: rgba(255,255,255,.22) !important; margin-bottom: 14px; }
    .promo-top .disc { font-size: 1.9rem; font-weight: 800; line-height: 1; position: relative; }
    .promo-top .until { font-size: .78rem; opacity: .9; margin-top: 6px; position: relative; }
    .promo-body { padding: 20px 22px 22px; display: flex; flex-direction: column; gap: 14px; flex: 1; }
    .promo-body h3 { font-size: 1.02rem; }
    .promo-body p { font-size: .87rem; flex: 1; }
    .carousel-dots { display: flex; justify-content: center; gap: 8px; }
    .carousel-dots button { width: 8px; height: 8px; border-radius: 99px; border: 0; background: #C9D6E5; cursor: pointer; transition: width .3s, background .3s; padding: 0; }
    .carousel-dots button.active { width: 26px; background: var(--blue); }

    /* =========================================================
       7. CARA KERJA
       ========================================================= */
    .how { background: #F7FBFF; overflow: hidden; }
    .how-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; position: relative; }
    .how-line { position: absolute; top: 62px; left: 16%; right: 16%; height: 3px; background-image: linear-gradient(90deg, var(--blue-light) 50%, transparent 0); background-size: 16px 3px; }
    .how-step { text-align: center; position: relative; background: #fff; border-radius: var(--radius-lg); padding: 30px 24px; box-shadow: var(--shadow-sm); transition: transform .3s, box-shadow .3s; }
    .how-step:hover { transform: translateY(-6px); box-shadow: var(--shadow); }
    .how-icon { width: 76px; height: 76px; margin: 0 auto 18px; position: relative; }
    .how-num { position: absolute; top: -6px; right: -10px; width: 30px; height: 30px; border-radius: 50%; background: var(--orange); color: #fff; font-weight: 700; font-size: .85rem; display: grid; place-items: center; border: 3px solid #fff; }
    .how-step h3 { font-size: 1.08rem; margin-bottom: 6px; }
    .how-step p { font-size: .9rem; }

    /* =========================================================
       8. FAQ
       ========================================================= */
    .faq-grid { display: grid; grid-template-columns: .8fr 1.2fr; gap: 56px; align-items: start; }
    .faq-side { position: sticky; top: calc(var(--nav-h) + 20px); }
    .faq-side h2 { font-size: clamp(1.8rem, 3.4vw, 2.4rem); }
    .faq-side > p { margin: 12px 0 24px; }
    .faq-illus { max-width: 320px; }
    .accordion { display: grid; gap: 14px; }
    .acc-item { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 2px solid var(--line); transition: border-color .25s; }
    .acc-item.open { border-color: var(--blue-light); }
    .acc-btn { width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 18px 22px; background: none; border: 0; text-align: left; font-weight: 600; font-size: 1rem; cursor: pointer; }
    .acc-btn .plus { width: 32px; height: 32px; flex-shrink: 0; border-radius: 10px; background: var(--blue-bg); display: grid; place-items: center; transition: transform .3s, background .3s; }
    .acc-btn .plus svg { width: 16px; height: 16px; }
    .acc-item.open .plus { transform: rotate(45deg); background: var(--orange); }
    .acc-item.open .plus path { stroke: #fff; }
    .acc-panel { max-height: 0; overflow: hidden; transition: max-height .35s ease; }
    .acc-panel p { padding: 0 22px 20px; font-size: .94rem; }

    /* =========================================================
       FOOTER
       ========================================================= */
    .footer { background: var(--navy-2); color: #B7C3D4; padding: 72px 0 0; }
    .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr 1.3fr; gap: 40px; }
    .footer .logo { color: #fff; }
    .footer p { color: #9FB0C6; font-size: .92rem; margin: 18px 0 22px; max-width: 300px; }
    .footer h4 { color: #fff; font-size: 1rem; margin-bottom: 18px; }
    .footer ul { list-style: none; padding: 0; margin: 0; display: grid; gap: 10px; font-size: .92rem; }
    .footer ul a { display: inline-flex; align-items: center; gap: 8px; transition: color .2s; }
    .footer ul a:hover { color: var(--blue-light); }
    .footer .dot { width: 8px; height: 8px; border-radius: 50%; }
    .footer .new { font-size: .66rem; background: var(--orange); color: #fff; padding: 1px 7px; border-radius: 99px; font-weight: 600; }
    .contact-list li { display: flex; gap: 12px; align-items: flex-start; }
    .contact-list svg { width: 18px; height: 18px; flex-shrink: 0; margin-top: 3px; }
    .socials { display: flex; gap: 10px; }
    .socials a { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,.08); display: grid; place-items: center; transition: background .2s, transform .2s; }
    .socials a:hover { background: var(--orange); transform: translateY(-3px); }
    .socials svg { width: 18px; height: 18px; }
    .footer-bottom { margin-top: 56px; padding: 22px 0; border-top: 1px solid rgba(255,255,255,.08); display: flex; justify-content: space-between; flex-wrap: wrap; gap: 12px; font-size: .86rem; color: #7F91AA; }

    /* toast */
    .toast {
      position: fixed; top: calc(var(--nav-h) + 12px); left: 50%; z-index: 200;
      transform: translate(-50%, -20px); opacity: 0; pointer-events: none;
      background: var(--navy); color: #fff; padding: 12px 20px; border-radius: 12px;
      font-size: .9rem; box-shadow: var(--shadow-lg);
      transition: opacity .3s, transform .3s;
      max-width: calc(100% - 32px);
    }
    .toast.show { opacity: 1; transform: translate(-50%, 0); }

    /* =========================================================
       REVEAL
       ========================================================= */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; }
    .reveal.visible { opacity: 1; transform: none; }
    .reveal.d1 { transition-delay: .1s; }
    .reveal.d2 { transition-delay: .2s; }
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after { animation: none !important; transition: none !important; }
      .reveal { opacity: 1; transform: none; }
      html { scroll-behavior: auto; }
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */
    @media (max-width: 1140px) {
      .nav-link { padding: 8px 10px; font-size: .86rem; }
      .nav-actions .btn { padding: 8px 14px; }
    }
    @media (max-width: 1024px) {
      .hamburger { display: block; }
      .nav-menu {
        position: fixed; top: var(--nav-h); left: 0; right: 0;
        flex-direction: column; align-items: stretch; gap: 4px;
        padding: 16px 20px 24px; background: #fff;
        box-shadow: 0 20px 30px rgba(13,43,78,.12);
        opacity: 0; visibility: hidden; transform: translateY(-12px);
        transition: opacity .25s, transform .25s, visibility .25s;
        max-height: calc(100vh - var(--nav-h)); overflow: auto;
      }
      .nav-menu.open { opacity: 1; visibility: visible; transform: none; }
      .nav-link { padding: 12px 16px; font-size: 1rem; }
      .nav-actions { margin: 10px 0 0; }
      .nav-actions .btn { flex: 1; padding: 12px; }
      .providers-layout { grid-template-columns: 1fr; }
      .filter-toggle { display: inline-flex; }

      /* filter jadi panel geser dari bawah */
      .filter-panel {
        position: fixed; left: 0; right: 0; bottom: 0; top: auto; z-index: 150;
        border-radius: 24px 24px 0 0;
        max-height: 85vh; overflow: auto;
        transform: translateY(105%);
        transition: transform .35s cubic-bezier(.3,.9,.4,1);
        box-shadow: var(--shadow-lg);
        padding-bottom: 90px;
      }
      .filter-panel::before { content: ''; display: block; width: 44px; height: 5px; border-radius: 99px; background: var(--line); margin: -8px auto 16px; }
      .filter-panel.open { transform: none; }
      .filter-close { display: inline-flex; }
      .filter-apply { position: fixed; left: 0; right: 0; bottom: 0; padding: 14px 24px; background: #fff; border-top: 1px solid var(--line); }
      .footer-grid { grid-template-columns: 1fr 1fr; }
      .promo-track { grid-auto-columns: calc((100% - 20px) / 2); }
      .provider-grid.list .p-card { grid-template-columns: 1fr 1fr; }
    }
    @media (min-width: 1025px) { .filter-apply { display: none; } }

    @media (max-width: 768px) {
      .section { padding: 72px 0; }
      .hero { padding-top: calc(var(--nav-h) + 28px); text-align: center; }
      .hero-grid, .coverage-grid, .faq-grid { grid-template-columns: 1fr; }
      .hero-sub { margin-left: auto; margin-right: auto; }
      .search-pill { flex-direction: column; align-items: stretch; border-radius: 20px; padding: 10px; gap: 4px; margin-left: auto; margin-right: auto; }
      .search-field { padding: 6px 12px; }
      .search-field + .search-field { border-left: 0; border-top: 1px solid var(--line); flex: 1; }
      .search-pill .btn { border-radius: 14px; }
      .hero-stats { justify-content: center; gap: 24px; }
      .hero-art { order: -1; max-width: 440px; margin: 0 auto; }

      .provider-grid { grid-template-columns: 1fr; }
      .provider-grid.list .p-card { grid-template-columns: 1fr; gap: 14px; }
      .view-toggle { display: none; }
      .toolbar { padding: 12px; }
      .toolbar-right { width: 100%; }
      .toolbar-right .select { flex: 1; }

      .compare-bar { gap: 10px; padding: 10px; bottom: 12px; }
      .compare-text { white-space: normal; font-size: .82rem; }
      .compare-bar .link-btn { display: none; }
      .modal { padding: 0; align-items: end; }
      .modal-box { border-radius: 22px 22px 0 0; max-height: 90vh; }
      .modal-head, .modal-body { padding-left: 18px; padding-right: 18px; }

      .coverage { padding: 120px 0; }
      .coverage-copy { text-align: center; }
      .coverage-form { text-align: left; padding: 22px; }
      .form-row { grid-template-columns: 1fr; gap: 0; }

      .promo-head { flex-direction: column; align-items: center; text-align: center; }
      .promo-head .section-head { text-align: center; }
      .promo-track { grid-auto-columns: 85%; }

      .how-grid { grid-template-columns: 1fr; }
      .how-line { top: 40px; bottom: 40px; left: 50%; right: auto; width: 3px; height: auto; background-image: linear-gradient(180deg, var(--blue-light) 50%, transparent 0); background-size: 3px 16px; }

      .faq-side { position: static; text-align: center; }
      .faq-illus { margin: 0 auto; max-width: 240px; }
      .footer-grid { grid-template-columns: 1fr; gap: 32px; }
      .footer-bottom { justify-content: center; text-align: center; }
    }
  </style>
  @endverbatim
</head>
<body>

  <!-- =========================================================
       SVG SYMBOLS
       ========================================================= -->
  <svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <defs>
      <symbol id="i-wifi" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
          <path d="M2.5 9a14 14 0 0 1 19 0" /><path d="M5.8 12.6a9 9 0 0 1 12.4 0" /><path d="M9.1 16.1a4.2 4.2 0 0 1 5.8 0" />
        </g>
        <circle cx="12" cy="19.6" r="1.7" fill="currentColor" />
      </symbol>
      <symbol id="i-check" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="11" fill="#E3F2FD" />
        <path d="M7 12.4l3.2 3.1L17 8.8" fill="none" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-tick" viewBox="0 0 24 24">
        <path d="M5 12.5l4.5 4.5L19 7.5" fill="none" stroke="#fff" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-arrow" viewBox="0 0 24 24">
        <path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-ext" viewBox="0 0 24 24">
        <path d="M14 4h6v6M20 4l-9 9M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
      <symbol id="i-pin" viewBox="0 0 24 24">
        <path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z" fill="none" stroke="currentColor" stroke-width="2" />
        <circle cx="12" cy="10" r="2.6" fill="none" stroke="currentColor" stroke-width="2" />
      </symbol>
      <symbol id="i-star" viewBox="0 0 24 24">
        <path d="M12 2l3 6.5 7 .8-5.2 4.8 1.5 7L12 17.6 5.7 21l1.5-7L2 9.3l7-.8z" fill="currentColor" />
      </symbol>
      <symbol id="i-filter" viewBox="0 0 24 24">
        <path d="M4 6h16M7 12h10M10 18h4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
      </symbol>
      <symbol id="i-close" viewBox="0 0 24 24">
        <path d="M6 6l12 12M18 6L6 18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
      </symbol>
      <symbol id="i-search" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2.4" /><path d="M20 20l-4-4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
      </symbol>
      <symbol id="i-compare" viewBox="0 0 24 24">
        <path d="M8 4v16M16 4v16M3 8l5-4 5 4M11 16l5 4 5-4" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
      </symbol>
    </defs>
  </svg>

  <!-- =========================================================
       NAVBAR
       ========================================================= -->
  <header class="navbar" id="navbar">
    <div class="container nav-inner">
      <a href="#beranda" class="logo" aria-label="KoneksiKu - Beranda">
        <span class="logo-icon">
          <svg viewBox="0 0 26 26" aria-hidden="true">
            <!-- ikon jaringan: titik-titik terhubung -->
            <path d="M6 7l7 6 7-6M13 13v7M6 7l-1 10 8 3 8-3-1-10" fill="none" stroke="#BBDEFB" stroke-width="1.6" stroke-linejoin="round" />
            <circle cx="6" cy="7" r="2.6" fill="#fff" />
            <circle cx="20" cy="7" r="2.6" fill="#fff" />
            <circle cx="5" cy="17" r="2.2" fill="#4FC3F7" />
            <circle cx="21" cy="17" r="2.2" fill="#4FC3F7" />
            <circle cx="13" cy="20" r="2.2" fill="#4FC3F7" />
            <circle cx="13" cy="13" r="3.4" fill="#FF6F3C" />
          </svg>
        </span>
        <span>Koneksi<span class="ku">Ku</span></span>
      </a>

      <nav class="nav-menu" id="navMenu" aria-label="Navigasi utama">
        <a href="#beranda" class="nav-link active">Beranda</a>
        <a href="#provider" class="nav-link">Semua Provider</a>
        <a href="#provider" class="nav-link" data-action="compare">Bandingkan</a>
        <a href="#jangkauan" class="nav-link">Cek Jangkauan</a>
        <a href="#promo" class="nav-link">Promo</a>
        <a href="#bantuan" class="nav-link">Bantuan</a>
        <div class="nav-actions">
          <a href="#" class="btn btn-outline" data-soon="Masuk">Masuk</a>
          <a href="#" class="btn btn-orange" data-soon="Daftar">Daftar</a>
        </div>
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
      <svg class="blob b1" viewBox="0 0 200 200" aria-hidden="true"><path fill="#BBDEFB" d="M44.7-61.6C57.3-52.4 66.2-38.2 70.9-22.6 75.5-7 75.9 10 69.6 24.1 63.3 38.2 50.3 49.4 35.6 57.7 20.9 66 4.4 71.4-12.7 70.2-29.8 69-47.5 61.2-58.8 47.8-70.1 34.4-75 15.4-73.1-2.6-71.2-20.6-62.4-37.6-49.5-46.9-36.6-56.2-19.6-57.8-2.3-54.7 15-51.6 32.1-70.8 44.7-61.6Z" transform="translate(100 100)"/></svg>
      <svg class="blob b2" viewBox="0 0 200 200" aria-hidden="true"><path fill="#4FC3F7" d="M39.9-54.3C51.4-46.2 60.2-34.4 65.4-20.6 70.6-6.8 72.2 9 66.6 21.6 61 34.2 48.2 43.6 34.6 51.9 21 60.2 6.6 67.4-8.6 68.5-23.8 69.6-39.8 64.6-51.4 54.2-63 43.8-70.2 28-71.6 11.9-73-4.2-68.6-20.6-59.5-33.4-50.4-46.2-36.6-55.4-22.4-62.6-8.2-69.8 6.4-75 19.4-70.4 32.4-65.8 28.4-62.4 39.9-54.3Z" transform="translate(100 100)"/></svg>

      <div class="container hero-grid">
        <div class="hero-copy">
          <h1 class="reveal">
            <span class="l1">Temukan Provider</span>
            <span class="l2">Internet Terbaikmu</span>
          </h1>
          <p class="hero-sub reveal d1">Bandingkan paket, harga, dan jangkauan dari berbagai provider internet di satu tempat.</p>

          <!-- kotak pencarian pil -->
          <form class="search-pill reveal d2" id="heroSearch" role="search">
            <label class="search-field">
              <svg style="color:#FF6F3C" aria-hidden="true"><use href="#i-pin" /></svg>
              <input type="text" id="heroLoc" placeholder="Kota atau kecamatan, mis. Bandung" list="cityList" aria-label="Lokasi (kota/kecamatan)" />
            </label>
            <label class="search-field">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 11l9-7 9 7v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z" fill="none" stroke="#1E88E5" stroke-width="2" stroke-linejoin="round" /></svg>
              <select id="heroNeed" aria-label="Kebutuhan">
                <option value="rumah">Rumah</option>
                <option value="kos">Kos</option>
                <option value="bisnis">Bisnis</option>
                <option value="gaming">Gaming</option>
              </select>
            </label>
            <button type="submit" class="btn btn-orange">
              <svg aria-hidden="true"><use href="#i-search" /></svg>
              Cari Provider
            </button>
          </form>
          <datalist id="cityList"></datalist>

          <div class="hero-stats reveal d2">
            <div class="stat"><b id="statProviders">2</b><small>Provider Pilihan</small></div>
            <div class="stat"><b>10</b><small>Paket</small></div>
            <div class="stat"><b id="statCities">10</b><small>Kota Terjangkau</small></div>
          </div>
        </div>

        <!-- Ilustrasi: peta kota, menara warna-warni, pin, karakter membandingkan paket di tablet -->
        <div class="hero-art reveal d1">
          <svg viewBox="0 0 560 480" role="img" aria-label="Ilustrasi peta kota dengan menara sinyal berbagai provider dan seseorang membandingkan dua paket internet di tablet">
            <circle cx="290" cy="240" r="210" fill="#FFFFFF" opacity=".6" />

            <!-- awan -->
            <g class="float-x" fill="#FFFFFF">
              <ellipse cx="80" cy="40" rx="36" ry="15" /><ellipse cx="100" cy="30" rx="22" ry="17" /><ellipse cx="64" cy="33" rx="15" ry="12" />
            </g>

            <!-- peta kota (isometrik sederhana) -->
            <g transform="translate(20 70)">
              <rect x="0" y="0" width="380" height="250" rx="24" fill="#FFFFFF" />
              <rect x="10" y="10" width="360" height="230" rx="18" fill="#E3F2FD" />
              <!-- jalan -->
              <path d="M10 120 H370 M130 10 V240 M260 10 V240" stroke="#FFFFFF" stroke-width="14" />
              <path d="M10 120 H370 M130 10 V240 M260 10 V240" stroke="#BBDEFB" stroke-width="1.5" stroke-dasharray="6 6" />
              <!-- blok -->
              <g fill="#FFFFFF">
                <rect x="24" y="24" width="90" height="80" rx="10" />
                <rect x="146" y="24" width="98" height="80" rx="10" />
                <rect x="276" y="24" width="80" height="80" rx="10" />
                <rect x="24" y="136" width="90" height="90" rx="10" />
                <rect x="276" y="136" width="80" height="90" rx="10" />
              </g>
              <rect x="146" y="136" width="98" height="90" rx="12" fill="#C8E6C9" />
              <circle cx="170" cy="164" r="11" fill="#81C784" /><circle cx="214" cy="196" r="13" fill="#81C784" />
              <!-- gedung kecil -->
              <g fill="#BBDEFB">
                <rect x="36" y="40" width="22" height="50" rx="4" /><rect x="64" y="56" width="18" height="34" rx="4" /><rect x="88" y="46" width="16" height="44" rx="4" />
                <rect x="290" y="150" width="22" height="62" rx="4" /><rect x="318" y="166" width="26" height="46" rx="4" />
              </g>
            </g>

            <!-- menara provider (warna berbeda) + sinyal -->
            <!-- menara oranye (M3) -->
            <g transform="translate(200 120)">
              <circle class="ring" cx="0" cy="0" r="22" fill="none" stroke="#FF6F3C" stroke-width="2.5" />
              <circle class="ring r2" cx="0" cy="0" r="22" fill="none" stroke="#FF6F3C" stroke-width="2.5" />
              <g fill="none" stroke="#FF6F3C" stroke-width="4" stroke-linecap="round">
                <path class="sig s3" d="M-28 -6 a30 30 0 0 1 56 0" /><path class="sig s2" d="M-18 0 a20 20 0 0 1 36 0" />
              </g>
              <path d="M-12 50 L0 4 L12 50z" fill="none" stroke="#0D2B4E" stroke-width="4" stroke-linejoin="round" />
              <path d="M-7 32 h14 M-4 20 h8" stroke="#0D2B4E" stroke-width="3" />
              <circle cx="0" cy="4" r="7" fill="#FF6F3C" />
            </g>
            <!-- menara ungu -->
            <g transform="translate(80 240)">
              <g fill="none" stroke="#8E24AA" stroke-width="3.5" stroke-linecap="round">
                <path class="sig s2" d="M-22 -4 a24 24 0 0 1 44 0" /><path class="sig" d="M-13 1 a15 15 0 0 1 26 0" />
              </g>
              <path d="M-9 40 L0 4 L9 40z" fill="none" stroke="#0D2B4E" stroke-width="3.5" stroke-linejoin="round" />
              <circle cx="0" cy="4" r="6" fill="#8E24AA" />
            </g>
            <!-- menara hijau -->
            <g transform="translate(345 230)">
              <g fill="none" stroke="#2E7D32" stroke-width="3.5" stroke-linecap="round">
                <path class="sig" d="M-22 -4 a24 24 0 0 1 44 0" /><path class="sig s3" d="M-13 1 a15 15 0 0 1 26 0" />
              </g>
              <path d="M-9 40 L0 4 L9 40z" fill="none" stroke="#0D2B4E" stroke-width="3.5" stroke-linejoin="round" />
              <circle cx="0" cy="4" r="6" fill="#2E7D32" />
            </g>
            <!-- router biru -->
            <g transform="translate(330 104)">
              <g fill="none" stroke="#1E88E5" stroke-width="3.5" stroke-linecap="round">
                <path class="sig s3" d="M-18 -10 a22 22 0 0 1 36 0" /><path class="sig s2" d="M-10 -4 a12 12 0 0 1 20 0" />
              </g>
              <rect x="-20" y="2" width="40" height="16" rx="6" fill="#1E88E5" />
              <circle cx="-8" cy="10" r="2.4" fill="#fff" /><circle cx="0" cy="10" r="2.4" fill="#4FC3F7" />
            </g>

            <!-- pin lokasi -->
            <g class="float">
              <path d="M110 150 c-3-8-22-22-22-38 a22 22 0 0 1 44 0 c0 16-19 30-22 38z" fill="#FF6F3C" />
              <circle cx="110" cy="112" r="9" fill="#fff" />
            </g>
            <g class="float" style="animation-delay:-2s">
              <path d="M270 262 c-2-6-16-16-16-28 a16 16 0 0 1 32 0 c0 12-14 22-16 28z" fill="#1E88E5" />
              <circle cx="270" cy="234" r="6" fill="#fff" />
            </g>

            <!-- karakter membandingkan dua kartu paket di tablet -->
            <g>
              <ellipse cx="450" cy="466" rx="80" ry="10" fill="#0D2B4E" opacity=".08" />
              <!-- kaki -->
              <path d="M440 380 l-8 80 M468 380 l6 80" stroke="#0D2B4E" stroke-width="16" stroke-linecap="round" />
              <path d="M424 462 h18 M466 462 h20" stroke="#FF6F3C" stroke-width="10" stroke-linecap="round" />
              <!-- badan -->
              <path d="M424 392 v-74 a30 30 0 0 1 60 0 v74z" fill="#4FC3F7" />
              <path d="M440 300 l14 18 14 -18" fill="none" stroke="#fff" stroke-width="3" stroke-linejoin="round" />
              <!-- kepala -->
              <rect x="446" y="276" width="16" height="16" rx="4" fill="#F6C9A8" />
              <circle cx="454" cy="258" r="22" fill="#F6C9A8" />
              <path d="M431 260 c-4-22 10-32 26-30 c16 2 24 14 20 30 c-6-10-12-14-20-14 c-10 0-18 6-26 14z" fill="#3E2723" />
              <path d="M432 262 c-4 16 0 30 6 34" fill="none" stroke="#3E2723" stroke-width="8" stroke-linecap="round" />
              <circle cx="446" cy="262" r="2.2" fill="#0D2B4E" />
              <path d="M444 272 q6 4 12 0" fill="none" stroke="#B5654A" stroke-width="2" stroke-linecap="round" />
              <!-- tangan memegang tablet -->
              <path d="M428 330 q-24 18 -40 26" stroke="#4FC3F7" stroke-width="13" stroke-linecap="round" fill="none" />
              <path d="M476 330 q-10 34 -64 40" stroke="#4FC3F7" stroke-width="13" stroke-linecap="round" fill="none" />

              <!-- tablet -->
              <g transform="rotate(-6 340 350)">
                <rect x="262" y="296" width="156" height="110" rx="14" fill="#0D2B4E" />
                <rect x="270" y="304" width="140" height="94" rx="9" fill="#F4FAFF" />
                <!-- kartu A (M3) -->
                <rect x="278" y="312" width="56" height="78" rx="8" fill="#fff" stroke="#FF6F3C" stroke-width="2" />
                <rect x="278" y="312" width="56" height="16" rx="8" fill="#FF6F3C" />
                <text x="306" y="324" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="9" fill="#fff">M3</text>
                <text x="306" y="346" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="13" fill="#0D2B4E">50</text>
                <rect x="286" y="354" width="40" height="4" rx="2" fill="#E3F2FD" />
                <rect x="286" y="362" width="30" height="4" rx="2" fill="#E3F2FD" />
                <rect x="286" y="374" width="40" height="9" rx="4" fill="#FF6F3C" />
                <!-- kartu B -->
                <rect x="346" y="312" width="56" height="78" rx="8" fill="#fff" stroke="#BBDEFB" stroke-width="2" />
                <rect x="346" y="312" width="56" height="16" rx="8" fill="#1E88E5" />
                <text x="374" y="346" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="13" fill="#0D2B4E">30</text>
                <rect x="354" y="354" width="40" height="4" rx="2" fill="#E3F2FD" />
                <rect x="354" y="362" width="30" height="4" rx="2" fill="#E3F2FD" />
                <rect x="354" y="374" width="40" height="9" rx="4" fill="#BBDEFB" />
                <!-- VS -->
                <circle cx="340" cy="351" r="11" fill="#0D2B4E" />
                <text x="340" y="355" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="9" fill="#4FC3F7">VS</text>
              </g>
              <!-- tangan di depan tablet -->
              <circle cx="390" cy="356" r="8" fill="#F6C9A8" />
              <circle cx="414" cy="370" r="8" fill="#F6C9A8" />

              <!-- bubble ide -->
              <g class="float" style="animation-delay:-1s">
                <rect x="480" y="200" width="56" height="40" rx="12" fill="#FF6F3C" />
                <path d="M490 240 l-4 10 14 -10z" fill="#FF6F3C" />
                <path d="M498 220 l6 6 12 -12" fill="none" stroke="#fff" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
              </g>
            </g>

            <!-- kartu harga melayang -->
            <g class="float" style="animation-delay:-3s">
              <rect x="410" y="40" width="130" height="58" rx="14" fill="#fff" />
              <circle cx="436" cy="69" r="14" fill="#FFE9E0" />
              <text x="436" y="74" text-anchor="middle" font-family="Poppins, sans-serif" font-weight="800" font-size="13" fill="#FF6F3C">%</text>
              <text x="458" y="65" font-family="Poppins, sans-serif" font-weight="700" font-size="12" fill="#0D2B4E">Harga transparan</text>
              <text x="458" y="81" font-family="Poppins, sans-serif" font-size="10" fill="#8A94A6">tanpa biaya tersembunyi</text>
            </g>
          </svg>
        </div>
      </div>

      <svg class="hero-wave" viewBox="0 0 1440 90" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 50 C240 90 480 10 720 40 S1200 90 1440 30 V90 H0z" fill="#FFFFFF" />
      </svg>
    </section>

    <!-- =========================================================
         2. LOGO PROVIDER MITRA
         ========================================================= -->
    <section class="partners">
      <p class="partners-title">Provider mitra KoneksiKu</p>
      <div class="marquee">
        <div class="marquee-track" id="marqueeTrack"><!-- diisi JS --></div>
      </div>
    </section>

    <!-- =========================================================
         3. DAFTAR PROVIDER
         ========================================================= -->
    <section class="section providers" id="provider">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><svg aria-hidden="true"><use href="#i-wifi" /></svg>Semua Provider</span>
          <h2>Pilih Provider Internet</h2>
          <p>Saring berdasarkan harga, kecepatan, dan fitur. Centang keduanya untuk membandingkan berdampingan.</p>
        </div>

        <div class="providers-layout">
          <!-- Sidebar filter -->
          <aside class="filter-panel" id="filterPanel" aria-label="Filter provider">
            <div class="filter-head">
              <h3><svg aria-hidden="true"><use href="#i-filter" /></svg>Filter</h3>
              <div>
                <button class="link-btn" id="resetFilter" type="button">Reset</button>
                <button class="icon-btn filter-close" id="filterClose" type="button" aria-label="Tutup filter"><svg><use href="#i-close" /></svg></button>
              </div>
            </div>

            <div class="filter-group">
              <h4>Harga maksimum</h4>
              <input type="range" id="priceRange" min="100000" max="400000" step="10000" value="400000" aria-label="Harga maksimum per bulan" />
              <div class="range-value"><span>Rp100rb</span><b id="priceLabel">s/d Rp400.000</b></div>
            </div>

            <div class="filter-group">
              <h4>Kecepatan minimum</h4>
              <div class="chip-group" id="speedChips">
                <label class="chip-opt"><input type="radio" name="speed" value="0" checked /><span>Semua</span></label>
                <label class="chip-opt"><input type="radio" name="speed" value="10" /><span>10</span></label>
                <label class="chip-opt"><input type="radio" name="speed" value="20" /><span>20</span></label>
                <label class="chip-opt"><input type="radio" name="speed" value="50" /><span>50</span></label>
                <label class="chip-opt"><input type="radio" name="speed" value="100" /><span>100+ Mbps</span></label>
              </div>
            </div>

            <div class="filter-group">
              <h4>Jenis koneksi</h4>
              <div id="typeChecks"><!-- diisi JS --></div>
            </div>

            <div class="filter-group">
              <h4>Fitur</h4>
              <label class="check"><input type="checkbox" name="feat" value="unlimited" /><span class="box"><svg><use href="#i-tick" /></svg></span>Unlimited</label>
              <label class="check"><input type="checkbox" name="feat" value="freeInstall" /><span class="box"><svg><use href="#i-tick" /></svg></span>Pemasangan Gratis</label>
              <label class="check"><input type="checkbox" name="feat" value="support24" /><span class="box"><svg><use href="#i-tick" /></svg></span>Support 24/7</label>
            </div>

            <div class="filter-apply">
              <button class="btn btn-blue btn-block" id="filterApply" type="button">Tampilkan <span id="applyCount">2</span> provider</button>
            </div>
          </aside>

          <!-- Hasil -->
          <div>
            <div class="toolbar">
              <div class="result-count" id="resultCount" aria-live="polite">Menampilkan <b>8</b> provider</div>
              <div class="toolbar-right">
                <button class="btn btn-ghost btn-sm filter-toggle" id="filterOpen" type="button">
                  <svg aria-hidden="true"><use href="#i-filter" /></svg>Filter
                </button>
                <select class="select" id="sortSelect" aria-label="Urutkan">
                  <option value="popular">Terpopuler</option>
                  <option value="cheap">Termurah</option>
                  <option value="fast">Tercepat</option>
                </select>
                <div class="view-toggle" style="display:flex;gap:6px">
                  <button class="icon-btn active" data-view="grid" type="button" aria-label="Tampilan grid">
                    <svg viewBox="0 0 24 24"><rect x="4" y="4" width="7" height="7" rx="2" fill="currentColor" /><rect x="13" y="4" width="7" height="7" rx="2" fill="currentColor" /><rect x="4" y="13" width="7" height="7" rx="2" fill="currentColor" /><rect x="13" y="13" width="7" height="7" rx="2" fill="currentColor" /></svg>
                  </button>
                  <button class="icon-btn" data-view="list" type="button" aria-label="Tampilan list">
                    <svg viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="4" rx="2" fill="currentColor" /><rect x="4" y="11" width="16" height="4" rx="2" fill="currentColor" /><rect x="4" y="17" width="16" height="3" rx="1.5" fill="currentColor" /></svg>
                  </button>
                </div>
              </div>
            </div>
            <div class="active-tags" id="activeTags"></div>
            <div class="provider-grid" id="providerGrid"><!-- diisi JS --></div>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         5. CEK JANGKAUAN
         ========================================================= -->
    <section class="section coverage" id="jangkauan">
      <svg class="wave top" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 0 H1440 V30 C1200 80 960 0 720 30 S240 80 0 30z" fill="#F7FBFF" />
      </svg>

      <div class="container coverage-grid">
        <!-- peta -->
        <div class="reveal">
          <svg class="map-svg" viewBox="0 0 480 400" role="img" aria-label="Ilustrasi peta dengan pin lokasi dan beberapa provider di sekitarnya">
            <rect x="10" y="20" width="460" height="360" rx="26" fill="#E3F2FD" />
            <g fill="#FFFFFF">
              <rect x="34" y="44" width="120" height="78" rx="10" /><rect x="186" y="44" width="96" height="78" rx="10" /><rect x="314" y="44" width="132" height="78" rx="10" />
              <rect x="34" y="154" width="84" height="94" rx="10" /><rect x="352" y="154" width="94" height="94" rx="10" />
              <rect x="34" y="280" width="120" height="76" rx="10" /><rect x="186" y="280" width="96" height="76" rx="10" /><rect x="314" y="280" width="132" height="76" rx="10" />
            </g>
            <rect x="150" y="154" width="170" height="94" rx="14" fill="#C8E6C9" />
            <circle cx="180" cy="186" r="12" fill="#81C784" /><circle cx="292" cy="220" r="11" fill="#81C784" />
            <g stroke="#FFFFFF" stroke-width="2" stroke-dasharray="8 8" fill="none"><path d="M10 138 H470" /><path d="M10 264 H470" /><path d="M170 20 V380" /><path d="M298 20 V380" /></g>
            <!-- area jangkauan -->
            <circle cx="234" cy="200" r="120" fill="#1E88E5" opacity=".1" />
            <circle cx="234" cy="200" r="120" fill="none" stroke="#1E88E5" stroke-width="2" stroke-dasharray="6 6" opacity=".5" />
            <circle class="ring" cx="234" cy="200" r="56" fill="none" stroke="#FF6F3C" stroke-width="3" />
            <circle class="ring r2" cx="234" cy="200" r="56" fill="none" stroke="#FF6F3C" stroke-width="3" />
            <!-- provider di sekitar -->
            <g font-family="Poppins, sans-serif" font-weight="800" font-size="10" fill="#fff" text-anchor="middle">
              <g class="float"><rect x="70" y="66" width="34" height="34" rx="10" fill="#FF6F3C" /><text x="87" y="87">M3</text></g>
              <g class="float" style="animation-delay:-1.5s"><rect x="370" y="70" width="34" height="34" rx="10" fill="#0F2A4A" /><text x="387" y="91">CO</text></g>
            </g>
            <!-- pin utama -->
            <ellipse cx="234" cy="206" rx="16" ry="5" fill="#0D2B4E" opacity=".2" />
            <g class="float">
              <path d="M234 204 c-4-10-30-30-30-52 a30 30 0 0 1 60 0 c0 22-26 42-30 52z" fill="#FF6F3C" />
              <circle cx="234" cy="151" r="15" fill="#FFFFFF" />
              <circle cx="234" cy="151" r="6" fill="#1E88E5" />
            </g>
            <g transform="translate(290 300)">
              <rect width="160" height="56" rx="12" fill="#FFFFFF" />
              <circle cx="26" cy="28" r="14" fill="#E8F8EF" />
              <path d="M20 28 l4 4 8 -8" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
              <text x="48" y="25" font-family="Poppins, sans-serif" font-weight="700" font-size="13" fill="#0D2B4E">2 Provider</text>
              <text x="48" y="41" font-family="Poppins, sans-serif" font-size="11" fill="#8A94A6">tersedia di sini</text>
            </g>
          </svg>
        </div>

        <!-- form -->
        <div class="coverage-copy reveal d1">
          <span class="eyebrow"><svg aria-hidden="true"><use href="#i-pin" /></svg>Cek Jangkauan</span>
          <h2>Provider Apa Saja yang Ada di Lokasimu?</h2>
          <p>Masukkan alamat dan kami tampilkan daftar provider yang sudah menjangkau area kamu.</p>

          <form class="coverage-form" id="coverageForm" novalidate>
            <div class="form-row">
              <div class="field">
                <label for="covCity">Kota / Kabupaten</label>
                <select id="covCity" required><option value="">Pilih kota</option></select>
              </div>
              <div class="field">
                <label for="covDistrict">Kecamatan</label>
                <input id="covDistrict" type="text" placeholder="Contoh: Coblong" required />
              </div>
            </div>
            <div class="field">
              <label for="covAddress">Alamat <span style="color:var(--gray);font-weight:400">(opsional)</span></label>
              <input id="covAddress" type="text" placeholder="Nama jalan, nomor rumah" />
            </div>
            <button type="submit" class="btn btn-orange btn-block" id="covBtn">
              <svg aria-hidden="true"><use href="#i-search" /></svg><span>Cek Provider Tersedia</span>
            </button>
            <div class="cov-result" id="covResult" aria-live="polite"></div>
          </form>
        </div>
      </div>

      <svg class="wave bottom" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 50 C240 0 480 80 720 50 S1200 0 1440 50 V80 H0z" fill="#FFFFFF" />
      </svg>
    </section>

    <!-- =========================================================
         6. PROMO TERBARU
         ========================================================= -->
    <section class="section" id="promo">
      <div class="container">
        <div class="promo-head reveal">
          <div class="section-head">
            <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12V4a1 1 0 0 1 1-1h8l9 9-9 9z" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round" /><circle cx="8" cy="8" r="1.8" fill="currentColor" /></svg>Promo Terbaru</span>
            <h2>Promo Spesial dari Provider</h2>
            <p>Penawaran terbatas yang diperbarui setiap minggu.</p>
          </div>
          <div class="carousel-nav">
            <button class="icon-btn" id="promoPrev" type="button" aria-label="Promo sebelumnya"><svg viewBox="0 0 24 24"><path d="M15 6l-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
            <button class="icon-btn" id="promoNext" type="button" aria-label="Promo berikutnya"><svg viewBox="0 0 24 24"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
          </div>
        </div>
        <div class="promo-track reveal d1" id="promoTrack"><!-- diisi JS --></div>
        <div class="carousel-dots" id="promoDots"></div>
      </div>
    </section>

    <!-- =========================================================
         7. CARA KERJA
         ========================================================= -->
    <section class="section how" id="cara">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2.2" /><path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" /></svg>Cara Kerja</span>
          <h2>Cara Kerja KoneksiKu</h2>
          <p>Tiga langkah sederhana untuk menemukan internet yang paling cocok.</p>
        </div>
        <div class="how-grid">
          <div class="how-line" aria-hidden="true"></div>
          <div class="how-step reveal">
            <div class="how-icon">
              <span class="how-num">1</span>
              <svg viewBox="0 0 76 76" aria-hidden="true">
                <rect width="76" height="76" rx="22" fill="#E3F2FD" />
                <path d="M38 60s16-13 16-26a16 16 0 0 0-32 0c0 13 16 26 16 26z" fill="#1E88E5" />
                <circle cx="38" cy="34" r="6" fill="#fff" />
                <ellipse cx="38" cy="62" rx="12" ry="3" fill="#FF6F3C" opacity=".5" />
              </svg>
            </div>
            <h3>Masukkan Lokasi</h3>
            <p>Ketik kota atau kecamatanmu untuk melihat provider yang tersedia.</p>
          </div>
          <div class="how-step reveal d1">
            <div class="how-icon">
              <span class="how-num">2</span>
              <svg viewBox="0 0 76 76" aria-hidden="true">
                <rect width="76" height="76" rx="22" fill="#FFE9E0" />
                <rect x="14" y="20" width="20" height="36" rx="5" fill="#fff" stroke="#FF6F3C" stroke-width="3" />
                <rect x="42" y="20" width="20" height="36" rx="5" fill="#fff" stroke="#1E88E5" stroke-width="3" />
                <path d="M19 30h10M19 37h7M47 30h10M47 37h7" stroke="#8A94A6" stroke-width="2.5" stroke-linecap="round" />
                <circle cx="38" cy="38" r="8" fill="#0D2B4E" />
                <path d="M35 38h6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" />
              </svg>
            </div>
            <h3>Bandingkan Paket</h3>
            <p>Lihat harga, kecepatan, FUP, dan biaya pasang secara berdampingan.</p>
          </div>
          <div class="how-step reveal d2">
            <div class="how-icon">
              <span class="how-num">3</span>
              <svg viewBox="0 0 76 76" aria-hidden="true">
                <rect width="76" height="76" rx="22" fill="#E3F2FD" />
                <rect x="14" y="18" width="48" height="38" rx="6" fill="#fff" stroke="#0D2B4E" stroke-width="3" />
                <path d="M14 27h48" stroke="#0D2B4E" stroke-width="3" />
                <circle cx="20" cy="22.5" r="1.8" fill="#FF6F3C" /><circle cx="26" cy="22.5" r="1.8" fill="#4FC3F7" />
                <rect x="24" y="38" width="28" height="9" rx="4.5" fill="#FF6F3C" />
                <path d="M44 50l6 10 2-5 5-2z" fill="#0D2B4E" />
              </svg>
            </div>
            <h3>Langganan di Website Provider</h3>
            <p>Klik "Kunjungi Website" dan selesaikan pendaftaran langsung di provider.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================================================
         8. FAQ
         ========================================================= -->
    <section class="section" id="bantuan">
      <div class="container faq-grid">
        <div class="faq-side reveal">
          <span class="eyebrow"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2.2" /><path d="M9.5 9.5a2.5 2.5 0 1 1 3.5 2.3c-.6.3-1 .8-1 1.5v.7" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" /><circle cx="12" cy="17" r="1.2" fill="currentColor" /></svg>Bantuan</span>
          <h2>Pertanyaan Seputar KoneksiKu</h2>
          <p>Masih bingung memilih? Temukan jawabannya di sini.</p>
          <svg class="faq-illus" viewBox="0 0 320 220" aria-hidden="true">
            <ellipse cx="160" cy="204" rx="130" ry="12" fill="#E3F2FD" />
            <g class="float">
              <rect x="16" y="20" width="92" height="56" rx="16" fill="#E3F2FD" />
              <path d="M50 76l-8 14 20-14z" fill="#E3F2FD" />
              <text x="62" y="60" text-anchor="middle" font-family="Poppins, sans-serif" font-size="32" font-weight="800" fill="#FF6F3C">?</text>
            </g>
            <g class="float" style="animation-delay:-2.5s">
              <rect x="220" y="34" width="84" height="46" rx="14" fill="#1E88E5" />
              <path d="M236 57l7 7 14-14" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
              <rect x="264" y="52" width="28" height="5" rx="2.5" fill="#BBDEFB" />
            </g>
            <!-- orang dengan kaca pembesar -->
            <path d="M120 200v-50a40 40 0 0 1 80 0v50z" fill="#0D2B4E" />
            <rect x="152" y="112" width="16" height="16" rx="4" fill="#D9A07A" />
            <circle cx="160" cy="94" r="24" fill="#D9A07A" />
            <path d="M136 92c0-22 14-28 26-28 14 0 24 10 22 28-6-8-14-12-24-12s-18 4-24 12z" fill="#1B1B2F" />
            <circle cx="152" cy="98" r="2.3" fill="#0D2B4E" /><circle cx="168" cy="98" r="2.3" fill="#0D2B4E" />
            <path d="M154 108q6 4 12 0" fill="none" stroke="#7A4A2A" stroke-width="2.2" stroke-linecap="round" />
            <path d="M196 150q22-10 28-34" stroke="#0D2B4E" stroke-width="13" stroke-linecap="round" fill="none" />
            <circle cx="232" cy="100" r="18" fill="#fff" stroke="#FF6F3C" stroke-width="6" />
            <path d="M226 94a8 8 0 0 1 8-4" fill="none" stroke="#4FC3F7" stroke-width="3" stroke-linecap="round" />
          </svg>
        </div>

        <div class="accordion reveal d1">
          <div class="acc-item open">
            <button class="acc-btn" aria-expanded="true">Bagaimana cara memilih provider internet yang tepat?<span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span></button>
            <div class="acc-panel"><p>Mulai dari lokasi: pastikan provider sudah menjangkau alamatmu. Lalu sesuaikan kecepatan dengan jumlah perangkat (sekitar 5 Mbps per perangkat aktif), cek ada tidaknya FUP, biaya pemasangan, dan kualitas layanan pelanggan.</p></div>
          </div>
          <div class="acc-item">
            <button class="acc-btn" aria-expanded="false">Apa bedanya internet fiber dan wireless?<span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span></button>
            <div class="acc-panel"><p>Fiber memakai kabel serat optik sampai ke rumah sehingga lebih stabil, latensi rendah, dan bisa sangat cepat. Wireless mengirim sinyal lewat udara dari menara terdekat; pemasangan lebih cepat dan menjangkau area tanpa kabel, tapi bisa terpengaruh cuaca dan penghalang.</p></div>
          </div>
          <div class="acc-item">
            <button class="acc-btn" aria-expanded="false">Apakah KoneksiKu memungut biaya?<span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span></button>
            <div class="acc-panel"><p>Tidak. KoneksiKu gratis digunakan. Harga yang kamu bayar sama persis dengan harga di website resmi provider karena pendaftaran dilakukan langsung di sana.</p></div>
          </div>
          <div class="acc-item">
            <button class="acc-btn" aria-expanded="false">Seberapa akurat data harga dan jangkauan?<span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span></button>
            <div class="acc-panel"><p>Data diperbarui berkala dari masing-masing provider. Namun ketersediaan akhir tetap dikonfirmasi oleh provider setelah survei lokasi, jadi selalu cek ulang di website resmi mereka.</p></div>
          </div>
          <div class="acc-item">
            <button class="acc-btn" aria-expanded="false">Bagaimana jika provider saya belum terdaftar?<span class="plus"><svg viewBox="0 0 16 16"><path d="M8 2v12M2 8h12" stroke="#1E88E5" stroke-width="2.4" stroke-linecap="round" /></svg></span></button>
            <div class="acc-panel"><p>Kami terus menambah mitra. Kamu bisa mengusulkan provider lewat email bantuan, dan provider juga bisa mendaftar sebagai mitra melalui halaman kontak.</p></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- =========================================================
       FOOTER
       ========================================================= -->
  <footer class="footer">
    <div class="container footer-grid">
      <div>
        <a href="#beranda" class="logo">
          <span class="logo-icon">
            <svg viewBox="0 0 26 26" aria-hidden="true">
              <path d="M6 7l7 6 7-6M13 13v7M6 7l-1 10 8 3 8-3-1-10" fill="none" stroke="#BBDEFB" stroke-width="1.6" stroke-linejoin="round" />
              <circle cx="6" cy="7" r="2.6" fill="#fff" /><circle cx="20" cy="7" r="2.6" fill="#fff" />
              <circle cx="5" cy="17" r="2.2" fill="#4FC3F7" /><circle cx="21" cy="17" r="2.2" fill="#4FC3F7" /><circle cx="13" cy="20" r="2.2" fill="#4FC3F7" />
              <circle cx="13" cy="13" r="3.4" fill="#FF6F3C" />
            </svg>
          </span>
          <span>Koneksi<span class="ku">Ku</span></span>
        </a>
        <p>Portal pembanding provider internet. Bantu kamu menemukan paket terbaik berdasarkan lokasi, kebutuhan, dan budget.</p>
        <div class="socials">
          <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="#fff" stroke-width="2" /><circle cx="12" cy="12" r="4" fill="none" stroke="#fff" stroke-width="2" /><circle cx="17.3" cy="6.7" r="1.2" fill="#fff" /></svg></a>
          <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v8h4v-8h3l1-4h-4V8.5a.5.5 0 0 1 .5-.5z" fill="#fff" /></svg></a>
          <a href="#" aria-label="X / Twitter"><svg viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20" stroke="#fff" stroke-width="2.4" stroke-linecap="round" /></svg></a>
          <a href="#" aria-label="TikTok"><svg viewBox="0 0 24 24"><path d="M14 3v11.5a3.5 3.5 0 1 1-3-3.46V7.5A7 7 0 1 0 18 14V8.5a6 6 0 0 0 3 1V6a4 4 0 0 1-4-3z" fill="#fff" /></svg></a>
          <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="4" fill="#fff" /><path d="M10 9l5 3-5 3z" fill="#0A2240" /></svg></a>
        </div>
      </div>
      <div>
        <h4>Provider</h4>
        <ul id="footerProviders"><!-- diisi JS --></ul>
      </div>
      <div>
        <h4>Bantuan</h4>
        <ul>
          <li><a href="#bantuan">FAQ</a></li>
          <li><a href="#cara">Cara Kerja</a></li>
          <li><a href="#jangkauan">Cek Jangkauan</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
          <li><a href="#">Jadi Mitra Provider</a></li>
        </ul>
      </div>
      <div>
        <h4>Kontak</h4>
        <ul class="contact-list">
          <li><svg viewBox="0 0 24 24" style="color:#25D366" aria-hidden="true"><use href="#i-wa" /></svg><a href="https://wa.me/6287844690552" target="_blank" rel="noopener">0878-4469-0552 (WhatsApp)</a></li>
        </ul>
      </div>
    </div>
    <div class="container footer-bottom">
      <span>© 2026 KoneksiKu by Ramos. Semua hak dilindungi.</span>
      <span>Dikembangkan oleh <b style="color:#fff">Ramos</b></span>
    </div>
  </footer>

  <!-- Overlay, bar bandingkan, modal, toast -->
  <div class="overlay" id="overlay"></div>

  <div class="compare-bar" id="compareBar" role="region" aria-label="Provider yang dipilih untuk dibandingkan">
    <div class="compare-logos" id="compareLogos"></div>
    <span class="compare-text" id="compareText"></span>
    <button class="link-btn" id="compareClear" type="button">Hapus</button>
    <button class="btn btn-orange btn-sm" id="compareOpen" type="button">
      <svg aria-hidden="true"><use href="#i-compare" /></svg>Bandingkan Sekarang
    </button>
  </div>

  <div class="modal" id="compareModal" role="dialog" aria-modal="true" aria-labelledby="compareTitle">
    <div class="modal-box">
      <div class="modal-head">
        <h3 id="compareTitle">Perbandingan Provider</h3>
        <button class="icon-btn" id="modalClose" type="button" aria-label="Tutup"><svg><use href="#i-close" /></svg></button>
      </div>
      <div class="modal-body" id="compareBody"></div>
    </div>
  </div>

  <div class="toast" id="toast" role="status"></div>

  {{-- Harga, kecepatan & URL provider dihitung dari database (lihat PageController::home) --}}
  <script>window.SITE_DATA = @json($providers);</script>
  @verbatim
  <script>
    /* =========================================================
       DATA PROVIDER (tambah provider baru cukup di array ini)
       ========================================================= */
    const PROVIDERS = [
      // Web2 → halaman M3
      { id: 'm3', name: 'M3', color: '#FF6F3C', type: 'Fiber', price: 150000, speedMin: 20, speedMax: 100,
        unlimited: true, freeInstall: true, support24: true, fup: 'Tanpa FUP', installFee: 0,
        cities: ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Medan', 'Makassar', 'Denpasar'],
        support: '24 jam (WhatsApp)', popularity: 98, recommended: true, url: '#' },
      // Web1 → halaman CentrinOnline
      { id: 'centrin', name: 'CentrinOnline', color: '#0F2A4A', type: 'Fiber', price: 209000, speedMin: 50, speedMax: 200,
        unlimited: true, freeInstall: true, support24: true, fup: 'Tanpa batas kuota (FUP wajar)', installFee: 0,
        cities: ['Surabaya', 'Sidoarjo', 'Gresik'],
        support: '24 jam (WA Customer Care)', popularity: 90, url: '#' },
    ];
    // Timpa dengan data terbaru dari server (harga termurah, rentang kecepatan, URL halaman).
    PROVIDERS.forEach((p) => Object.assign(p, (window.SITE_DATA || {})[p.id] || {}));

    const PROMOS = [
      { pid: 'm3', title: 'M3: Gratis biaya pasang bulan ini', desc: 'Daftar paket apa pun dan hemat biaya instalasi. Router dual-band sudah termasuk.', big: 'GRATIS', small: 'Biaya pasang · s/d 31 Okt 2026' },
      { pid: 'centrin', title: 'CentrinOnline: Bundling 3+1 & 5+2', desc: 'Bayar sekaligus beberapa bulan, dapat bonus bulan gratis. Khusus area Surabaya.', big: '+2 BLN', small: 'Bonus bulan gratis · Surabaya' },
      { pid: 'm3', title: 'M3 Bisnis: Kecepatan simetris', desc: 'Paket bisnis dengan IP publik dan SLA, cocok untuk kantor dan kafe.', big: 'BISNIS', small: 'Mulai Rp350.000/bln' },
      { pid: 'centrin', title: 'CentrinOnline: Bayar setelah pasang', desc: 'Tanpa deposit dan gratis biaya pasang. Internet langsung aktif, baru bayar.', big: 'Rp0', small: 'Deposit · langsung aktif' },
    ];

    /* =========================================================
       HELPER
       ========================================================= */
    const $ = (s, el = document) => el.querySelector(s);
    const $$ = (s, el = document) => [...el.querySelectorAll(s)];
    const rupiah = (n) => 'Rp' + n.toLocaleString('id-ID');
    const speedText = (mbps) => (mbps >= 1000 ? mbps / 1000 + ' Gbps' : mbps + ' Mbps');
    const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const initials = (name) => name.replace(/[^A-Z0-9]/g, '').slice(0, 2) || name.slice(0, 2).toUpperCase();
    const logo = (p, size = '') => `<span class="p-logo ${size}" style="background:${p.color}">${initials(p.name)}</span>`;
    const byId = (id) => PROVIDERS.find((p) => p.id === id);
    const linkAttrs = (p) => (p.url === '#' ? 'href="#" data-placeholder="1"' : `href="${p.url}"`);

    const ALL_CITIES = [...new Set(PROVIDERS.flatMap((p) => (p.nationwide ? [] : p.cities)))].sort();
    const coversCity = (p, city) => p.nationwide || p.cities.some((c) => c.toLowerCase() === city.toLowerCase());

    let toastTimer;
    const toast = (msg) => {
      const t = $('#toast');
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => t.classList.remove('show'), 2600);
    };

    /* =========================================================
       NAVBAR + SCROLLSPY + REVEAL
       ========================================================= */
    const navbar = $('#navbar');
    const hamburger = $('#hamburger');
    const navMenu = $('#navMenu');
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
    $$('a', navMenu).forEach((a) => a.addEventListener('click', () => setMenu(false)));

    const spyLinks = $$('.nav-link:not([data-action])');
    const spy = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) spyLinks.forEach((l) => l.classList.toggle('active', l.getAttribute('href') === '#' + e.target.id));
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    spyLinks.map((l) => $(l.getAttribute('href'))).filter(Boolean).forEach((s) => spy.observe(s));

    const revealer = new IntersectionObserver((entries, obs) => {
      entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.12 });
    $$('.reveal').forEach((el) => revealer.observe(el));

    // tombol yang belum punya halaman (Masuk/Daftar, provider tanpa website)
    document.addEventListener('click', (e) => {
      const soon = e.target.closest('[data-soon]');
      if (soon) { e.preventDefault(); toast(`Fitur ${soon.dataset.soon} segera hadir 🚀`); return; }
      const ph = e.target.closest('[data-placeholder]');
      if (ph) { e.preventDefault(); toast('Website provider ini segera hadir.'); }
    });

    /* =========================================================
       2. MARQUEE LOGO MITRA
       ========================================================= */
    const partnerHTML = PROVIDERS.map((p) => `<a class="partner" ${linkAttrs(p)}>${logo(p, 'sm')}${esc(p.name)}</a>`).join('');
    // hanya 2 provider: ulangi agar strip marquee tetap penuh
    const half = partnerHTML.repeat(4);
    $('#marqueeTrack').innerHTML = half + half.replace(/<a /g, '<a aria-hidden="true" tabindex="-1" ');

    /* =========================================================
       3. DAFTAR PROVIDER: filter, urutkan, tampilan
       ========================================================= */
    const state = {
      maxPrice: 400000,
      minSpeed: 0,
      types: new Set(),
      features: new Set(),
      city: '',
      sort: 'popular',
      view: 'grid',
      compare: new Set(),
    };

    // checkbox jenis koneksi dibuat dari data
    const TYPES = ['Fiber', 'Wireless', 'Satelit'];
    $('#typeChecks').innerHTML = TYPES.map((t) => `
      <label class="check"><input type="checkbox" name="type" value="${t}" /><span class="box"><svg><use href="#i-tick" /></svg></span>${t}
        <span class="count">${PROVIDERS.filter((p) => p.type === t).length}</span></label>`).join('');

    const FEATURE_LABELS = { unlimited: 'Unlimited', freeInstall: 'Pemasangan Gratis', support24: 'Support 24/7' };

    const applyFilters = () => {
      const list = PROVIDERS.filter((p) =>
        p.price <= state.maxPrice &&
        p.speedMax >= state.minSpeed &&
        (state.types.size === 0 || state.types.has(p.type)) &&
        [...state.features].every((f) => p[f]) &&
        (!state.city || coversCity(p, state.city))
      );
      const sorters = {
        cheap: (a, b) => a.price - b.price,
        fast: (a, b) => b.speedMax - a.speedMax,
        popular: (a, b) => b.popularity - a.popularity,
      };
      return list.sort(sorters[state.sort]);
    };

    const cardFeatures = (p) => {
      const f = [];
      f.push(p.unlimited ? 'Unlimited tanpa FUP' : p.fup);
      f.push(p.freeInstall ? 'Pemasangan gratis' : `Biaya pasang ${rupiah(p.installFee)}`);
      f.push(p.support24 ? 'Support 24/7' : `Support ${p.support.split(' ')[0]}`);
      return f;
    };

    const typeIcon = { Fiber: '〰', Wireless: '📶', Satelit: '🛰' };

    const providerCard = (p, i) => `
      <article class="p-card ${p.recommended ? 'recommended' : ''} ${state.compare.has(p.id) ? 'selected' : ''}" style="animation-delay:${i * 60}ms">
        ${p.recommended ? '<span class="ribbon"><svg><use href="#i-star" /></svg>Rekomendasi</span>' : ''}
        <div class="p-head">
          ${logo(p, 'lg')}
          <div>
            <h3>${esc(p.name)}</h3>
            <span class="type-badge type-${p.type}">${typeIcon[p.type]} ${p.type}</span>
          </div>
        </div>
        <div class="p-meta">
          <div class="p-speed">
            <small>Kecepatan</small>
            <b>${p.speedMin}–${speedText(p.speedMax)}</b>
          </div>
          <div class="p-price"><small>Mulai dari</small><b>${rupiah(p.price)}<span>/bln</span></b></div>
        </div>
        <ul class="p-features">
          ${cardFeatures(p).map((f) => `<li><svg><use href="#i-check" /></svg>${esc(f)}</li>`).join('')}
        </ul>
        <div class="p-foot">
          <label class="check"><input type="checkbox" data-compare="${p.id}" ${state.compare.has(p.id) ? 'checked' : ''} /><span class="box"><svg><use href="#i-tick" /></svg></span>Bandingkan</label>
          <a class="btn ${p.recommended ? 'btn-orange' : 'btn-blue'} btn-sm" ${linkAttrs(p)}>Kunjungi Website<svg><use href="#i-ext" /></svg></a>
        </div>
      </article>`;

    const grid = $('#providerGrid');

    const renderTags = () => {
      const tags = [];
      if (state.city) tags.push(['city', `📍 ${state.city}`]);
      if (state.maxPrice < 400000) tags.push(['price', `≤ ${rupiah(state.maxPrice)}`]);
      if (state.minSpeed) tags.push(['speed', `≥ ${state.minSpeed} Mbps`]);
      state.types.forEach((t) => tags.push(['type:' + t, t]));
      state.features.forEach((f) => tags.push(['feat:' + f, FEATURE_LABELS[f]]));
      $('#activeTags').innerHTML = tags.map(([k, label]) =>
        `<span class="tag">${esc(label)}<button type="button" data-untag="${k}" aria-label="Hapus filter ${esc(label)}">✕</button></span>`).join('');
    };

    const render = () => {
      const list = applyFilters();
      grid.classList.toggle('list', state.view === 'list');
      grid.innerHTML = list.length
        ? list.map(providerCard).join('')
        : `<div class="empty-state">
            <svg viewBox="0 0 140 100" aria-hidden="true"><ellipse cx="70" cy="90" rx="50" ry="6" fill="#E3F2FD"/><circle cx="62" cy="46" r="30" fill="#fff" stroke="#1E88E5" stroke-width="6"/><path d="M84 68l22 20" stroke="#0D2B4E" stroke-width="9" stroke-linecap="round"/><path d="M52 40l20 12M72 40L52 52" stroke="#FF6F3C" stroke-width="5" stroke-linecap="round"/></svg>
            <h3>Tidak ada provider yang cocok</h3><p>Coba longgarkan filter harga atau kecepatan.</p>
            <button class="btn btn-blue" type="button" data-reset>Reset Filter</button>
          </div>`;
      const n = list.length;
      $('#resultCount').innerHTML = `Menampilkan <b>${n}</b> dari ${PROVIDERS.length} provider${state.city ? ` di <b>${esc(state.city)}</b>` : ''}`;
      $('#applyCount').textContent = n;
      renderTags();
    };

    // slider harga
    const priceRange = $('#priceRange');
    const syncPrice = () => {
      state.maxPrice = +priceRange.value;
      $('#priceLabel').textContent = 's/d ' + rupiah(state.maxPrice);
      const pct = ((priceRange.value - priceRange.min) / (priceRange.max - priceRange.min)) * 100;
      priceRange.style.setProperty('--fill', pct + '%');
    };
    priceRange.addEventListener('input', () => { syncPrice(); render(); });

    // semua input filter lain (event delegation)
    $('#filterPanel').addEventListener('change', (e) => {
      const el = e.target;
      if (el.name === 'speed') state.minSpeed = +el.value;
      if (el.name === 'type') el.checked ? state.types.add(el.value) : state.types.delete(el.value);
      if (el.name === 'feat') el.checked ? state.features.add(el.value) : state.features.delete(el.value);
      render();
    });

    const resetFilters = () => {
      priceRange.value = 400000; syncPrice();
      state.minSpeed = 0; state.types.clear(); state.features.clear(); state.city = '';
      $$('#filterPanel input[type=checkbox]').forEach((c) => (c.checked = false));
      $('#filterPanel input[name=speed][value="0"]').checked = true;
      render();
    };
    $('#resetFilter').addEventListener('click', resetFilters);

    // hapus satu filter dari tag
    $('#activeTags').addEventListener('click', (e) => {
      const k = e.target.dataset.untag;
      if (!k) return;
      if (k === 'city') state.city = '';
      if (k === 'price') { priceRange.value = 400000; syncPrice(); }
      if (k === 'speed') { state.minSpeed = 0; $('#filterPanel input[name=speed][value="0"]').checked = true; }
      if (k.startsWith('type:')) { const v = k.slice(5); state.types.delete(v); $(`#filterPanel input[name=type][value="${v}"]`).checked = false; }
      if (k.startsWith('feat:')) { const v = k.slice(5); state.features.delete(v); $(`#filterPanel input[name=feat][value="${v}"]`).checked = false; }
      render();
    });

    $('#sortSelect').addEventListener('change', (e) => { state.sort = e.target.value; render(); });

    $$('[data-view]').forEach((b) => b.addEventListener('click', () => {
      state.view = b.dataset.view;
      $$('[data-view]').forEach((x) => x.classList.toggle('active', x === b));
      render();
    }));

    // panel filter mobile (geser dari bawah)
    const overlay = $('#overlay');
    const filterPanel = $('#filterPanel');
    const setFilterPanel = (open) => {
      filterPanel.classList.toggle('open', open);
      overlay.classList.toggle('show', open);
      document.body.classList.toggle('lock', open);
    };
    $('#filterOpen').addEventListener('click', () => setFilterPanel(true));
    $('#filterClose').addEventListener('click', () => setFilterPanel(false));
    $('#filterApply').addEventListener('click', () => setFilterPanel(false));

    /* =========================================================
       4. BANDINGKAN
       ========================================================= */
    const MAX_COMPARE = 3;
    const compareBar = $('#compareBar');

    const updateCompareBar = () => {
      const ids = [...state.compare];
      $('#compareLogos').innerHTML = ids.map((id) => logo(byId(id), 'sm')).join('');
      $('#compareText').innerHTML = ids.length < 2
        ? `<b>${ids.length}</b> provider dipilih — pilih minimal 2`
        : `<b>${ids.length}</b> provider dipilih`;
      $('#compareOpen').disabled = ids.length < 2;
      $('#compareOpen').style.opacity = ids.length < 2 ? '.5' : '1';
      compareBar.classList.toggle('show', ids.length > 0);
    };

    grid.addEventListener('change', (e) => {
      const id = e.target.dataset.compare;
      if (!id) return;
      if (e.target.checked) {
        if (state.compare.size >= MAX_COMPARE) {
          e.target.checked = false;
          toast(`Maksimal ${MAX_COMPARE} provider untuk dibandingkan.`);
          return;
        }
        state.compare.add(id);
      } else {
        state.compare.delete(id);
      }
      e.target.closest('.p-card').classList.toggle('selected', e.target.checked);
      updateCompareBar();
    });
    grid.addEventListener('click', (e) => { if (e.target.closest('[data-reset]')) resetFilters(); });

    $('#compareClear').addEventListener('click', () => {
      state.compare.clear();
      $$('[data-compare]').forEach((c) => (c.checked = false));
      $$('.p-card.selected').forEach((c) => c.classList.remove('selected'));
      updateCompareBar();
    });

    const modal = $('#compareModal');
    let lastFocus = null;
    const openModal = () => {
      const items = [...state.compare].map(byId);
      const minPrice = Math.min(...items.map((p) => p.price));
      const maxSpeed = Math.max(...items.map((p) => p.speedMax));
      const minFee = Math.min(...items.map((p) => p.installFee));
      const row = (label, fn) => `<tr><td>${label}</td>${items.map((p) => `<td>${fn(p)}</td>`).join('')}</tr>`;
      $('#compareBody').innerHTML = `
        <table class="compare-table">
          <thead><tr><th></th>${items.map((p) => `<th>${logo(p, 'lg')}${esc(p.name)}<br><span class="type-badge type-${p.type}">${p.type}</span></th>`).join('')}</tr></thead>
          <tbody>
            ${row('Harga mulai', (p) => `<span class="${p.price === minPrice ? 'best' : ''}">${rupiah(p.price)}/bln</span>`)}
            ${row('Kecepatan maksimum', (p) => `<span class="${p.speedMax === maxSpeed ? 'best' : ''}">${speedText(p.speedMax)}</span>`)}
            ${row('FUP', (p) => p.unlimited ? '<span class="best">Tanpa FUP</span>' : p.fup)}
            ${row('Biaya pasang', (p) => `<span class="${p.installFee === minFee ? 'best' : ''}">${p.installFee ? rupiah(p.installFee) : 'Gratis'}</span>`)}
            ${row('Jangkauan', (p) => p.nationwide ? 'Seluruh Indonesia' : `${p.cities.length} kota`)}
            ${row('Layanan pelanggan', (p) => esc(p.support))}
            ${row('', (p) => `<a class="btn ${p.recommended ? 'btn-orange' : 'btn-blue'} btn-sm" ${linkAttrs(p)}>Kunjungi Website</a>`)}
          </tbody>
        </table>`;
      lastFocus = document.activeElement;
      modal.classList.add('show');
      overlay.classList.add('show');
      document.body.classList.add('lock');
      $('#modalClose').focus();
    };
    const closeModal = () => {
      if (!modal.classList.contains('show')) return;
      modal.classList.remove('show');
      overlay.classList.remove('show');
      document.body.classList.remove('lock');
      lastFocus?.focus();
    };
    $('#compareOpen').addEventListener('click', openModal);
    $('#modalClose').addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    overlay.addEventListener('click', () => { closeModal(); setFilterPanel(false); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') { closeModal(); setFilterPanel(false); setMenu(false); } });

    // link "Bandingkan" di navbar
    $('[data-action="compare"]').addEventListener('click', (e) => {
      if (state.compare.size >= 2) { e.preventDefault(); openModal(); }
      else setTimeout(() => toast('Centang kedua provider di daftar untuk dibandingkan.'), 400);
    });

    /* =========================================================
       HERO SEARCH: lokasi + kebutuhan → filter daftar provider
       ========================================================= */
    $('#cityList').innerHTML = ALL_CITIES.map((c) => `<option value="${c}">`).join('');
    const NEED_PRESETS = {
      rumah:  { minSpeed: 20, features: [] },
      kos:    { minSpeed: 10, features: [], maxPrice: 200000 },
      bisnis: { minSpeed: 50, features: ['support24'] },
      gaming: { minSpeed: 100, features: ['unlimited'], types: ['Fiber'] },
    };
    $('#heroSearch').addEventListener('submit', (e) => {
      e.preventDefault();
      resetFilters();
      const loc = $('#heroLoc').value.trim();
      const match = ALL_CITIES.find((c) => loc.toLowerCase().includes(c.toLowerCase()));
      state.city = match || '';
      const preset = NEED_PRESETS[$('#heroNeed').value];
      state.minSpeed = preset.minSpeed;
      $(`#filterPanel input[name=speed][value="${preset.minSpeed}"]`).checked = true;
      preset.features.forEach((f) => { state.features.add(f); $(`#filterPanel input[name=feat][value="${f}"]`).checked = true; });
      (preset.types || []).forEach((t) => { state.types.add(t); $(`#filterPanel input[name=type][value="${t}"]`).checked = true; });
      if (preset.maxPrice) { priceRange.value = preset.maxPrice; syncPrice(); }
      render();
      if (loc && !match) toast(`"${loc}" belum ada di data kami, menampilkan semua lokasi.`);
      $('#provider').scrollIntoView();
    });

    /* =========================================================
       5. CEK JANGKAUAN
       ========================================================= */
    $('#covCity').insertAdjacentHTML('beforeend', ALL_CITIES.map((c) => `<option>${c}</option>`).join(''));
    const covForm = $('#coverageForm');
    const covResult = $('#covResult');
    const covBtn = $('#covBtn');

    covForm.addEventListener('submit', (e) => {
      e.preventDefault();
      let ok = true;
      $$('[required]', covForm).forEach((el) => {
        const bad = !el.value.trim();
        el.closest('.field').classList.toggle('invalid', bad);
        if (bad) ok = false;
      });
      if (!ok) return toast('Lengkapi kota dan kecamatan terlebih dahulu.');

      const city = $('#covCity').value;
      const district = $('#covDistrict').value.trim();
      const label = $('span', covBtn);
      covBtn.style.pointerEvents = 'none';
      label.textContent = 'Mencari...';
      covResult.classList.remove('show');

      setTimeout(() => {
        covBtn.style.pointerEvents = '';
        label.textContent = 'Cek Provider Tersedia';
        // provider rekomendasi di atas, lalu berdasarkan popularitas
        const found = PROVIDERS.filter((p) => coversCity(p, city))
          .sort((a, b) => (b.recommended ? 1 : 0) - (a.recommended ? 1 : 0) || b.popularity - a.popularity);
        covResult.innerHTML = `
          <div class="cov-summary">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#25D366"/><path d="M7 12.5l3 3 7-7" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span><b>${found.length} provider</b> tersedia di ${esc(district)}, ${esc(city)}</span>
          </div>
          <div class="cov-list">
            ${found.map((p) => `
              <div class="cov-item ${p.recommended ? 'rec' : ''}">
                ${logo(p)}
                <div class="info"><b>${esc(p.name)} ${p.recommended ? '<span style="color:var(--orange);font-size:.75rem">★ Rekomendasi</span>' : ''}</b>
                  <small>${p.type} · ${p.speedMin}–${speedText(p.speedMax)} · mulai ${rupiah(p.price)}/bln</small></div>
                <a class="btn ${p.recommended ? 'btn-orange' : 'btn-ghost'} btn-sm" ${linkAttrs(p)}>Website</a>
              </div>`).join('')}
          </div>`;
        covResult.classList.add('show');
      }, 800);
    });
    $$('[required]', covForm).forEach((el) => el.addEventListener('input', () => el.closest('.field').classList.remove('invalid')));

    /* =========================================================
       6. PROMO CAROUSEL
       ========================================================= */
    const track = $('#promoTrack');
    track.innerHTML = PROMOS.map((pr) => {
      const p = byId(pr.pid);
      return `
        <article class="promo-card">
          <div class="promo-top" style="background:linear-gradient(135deg, ${p.color}, ${p.color}CC)">
            ${logo(p)}
            <div class="disc">${esc(pr.big)}</div>
            <div class="until">${esc(pr.small)}</div>
          </div>
          <div class="promo-body">
            <h3>${esc(pr.title)}</h3>
            <p>${esc(pr.desc)}</p>
            <a class="btn ${p.recommended ? 'btn-orange' : 'btn-ghost'} btn-sm" ${linkAttrs(p)}>Lihat Promo<svg><use href="#i-arrow" /></svg></a>
          </div>
        </article>`;
    }).join('');

    const dots = $('#promoDots');
    const promoCards = $$('.promo-card', track);
    dots.innerHTML = promoCards.map((_, i) => `<button type="button" aria-label="Promo ${i + 1}"></button>`).join('');
    const step = () => promoCards[0].offsetWidth + 20;
    const currentIndex = () => Math.round(track.scrollLeft / step());
    const goTo = (i) => track.scrollTo({ left: i * step() });
    const atEnd = () => track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;

    $('#promoPrev').addEventListener('click', () => goTo(Math.max(0, currentIndex() - 1)));
    $('#promoNext').addEventListener('click', () => goTo(atEnd() ? 0 : currentIndex() + 1));
    $$('button', dots).forEach((d, i) => d.addEventListener('click', () => goTo(i)));
    const syncDots = () => {
      const idx = atEnd() ? promoCards.length - 1 : currentIndex();
      $$('button', dots).forEach((d, i) => d.classList.toggle('active', i === idx));
    };
    track.addEventListener('scroll', syncDots, { passive: true });
    syncDots();

    // auto-geser, berhenti saat hover/fokus
    let autoplay = setInterval(() => $('#promoNext').click(), 5000);
    const pause = () => clearInterval(autoplay);
    const resume = () => { clearInterval(autoplay); autoplay = setInterval(() => $('#promoNext').click(), 5000); };
    track.addEventListener('mouseenter', pause);
    track.addEventListener('mouseleave', resume);
    track.addEventListener('focusin', pause);
    track.addEventListener('focusout', resume);

    /* =========================================================
       8. FAQ ACCORDION
       ========================================================= */
    const accItems = $$('.acc-item');
    const setAcc = (item, open) => {
      const panel = $('.acc-panel', item);
      item.classList.toggle('open', open);
      $('.acc-btn', item).setAttribute('aria-expanded', String(open));
      panel.style.maxHeight = open ? panel.scrollHeight + 'px' : '0px';
    };
    accItems.forEach((item) => {
      setAcc(item, item.classList.contains('open'));
      $('.acc-btn', item).addEventListener('click', () => {
        const willOpen = !item.classList.contains('open');
        accItems.forEach((o) => setAcc(o, o === item && willOpen));
      });
    });
    window.addEventListener('resize', () => accItems.filter((i) => i.classList.contains('open')).forEach((i) => setAcc(i, true)));

    /* =========================================================
       FOOTER: daftar provider dari data
       ========================================================= */
    $('#footerProviders').innerHTML = PROVIDERS.map((p) =>
      `<li><a ${linkAttrs(p)}><span class="dot" style="background:${p.color}"></span>${esc(p.name)}${p.recommended ? ' <span class="new">Rekomendasi</span>' : ''}</a></li>`).join('');
    $('#statProviders').textContent = PROVIDERS.length;
    $('#statCities').textContent = ALL_CITIES.length;

    /* INIT */
    syncPrice();
    render();
    updateCompareBar();
  </script>
  @endverbatim
</body>
</html>
