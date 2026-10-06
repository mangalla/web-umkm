<?php

namespace App\Models;

use App\Models\Concerns\Sortable;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use Sortable;

    protected $fillable = [
        'site', 'collection', 'title', 'speed', 'unit', 'price', 'price_suffix',
        'pill', 'promo', 'is_popular', 'badge', 'features', 'cta_label', 'wa_text',
        'is_visible', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_popular' => 'boolean',
            'is_visible' => 'boolean',
        ];
    }

    public function sortGroup(): array
    {
        return ['site' => $this->site, 'collection' => $this->collection];
    }

    /** Kartu tampil untuk satu bagian halaman, sudah terurut. */
    public static function forPage(string $site, string $collection)
    {
        return static::where(compact('site', 'collection'))->visible()->ordered()->get();
    }

    /** Link WhatsApp untuk tombol kartu. */
    public function waLink(?string $number): string
    {
        $number = preg_replace('/\D/', '', (string) $number);
        return "https://wa.me/{$number}" . ($this->wa_text ? '?text=' . rawurlencode($this->wa_text) : '');
    }
}
