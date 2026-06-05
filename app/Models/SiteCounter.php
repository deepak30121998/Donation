<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteCounter extends Model
{
    protected $fillable = ['key', 'label', 'value', 'suffix', 'prefix', 'order'];

    protected function casts(): array
    {
        return ['value' => 'integer', 'order' => 'integer'];
    }

    public function scopeOrdered($query) { return $query->orderBy('order'); }
}
