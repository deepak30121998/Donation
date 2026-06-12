<?php

namespace App\Actions\Contact;

use App\Mail\ContactNotificationMail;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactNotificationAction
{
    public function handle(ContactSubmission $submission): void
    {
        $adminAddress = config('mail.admin_address')
            ?? config('mail.from.address');

        if (empty($adminAddress)) {
            Log::info('Contact notification skipped — no admin email configured.', [
                'submission_id' => $submission->id,
            ]);
            return;
        }

        try {
            Mail::to($adminAddress)->send(new ContactNotificationMail($submission));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact notification.', [
                'submission_id' => $submission->id,
                'error'         => $e->getMessage(),
            ]);
        }
    }
}
