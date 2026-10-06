@extends('layouts.admin')
@section('title', $meta['title'])

@section('content')
  <div class="toolbar">
    <p class="muted grow">{{ $meta['desc'] }} Urutan di sini = urutan di halaman.</p>
    <a class="btn btn-accent" href="{{ route('admin.cards.create', [$site, $collection]) }}">
      <svg aria-hidden="true"><use href="#i-plus"/></svg>Tambah kartu
    </a>
  </div>

  @if ($cards->isEmpty())
    <div class="panel empty">Belum ada kartu. Klik “Tambah kartu” untuk membuat yang pertama.</div>
  @else
    <div class="items">
      @foreach ($cards as $card)
        <article @class(['panel', 'item', 'is-hidden' => ! $card->is_visible])>
          <div class="item-preview">@include('admin.partials.card-preview', ['card' => $card])</div>
          @include('admin.partials.item-bar', [
            'prefix' => 'admin.cards', 'item' => $card, 'label' => $card->title,
            'position' => $loop->iteration, 'first' => $loop->first, 'last' => $loop->last,
          ])
        </article>
      @endforeach
    </div>
  @endif
@endsection
