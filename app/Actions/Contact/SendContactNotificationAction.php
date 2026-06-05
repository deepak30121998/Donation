<?php

namespace App\Actions\Contact;

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactNotificationAction
{
    public function handle(ContactSubmission $submission): void
    {
        $adminAddress = config('mail.admin_address');

        if (empty($adminAddress)) {
            Log::info('Contact notification skipped — mail.admin_address not configured.', [
                'submission_id' => $submission->id,
                'from'          => $submission->email,
            ]);

            return;
        }

        try {
            Mail::raw(
                "New contact submission received.\n\n"
                . "Name: {$submission->full_name}\n"
                . "Email: {$submission->email}\n"
                . "Phone: {$submission->phone}\n\n"
                . "Message:\n{$submission->message}",
                function ($message) use ($adminAddress, $submission) {
                    $message->to($adminAddress)
                        ->subject("New Contact Submission from {$submission->full_name}");
                }
            );
        } catch (\Throwable $e) {
            Log::error('Failed to send contact notification email.', [
                'submission_id' => $submission->id,
                'error'         => $e->getMessage(),
            ]);
        }
    }
}
