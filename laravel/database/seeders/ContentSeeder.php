<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Faq;
use App\Models\Text;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Mengimpor konten awal dari data/content.json
 * (hasil panel admin versi statis sebelum migrasi ke Laravel).
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/content.json'), true, flags: JSON_THROW_ON_ERROR);

        DB::transaction(function () use ($data) {
            Card::query()->delete();
            Faq::query()->delete();

            foreach (['web1', 'web2'] as $site) {
                Text::saveMany($site, $data[$site]['texts']);
            }

            $collections = [
                ['web1', 'plans', $data['web1']['plans']],
                ['web1', 'bundles', $data['web1']['bundles']],
                ['web2', 'rumah', $data['web2']['plansRumah']],
                ['web2', 'bisnis', $data['web2']['plansBisnis']],
            ];

            foreach ($collections as [$site, $collection, $items]) {
                foreach (array_values($items) as $i => $c) {
                    Card::create([
                        'site' => $site,
                        'collection' => $collection,
                        // Web1 memakai "eyebrow", Web2 memakai "name" sebagai judul kartu.
                        'title' => $c['eyebrow'] ?? $c['name'],
                        'speed' => (string) $c['speed'],
                        'unit' => $c['unit'] ?? 'Mbps',
                        'price' => $c['price'],
                        'price_suffix' => $c['priceSuffix'] ?? null,
                        'pill' => $c['pill'] ?? null ?: null,
                        'promo' => $c['promo'] ?? null ?: null,
                        // Web1 lama menandai kartu populer lewat badge yang terisi.
                        'is_popular' => (bool) ($c['popular'] ?? ! empty($c['badge'])),
                        'badge' => $c['badge'] ?? null ?: null,
                        'features' => $c['features'] ?? [],
                        'cta_label' => $c['ctaLabel'] ?? 'Pesan Sekarang',
                        'wa_text' => $c['waText'] ?? null,
                        'is_visible' => $c['visible'] ?? true,
                        'sort_order' => $i + 1,
                    ]);
                }
            }

            foreach (array_values($data['web2']['faq']) as $i => $f) {
                Faq::create([
                    'site' => 'web2',
                    'question' => $f['q'],
                    'answer' => $f['a'],
                    'is_visible' => $f['visible'] ?? true,
                    'sort_order' => $i + 1,
                ]);
            }
        });
    }
}
