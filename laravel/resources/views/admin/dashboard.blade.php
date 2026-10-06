@extends('layouts.admin')
@section('title', 'Ringkasan')

@section('content')
  @if ($defaultPassword)
    <div class="alert alert-warn">
      <svg aria-hidden="true"><use href="#i-alert"/></svg>
      <p>Anda masih memakai password bawaan. <a href="{{ route('admin.account') }}">Ganti password sekarang</a> sebelum website dionlinekan.</p>
    </div>
  @endif

  <p class="muted">Terakhir diubah: <b>{{ $lastUpdate ? \Illuminate\Support\Carbon::parse($lastUpdate)->translatedFormat('d M Y, H:i') : '—' }}</b></p>

  <div class="stats">
    @foreach (config('cms.sites') as $siteKey => $site)
      @foreach ($site['collections'] as $colKey => $col)
        @php $c = $counts[$siteKey][$colKey] ?? null; @endphp
        <a class="panel stat" href="{{ route('admin.cards.index', [$siteKey, $colKey]) }}">
          <div class="stat-top">
            <span @class(['stat-ic', 'orange' => $siteKey === 'web2'])><svg aria-hidden="true"><use href="#{{ $col['icon'] }}"/></svg></span>
            <span class="stat-site">{{ strtoupper($siteKey) }}</span>
          </div>
          <b>{{ $c->total ?? 0 }}</b>
          <span>{{ $col['title'] }} · {{ (int) ($c->visible ?? 0) }} tampil</span>
        </a>
      @endforeach
      @if ($site['faq'])
        @php $f = $faqCounts[$siteKey] ?? null; @endphp
        <a class="panel stat" href="{{ route('admin.faqs.index', $siteKey) }}">
          <div class="stat-top">
            <span class="stat-ic orange"><svg aria-hidden="true"><use href="#i-help"/></svg></span>
            <span class="stat-site">{{ strtoupper($siteKey) }}</span>
          </div>
          <b>{{ $f->total ?? 0 }}</b>
          <span>FAQ · {{ (int) ($f->visible ?? 0) }} tampil</span>
        </a>
      @endif
    @endforeach
  </div>

  <div class="site-cards">
    @foreach (config('cms.sites') as $siteKey => $site)
      <section class="panel site-card">
        <header class="panel-head">
          <div><h2>{{ $site['name'] }}</h2><p>{{ $texts[$siteKey]['meta.title'] ?? '' }}</p></div>
          <a class="btn btn-ghost" href="{{ route($site['route']) }}" target="_blank" rel="noopener"><svg aria-hidden="true"><use href="#i-external"/></svg>Buka</a>
        </header>
        <div class="panel-body">
          <ul>
            <li><span>Alamat halaman</span><span>{{ parse_url(route($site['route']), PHP_URL_PATH) }}</span></li>
            <li><span>Teks yang bisa diatur</span><span>{{ collect($site['groups'])->sum(fn ($g) => count($g['fields'])) }}</span></li>
            <li><span>Nomor WhatsApp</span><span>{{ $texts[$siteKey]['contact.waNumber'] ?? '—' }}</span></li>
          </ul>
          <a class="btn btn-primary" href="{{ route('admin.texts.edit', $siteKey) }}"><svg aria-hidden="true"><use href="#i-text"/></svg>Edit teks halaman</a>
        </div>
      </section>
    @endforeach
  </div>
@endsection
