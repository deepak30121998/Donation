<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryItem extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'gallery_category_id', 'order', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order'     => 'integer',
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->nonQueued();
        $this->addMediaConversion('lightbox')->width(1200)->nonQueued();
    }

    public function galleryCategory(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('order'); }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('gallery_category_id', $categoryId);
    }

    // Returns the category slug as CSS class for Isotope filtering
    public function getCategoryClassAttribute(): string
    {
        return $this->galleryCategory?->slug ?? '';
    }
}
