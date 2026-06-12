<?php

namespace App\Services;

use App\Actions\Donation\StoreDonationAction;
use App\Contracts\Services\DonationServiceInterface;
use App\DTOs\DonationData;
use App\Mail\DonationReceiptMail;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DonationService implements DonationServiceInterface
{
    public function __construct(
        private readonly StoreDonationAction $storeDonationAction,
    ) {}

    public function process(DonationData $data): Donation
    {
        return $this->storeDonationAction->handle($data);
    }

    public function sendReceipt(Donation $donation): void
    {
        try {
            Mail::to($donation->donor_email)->send(new DonationReceiptMail($donation));
        } catch (\Throwable $e) {
            Log::error('Failed to send donation receipt.', [
                'donation_id' => $donation->id,
                'email'       => $donation->donor_email,
                'error'       => $e->getMessage(),
            ]);
        }
    }
}
