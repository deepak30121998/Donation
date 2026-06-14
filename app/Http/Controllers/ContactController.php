<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ContactServiceInterface;
use App\DTOs\ContactData;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\JsonResponse;
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

    public function store(StoreContactRequest $request): JsonResponse|RedirectResponse
    {
        $data = ContactData::fromRequest($request->validated());
        $this->contactService->store($data);

        $context = [
            'icon'    => 'fa-paper-plane',
            'title'   => 'Thank You for <span>Reaching Out!</span>',
            'message' => 'We have received your message and our team will get back to you as soon as possible.',
        ];

        if ($request->ajax()) {
            session()->flash('thank_you', $context);

            return response()->json(['redirect' => route('thank-you')]);
        }

        return redirect()->route('thank-you')->with('thank_you', $context);
    }
}
