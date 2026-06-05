<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page', 'section_key', 'title', 'subtitle',
        'body', 'button_text', 'button_url', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public static function forPage(string $page, string $key): ?self
    {
        return static::where('page', $page)->where('section_key', $key)->first();
    }
}
