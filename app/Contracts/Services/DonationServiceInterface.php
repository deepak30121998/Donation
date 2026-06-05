<?php

namespace App\Contracts\Services;

use App\DTOs\DonationData;
use App\Models\Donation;

interface DonationServiceInterface
{
    public function process(DonationData $data): Donation;

    public function sendReceipt(Donation $donation): void;
}
