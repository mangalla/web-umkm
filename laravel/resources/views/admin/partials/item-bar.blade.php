{{--
  Toolbar aksi untuk satu item (kartu atau FAQ).
  $prefix  : 'admin.cards' / 'admin.faqs'
  $item    : model
  $first, $last : posisi di daftar
  $label   : nama item untuk dialog konfirmasi
--}}
<div class="item-bar">
  <span class="pos">#{{ $position }} @unless ($item->is_visible)<span class="tag tag-hidden">Disembunyikan</span>@endunless</span>

  <form class="inline-form" method="POST" action="{{ route("$prefix.move", [$item, 'up']) }}">@csrf
    <button class="icon-btn" type="submit" title="Geser ke atas/kiri" aria-label="Geser ke atas" @disabled($first)><svg aria-hidden="true"><use href="#i-up"/></svg></button>
  </form>
  <form class="inline-form" method="POST" action="{{ route("$prefix.move", [$item, 'down']) }}">@csrf
    <button class="icon-btn" type="submit" title="Geser ke bawah/kanan" aria-label="Geser ke bawah" @disabled($last)><svg aria-hidden="true"><use href="#i-down"/></svg></button>
  </form>
  <form class="inline-form" method="POST" action="{{ route("$prefix.toggle", $item) }}">@csrf
    <button class="icon-btn" type="submit" title="{{ $item->is_visible ? 'Sembunyikan' : 'Tampilkan' }}" aria-label="{{ $item->is_visible ? 'Sembunyikan' : 'Tampilkan' }}">
      <svg aria-hidden="true"><use href="#{{ $item->is_visible ? 'i-eye' : 'i-eye-off' }}"/></svg>
    </button>
  </form>
  @if (Route::has("$prefix.duplicate"))
    <form class="inline-form" method="POST" action="{{ route("$prefix.duplicate", $item) }}">@csrf
      <button class="icon-btn" type="submit" title="Duplikat" aria-label="Duplikat"><svg aria-hidden="true"><use href="#i-copy"/></svg></button>
    </form>
  @endif
  <a class="icon-btn" href="{{ route("$prefix.edit", $item) }}" title="Edit" aria-label="Edit"><svg aria-hidden="true"><use href="#i-edit"/></svg></a>
  <form class="inline-form" method="POST" action="{{ route("$prefix.destroy", $item) }}"
        data-confirm="“{{ $label }}” akan dihapus permanen." data-confirm-title="Hapus item ini?">
    @csrf
    @method('DELETE')
    <button class="icon-btn danger" type="submit" title="Hapus" aria-label="Hapus"><svg aria-hidden="true"><use href="#i-trash"/></svg></button>
  </form>
</div>
