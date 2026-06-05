<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cause extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'short_description',
        'goal_amount', 'raised_amount', 'order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'goal_amount'   => 'decimal:2',
            'raised_amount' => 'decimal:2',
            'is_active'     => 'boolean',
            'order'         => 'integer',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(280)->nonQueued();
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentAttribute(): int
    {
        if ($this->goal_amount <= 0) return 0;
        return (int) min(100, ($this->raised_amount / $this->goal_amount) * 100);
    }

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('order'); }
}
