<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TeamMember extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'position', 'bio',
        'twitter_url', 'facebook_url', 'instagram_url',
        'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'order' => 'integer'];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(300)->height(300)->nonQueued();
        $this->addMediaConversion('card')->width(400)->height(400)->nonQueued();
    }

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('order'); }
}
