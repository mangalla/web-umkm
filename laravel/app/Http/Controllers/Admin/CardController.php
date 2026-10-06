<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CardController extends Controller
{
    public function index(string $site, string $collection): View
    {
        $this->ensureCollection($site, $collection);

        return view('admin.cards.index', [
            'site' => $site,
            'collection' => $collection,
            'meta' => config("cms.sites.$site.collections.$collection"),
            'cards' => Card::where(compact('site', 'collection'))->ordered()->get(),
        ]);
    }

    public function create(string $site, string $collection): View
    {
        $this->ensureCollection($site, $collection);

        $card = new Card([
            'site' => $site,
            'collection' => $collection,
            'unit' => 'Mbps',
            'price_suffix' => $site === 'web1' ? '/bulan' : '/bln',
            'badge' => 'Paling Populer',
            'features' => [],
            'cta_label' => $site === 'web1' ? 'Pesan Sekarang' : 'Pilih Paket',
            'is_visible' => true,
        ]);

        return $this->form($card);
    }

    public function store(CardRequest $request, string $site, string $collection): RedirectResponse
    {
        $this->ensureCollection($site, $collection);

        $card = Card::create($request->cardData() + compact('site', 'collection'));

        return redirect()->route('admin.cards.index', [$site, $collection])
            ->with('status', "Kartu “{$card->title}” ditambahkan.");
    }

    public function edit(Card $card): View
    {
        return $this->form($card);
    }

    public function update(CardRequest $request, Card $card): RedirectResponse
    {
        $card->update($request->cardData());

        return redirect()->route('admin.cards.index', [$card->site, $card->collection])
            ->with('status', "Kartu “{$card->title}” disimpan.");
    }

    public function destroy(Card $card): RedirectResponse
    {
        $card->delete();

        return back()->with('status', "Kartu “{$card->title}” dihapus.");
    }

    /** Salinan langsung dibuat (disembunyikan) lalu dibuka untuk diedit. */
    public function duplicate(Card $card): RedirectResponse
    {
        $copy = $card->replicate(['sort_order']);
        $copy->title = $card->title . ' (salinan)';
        $copy->is_visible = false;
        $copy->save();

        return redirect()->route('admin.cards.edit', $copy)
            ->with('status', 'Salinan dibuat dan disembunyikan. Ubah lalu centang "Tampilkan" bila sudah siap.');
    }

    public function toggle(Card $card): RedirectResponse
    {
        $card->update(['is_visible' => ! $card->is_visible]);

        return back()->with('status', $card->is_visible ? 'Kartu ditampilkan.' : 'Kartu disembunyikan dari halaman.');
    }

    public function move(Card $card, string $direction): RedirectResponse
    {
        $card->move($direction === 'up' ? -1 : 1);

        return back();
    }

    private function form(Card $card): View
    {
        $site = config("cms.sites.{$card->site}");
        $meta = config('cms.card_field_meta');

        // Hanya kolom yang dipakai situs ini, dengan label khusus situs bila ada.
        $fields = collect($site['card_fields'])
            ->mapWithKeys(fn ($name) => [$name => array_merge($meta[$name], isset($site['card_labels'][$name]) ? ['label' => $site['card_labels'][$name]] : [])]);

        return view('admin.cards.form', [
            'card' => $card,
            'fields' => $fields,
            'collectionTitle' => $site['collections'][$card->collection]['title'],
        ]);
    }

    private function ensureCollection(string $site, string $collection): void
    {
        abort_unless(config("cms.sites.$site.collections.$collection"), 404);
    }
}
