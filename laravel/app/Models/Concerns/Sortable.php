<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Urutan manual (kolom sort_order) di dalam satu "grup".
 * Model yang memakai trait ini menentukan grupnya lewat sortGroup(),
 * mis. kartu diurutkan per site + collection, FAQ per site.
 */
trait Sortable
{
    /** @return array<string, mixed> kolom => nilai yang membentuk grup urutan */
    abstract public function sortGroup(): array;

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    /** Query untuk semua item di grup yang sama dengan model ini. */
    public function siblings(): Builder
    {
        return static::query()->where($this->sortGroup());
    }

    protected static function bootSortable(): void
    {
        // Item baru otomatis ditaruh paling akhir di grupnya.
        static::creating(function ($model) {
            if (! $model->sort_order) {
                $model->sort_order = (int) $model->siblings()->max('sort_order') + 1;
            }
        });
    }

    /** Tukar posisi dengan tetangga di atas (-1) atau di bawah (+1). */
    public function move(int $direction): bool
    {
        $neighbor = $this->siblings()
            ->where('sort_order', $direction < 0 ? '<' : '>', $this->sort_order)
            ->orderBy('sort_order', $direction < 0 ? 'desc' : 'asc')
            ->first();

        if (! $neighbor) {
            return false;
        }

        DB::transaction(function () use ($neighbor) {
            [$this->sort_order, $neighbor->sort_order] = [$neighbor->sort_order, $this->sort_order];
            $this->save();
            $neighbor->save();
        });

        return true;
    }
}
