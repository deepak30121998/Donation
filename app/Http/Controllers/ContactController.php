<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ContactServiceInterface;
use App\DTOs\ContactData;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected ContactServiceInterface $contactService,
    ) {}

    public function index(): View
    {
        return view('contact.index');
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $data = ContactData::fromRequest($request->validated());
        $this->contactService->store($data);

        return back()->with('success', 'Your message has been sent. We will get back to you soon!');
    }
}
