<?php

namespace App\Actions\Newsletter;

use App\Models\NewsletterSubscriber;

class SubscribeEmailAction
{
    public function handle(string $email): NewsletterSubscriber
    {
        /** @var NewsletterSubscriber $subscriber */
        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $email],
            [
                'is_active'     => true,
                'subscribed_at' => now(),
            ]
        );

        if (! $subscriber->wasRecentlyCreated) {
            $subscriber->update([
                'is_active'        => true,
                'subscribed_at'    => now(),
                'unsubscribed_at'  => null,
            ]);
        }

        return $subscriber->fresh();
    }
}
