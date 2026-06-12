<?php

namespace App\Contracts\Services;

use App\Models\NewsletterSubscriber;

interface NewsletterServiceInterface
{
    public function subscribe(string $email): NewsletterSubscriber;
    public function unsubscribe(string $email): void;
}
