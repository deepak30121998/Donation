<?php

namespace App\Actions\Donation;

use App\DTOs\DonationData;
use App\Models\Cause;
use App\Models\Donation;

class StoreDonationAction
{
    public function handle(DonationData $data): Donation
    {
        /** @var Donation $donation */
        $donation = Donation::create([
            'cause_id'         => $data->causeId,
            'donor_first_name' => $data->donorFirstName,
            'donor_last_name'  => $data->donorLastName,
            'donor_email'      => $data->donorEmail,
            'donor_phone'      => $data->donorPhone,
            'donor_pan'        => $data->donorPan,
            'donor_address'    => $data->donorAddress,
            'amount'           => $data->amount,
            'payment_method'   => $data->paymentMethod,
            'message'          => $data->message,
            'donated_at'       => now(),
        ]);

        if ($data->causeId !== null) {
            Cause::where('id', $data->causeId)
                ->increment('raised_amount', $data->amount);
        }

        return $donation->fresh();
    }
}
