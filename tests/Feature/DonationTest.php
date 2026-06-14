<?php

use App\Models\Cause;
use App\Models\Donation;
use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;

/**
 * Valid donation payload helper.
 * Defaults to 'offline' — store() only handles offline/test.
 * Online payments go through Razorpay createOrder + verify (separate flow).
 */
function validDonation(array $overrides = []): array
{
    return array_merge([
        'donor_first_name' => 'Jane',
        'donor_last_name'  => 'Doe',
        'donor_email'      => 'jane.doe@example.com',
        'donor_phone'      => '555-0100',
        'amount'           => 50,
        'payment_method'   => 'offline',
        'cause_id'         => null,
        'message'          => 'Keep up the great work!',
    ], $overrides);
}

it('shows the donation page with causes', function () {
    $cause = Cause::create([
        'title'       => 'Test Cause',
        'goal_amount' => 1000,
        'is_active'   => true,
        'order'       => 1,
    ]);

    $this->get('/donation')
        ->assertOk()
        ->assertSee($cause->title);
});

it('stores a valid donation and redirects with success', function () {
    $response = $this->post('/donation', validDonation());

    $response->assertRedirect(route('donation.index'));
    $response->assertSessionHas('success');
});

it('shows validation error when amount is missing', function () {
    $this->post('/donation', validDonation(['amount' => '']))
        ->assertSessionHasErrors(['amount']);
});

it('shows validation error when amount is zero', function () {
    $this->post('/donation', validDonation(['amount' => 0]))
        ->assertSessionHasErrors(['amount']);
});

it('shows validation error when amount is negative', function () {
    $this->post('/donation', validDonation(['amount' => -10]))
        ->assertSessionHasErrors(['amount']);
});

it('shows validation error when donor email is invalid', function () {
    $this->post('/donation', validDonation(['donor_email' => 'not-an-email']))
        ->assertSessionHasErrors(['donor_email']);
});

it('shows validation error when required fields are missing', function () {
    $this->post('/donation', [])
        ->assertSessionHasErrors(['donor_first_name', 'donor_last_name', 'donor_email', 'amount', 'payment_method']);
});

it('accepts donation without a cause (cause_id nullable)', function () {
    $this->post('/donation', validDonation(['cause_id' => null]))
        ->assertRedirect(route('donation.index'))
        ->assertSessionHas('success');
});

it('accepts donation with a valid cause_id', function () {
    $cause = Cause::create([
        'title'       => 'Valid Cause',
        'goal_amount' => 5000,
        'is_active'   => true,
        'order'       => 1,
    ]);

    $this->post('/donation', validDonation(['cause_id' => $cause->id]))
        ->assertRedirect(route('donation.index'))
        ->assertSessionHas('success');
});

it('rejects donation with non-existent cause_id', function () {
    $this->post('/donation', validDonation(['cause_id' => 999999]))
        ->assertSessionHasErrors(['cause_id']);
});

it('creates donation record in database with correct values', function () {
    $this->post('/donation', validDonation([
        'donor_first_name' => 'Alice',
        'donor_last_name'  => 'Smith',
        'donor_email'      => 'alice.smith@example.com',
        'amount'           => 75.00,
        'payment_method'   => 'offline',
    ]));

    $this->assertDatabaseHas('donations', [
        'donor_first_name' => 'Alice',
        'donor_last_name'  => 'Smith',
        'donor_email'      => 'alice.smith@example.com',
        'payment_method'   => 'offline',
    ]);
});

it('sets donated_at timestamp on creation', function () {
    $this->post('/donation', validDonation([
        'donor_email' => 'timestamptest@example.com',
    ]));

    $donation = Donation::where('donor_email', 'timestamptest@example.com')->first();
    expect($donation)->not->toBeNull();
    expect($donation->donated_at)->not->toBeNull();
});

it('accepts offline and test payment methods via store()', function () {
    // 'online' goes through Razorpay createOrder+verify, not store()
    foreach (['offline', 'test'] as $method) {
        $email = "payment_{$method}@example.com";
        $this->post('/donation', validDonation([
            'payment_method' => $method,
            'donor_email'    => $email,
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('donations', [
            'donor_email'    => $email,
            'payment_method' => $method,
        ]);
    }
});

it('rejects online payment via store() — must use Razorpay flow', function () {
    $this->post('/donation', validDonation(['payment_method' => 'online']))
        ->assertRedirect(route('donation.index'))
        ->assertSessionHas('error');
});

it('rejects invalid payment method', function () {
    $this->post('/donation', validDonation(['payment_method' => 'crypto']))
        ->assertSessionHasErrors(['payment_method']);
});

it('increments cause raised_amount when donation is marked completed', function () {
    $cause = Cause::create([
        'title'          => 'Increment Cause',
        'goal_amount'    => 10000,
        'raised_amount'  => 200,
        'is_active'      => true,
        'order'          => 1,
    ]);

    $this->post('/donation', validDonation([
        'cause_id'    => $cause->id,
        'amount'      => 100,
        'payment_method' => 'offline',
        'donor_email' => 'increment@example.com',
    ]));

    // Offline donations start as 'pending'; raised_amount increments on markCompleted
    $donation = Donation::where('donor_email', 'increment@example.com')->first();
    expect($donation)->not->toBeNull();
    expect((float) $cause->fresh()->raised_amount)->toBe(200.0); // still 200 while pending

    app(\App\Actions\Donation\StoreDonationAction::class)->markCompleted($donation, 'BANK-TXN-TEST');

    expect((float) $cause->fresh()->raised_amount)->toBe(300.0);
});
