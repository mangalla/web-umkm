@extends('layouts.admin')
@section('title', $card->exists ? "Edit: {$card->title}" : "Tambah kartu — {$collectionTitle}")

@section('content')
  <form method="POST" id="cardForm"
        action="{{ $card->exists ? route('admin.cards.update', $card) : route('admin.cards.store', [$card->site, $card->collection]) }}">
    @csrf
    @if ($card->exists) @method('PUT') @endif

    <div class="editor-page">
      <section class="panel">
        <div class="editor-fields">
          @foreach ($fields as $name => $f)
            @php
              $type = $f['type'] ?? 'text';
              $value = old($name, $card->{$name});
            @endphp

            @if ($type === 'check')
              {{-- hidden 0 agar checkbox yang tidak dicentang tetap terkirim --}}
              <input type="hidden" name="{{ $name }}" value="0" />
              <label class="check wide"><input type="checkbox" name="{{ $name }}" value="1" data-preview="{{ $name }}" @checked($value) /> {{ $f['label'] }}</label>
            @else
              <label @class(['field', 'wide' => in_array($type, ['list', 'long']), 'has-error' => $errors->has($name) || $errors->has("$name.*")])>
                <span>{{ $f['label'] }}@if ($f['required'] ?? false) *@endif</span>
                @if ($type === 'list')
                  <textarea name="{{ $name }}" rows="7" data-preview="{{ $name }}">{{ is_array($value) ? implode("\n", $value) : $value }}</textarea>
                @elseif ($type === 'long')
                  <textarea name="{{ $name }}" rows="3" data-preview="{{ $name }}">{{ $value }}</textarea>
                @else
                  <input type="text" name="{{ $name }}" value="{{ $value }}" data-preview="{{ $name }}" @required($f['required'] ?? false) />
                @endif
                @isset($f['hint'])<small>{{ $f['hint'] }}</small>@endisset
                @error($name)<small class="field-error">{{ $message }}</small>@enderror
                @error("$name.*")<small class="field-error">{{ $message }}</small>@enderror
              </label>
            @endif
          @endforeach
        </div>
        <div class="form-actions">
          <a class="btn btn-ghost" href="{{ route('admin.cards.index', [$card->site, $card->collection]) }}">Batal</a>
          <button class="btn btn-primary" type="submit">{{ $card->exists ? 'Simpan perubahan' : 'Tambah kartu' }}</button>
        </div>
      </section>

      <aside class="editor-preview">
        <p class="preview-label">Pratinjau</p>
        <div id="cardPreview">@include('admin.partials.card-preview', ['card' => $card])</div>
      </aside>
    </div>
  </form>
@endsection
