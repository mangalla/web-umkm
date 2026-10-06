{{-- Kartu paket Web1. $bundle = true untuk kartu di carousel bundling. --}}
<article @class(['plan-card', 'bundle-card' => $bundle, 'is-popular' => $card->is_popular]) @if ($bundle) role="listitem" @endif>
  @if ($card->is_popular && $card->badge)
    <span class="plan-badge">{{ $card->badge }}</span>
  @endif
  <p class="plan-eyebrow">{{ $card->title }}</p>
  <div class="plan-speed"><span class="num">{{ $card->speed }}</span><span class="unit">{{ $card->unit }}</span></div>
  @if ($card->pill)
    <span class="plan-pill">{{ $card->pill }}</span>
  @endif
  <p class="plan-price">{{ $card->price }}<span>{{ $card->price_suffix }}</span></p>
  @if ($card->promo)
    <p class="plan-promo">{{ $card->promo }}</p>
  @endif
  <ul class="plan-features">
    @foreach ($card->features as $feature)
      <li><svg aria-hidden="true"><use href="#i-check"/></svg>{{ $feature }}</li>
    @endforeach
  </ul>
  <a class="btn btn-accent plan-cta" href="{{ $card->waLink($t('contact.waNumber')) }}" target="_blank" rel="noopener">{{ $card->cta_label }}</a>
</article>
