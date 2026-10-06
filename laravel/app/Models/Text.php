<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Text extends Model
{
    protected $fillable = ['site', 'key', 'value'];

    /**
     * Semua teks satu situs sebagai array kunci => nilai.
     * Di-cache karena dibaca di setiap kunjungan halaman; cache dibuang saat admin menyimpan.
     *
     * @return array<string, string>
     */
    public static function mapFor(string $site): array
    {
        return Cache::rememberForever(static::cacheKey($site), fn () => static::where('site', $site)
            ->pluck('value', 'key')
            ->map(fn ($v) => (string) $v)
            ->all());
    }

    /** Simpan banyak teks sekaligus lalu bersihkan cache. */
    public static function saveMany(string $site, array $values): void
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['site' => $site, 'key' => $key], ['value' => (string) $value]);
        }
        Cache::forget(static::cacheKey($site));
    }

    public static function cacheKey(string $site): string
    {
        return "cms.texts.{$site}";
    }
}
