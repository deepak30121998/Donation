<?php

namespace App\Services;

use App\Actions\Donation\StoreDonationAction;
use App\Contracts\Services\DonationServiceInterface;
use App\DTOs\DonationData;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;

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
        // TODO: implement a proper Mailable for donation receipts.
        Log::info('Donation receipt pending delivery.', [
            'donation_id' => $donation->id,
            'email'       => $donation->donor_email,
            'amount'      => $donation->amount,
        ]);
    }
}
