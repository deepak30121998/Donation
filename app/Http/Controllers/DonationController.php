<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Services\DonationServiceInterface;
use App\DTOs\DonationData;
use App\Http\Requests\StoreDonationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function __construct(
        protected DonationServiceInterface   $donationService,
        protected CauseRepositoryInterface   $causeRepo,
    ) {}

    public function index(): View
    {
        return view('donation.index', [
            'causes' => $this->causeRepo->activeOrdered(),
        ]);
    }

    public function store(StoreDonationRequest $request): RedirectResponse
    {
        $data = DonationData::fromRequest($request->validated());
        $this->donationService->process($data);

        return redirect()->route('donation.index')
            ->with('success', 'Thank you for your donation!');
    }
}
