{{-- Pratinjau ringkas kartu paket di daftar admin (maks. 4 poin keunggulan). --}}
@php $features = collect($card->features)->filter(); @endphp
<div @class(['pv', 'popular' => $card->is_popular])>
  <div class="pv-head">
    <span class="pv-eyebrow">{{ $card->title }}</span>
    @if ($card->is_popular)<span class="tag tag-popular">{{ $card->badge ?: 'Populer' }}</span>@endif
  </div>
  <div class="pv-speed">{{ $card->speed }}<small>{{ $card->unit }}</small></div>
  @if ($card->pill)<span class="pv-pill">{{ $card->pill }}</span>@endif
  <div class="pv-price">{{ $card->price }}<span>{{ $card->price_suffix }}</span></div>
  @if ($card->promo)<div class="pv-promo">{{ $card->promo }}</div>@endif
  <ul>
    @foreach ($features->take(4) as $feature)
      <li><svg aria-hidden="true"><use href="#i-check"/></svg><span>{{ $feature }}</span></li>
    @endforeach
  </ul>
  @if ($features->count() > 4)<span class="pv-more">+{{ $features->count() - 4 }} poin lainnya</span>@endif
  <div class="pv-cta">{{ $card->cta_label }}</div>
</div>
