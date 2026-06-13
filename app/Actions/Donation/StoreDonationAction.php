<?php

namespace App\Actions\Donation;

use App\DTOs\DonationData;
use App\Models\Cause;
use App\Models\Donation;

class StoreDonationAction
{
    public function handle(DonationData $data, string $status = 'pending', ?string $razorpayOrderId = null): Donation
    {
        /** @var Donation $donation */
        $donation = Donation::create([
            'cause_id'          => $data->causeId,
            'donor_first_name'  => $data->donorFirstName,
            'donor_last_name'   => $data->donorLastName,
            'donor_email'       => $data->donorEmail,
            'donor_phone'       => $data->donorPhone,
            'donor_pan'         => $data->donorPan,
            'donor_address'     => $data->donorAddress,
            'amount'            => $data->amount,
            'payment_method'    => $data->paymentMethod,
            'status'            => $status,
            'razorpay_order_id' => $razorpayOrderId,
            'message'           => $data->message,
            'donated_at'        => now(),
        ]);

        return $donation->fresh();
    }

    public function markCompleted(Donation $donation, string $paymentId): Donation
    {
        $donation->update([
            'status'         => 'completed',
            'transaction_id' => $paymentId,
        ]);

        if ($donation->cause_id !== null) {
            Cause::where('id', $donation->cause_id)
                ->increment('raised_amount', $donation->amount);
        }

        return $donation->fresh();
    }
}
