<?php

namespace App\Http\Controllers;

use App\Actions\Newsletter\SubscribeEmailAction;
use App\Http\Requests\SubscribeNewsletterRequest;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function __construct(
        protected SubscribeEmailAction $action,
    ) {}

    public function store(SubscribeNewsletterRequest $request): RedirectResponse
    {
        $this->action->handle($request->validated('email'));

        return back()->with('newsletter_success', 'You have been subscribed!');
    }
}
