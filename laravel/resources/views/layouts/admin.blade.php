<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex, nofollow" />
<title>@yield('title', 'Panel Admin') · KoneksiKu</title>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%230D2B4E'/%3E%3Cpath d='M9 22V10h4.5a3.5 3.5 0 0 1 0 7H9' fill='none' stroke='%23FF6F3C' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/%3E%3Ccircle cx='22' cy='20' r='3' fill='%234FC3F7'/%3E%3C/svg%3E" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" />
<link rel="stylesheet" href="{{ asset('admin-assets/admin.css') }}" />
</head>
<body>
@include('admin.partials.icons')

@php
  $current = request()->route()?->getName();
  $routeSite = request()->route('site') ?? request()->route('card')?->site ?? request()->route('faq')?->site;
  $routeCollection = request()->route('collection') ?? request()->route('card')?->collection;
  $isActive = fn (string $name, array $params = []) => $current === $name
      && collect($params)->every(fn ($v, $k) => ['site' => $routeSite, 'collection' => $routeCollection][$k] === $v);
@endphp

<div class="app">
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <span class="brand-mark">P</span>
      <span>Panel Admin<small>KoneksiKu · Laravel</small></span>
    </div>

    <nav class="side-nav" aria-label="Menu admin">
      <a @class(['side-link', 'is-active' => $current === 'admin.dashboard']) href="{{ route('admin.dashboard') }}">
        <svg aria-hidden="true"><use href="#i-grid"/></svg><span>Ringkasan</span>
      </a>

      @foreach (config('cms.sites') as $siteKey => $siteConfig)
        <p class="side-group">{{ $siteConfig['name'] }}</p>
        <a @class(['side-link', 'is-active' => $isActive('admin.texts.edit', ['site' => $siteKey])]) href="{{ route('admin.texts.edit', $siteKey) }}">
          <svg aria-hidden="true"><use href="#i-text"/></svg><span>Teks Halaman</span>
        </a>
        @foreach ($siteConfig['collections'] as $colKey => $col)
          <a @class(['side-link', 'is-active' => $routeSite === $siteKey && $routeCollection === $colKey]) href="{{ route('admin.cards.index', [$siteKey, $colKey]) }}">
            <svg aria-hidden="true"><use href="#{{ $col['icon'] }}"/></svg><span>{{ $col['title'] }}</span>
          </a>
        @endforeach
        @if ($siteConfig['faq'])
          <a @class(['side-link', 'is-active' => str_starts_with((string) $current, 'admin.faqs') && $routeSite === $siteKey]) href="{{ route('admin.faqs.index', $siteKey) }}">
            <svg aria-hidden="true"><use href="#i-help"/></svg><span>FAQ</span>
          </a>
        @endif
      @endforeach

      <p class="side-group">Akun</p>
      <a @class(['side-link', 'is-active' => $current === 'admin.account']) href="{{ route('admin.account') }}">
        <svg aria-hidden="true"><use href="#i-lock"/></svg><span>Keamanan</span>
      </a>
    </nav>

    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="side-logout" type="submit"><svg aria-hidden="true"><use href="#i-logout"/></svg>Keluar</button>
    </form>
  </aside>
  <div class="scrim" id="scrim"></div>

  <div class="main">
    <header class="topbar">
      <button class="icon-btn menu-btn" type="button" id="menuBtn" aria-label="Buka menu">
        <svg aria-hidden="true"><use href="#i-menu"/></svg>
      </button>
      <div class="topbar-title">
        <p class="crumb">{{ $routeSite ? config("cms.sites.$routeSite.name") : 'Panel Admin' }}</p>
        <h1>@yield('title', 'Ringkasan')</h1>
      </div>
      @if ($routeSite)
        <a class="btn btn-ghost" href="{{ route(config("cms.sites.$routeSite.route")) }}" target="_blank" rel="noopener">
          <svg aria-hidden="true"><use href="#i-external"/></svg><span>Lihat halaman</span>
        </a>
      @endif
    </header>

    <main class="content">
      @if (session('status'))
        <div class="flash" role="status"><svg aria-hidden="true"><use href="#i-check"/></svg>{{ session('status') }}</div>
      @endif
      @if ($errors->any())
        <div class="errors" role="alert">
          <b>Periksa kembali isian berikut:</b>
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>
</div>

{{-- Konfirmasi untuk form bertanda data-confirm (hapus, dll.) --}}
<dialog class="modal" id="confirmModal">
  <div class="modal-inner">
    <div class="confirm-body">
      <span class="confirm-icon"><svg aria-hidden="true"><use href="#i-alert"/></svg></span>
      <div><h2 id="confirmTitle">Yakin?</h2><p class="muted" id="confirmText"></p></div>
    </div>
    <footer class="modal-foot">
      <button class="btn btn-ghost" type="button" data-answer="no">Batal</button>
      <button class="btn btn-danger" type="button" data-answer="yes">Hapus</button>
    </footer>
  </div>
</dialog>

<script src="{{ asset('admin-assets/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
