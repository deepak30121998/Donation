<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'message', 'is_read',
    ];

    protected function casts(): array
    {
        return ['is_read' => 'boolean'];
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeUnread($query) { return $query->where('is_read', false); }
}
