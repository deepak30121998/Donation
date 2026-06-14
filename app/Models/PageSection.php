<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageSection extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'page', 'section_key', 'title', 'subtitle',
        'body', 'button_text', 'button_url', 'is_active', 'order',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(250)->nonQueued();
        $this->addMediaConversion('banner')->width(1920)->height(800)->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        // Pin to the public disk so admin uploads (hero banner, etc.) are web-accessible.
        $this->addMediaCollection('image')->singleFile()->useDisk('public');
        $this->addMediaCollection('image_2')->singleFile()->useDisk('public');
    }

    public static function forPage(string $page, string $key): ?self
    {
        return static::where('page', $page)->where('section_key', $key)->first();
    }
}
