@extends('layouts.admin')
@section('title', 'Teks Halaman')

@section('content')
  <div class="toolbar">
    <label class="search">
      <svg aria-hidden="true"><use href="#i-search"/></svg>
      <input type="search" id="textSearch" placeholder="Cari teks… (mis. judul, WhatsApp)" aria-label="Cari teks" />
    </label>
    <span class="grow"></span>
    <span class="muted" style="font-size:.85rem">Kolom oranye = belum disimpan · Ctrl+S untuk menyimpan</span>
  </div>

  <form method="POST" action="{{ route('admin.texts.update', $site) }}" id="textsForm" class="text-groups">
    @csrf
    @method('PUT')

    @foreach ($config['groups'] as $group)
      <section class="panel" data-group>
        <header class="panel-head">
          <div><h2>{{ $group['title'] }}</h2>@isset($group['desc'])<p>{{ $group['desc'] }}</p>@endisset</div>
        </header>
        <div class="panel-body text-grid">
          @foreach ($group['fields'] as $f)
            @php
              [$key, $label, $opts] = [$f[0], $f[1], $f[2] ?? []];
              $name = 'texts[' . str_replace('.', '__', $key) . ']';
              $errorKey = 'texts.' . str_replace('.', '__', $key);
              $value = old($errorKey, $texts[$key] ?? '');
              $long = ($opts['type'] ?? 'text') === 'long';
            @endphp
            <label @class(['field', 'wide' => $long || ($opts['wide'] ?? false), 'has-error' => $errors->has($errorKey)])>
              <span>{{ $label }}<span class="field-key">{{ $key }}</span></span>
              @if ($long)
                <textarea name="{{ $name }}" rows="3" data-original="{{ $texts[$key] ?? '' }}">{{ $value }}</textarea>
              @else
                <input type="text" name="{{ $name }}" value="{{ $value }}" data-original="{{ $texts[$key] ?? '' }}" />
              @endif
              @isset($opts['hint'])<small>{{ $opts['hint'] }}</small>@endisset
              @error($errorKey)<small class="field-error">{{ $message }}</small>@enderror
            </label>
          @endforeach
        </div>
      </section>
    @endforeach

    <p class="empty" id="textEmpty" hidden>Tidak ada teks yang cocok.</p>

    <div class="savebar static" id="savebar">
      <p><b id="dirtyCount">0</b> teks diubah dan belum disimpan.</p>
      <button class="btn btn-ghost" type="reset">Batalkan</button>
      <button class="btn btn-accent" type="submit">Simpan perubahan</button>
    </div>
  </form>
@endsection
