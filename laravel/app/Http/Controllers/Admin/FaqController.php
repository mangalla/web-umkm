<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(string $site): View
    {
        $this->ensureFaq($site);

        return view('admin.faqs.index', [
            'site' => $site,
            'faqs' => Faq::where('site', $site)->ordered()->get(),
        ]);
    }

    public function create(string $site): View
    {
        $this->ensureFaq($site);

        return view('admin.faqs.form', ['faq' => new Faq(['site' => $site, 'is_visible' => true])]);
    }

    public function store(Request $request, string $site): RedirectResponse
    {
        $this->ensureFaq($site);
        Faq::create($this->validated($request) + ['site' => $site]);

        return redirect()->route('admin.faqs.index', $site)->with('status', 'Pertanyaan ditambahkan.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $faq->update($this->validated($request));

        return redirect()->route('admin.faqs.index', $faq->site)->with('status', 'Pertanyaan disimpan.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('status', 'Pertanyaan dihapus.');
    }

    public function toggle(Faq $faq): RedirectResponse
    {
        $faq->update(['is_visible' => ! $faq->is_visible]);

        return back()->with('status', $faq->is_visible ? 'Pertanyaan ditampilkan.' : 'Pertanyaan disembunyikan.');
    }

    public function move(Faq $faq, string $direction): RedirectResponse
    {
        $faq->move($direction === 'up' ? -1 : 1);

        return back();
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:2000'],
        ], [], ['question' => 'pertanyaan', 'answer' => 'jawaban']) + ['is_visible' => $request->boolean('is_visible')];
    }

    private function ensureFaq(string $site): void
    {
        abort_unless(config("cms.sites.$site.faq"), 404);
    }
}
