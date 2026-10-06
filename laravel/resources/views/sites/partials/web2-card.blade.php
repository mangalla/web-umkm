{{-- Kartu paket Web2. Warna ikon: oranye untuk populer, selain itu bergantian biru/navy. --}}
@php
  $iconColor = $card->is_popular ? '#FF6F3C' : ['#1E88E5', '#0D2B4E'][$index % 2];
  $check = $card->is_popular ? '#i-check-o' : '#i-check';
@endphp
<article @class(['price-card', 'popular' => $card->is_popular])>
  @if ($card->is_popular && $card->badge)
    <span class="popular-label"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3 6.5 7 .8-5.2 4.8 1.5 7L12 17.6 5.7 21l1.5-7L2 9.3l7-.8z" fill="currentColor" /></svg>{{ $card->badge }}</span>
  @endif
  <div class="plan-top">
    <span class="plan-name">{{ $card->title }}</span>
    <span class="plan-icon"><svg viewBox="0 0 24 24" style="color:{{ $iconColor }}" aria-hidden="true"><use href="#i-wifi" /></svg></span>
  </div>
  <div class="plan-speed"><span>{{ $card->speed }}</span><small>{{ $card->unit }}</small></div>
  <div class="plan-price"><span style="font-size:inherit;font-weight:inherit;color:inherit">{{ $card->price }}</span><span>{{ $card->price_suffix }}</span></div>
  <ul class="plan-features">
    @foreach ($card->features as $feature)
      <li><svg aria-hidden="true"><use href="{{ $check }}" /></svg>{{ $feature }}</li>
    @endforeach
  </ul>
  <a href="#jangkauan" @class(['btn', 'btn-block', 'btn-orange' => $card->is_popular, 'btn-outline' => ! $card->is_popular]) data-f="cta" data-plan="{{ $card->title }}">{{ $card->cta_label }}</a>
</article>
