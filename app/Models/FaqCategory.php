<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FaqCategory extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'order'];

    protected function casts(): array
    {
        return ['order' => 'integer'];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('order');
    }
}
