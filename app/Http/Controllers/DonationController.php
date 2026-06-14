<?php

namespace App\Http\Controllers;

use App\Actions\Donation\StoreDonationAction;
use App\Contracts\Repositories\CauseRepositoryInterface;
use App\Contracts\Services\DonationServiceInterface;
use App\DTOs\DonationData;
use App\Http\Requests\StoreDonationRequest;
use App\Models\Donation;
use App\Models\PageSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Razorpay\Api\Api;

class DonationController extends Controller
{
    public function __construct(
        protected DonationServiceInterface $donationService,
        protected CauseRepositoryInterface $causeRepo,
        protected StoreDonationAction      $storeDonationAction,
    ) {}

    public function index(): View
    {
        $amountsSection = PageSection::where('page', 'global')
            ->where('section_key', 'donation_amounts')
            ->first();

        $donationAmounts = $amountsSection?->body
            ? array_values(array_filter(array_map('trim', explode("\n", strip_tags($amountsSection->body)))))
            : ['500', '1100', '2100', '5100'];

        return view('donation.index', [
            'causes'          => $this->causeRepo->activeOrdered(),
            'donationAmounts' => $donationAmounts,
            'defaultAmount'   => (string) ($donationAmounts[0] ?? '500'),
            'razorpayKeyId'   => config('razorpay.key_id'),
        ]);
    }

    /**
     * Create a Razorpay order for online payments.
     * Called via AJAX before opening the Razorpay checkout modal.
     */
    public function createOrder(Request $request): JsonResponse
    {
        // Inline validation so errors always return JSON regardless of Accept header
        try {
            $validated = $request->validate([
                'donor_first_name' => ['required', 'string', 'max:100'],
                'donor_last_name'  => ['required', 'string', 'max:100'],
                'donor_email'      => ['required', 'email', 'max:255'],
                'donor_phone'      => ['nullable', 'string', 'max:30'],
                'donor_pan'        => ['nullable', 'string', 'max:10', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
                'donor_address'    => ['nullable', 'string', 'max:500'],
                'amount'           => ['required', 'numeric', 'min:1'],
                'payment_method'   => ['required', 'string', 'in:online,offline,test'],
                'cause_id'         => ['nullable', 'integer', 'exists:causes,id'],
                'message'          => ['nullable', 'string', 'max:2000'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error'  => collect($e->errors())->flatten()->first(),
                'errors' => $e->errors(),
            ], 422);
        }

        // Only online payments go through Razorpay
        if ($validated['payment_method'] !== 'online') {
            return response()->json(['error' => 'Use the standard form for offline/test payments.'], 422);
        }

        $amountPaise = (int) round((float) $validated['amount'] * 100);

        $data = DonationData::fromRequest($validated);

        try {
            $api   = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));
            $order = $api->order->create([
                'amount'          => $amountPaise,
                'currency'        => config('razorpay.currency', 'INR'),
                'payment_capture' => 1,
                'notes'           => [
                    'donor_name'  => trim($validated['donor_first_name'] . ' ' . $validated['donor_last_name']),
                    'donor_email' => $validated['donor_email'],
                    'cause_id'    => $validated['cause_id'] ?? '',
                ],
            ]);

            // Save a pending donation so we have a record even if the user closes the modal
            $donation = $this->storeDonationAction->handle($data, 'pending', $order->id);
        } catch (\Throwable $e) {
            Log::error('Razorpay order creation failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Payment gateway error. Please try again.'], 500);
        }

        return response()->json([
            'order_id'    => $order->id,
            'amount'      => $amountPaise,
            'currency'    => 'INR',
            'key_id'      => config('razorpay.key_id'),
            'donation_id' => $donation->id,
            'name'        => trim($validated['donor_first_name'] . ' ' . $validated['donor_last_name']),
            'email'       => $validated['donor_email'],
            'phone'       => $validated['donor_phone'] ?? '',
            'description' => 'Donation to Ujjawal Unnati Foundation',
        ]);
    }

    /**
     * Verify Razorpay payment signature and mark donation as completed.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'razorpay_order_id'   => ['required', 'string'],
            'razorpay_payment_id' => ['required', 'string'],
            'razorpay_signature'  => ['required', 'string'],
            'donation_id'         => ['required', 'integer', 'exists:donations,id'],
        ]);

        $expectedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
            config('razorpay.key_secret')
        );

        if (!hash_equals($expectedSignature, $request->razorpay_signature)) {
            Log::warning('Razorpay signature mismatch', [
                'order_id'   => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
            ]);

            $donation = Donation::find($request->donation_id);
            $donation?->update(['status' => 'failed']);

            return redirect()->route('donation.index')
                ->with('error', 'Payment verification failed. If money was deducted, please contact us.');
        }

        $donation = Donation::find($request->donation_id);

        if ($donation && $donation->status !== 'completed') {
            $this->storeDonationAction->markCompleted($donation, $request->razorpay_payment_id);
            $this->donationService->sendReceipt($donation->fresh());
        }

        return redirect()->route('donation.thankYou')
            ->with('donation_completed', $donation->id);
    }

    /**
     * Show the thank-you page after a successful/recorded donation.
     * Reads the donation id from the session (not the URL) so donors
     * cannot view other people's donation details.
     */
    public function thankYou(): View|RedirectResponse
    {
        $donationId = session('donation_completed');

        if (! $donationId) {
            return redirect()->route('donation.index');
        }

        $donation = Donation::with('cause')->find($donationId);

        if (! $donation) {
            return redirect()->route('donation.index');
        }

        // Keep it available if the page is re-rendered within the same request cycle.
        session()->keep('donation_completed');

        return view('donation.thank-you', ['donation' => $donation]);
    }

    /**
     * Handle offline / test donations (no Razorpay).
     */
    public function store(StoreDonationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['payment_method'] === 'online') {
            return redirect()->route('donation.index')
                ->with('error', 'Online payments must go through the Razorpay checkout.');
        }

        $data     = DonationData::fromRequest($validated);
        $donation = $this->storeDonationAction->handle($data, 'pending');

        return redirect()->route('donation.thankYou')
            ->with('donation_completed', $donation->id);
    }
}
