<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavigationItem extends Model
{
    protected $fillable = [
        'label', 'url', 'route_name', 'route_params',
        'parent_id', 'target', 'order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'route_params' => 'array',
            'is_active'    => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('order');
    }

    public function getHrefAttribute(): string
    {
        if ($this->route_name) {
            try {
                return route($this->route_name, $this->route_params ?? []);
            } catch (\Exception) {
                // fall through to url
            }
        }

        return $this->url ?? '#';
    }
}
