<?php

namespace App\DTOs;

readonly class ContactData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public ?string $phone,
        public ?string $message,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
            phone: $data['phone'] ?? null,
            message: $data['message'] ?? null,
        );
    }
}
