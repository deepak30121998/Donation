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

        if ($request->ajax()) {
            return response()->json(['message' => 'Your message has been sent. We will get back to you soon!']);
        }

        return back()->with('success', 'Your message has been sent. We will get back to you soon!');
    }
}
