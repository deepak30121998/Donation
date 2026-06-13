<?php

namespace App\Models;

use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Donation extends Model
{
    use LogsActivity;

    protected $fillable = [
        'cause_id', 'donor_first_name', 'donor_last_name', 'donor_email',
        'donor_phone', 'donor_pan', 'donor_address',
        'amount', 'payment_method', 'status',
        'transaction_id', 'message', 'donated_at',
    ];

    protected function casts(): array
    {
        return [
            'amount'         => 'decimal:2',
            'payment_method' => DonationPaymentMethod::class,
            'status'         => DonationStatus::class,
            'donated_at'     => 'datetime',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }

    public function getDonorFullNameAttribute(): string
    {
        return "{$this->donor_first_name} {$this->donor_last_name}";
    }

    public function scopeCompleted($query) { return $query->where('status', DonationStatus::Completed); }
}
