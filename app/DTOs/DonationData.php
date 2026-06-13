<?php

namespace App\DTOs;

readonly class DonationData
{
    public function __construct(
        public string $donorFirstName,
        public string $donorLastName,
        public string $donorEmail,
        public ?string $donorPhone,
        public ?string $donorPan,
        public ?string $donorAddress,
        public float $amount,
        public string $paymentMethod,
        public ?int $causeId,
        public ?string $message,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            donorFirstName: $data['donor_first_name'],
            donorLastName: $data['donor_last_name'],
            donorEmail: $data['donor_email'],
            donorPhone: $data['donor_phone'] ?? null,
            donorPan: $data['donor_pan'] ?? null,
            donorAddress: $data['donor_address'] ?? null,
            amount: (float) $data['amount'],
            paymentMethod: $data['payment_method'],
            causeId: isset($data['cause_id']) ? (int) $data['cause_id'] : null,
            message: $data['message'] ?? null,
        );
    }
}
