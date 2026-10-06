<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Faq;
use App\Models\Text;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PageController extends Controller
{
    /** Halaman perbandingan provider (KoneksiKu). */
    public function home(): View
    {
        $stats = fn (Collection $cards, string $route) => $cards->isEmpty() ? ['url' => route($route)] : [
            'url' => route($route),
            'price' => $cards->map(fn ($c) => $this->rupiah($c->price))->filter()->min(),
            'speedMin' => $cards->min(fn ($c) => (int) $c->speed),
            'speedMax' => $cards->max(fn ($c) => (int) $c->speed),
        ];

        return view('home', ['providers' => [
            'centrin' => $stats(Card::forPage('web1', 'plans'), 'web1'),
            'm3' => $stats(Card::forPage('web2', 'rumah')->concat(Card::forPage('web2', 'bisnis')), 'web2'),
        ]]);
    }

    public function web1(): View
    {
        return view('sites.web1', $this->siteData('web1') + [
            'plans' => Card::forPage('web1', 'plans'),
            'bundles' => Card::forPage('web1', 'bundles'),
        ]);
    }

    public function web2(): View
    {
        return view('sites.web2', $this->siteData('web2') + [
            'rumah' => Card::forPage('web2', 'rumah'),
            'bisnis' => Card::forPage('web2', 'bisnis'),
            'faqs' => Faq::where('site', 'web2')->visible()->ordered()->get(),
        ]);
    }

    /**
     * Helper yang dipakai template:
     *   $t('kunci')        → teks
     *   $wa('kunciPesan')  → link WhatsApp ke nomor situs, dengan pesan dari teks lain
     *   $tel('kunci')      → link telepon
     */
    private function siteData(string $site): array
    {
        $texts = Text::mapFor($site);
        $t = fn (string $key) => $texts[$key] ?? '';

        return [
            't' => $t,
            'wa' => function (?string $messageKey = null) use ($t) {
                $number = preg_replace('/\D/', '', $t('contact.waNumber'));
                $message = $messageKey ? $t($messageKey) : '';
                return "https://wa.me/{$number}" . ($message !== '' ? '?text=' . rawurlencode($message) : '');
            },
            'tel' => fn (string $key) => 'tel:' . preg_replace('/[^\d+]/', '', $t($key)),
        ];
    }

    /** "Rp1.100.000" → 1100000 */
    private function rupiah(string $price): ?int
    {
        $digits = preg_replace('/\D/', '', $price);
        return $digits === '' ? null : (int) $digits;
    }
}
