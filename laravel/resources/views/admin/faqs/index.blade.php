@extends('layouts.admin')
@section('title', 'FAQ')

@section('content')
  <div class="toolbar">
    <p class="muted grow">Pertanyaan di bagian Bantuan. Urutan di sini = urutan di halaman.</p>
    <a class="btn btn-accent" href="{{ route('admin.faqs.create', $site) }}"><svg aria-hidden="true"><use href="#i-plus"/></svg>Tambah pertanyaan</a>
  </div>

  @if ($faqs->isEmpty())
    <div class="panel empty">Belum ada pertanyaan.</div>
  @else
    <div class="items list">
      @foreach ($faqs as $faq)
        <article @class(['panel', 'item', 'is-hidden' => ! $faq->is_visible])>
          <div class="item-preview pv-faq"><b>{{ $faq->question }}</b><p>{{ $faq->answer }}</p></div>
          @include('admin.partials.item-bar', [
            'prefix' => 'admin.faqs', 'item' => $faq, 'label' => $faq->question,
            'position' => $loop->iteration, 'first' => $loop->first, 'last' => $loop->last,
          ])
        </article>
      @endforeach
    </div>
  @endif
@endsection
