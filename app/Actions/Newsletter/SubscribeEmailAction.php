<?php

namespace App\Actions\Newsletter;

use App\Mail\NewsletterWelcomeMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscribeEmailAction
{
    public function handle(string $email): NewsletterSubscriber
    {
        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $email],
            ['is_active' => true, 'subscribed_at' => now()]
        );

        $isNew = $subscriber->wasRecentlyCreated;

        if (! $isNew) {
            $subscriber->update([
                'is_active'       => true,
                'subscribed_at'   => now(),
                'unsubscribed_at' => null,
            ]);
        }

        // Send welcome email only to new subscribers
        if ($isNew) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));
            } catch (\Throwable $e) {
                Log::error('Failed to send newsletter welcome email.', [
                    'email' => $subscriber->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $subscriber->fresh();
    }
}
