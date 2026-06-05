<?php

namespace App\Services;

use App\Actions\Contact\SendContactNotificationAction;
use App\Contracts\Services\ContactServiceInterface;
use App\DTOs\ContactData;
use App\Models\ContactSubmission;

class ContactService implements ContactServiceInterface
{
    public function __construct(
        private readonly SendContactNotificationAction $sendContactNotificationAction,
    ) {}

    public function store(ContactData $data): ContactSubmission
    {
        /** @var ContactSubmission $submission */
        $submission = ContactSubmission::create([
            'first_name' => $data->firstName,
            'last_name'  => $data->lastName,
            'email'      => $data->email,
            'phone'      => $data->phone,
            'message'    => $data->message,
        ]);

        $this->sendContactNotificationAction->handle($submission);

        return $submission;
    }
}
