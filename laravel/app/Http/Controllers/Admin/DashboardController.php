<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Faq;
use App\Models\Text;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        // Jumlah kartu per site+collection: [site][collection] => ['total' => n, 'visible' => n]
        $counts = Card::selectRaw('site, collection, count(*) as total, sum(case when is_visible then 1 else 0 end) as visible')
            ->groupBy('site', 'collection')
            ->get()
            ->groupBy('site')
            ->map(fn ($rows) => $rows->keyBy('collection'));

        $faqCounts = Faq::selectRaw('site, count(*) as total, sum(case when is_visible then 1 else 0 end) as visible')
            ->groupBy('site')->get()->keyBy('site');

        return view('admin.dashboard', [
            'counts' => $counts,
            'faqCounts' => $faqCounts,
            'texts' => collect(config('cms.sites'))->map(fn ($s, $key) => Text::mapFor($key)),
            'lastUpdate' => collect([Card::max('updated_at'), Faq::max('updated_at'), Text::max('updated_at')])->filter()->max(),
            'defaultPassword' => Hash::check('admin123', auth()->user()->password),
        ]);
    }
}
