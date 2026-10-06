<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Text;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TextController extends Controller
{
    public function edit(string $site): View
    {
        return view('admin.texts', [
            'site' => $site,
            'config' => config("cms.sites.$site"),
            'texts' => Text::mapFor($site),
        ]);
    }

    public function update(Request $request, string $site): RedirectResponse
    {
        // Hanya kunci yang terdaftar di config/cms.php yang boleh disimpan.
        $rules = [];
        $labels = [];
        foreach (config("cms.sites.$site.groups") as $group) {
            foreach ($group['fields'] as $f) {
                [$key, $label, $opts] = [$f[0], $f[1], $f[2] ?? []];
                $field = 'texts.' . str_replace('.', '__', $key);
                $rules[$field] = ($opts['rule'] ?? null) === 'phone'
                    ? ['required', 'regex:/^\d{8,15}$/']
                    : ['nullable', 'string', 'max:2000'];
                $labels[$field] = $label;
            }
        }

        $validated = $request->validate($rules, ['regex' => ':attribute hanya boleh angka, 8–15 digit (mis. 62812xxxx).'], $labels);

        // Kunci berisi titik ("hero.line1") dikirim sebagai "hero__line1" agar tidak dipecah jadi array oleh Laravel.
        $values = collect($validated['texts'] ?? [])
            ->mapWithKeys(fn ($v, $k) => [str_replace('__', '.', $k) => trim((string) $v)])
            ->all();

        Text::saveMany($site, $values);

        return back()->with('status', 'Teks berhasil disimpan.');
    }
}
