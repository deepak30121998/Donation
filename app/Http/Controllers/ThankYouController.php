<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ThankYouController extends Controller
{
    /**
     * Generic thank-you page for contact / newsletter submissions.
     * The context (title, message, icon) is passed via the session so
     * the page cannot be opened directly without a real submission.
     */
    public function show(): View|RedirectResponse
    {
        $context = session('thank_you');

        if (! $context) {
            return redirect()->route('home');
        }

        session()->keep('thank_you');

        return view('thank-you', ['context' => $context]);
    }
}
