<?php

namespace App\Services;

use App\Actions\Newsletter\SubscribeEmailAction;
use App\Contracts\Services\NewsletterServiceInterface;
use App\Models\NewsletterSubscriber;

class NewsletterService implements NewsletterServiceInterface
{
    public function __construct(
        private readonly SubscribeEmailAction $subscribeEmailAction,
    ) {}

    public function subscribe(string $email): NewsletterSubscriber
    {
        return $this->subscribeEmailAction->handle($email);
    }

    public function unsubscribe(string $email): void
    {
        NewsletterSubscriber::where('email', $email)->update([
            'is_active'        => false,
            'unsubscribed_at'  => now(),
        ]);
    }
}
