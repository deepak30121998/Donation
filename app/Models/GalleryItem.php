<?php

namespace App\Models;

use App\Enums\GalleryCategory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryItem extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'category', 'order', 'is_active'];

    protected function casts(): array
    {
        return [
            'category'  => GalleryCategory::class,
            'is_active' => 'boolean',
            'order'     => 'integer',
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->nonQueued();
        $this->addMediaConversion('lightbox')->width(1200)->nonQueued();
    }

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('order'); }
    public function scopeByCategory($query, string $category) { return $query->where('category', $category); }
}
