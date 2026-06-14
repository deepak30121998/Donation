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

        return redirect()->route('thank-you')->with('thank_you', [
            'icon'    => 'fa-bell',
            'title'   => 'Thank You for <span>Subscribing!</span>',
            'message' => "You're now on our list. We'll keep you updated on our work, stories of impact, and ways you can help.",
        ]);
    }
}
