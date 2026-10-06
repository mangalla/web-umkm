<?php

namespace App\Models;

use App\Models\Concerns\Sortable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Sortable;

    protected $fillable = ['site', 'question', 'answer', 'is_visible', 'sort_order'];

    protected function casts(): array
    {
        return ['is_visible' => 'boolean'];
    }

    public function sortGroup(): array
    {
        return ['site' => $this->site];
    }
}
